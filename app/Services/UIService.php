<?php
namespace Modules\CoreUI\Services;

class UIService
{
	protected static $hooks = [];

	public static function registerHook($name, $view)
	{
		static::$hooks[$name][] = $view;
	}

	public static function renderHook($name)
	{
		$output = "";
		foreach (static::$hooks[$name] ?? [] as $view) {
			$output .= view($view)->render();
		}
		return $output;
	}
}
