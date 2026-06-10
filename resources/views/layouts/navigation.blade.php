<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom py-2">
    <div class="container-xl px-4 px-md-5">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <div class="brand-logo-box">
                <svg width="18" height="16" viewBox="0 0 24 20" fill="none">
                    <path d="M21 8H19.5L17.5 3C17.19 2.4 16.56 2 15.86 2H8.14C7.44 2 6.81 2.4 6.5 3L4.5 8H3C2.45 8 2 8.45 2 9C2 9.55 2.45 10 3 10H3.5L3 10.5V17C3 17.55 3.45 18 4 18H5C5.55 18 6 17.55 6 17V16H18V17C18 17.55 18.45 18 19 18H20C20.55 18 21 17.55 21 17V10.5L20.5 10H21C21.55 10 22 9.55 22 9C22 8.45 21.55 8 21 8ZM7.5 13C6.67 13 6 12.33 6 11.5C6 10.67 6.67 10 7.5 10C8.33 10 9 10.67 9 11.5C9 12.33 8.33 13 7.5 13ZM16.5 13C15.67 13 15 12.33 15 11.5C15 10.67 15.67 10 16.5 10C17.33 10 18 10.67 18 11.5C18 12.33 17.33 13 16.5 13ZM5 8L7.5 3H16.5L19 8H5Z" fill="white"/>
                </svg>
            </div>
            <span class="brand-text">AutoRent</span>
        </a>

        <!-- Hamburger -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-md-3 ms-md-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold text-indigo' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('katalog') ? 'active fw-bold text-indigo' : '' }}" href="/katalog">Katalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('riwayat') ? 'active fw-bold text-indigo' : '' }}" href="/riwayat">Riwayat</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::user()->avatar)
                                <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle object-fit-cover" width="32" height="32">
                            @else
                                <div class="bg-indigo text-white rounded-circle d-flex align-items-center justify-content-center" style="width:32px; height:32px; font-size:14px; font-weight:600;">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            @endif
                            <span class="fw-medium text-dark">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2 text-muted"></i> Profile
                                </a>
                            </li>
                            @if(Auth::user()->role === 'admin')
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2 text-muted"></i> Admin Panel
                                </a>
                            </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item d-flex gap-2 align-items-center mt-2 mt-md-0">
                        <a href="{{ route('login') }}" class="btn btn-outline-custom border-0 fw-medium">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-primary-custom text-white fw-medium">Daftar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
