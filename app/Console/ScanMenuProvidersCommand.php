<?php
namespace Modules\CoreUI\Console;

use Illuminate\Console\Command;
use Modules\CoreUI\Services\MenuService;

class ScanMenuProvidersCommand extends Command
{
  protected $signature = "app:menu-scan";
  protected $description = "Scan all modules for menu providers";

  public function handle() {
    $menuService = app(MenuService::class);

    $this->info("Scanning for menu providers...");

    // Clear cache first
    $menuService->clearCache();

    // Scan providers
    $providers = $menuService->scanMenuProviders();

    $this->info("Found {$providers->count()} menu provider(s):");

    foreach ($providers as $name => $provider) {
      $this->line("- {$name}: " . get_class($provider));
    }

    $this->info("Menu providers scanned successfully.");
  }
}