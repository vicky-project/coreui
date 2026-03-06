<style>
  body {
    background-color: #f4f6f9;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  .wrapper {
    display: flex;
    min-height: 100vh;
    position: relative;
  }

  /* ===== MOBILE FIRST (default untuk layar kecil) ===== */
  .sidebar {
    position: fixed;
    top: 0;
    left: -260px;
    /* tersembunyi di luar layar */
    width: 260px;
    height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    transition: left 0.3s ease;
    z-index: 1000;
    overflow-y: auto;
    }
    .sidebar.active {
    left: 0; /* muncul saat tombol toggle diklik */
    }

    .sidebar .sidebar-header {
    padding: 20px 15px;
    text-align: center;
    border-bottom: 1px solid rgba(255,255,255,0.2);
    }
    .sidebar .sidebar-header h3 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    }
    .sidebar .nav-link {
    color: rgba(255,255,255,0.85);
    padding: 12px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: 0.2s;
    border-left: 3px solid transparent;
    white-space: nowrap;
    }
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
    background: rgba(255,255,255,0.2);
    color: white;
    border-left-color: white;
    }
    .sidebar .nav-link i {
    min-width: 30px;
    font-size: 1.2rem;
    text-align: center;
    }
    .sidebar .nav-header {
    color: rgba(255,255,255,0.5);
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 15px 20px 5px;
    }
    .sidebar-divider {
    border-top: 1px solid rgba(255,255,255,0.2);
    margin: 10px 0;
    }

    /* Konten utama di mobile mengambil seluruh lebar */
    .content {
    flex: 1;
    margin-left: 0;
    transition: margin-left 0.3s ease;
    padding: 20px;
    width: 100%;
    }

    .navbar-top {
    background: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    padding: 10px 20px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 8px;
    }
    .toggle-sidebar {
    cursor: pointer;
    font-size: 1.8rem;
    color: #667eea;
    line-height: 1;
    }

    /* ===== LAYAR SEDANG DAN BESAR (≥768px) ===== */
    @media (min-width: 768px) {
    .sidebar {
    left: 0; /* sidebar selalu terlihat */
    width: 260px;
    position: fixed;
    }
    .sidebar.collapsed {
    width: 70px;
    }
    .sidebar.collapsed .sidebar-header h3,
    .sidebar.collapsed .nav-link span {
    display: none;
    }
    .content {
    margin-left: 260px;
    }
    .content.expanded {
    margin-left: 70px; /* saat sidebar collapsed */
    }
    /* Di desktop, kelas active tidak digunakan untuk menampilkan/menyembunyikan */
    .sidebar.active {
    left: 0; /* tidak berpengaruh, tetapi biarkan saja */
    }
    }

    /* ===== OVERLAY UNTUK MOBILE (opsional) ===== */
    .sidebar-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 999;
    }
    .sidebar-overlay.active {
    display: block;
    }

    /* ===== TELEGRAM ADAPTATION ===== */
    body.telegram-app {
    background: var(--tg-theme-bg-color, #f4f6f9);
    }
    body.telegram-app .sidebar {
    background: var(--tg-theme-secondary-bg-color, #667eea);
    }
    body.telegram-app .sidebar .nav-link {
    color: var(--tg-theme-text-color, white);
    }
    body.telegram-app .navbar-top {
    background: var(--tg-theme-bg-color, #ffffff);
    color: var(--tg-theme-text-color, #000000);
    }
    body.telegram-app .card {
    background: var(--tg-theme-bg-color, #ffffff);
    color: var(--tg-theme-text-color, #000000);
    }

    /* ===== STYLE LAINNYA ===== */
    .card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    }
    .card-header {
    background: white;
    border-bottom: 1px solid #e9ecef;
    font-weight: 600;
    padding: 15px 20px;
    border-radius: 10px 10px 0 0 !important;
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
    .btn-outline-secondary {
    border-radius: 25px;
    }
    </style>