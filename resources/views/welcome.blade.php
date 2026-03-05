@extends('coreui::layouts.main')

@section('content')
<div class="main-container">

  <!-- Logo Lingkaran -->
  <div class="app-logo d-flex justify-content-center align-items-center text-center p-4">
    <img src="{{ config('coreui.logo_url') }}" alt="Logo Aplikasi" class="img-fluid rounded-circle" style="width: 100px; height: 100px;">
  </div>

  <!-- Nama Aplikasi -->
  <div class="app-name h4 fw-bold text-center">
    {{ config('app.name') }} App
  </div>

  <!-- Deskripsi -->
  <div class="app-description text-center pb-4">
    <small>
      Satu aplikasi untuk semua fitur tersedia.
    </small>
  </div>

  <!-- Menu Utama -->
  <div class="container text-center mt-4 p-3">
    <div class="row">
      @hook('main-apps')
    </div>
  </div>
  <div class="row mt-4 py-3 fixed-bottom">
    <div class="col-12">
      @hasHook('main-footer')
      <div class="d-inline gap-2">
        @hook('main-footer')
      </div>
      @endHasHook
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  const menu = document.getElementById('dashboard');
  menu.href += `?initData=${encodeURIComponent(window.Telegram.WebApp.initData)}`;
</script>
@endpush