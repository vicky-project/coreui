<?php
namespace Modules\CoreUI\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Nwidart\Modules\Facades\Module;
use ReflectionClass;
use Modules\CoreUI\Interfaces\MenuProvider;
use Illuminate\Support\Collection;

class MenuService
{
  const CACHE_KEY = "module_menus_collections";
  const CACHE_TTL = 86400; // 24 jam

  /**
  * Scan all modules for menu providers
  */
  public function scanMenuProviders(): Collection
  {
    return Cache::remember(static::CACHE_KEY, static::CACHE_TTL, function () {
      $providers = collect();

      $modules = Module::allEnabled();

      foreach ($modules as $module) {
        $moduleName = $module->getName();
        $modulePath = module_path($moduleName);

        // Scan Providers directory for Menu providers
        $providerPath = $modulePath . "/app/Providers/Menu";

        if (File::exists($providerPath)) {
          logger()->info("Directory found: {$providerPath}");

          $files = File::allFiles($providerPath);
          logger()->debug("found files: " . count($files));

          foreach ($files as $file) {
            $className = $this->getClassNameFromFile($file, $moduleName);
            logger()->debug("Classname: {$className}");

            if ($className && class_exists($className)) {
              logger()->debug("Class exist for: {$className}");

              $reflection = new ReflectionClass($className);

              if ($reflection->implementsInterface(MenuProvider::class)) {
                $provider = app($className);
                $providers->push($provider->getName(), $provider);
              }
            }
          }
        }

        // Also check for MenuServiceProvider in main Providers directory
        $menuProviderClass = "Modules\\{$moduleName}\\Providers\\MenuServiceProvider";
        if (class_exists($menuProviderClass)) {
          $reflection = new ReflectionClass($menuProviderClass);

          if ($reflection->implementsInterface(MenuProvider::class)) {
            $provider = app($menuProviderClass);
            $providers->put($provider->getName(), $provider);
          }
        }
      }

      return $providers;
    });
  }

  /**
  * Get class name from file
  */
  private function getClassNameFromFile($file,
    string $moduleName): ?string
  {
    $path = $file->getPathname();
    $relativePath = str_replace(module_path($moduleName) . "/app",
      "",
      $path);
    $relativePath = trim($relativePath,
      "/");

    // Convert path to namespace
    $namespace =
    "Modules\\{$moduleName}\\" . str_replace("/",
      "\\",
      $relativePath);
    $namespace = str_replace(".php",
      "",
      $namespace);

    return $namespace;
  }

  /**
  * Get all menus grouped by location
  */
  public function getAllMenus(): array
  {
    $providers = $this->scanMenuProviders()->toArray();
    \Log::debug("all menus",
      ['menu' => $providers]);

    $menus = [
      "sidebar" => collect(),
      "navbar" => collect(),
      "footer" => collect(),
      "quick_actions" => collect(),
    ];

    foreach ($providers as $provider) {
      $providerMenus = $provider->getMenus();
      $providerConfig = $provider->getConfig();

      foreach ($providerMenus as $menu) {
        // Set default location from provider config if not specified
        if (!isset($menu["location"])) {
          $menu["location"] = $providerConfig["location"] ?? "sidebar";
        }

        // Set default group from provider config if not specified
        if (!isset($menu["group"])) {
          $menu["group"] = $providerConfig["group"] ?? "application";
        }

        // Add provider info
        $menu["provider"] = $provider->getName();
        $menu["module"] = $providerConfig["module"] ?? null;

        // Add to appropriate location collection
        $location = $menu["location"];
        if (isset($menus[$location])) {
          $menus[$location]->push($menu);
        }
      }
    }

    // Process and organize menus
    return $this->processMenus($menus);
  }

  /**
  * Process and organize menus
  */
  private function processMenus(array $menus): array
  {
    $processed = [];

    foreach ($menus as $location => $locationMenus) {
      // Group by group first
      $grouped = $locationMenus->groupBy("group");

      $processed[$location] = [];

      foreach ($grouped as $groupName => $groupMenus) {
        // Sort by order
        $sorted = $groupMenus->sortBy("order")->values();

        // Organize parent-child relationships
        $organized = $this->organizeMenuHierarchy($sorted);

        $processed[$location][$groupName] = $organized;
      }

      // Sort groups by average order
      uksort($processed[$location], function ($a, $b) use (
        $processed,
        $location
      ) {
        $orderA = $this->getGroupOrder($processed[$location][$a]);
        $orderB = $this->getGroupOrder($processed[$location][$b]);

        return $orderA <=> $orderB;
      });
    }

    return $processed;
  }

