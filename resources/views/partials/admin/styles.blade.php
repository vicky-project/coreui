<style>
  body {
    background-color: #f4f6f9;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  .wrapper {
    display: flex;
    min-height: 100vh;
  }
  .sidebar {
    width: 260px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    transition: all 0.3s ease;
    position: fixed;
    height: 100vh;
    overflow-y: auto;
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    z-index: 1000;
    }
    .sidebar.collapsed {
    width: 70px;
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
    white-space: nowrap;
    }
    .sidebar.collapsed .sidebar-header h3 {
    display: none;
    }
    .sidebar .nav {
    padding: 15px 0;
    }
    .sidebar .nav-item {
    width: 100%;
    }
    .sidebar .nav-link {
    color: rgba(255,255,255,0.85);
    padding: 12px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.2s;
    border-left: 3px solid transparent;
    white-space: nowrap;
    }
    .sidebar .nav-link:hover {
    background: rgba(255,255,255,0.1);
    color: white;
    border-left-color: white;
    }
    .sidebar .nav-link.active {
    background: rgba(255,255,255,0.2);
    color: white;
    border-left-color: white;
    }
    .sidebar .nav-link i {
    font-size: 1.3rem;
    min-width: 30px;
    text-align: center;
    }
    .sidebar.collapsed .nav-link span {
    display: none;
    }
    .sidebar .dropdown-menu {
    background: #5a67d8;
    border: none;
    border-radius: 0;
    margin-left: 50px;
    }
    .sidebar .dropdown-item {
    color: white;
    padding: 8px 20px;
    }
    .sidebar .dropdown-item:hover {
    background: rgba(255,255,255,0.2);
    }
    .content {
    flex: 1;
    margin-left: 260px;
    transition: margin-left 0.3s ease;
    padding: 20px;
    }
    .content.expanded {
    margin-left: 70px;
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

    /* Responsive */
    @media (max-width: 768px) {
    .sidebar {
    margin-left: -260px;
    }
    .sidebar.active {
    margin-left: 0;
    }
    .content {
    margin-left: 0;
    }
    .content.expanded {
    margin-left: 0;
    }
    }

    /* Telegram Mini App adaptation */
    body.telegram-app {
    background: var(--tg-theme-bg-color, #f4f6f9);
    }
    body.telegram-app .sidebar {
    background: var(--tg-theme-secondary-bg-color, #667eea);
    color: var(--tg-theme-text-color, #ffffff);
    }
    body.telegram-app .navbar-top {
    background: var(--tg-theme-bg-color, #ffffff);
    color: var(--tg-theme-text-color, #000000);
    }
    body.telegram-app .card {
    background: var(--tg-theme-bg-color, #ffffff);
    color: var(--tg-theme-text-color, #000000);
    }
    </style>