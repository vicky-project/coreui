<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', config('app.name'))</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  @include('coreui::partials.app.styles')

  @stack('styles')
</head>
<body class="{{ request()->has('token') ? 'telegram-app' : ''}}">
  <!-- Navbar -->
  @if(!session("is_telegram_app", false))
  @include('coreui::partials.app.navbar')
  @endif

  <!-- Toast Container for Flash Messages -->
  @if(session('success') || $errors->any())
  <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100;">
    @if(session('success'))
    <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000">
      <div class="d-flex">
        <div class="toast-body">
          <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
    @endif

    @if($errors->any())
    <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000">
      <div class="d-flex">
        <div class="toast-body">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
    @endif
  </div>
  @endif

  <!-- Main Content -->
  <div class="main-content">
    <div class="container">
      @yield('content')
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <span>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</span>
    </div>
  </footer>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Telegram WebApp SDK -->
  <script src="https://telegram.org/js/telegram-web-app.js?61"></script>

  <script>
    // Terapkan tema Telegram ke CSS variables
    function applyTelegramTheme() {
      if (tg && tg.themeParams) {
        const theme = tg.themeParams;
        document.documentElement.style.setProperty('--tg-theme-bg-color', theme.bg_color || '#ffffff');
        document.documentElement.style.setProperty('--tg-theme-text-color', theme.text_color || '#000000');
        document.documentElement.style.setProperty('--tg-theme-hint-color', theme.hint_color || '#999999');
        document.documentElement.style.setProperty('--tg-theme-link-color', theme.link_color || '#40a7e3');
        document.documentElement.style.setProperty('--tg-theme-button-color', theme.button_color || '#40a7e3');
        document.documentElement.style.setProperty('--tg-theme-button-text-color', theme.button_text_color || '#ffffff');
        document.documentElement.style.setProperty('--tg-theme-secondary-bg-color', theme.secondary_bg_color || '#f0f0f0');
        document.documentElement.style.setProperty('--tg-theme-section-bg-color', theme.section_bg_color || '#f0f0f0');
        document.documentElement.style.setProperty('--tg-theme-section-header-text-color', theme.section_header_text_color || '#000000');
        document.documentElement.style.setProperty('--tg-theme-subtitle-text-color', theme.subtitle_text_color || '#666666');
        document.documentElement.style.setProperty('--tg-theme-destructive-text-color', theme.destructive_text_color || '#ff3b30');
        document.documentElement.style.setProperty('--tg-theme-section-separator-color', theme.section_separator_color || '#e9ecef');
        document.documentElement.style.setProperty('--tg-theme-header-bg-color', theme.header_bg_color || '#ffffff');
      } else {
        if (tg.colorScheme === 'dark') {
          document.documentElement.style.setProperty('--tg-theme-bg-color', '#1f1f1f');
          document.documentElement.style.setProperty('--tg-theme-text-color', '#ffffff');
          document.documentElement.style.setProperty('--tg-theme-hint-color', '#aaaaaa');
          document.documentElement.style.setProperty('--tg-theme-link-color', '#8774e1');
          document.documentElement.style.setProperty('--tg-theme-button-color', '#8774e1');
          document.documentElement.style.setProperty('--tg-theme-button-text-color', '#ffffff');
          document.documentElement.style.setProperty('--tg-theme-secondary-bg-color', '#2f2f2f');
          document.documentElement.style.setProperty('--tg-theme-section-bg-color', '#2f2f2f');
          document.documentElement.style.setProperty('--tg-theme-section-header-text-color', '#ffffff');
          document.documentElement.style.setProperty('--tg-theme-subtitle-text-color', '#cccccc');
          document.documentElement.style.setProperty('--tg-theme-destructive-text-color', '#ff453a');
          document.documentElement.style.setProperty('--tg-theme-section-separator-color', '#3a3a3a');
          document.documentElement.style.setProperty('--tg-theme-header-bg-color', '#1f1f1f');
        } else {
          document.documentElement.style.setProperty('--tg-theme-bg-color', '#ffffff');
          document.documentElement.style.setProperty('--tg-theme-text-color', '#000000');
          document.documentElement.style.setProperty('--tg-theme-hint-color', '#999999');
          document.documentElement.style.setProperty('--tg-theme-link-color', '#40a7e3');
          document.documentElement.style.setProperty('--tg-theme-button-color', '#40a7e3');
          document.documentElement.style.setProperty('--tg-theme-button-text-color', '#ffffff');
          document.documentElement.style.setProperty('--tg-theme-secondary-bg-color', '#f0f0f0');
          document.documentElement.style.setProperty('--tg-theme-section-bg-color', '#f0f0f0');
          document.documentElement.style.setProperty('--tg-theme-section-header-text-color', '#000000');
          document.documentElement.style.setProperty('--tg-theme-subtitle-text-color', '#666666');
          document.documentElement.style.setProperty('--tg-theme-destructive-text-color', '#ff3b30');
          document.documentElement.style.setProperty('--tg-theme-section-separator-color', '#e9ecef');
          document.documentElement.style.setProperty('--tg-theme-header-bg-color', '#ffffff');
        }
      }
    }

    // Fungsi toast
    function showToast(message, type = 'success') {
      let toastContainer = document.querySelector('.toast-container');
      if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
        document.body.appendChild(toastContainer);

        const toastEl = document.createElement('div');
        toastEl.id = 'liveToast';
        toastEl.className = 'toast';
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');
        toastEl.innerHTML = `
        <div class="toast-header">
        <strong class="me-auto">Notifikasi</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body"></div>
        `;
        toastContainer.appendChild(toastEl);
      }

      const toastEl = document.getElementById('liveToast');
      const toastBody = toastEl.querySelector('.toast-body');
      toastBody.textContent = message;

      toastEl.classList.remove('bg-success', 'bg-danger', 'text-white');
      if (type === 'success') {
        toastEl.classList.add('bg-success', 'text-white');
      } else if (type === 'danger') {
        toastEl.classList.add('bg-danger', 'text-white');
      } else {
        toastEl.classList.add('bg-info', 'text-white');
      }

      const toast = new bootstrap.Toast(toastEl);
      toast.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
    // Telegram Mini App detection
    // Inisialisasi Telegram WebApp
    const tg = window.Telegram?.WebApp;
    if (tg?.initData) {
    applyTelegramTheme();
    tg.onEvent('themeChanged', function() {
    applyTelegramTheme();
    });
    tg.BackButton.isVisible = true;
    tg.onEvent("backButtonClicked",
    function () {
    const urlObj = new URL('{{ config("coreui.home_url") }}', window.location.origin);
    urlObj.searchParams.set("initData", tg.initData);
    window.location = urlObj.toString();
    });
    tg.BackButton.show();
    tg.setBottomBarColor(tg.themeParams.bottom_bar_bg_color);
    tg.expand();
    tg.ready();
    }

    // Inisialisasi semua toast yang ada di halaman
    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function(toastEl) {
    return new bootstrap.Toast(toastEl).show();
    });
    });
  </script>

  @stack('scripts')
</body>
</html>