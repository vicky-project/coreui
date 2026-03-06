<?php
namespace Modules\CoreUI\Console;

use Illuminate\Console\Command;
use Modules\CoreUI\Services\MenuService;

class ClearMenuCacheCommand extends Command
{
  protected $signature = "app:menu-clear";
  protected $description = "Clear the menu cache";

  public function handle() {
    $menuService = app(MenuService::class);
    $menuService->clearCache();

    $this->info("Menu cache cleared successfully.");
  }
}