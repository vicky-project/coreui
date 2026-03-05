<?php
namespace Modules\CoreUI\Services;

use Illuminate\Support\Facades\Blade;

class MenuRenderer
{
  protected MenuService $menuService;

  public function __construct(MenuService $menuService) {
    $this->menuService = $menuService;
  }

  /**
  * Render sidebar menu
  */
  public function renderSidebar(?string $group = null, $user = null): string
  {
    $menus = $this->menuService->getSidebarMenus($group);
    $filteredMenus = [];

    foreach ($menus as $groupName => $items) {
      $filteredItems = $this->menuService->filterMenusByUser($items, $user);
      if (!empty($filteredItems)) {
        $filteredMenus[$groupName] = $filteredItems;
      }
    }

    return view("coreui::partials.sidebar", [
      "menus" => $filteredMenus,
      "group" => $group,
    ])->render();
  }

  /**
  * Render navbar menu
  */
  public function renderNavbar($user = null): string
  {
    $menus = $this->menuService->getNavbarMenus();
    $filteredMenus = $this->menuService->filterMenusByUser($menus, $user);

    return view("coreui::partials.navbar", [
      "menus" => $filteredMenus,
    ])->render();
  }

  /**
  * Render menu by location
  */
  public function render(
    string $location,
    ?string $group = null,
    $user = null
  ): string {
    $menus = $this->menuService->getMenusByLocation($location, $group);
    $filteredMenus = $this->menuService->filterMenusByUser($menus, $user);

    return view("coreui::partials.{$location}", [
      "menus" => $filteredMenus,
      "group" => $group,
    ])->render();
  }

  /**
  * Register Blade directives
  */
  public function registerBladeDirectives(): void
  {
    // Menu directive
    Blade::directive("menu", function ($expression) {
      return "<?php echo app('Modules\\CoreUI\\Services\\MenuRenderer')->render({$expression}); ?>";
    });

    // Sidebar menu directive
    Blade::directive("sidebarMenu", function ($expression) {
      $params = $expression ?: "null, null";
      return "<?php echo app('Modules\\CoreUI\\Services\\MenuRenderer')->renderSidebar({$params}); ?>";
    });

    // Navbar menu directive
    Blade::directive("navbarMenu", function ($expression) {
      $params = $expression ?: "null";
      return "<?php echo app('Modules\\CoreUI\\Services\\MenuRenderer')->renderNavbar({$params}); ?>";
    });

    // Menu exists directive
    Blade::directive("hasMenu", function ($expression) {
      return "<?php if (!empty(app('Modules\\CoreUI\\Services\\MenuService')->getMenusByLocation({$expression}))): ?>";
    });

    Blade::directive("endhasMenu", function () {
      return "<?php endif; ?>";
    });
  }
}