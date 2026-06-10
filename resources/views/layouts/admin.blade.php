<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AutoRent Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7fe; color: #1f2937; }
        .sidebar { background: #ffffff; min-height: 100vh; width: 260px; position: fixed; top: 0; left: 0; z-index: 100; transition: all 0.3s; }
        .sidebar-brand { padding: 1.5rem 1.5rem 1rem 1.5rem; }
        .brand-text { font-size: 1.25rem; font-weight: 800; color: #4318FF; letter-spacing: -0.5px; margin-bottom: 0; display: block;}
        .brand-subtitle { font-size: 0.75rem; color: #a3aed1; font-weight: 500; }
        
        .sidebar-menu { padding: 0.5rem 1rem; }
        .menu-link { display: flex; align-items: center; gap: 12px; padding: 0.85rem 1.25rem; color: #a3aed1; text-decoration: none; border-radius: 12px; font-weight: 600; font-size: 0.95rem; margin-bottom: 0.25rem; transition: all 0.2s; }
        .menu-link:hover { color: #4318FF; background: #f4f7fe; }
        .menu-link.active { background: #4318FF; color: #ffffff; box-shadow: 0 4px 10px rgba(67, 24, 255, 0.2); }
        .menu-link i { font-size: 1.1rem; }
        
        .main-wrapper { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; transition: all 0.3s; }
        .admin-navbar { background: transparent; padding: 1.5rem 2rem; position: sticky; top: 0; z-index: 90; }
        
        .search-container { background: #ffffff; border-radius: 50px; padding: 0.5rem 1.2rem; width: 350px; display: flex; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
        .search-container input { border: none; background: transparent; width: 100%; outline: none; font-size: 0.9rem; color: #1f2937; padding-left: 10px; }
        .search-container input::placeholder { color: #a3aed1; }
        
        .profile-container { background: #ffffff; border-radius: 50px; padding: 0.4rem 1rem; display: flex; align-items: center; gap: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); cursor: pointer; text-decoration: none; color: inherit; }
        
        .btn-primary-custom { background-color: #4318FF; border-color: #4318FF; border-radius: 8px; padding: 0.5rem 1.25rem; font-weight: 600; font-size: 0.85rem; color: white; transition: all 0.2s; }
        .btn-primary-custom:hover { background-color: #3311db; border-color: #3311db; color: white;}
        .btn-outline-custom { color: #1f2937; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 0.5rem 1.25rem; font-weight: 600; font-size: 0.85rem; transition: all 0.2s; }
        .btn-outline-custom:hover { background-color: #f9fafb; color: #1f2937; }
        
        .card-custom { border: none; border-radius: 20px; box-shadow: 0 5px 14px rgba(0,0,0,0.02); background: #ffffff; }
        
        /* Badges */
        .status-badge { padding: 6px 14px; border-radius: 8px; font-size: 0.75rem; font-weight: 700; }
        .status-aktif { background: #e0e7ff; color: #4318FF; }
        .status-selesai { background: #dcfce7; color: #059669; }
        .status-dibatalkan { background: #fee2e2; color: #dc2626; }
        .status-menunggu { background: #fef3c7; color: #d97706; }

        @media (max-width: 991.98px) {
            .sidebar { left: -260px; }
            .sidebar.show { left: 0; }
            .main-wrapper { margin-left: 0; }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar shadow-sm" id="sidebarMenu">
        <div class="sidebar-brand mb-4">
            <span class="brand-text">AutoRent Admin</span>
            <span class="brand-subtitle">SaaS Car Rental</span>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-fill"></i> Dashboard
            </a>
            <a href="{{ route('admin.armada.index') }}" class="menu-link {{ Route::is('admin.armada.*') ? 'active' : '' }}">
                <i class="bi bi-car-front-fill"></i> Armada
            </a>
            <a href="{{ route('admin.booking.index') }}" class="menu-link {{ Route::is('admin.booking.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check-fill"></i> Booking
            </a>
            <a href="{{ route('admin.pelanggan.index') }}" class="menu-link {{ Route::is('admin.pelanggan.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Pelanggan
            </a>
            <a href="{{ route('admin.pembayaran.index') }}" class="menu-link {{ Route::is('admin.pembayaran.*') ? 'active' : '' }}">
                <i class="bi bi-credit-card-fill"></i> Pembayaran
            </a>
            
            <div style="margin-top: 5rem;">
                <a href="{{ route('profile.edit') }}" class="menu-link {{ Route::is('profile.edit') ? 'active' : '' }}">
                    <i class="bi bi-gear-fill"></i> Pengaturan
                </a>
                <a href="{{ url('/') }}" class="menu-link mt-2">
                    <i class="bi bi-arrow-left-circle-fill"></i> Portal User
                </a>
            </div>
        </div>
    </aside>

    <!-- MAIN WRAPPER -->
    <div class="main-wrapper">
        <!-- NAVBAR -->
        <nav class="admin-navbar d-flex align-items-center justify-content-between">
            <button class="btn btn-light d-lg-none bg-white border-0 shadow-sm rounded-circle p-2" type="button" onclick="document.getElementById('sidebarMenu').classList.toggle('show')">
                <i class="bi bi-list fs-4"></i>
            </button>
            
            <form action="{{ route('admin.booking.index') }}" method="GET" class="d-none d-md-flex search-container">
                <i class="bi bi-search text-muted"></i>
                <input type="text" name="q" id="globalSearchInput" placeholder="Ketik '/' atau 'Ctrl+K' untuk mencari..." value="{{ request('q') }}">
            </form>
            
            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <a class="profile-container dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="text-end d-none d-sm-block">
                            <div class="small fw-bold text-dark" style="font-size: 0.85rem; line-height: 1;">Admin AutoRent</div>
                            <div class="text-muted" style="font-size: 0.7rem;">SUPERADMIN</div>
                        </div>
                        @if(Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" class="rounded-circle object-fit-cover" style="width: 38px; height: 38px;">
                        @else
                            <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-weight: bold; font-size: 0.9rem;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2">
                        <li><a class="dropdown-item py-2 small fw-medium" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Edit Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="admin-logout-form" class="d-none">
                                @csrf
                            </form>
                            <a href="#" class="dropdown-item py-2 text-danger small fw-medium" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Keluar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- CONTENT -->
        <main class="px-4 px-md-5 pb-5 pt-2 flex-grow-1">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 for nice alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Loading State on Submit
            const forms = document.querySelectorAll('form.needs-loading');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
                        submitBtn.disabled = true;
                    }
                });
            });

            // Keyboard Shortcuts
            document.addEventListener('keydown', function(e) {
                // Ignore if user is typing in an input
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
                
                // Ctrl+K or / to focus search
                if (e.key === '/' || (e.ctrlKey && e.key === 'k') || (e.metaKey && e.key === 'k')) {
                    e.preventDefault();
                    document.getElementById('globalSearchInput').focus();
                }
            });
        });
    </script>
</body>
</html>
