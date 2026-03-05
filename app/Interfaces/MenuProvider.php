<?php
namespace Modules\CoreUI\Interfaces;

interface MenuProvider
{
  /**
  * Get menu identifier for this provider
  */
  public function getName(): string;

  /**
  * Get all menus provided by this module
  */
  public function getMenus(): array;

  /**
  * Get menu configuration
  */
  public function getConfig(): array;
}