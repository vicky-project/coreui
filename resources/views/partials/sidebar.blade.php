@props(['menus' => [], 'group' => null])

@php
$menuService = app(\Modules\CoreUI\Services\MenuService::class);
$currentUser = auth()->user();
@endphp

@if(!empty($menus))
<nav class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <h3>{{ config('app.name') }}</h3>
  </div>

  <ul class="nav flex-column">
    @foreach($menus as $groupName => $groupMenus)
    {{-- Header grup jika bukan grup default --}}
    @if($groupName !== 'default' && !empty($groupMenus))
    <li class="nav-header">{{ $groupName }}</li>
    @endif

    @foreach($groupMenus as $menu)
    @php
    $hasChildren = !empty($menu['children']);
    $isActive = $menuService->isActive($menu);
    $canAccess = $menuService->canAccess($menu, $currentUser);
    @endphp

    @if($canAccess)
    @if(($menu['type'] ?? 'link') === 'divider')
    <li><hr class="sidebar-divider"></li>
    @elseif(($menu['type'] ?? 'link') === 'header')
    <li class="nav-header">{{ $menu['title'] }}</li>
    @else
    <li class="nav-item {{ $hasChildren ? 'dropdown' : '' }}">
      <a href="{{ $menu['url'] ?? ($menu['route'] ? route($menu['route'], $menu['route_params'] ?? []) : '#') }}"
        class="nav-link {{ $isActive ? 'active' : '' }} {{ $hasChildren ? 'dropdown-toggle' : '' }}"
        @if($hasChildren) data-bs-toggle="collapse" data-bs-target="#collapse-{{ $menu['id'] }}" aria-expanded="false" @endif
        @if(!empty($menu['target'])) target="{{ $menu['target'] }}" @endif
        {!! $menu['attributes'] ? implode(' ', array_map(fn($k, $v) => "$k=\"$v\"", array_keys($menu['attributes']), $menu['attributes'])) : '' !!}
        >
        @if(!empty($menu['icon']))
        <i class="{{ $menu['icon'] }}"></i>
        @endif
        <span>{{ $menu['title'] }}</span>
        @if(!empty($menu['badge']))
        <span class="badge bg-{{ $menu['badge_type'] ?? 'primary' }} ms-auto">{{ $menu['badge'] }}</span>
        @endif
      </a>

      @if($hasChildren)
      <div class="collapse" id="collapse-{{ $menu['id'] }}">
        <ul class="nav flex-column ms-3">
          @foreach($menu['children'] as $child)
          @php
          $childActive = $menuService->isActive($child);
          $childCanAccess = $menuService->canAccess($child, $currentUser);
          @endphp
          @if($childCanAccess)
          <li class="nav-item">
            <a href="{{ $child['url'] ?? ($child['route'] ? route($child['route'], $child['route_params'] ?? []) : '#') }}"
              class="nav-link {{ $childActive ? 'active' : '' }}"
              @if(!empty($child['target'])) target="{{ $child['target'] }}" @endif
              >
              @if(!empty($child['icon']))
              <i class="{{ $child['icon'] }}"></i>
              @endif
              <span>{{ $child['title'] }}</span>
              @if(!empty($child['badge']))
              <span class="badge bg-{{ $child['badge_type'] ?? 'primary' }} ms-auto">{{ $child['badge'] }}</span>
              @endif
            </a>
          </li>
          @endif
          @endforeach
        </ul>
      </div>
      @endif
    </li>
    @endif
    @endif
    @endforeach
    @endforeach
  </ul>
</nav>
@else
<div class="p-3 text-muted">
  No menu items available.
</div>
@endif