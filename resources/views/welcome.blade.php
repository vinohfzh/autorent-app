<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="AutoRent – Platform sewa mobil premium dengan proses kilat, armada terawat, dan harga transparan untuk segala kebutuhan perjalanan Anda di Indonesia.">
    <title>AutoRent – Sewa Mobil, Tanpa Drama.</title>

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
        body { font-family: 'Inter', sans-serif; color: #111827; overflow-x: hidden; }

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
        }
        #navbar.scrolled { box-shadow: 0 2px 20px rgba(0,0,0,0.08); }
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

        /* ===== HERO ===== */
        #home {
            background: linear-gradient(180deg, #eef2ff 0%, #ffffff 100%);
            padding-top: 7rem;
            padding-bottom: 4rem;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: #eef2ff; border: 1px solid #c7d2fe;
            border-radius: 50px; padding: 6px 16px;
            font-size: 0.75rem; font-weight: 600; color: #4338ca;
            letter-spacing: 0.02em;
        }
        .badge-dot {
            width: 7px; height: 7px;
            border-radius: 50%; background: #6366f1;
            animation: pulse-dot 2s infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }
        .hero-title {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 800; line-height: 1.1;
            letter-spacing: -0.04em;
        }
        .hero-title .brand { color: var(--indigo-600); }
        .hero-subtitle {
            font-size: 1.125rem; color: var(--gray-500);
            line-height: 1.7; max-width: 580px; margin: 0 auto;
        }
        .btn-hero-primary {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff; border: none;
            font-size: 1rem; font-weight: 500;
            padding: 1rem 2rem;
            border-radius: 50px;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(79,70,229,0.3);
        }
        .btn-hero-primary:hover {
            background: linear-gradient(135deg, #4f46e5, #4338ca);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79,70,229,0.4);
        }
        .btn-hero-secondary {
            background: #fff; color: #374151;
            border: 1px solid #e5e7eb;
            font-size: 1rem; font-weight: 500;
            padding: 1rem 2rem;
            border-radius: 50px;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }
        .btn-hero-secondary:hover {
            border-color: #c7d2fe;
            color: var(--indigo-600);
            transform: translateY(-1px);
        }
        .social-proof { display: flex; align-items: center; gap: 12px; }
        .avatar-stack { display: flex; }
        .avatar-item {
            width: 32px; height: 32px; border-radius: 50%;
            border: 2px solid #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.65rem; font-weight: 700;
            margin-left: -8px;
        }
        .avatar-item:first-child { margin-left: 0; }

        /* ===== SEARCH FORM ===== */
        .search-widget {
            background: rgba(255,255,255,0.97);
            border: 1px solid #e5e7eb;
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.08);
            margin-top: -2rem;
            position: relative;
            z-index: 10;
        }
        .search-label {
            font-size: 0.65rem; font-weight: 700;
            color: #9ca3af; letter-spacing: 0.1em;
            text-transform: uppercase; margin-bottom: 6px;
        }
        .search-input-wrapper {
            position: relative;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 14px 12px 40px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .search-input-wrapper:focus-within {
            border-color: var(--indigo-600);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
        }
        .search-input-wrapper .input-icon {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%); color: #9ca3af;
            font-size: 0.875rem;
        }
        .search-input-wrapper input {
            border: none; background: transparent;
            width: 100%; font-size: 0.875rem; color: #374151;
            outline: none;
        }
        .search-input-wrapper input::placeholder { color: #9ca3af; }
        .btn-search {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff; border: none;
            width: 100%; padding: 12px;
            border-radius: 12px;
            font-size: 0.875rem; font-weight: 500;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(79,70,229,0.25);
        }
        .btn-search:hover {
            background: linear-gradient(135deg, #4f46e5, #4338ca);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(79,70,229,0.35);
        }

        /* ===== FLEET SECTION ===== */
        #fleet { background: #fff; }
        .section-title {
            font-size: 2.25rem; font-weight: 800;
            color: var(--gray-900); letter-spacing: -0.03em;
        }
        .section-subtitle { color: var(--gray-500); font-size: 1rem; }
        .fleet-scroll-wrap {
            overflow-x: auto;
            padding-bottom: 16px;
            scrollbar-width: none; -ms-overflow-style: none;
        }
        .fleet-scroll-wrap::-webkit-scrollbar { display: none; }
        .fleet-track { display: flex; gap: 20px; min-width: max-content; }
        .car-card {
            width: 320px;
            background: #fff;
            border: 1px solid #f3f4f6;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            flex-shrink: 0;
        }
        .car-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .car-img-wrap {
            padding: 8px;
        }
        .car-img-inner {
            background: #f9fafb;
            border-radius: 16px;
            overflow: hidden;
            aspect-ratio: 16/10;
            position: relative;
        }
        .car-img-inner img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .car-badge {
            position: absolute; top: 12px; left: 12px;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(4px);
            border-radius: 50px;
            padding: 4px 12px;
            font-size: 0.7rem; font-weight: 700; color: #111;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        }
        .car-body { padding: 16px 20px 20px; }
        .car-name { font-size: 1.1rem; font-weight: 700; color: var(--gray-900); margin-bottom: 10px; }
        .car-specs { display: flex; gap: 16px; margin-bottom: 16px; }
        .car-spec { display: flex; align-items: center; gap: 5px; font-size: 0.8rem; color: var(--gray-500); }
        .car-footer {
            display: flex; align-items: center; justify-content: space-between;
            padding-top: 14px;
            border-top: 1px solid #f3f4f6;
        }
        .price-label { font-size: 0.6rem; font-weight: 700; color: #9ca3af; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 2px; }
        .price-value { font-size: 1.4rem; font-weight: 800; color: var(--indigo-600); }
        .price-per { font-size: 0.8rem; color: var(--gray-500); }
        .btn-car-arrow {
            width: 40px; height: 40px;
            background: #eef2ff;
            border: none; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: var(--indigo-600); font-size: 1rem;
            transition: background 0.2s;
        }
        .btn-car-arrow:hover { background: #c7d2fe; }
        .btn-see-all {
            font-size: 0.875rem; font-weight: 600; color: var(--indigo-600);
            text-decoration: none; display: inline-flex; align-items: center; gap: 4px;
            transition: gap 0.15s ease;
        }
        .btn-see-all:hover { gap: 8px; color: var(--indigo-700); }

        /* ===== STATS SECTION ===== */
        .stats-section {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            padding: 4rem 0;
        }
        .stat-number { font-size: 2.5rem; font-weight: 800; color: #fff; }
        .stat-label { font-size: 0.875rem; color: rgba(255,255,255,0.7); }

        /* ===== HOW IT WORKS ===== */
        #how-it-works { background: #f9fafb; }
        .step-card {
            background: #fff;
            border: 1px solid #f3f4f6;
            border-radius: 24px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            height: 100%;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .step-card:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(0,0,0,0.08); }
        .step-icon-wrap {
            width: 64px; height: 64px;
            background: #eef2ff; border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.25rem;
            font-size: 1.5rem; color: var(--indigo-600);
        }
        .step-badge {
            width: 28px; height: 28px;
            background: var(--indigo-600);
            color: #fff; font-size: 0.7rem; font-weight: 700;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .step-title { font-size: 1.125rem; font-weight: 700; color: var(--gray-900); margin-bottom: 0.75rem; }
        .step-desc { font-size: 0.9rem; color: var(--gray-500); line-height: 1.65; }

        /* ===== TESTIMONIALS ===== */
        #testimonials { background: #fff; }
        .testimonial-card {
            background: #f9fafb;
            border: 1px solid #f3f4f6;
            border-radius: 24px;
            padding: 2rem;
            height: 100%;
            display: flex; flex-direction: column; justify-content: space-between;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .testimonial-card:hover { transform: translateY(-2px); box-shadow: 0 12px 30px rgba(0,0,0,0.07); }
        .stars { color: #f59e0b; font-size: 0.875rem; margin-bottom: 1.25rem; }
        .testimonial-text { font-size: 0.9rem; color: #374151; line-height: 1.75; margin-bottom: 1.5rem; font-style: italic; }
        .avatar-circle {
            width: 44px; height: 44px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; font-weight: 700;
            flex-shrink: 0;
        }
        .reviewer-name { font-size: 0.875rem; font-weight: 700; color: var(--gray-900); margin-bottom: 1px; }
        .reviewer-role { font-size: 0.8rem; color: var(--gray-500); }

        /* ===== CTA BANNER ===== */
        .cta-section {
            background: linear-gradient(135deg, #4338ca 0%, #6366f1 50%, #7c3aed 100%);
            padding: 5rem 0;
        }
        .cta-title { font-size: 2.25rem; font-weight: 800; color: #fff; letter-spacing: -0.03em; }
        .cta-subtitle { color: rgba(255,255,255,0.75); font-size: 1.125rem; }
        .btn-cta-white {
            background: #fff;
            color: var(--indigo-600);
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-size: 1rem; font-weight: 600;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        .btn-cta-white:hover {
            background: #f0f4ff;
            color: var(--indigo-700);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        .btn-cta-outline {
            background: transparent;
            color: rgba(255,255,255,0.9);
            border: 1px solid rgba(255,255,255,0.35);
            padding: 1rem 2rem;
            border-radius: 50px;
            font-size: 1rem; font-weight: 500;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.2s ease;
        }
        .btn-cta-outline:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }

        /* ===== FOOTER ===== */
        footer {
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
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

        /* ===== REVEAL ANIMATION ===== */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-d1 { transition-delay: 0.1s; }
        .reveal-d2 { transition-delay: 0.2s; }
        .reveal-d3 { transition-delay: 0.3s; }
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
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/katalog">Katalog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">Cara Kerja</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimonials">Ulasan</a></li>
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

    <!-- ===================== HERO SECTION ===================== -->
    <section id="home" class="py-5">
        <div class="container-xl px-4 px-md-5">
            <div class="text-center">

                <!-- Badge -->
                <div class="hero-badge mb-4 reveal">
                    <span class="badge-dot"></span>
                    Platform Sewa Mobil #1 di Indonesia
                </div>

                <!-- Headline -->
                <h1 class="hero-title mb-4 reveal">
                    <span class="brand">AutoRent</span><br>
                    Sewa Mobil,<br>Tanpa Drama.
                </h1>

                <!-- Subheadline -->
                <p class="hero-subtitle mx-auto mb-5 reveal">
                    Nikmati pengalaman sewa mobil premium dengan proses kilat, armada terawat, dan harga transparan untuk segala kebutuhan perjalanan Anda.
                </p>

                <!-- CTA Buttons -->
                <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-3 mb-5 reveal">
                    <a href="#fleet" class="btn-hero-primary text-decoration-none">
                        <i class="bi bi-search"></i> Cari Mobil
                    </a>
                    <a href="#fleet" class="btn-hero-secondary text-decoration-none">
                        Lihat Armada <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <!-- Social Proof -->
                <div class="social-proof justify-content-center reveal">
                    <div class="avatar-stack">
                        <div class="avatar-item" style="background:#eef2ff; color:#4f46e5;">A</div>
                        <div class="avatar-item" style="background:#ecfdf5; color:#059669;">B</div>
                        <div class="avatar-item" style="background:#fffbeb; color:#d97706;">C</div>
                        <div class="avatar-item" style="background:#fdf2f8; color:#db2777;">D</div>
                        <div class="avatar-item" style="background:#f5f3ff; color:#7c3aed;">E</div>
                    </div>
                    <p class="mb-0 ms-2 text-muted" style="font-size:0.875rem;">
                        Dipercaya <strong class="text-dark">10.000+</strong> penyewa di Indonesia
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== SEARCH FORM ===================== -->
    <div class="container-xl px-4 px-md-5" style="position: relative; z-index: 20;">
        <div class="search-widget reveal">
            <div class="row g-3 align-items-end">
                <!-- Kota -->
                <div class="col-12 col-md-3">
                    <div class="search-label">Kota</div>
                    <div class="search-input-wrapper">
                        <i class="bi bi-geo-alt-fill input-icon"></i>
                        <input type="text" id="city-input" placeholder="Jakarta, Indonesia">
                    </div>
                </div>

                <!-- Tanggal Mulai -->
                <div class="col-12 col-md-3">
                    <div class="search-label">Tanggal Mulai</div>
                    <div class="search-input-wrapper">
                        <i class="bi bi-calendar3 input-icon"></i>
                        <input type="date" id="start-date">
                    </div>
                </div>

                <!-- Tanggal Selesai -->
                <div class="col-12 col-md-3">
                    <div class="search-label">Tanggal Selesai</div>
                    <div class="search-input-wrapper">
                        <i class="bi bi-calendar3 input-icon"></i>
                        <input type="date" id="end-date">
                    </div>
                </div>

                <!-- Submit -->
                <div class="col-12 col-md-3">
                    <button id="search-btn" class="btn-search">
                        <i class="bi bi-search"></i> Cari Mobil
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================== FLEET SECTION ===================== -->
    <section id="fleet" class="py-5 mt-4">
        <div class="container-xl px-4 px-md-5">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-end mb-4 reveal">
                <div>
                    <h2 class="section-title mb-1">Armada Pilihan</h2>
                    <p class="section-subtitle mb-0">Pilih kendaraan terbaik untuk kenyamanan Anda.</p>
                </div>
                <a href="/katalog" class="btn-see-all">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- Cards Scroll -->
            <div class="fleet-scroll-wrap reveal">
                <div class="fleet-track">

                    <!-- Tesla Model 3 -->
                    <div class="car-card">
                        <div class="car-img-wrap">
                            <div class="car-img-inner">
                                <img src="{{ asset('img/tesla_model3.png') }}" alt="Tesla Model 3" loading="lazy">
                                <span class="car-badge">⚡ Electric</span>
                            </div>
                        </div>
                        <div class="car-body">
                            <div class="car-name">Tesla Model 3</div>
                            <div class="car-specs">
                                <div class="car-spec"><i class="bi bi-sliders"></i> Auto</div>
                                <div class="car-spec"><i class="bi bi-people-fill"></i> 5 Kursi</div>
                                <div class="car-spec"><i class="bi bi-lightning-charge"></i> 0–100 3.3s</div>
                            </div>
                            <div class="car-footer">
                                <div>
                                    <div class="price-label">Mulai Dari</div>
                                    <span class="price-value">Rp 1.2jt</span>
                                    <span class="price-per">/hari</span>
                                </div>
                                <button class="btn-car-arrow"><i class="bi bi-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- BMW Series 5 -->
                    <div class="car-card">
                        <div class="car-img-wrap">
                            <div class="car-img-inner">
                                <img src="{{ asset('img/bmw_series5.png') }}" alt="BMW Series 5" loading="lazy">
                                <span class="car-badge">⛽ Petrol</span>
                            </div>
                        </div>
                        <div class="car-body">
                            <div class="car-name">BMW Series 5</div>
                            <div class="car-specs">
                                <div class="car-spec"><i class="bi bi-sliders"></i> Auto</div>
                                <div class="car-spec"><i class="bi bi-people-fill"></i> 5 Kursi</div>
                                <div class="car-spec"><i class="bi bi-speedometer2"></i> 0–100 5.2s</div>
                            </div>
                            <div class="car-footer">
                                <div>
                                    <div class="price-label">Mulai Dari</div>
                                    <span class="price-value">Rp 2.5jt</span>
                                    <span class="price-per">/hari</span>
                                </div>
                                <button class="btn-car-arrow"><i class="bi bi-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Land Rover Vogue -->
                    <div class="car-card">
                        <div class="car-img-wrap">
                            <div class="car-img-inner">
                                <img src="{{ asset('img/land_rover_vogue.png') }}" alt="Land Rover Vogue" loading="lazy">
                                <span class="car-badge">🌿 Hybrid</span>
                            </div>
                        </div>
                        <div class="car-body">
                            <div class="car-name">Land Rover Vogue</div>
                            <div class="car-specs">
                                <div class="car-spec"><i class="bi bi-sliders"></i> Auto</div>
                                <div class="car-spec"><i class="bi bi-people-fill"></i> 7 Kursi</div>
                                <div class="car-spec"><i class="bi bi-crosshair2"></i> 4WD</div>
                            </div>
                            <div class="car-footer">
                                <div>
                                    <div class="price-label">Mulai Dari</div>
                                    <span class="price-value">Rp 4.0jt</span>
                                    <span class="price-per">/hari</span>
                                </div>
                                <button class="btn-car-arrow"><i class="bi bi-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Mini Cooper S -->
                    <div class="car-card">
                        <div class="car-img-wrap">
                            <div class="car-img-inner">
                                <img src="{{ asset('img/mini_cooper_s.png') }}" alt="Mini Cooper S" loading="lazy">
                                <span class="car-badge">⛽ Petrol</span>
                            </div>
                        </div>
                        <div class="car-body">
                            <div class="car-name">Mini Cooper S</div>
                            <div class="car-specs">
                                <div class="car-spec"><i class="bi bi-sliders"></i> Auto</div>
                                <div class="car-spec"><i class="bi bi-people-fill"></i> 4 Kursi</div>
                                <div class="car-spec"><i class="bi bi-speedometer2"></i> 0–100 6.7s</div>
                            </div>
                            <div class="car-footer">
                                <div>
                                    <div class="price-label">Mulai Dari</div>
                                    <span class="price-value">Rp 1.5jt</span>
                                    <span class="price-per">/hari</span>
                                </div>
                                <button class="btn-car-arrow"><i class="bi bi-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ===================== STATS SECTION ===================== -->
    <section class="stats-section">
        <div class="container-xl px-4 px-md-5">
            <div class="row text-center g-4">
                <div class="col-6 col-md-3 reveal">
                    <div class="stat-number">10K+</div>
                    <div class="stat-label">Penyewa Aktif</div>
                </div>
                <div class="col-6 col-md-3 reveal reveal-d1">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Armada Tersedia</div>
                </div>
                <div class="col-6 col-md-3 reveal reveal-d2">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Kota di Indonesia</div>
                </div>
                <div class="col-6 col-md-3 reveal reveal-d3">
                    <div class="stat-number">4.9★</div>
                    <div class="stat-label">Rating Rata-rata</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== HOW IT WORKS ===================== -->
    <section id="how-it-works" class="py-5" style="border-top: 1px solid #f3f4f6;">
        <div class="container-xl px-4 px-md-5">

            <div class="text-center mb-5 reveal">
                <h2 class="section-title mb-3">Cara Kerjanya</h2>
                <p class="section-subtitle mx-auto" style="max-width: 480px;">Tiga langkah mudah untuk memulai perjalanan Anda bersama AutoRent.</p>
            </div>

            <div class="row g-4">
                <!-- Step 1 -->
                <div class="col-12 col-md-4 reveal">
                    <div class="step-card">
                        <div class="step-icon-wrap">
                            <i class="bi bi-search"></i>
                        </div>
                        <div class="step-badge">1</div>
                        <h3 class="step-title">Pilih Kendaraan</h3>
                        <p class="step-desc">Telusuri berbagai pilihan armada terbaik kami yang sesuai dengan gaya dan kebutuhan perjalanan Anda.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="col-12 col-md-4 reveal reveal-d1">
                    <div class="step-card">
                        <div class="step-icon-wrap">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="step-badge">2</div>
                        <h3 class="step-title">Tentukan Jadwal</h3>
                        <p class="step-desc">Atur waktu penjemputan dan pengembalian dengan sistem kalender kami yang fleksibel dan instan.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="col-12 col-md-4 reveal reveal-d2">
                    <div class="step-card">
                        <div class="step-icon-wrap">
                            <i class="bi bi-key-fill"></i>
                        </div>
                        <div class="step-badge">3</div>
                        <h3 class="step-title">Ambil &amp; Berkendara</h3>
                        <p class="step-desc">Ambil kunci Anda di titik terdekat atau minta layanan pengantaran langsung ke pintu rumah Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== TESTIMONIALS ===================== -->
    <section id="testimonials" class="py-5" style="border-top: 1px solid #f3f4f6;">
        <div class="container-xl px-4 px-md-5">

            <div class="text-center mb-5 reveal">
                <h2 class="section-title mb-3">Apa Kata Mereka?</h2>
                <p class="section-subtitle">Kepuasan pelanggan adalah prioritas utama kami.</p>
            </div>

            <div class="row g-4">
                <!-- Testimonial 1 -->
                <div class="col-12 col-md-4 reveal">
                    <div class="testimonial-card">
                        <div>
                            <div class="stars">★★★★★</div>
                            <p class="testimonial-text">"Prosesnya benar-benar tanpa drama. Mobil bersih dan wangi, harganya pun sangat kompetitif dibanding aplikasi lain."</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-circle" style="background:#eef2ff; color:#4338ca;">AP</div>
                            <div>
                                <div class="reviewer-name">Andi Pratama</div>
                                <div class="reviewer-role">Penyewa di Jakarta</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="col-12 col-md-4 reveal reveal-d1">
                    <div class="testimonial-card">
                        <div>
                            <div class="stars">★★★★★</div>
                            <p class="testimonial-text">"Sangat terbantu untuk perjalanan bisnis mendadak. Respon CS sangat cepat dan armada Tesla-nya dalam kondisi prima."</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-circle" style="background:#ecfdf5; color:#065f46;">SW</div>
                            <div>
                                <div class="reviewer-name">Sarah Wijaya</div>
                                <div class="reviewer-role">Creative Director</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="col-12 col-md-4 reveal reveal-d2">
                    <div class="testimonial-card">
                        <div>
                            <div class="stars">★★★★★</div>
                            <p class="testimonial-text">"Terbaik di kelasnya! Tidak ada biaya tersembunyi. Pengembalian unit sangat mudah dan tidak ribet."</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-circle" style="background:#fffbeb; color:#92400e;">BS</div>
                            <div>
                                <div class="reviewer-name">Budi Santoso</div>
                                <div class="reviewer-role">Traveler</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== CTA BANNER ===================== -->
    <section class="cta-section">
        <div class="container-xl px-4 px-md-5 text-center reveal">
            <h2 class="cta-title mb-3">Siap Memulai Perjalanan?</h2>
            <p class="cta-subtitle mb-5">Daftar sekarang dan dapatkan diskon 20% untuk sewa pertama Anda.</p>
            <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-cta-white text-decoration-none">
                        Buka Dashboard <i class="bi bi-arrow-right"></i>
                    </a>
                @else
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-cta-white text-decoration-none">
                            Daftar Gratis Sekarang <i class="bi bi-arrow-right"></i>
                        </a>
                    @endif
                    <a href="{{ route('login') }}" class="btn-cta-outline text-decoration-none">
                        Sudah punya akun? Masuk
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- ===================== FOOTER ===================== -->
    <footer class="py-5">
        <div class="container-xl px-4 px-md-5">
            <div class="row g-5 mb-5">

                <!-- Brand -->
                <div class="col-12 col-md-4">
                    <div class="footer-brand d-flex align-items-center gap-2 mb-3">
                        <div class="logo-box">
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

    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 20);
        });

        // Scroll reveal
        const revealEls = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
        revealEls.forEach(el => observer.observe(el));

        // Active nav on scroll
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('#navMenu .nav-link');
        window.addEventListener('scroll', () => {
            let curr = '';
            sections.forEach(s => { if (window.scrollY >= s.offsetTop - 120) curr = s.id; });
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + curr) link.classList.add('active');
            });
        });

        // Date inputs
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('start-date').min = today;
        document.getElementById('end-date').min = today;
        document.getElementById('start-date').addEventListener('change', e => {
            document.getElementById('end-date').min = e.target.value;
        });
    </script>
</body>
</html>
