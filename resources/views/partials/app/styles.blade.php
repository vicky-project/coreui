<style>
  body {
    font-size: 14px;
    line-height: 1.5;
    background-color: #f8f9fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  .container {
    padding-left: 15px;
    padding-right: 15px;
  }

  /* Navbar */
  .navbar-custom {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 0.5rem 1rem;
    }
    .navbar-custom .navbar-brand {
    color: white;
    font-weight: 600;
    font-size: 1.2rem;
    }
    .navbar-custom .nav-link {
    color: rgba(255,255,255,0.9);
    font-weight: 500;
    padding: 0.4rem 0.8rem !important;
    border-radius: 25px;
    transition: all 0.2s;
    font-size: 0.9rem;
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
    padding: 0.6rem 1.2rem;
    font-weight: 500;
    }
    .navbar-custom .dropdown-item i {
    margin-right: 8px;
    color: #667eea;
    }
    .navbar-custom .dropdown-item:hover {
    background: #f8f9fa;
    }

    /* Main Content */
    .main-content {
    flex: 1;
    padding: 20px 0;
    }

    /* Card */
    .card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    margin-bottom: 15px;
    }
    .card-header {
    background: white;
    border-bottom: 1px solid #e9ecef;
    font-weight: 600;
    padding: 12px 15px;
    border-radius: 12px 12px 0 0 !important;
    font-size: 1rem;
    }
    .card-body {
    padding: 15px;
    }

    /* App Item (grid ikon aplikasi) */
    .app-item {
    display: block;
    text-align: center;
    padding: 0.8rem 0.25rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 8px 20px -6px rgba(0,0,0,0.1);
    transition: all 0.25s cubic-bezier(0.4,0,0.2,1);
    color: #2d3748;
    text-decoration: none;
    border: 1px solid rgba(0,0,0,0.02);
    }
    .app-item i {
    font-size: 1.8rem;
    display: block;
    margin-bottom: 0.3rem;
    color: #667eea;
    transition: color 0.2s;
    }
    .app-item span {
    font-size: 0.8rem;
    font-weight: 500;
    display: block;
    line-height: 1.2;
    }
    .app-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 30px -10px rgba(102,126,234,0.4);
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    }
    .app-item:hover i {
    color: white;
    }

    /* Footer */
    .footer {
    background: white;
    border-top: 1px solid #e9ecef;
    padding: 15px 0;
    text-align: center;
    color: #6c757d;
    font-size: 0.8rem;
    }

    /* Buttons */
    .btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 40px;
    padding: 0.5rem 1.2rem;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.2s;
    }
    .btn-primary:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46a1 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 15px rgba(102,126,234,0.4);
    }
    .btn-outline-secondary {
    border: 2px solid #e2e8f0;
    border-radius: 40px;
    color: #4a5568;
    padding: 0.5rem 1.2rem;
    font-size: 0.9rem;
    transition: all 0.2s;
    }
    .btn-outline-secondary:hover {
    background: #edf2f7;
    border-color: #cbd5e0;
    }

    /* Form elements */
    .form-control {
    border: 2px solid #e2e8f0;
    border-radius: 40px;
    padding: 0.6rem 1.2rem;
    transition: border-color 0.2s;
    font-size: 0.9rem;
    }
    .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102,126,234,0.1);
    }
    .form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
    }

    /* Toasts */
    .toast {
    border-radius: 12px;
    border: none;
    box-shadow: 0 15px 35px -10px rgba(0,0,0,0.2);
    }
    .toast-header {
    background: transparent;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    /* ===== TABLET (≥576px) ===== */
    @media (min-width: 576px) {
    body {
    font-size: 15px;
    }
    .navbar-custom .navbar-brand {
    font-size: 1.4rem;
    }
    .navbar-custom .nav-link {
    padding: 0.5rem 1rem !important;
    font-size: 1rem;
    }
    .main-content {
    padding: 30px 0;
    }
    .card {
    border-radius: 15px;
    margin-bottom: 20px;
    }
    .card-header {
    padding: 15px 20px;
    font-size: 1.1rem;
    }
    .card-body {
    padding: 20px;
    }
    .app-item {
    padding: 1rem 0.5rem;
    }
    .app-item i {
    font-size: 2rem;
    }
    .app-item span {
    font-size: 0.9rem;
    }
    .footer {
    padding: 20px 0;
    font-size: 0.9rem;
    }
    .btn-primary, .btn-outline-secondary {
    padding: 0.6rem 1.5rem;
    font-size: 1rem;
    }
    }

    /* ===== DESKTOP (≥768px) ===== */
    @media (min-width: 768px) {
    body {
    font-size: 16px;
    }
    .navbar-custom {
    padding: 0.8rem 1rem;
    }
    .navbar-custom .navbar-brand {
    font-size: 1.5rem;
    }
    .main-content {
    padding: 40px 0;
    }
    .card-header {
    padding: 18px 25px;
    font-size: 1.2rem;
    }
    .card-body {
    padding: 25px;
    }
    .app-item {
    padding: 1.2rem 0.5rem;
    }
    .app-item i {
    font-size: 2.2rem;
    }
    .app-item span {
    font-size: 1rem;
    }
    .footer {
    padding: 25px 0;
    }
    }

    /* ===== LARGE DESKTOP (≥992px) ===== */
    @media (min-width: 992px) {
    .container {
    max-width: 960px;
    }
    }

    /* ===== EXTRA LARGE (≥1200px) ===== */
    @media (min-width: 1200px) {
    .container {
    max-width: 1140px;
    }
    }

    /* ===== TELEGRAM MINI APP ADAPTATION ===== */
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
    body.telegram-app .card-header {
    background: var(--tg-theme-secondary-bg-color, #f8f9fa);
    border-bottom-color: var(--tg-theme-hint-color, #e9ecef);
    }
    body.telegram-app .app-item {
    background: var(--tg-theme-bg-color, white);
    color: var(--tg-theme-text-color, #2d3748);
    box-shadow: none;
    border: 1px solid var(--tg-theme-hint-color, #e9ecef);
    }
    body.telegram-app .app-item:hover {
    background: var(--tg-theme-button-color, #40a7e3);
    color: var(--tg-theme-button-text-color, white);
    border-color: transparent;
    }
    body.telegram-app .app-item i {
    color: var(--tg-theme-text-color, #2d3748);
    }
    body.telegram-app .app-item:hover i {
    color: var(--tg-theme-button-text-color, white);
    }
    body.telegram-app .btn-primary {
    background: var(--tg-theme-button-color, #40a7e3);
    color: var(--tg-theme-button-text-color, white);
    }
    body.telegram-app .footer {
    background: var(--tg-theme-secondary-bg-color, #f8f9fa);
    color: var(--tg-theme-hint-color, #6c757d);
    }
    </style>