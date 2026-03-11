<style>
  body {
    background-color: #f8f9fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }
  .navbar-custom {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 0.8rem 1rem;
    }
    .navbar-custom .navbar-brand {
    color: white;
    font-weight: 600;
    font-size: 1.5rem;
    }
    .navbar-custom .nav-link {
    color: rgba(255,255,255,0.9);
    font-weight: 500;
    padding: 0.5rem 1rem !important;
    border-radius: 25px;
    transition: all 0.2s;
    }
    .navbar-custom .nav-link:hover {
    background: rgba(255,255,255,0.2);
    color: white;
    }
    .navbar-custom .dropdown-menu {
    border: none;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .navbar-custom .dropdown-item {
    padding: 0.7rem 1.5rem;
    font-weight: 500;
    }
    .navbar-custom .dropdown-item i {
    margin-right: 10px;
    color: #667eea;
    }
    .navbar-custom .dropdown-item:hover {
    background: #f8f9fa;
    }
    .main-content {
    flex: 1;
    padding: 30px 0;
    }
    .footer {
    background: white;
    border-top: 1px solid #e9ecef;
    padding: 20px 0;
    text-align: center;
    color: #6c757d;
    }
    .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    }
    .card-header {
    background: white;
    border-bottom: 1px solid #e9ecef;
    font-weight: 600;
    padding: 15px 20px;
    border-radius: 15px 15px 0 0 !important;
    }
    .btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 25px;
    padding: 0.5rem 1.5rem;
    transition: all 0.2s;
    }
    .btn-primary:hover {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    /* Telegram Mini App adaptation */
    body.telegram-app {
    background: var(--tg-theme-bg-color, #f8f9fa);
    color: var(--tg-theme-text-color, #212529);
    }
    body.telegram-app .navbar-custom {
    background: var(--tg-theme-secondary-bg-color, #667eea);
    }
    body.telegram-app .navbar-custom .navbar-brand,
    body.telegram-app .navbar-custom .nav-link {
    color: var(--tg-theme-text-color, white);
    }
    body.telegram-app .card {
    background: var(--tg-theme-bg-color, white);
    color: var(--tg-theme-text-color, #212529);
    box-shadow: none;
    border: 1px solid var(--tg-theme-hint-color, #e9ecef);
    }
    body.telegram-app .btn-primary {
    background: var(--tg-theme-button-color, #40a7e3);
    color: var(--tg-theme-button-text-color, white);
    }

    /* Tampilan web biasa (bukan Telegram) */
    body:not(.telegram-app) {
    background: linear-gradient(145deg, #e6e9f0 0%, #d1d9e6 100%);
    /* Warna gradien lembut, tidak terlalu mencolok */
    }

    body:not(.telegram-app) .card {
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
    }

    body:not(.telegram-app) .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.15);
    }

    body:not(.telegram-app) .navbar-custom {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    /* Tetap gradien asli */
    }

    body:not(.telegram-app) .footer {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    color: #4a5568;
    }

    /* Jika backdrop-filter tidak didukung, fallback */
    @supports not (backdrop-filter: blur(10px)) {
    body:not(.telegram-app) .footer {
    background: #f8fafc;
    }
    }

    /* Aksen pada tombol */
    body:not(.telegram-app) .btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    }

    body:not(.telegram-app) .btn-primary:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46a1 100%);
    box-shadow: 0 10px 15px -3px rgba(102, 126, 234, 0.4);
    }

    /* Header card dengan garis aksen */
    body:not(.telegram-app) .card-header {
    background: #f9fafc;
    border-bottom: 2px solid #667eea;
    }
    </style>