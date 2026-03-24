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
    @sidebarMenu()

    <!-- Main Content -->
    <div class="content" id="content">
      <!-- Navbar -->
      @include('coreui::partials.admin.navbar')

      <!-- Page Content -->
      <div class="container">
        @yield('content')
      </div>
    </div>
  </div>

  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Telegram WebApp SDK -->
  <script src="https://telegram.org/js/telegram-web-app.js?61"></script>

  <script>
    // Toggle sidebar
    document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const content = document.getElementById('content');

    if (!toggleBtn || !sidebar) return;

    // Fungsi untuk menutup sidebar di mobile
    function closeMobileSidebar() {
    if (window.innerWidth < 768) {
    sidebar.classList.remove('active');
    if (overlay) overlay.classList.remove('active');
    }
    }

    // Fungsi untuk toggle sidebar
    function handleToggle() {
    const isMobile = window.innerWidth < 768;

    if (isMobile) {
    // Mode mobile: toggle active
    sidebar.classList.toggle('active');
    if (overlay) overlay.classList.toggle('active');
    } else {
    // Mode desktop: toggle collapsed
    sidebar.classList.toggle('collapsed');
    content.classList.toggle('expanded');
    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
    }
    }

    // Event listener untuk tombol toggle
    toggleBtn.addEventListener('click', handleToggle);

    // Klik di overlay menutup sidebar
    if (overlay) {
    overlay.addEventListener('click', closeMobileSidebar);
    }

    // Tekan tombol Escape untuk menutup sidebar di mobile
    document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && window.innerWidth < 768 && sidebar.classList.contains('active')) {
    closeMobileSidebar();
    }
    });

    // Handle resize
    let previousWidth = window.innerWidth;
    window.addEventListener('resize', function() {
    const currentWidth = window.innerWidth;
    const wasMobile = previousWidth < 768;
    const isMobile = currentWidth < 768;

    if (wasMobile !== isMobile) {
    // Reset semua class
    sidebar.classList.remove('active', 'collapsed');
    content.classList.remove('expanded');
    if (overlay) overlay.classList.remove('active');

    if (!isMobile) {
    // Desktop: atur collapsed sesuai localStorage
    const wasCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (wasCollapsed) {
    sidebar.classList.add('collapsed');
    content.classList.add('expanded');
    }
    }
    }
    previousWidth = currentWidth;
    });

    // Inisialisasi desktop
    if (window.innerWidth >= 768) {
    const wasCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (wasCollapsed) {
    sidebar.classList.add('collapsed');
    content.classList.add('expanded');
    }
    }
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
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
    });
  </script>

  @stack('scripts')
</body>
</html>