<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Bootstrap 5 from SHCDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="tkdn-bg">
    <div id="sidebarOverlay" class="sidebar-overlay"></div>
    <div id="app" class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar tkdn-sidebar flex-shrink-0 p-3" style="z-index: 1051;">
            <button class="btn btn-link sidebar-close-btn position-absolute top-0 end-0 mt-2 me-2 d-lg-none" id="sidebarClose" aria-label="Close sidebar" style="z-index: 1052;">
                <i class="bi bi-x-lg" style="font-size: 1.5rem;"></i>
            </button>
            <div class="sidebar-logo mb-4 d-flex align-items-center">
                <svg width="160" height="48" viewBox="0 0 160 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Icon Cube -->
                    <rect x="8" y="8" width="32" height="32" rx="8" fill="#2563eb"/>
                    <rect x="16" y="16" width="16" height="16" rx="4" fill="#fff"/>
                    <rect x="20" y="20" width="8" height="8" rx="2" fill="#2563eb"/>
                    <!-- TKDN Text -->
                    <text x="56" y="34" fill="#2563eb" font-size="32" font-family="Nunito, Arial, sans-serif" font-weight="bold" letter-spacing="2">TKDN</text>
                </svg>
            </div>
            <ul class="nav nav-pills flex-column mb-auto sidebar-menu">
                <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-cloud me-2"></i>Project</a></li>
                <li class="nav-item">
                    @php
                        $satuanActive = request()->is('satuan*');
                    @endphp
                    <a href="#" class="nav-link d-flex justify-content-between align-items-center @if($satuanActive) active @endif" data-bs-toggle="collapse" data-bs-target="#submenuSatuan" aria-expanded="{{ $satuanActive ? 'true' : 'false' }}" aria-controls="submenuSatuan">
                        <span><i class="bi bi-cpu me-2"></i>Master</span>
                        <i class="bi bi-chevron-down small"></i>
                    </a>
                    <div class="collapse ps-4 @if($satuanActive) show @endif" id="submenuSatuan">
                        <ul class="nav flex-column">
                                <li class="nav-item">
                                <a href="{{ url('satuan') }}" class="nav-link @if(request()->is('satuan')) active @endif">
                                    <i class="bi bi-people me-2"></i>Pekerja
                                </a>
                                </li>
                                <li class="nav-item">
                                <a href="{{ url('satuan/create') }}" class="nav-link @if(request()->is('satuan/create')) active @endif">
                                    <i class="bi bi-box-seam me-2"></i>Material
                                </a>
                            </li>
                        </ul>
                    </div>
                                </li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-credit-card me-2"></i>Harga</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-people me-2"></i>Pekerja</a></li>
                <li class="nav-item"><a href="{{ route('settings.edit') }}" class="nav-link"><i class="bi bi-gear me-2"></i>Settings</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-question-circle me-2"></i>Support</a></li>
            </ul>
        </nav>
        <!-- Main Content -->
        <div class="flex-grow-1 main-content tkdn-content" id="mainContent">
            <!-- Header -->
            <header class="tkdn-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <button class="btn btn-link tkdn-sidebar-toggle d-lg-none me-2" id="sidebarToggle" aria-label="Toggle sidebar">
                        <i class="bi bi-list" style="font-size: 2rem;"></i>
                    </button>
                    <i class="bi bi-cube fs-3 text-primary me-2"></i>
                    <span class="fs-4 fw-bold">TKDN</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span id="darkModeToggle" class="tkdn-darkmode-toggle me-2" style="cursor:pointer; font-size: 1.5rem;">
                        <i class="bi bi-moon"></i>
                    </span>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center user-dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="rounded-circle me-2" width="40" height="40">
                            <div class="d-none d-md-block text-start">
                                <div class="fw-bold">{{ Auth::user()->name }}</div>
                                <div class="small text-muted">{{ Auth::user()->email }}</div>
                            </div>
                        </a>
                        <ul class="dropdown-menu user-dropdown-menu dropdown-menu-end p-2" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('settings.edit') }}">
                                    <i class="bi bi-gear"></i> Settings
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                    </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </li>
                    </ul>
                    </div>
                </div>
            </header>
            <main class="p-4">
            @yield('content')
        </main>
        </div>
    </div>
    <script>
      // Sidebar mobile toggle (optional, jika ingin collapse di mobile)
      const sidebar = document.getElementById('sidebar');
      const sidebarToggle = document.getElementById('sidebarToggle');
      const sidebarOverlay = document.getElementById('sidebarOverlay');
      function openSidebar() {
        sidebar.classList.add('sidebar-open');
        sidebarOverlay.classList.add('show');
      }
      function closeSidebar() {
        sidebar.classList.remove('sidebar-open');
        sidebarOverlay.classList.remove('show');
      }
      sidebarToggle && sidebarToggle.addEventListener('click', openSidebar);
      sidebarOverlay && sidebarOverlay.addEventListener('click', closeSidebar);
      window.addEventListener('resize', function() {
        if(window.innerWidth >= 992) closeSidebar();
      });

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

      const sidebarClose = document.getElementById('sidebarClose');
      if (sidebarClose) {
        sidebarClose.addEventListener('click', closeSidebar);
      }
    </script>
</body>
</html>
