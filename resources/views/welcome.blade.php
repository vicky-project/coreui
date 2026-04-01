@extends('coreui::layouts.public')
@section('title', 'Selamat Datang di VickyServer')

@section('content')
<!-- Hero Section -->
<div class="hero text-center mb-5">
  <div class="container">
    <h1>Layanan Praktis untuk Keseharian Anda</h1>
    <p class="lead mb-4">
      Dari kebutuhan ibadah hingga informasi terkini, VickyServer hadir dengan fitur siap pakai. Nikmati pengalaman seamless di web maupun Telegram Mini App.
    </p>
    @guest
    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 me-2">Mulai Sekarang</a>
    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5">Masuk</a>
    @else
    <a href="{{ route('apps.index') }}" class="btn btn-light btn-lg px-5">Dashboard</a>
    @endguest
  </div>
</div>

<!-- Preview Telegram Mini App -->
<div class="container mb-5 text-center">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm border-0">
        <div class="card-body p-0">
          <img src="{{ asset('images/preview-app.webp') }}" alt="VickyServer Mini App Preview" class="img-fluid rounded-4" style="max-width: 100%;">
          <div class="p-3 bg-light rounded-bottom">
            <i class="bi bi-telegram me-2"></i> Buka Mini App Telegram — akses fitur tanpa login
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Grid Fitur -->
<div class="container" id="features">
  <h2 class="text-center mb-5">Fitur yang Tersedia</h2>
  <div class="row g-4">
    <!-- Prayer -->
    <div class="col-sm-6 col-md-4 col-lg-3">
      <a href="{{ route('apps.prayer') }}" class="text-decoration-none">
        <div class="module-card text-center p-4 h-100">
          <i class="bi bi-moon-stars module-icon"></i>
          <h5 class="mt-3">Prayer</h5>
          <p class="text-muted small">
            Jadwal sholat, arah kiblat, dan pengingat ibadah harian.
          </p>
        </div>
      </a>
    </div>
    <!-- Weather -->
    <div class="col-sm-6 col-md-4 col-lg-3">
      <a href="{{ route('apps.weather') }}" class="text-decoration-none">
        <div class="module-card text-center p-4 h-100">
          <i class="bi bi-cloud-sun module-icon"></i>
          <h5 class="mt-3">Weather</h5>
          <p class="text-muted small">
            Cuaca real-time, ramalan 7 hari, dan peringatan cuaca ekstrem.
          </p>
        </div>
      </a>
    </div>
    <!-- Hadith -->
    <div class="col-sm-6 col-md-4 col-lg-3">
      <a href="{{ route('apps.hadith.index') }}" class="text-decoration-none">
        <div class="module-card text-center p-4 h-100">
          <i class="bi bi-chat-quote module-icon"></i>
          <h5 class="mt-3">Hadith</h5>
          <p class="text-muted small">
            Kumpulan hadits shahih dengan pencarian dan kategori.
          </p>
        </div>
      </a>
    </div>
    <!-- Quran -->
    <div class="col-sm-6 col-md-4 col-lg-3">
      <a href="{{ route('apps.quran.index') }}" class="text-decoration-none">
        <div class="module-card text-center p-4 h-100">
          <i class="bi bi-book module-icon"></i>
          <h5 class="mt-3">Quran</h5>
          <p class="text-muted small">
            Baca Al-Qur'an dengan terjemahan, tafsir, dan audio murottal.
          </p>
        </div>
      </a>
    </div>
    <!-- SwiftBank -->
    <div class="col-sm-6 col-md-4 col-lg-3">
      <a href="{{ route('apps.swift') }}" class="text-decoration-none">
        <div class="module-card text-center p-4 h-100">
          <i class="bi bi-bank2 module-icon"></i>
          <h5 class="mt-3">SwiftBank</h5>
          <p class="text-muted small">
            Informasi kode bank dan transfer antar bank dengan mudah.
          </p>
        </div>
      </a>
    </div>
    <!-- Gold -->
    <div class="col-sm-6 col-md-4 col-lg-3">
      <a href="{{ route('apps.gold') }}" class="text-decoration-none">
        <div class="module-card text-center p-4 h-100">
          <i class="bi bi-gem module-icon"></i>
          <h5 class="mt-3">Gold</h5>
          <p class="text-muted small">
            Harga emas terkini, grafik, dan analisis pergerakan.
          </p>
        </div>
      </a>
    </div>
  </div>
</div>

<!-- Dua Cara Akses -->
<div class="container mt-5" id="telegram">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h3>Akses Melalui Web atau Telegram Mini App</h3>
      <ul class="list-unstyled mt-3">
        <li class="mb-3"><i class="bi bi-globe2 text-primary fs-4 me-2"></i> <strong>Website</strong> — Login untuk mengelola semua fitur dan pengaturan.</li>
        <li class="mb-3"><i class="bi bi-telegram text-primary fs-4 me-2"></i> <strong>Telegram Mini App</strong> — Cukup buka bot <a href="https://t.me/vickyserver_bot" target="_blank">@vickyserver_bot</a>. Nikmati semua fitur tanpa perlu login.</li>
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
      <h3>Mengapa VickyServer?</h3>
      <p class="text-muted">
        VickyServer dirancang untuk membantu Anda menjalani hari dengan lebih mudah. Mulai dari kebutuhan spiritual (jadwal sholat, Al-Qur'an, hadits), informasi cuaca, hingga keperluan finansial (SwiftBank dan harga emas), semuanya tersedia dalam satu platform.
        </p>
        <p class="text-muted">
        Semua fitur dapat diakses secara gratis melalui website maupun Telegram Mini App, sehingga Anda bebas memilih cara yang paling nyaman. Tidak perlu registrasi untuk menggunakan versi Telegram – cukup buka bot dan nikmati layanannya.
        </p>
        </div>
        <div class="col-md-6 text-center">
        <i class="bi bi-layers" style="font-size: 8rem; color: #667eea;"></i>
        </div>
        </div>
        </div>
        @endsection

        @push('styles')
        <style>
        .hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 5rem 0;
        border-radius: 0 0 2rem 2rem;
        }
        .hero h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        }
        .module-card {
        background: white;
        border-radius: 1rem;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
        }
        .module-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        border-color: #667eea;
        }
        .module-icon {
        font-size: 2.5rem;
        color: #667eea;
        }
        .btn-telegram {
        background-color: #0088cc;
        color: white;
        border-radius: 2rem;
        padding: 0.5rem 1.5rem;
        }
        .btn-telegram:hover {
        background-color: #006699;
        color: white;
        }
        @media (max-width: 768px) {
        .hero h1 { font-size: 1.8rem; }
        .module-card { padding: 1rem; }
        }
        </style>
        @endpush