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
<body>
  <!-- Navbar -->
  @if(!session("is_telegram_app", false))
  @include('coreui::partials.app.navbar')
  @endif

  <!-- Toast Container for Flash Messages -->
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
  <script src="https://telegram.org/js/telegram-web-app.js?59"></script>

  <script>
    // Telegram Mini App detection
    if (window.Telegram?.WebApp) {
      Telegram.WebApp.ready();
      Telegram.WebApp.expand();
      document.body.classList.add('telegram-app');

      // Optionally send session flag to server
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
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
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