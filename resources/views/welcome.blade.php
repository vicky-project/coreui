@extends('coreui::layouts.public')
@section('title', 'Selamat Datang')
@section('content')
<!-- Hero Section -->
<div class="hero text-center mb-5">
  <div class="container">
    <h1>Solusi Modular untuk Aplikasi Modern</h1>
    <p class="lead mb-4">
      Bangun aplikasi Anda dengan modul-modul independen yang siap pakai. Integrasi mudah, fleksibel, dan powerful.
    </p>
    @guest
    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 me-2">Mulai Sekarang</a>
    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5">Masuk</a>
    @else
    <a href="{{ route('apps.index') }}" class="btn btn-light btn-lg px-5">Dashboard</a>
    @endguest
  </div>
</div>

<!-- Features Section -->
<div class="container" id="features">
  <h2 class="text-center mb-5">Fitur Unggulan</h2>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card feature-card p-4">
        <div class="text-center mb-3">
          <i class="bi bi-box feature-icon"></i>
        </div>
        <h5 class="card-title text-center">Modular</h5>
        <p class="card-text text-muted text-center">
          Setiap fitur adalah modul independen. Aktifkan/nonaktifkan sesuai kebutuhan.
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
          Manajemen role & permission terintegrasi di seluruh modul.
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
          Akses aplikasi langsung dari Telegram dengan pengalaman seamless.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Tentang Section -->
<div class="container mt-5" id="about">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h3>Tentang Aplikasi</h3>
      <p class="text-muted">
        Aplikasi ini dibangun dengan arsitektur modular menggunakan Laravel dan package nwidart/laravel-modules. Setiap modul dapat dikembangkan dan diintegrasikan secara independen, memudahkan pengembangan skala besar dan pemeliharaan jangka panjang.
      </p>
      <p class="text-muted">
        Dengan dukungan untuk Telegram Mini App, Anda dapat menjangkau pengguna di platform favorit mereka tanpa mengorbankan fungsionalitas.
      </p>
    </div>
    <div class="col-md-6 text-center">
      <i class="bi bi-layers" style="font-size: 8rem; color: #667eea;"></i>
    </div>
  </div>
</div>
@endsection