<?php
namespace Modules\CoreUI\Services;

use Modules\CoreUI\Interfaces\MenuProvider;
use Illuminate\Support\Str;

abstract class BaseMenuProvider implements MenuProvider
{
  /**
  * Module name
  */
  protected string $module;

  /**
  * Menu configuration
  */
  protected array $config = [
    "group" => null,
    "location" => "sidebar",
    "icon" => null,
    "order" => 0,
    "permission" => null,
    "roles" => [],
    "conditions" => [],
  ];

  /**
  * Constructor
  */
  public function __construct(string $module) {
    $this->module = $module;
  }

  /**
  * Get menu identifier
  */
  public function getName(): string
  {
    return $this->module . "_" . strtolower(class_basename(static::class));
  }

  /**
  * Get menu configuration
  */
  public function getConfig(): array
  {
    return array_merge($this->config, [
      "module" => $this->module,
      "provider" => static::class,
    ]);
  }

  /**
  * Create a menu item
  */
  protected function item(array $item): array
  {
    $defaults = [
      "id" => $this->module.'_'. Str::slug($item['title']??uniqid()),
      "type" => "link",
      "title" => "",
      "icon" => null,
      "url" => null,
      "route" => null,
      "route_params" => [],
      "target" => "_self",
      "order" => 0,
      "group" => null,
      "permission" => null,
      "roles" => [],
      "conditions" => [],
      "children" => [],
      "attributes" => [],
      "active_patterns" => [],
      "badge" => null,
      "badge_type" => "primary",
      "divider" => false,
    ];

    return array_merge($defaults, $item);
  }

  /**
  * Create a menu group
  */
  protected function group(
    string $title,
    array $items,
    array $config = []
  ): array {
    return [
      "type" => "group",
      "title" => $title,
      "items" => $items,
      "config" => array_merge(
        [
          "collapsible" => true,
          "collapsed" => false,
          "icon" => null,
        ],
        $config
      ),
    ];
  }

  /**
  * Create a divider
  */
  protected function divider(int $order = 0): array
  {
    return [
      "type" => "divider",
      "order" => $order,
      "divider" => true,
    ];
  }

  /**
  * Create a header
  */
  protected function header(string $title, array $config = []): array
  {
    return [
      "type" => "header",
      "title" => $title,
      "order" => $config["order"] ?? 0,
      "icon" => $config["icon"] ?? null,
      "class" => $config["class"] ?? "",
    ];
  }
}