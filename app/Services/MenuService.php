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
  * Daftarkan autoloader kustom untuk memastikan semua kelas provider dapat ditemukan.
  * Panggil method ini di ServiceProvider (misal CoreUIServiceProvider).
  */
  public static function registerAutoloader(): void
  {
    spl_autoload_register(function ($class) {
      // Hanya tangani kelas dalam namespace Modules\
      if (str_starts_with($class, 'Modules\\')) {
        $parts = explode('\\', $class);
        // Struktur: Modules\ModuleName\...
        if (count($parts) >= 3) {
          $moduleName = $parts[1];
          $modulePath = module_path($moduleName);
          if (!$modulePath) {
            return;
          }
          // Ubah namespace ke path file
          $relativePath = implode(DIRECTORY_SEPARATOR, array_slice($parts, 2)) . '.php';
          $file = $modulePath . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $relativePath;

          if (File::exists($file)) {
            require_once $file;
            if (class_exists($class, false)) {
              return true;
            }
          }
        }
      }
    });
  }

  /**
  * Scan all modules for menu providers.
  * Sekarang cache hanya menyimpan data array, bukan objek.
  */
  public function scanMenuProviders(): Collection
  {
    // Hapus cache yang mungkin rusak (jalankan sekali jika perlu)
    // $this->clearCache();

    $providersArray = Cache::remember(static::CACHE_KEY,
      static::CACHE_TTL,
      function () {
        $providers = collect();

        $modules = Module::allEnabled();

        foreach ($modules as $module) {
          $moduleName = $module->getName();
          $modulePath = module_path($moduleName);

          // Scan Providers/Menu directory
          $providerPath = $modulePath . "/app/Providers/Menu";

          if (File::exists($providerPath)) {
            logger()->info("Directory found: {$providerPath}");

            $files = File::allFiles($providerPath);

            foreach ($files as $file) {
              $className = $this->getClassNameFromFile($file, $moduleName);

              if ($className && class_exists($className)) {
                $reflection = new ReflectionClass($className);

                if ($reflection->implementsInterface(MenuProvider::class)) {
                  $provider = app($className);
                  // Simpan data sebagai array agar aman dari serialisasi
                  $providers->put($provider->getName(), [
                    'name' => $provider->getName(),
                    'class' => $className,
                    'menus' => $provider->getMenus(),
                    'config' => $provider->getConfig(),
                  ]);
                }
              }
            }
          }

          // Check MenuServiceProvider in main Providers directory
          $menuProviderClass = "Modules\\{$moduleName}\\Providers\\MenuServiceProvider";
          if (class_exists($menuProviderClass)) {
            $reflection = new ReflectionClass($menuProviderClass);

            if ($reflection->implementsInterface(MenuProvider::class)) {
              $provider = app($menuProviderClass);
              $providers->put($provider->getName(), [
                'name' => $provider->getName(),
                'class' => $menuProviderClass,
                'menus' => $provider->getMenus(),
                'config' => $provider->getConfig(),
              ]);
            }
          }
        }

        return $providers->toArray(); // simpan sebagai array
      });

    // Kembalikan Collection agar kompatibel dengan return type
    return collect($providersArray);
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

    $namespace = "Modules\\{$moduleName}\\" . str_replace("/",
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
    $providersCollection = $this->scanMenuProviders(); // ini sudah collection array
    $providers = $providersCollection->toArray();

    $menus = [
      "sidebar" => collect(),
      "navbar" => collect(),
      "footer" => collect(),
      "quick_actions" => collect(),
    ];

    foreach ($providers as $key => $providerData) {
      // providerData adalah array, bukan objek
      if (!is_array($providerData) || empty($providerData['menus'])) {
        logger()->warning("Invalid provider found.", ["key" => $key, "provider" => $providerData]);
        continue;
      }

      $providerMenus = $providerData['menus'];
      $providerConfig = $providerData['config'] ?? [];

      foreach ($providerMenus as $menu) {
        if (!isset($menu["location"])) {
          $menu["location"] = $providerConfig["location"] ?? "sidebar";
        }

        if (!isset($menu["group"])) {
          $menu["group"] = $providerConfig["group"] ?? "application";
        }

        $menu["provider"] = $providerData['name'];
        $menu["module"] = $providerConfig["module"] ?? null;

        $location = $menu["location"];
        if (isset($menus[$location])) {
          $menus[$location]->push($menu);
        }
      }
    }

    return $this->processMenus($menus);
  }

  // ... method processMenus, organizeMenuHierarchy, getGroupOrder, getMenusByLocation, dll.
  // TIDAK BERUBAH, cukup salin dari kode asli Anda.
  // Saya tidak menulis ulang semua karena panjang, tetapi pastikan Anda menyalinnya tanpa perubahan.
  // Berikut contoh beberapa method yang tetap sama:

  private function processMenus(array $menus): array
  {
    $processed = [];

    foreach ($menus as $location => $locationMenus) {
      $grouped = $locationMenus->groupBy("group");

      $processed[$location] = [];

      foreach ($grouped as $groupName => $groupMenus) {
        $sorted = $groupMenus->sortBy("order")->values();
        $organized = $this->organizeMenuHierarchy($sorted);
        $processed[$location][$groupName] = $organized;
      }

      uksort($processed[$location], function ($a, $b) use ($processed, $location) {
        $orderA = $this->getGroupOrder($processed[$location][$a]);
        $orderB = $this->getGroupOrder($processed[$location][$b]);
        return $orderA <=> $orderB;
      });
    }

    return $processed;
  }

  private function organizeMenuHierarchy(Collection $menus): Collection
  {
    // ... sama persis seperti kode Anda ...
  }

  private function getGroupOrder(Collection $menus): int
  {
    if ($menus->isEmpty()) return 999;
    return (int) $menus->avg("order");
  }

  // ... method lainnya (getMenusByLocation, getSidebarMenus, canAccess, dll.)
  // Salin seluruhnya dari kode asli tanpa modifikasi

  public function clearCache(): void
  {
    Cache::forget(static::CACHE_KEY);
  }
}