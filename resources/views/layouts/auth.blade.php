<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="uix-bg">
    <div class="container min-vh-100 d-flex flex-column justify-content-center align-items-center py-4">
        <div class="mb-4 text-center">
            <i class="bi bi-cube fs-1 text-primary"></i>
            <div class="fs-3 fw-bold mt-2">TKDN</div>
        </div>
        <div class="w-100" style="max-width: 400px;">
            <div class="d-flex justify-content-end mb-3">
                <span id="darkModeToggle" class="uix-darkmode-toggle" style="cursor:pointer; font-size: 1.5rem;">
                  <i class="bi bi-moon"></i>
                </span>
            </div>
            <div class="card uix-card p-4 shadow-sm">
                @yield('content')
            </div>
        </div>
    </div>
    <script>
      const toggle = document.getElementById('darkModeToggle');
      const body = document.body;
      function updateDarkIcon() {
        if(body.classList.contains('dark')) {
          toggle.innerHTML = '<i class="bi bi-sun"></i>';
        } else {
          toggle.innerHTML = '<i class="bi bi-moon"></i>';
        }
      }
      if(localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark');
      }
      updateDarkIcon();
      toggle.addEventListener('click', function() {
        body.classList.toggle('dark');
        if(body.classList.contains('dark')) {
          localStorage.setItem('theme', 'dark');
        } else {
          localStorage.setItem('theme', 'light');
        }
        updateDarkIcon();
      });
    </script>
</body>
</html> 