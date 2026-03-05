<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin Panel') - {{ config('app.name') }}</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  @include('coreui::partials.admin.styles')

  @stack('styles')
</head>
<body class="{{ session('is_telegram_app') ? 'telegram-app' : '' }}">
  <div class="wrapper">
    <!-- Sidebar -->
    @include('coreui::partials.admin.sidebar')

    <!-- Main Content -->
    <div class="content" id="content">
      <!-- Navbar -->
      @include('coreui::partials.admin.navbar')

      <!-- Page Content -->
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Telegram WebApp SDK -->
  <script src="https://telegram.org/js/telegram-web-app.js?59"></script>

  <script>
    // Toggle sidebar
    document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    if (toggleBtn) {
    toggleBtn.addEventListener('click', function() {
    sidebar.classList.toggle('collapsed');
    content.classList.toggle('expanded');

    // Save state to localStorage
    const isCollapsed = sidebar.classList.contains('collapsed');
    localStorage.setItem('sidebarCollapsed', isCollapsed);
    });
    }

    // Restore sidebar state from localStorage
    const savedState = localStorage.getItem('sidebarCollapsed');
    if (savedState === 'true') {
    sidebar.classList.add('collapsed');
    content.classList.add('expanded');
    }

    // Telegram Mini App detection
    if (window.Telegram?.WebApp) {
    Telegram.WebApp.ready();
    Telegram.WebApp.expand();
    document.body.classList.add('telegram-app');

    // Set session flag via AJAX if needed (optional)
    @if(Route::has('telegram.set-session'))
    fetch('{{ secure_url(route("telegram.set-session")) }}', {
    method: 'POST',
    headers: {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    'Content-Type': 'application/json'
    },
    body: JSON.stringify({ is_telegram_app: true })
    });
    @endif
    }
    });
  </script>

  @stack('scripts')
</body>
</html>