<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Sewa - AutoRent</title>

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

        :root {
            --indigo-600: #4f46e5;
            --indigo-700: #4338ca;
            --indigo-50: #eef2ff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
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
        .navbar-brand .brand-logo-box {
            width: 32px; height: 32px;
            background: var(--indigo-600);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }
        .navbar-brand .brand-text { font-size: 1.2rem; font-weight: 800; color: var(--indigo-600); letter-spacing: -0.5px; }
        .nav-link {
            font-size: 0.875rem; font-weight: 500;
            color: var(--gray-500) !important;
            transition: color 0.15s ease;
            padding: 0.25rem 0 !important;
        }
        .nav-link:hover { color: var(--gray-900) !important; }
        .nav-link.active { color: var(--indigo-600) !important; border-bottom: 2px solid var(--indigo-600); }

        .page-content { padding-top: 6.5rem; padding-bottom: 5rem; min-height: calc(100vh - 300px); }

        /* ===== RIWAYAT STYLES ===== */
        .booking-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: all 0.25s ease; }
        .booking-card:hover { border-color: #c7d2fe; box-shadow: 0 8px 24px rgba(79,70,229,0.08); transform: translateY(-2px); }
        .bc-img-box { width: 100px; height: 75px; background: #f9fafb; border-radius: 12px; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid #f3f4f6; }
        .bc-img-box img { width: 100%; height: 100%; object-fit: cover; }
        .bc-img-placeholder { font-size: 2rem; color: #d1d5db; }
        .bc-price { font-size: 1.1rem; font-weight: 700; color: var(--indigo-600); }
        .status-badge { padding: 4px 12px; border-radius: 50px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block; }
        .status-aktif { background: #e0e7ff; color: #4338ca; }
        .status-selesai { background: #d1fae5; color: #047857; }
        .status-dibatalkan { background: #fee2e2; color: #b91c1c; }
        .bc-toggle-btn { background: none; border: none; color: var(--indigo-600); font-weight: 600; font-size: 0.875rem; padding: 0; text-decoration: none; transition: opacity 0.2s; cursor: pointer; }
        .bc-toggle-btn:hover { opacity: 0.75; }
        .bc-collapse-body { border-top: 1px dashed #e5e7eb; margin-top: 1.25rem; padding-top: 1.25rem; }
        .filter-btn { padding: 0.45rem 1.1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; background: #f3f4f6; color: #6b7280; border: 1.5px solid transparent; cursor: pointer; transition: all 0.2s; white-space: nowrap; }
        .filter-btn:hover { background: #e5e7eb; color: #111827; }
        .filter-btn.active { background: var(--indigo-50); color: var(--indigo-700); border-color: #c7d2fe; }
        .btn-action-primary { background: var(--indigo-600); color: #fff; border: none; font-size: 0.875rem; font-weight: 600; padding: 0.55rem 1.1rem; border-radius: 50px; text-decoration: none; transition: all 0.2s; display: inline-block; }
        .btn-action-primary:hover { background: var(--indigo-700); color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,0.2); }
        .btn-action-secondary { background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; font-size: 0.875rem; font-weight: 600; padding: 0.55rem 1.1rem; border-radius: 50px; text-decoration: none; transition: all 0.2s; display: inline-block; }
        .btn-action-secondary:hover { background: #e5e7eb; color: #111827; }

        @media (min-width: 576px) {
            .w-sm-auto { width: auto !important; }
        }
        @media (max-width: 575.98px) {
            .booking-card { padding: 1.25rem; }
            .bc-img-box { width: 80px; height: 60px; }
            .bc-price { font-size: 1rem; }
            .status-badge { font-size: 0.65rem; }
        }
    </style>
</head>
<body>

    <!-- ===================== NAVBAR ===================== -->
    <nav id="navbar" class="navbar navbar-expand-md fixed-top py-2">
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
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false">
                <i class="bi bi-list fs-4 text-dark"></i>
            </button>

            <!-- Nav Links -->
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto gap-md-4 gap-2 py-3 py-md-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('katalog') }}">Katalog</a></li>
                    @auth
                    <li class="nav-item"><a class="nav-link active fw-bold text-indigo" href="{{ route('riwayat') }}">Riwayat Sewa</a></li>
                    @endauth
                </ul>
                <div class="d-flex align-items-center gap-3 py-2 py-md-0">
                    @auth
                        <div class="dropdown">
                            <a href="#" class="btn-nav-plain dropdown-toggle d-flex align-items-center gap-2 text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width:30px;height:30px;background:var(--indigo-600);font-weight:700;font-size:13px;">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="fw-medium text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" style="border-radius:12px;">
                                <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2 text-muted"></i>Profil Saya</a></li>
                                <li><a class="dropdown-item py-2" href="{{ route('riwayat') }}"><i class="bi bi-clock-history me-2 text-muted"></i>Riwayat Sewa</a></li>
                                @if(Auth::user()->role === 'admin')
                                <li><a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2 text-muted"></i>Admin Panel</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" id="riwayat-logout-form" class="d-none">@csrf</form>
                                    <a href="#" class="dropdown-item py-2 text-danger" onclick="event.preventDefault(); document.getElementById('riwayat-logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn-nav-plain text-decoration-none" style="font-size: 0.875rem; font-weight: 500; color: #374151; transition: color 0.15s;">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-nav-register text-decoration-none" style="background: linear-gradient(135deg, #6366f1, #4f46e5); color: #fff; font-size: 0.875rem; font-weight: 500; padding: 0.5rem 1.5rem; border-radius: 50px;">Daftar Sekarang</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- ===================== PAGE CONTENT ===================== -->
    <main class="page-content">
        <div class="container-xl px-4 px-md-5">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9">

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h2 class="fw-bold fs-3 mb-0 text-dark">Riwayat Sewa</h2>
                    </div>

                    <!-- Flash Message -->
                    @if (session('success'))
                        <div class="alert alert-success d-flex align-items-center gap-2 mb-4 rounded-4 border-0 shadow-sm" role="alert">
                            <i class="bi bi-check-circle-fill flex-shrink-0 text-success fs-5"></i>
                            <div class="fw-medium">{{ session('success') }}</div>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success d-flex align-items-center gap-2 mb-4 rounded-4 border-0 shadow-sm" role="alert">
                            <i class="bi bi-check-circle-fill flex-shrink-0 text-success fs-5"></i>
                            <div class="fw-medium">{{ session('status') }}</div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger d-flex align-items-center gap-2 mb-4 rounded-4 border-0 shadow-sm" role="alert">
                            <i class="bi bi-exclamation-circle-fill flex-shrink-0 text-danger fs-5"></i>
                            <div class="fw-medium">{{ session('error') }}</div>
                        </div>
                    @endif

                    <!-- Filter Tabs -->
                    <div class="d-flex gap-2 flex-wrap mb-4">
                        <button class="filter-btn active" data-filter="all">Semua</button>
                        <button class="filter-btn" data-filter="aktif">Aktif</button>
                        <button class="filter-btn" data-filter="selesai">Selesai</button>
                        <button class="filter-btn" data-filter="dibatalkan">Dibatalkan</button>
                    </div>

                    @if($transaksis->isEmpty())
                        <!-- Empty State -->
                        <div class="text-center py-5 bg-white rounded-4 border">
                            <i class="bi bi-calendar-x text-muted mb-3 d-block" style="font-size: 4rem; opacity: 0.4;"></i>
                            <h5 class="fw-bold text-dark mb-2">Belum Ada Riwayat Sewa</h5>
                            <p class="text-muted mb-4">Anda belum pernah melakukan pemesanan. Mulai eksplorasi armada terbaik kami sekarang!</p>
                            <a href="{{ route('katalog') }}" class="btn-action-primary text-decoration-none px-4 py-2">
                                <i class="bi bi-search me-2"></i>Cari Mobil
                            </a>
                        </div>
                    @else
                        <!-- Booking Cards -->
                        <div id="booking-list">
                            @foreach($transaksis as $index => $t)
                            <div class="booking-card mb-3" data-status="{{ $t->status }}">
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start gap-3">
                                    <!-- Left: Car Info -->
                                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                                        <div class="bc-img-box">
                                            @if($t->kendaraan && $t->kendaraan->foto)
                                                <img src="{{ Storage::url($t->kendaraan->foto) }}" alt="{{ $t->kendaraan->nama_mobil }}">
                                            @else
                                                <i class="bi bi-car-front bc-img-placeholder"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="fw-bold mb-1" style="font-size: 1.1rem; color: var(--gray-900);">
                                                {{ $t->kendaraan ? $t->kendaraan->nama_mobil : 'Kendaraan tidak ditemukan' }}
                                            </h3>
                                            <p class="text-muted small mb-1">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ \Carbon\Carbon::parse($t->tgl_mulai)->format('d M Y') }}
                                                –
                                                {{ \Carbon\Carbon::parse($t->tgl_selesai)->format('d M Y') }}
                                                <span class="ms-1 fw-medium" style="color: var(--indigo-600);">({{ $t->total_hari }} hari)</span>
                                            </p>
                                            <p class="text-muted mb-0" style="font-size: 0.75rem; letter-spacing: 0.04em;">
                                                ID: #{{ str_pad($t->id, 7, '0', STR_PAD_LEFT) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Right: Price, Status, Toggle -->
                                    <div class="d-flex flex-row flex-sm-column align-items-center align-items-sm-end justify-content-between gap-2 flex-shrink-0 w-100 w-sm-auto mt-3 mt-sm-0">
                                        <div class="bc-price">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</div>
                                        <span class="status-badge status-{{ $t->status }}">
                                            {{ ucfirst($t->status) }}
                                        </span>
                                        <button class="bc-toggle-btn" data-bs-toggle="collapse" data-bs-target="#detail{{ $t->id }}" aria-expanded="false">
                                            Detail
                                        </button>
                                    </div>
                                </div>

                                <!-- Collapsible Detail -->
                                <div class="collapse" id="detail{{ $t->id }}">
                                    <div class="bc-collapse-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <h6 class="fw-bold small text-muted text-uppercase mb-3" style="letter-spacing: 0.08em;">Informasi Kendaraan</h6>
                                                <div class="d-flex align-items-start gap-2 mb-2">
                                                    <i class="bi bi-car-front mt-1" style="color: var(--indigo-600);"></i>
                                                    <div>
                                                        <div class="small fw-medium text-dark">{{ $t->kendaraan ? $t->kendaraan->nama_mobil : '-' }}</div>
                                                        <div class="small text-muted">{{ $t->kendaraan ? ($t->kendaraan->merek . ' · ' . ($t->kendaraan->kategori?->nama_kategori ?? 'Umum')) : '-' }}</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-start gap-2 mb-2">
                                                    <i class="bi bi-credit-card mt-1" style="color: var(--indigo-600);"></i>
                                                    <div>
                                                        <div class="small fw-medium text-dark">Biaya Sewa</div>
                                                        <div class="small text-muted">Rp {{ $t->kendaraan ? number_format($t->kendaraan->harga_sewa, 0, ',', '.') : '-' }} / hari × {{ $t->total_hari }} hari</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold small text-muted text-uppercase mb-3" style="letter-spacing: 0.08em;">Informasi Pelanggan</h6>
                                                <div class="d-flex align-items-start gap-2 mb-2">
                                                    <i class="bi bi-person mt-1" style="color: var(--indigo-600);"></i>
                                                    <div>
                                                        <div class="small fw-medium text-dark">{{ $t->pelanggan ? $t->pelanggan->nama : '-' }}</div>
                                                        <div class="small text-muted">{{ $t->pelanggan ? $t->pelanggan->no_hp : '-' }}</div>
                                                    </div>
                                                </div>
                                                @if($t->pembayaran)
                                                <div class="d-flex align-items-start gap-2 mb-2">
                                                    <i class="bi bi-receipt mt-1" style="color: var(--indigo-600);"></i>
                                                    <div>
                                                        <div class="small fw-medium text-dark">Pembayaran</div>
                                                        <div class="small text-muted">
                                                            {{ strtoupper($t->pembayaran->metode) }} –
                                                            <span class="fw-bold {{ $t->pembayaran->status_bayar === 'lunas' ? 'text-success' : 'text-warning' }}">
                                                                {{ ucfirst(str_replace('_', ' ', $t->pembayaran->status_bayar)) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="d-flex align-items-start gap-2 mb-2">
                                                    <i class="bi bi-exclamation-circle text-warning mt-1"></i>
                                                    <div class="small text-warning fw-medium">Belum ada pembayaran</div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="d-flex justify-content-end align-items-center gap-2 mt-3 pt-3 border-top">
                                            @if($t->status === 'aktif' && !$t->pembayaran)
                                                <a href="{{ route('pembayaran.create', $t->id) }}" class="btn-action-primary">
                                                    <i class="bi bi-credit-card me-2"></i>Bayar Sekarang
                                                </a>
                                            @elseif($t->status === 'selesai')
                                                <a href="{{ route('katalog') }}" class="btn-action-secondary">
                                                    <i class="bi bi-arrow-repeat me-2"></i>Sewa Lagi
                                                </a>
                                            @elseif($t->status === 'aktif' && $t->pembayaran)
                                                <span class="text-muted small fw-medium"><i class="bi bi-clock-history me-1"></i>Menunggu Konfirmasi Admin</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($transaksis->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $transaksis->links() }}
                        </div>
                        @endif
                    @endif

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
                        <span style="font-size: 1.2rem; font-weight: 800; color: #4f46e5;">AutoRent</span>
                    </div>
                    <p class="footer-desc" style="font-size: 0.875rem; color: #6b7280; line-height: 1.65; max-width: 220px;">Platform sewa mobil modern dengan standar kenyamanan dan kepercayaan tertinggi di Indonesia.</p>
                </div>
                <div class="col-6 col-md-2">
                    <div style="font-size: 0.7rem; font-weight: 700; color: #111827; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1.25rem;">Perusahaan</div>
                    <a href="#" style="font-size: 0.875rem; color: #6b7280; text-decoration: none; display: block; margin-bottom: 0.75rem;">Tentang Kami</a>
                    <a href="#" style="font-size: 0.875rem; color: #6b7280; text-decoration: none; display: block; margin-bottom: 0.75rem;">Karir</a>
                    <a href="#" style="font-size: 0.875rem; color: #6b7280; text-decoration: none; display: block; margin-bottom: 0.75rem;">Blog</a>
                    <a href="#" style="font-size: 0.875rem; color: #6b7280; text-decoration: none; display: block; margin-bottom: 0.75rem;">Hubungi Kami</a>
                </div>
                <div class="col-6 col-md-2">
                    <div style="font-size: 0.7rem; font-weight: 700; color: #111827; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1.25rem;">Layanan</div>
                    <a href="#" style="font-size: 0.875rem; color: #6b7280; text-decoration: none; display: block; margin-bottom: 0.75rem;">Sewa Harian</a>
                    <a href="#" style="font-size: 0.875rem; color: #6b7280; text-decoration: none; display: block; margin-bottom: 0.75rem;">Sewa Korporasi</a>
                    <a href="#" style="font-size: 0.875rem; color: #6b7280; text-decoration: none; display: block; margin-bottom: 0.75rem;">Lepas Kunci</a>
                    <a href="#" style="font-size: 0.875rem; color: #6b7280; text-decoration: none; display: block; margin-bottom: 0.75rem;">Bantuan</a>
                </div>
                <div class="col-12 col-md-4">
                    <div style="font-size: 0.7rem; font-weight: 700; color: #111827; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1.25rem;">Legal &amp; Sosial</div>
                    <a href="#" style="font-size: 0.875rem; color: #6b7280; text-decoration: none; display: block; margin-bottom: 0.75rem;">Syarat &amp; Ketentuan</a>
                    <a href="#" style="font-size: 0.875rem; color: #6b7280; text-decoration: none; display: block; margin-bottom: 0.75rem;">Kebijakan Privasi</a>
                </div>
            </div>
            <div style="border-top: 1px solid #e5e7eb; padding: 1.5rem 0; text-align: center;">
                <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0;">© {{ date('Y') }} AutoRent Car Rental. Seluruh hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const filter = this.dataset.filter;
                document.querySelectorAll('#booking-list .booking-card').forEach(card => {
                    if (filter === 'all' || card.dataset.status === filter) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Toggle button text
        document.querySelectorAll('.bc-toggle-btn').forEach(btn => {
            const target = document.querySelector(btn.dataset.bsTarget);
            if (target) {
                target.addEventListener('show.bs.collapse', () => { btn.textContent = 'Tutup'; });
                target.addEventListener('hide.bs.collapse', () => { btn.textContent = 'Detail'; });
            }
        });
    </script>
</body>
</html>
