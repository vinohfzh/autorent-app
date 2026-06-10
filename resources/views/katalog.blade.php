<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Katalog Armada AutoRent - Temukan pilihan mobil premium terbaik untuk perjalanan Anda.">
    <title>Katalog Armada - AutoRent</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* ===== BASE ===== */
        * { -webkit-font-smoothing: antialiased; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; color: #111827; background-color: #f9fafb; overflow-x: hidden; }

        /* ===== COLOR VARIABLES ===== */
        :root {
            --indigo-600: #4f46e5;
            --indigo-700: #4338ca;
            --indigo-50: #eef2ff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-500: #6b7280;
            --gray-900: #111827;
        }

        /* ===== NAVBAR ===== */
        #navbar {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid #f3f4f6;
            transition: box-shadow 0.3s ease;
            z-index: 1050;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08); /* Always shadow on catalog page */
        }
        .navbar-brand .logo-box {
            width: 32px; height: 32px;
            background: var(--indigo-600);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }
        .navbar-brand span { font-size: 1.2rem; font-weight: 800; color: var(--indigo-600); letter-spacing: -0.5px; }
        .nav-link {
            font-size: 0.875rem; font-weight: 500;
            color: var(--gray-500) !important;
            transition: color 0.15s ease;
            padding: 0.25rem 0 !important;
        }
        .nav-link:hover { color: var(--gray-900) !important; }
        .nav-link.active { color: var(--indigo-600) !important; border-bottom: 2px solid var(--indigo-600); }
        .btn-nav-login {
            font-size: 0.875rem; font-weight: 500;
            color: #374151; border: none; background: none;
            transition: color 0.15s ease;
        }
        .btn-nav-login:hover { color: var(--indigo-600); }
        .btn-nav-register {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff; border: none;
            font-size: 0.875rem; font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .btn-nav-register:hover {
            background: linear-gradient(135deg, #4f46e5, #4338ca);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79,70,229,0.35);
        }

        /* ===== CATALOG HEADER ===== */
        .catalog-header {
            background: linear-gradient(180deg, #eef2ff 0%, #ffffff 100%);
            padding-top: 8rem;
            padding-bottom: 3rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .breadcrumb { margin-bottom: 1.5rem; font-size: 0.875rem; font-weight: 500; }
        .breadcrumb-item a { color: var(--indigo-600); text-decoration: none; }
        .breadcrumb-item.active { color: var(--gray-500); }
        .breadcrumb-item + .breadcrumb-item::before { content: "›"; font-size: 1.1rem; color: #9ca3af; line-height: 1; }
        
        .catalog-title { font-size: 2.5rem; font-weight: 800; color: var(--gray-900); letter-spacing: -0.03em; margin-bottom: 0.5rem; }
        .catalog-subtitle { color: var(--gray-500); font-size: 1.125rem; max-width: 600px; }
        
        /* ===== FILTER SECTION ===== */
        .filter-section {
            background: #fff;
            border-radius: 16px;
            padding: 1.25rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid #f3f4f6;
            margin-bottom: 2.5rem;
        }
        .btn-filter-group { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .btn-filter {
            background: #fff;
            border: 1px solid #e5e7eb;
            color: #374151;
            font-size: 0.875rem; font-weight: 600;
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            transition: all 0.2s ease;
        }
        .btn-filter:hover { background: #f9fafb; border-color: #d1d5db; }
        .btn-filter.active {
            background: var(--indigo-50);
            color: var(--indigo-700);
            border-color: #c7d2fe;
        }
        .sort-dropdown .btn {
            font-size: 0.875rem; font-weight: 600; color: var(--indigo-600);
            border: none; padding: 0; box-shadow: none;
        }

        /* ===== CAR CARDS ===== */
        .car-card {
            background: #fff;
            border: 1px solid #f3f4f6;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            height: 100%;
            display: flex; flex-direction: column;
        }
        .car-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }
        .car-img-wrap { padding: 8px; position: relative; }
        .car-img-inner {
            background: #f9fafb;
            border-radius: 16px;
            overflow: hidden;
            aspect-ratio: 16/10;
            position: relative;
            display: flex; align-items: center; justify-content: center;
        }
        .car-img-inner img { width: 100%; height: 100%; object-fit: cover; }
        
        .status-badge {
            position: absolute; top: 16px; right: 16px;
            backdrop-filter: blur(4px);
            border-radius: 50px; padding: 4px 12px;
            font-size: 0.75rem; font-weight: 700;
            display: inline-flex; align-items: center; gap: 6px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        }
        .status-available { background: rgba(255,255,255,0.9); color: #059669; }
        .status-available::before { content: ""; width: 6px; height: 6px; background-color: #10b981; border-radius: 50%; }
        .status-unavailable { background: rgba(243, 244, 246, 0.9); color: #6b7280; }
        .status-unavailable::before { content: ""; width: 6px; height: 6px; background-color: #9ca3af; border-radius: 50%; }

        .car-body { padding: 16px 20px 20px; display: flex; flex-direction: column; flex-grow: 1; }
        .car-brand-year { font-size: 0.75rem; font-weight: 600; color: var(--indigo-600); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; }
        .car-name { font-size: 1.15rem; font-weight: 700; color: var(--gray-900); margin-bottom: 12px; }
        .car-specs { display: flex; gap: 12px; margin-bottom: auto; flex-wrap: wrap; }
        .car-spec { display: flex; align-items: center; gap: 4px; font-size: 0.8rem; color: var(--gray-500); font-weight: 500; }
        
        .car-footer {
            display: flex; align-items: center; justify-content: space-between;
            padding-top: 16px; margin-top: 16px;
            border-top: 1px solid #f3f4f6;
        }
        .price-label { font-size: 0.65rem; font-weight: 700; color: #9ca3af; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 2px; }
        .price-value { font-size: 1.25rem; font-weight: 800; color: var(--indigo-600); }
        .price-per { font-size: 0.8rem; color: var(--gray-500); font-weight: 500; }
        
        .btn-car-detail {
            background: var(--indigo-50);
            color: var(--indigo-600);
            border: none; border-radius: 12px;
            font-size: 0.875rem; font-weight: 600;
            padding: 8px 16px;
            transition: all 0.2s;
        }
        .btn-car-detail:hover { background: var(--indigo-600); color: #fff; }

        /* ===== PAGINATION ===== */
        .pagination-wrap { display: flex; justify-content: center; margin-top: 3rem; margin-bottom: 2rem; }
        .page-link-custom {
            width: 40px; height: 40px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50% !important;
            border: 1px solid #e5e7eb;
            color: var(--gray-500);
            font-weight: 600; font-size: 0.875rem;
            margin: 0 4px;
            transition: all 0.2s;
            text-decoration: none;
            background: #fff;
        }
        .page-link-custom:hover { background: var(--indigo-50); color: var(--indigo-600); border-color: #c7d2fe; }
        .page-link-custom.active { background: var(--indigo-600); color: #fff; border-color: var(--indigo-600); box-shadow: 0 4px 10px rgba(79,70,229,0.3); }
        .page-link-custom.disabled { opacity: 0.5; pointer-events: none; }

        /* ===== FOOTER ===== */
        footer {
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
            margin-top: 4rem;
        }
        .footer-brand span { font-size: 1.2rem; font-weight: 800; color: var(--indigo-600); }
        .footer-desc { font-size: 0.875rem; color: var(--gray-500); line-height: 1.65; max-width: 220px; }
        .footer-heading { font-size: 0.7rem; font-weight: 700; color: var(--gray-900); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1.25rem; }
        .footer-link {
            font-size: 0.875rem; color: var(--gray-500);
            text-decoration: none; display: block; margin-bottom: 0.75rem;
            transition: color 0.15s;
        }
        .footer-link:hover { color: var(--indigo-600); }
        .social-icon {
            width: 32px; height: 32px;
            background: #e5e7eb;
            border-radius: 8px;
            display: inline-flex; align-items: center; justify-content: center;
            color: var(--gray-500);
            font-size: 0.875rem;
            transition: all 0.15s;
            text-decoration: none;
        }
        .social-icon:hover { background: #eef2ff; color: var(--indigo-600); }
        .footer-bottom { border-top: 1px solid #e5e7eb; padding: 1.5rem 0; }
        .footer-copy { font-size: 0.875rem; color: var(--gray-500); }
    </style>
</head>
<body>

    <!-- ===================== NAVBAR ===================== -->
    <nav id="navbar" class="navbar navbar-expand-md fixed-top py-2">
        <div class="container-xl px-4 px-md-5">

            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <div class="logo-box">
                    <svg width="18" height="16" viewBox="0 0 24 20" fill="none">
                        <path d="M21 8H19.5L17.5 3C17.19 2.4 16.56 2 15.86 2H8.14C7.44 2 6.81 2.4 6.5 3L4.5 8H3C2.45 8 2 8.45 2 9C2 9.55 2.45 10 3 10H3.5L3 10.5V17C3 17.55 3.45 18 4 18H5C5.55 18 6 17.55 6 17V16H18V17C18 17.55 18.45 18 19 18H20C20.55 18 21 17.55 21 17V10.5L20.5 10H21C21.55 10 22 9.55 22 9C22 8.45 21.55 8 21 8ZM7.5 13C6.67 13 6 12.33 6 11.5C6 10.67 6.67 10 7.5 10C8.33 10 9 10.67 9 11.5C9 12.33 8.33 13 7.5 13ZM16.5 13C15.67 13 15 12.33 15 11.5C15 10.67 15.67 10 16.5 10C17.33 10 18 10.67 18 11.5C18 12.33 17.33 13 16.5 13ZM5 8L7.5 3H16.5L19 8H5Z" fill="white"/>
                    </svg>
                </div>
                <span>AutoRent</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <i class="bi bi-list fs-4 text-dark"></i>
            </button>

            <!-- Nav Links -->
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto gap-md-4 gap-2 py-3 py-md-0">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/katalog">Katalog Armada</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3 py-2 py-md-0">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-nav-login text-decoration-none">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-nav-login text-decoration-none">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-nav-register text-decoration-none">Daftar Sekarang</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- ===================== CATALOG HEADER ===================== -->
    <header class="catalog-header">
        <div class="container-xl px-4 px-md-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Katalog Armada</li>
                </ol>
            </nav>
            <h1 class="catalog-title">Temukan Mobil Pilihanmu</h1>
            <p class="catalog-subtitle">Jelajahi berbagai koleksi mobil premium kami yang dirawat secara berkala untuk menjamin kenyamanan dan keamanan perjalanan Anda.</p>
        </div>
    </header>

    <!-- ===================== MAIN CONTENT ===================== -->
    <main class="py-5">
        <div class="container-xl px-4 px-md-5">
            
            <!-- Filter Section -->
            <div class="filter-section d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                <div class="d-flex align-items-center gap-3">
                    <span class="text-muted fw-semibold" style="font-size: 0.875rem;">Kategori:</span>
                    <div class="btn-filter-group">
                        <button class="btn-filter active">Semua</button>
                        <button class="btn-filter">SUV</button>
                        <button class="btn-filter">Sedan</button>
                        <button class="btn-filter">Hatchback</button>
                        <button class="btn-filter">Listrik (EV)</button>
                    </div>
                </div>
                
                <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                    <span class="text-muted fw-semibold" style="font-size: 0.875rem;">Menampilkan 24 mobil</span>
                    <div class="dropdown sort-dropdown border-start ps-3 ms-1">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Urutkan: Harga Terendah
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" style="border-radius: 12px;">
                            <li><a class="dropdown-item" href="#">Harga Terendah</a></li>
                            <li><a class="dropdown-item" href="#">Harga Tertinggi</a></li>
                            <li><a class="dropdown-item" href="#">Tahun Terbaru</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Car Grid -->
            <div class="row g-4">

                <!-- Car 1: Tesla Model 3 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="car-card">
                        <div class="car-img-wrap">
                            <div class="car-img-inner">
                                <img src="{{ asset('img/tesla_model3.png') }}" alt="Tesla Model 3" loading="lazy">
                            </div>
                            <span class="status-badge status-available">Tersedia</span>
                        </div>
                        <div class="car-body">
                            <div class="car-brand-year">Tesla • 2023</div>
                            <h3 class="car-name">Tesla Model 3</h3>
                            <div class="car-specs">
                                <div class="car-spec"><i class="bi bi-people-fill"></i> 5 Kursi</div>
                                <div class="car-spec"><i class="bi bi-gear"></i> Otomatis</div>
                                <div class="car-spec"><i class="bi bi-lightning-charge"></i> Listrik</div>
                            </div>
                            <div class="car-footer">
                                <div>
                                    <div class="price-label">Harga Sewa</div>
                                    <span class="price-value">Rp 1.2jt</span>
                                    <span class="price-per">/hari</span>
                                </div>
                                <a href="#" class="btn-car-detail text-decoration-none">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Car 2: Hyundai IONIQ 5 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="car-card" style="opacity: 0.85;">
                        <div class="car-img-wrap">
                            <div class="car-img-inner" style="background-color: #e5e7eb;">
                                <!-- Image placeholder -->
                                <i class="bi bi-car-front text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
                            </div>
                            <span class="status-badge status-unavailable">Disewa</span>
                        </div>
                        <div class="car-body">
                            <div class="car-brand-year">Hyundai • 2022</div>
                            <h3 class="car-name">Hyundai IONIQ 5</h3>
                            <div class="car-specs">
                                <div class="car-spec"><i class="bi bi-people-fill"></i> 5 Kursi</div>
                                <div class="car-spec"><i class="bi bi-gear"></i> Otomatis</div>
                                <div class="car-spec"><i class="bi bi-lightning-charge"></i> Listrik</div>
                            </div>
                            <div class="car-footer">
                                <div>
                                    <div class="price-label">Harga Sewa</div>
                                    <span class="price-value">Rp 1.5jt</span>
                                    <span class="price-per">/hari</span>
                                </div>
                                <a href="#" class="btn-car-detail text-decoration-none disabled" style="background:#f3f4f6; color:#9ca3af;">Tidak Tersedia</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Car 3: Porsche Taycan -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="car-card">
                        <div class="car-img-wrap">
                            <div class="car-img-inner" style="background-color: #f3f4f6;">
                                <i class="bi bi-car-front text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
                            </div>
                            <span class="status-badge status-available">Tersedia</span>
                        </div>
                        <div class="car-body">
                            <div class="car-brand-year">Porsche • 2023</div>
                            <h3 class="car-name">Porsche Taycan</h3>
                            <div class="car-specs">
                                <div class="car-spec"><i class="bi bi-people-fill"></i> 4 Kursi</div>
                                <div class="car-spec"><i class="bi bi-gear"></i> Otomatis</div>
                                <div class="car-spec"><i class="bi bi-lightning-charge"></i> Listrik</div>
                            </div>
                            <div class="car-footer">
                                <div>
                                    <div class="price-label">Harga Sewa</div>
                                    <span class="price-value">Rp 4.2jt</span>
                                    <span class="price-per">/hari</span>
                                </div>
                                <a href="#" class="btn-car-detail text-decoration-none">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Car 4: Ferrari F8 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="car-card">
                        <div class="car-img-wrap">
                            <div class="car-img-inner" style="background-color: #f3f4f6;">
                                <i class="bi bi-car-front text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
                            </div>
                            <span class="status-badge status-available">Tersedia</span>
                        </div>
                        <div class="car-body">
                            <div class="car-brand-year">Ferrari • 2021</div>
                            <h3 class="car-name">Ferrari F8 Tributo</h3>
                            <div class="car-specs">
                                <div class="car-spec"><i class="bi bi-people-fill"></i> 2 Kursi</div>
                                <div class="car-spec"><i class="bi bi-gear"></i> Otomatis</div>
                                <div class="car-spec"><i class="bi bi-fuel-pump"></i> Bensin</div>
                            </div>
                            <div class="car-footer">
                                <div>
                                    <div class="price-label">Harga Sewa</div>
                                    <span class="price-value">Rp 8.5jt</span>
                                    <span class="price-per">/hari</span>
                                </div>
                                <a href="#" class="btn-car-detail text-decoration-none">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Car 5: Mercedes-Benz G63 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="car-card">
                        <div class="car-img-wrap">
                            <div class="car-img-inner">
                                <img src="{{ asset('img/land_rover_vogue.png') }}" alt="Mercedes G63 Placeholder" loading="lazy">
                            </div>
                            <span class="status-badge status-available">Tersedia</span>
                        </div>
                        <div class="car-body">
                            <div class="car-brand-year">Mercedes-Benz • 2022</div>
                            <h3 class="car-name">AMG G63</h3>
                            <div class="car-specs">
                                <div class="car-spec"><i class="bi bi-people-fill"></i> 5 Kursi</div>
                                <div class="car-spec"><i class="bi bi-gear"></i> Otomatis</div>
                                <div class="car-spec"><i class="bi bi-fuel-pump"></i> Bensin</div>
                            </div>
                            <div class="car-footer">
                                <div>
                                    <div class="price-label">Harga Sewa</div>
                                    <span class="price-value">Rp 5.2jt</span>
                                    <span class="price-per">/hari</span>
                                </div>
                                <a href="#" class="btn-car-detail text-decoration-none">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Car 6: BMW Series 5 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="car-card">
                        <div class="car-img-wrap">
                            <div class="car-img-inner">
                                <img src="{{ asset('img/bmw_series5.png') }}" alt="BMW Series 5" loading="lazy">
                            </div>
                            <span class="status-badge status-available">Tersedia</span>
                        </div>
                        <div class="car-body">
                            <div class="car-brand-year">BMW • 2023</div>
                            <h3 class="car-name">BMW Series 5</h3>
                            <div class="car-specs">
                                <div class="car-spec"><i class="bi bi-people-fill"></i> 5 Kursi</div>
                                <div class="car-spec"><i class="bi bi-gear"></i> Otomatis</div>
                                <div class="car-spec"><i class="bi bi-fuel-pump"></i> Bensin</div>
                            </div>
                            <div class="car-footer">
                                <div>
                                    <div class="price-label">Harga Sewa</div>
                                    <span class="price-value">Rp 1.8jt</span>
                                    <span class="price-per">/hari</span>
                                </div>
                                <a href="#" class="btn-car-detail text-decoration-none">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Pagination -->
            <div class="pagination-wrap">
                <a href="#" class="page-link-custom disabled"><i class="bi bi-chevron-left"></i></a>
                <a href="#" class="page-link-custom active">1</a>
                <a href="#" class="page-link-custom">2</a>
                <a href="#" class="page-link-custom">3</a>
                <span class="d-flex align-items-center justify-content-center text-muted fw-bold px-2">...</span>
                <a href="#" class="page-link-custom">8</a>
                <a href="#" class="page-link-custom"><i class="bi bi-chevron-right"></i></a>
            </div>

        </div>
    </main>

    <!-- ===================== FOOTER ===================== -->
    <footer class="py-5">
        <div class="container-xl px-4 px-md-5">
            <div class="row g-5 mb-5">
                <!-- Brand -->
                <div class="col-12 col-md-4">
                    <div class="footer-brand d-flex align-items-center gap-2 mb-3">
                        <div class="logo-box" style="width: 32px; height: 32px; background: #4f46e5; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <svg width="18" height="16" viewBox="0 0 24 20" fill="none">
                                <path d="M21 8H19.5L17.5 3C17.19 2.4 16.56 2 15.86 2H8.14C7.44 2 6.81 2.4 6.5 3L4.5 8H3C2.45 8 2 8.45 2 9C2 9.55 2.45 10 3 10H3.5L3 10.5V17C3 17.55 3.45 18 4 18H5C5.55 18 6 17.55 6 17V16H18V17C18 17.55 18.45 18 19 18H20C20.55 18 21 17.55 21 17V10.5L20.5 10H21C21.55 10 22 9.55 22 9C22 8.45 21.55 8 21 8ZM7.5 13C6.67 13 6 12.33 6 11.5C6 10.67 6.67 10 7.5 10C8.33 10 9 10.67 9 11.5C9 12.33 8.33 13 7.5 13ZM16.5 13C15.67 13 15 12.33 15 11.5C15 10.67 15.67 10 16.5 10C17.33 10 18 10.67 18 11.5C18 12.33 17.33 13 16.5 13ZM5 8L7.5 3H16.5L19 8H5Z" fill="white"/>
                            </svg>
                        </div>
                        <span>AutoRent</span>
                    </div>
                    <p class="footer-desc">Platform sewa mobil modern dengan standar kenyamanan dan kepercayaan tertinggi di Indonesia.</p>
                </div>

                <!-- Perusahaan -->
                <div class="col-6 col-md-2">
                    <div class="footer-heading">Perusahaan</div>
                    <a href="#" class="footer-link">Tentang Kami</a>
                    <a href="#" class="footer-link">Karir</a>
                    <a href="#" class="footer-link">Blog</a>
                    <a href="#" class="footer-link">Hubungi Kami</a>
                </div>

                <!-- Layanan -->
                <div class="col-6 col-md-2">
                    <div class="footer-heading">Layanan</div>
                    <a href="#" class="footer-link">Sewa Harian</a>
                    <a href="#" class="footer-link">Sewa Korporasi</a>
                    <a href="#" class="footer-link">Lepas Kunci</a>
                    <a href="#" class="footer-link">Bantuan</a>
                </div>

                <!-- Legal & Sosial -->
                <div class="col-12 col-md-4">
                    <div class="footer-heading">Legal &amp; Sosial</div>
                    <a href="#" class="footer-link">Syarat &amp; Ketentuan</a>
                    <a href="#" class="footer-link">Kebijakan Privasi</a>
                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom text-center">
                <p class="footer-copy mb-0">© {{ date('Y') }} AutoRent Car Rental. Seluruh hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