  /**
  * Organize menu hierarchy (parent-child relationships)
  */
  private function organizeMenuHierarchy(Collection $menus): Collection
  {
    $itemsById = [];
    $rootItems = collect();

    // First pass: index all items
    foreach ($menus as $menu) {
      $menu["children"] = collect();
      $itemsById[$menu["id"]] = $menu;
    }

    // Second pass: build hierarchy
    foreach ($menus as $menu) {
      if (isset($menu["parent_id"]) && isset($itemsById[$menu["parent_id"]])) {
        $itemsById[$menu["parent_id"]]["children"]->push($menu);
      } else {
        $rootItems->push($menu);
      }
    }

    // Sort children within each parent
    foreach ($itemsById as &$item) {
      $item["children"] = $item["children"]->sortBy("order")->values();
    }

    return $rootItems->sortBy("order")->values();
  }

  /**
  * Get average order for a group
  */
  private function getGroupOrder(Collection $menus): int
  {
    if ($menus->isEmpty()) {
      return 999;
    }

    return (int) $menus->avg("order");
  }

  /**
  * Get menus for a specific location
  */
  public function getMenusByLocation(
    string $location,
    ?string $group = null
  ): array|Collection {
    $allMenus = $this->getAllMenus();

    if (!isset($allMenus[$location])) {
      return [];
    }

    if ($group) {
      return $allMenus[$location][$group] ?? [];
    }

    return $allMenus[$location];
  }

  /**
  * Get sidebar menus
  */
  public function getSidebarMenus(?string $group = null): array|Collection
  {
    return $this->getMenusByLocation("sidebar", $group);
  }

  /**
  * Get navbar menus
  */
  public function getNavbarMenus(): array
  {
    return $this->getMenusByLocation("navbar");
  }

  /**
  * Check if user can access menu item
  */
  public function canAccess(array $menuItem, $user = null): bool
  {
    // If no user, check if menu is public
    if (!auth()->check()) {
      return empty($menuItem["permission"]) && empty($menuItem["roles"]);
    }

    // Check permission
    $user = $user ?? auth()->user();
    if (
      !empty($menuItem["permission"]) &&
      !$user->can($menuItem["permission"])
    ) {
      return false;
    }

    // Check roles
    if (!empty($menuItem["roles"])) {
      $hasRole = false;
      foreach ($menuItem["roles"] as $role) {
        if ($user->hasRole($role)) {
          $hasRole = true;
          break;
        }
      }
      if (!$hasRole) {
        return false;
      }
    }

    // Check custom conditions
    if (!empty($menuItem["conditions"])) {
      foreach ($menuItem["conditions"] as $condition) {
        if (is_callable($condition) && !call_user_func($condition, $user)) {
          return false;
        }
      }
    }

    return true;
  }

  /**
  * Filter menus by user permissions
  */
  public function filterMenusByUser(
    array|Collection $menus,
    $user = null
  ): array {
    $filtered = [];
    $user = $user ?? auth()->user();

    foreach ($menus as $key => $menu) {
      if ($menu["type"] === "group") {
        $filteredItems = [];
        foreach ($menu["items"] as $item) {
          if ($this->canAccess($item, $user)) {
            $filteredItems[] = $this->filterMenuItemChildren($item, $user);
          }
        }

        if (!empty($filteredItems)) {
          $menu["items"] = $filteredItems;
          $filtered[$key] = $menu;
        }
      } elseif ($this->canAccess($menu, $user)) {
        $filtered[$key] = $this->filterMenuItemChildren($menu, $user);
      }
    }

    return $filtered;
  }

  /**
  * Filter menu item children by user permissions
  */
  private function filterMenuItemChildren(array $menuItem, $user): array
  {
    if (!empty($menuItem["children"])) {
      $filteredChildren = [];
      foreach ($menuItem["children"] as $child) {
        if ($this->canAccess($child, $user)) {
          $filteredChildren[] = $this->filterMenuItemChildren($child, $user);
        }
      }
      $menuItem["children"] = $filteredChildren;
    }

    return $menuItem;
  }

  /**
  * Clear menu cache
  */
  public function clearCache(): void
  {
    Cache::forget(static::CACHE_KEY);
  }

  /**
  * Check if menu item is active
  */
  public function isActive(array $menuItem): bool
  {
    $currentUrl = request()->url();

    // Check by route name
    if (!empty($menuItem['route']) && request()->routeIs($menuItem['route'])) {
      return true;
    }

    // Check by URL
    if (!empty($menuItem["url"])) {
      $menuUrl = url($menuItem["url"]);
      if ($menuUrl === $currentUrl || $menuUrl === request()->fullUrl()) {
        return true;
      }
    }

    // Check children
    if (!empty($menuItem["children"])) {
      foreach ($menuItem["children"] as $child) {
        if ($this->isActive($child)) {
          return true;
        }
      }
    }

    return false;
  }
}