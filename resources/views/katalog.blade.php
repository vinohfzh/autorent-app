<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Katalog Armada AutoRent - Temukan pilihan mobil terbaik untuk perjalanan Anda.">
    <title>Katalog Armada - AutoRent</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * { -webkit-font-smoothing: antialiased; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; color: #111827; background-color: #f9fafb; overflow-x: hidden; }

        :root {
            --indigo-600: #4f46e5;
            --indigo-700: #4338ca;
            --indigo-50: #eef2ff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-500: #6b7280;
            --gray-900: #111827;
        }

        /* NAVBAR */
        #navbar {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid #f3f4f6;
            box-shadow: 0 2px 20px rgba(0,0,0,0.06);
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
        .btn-nav-plain {
            font-size: 0.875rem; font-weight: 500;
            color: #374151; border: none; background: none;
            text-decoration: none;
            transition: color 0.15s;
            padding: 0;
        }
        .btn-nav-plain:hover { color: var(--indigo-600); }
        .btn-nav-primary {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff; border: none;
            font-size: 0.875rem; font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .btn-nav-primary:hover { color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,0.35); }

        /* HEADER */
        .catalog-header {
            background: linear-gradient(180deg, #eef2ff 0%, #ffffff 100%);
            padding-top: 6rem;
            padding-bottom: 3rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .catalog-title { font-size: 2.5rem; font-weight: 800; color: var(--gray-900); letter-spacing: -0.03em; margin-bottom: 0.5rem; }
        .catalog-subtitle { color: var(--gray-500); font-size: 1.1rem; max-width: 580px; }
        .breadcrumb { margin-bottom: 1.25rem; font-size: 0.875rem; font-weight: 500; }
        .breadcrumb-item a { color: var(--indigo-600); text-decoration: none; }
        .breadcrumb-item.active { color: var(--gray-500); }
        .breadcrumb-item + .breadcrumb-item::before { content: "›"; font-size: 1.1rem; color: #9ca3af; }

        /* FILTER */
        .filter-section {
            background: #fff;
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            border: 1px solid #f3f4f6;
            margin-bottom: 2.5rem;
        }
        .btn-filter {
            background: #fff; border: 1.5px solid #e5e7eb;
            color: #374151; font-size: 0.8rem; font-weight: 600;
            padding: 0.5rem 1.1rem; border-radius: 50px;
            transition: all 0.2s; cursor: pointer;
        }
        .btn-filter:hover { border-color: #c7d2fe; color: var(--indigo-600); }
        .btn-filter.active { background: var(--indigo-50); color: var(--indigo-700); border-color: #c7d2fe; }

        /* CAR CARDS */
        .car-card {
            background: #fff;
            border: 1.5px solid #f3f4f6;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s;
            height: 100%;
            display: flex; flex-direction: column;
        }
        .car-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(79,70,229,0.1);
            border-color: #c7d2fe;
        }
        .car-img-wrap { padding: 8px; position: relative; }
        .car-img-inner {
            background: #f9fafb;
            border-radius: 14px;
            overflow: hidden;
            aspect-ratio: 16/10;
            display: flex; align-items: center; justify-content: center;
        }
        .car-img-inner img { width: 100%; height: 100%; object-fit: cover; }
        .car-img-placeholder { font-size: 3.5rem; color: #d1d5db; }

        .status-badge {
            position: absolute; top: 16px; right: 16px;
            border-radius: 50px; padding: 4px 12px;
            font-size: 0.72rem; font-weight: 700;
            display: inline-flex; align-items: center; gap: 6px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }
        .status-available { background: rgba(255,255,255,0.95); color: #059669; }
        .status-available::before { content: ""; width: 6px; height: 6px; background: #10b981; border-radius: 50%; display: inline-block; }
        .status-unavailable { background: rgba(243,244,246,0.95); color: #6b7280; }
        .status-unavailable::before { content: ""; width: 6px; height: 6px; background: #9ca3af; border-radius: 50%; display: inline-block; }

        .car-body { padding: 16px 20px 20px; display: flex; flex-direction: column; flex-grow: 1; }
        .car-kategori { font-size: 0.7rem; font-weight: 700; color: var(--indigo-600); text-transform: uppercase; letter-spacing: 0.07em; margin-bottom: 4px; }
        .car-name { font-size: 1.1rem; font-weight: 700; color: var(--gray-900); margin-bottom: 10px; line-height: 1.3; }
        .car-specs { display: flex; gap: 10px; margin-bottom: auto; flex-wrap: wrap; }
        .car-spec { display: flex; align-items: center; gap: 4px; font-size: 0.78rem; color: var(--gray-500); font-weight: 500; }
        .car-footer {
            display: flex; align-items: center; justify-content: space-between;
            padding-top: 14px; margin-top: 14px;
            border-top: 1px solid #f3f4f6;
        }
        .price-label { font-size: 0.62rem; font-weight: 700; color: #9ca3af; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 2px; }
        .price-value { font-size: 1.2rem; font-weight: 800; color: var(--indigo-600); }
        .price-per { font-size: 0.78rem; color: var(--gray-500); font-weight: 500; }
        .btn-car-detail {
            background: var(--indigo-600); color: #fff;
            border: none; border-radius: 50px;
            font-size: 0.82rem; font-weight: 600;
            padding: 8px 18px;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-car-detail:hover { background: var(--indigo-700); color: #fff; transform: translateY(-1px); }
        .btn-car-unavailable {
            background: #f3f4f6; color: #9ca3af;
            border: none; border-radius: 50px;
            font-size: 0.82rem; font-weight: 600;
            padding: 8px 18px;
            cursor: not-allowed;
        }

        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 5rem 2rem; }
        .empty-state-icon { font-size: 5rem; color: #d1d5db; margin-bottom: 1.5rem; }
        .empty-state h3 { font-weight: 700; color: var(--gray-900); margin-bottom: 0.75rem; }
        .empty-state p { color: var(--gray-500); max-width: 380px; margin: 0 auto 1.5rem; }

        /* FOOTER */
        footer { background: #f9fafb; border-top: 1px solid #e5e7eb; margin-top: 4rem; }
        .footer-brand span { font-size: 1.2rem; font-weight: 800; color: var(--indigo-600); }
        .footer-desc { font-size: 0.875rem; color: var(--gray-500); line-height: 1.65; max-width: 220px; }
        .footer-heading { font-size: 0.7rem; font-weight: 700; color: var(--gray-900); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1.25rem; }
        .footer-link { font-size: 0.875rem; color: var(--gray-500); text-decoration: none; display: block; margin-bottom: 0.75rem; transition: color 0.15s; }
        .footer-link:hover { color: var(--indigo-600); }
        .footer-bottom { border-top: 1px solid #e5e7eb; padding: 1.5rem 0; }
        .footer-copy { font-size: 0.875rem; color: var(--gray-500); }
    </style>
</head>
<body>

    <!-- ===================== NAVBAR ===================== -->
    <nav id="navbar" class="navbar navbar-expand-md fixed-top py-2">
        <div class="container-xl px-4 px-md-5">

            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <div class="logo-box">
                    <svg width="18" height="16" viewBox="0 0 24 20" fill="none">
                        <path d="M21 8H19.5L17.5 3C17.19 2.4 16.56 2 15.86 2H8.14C7.44 2 6.81 2.4 6.5 3L4.5 8H3C2.45 8 2 8.45 2 9C2 9.55 2.45 10 3 10H3.5L3 10.5V17C3 17.55 3.45 18 4 18H5C5.55 18 6 17.55 6 17V16H18V17C18 17.55 18.45 18 19 18H20C20.55 18 21 17.55 21 17V10.5L20.5 10H21C21.55 10 22 9.55 22 9C22 8.45 21.55 8 21 8ZM7.5 13C6.67 13 6 12.33 6 11.5C6 10.67 6.67 10 7.5 10C8.33 10 9 10.67 9 11.5C9 12.33 8.33 13 7.5 13ZM16.5 13C15.67 13 15 12.33 15 11.5C15 10.67 15.67 10 16.5 10C17.33 10 18 10.67 18 11.5C18 12.33 17.33 13 16.5 13ZM5 8L7.5 3H16.5L19 8H5Z" fill="white"/>
                    </svg>
                </div>
                <span>AutoRent</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false">
                <i class="bi bi-list fs-4 text-dark"></i>
            </button>

            <!-- Nav Links -->
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto gap-md-4 gap-2 py-3 py-md-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('katalog') }}">Katalog</a></li>
                    @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('riwayat') }}">Riwayat Sewa</a></li>
                    @endauth
                </ul>
                <div class="d-flex align-items-center gap-3 py-2 py-md-0">
                    @auth
                        <div class="dropdown">
                            <a href="#" class="btn-nav-plain dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width:30px;height:30px;background:var(--indigo-600);font-weight:700;font-size:13px;">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" style="border-radius:12px;">
                                <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2 text-muted"></i>Profil Saya</a></li>
                                <li><a class="dropdown-item py-2" href="{{ route('riwayat') }}"><i class="bi bi-clock-history me-2 text-muted"></i>Riwayat Sewa</a></li>
                                @if(Auth::user()->role === 'admin')
                                <li><a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2 text-muted"></i>Admin Panel</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" id="katalog-logout-form" class="d-none">@csrf</form>
                                    <a href="#" class="dropdown-item py-2 text-danger" onclick="event.preventDefault(); document.getElementById('katalog-logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn-nav-plain">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-nav-primary">Daftar Sekarang</a>
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
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Katalog Armada</li>
                </ol>
            </nav>
            <h1 class="catalog-title">Temukan Mobil Pilihanmu</h1>
            <p class="catalog-subtitle">Jelajahi koleksi kendaraan terawat kami untuk segala kebutuhan perjalanan Anda.</p>
        </div>
    </header>

    <!-- ===================== MAIN CONTENT ===================== -->
    <main class="py-5">
        <div class="container-xl px-4 px-md-5">

            <!-- Filter Kategori -->
            <div class="filter-section d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="text-muted fw-semibold me-1" style="font-size:0.85rem;">Kategori:</span>
                    <a href="{{ route('katalog') }}" class="btn-filter {{ !request('kategori') ? 'active' : '' }}">Semua</a>
                    @foreach($kategoris as $kat)
                        <a href="{{ route('katalog', ['kategori' => $kat->id]) }}" class="btn-filter {{ request('kategori') == $kat->id ? 'active' : '' }}">
                            {{ $kat->nama_kategori }}
                        </a>
                    @endforeach
                </div>
                <span class="text-muted" style="font-size:0.85rem;">
                    Menampilkan <strong>{{ $kendaraans->total() }}</strong> kendaraan
                </span>
            </div>

            <!-- Car Grid -->
            @if($kendaraans->isEmpty())
                <div class="empty-state">
                    <div class="empty-state-icon"><i class="bi bi-car-front"></i></div>
                    <h3>Belum Ada Kendaraan</h3>
                    <p>Saat ini belum ada kendaraan yang tersedia. Silakan coba lagi nanti atau hubungi kami.</p>
                    <a href="{{ route('home') }}" class="btn-nav-primary">Kembali ke Beranda</a>
                </div>
            @else
                <div class="row g-4">
                    @foreach($kendaraans as $k)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="car-card">
                            <!-- Image -->
                            <div class="car-img-wrap">
                                <div class="car-img-inner">
                                    @if($k->foto)
                                        <img src="{{ Storage::url($k->foto) }}" alt="{{ $k->nama_mobil }}" loading="lazy">
                                    @else
                                        <i class="bi bi-car-front-fill car-img-placeholder"></i>
                                    @endif
                                </div>
                                @if($k->status === 'tersedia')
                                    <span class="status-badge status-available">Tersedia</span>
                                @else
                                    <span class="status-badge status-unavailable">{{ ucfirst($k->status) }}</span>
                                @endif
                            </div>

                            <!-- Info -->
                            <div class="car-body">
                                <div class="car-kategori">{{ $k->merek }} &bull; {{ $k->kategori?->nama_kategori ?? 'Lainnya' }}</div>
                                <h3 class="car-name">{{ $k->nama_mobil }}</h3>
                                <div class="car-specs mb-3">
                                    <div class="car-spec"><i class="bi bi-credit-card-2-front"></i> {{ $k->plat_nomor }}</div>
                                    @if($k->keterangan)
                                        <div class="car-spec"><i class="bi bi-info-circle"></i> {{ Str::limit($k->keterangan, 30) }}</div>
                                    @endif
                                </div>
                                <div class="car-footer">
                                    <div>
                                        <div class="price-label">Harga Sewa</div>
                                        <span class="price-value">Rp {{ number_format($k->harga_sewa, 0, ',', '.') }}</span>
                                        <span class="price-per">/hari</span>
                                    </div>
                                    @if($k->status === 'tersedia')
                                        <a href="{{ route('detail', $k->id) }}" class="btn-car-detail">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    @else
                                        <span class="btn-car-unavailable">Tidak Tersedia</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($kendaraans->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $kendaraans->appends(request()->query())->links() }}
                </div>
                @endif
            @endif

        </div>
    </main>

    <!-- ===================== FOOTER ===================== -->
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
