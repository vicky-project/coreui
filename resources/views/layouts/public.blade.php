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
      padding: 20px 0;
      text-align: center;
      color: #6c757d;
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
      <li class="nav-item">
      <a class="nav-link" href="#features">Fitur</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="#about">Tentang</a>
      </li>
      @auth
      <li class="nav-item">
      <a class="nav-link" href="{{ route('apps.index') }}">
      <i class="bi bi-speedometer2"></i> Dashboard
      </a>
      </li>
      @else
      <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">Login</a>
      </li>
      <li class="nav-item">
      <a class="btn btn-outline-primary ms-2" href="{{ route('register') }}">Daftar</a>
      </li>
      @endauth
      </ul>
      </div>
      </div>
      </nav>

      <!-- Main Content -->
      <div class="main-content">
      @yield('content')
      </div>

      <!-- Footer -->
      <footer class="footer">
      <div class="container">
      <span>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</span>
      </div>
      </footer>

      <!-- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      @stack('scripts')
      </body>
      </html>