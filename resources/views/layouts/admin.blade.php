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

  <style>
    /* Global Loading Overlay */
    .global-loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(255,255,255,0.8);
      backdrop-filter: blur(3px);
      z-index: 10555;
      /* di atas segalanya */
      display: flex;
      align-items: center;
      justify-content: center;
      pointer-events: all;
    }
    .global-loading-overlay .spinner-content {
      text-align: center;
    }
  </style>

  @stack('styles')
</head>
<body>
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

  <!-- Global Loading Overlay -->
  <div class="global-loading-overlay d-none" id="globalLoadingOverlay">
    <div class="spinner-content">
      <div class="spinner-border text-primary mb-2" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
      </div>
      <p class="fw-semibold mb-0 fs-5">
        Menyimpan perubahan...
      </p>
    </div>
  </div>
  <script src="//cdn.jsdelivr.net/npm/eruda"></script>
  <script>
    eruda.init();
  </script>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    (function() {
    let isSubmitting = false;

    // Tangkap semua submit form dengan method POST
    document.addEventListener('submit', function(e) {
    const form = e.target;

    // Hanya proses form dengan method POST
    if (form.method.toUpperCase() !== 'POST') return;

    // Cegah double submit
    if (isSubmitting) {
    e.preventDefault();
    e.stopPropagation();
    return false;
    }

    // Validasi HTML5 client-side
    if (!form.checkValidity()) {
    // Jika tidak valid, tampilkan feedback bawaan
    form.classList.add('was-validated');
    return;
    }

    // Tampilkan overlay
    const overlay = document.getElementById('globalLoadingOverlay');
    if (overlay) {
    overlay.classList.remove('d-none');
    }

    // Nonaktifkan semua tombol submit di form ini
    const submitButtons = form.querySelectorAll('button[type="submit"], input[type="submit"]');
    submitButtons.forEach(btn => {
    btn.disabled = true;
    // Simpan teks asli jika perlu
    btn.setAttribute('data-original-text', btn.innerHTML);
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
    });

    // Nonaktifkan link Cancel (asumsi punya class 'btn' atau 'cancel-link')
    const cancelLinks = form.querySelectorAll('a.btn, a[href]:not(.dropdown-toggle):not(.pagination a)');
    cancelLinks.forEach(link => {
    link.setAttribute('data-original-href', link.getAttribute('href'));
    link.setAttribute('href', 'javascript:void(0)');
    link.classList.add('disabled', 'pe-none');
    // Hentikan event klik
    link.addEventListener('click', function preventClick(ev) {
    ev.preventDefault();
    }, { once: true });
    });

    // Tandai sedang submit
    isSubmitting = true;
    });

    // Reset state jika halaman dimuat ulang (misal karena validasi server)
    window.addEventListener('pageshow', function() {
    isSubmitting = false;
    const overlay = document.getElementById('globalLoadingOverlay');
    if (overlay) {
    overlay.classList.add('d-none');
    }
    });

    // Fallback: reset jika tombol kembali ditekan
    window.addEventListener('beforeunload', function() {
    isSubmitting = false;
    });
    })();
  </script>
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

  @stack('scripts')
</body>
</html>