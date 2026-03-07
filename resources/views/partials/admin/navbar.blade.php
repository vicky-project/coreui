<div class="navbar-top">
  <div class="d-flex align-items-center">
    <i class="bi bi-list toggle-sidebar" id="toggleSidebar"></i>
    <span class="ms-3 d-none d-sm-inline">@yield('title', 'Admin Panel')</span>
  </div>

  <div class="dropdown">
    <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
      <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="rounded-circle" width="32" height="32">
      <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <a class="dropdown-item" href="{{ route('profile') }}">
          <i class="bi bi-person"></i> Profile
        </a>
      </li>
      <li><hr class="dropdown-divider"></li>
      <li>
        <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </li>
    </ul>
  </div>
</div>