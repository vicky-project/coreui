@extends('coreui::layouts.public')
@section('title', 'Selamat Datang di VickyServer')
@section('content')
<!-- Hero Section -->
<div class="hero text-center mb-5">
  <div class="container">
    <h1>Solusi Modular untuk Kebutuhan Anda</h1>
    <p class="lead mb-4">
      Dari kebutuhan personal hingga umum, VickyServer hadir dengan modul-modul siap pakai. Nikmati pengalaman seamless di web maupun Telegram.
    </p>
    @guest
    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 me-2">Mulai Sekarang</a>
    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5">Masuk</a>
    @else
    <a href="{{ route('apps.index') }}" class="btn btn-light btn-lg px-5">Dashboard</a>
    @endguest
  </div>
</div>

<!-- Preview Gambar (menggunakan screenshot yang dilampirkan) -->
<div class="container mb-5 text-center">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm border-0">
        <div class="card-body p-0">
          <img src="{{ asset('images/preview-app.webp') }}" alt="VickyServer App Preview" class="img-fluid rounded-4" style="max-width: 100%;">
          <div class="p-3 bg-light rounded-bottom">
            <i class="bi bi-telegram me-2"></i> Tampilan Mini App Telegram — akses fitur tanpa login
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modul Unggulan -->
<div class="container" id="modules">
  <h2 class="text-center mb-5">Modul Siap Pakai</h2>
  <div class="row g-4">
    <div class="col-sm-6 col-lg-3">
      <div class="module-card">
        <i class="bi bi-check2-square module-icon"></i>
        <h5>Object Task</h5>
        <p class="text-muted">
          Kelola tugas & objektif dengan mudah, tracking progress, dan kolaborasi tim.
        </p>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3">
      <div class="module-card">
        <i class="bi bi-moon-stars module-icon"></i>
        <h5>Prayer</h5>
        <p class="text-muted">
          Jadwal sholat, arah kiblat, dan pengingat ibadah harian.
        </p>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3">
      <div class="module-card">
        <i class="bi bi-app-indicator module-icon"></i>
        <h5>Application</h5>
        <p class="text-muted">
          Kumpulan utilitas ringan: kalkulator, konverter, dan tools lainnya.
        </p>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3">
      <div class="module-card">
        <i class="bi bi-cloud-sun module-icon"></i>
        <h5>Weather</h5>
        <p class="text-muted">
          Informasi cuaca real-time, ramalan 7 hari, dan notifikasi cuaca ekstrem.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Fitur Arsitektur -->
<div class="container mt-5" id="features">
  <h2 class="text-center mb-5">Keunggulan Sistem</h2>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card feature-card p-4">
        <div class="text-center mb-3">
          <i class="bi bi-box feature-icon"></i>
        </div>
        <h5 class="card-title text-center">Modular & Scalable</h5>
        <p class="card-text text-muted text-center">
          Aktifkan/nonaktifkan modul sesuai kebutuhan. Mudah dikembangkan secara independen.
        </p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card feature-card p-4">
        <div class="text-center mb-3">
          <i class="bi bi-shield-lock feature-icon"></i>
        </div>
        <h5 class="card-title text-center">Keamanan Terpadu</h5>
        <p class="card-text text-muted text-center">
          Role & permission terintegrasi di semua modul, aman untuk data sensitif.
        </p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card feature-card p-4">
        <div class="text-center mb-3">
          <i class="bi bi-telegram feature-icon"></i>
        </div>
        <h5 class="card-title text-center">Telegram Mini App</h5>
        <p class="card-text text-muted text-center">
          Akses fitur tanpa login melalui bot Telegram. Pengalaman langsung dari aplikasi pesan favorit.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Dua Mode Akses -->
<div class="container mt-5" id="telegram">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h3>Dua Cara Akses, Satu Akun</h3>
      <ul class="list-unstyled mt-3">
        <li class="mb-3"><i class="bi bi-globe2 text-primary fs-4 me-2"></i> <strong>Web (Browser)</strong> — Login untuk mengakses semua fitur penuh, manajemen data, dan integrasi.</li>
        <li class="mb-3"><i class="bi bi-telegram text-primary fs-4 me-2"></i> <strong>Telegram Mini App</strong> — Buka langsung dari bot <a href="https://t.me/vickyserver_bot" target="_blank">@vickyserver_bot</a>. Nikmati modul <strong>Prayer, Weather, dan Object Task</strong> tanpa login!</li>
      </ul>
      <a href="https://t.me/vickyserver_bot" class="btn btn-telegram mt-2" target="_blank">
        <i class="bi bi-telegram me-2"></i> Buka di Telegram
      </a>
    </div>
    <div class="col-md-6 text-center">
      <i class="bi bi-phone-fill" style="font-size: 7rem; color: #667eea;"></i>
      <i class="bi bi-laptop" style="font-size: 7rem; color: #764ba2; margin-left: -20px;"></i>
    </div>
  </div>
</div>

<!-- Tentang Aplikasi -->
<div class="container mt-5" id="about">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h3>Tentang VickyServer</h3>
      <p class="text-muted">
        Awalnya dibangun untuk kebutuhan personal, VickyServer kini berkembang menjadi platform modular yang melayani kebutuhan umum dengan pendekatan sederhana namun powerful. Setiap modul (Object Task, Prayer, Application, Weather) dapat digunakan secara independen, baik melalui web (dengan autentikasi penuh) maupun Telegram Mini App (akses cepat tanpa login).
      </p>
      <p class="text-muted">
        Arsitektur berbasis Laravel Modules memungkinkan pengembangan dan pemeliharaan jangka panjang. Dukungan penuh untuk Telegram Mini App memberikan fleksibilitas bagi pengguna yang ingin mengakses fitur-fitur utama tanpa harus membuka browser.
      </p>
    </div>
    <div class="col-md-6 text-center">
      <i class="bi bi-layers" style="font-size: 8rem; color: #667eea;"></i>
    </div>
  </div>
</div>
@endsection