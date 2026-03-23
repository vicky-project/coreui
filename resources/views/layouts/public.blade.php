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

  @stack('styles')

  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .navbar-custom {
      background: rgba(255,255,255,0.95);
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      padding: 1rem 0;
    }
    .navbar-custom .navbar-brand {
      font-weight: 700;
      font-size: 1.5rem;
      color: #667eea;
    }
    .navbar-custom .nav-link {
      color: #333;
      font-weight: 500;
      padding: 0.5rem 1.2rem !important;
      border-radius: 25px;
      transition: all 0.2s;
    }
    .navbar-custom .nav-link:hover {
      background: #667eea;
      color: white;
    }
    .navbar-custom .btn-outline-primary {
      border-radius: 25px;
      padding: 0.5rem 1.5rem;
    }
    .main-content {
      flex: 1;
      padding: 50px 0;
    }
    .footer {
      background: white;
      border-top: 1px solid #e9ecef;
      padding: 40px 0 20px;
      margin-top: 60px;
    }
    .hero {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 80px 0;
      border-radius: 0 0 50px 50px;
      }
      .hero h1 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 20px;
      }
      .hero p {
      font-size: 1.2rem;
      opacity: 0.9;
      }
      .feature-card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.05);
      transition: transform 0.3s;
      height: 100%;
      }
      .feature-card:hover {
      transform: translateY(-5px);
      }
      .feature-icon {
      font-size: 2.5rem;
      color: #667eea;
      }
      .module-card {
      border-radius: 20px;
      background: white;
      transition: all 0.3s;
      height: 100%;
      text-align: center;
      padding: 1.5rem;
      }
      .module-card:hover {
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      transform: translateY(-8px);
      }
      .module-icon {
      font-size: 3rem;
      color: #667eea;
      margin-bottom: 1rem;
      }
      .btn-telegram {
      background-color: #26A5E4;
      border-color: #26A5E4;
      color: white;
      border-radius: 30px;
      padding: 10px 25px;
      font-weight: 600;
      }
      .btn-telegram:hover {
      background-color: #1e8fc6;
      border-color: #1e8fc6;
      color: white;
      }
      .social-icons a {
      font-size: 1.5rem;
      margin: 0 10px;
      color: #6c757d;
      transition: color 0.2s;
      }
      .social-icons a:hover {
      color: #667eea;
      }
      .footer-links a {
      text-decoration: none;
      color: #6c757d;
      }
      .footer-links a:hover {
      color: #667eea;
      }
      @media (max-width: 768px) {
      .hero h1 { font-size: 2rem; }
      .hero p { font-size: 1rem; }
      }
      </style>
      </head>
      <body>
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
      <i class="bi bi-grid"></i> {{ config('app.name') }}
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPublic">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarPublic">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
      <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
      <li class="nav-item"><a class="nav-link" href="#modules">Modul</a></li>
      <li class="nav-item"><a class="nav-link" href="#telegram">Telegram</a></li>
      @auth
      <li class="nav-item"><a class="nav-link" href="{{ route('apps.index') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
      @else
      <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
      <li class="nav-item"><a class="btn btn-outline-primary ms-2" href="{{ route('register') }}">Daftar</a></li>
      @endauth
      </ul>
      </div>
      </div>
      </nav>

      <!-- Main Content -->
      <div class="main-content">
      @yield('content')
      </div>

      <!-- Footer Baru -->
      <footer class="footer">
      <div class="container">
      <div class="row">
      <div class="col-md-4 mb-4">
      <h5 class="fw-bold">{{ config('app.name') }}</h5>
      <p class="text-muted">Solusi modular untuk kebutuhan personal hingga umum. Akses mudah via web dan Telegram Mini App.</p>
      <div class="social-icons mt-3">
      <a href="https://github.com/vicky-project" target="_blank"><i class="bi bi-github"></i></a>
      <a href="https://twitter.com/yourhandle" target="_blank"><i class="bi bi-twitter-x"></i></a>
      <a href="https://linkedin.com/in/yourprofile" target="_blank"><i class="bi bi-linkedin"></i></a>
      <a href="https://t.me/vickyserver_bot" target="_blank"><i class="bi bi-telegram"></i></a>
      </div>
      </div>
      <div class="col-md-4 mb-4">
      <h5 class="fw-bold">Tautan Cepat</h5>
      <ul class="list-unstyled footer-links">
      <li><a href="#features">Fitur Unggulan</a></li>
      <li><a href="#modules">Modul Aplikasi</a></li>
      <li><a href="#telegram">Telegram Mini App</a></li>
      <li><a href="{{ route('login') }}">Login</a></li>
      </ul>
      </div>
      <div class="col-md-4 mb-4">
      <h5 class="fw-bold">Bantuan & Kontak</h5>
      <ul class="list-unstyled footer-links">
      <li><i class="bi bi-envelope"></i> <a href="mailto:pratamavr@gmail.com">pratamavr@gmail.com</a></li>
      <li><i class="bi bi-telegram"></i> <a href="https://t.me/Mekanik_harian" target="_blank">@Mekanik_harian</a></li>
      <li><i class="bi bi-question-circle"></i> <a href="/faq">Pusat Bantuan</a></li>
      </ul>
      </div>
      </div>
      <hr class="my-3">
      <div class="text-center">
      <span>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</span>
      </div>
      </div>
      </footer>

      <!-- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      @stack('scripts')
      </body>
      </html>