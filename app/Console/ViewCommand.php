<?php

namespace Modules\CoreUI\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ViewCommand extends Command
{
  /**
  * The name and signature of the console command.
  */
  protected $signature = "app:view-install {--force : Overwriting existing views by default.}";

  /**
  * The console command description.
  */
  protected $description = "Basic view template admin panel.";

  /**
  * The views that need to be exported.
  *
  * @var array
  */
  protected $views = [
    "welcome.stub" => "welcome.blade.php",
  ];

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
    $this->exportViews();

    $this->components->info("View layouts scaffolding generated successfully.");
  }

  /**
  * Get the console command options.
  */
  protected function getOptions(): array
  {
    return [
      [
        "force",
        null,
        InputOption::VALUE_OPTIONAL,
        "Overwrite existing view by default.",
        null,
      ],
    ];
  }

  protected function exportViews() {
    foreach ($this->views as $key => $value) {
      if (
        file_exists($view = $this->getViewPath($value)) &&
        !$this->option("force")
      ) {
        if (
          !$this->components->confirm(
            "The [$value] view already exists. Do you want to replace it?"
          )
        ) {
          continue;
        }
      }

      copy(module_path("CoreUI", "stubs/{$key}"), $view);
    }
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