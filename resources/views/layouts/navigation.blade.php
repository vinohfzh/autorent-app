<style>
    /* ===== GLOBAL NAVBAR STYLE (digunakan di semua halaman frontend) ===== */
    #main-navbar {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border-bottom: 1px solid rgba(243,244,246,0.8);
        box-shadow: 0 2px 20px rgba(0,0,0,0.07);
        z-index: 1050;
    }
    #main-navbar .brand-logo-box {
        width: 32px; height: 32px;
        background: #4f46e5;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    #main-navbar .brand-text {
        font-size: 1.2rem; font-weight: 800;
        color: #4f46e5;
        letter-spacing: -0.5px;
        font-family: 'Inter', sans-serif;
    }
    #main-navbar .nav-link {
        font-size: 0.875rem; font-weight: 500;
        color: #6b7280 !important;
        transition: color 0.15s ease;
        padding: 0.25rem 0 !important;
    }
    #main-navbar .nav-link:hover { color: #111827 !important; }
    #main-navbar .nav-link.active {
        color: #4f46e5 !important;
        border-bottom: 2px solid #4f46e5;
    }
    #main-navbar .btn-nav-login {
        font-size: 0.875rem; font-weight: 500;
        color: #374151; text-decoration: none;
        transition: color 0.15s;
    }
    #main-navbar .btn-nav-login:hover { color: #4f46e5; }
    #main-navbar .btn-nav-register {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #fff; border: none;
        font-size: 0.875rem; font-weight: 500;
        padding: 0.45rem 1.35rem; border-radius: 50px;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        text-decoration: none;
    }
    #main-navbar .btn-nav-register:hover {
        background: linear-gradient(135deg, #4f46e5, #4338ca);
        color: #fff; transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79,70,229,0.35);
    }
    #main-navbar .user-avatar {
        width: 30px; height: 30px;
        background: #4f46e5;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-weight: 700; font-size: 13px;
        flex-shrink: 0;
    }
    #main-navbar .dropdown-toggle {
        font-size: 0.875rem; font-weight: 500;
        color: #111827; text-decoration: none;
    }
    #main-navbar .dropdown-menu {
        border-radius: 12px;
        border: 1px solid #f3f4f6;
        box-shadow: 0 10px 25px rgba(0,0,0,0.10);
        margin-top: 0.5rem !important;
        min-width: 180px;
    }
    #main-navbar .dropdown-item {
        font-size: 0.875rem; font-weight: 500;
        color: #374151; padding: 0.6rem 1rem;
    }
    #main-navbar .dropdown-item:hover { background: #f9fafb; color: #4f46e5; }
    #main-navbar .dropdown-item.text-danger:hover { background: #fef2f2; color: #b91c1c; }
</style>

<nav id="main-navbar" class="navbar navbar-expand-md fixed-top py-2">
    <div class="container-xl px-4 px-md-5">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <div class="brand-logo-box">
                <svg width="18" height="16" viewBox="0 0 24 20" fill="none">
                    <path d="M21 8H19.5L17.5 3C17.19 2.4 16.56 2 15.86 2H8.14C7.44 2 6.81 2.4 6.5 3L4.5 8H3C2.45 8 2 8.45 2 9C2 9.55 2.45 10 3 10H3.5L3 10.5V17C3 17.55 3.45 18 4 18H5C5.55 18 6 17.55 6 17V16H18V17C18 17.55 18.45 18 19 18H20C20.55 18 21 17.55 21 17V10.5L20.5 10H21C21.55 10 22 9.55 22 9C22 8.45 21.55 8 21 8ZM7.5 13C6.67 13 6 12.33 6 11.5C6 10.67 6.67 10 7.5 10C8.33 10 9 10.67 9 11.5C9 12.33 8.33 13 7.5 13ZM16.5 13C15.67 13 15 12.33 15 11.5C15 10.67 15.67 10 16.5 10C17.33 10 18 10.67 18 11.5C18 12.33 17.33 13 16.5 13ZM5 8L7.5 3H16.5L19 8H5Z" fill="white"/>
                </svg>
            </div>
            <span class="brand-text">AutoRent</span>
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavMenu" aria-controls="mainNavMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-4 text-dark"></i>
        </button>

        <!-- Nav Links -->
        <div class="collapse navbar-collapse" id="mainNavMenu">
            <ul class="navbar-nav mx-auto gap-md-4 gap-2 py-3 py-md-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('katalog') ? 'active' : '' }}" href="{{ route('katalog') }}">Katalog</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('riwayat') ? 'active' : '' }}" href="{{ route('riwayat') }}">Riwayat Sewa</a>
                </li>
                @endauth
            </ul>

            <div class="d-flex align-items-center gap-3 py-2 py-md-0">
                @auth
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle d-flex align-items-center gap-2 text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::user()->avatar ?? false)
                                <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle object-fit-cover" width="30" height="30">
                            @else
                                <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            @endif
                            <span style="font-size:0.875rem;font-weight:500;color:#111827;">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2 text-muted"></i>Profil Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('riwayat') }}">
                                    <i class="bi bi-clock-history me-2 text-muted"></i>Riwayat Sewa
                                </a>
                            </li>
                            @if(Auth::user()->role === 'admin')
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2 text-muted"></i>Admin Panel
                                </a>
                            </li>
                            @endif
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" id="nav-logout-form" class="d-none">@csrf</form>
                                <a href="#" class="dropdown-item py-2 text-danger"
                                   onclick="event.preventDefault(); document.getElementById('nav-logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                </a>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-nav-login">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-nav-register">Daftar Sekarang</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
