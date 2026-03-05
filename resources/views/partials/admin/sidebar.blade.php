<nav class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <h3>{{ config('app.name') }}</h3>
  </div>

  <ul class="nav flex-column">
    @php
    // Tentukan menu berdasarkan ketersediaan modul Admin
    $menuManager = app(\Modules\CoreUI\Services\MenuManager::class);
    $menus = $menuManager->getAll();
    @endphp

    @foreach($menus as $menu)
    @if(isset($menu['children']) && count($menu['children']) > 0)
    {{-- Menu dengan submenu (dropdown) --}}
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="{{ $menu['icon'] ?? 'bi bi-folder' }}"></i>
        <span>{{ $menu['title'] }}</span>
      </a>
      <ul class="dropdown-menu">
        @foreach($menu['children'] as $child)
        @can($child['permission'] ?? 'access admin')
        <li>
          <a class="dropdown-item" href="{{ isset($child['route']) ? route($child['route']) : '#' }}">
            <i class="{{ $child['icon'] ?? 'bi bi-dot' }}"></i> {{ $child['title'] }}
          </a>
        </li>
        @endcan
        @endforeach
      </ul>
    </li>
    @else
    {{-- Menu biasa --}}
    @can($menu['permission'] ?? 'access admin')
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs($menu['route'] ?? '') ? 'active' : '' }}"
        href="{{ isset($menu['route']) ? route($menu['route']) : '#' }}">
        <i class="{{ $menu['icon'] ?? 'bi bi-circle' }}"></i>
        <span>{{ $menu['title'] }}</span>
      </a>
    </li>
    @endcan
    @endif
    @endforeach
  </ul>
</nav>