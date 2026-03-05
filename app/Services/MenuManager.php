<?php
namespace Modules\CoreUI\Services;

class MenuManager
{
	protected array $menus = [];

	/**
	 * Tambahkan menu atau grup menu
	 * @param array $menu [
	 *   'title' => 'Menu Title',
	 *   'icon' => 'bi bi-icon',
	 *   'route' => 'route.name',   // opsional untuk parent
	 *   'permission' => 'permission', // opsional
	 *   'order' => int,
	 *   'children' => [              // opsional untuk submenu
	 *       ['title' => 'Sub', 'icon' => '...', 'route' => '...', 'permission' => '...']
	 *   ]
	 * ]
	 */
	public function add(array $menu): void
	{
		$this->menus[] = $menu;
	}

	public function getAll(): array
	{
		// Urutkan berdasarkan order
		usort(
			$this->menus,
			fn($a, $b) => ($a["order"] ?? 999) <=> ($b["order"] ?? 999),
		);
		return $this->menus;
	}
}
