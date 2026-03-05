<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name') }} - @yield('title')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

  @stack('styles')
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="/">{{ config('app.name') }}</a>

        <div class="collapse navbar-collapse">
          <ul class="navbar-nav me-auto">
            @stack('nav_links')
          </ul>

          <div class="navbar-nav">
            @stack('nav_auth')
          </div>
        </div>
      </div>
    </nav>

    <main class="py-4">
      <div class="container">
        @yield('content')
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>