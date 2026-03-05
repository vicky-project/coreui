<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', config('core.title', 'Vicky Server')) - config('app.name')</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  @include('core::partials.styles')

  @stack('styles')
</head>
<body>
  @yield('content')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Telegram WebApp SDK -->
  <script src="https://telegram.org/js/telegram-web-app.js?59"></script>
  <script>
    // Inisialisasi Telegram WebApp
    const tg = window.Telegram.WebApp;
    tg.expand(); // Memperluas ke layar penuh

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

    applyTelegramTheme();
    tg.onEvent('themeChanged', function() {
    applyTelegramTheme();
    });

    // Fungsi untuk menangani klik menu
    function handleMenuClick(menu) {
      // Contoh: tampilkan notifikasi dengan Toast Bootstrap (tanpa alert)
      const toastMessage = `Menu ${menu} diklik. Fitur sedang dikembangkan.`;
      showToast(toastMessage);

      // Di sini nanti bisa ditambahkan navigasi ke halaman lain
      // Misalnya dengan memuat konten dinamis atau mengarahkan ke route baru
    }

    // Fungsi untuk menampilkan Toast Bootstrap (feedback)
    function showToast(message, type = 'success') {
      // Cek apakah elemen toast sudah ada, jika belum buat
      let toastContainer = document.querySelector('.toast-container');
      if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
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

      // Warna latar belakang sesuai tipe
      toastEl.classList.remove('bg-success', 'bg-danger', 'text-white');

      switch (type) {
        case 'success':
          toastEl.classList.add('bg-success', 'text-white');
          break;
        case 'info':
          toastEl.classList.add('bg-info', 'text-white');
          break;
        case 'warning':
          toastEl.classList.add('bg-warning', 'text-white');
          break;
        case 'danger':
        default:
          toastEl.classList.add('bg-danger', 'text-white');
          break;
      }

      const toast = new bootstrap.Toast(toastEl);
      toast.show();
    }

    // Beri tahu Telegram bahwa halaman sudah siap
    tg.ready();
  </script>

  @stack('scripts')
</body>
</html>