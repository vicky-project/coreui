<?php

namespace Modules\CoreUI\Console;

use Nwidart\Modules\Facades\Module;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ModuleInstall extends Command
{
  /**
  * The name and signature of the console command.
  */
  protected $signature = "app:install {module?* : The module name(s) to install. If none provided, all modules will be installed.} {--force : Overwriting existing views by default.}";

  /**
  * The console command description.
  */
  protected $description = "Running setup module application.";

  /**
  * Create a new command instance.
  */
  public function __construct() {
    parent::__construct();
  }

  /**
  * Execute the console command.
  */
  public function handle() {
    $moduleNames = $this->argument('module') ?: []; // Ambil argumen, jika kosong jadikan array kosong

    // Tentukan modul yang akan diproses
    if (empty($moduleNames)) {
      $modules = Module::all();
      $this->info('No module specified. Installing all modules...');
    } else {
      $modules = [];
      foreach ($moduleNames as $name) {
        $module = Module::find($name);
        if (!$module) {
          $this->error("Module {$name} not found. Skipping.");
          continue;
        }
        $modules[] = $module;
      }

      if (empty($modules)) {
        $this->error('No valid modules found to install.');
        return 1;
      }
    }

    $exitCode = 0;

    foreach ($modules as $module) {
      $this->line(''); // Memberi jarak antar output module
      $this->info("Installing module {$module->getName()}...");

      // Enable module jika belum aktif
      if (!$module->isEnabled()) {
        $module->enable();
        $this->info("Module {$module->getName()} enabled.");
      } else {
        $this->info("Module {$module->getName()} already enabled.");
      }

      $postInstallationClass = "Modules\\{$module->getName()}\\Installations\\PostInstallation";

      if (class_exists($postInstallationClass)) {
        $this->info("Found installer. Running process...");
        $postInstallation = app($postInstallationClass);
        try {
          $postInstallation->handle($module->getName());
          $this->info("Installation process for {$module->getName()} completed.");
        } catch (\Exception $e) {
          logger()->error("Failed install module", [
            "module" => $module->getName(),
            "error" => $e->getMessage(),
            "trace" => $e->getTraceAsString(),
          ]);

          $this->error("Failed to install module {$module->getName()}: " . $e->getMessage());
          $exitCode = 1;
          continue; // Lanjut ke module berikutnya
        }
      } else {
        $this->info("No post-installation script found for module {$module->getName()}.");
      }

      $this->info("Installation for module {$module->getName()} successful.");
    }

    if ($exitCode === 0) {
      $this->info("All installations completed successfully.");
    } else {
      $this->error("Some installations failed. Check the logs for details.");
    }

    $this->exportViews();

    return $exitCode;
  }

  protected function exportViews() {
    $welcomePath = "welcome.blade.php";
    $stub = 'welcome.stub';
    if (
      file_exists($view = $this->getViewPath($welcomePath)) &&
      !$this->option("force")
    ) {
      if (
        !$this->components->confirm(
          "The [$welcomePath] view already exists. Do you want to replace it?"
        )
      ) {
        return;
      }
    }

    copy(module_path("Core", "stubs/{$stub}"), $view);
  }

  /**
  * Get the console command arguments.
  */
  protected function getArguments(): array
  {
    return [
      ['module',
        InputArgument::IS_ARRAY | InputArgument::OPTIONAL,
        'Module name(s) to be installed.'],
    ];
  }

  /**
  * Get full view path relative to the application's configured view path.
  *
  * @param  string  $path
  * @return string
  */
  protected function getViewPath($path) {
    return implode(DIRECTORY_SEPARATOR, [
      config("view.paths")[0] ?? resource_path("views"),
      $path,
    ]);
  }
}