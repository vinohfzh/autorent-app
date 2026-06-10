<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Detail armada AutoRent - Sewa mobil premium dengan harga transparan.">
    <title>Tesla Model 3 - AutoRent</title>

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
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            z-index: 1050;
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
        
        .btn-nav-login { font-size: 0.875rem; font-weight: 500; color: #374151; border: none; background: none; transition: color 0.15s ease; }
        .btn-nav-login:hover { color: var(--indigo-600); }
        .btn-nav-register {
            background: linear-gradient(135deg, #6366f1, #4f46e5); color: #fff; border: none;
            font-size: 0.875rem; font-weight: 500; padding: 0.5rem 1.5rem; border-radius: 50px;
            transition: all 0.2s ease; box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .btn-nav-register:hover { background: linear-gradient(135deg, #4f46e5, #4338ca); color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,0.35); }

        /* ===== MAIN LAYOUT ===== */
        .page-content { padding-top: 6.5rem; padding-bottom: 4rem; }
        
        .breadcrumb { font-size: 0.875rem; font-weight: 500; margin-bottom: 1.5rem; }
        .breadcrumb-item a { color: var(--indigo-600); text-decoration: none; }
        .breadcrumb-item.active { color: var(--gray-500); }
        .breadcrumb-item + .breadcrumb-item::before { content: "›"; font-size: 1.1rem; color: #9ca3af; line-height: 1; }

        /* ===== LEFT COLUMN ===== */
        .car-title-section { margin-bottom: 1.5rem; }
        .car-brand-year { font-size: 0.875rem; font-weight: 600; color: var(--gray-500); letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 0.5rem; }
        .car-title { font-size: 2.25rem; font-weight: 800; color: var(--gray-900); letter-spacing: -0.03em; margin-bottom: 0.5rem; }
        .car-rating { display: inline-flex; align-items: center; gap: 6px; font-size: 0.875rem; font-weight: 600; color: var(--gray-900); background: #fff; padding: 4px 12px; border-radius: 50px; border: 1px solid #e5e7eb; }
        .car-rating i { color: #f59e0b; }
        .car-rating span { color: var(--gray-500); font-weight: 500; }

        /* Image Gallery */
        .gallery-main { width: 100%; aspect-ratio: 16/9; background: #fff; border-radius: 20px; overflow: hidden; margin-bottom: 1rem; border: 1px solid #f3f4f6; position: relative; }
        .gallery-main img { width: 100%; height: 100%; object-fit: cover; }
        .gallery-thumbnails { display: flex; gap: 1rem; overflow-x: auto; padding-bottom: 0.5rem; }
        .gallery-thumb { width: 120px; height: 80px; border-radius: 12px; overflow: hidden; border: 2px solid transparent; cursor: pointer; opacity: 0.7; transition: all 0.2s; background: #fff; flex-shrink: 0; }
        .gallery-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .gallery-thumb:hover { opacity: 1; }
        .gallery-thumb.active { border-color: var(--indigo-600); opacity: 1; }

        /* Sections */
        .section-title { font-size: 1.25rem; font-weight: 700; color: var(--gray-900); margin-bottom: 1.25rem; margin-top: 2.5rem; }
        
        .specs-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
        @media (max-width: 576px) { .specs-grid { grid-template-columns: repeat(2, 1fr); } }
        .spec-item { background: #fff; border: 1px solid #f3f4f6; border-radius: 16px; padding: 1rem; display: flex; align-items: center; gap: 1rem; transition: transform 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.02); }
        .spec-item:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .spec-icon { width: 40px; height: 40px; background: var(--indigo-50); color: var(--indigo-600); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
        .spec-label { font-size: 0.75rem; font-weight: 600; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.1rem; }
        .spec-val { font-size: 0.95rem; font-weight: 700; color: var(--gray-900); }

        .desc-text { font-size: 1rem; line-height: 1.7; color: #4b5563; }
        
        .included-list { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        @media (max-width: 576px) { .included-list { grid-template-columns: 1fr; } }
        .included-item { display: flex; align-items: center; gap: 12px; font-weight: 500; color: var(--gray-900); }
        .included-icon { color: #10b981; font-size: 1.25rem; }

        /* ===== RIGHT COLUMN (STICKY WIDGET) ===== */
        .widget-wrapper { position: sticky; top: 6.5rem; }
        .booking-widget { background: #fff; border-radius: 24px; padding: 1.75rem; border: 1px solid #f3f4f6; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        
        .price-header { margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px dashed #e5e7eb; }
        .price-val { font-size: 2rem; font-weight: 800; color: var(--indigo-600); line-height: 1; }
        .price-unit { font-size: 1rem; font-weight: 500; color: var(--gray-500); }
        
        .date-picker { display: flex; gap: 0.75rem; margin-bottom: 1rem; }
        .date-box { flex: 1; background: var(--gray-50); border: 1px solid #e5e7eb; border-radius: 12px; padding: 0.75rem; transition: border-color 0.2s; cursor: pointer; }
        .date-box:hover { border-color: var(--indigo-600); }
        .date-label { font-size: 0.75rem; font-weight: 700; color: var(--gray-500); text-transform: uppercase; margin-bottom: 0.25rem; }
        .date-val { font-size: 0.95rem; font-weight: 600; color: var(--gray-900); display: flex; align-items: center; gap: 8px; }
        .date-val i { color: var(--indigo-600); }
        .total-days { text-align: center; font-size: 0.875rem; font-weight: 500; color: var(--indigo-600); margin-bottom: 1.25rem; background: var(--indigo-50); padding: 4px; border-radius: 50px; }
        
        .delivery-toggle { display: flex; background: var(--gray-50); padding: 4px; border-radius: 50px; margin-bottom: 1.5rem; border: 1px solid #e5e7eb; }
        .delivery-btn { flex: 1; border: none; background: transparent; padding: 8px 0; font-size: 0.875rem; font-weight: 600; color: var(--gray-500); border-radius: 50px; transition: all 0.2s; }
        .delivery-btn.active { background: #fff; color: var(--indigo-600); box-shadow: 0 2px 4px rgba(0,0,0,0.05); }

        .price-breakdown { margin-bottom: 1.5rem; }
        .breakdown-row { display: flex; justify-content: space-between; font-size: 0.95rem; color: var(--gray-500); margin-bottom: 0.75rem; }
        .breakdown-total { display: flex; justify-content: space-between; font-size: 1.15rem; font-weight: 800; color: var(--gray-900); padding-top: 1rem; border-top: 1px solid #e5e7eb; margin-top: 0.5rem; }
        
        .btn-booking { background: linear-gradient(135deg, #6366f1, #4f46e5); color: #fff; border: none; width: 100%; padding: 1rem; font-size: 1.1rem; font-weight: 700; border-radius: 16px; transition: all 0.2s; box-shadow: 0 4px 12px rgba(79,70,229,0.25); margin-bottom: 1.5rem; }
        .btn-booking:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(79,70,229,0.35); color: #fff; }

        .trust-signals { display: flex; justify-content: center; gap: 1.5rem; }
        .trust-item { display: flex; align-items: center; gap: 6px; font-size: 0.8rem; font-weight: 500; color: var(--gray-500); }
        .trust-item i { color: #10b981; font-size: 1.1rem; }

        .pickup-location { display: flex; gap: 12px; margin-top: 1.5rem; padding: 1rem; background: var(--indigo-50); border-radius: 12px; border: 1px solid #c7d2fe; }
        .pickup-location i { color: var(--indigo-600); font-size: 1.25rem; }
        .pickup-location .loc-title { font-size: 0.875rem; font-weight: 700; color: var(--indigo-700); margin-bottom: 0.1rem; }
        .pickup-location .loc-desc { font-size: 0.8rem; color: #4338ca; }

        /* ===== RELATED CARS (Same as Catalog) ===== */
        .related-section { margin-top: 4rem; padding-top: 4rem; border-top: 1px solid #e5e7eb; }
        .car-card { background: #fff; border: 1px solid #f3f4f6; border-radius: 24px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.06); transition: transform 0.25s ease, box-shadow 0.25s ease; height: 100%; display: flex; flex-direction: column; }
        .car-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
        .car-img-wrap { padding: 8px; position: relative; }
        .car-img-inner { background: #f9fafb; border-radius: 16px; overflow: hidden; aspect-ratio: 16/10; position: relative; display: flex; align-items: center; justify-content: center; }
        .car-img-inner img { width: 100%; height: 100%; object-fit: cover; }
        
        .status-badge { position: absolute; top: 16px; right: 16px; backdrop-filter: blur(4px); border-radius: 50px; padding: 4px 12px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); }
        .status-available { background: rgba(255,255,255,0.9); color: #059669; }
        .status-available::before { content: ""; width: 6px; height: 6px; background-color: #10b981; border-radius: 50%; }

        .car-body { padding: 16px 20px 20px; display: flex; flex-direction: column; flex-grow: 1; }
        .car-card-brand-year { font-size: 0.75rem; font-weight: 600; color: var(--indigo-600); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; }
        .car-name { font-size: 1.15rem; font-weight: 700; color: var(--gray-900); margin-bottom: 12px; }
        .car-specs { display: flex; gap: 12px; margin-bottom: auto; flex-wrap: wrap; }
        .car-spec-item { display: flex; align-items: center; gap: 4px; font-size: 0.8rem; color: var(--gray-500); font-weight: 500; }
        
        .car-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 16px; margin-top: 16px; border-top: 1px solid #f3f4f6; }
        .car-price-label { font-size: 0.65rem; font-weight: 700; color: #9ca3af; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 2px; }
        .car-price-value { font-size: 1.25rem; font-weight: 800; color: var(--indigo-600); }
        .car-price-per { font-size: 0.8rem; color: var(--gray-500); font-weight: 500; }
        
        .btn-car-detail { background: var(--indigo-50); color: var(--indigo-600); border: none; border-radius: 12px; font-size: 0.875rem; font-weight: 600; padding: 8px 16px; transition: all 0.2s; }
        .btn-car-detail:hover { background: var(--indigo-600); color: #fff; }

        /* ===== FOOTER ===== */
        footer { background: #f9fafb; border-top: 1px solid #e5e7eb; margin-top: 0; }
        .footer-brand span { font-size: 1.2rem; font-weight: 800; color: var(--indigo-600); }
        .footer-desc { font-size: 0.875rem; color: var(--gray-500); line-height: 1.65; max-width: 220px; }
        .footer-heading { font-size: 0.7rem; font-weight: 700; color: var(--gray-900); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1.25rem; }
        .footer-link { font-size: 0.875rem; color: var(--gray-500); text-decoration: none; display: block; margin-bottom: 0.75rem; transition: color 0.15s; }
        .footer-link:hover { color: var(--indigo-600); }
        .social-icon { width: 32px; height: 32px; background: #e5e7eb; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; color: var(--gray-500); font-size: 0.875rem; transition: all 0.15s; text-decoration: none; }
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
                    <svg width="18" height="16" viewBox="0 0 24 20" fill="none"><path d="M21 8H19.5L17.5 3C17.19 2.4 16.56 2 15.86 2H8.14C7.44 2 6.81 2.4 6.5 3L4.5 8H3C2.45 8 2 8.45 2 9C2 9.55 2.45 10 3 10H3.5L3 10.5V17C3 17.55 3.45 18 4 18H5C5.55 18 6 17.55 6 17V16H18V17C18 17.55 18.45 18 19 18H20C20.55 18 21 17.55 21 17V10.5L20.5 10H21C21.55 10 22 9.55 22 9C22 8.45 21.55 8 21 8ZM7.5 13C6.67 13 6 12.33 6 11.5C6 10.67 6.67 10 7.5 10C8.33 10 9 10.67 9 11.5C9 12.33 8.33 13 7.5 13ZM16.5 13C15.67 13 15 12.33 15 11.5C15 10.67 15.67 10 16.5 10C17.33 10 18 10.67 18 11.5C18 12.33 17.33 13 16.5 13ZM5 8L7.5 3H16.5L19 8H5Z" fill="white"/></svg>
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

    <!-- ===================== PAGE CONTENT ===================== -->
    <main class="page-content">
        <div class="container-xl px-4 px-md-5">
            
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/katalog">Katalog Armada</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tesla Model 3</li>
                </ol>
            </nav>

            <div class="row g-5">
                
                <!-- ================= LEFT COLUMN ================= -->
                <div class="col-lg-7 col-xl-8">
                    
                    <!-- Title & Rating -->
                    <div class="car-title-section">
                        <div class="d-flex justify-content-between align-items-end flex-wrap gap-2">
                            <div>
                                <div class="car-brand-year">Tesla • 2023</div>
                                <h1 class="car-title">Tesla Model 3</h1>
                            </div>
                            <div class="car-rating mb-2">
                                <i class="bi bi-star-fill"></i> 4.9 <span>(128 Ulasan)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Image Gallery -->
                    <div class="gallery-main">
                        <img src="{{ asset('img/tesla_model3.png') }}" alt="Tesla Model 3 Main Image">
                        <span class="status-badge status-available">Tersedia</span>
                    </div>
                    <div class="gallery-thumbnails">
                        <div class="gallery-thumb active"><img src="{{ asset('img/tesla_model3.png') }}" alt="Thumb 1"></div>
                        <div class="gallery-thumb"><div style="width:100%; height:100%; background:#e5e7eb; display:flex; align-items:center; justify-content:center;"><i class="bi bi-image text-muted"></i></div></div>
                        <div class="gallery-thumb"><div style="width:100%; height:100%; background:#e5e7eb; display:flex; align-items:center; justify-content:center;"><i class="bi bi-image text-muted"></i></div></div>
                    </div>

                    <!-- Spesifikasi -->
                    <h2 class="section-title">Spesifikasi Kendaraan</h2>
                    <div class="specs-grid">
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-people-fill"></i></div>
                            <div><div class="spec-label">Kursi</div><div class="spec-val">4 Kursi</div></div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-gear-fill"></i></div>
                            <div><div class="spec-label">Transmisi</div><div class="spec-val">Otomatis</div></div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-lightning-charge-fill"></i></div>
                            <div><div class="spec-label">BBM</div><div class="spec-val">Listrik</div></div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-snow"></i></div>
                            <div><div class="spec-label">AC</div><div class="spec-val">Full AC</div></div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-briefcase-fill"></i></div>
                            <div><div class="spec-label">Koper</div><div class="spec-val">2 Koper</div></div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-door-closed-fill"></i></div>
                            <div><div class="spec-label">Pintu</div><div class="spec-val">4 Pintu</div></div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <h2 class="section-title">Deskripsi Kendaraan</h2>
                    <p class="desc-text">
                        Tesla Model 3 dirancang untuk kinerja elektrik yang luar biasa, dengan akselerasi cepat dan jarak tempuh yang jauh. Dilengkapi dengan teknologi autopilot dan interior minimalis yang mewah, memberikan pengalaman berkendara masa depan yang tak tertandingi. Nikmati kenyamanan kabin yang senyap dan sistem hiburan tercanggih selama perjalanan Anda di dalam kota maupun luar kota.
                    </p>

                    <!-- Termasuk dalam sewa -->
                    <h2 class="section-title">Yang Termasuk Dalam Sewa</h2>
                    <div class="included-list">
                        <div class="included-item"><i class="bi bi-check-circle-fill included-icon"></i> Asuransi All-Risk</div>
                        <div class="included-item"><i class="bi bi-check-circle-fill included-icon"></i> Layanan Darurat 24/7</div>
                        <div class="included-item"><i class="bi bi-check-circle-fill included-icon"></i> Pembersihan Unit Rutin</div>
                        <div class="included-item"><i class="bi bi-check-circle-fill included-icon"></i> Pajak (PPN)</div>
                    </div>

                </div>

                <!-- ================= RIGHT COLUMN (STICKY) ================= -->
                <div class="col-lg-5 col-xl-4">
                    <div class="widget-wrapper">
                        <div class="booking-widget">
                            
                            <div class="price-header">
                                <div class="price-val">Rp 1.200.000 <span class="price-unit">/ hari</span></div>
                            </div>

                            <div class="date-picker">
                                <div class="date-box">
                                    <div class="date-label">Ambil</div>
                                    <div class="date-val"><i class="bi bi-calendar-event"></i> 12 Okt 2024</div>
                                </div>
                                <div class="date-box">
                                    <div class="date-label">Kembali</div>
                                    <div class="date-val"><i class="bi bi-calendar-check"></i> 15 Okt 2024</div>
                                </div>
                            </div>
                            <div class="total-days">3 Hari Total</div>

                            <div class="delivery-toggle">
                                <button class="delivery-btn active">Ambil Sendiri</button>
                                <button class="delivery-btn">Diantar (Gratis)</button>
                            </div>

                            <div class="price-breakdown">
                                <div class="breakdown-row"><span>Sewa 3 Hari</span><span>Rp 3.600.000</span></div>
                                <div class="breakdown-row"><span>Biaya Layanan</span><span>Rp 25.000</span></div>
                                <div class="breakdown-total"><span>Total</span><span>Rp 3.625.000</span></div>
                            </div>

                            <button class="btn-booking">Booking Sekarang</button>

                            <div class="trust-signals">
                                <div class="trust-item"><i class="bi bi-shield-lock-fill"></i> Pembayaran Aman</div>
                                <div class="trust-item"><i class="bi bi-person-check-fill"></i> KTP Terverifikasi</div>
                            </div>

                            <!-- Suggestion: Pickup Location -->
                            <div class="pickup-location">
                                <i class="bi bi-geo-alt-fill"></i>
                                <div>
                                    <div class="loc-title">Lokasi Penjemputan</div>
                                    <div class="loc-desc">AutoRent Hub, Sudirman Central Business District (SCBD), Jakarta Selatan.</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div> <!-- End Row -->

            <!-- ================= RELATED CARS ================= -->
            <div class="related-section">
                <h2 class="section-title mt-0">Mobil Lainnya Yang Tersedia</h2>
                <div class="row g-4">
                    
                    <!-- Card 1 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="car-card">
                            <div class="car-img-wrap">
                                <div class="car-img-inner">
                                    <img src="{{ asset('img/bmw_series5.png') }}" alt="BMW Series 5">
                                </div>
                                <span class="status-badge status-available">Tersedia</span>
                            </div>
                            <div class="car-body">
                                <div class="car-card-brand-year">BMW • 2023</div>
                                <h3 class="car-name">BMW 5 Series</h3>
                                <div class="car-specs">
                                    <div class="car-spec-item"><i class="bi bi-people-fill"></i> 5 Kursi</div>
                                    <div class="car-spec-item"><i class="bi bi-gear"></i> Otomatis</div>
                                    <div class="car-spec-item"><i class="bi bi-fuel-pump"></i> Bensin</div>
                                </div>
                                <div class="car-footer">
                                    <div>
                                        <div class="car-price-label">Harga Sewa</div>
                                        <span class="car-price-value">Rp 1.8jt</span>
                                        <span class="car-price-per">/hari</span>
                                    </div>
                                    <a href="/detail" class="btn-car-detail text-decoration-none">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="car-card">
                            <div class="car-img-wrap">
                                <div class="car-img-inner">
                                    <img src="{{ asset('img/land_rover_vogue.png') }}" alt="Land Rover Vogue">
                                </div>
                                <span class="status-badge status-available">Tersedia</span>
                            </div>
                            <div class="car-body">
                                <div class="car-card-brand-year">Land Rover • 2022</div>
                                <h3 class="car-name">Range Rover Vogue</h3>
                                <div class="car-specs">
                                    <div class="car-spec-item"><i class="bi bi-people-fill"></i> 5 Kursi</div>
                                    <div class="car-spec-item"><i class="bi bi-gear"></i> Otomatis</div>
                                    <div class="car-spec-item"><i class="bi bi-fuel-pump"></i> Bensin</div>
                                </div>
                                <div class="car-footer">
                                    <div>
                                        <div class="car-price-label">Harga Sewa</div>
                                        <span class="car-price-value">Rp 3.5jt</span>
                                        <span class="car-price-per">/hari</span>
                                    </div>
                                    <a href="/detail" class="btn-car-detail text-decoration-none">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="car-card">
                            <div class="car-img-wrap">
                                <div class="car-img-inner">
                                    <img src="{{ asset('img/mini_cooper_s.png') }}" alt="Mini Cooper S">
                                </div>
                                <span class="status-badge status-available">Tersedia</span>
                            </div>
                            <div class="car-body">
                                <div class="car-card-brand-year">Mini • 2023</div>
                                <h3 class="car-name">Mini Cooper S</h3>
                                <div class="car-specs">
                                    <div class="car-spec-item"><i class="bi bi-people-fill"></i> 4 Kursi</div>
                                    <div class="car-spec-item"><i class="bi bi-gear"></i> Otomatis</div>
                                    <div class="car-spec-item"><i class="bi bi-fuel-pump"></i> Bensin</div>
                                </div>
                                <div class="car-footer">
                                    <div>
                                        <div class="car-price-label">Harga Sewa</div>
                                        <span class="car-price-value">Rp 1.1jt</span>
                                        <span class="car-price-per">/hari</span>
                                    </div>
                                    <a href="/detail" class="btn-car-detail text-decoration-none">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

    <!-- ===================== FOOTER ===================== -->
    <footer class="py-5">
        <div class="container-xl px-4 px-md-5">
            <div class="row g-5 mb-5">
                <div class="col-12 col-md-4">
                    <div class="footer-brand d-flex align-items-center gap-2 mb-3">
                        <div class="logo-box" style="width: 32px; height: 32px; background: #4f46e5; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <svg width="18" height="16" viewBox="0 0 24 20" fill="none"><path d="M21 8H19.5L17.5 3C17.19 2.4 16.56 2 15.86 2H8.14C7.44 2 6.81 2.4 6.5 3L4.5 8H3C2.45 8 2 8.45 2 9C2 9.55 2.45 10 3 10H3.5L3 10.5V17C3 17.55 3.45 18 4 18H5C5.55 18 6 17.55 6 17V16H18V17C18 17.55 18.45 18 19 18H20C20.55 18 21 17.55 21 17V10.5L20.5 10H21C21.55 10 22 9.55 22 9C22 8.45 21.55 8 21 8ZM7.5 13C6.67 13 6 12.33 6 11.5C6 10.67 6.67 10 7.5 10C8.33 10 9 10.67 9 11.5C9 12.33 8.33 13 7.5 13ZM16.5 13C15.67 13 15 12.33 15 11.5C15 10.67 15.67 10 16.5 10C17.33 10 18 10.67 18 11.5C18 12.33 17.33 13 16.5 13ZM5 8L7.5 3H16.5L19 8H5Z" fill="white"/></svg>
                        </div>
                        <span>AutoRent</span>
                    </div>
                    <p class="footer-desc">Platform sewa mobil modern dengan standar kenyamanan dan kepercayaan tertinggi di Indonesia.</p>
                </div>
                <div class="col-6 col-md-2">
                    <div class="footer-heading">Perusahaan</div>
                    <a href="#" class="footer-link">Tentang Kami</a><a href="#" class="footer-link">Karir</a><a href="#" class="footer-link">Blog</a><a href="#" class="footer-link">Hubungi Kami</a>
                </div>
                <div class="col-6 col-md-2">
                    <div class="footer-heading">Layanan</div>
                    <a href="#" class="footer-link">Sewa Harian</a><a href="#" class="footer-link">Sewa Korporasi</a><a href="#" class="footer-link">Lepas Kunci</a><a href="#" class="footer-link">Bantuan</a>
                </div>
                <div class="col-12 col-md-4">
                    <div class="footer-heading">Legal &amp; Sosial</div>
                    <a href="#" class="footer-link">Syarat &amp; Ketentuan</a><a href="#" class="footer-link">Kebijakan Privasi</a>
                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a><a href="#" class="social-icon"><i class="bi bi-instagram"></i></a><a href="#" class="social-icon"><i class="bi bi-facebook"></i></a><a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
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
        // Simple Thumbnail interaction
        document.querySelectorAll('.gallery-thumb').forEach(thumb => {
            thumb.addEventListener('click', function() {
                document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Simple Delivery Toggle
        document.querySelectorAll('.delivery-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.delivery-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>
