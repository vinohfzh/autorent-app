<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Konfirmasi Pesanan - AutoRent">
    <title>Konfirmasi Pesanan - AutoRent</title>

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
        .navbar-brand .logo-box { width: 32px; height: 32px; background: var(--indigo-600); border-radius: 8px; display: flex; align-items: center; justify-content: center; }
        .navbar-brand span { font-size: 1.2rem; font-weight: 800; color: var(--indigo-600); letter-spacing: -0.5px; }
        .nav-link { font-size: 0.875rem; font-weight: 500; color: var(--gray-500) !important; padding: 0.25rem 0 !important; }
        .nav-link:hover { color: var(--gray-900) !important; }
        .btn-nav-login { font-size: 0.875rem; font-weight: 500; color: #374151; border: none; background: none; }
        .btn-nav-register { background: linear-gradient(135deg, #6366f1, #4f46e5); color: #fff; border: none; font-size: 0.875rem; font-weight: 500; padding: 0.5rem 1.5rem; border-radius: 50px; }

        /* ===== MAIN LAYOUT ===== */
        .page-content { padding-top: 7rem; padding-bottom: 5rem; }

        /* ===== STEP INDICATOR ===== */
        .step-indicator-wrapper { max-width: 600px; margin: 0 auto 3rem; position: relative; }
        .step-progress-bar { position: absolute; top: 20px; left: 10%; right: 10%; height: 3px; background: var(--gray-200); z-index: 1; }
        .step-progress-fill { position: absolute; top: 0; left: 0; height: 100%; background: var(--indigo-600); width: 50%; transition: width 0.3s ease; } /* 50% for step 2 */
        .step-items { display: flex; justify-content: space-between; position: relative; z-index: 2; }
        .step-item { display: flex; flex-direction: column; align-items: center; gap: 8px; }
        .step-circle { width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; transition: all 0.3s; background: #fff; border: 3px solid var(--gray-200); color: var(--gray-500); }
        .step-label { font-size: 0.85rem; font-weight: 600; color: var(--gray-500); }
        
        .step-item.active .step-circle { border-color: var(--indigo-600); color: var(--indigo-600); box-shadow: 0 0 0 4px var(--indigo-50); }
        .step-item.active .step-label { color: var(--indigo-600); }
        .step-item.completed .step-circle { background: var(--indigo-600); border-color: var(--indigo-600); color: #fff; }
        .step-item.completed .step-label { color: var(--gray-900); }

        /* ===== KONFIRMASI SECTION ===== */
        .conf-wrapper { max-width: 800px; margin: 0 auto; background: #fff; border-radius: 20px; padding: 3rem; border: 1px solid var(--gray-200); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); }
        .conf-title { font-size: 1.5rem; font-weight: 800; color: var(--gray-900); margin-bottom: 0.5rem; text-align: center; }
        .conf-subtitle { font-size: 0.95rem; color: var(--gray-500); text-align: center; margin-bottom: 2.5rem; }

        .data-group { margin-bottom: 2.5rem; }
        .data-group-title { font-size: 1.1rem; font-weight: 700; color: var(--gray-900); display: flex; align-items: center; gap: 8px; margin-bottom: 1.25rem; border-bottom: 1px solid var(--gray-200); padding-bottom: 0.5rem; }
        .data-group-title i { color: var(--indigo-600); }

        .data-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
        @media (max-width: 576px) { .data-grid { grid-template-columns: 1fr; } }
        
        .data-item-lbl { font-size: 0.75rem; font-weight: 700; color: var(--gray-500); text-transform: uppercase; margin-bottom: 0.25rem; letter-spacing: 0.05em; }
        .data-item-val { font-size: 1rem; font-weight: 600; color: var(--gray-900); }

        .car-review-card { display: flex; gap: 1.5rem; background: var(--gray-50); padding: 1.5rem; border-radius: 16px; align-items: center; }
        @media (max-width: 576px) { .car-review-card { flex-direction: column; align-items: flex-start; text-align: left; } }
        .car-review-img { width: 140px; border-radius: 12px; overflow: hidden; background: #fff; }
        .car-review-img img { width: 100%; height: auto; display: block; }
        
        .total-box { background: var(--indigo-50); border: 2px solid var(--indigo-600); border-radius: 16px; padding: 1.5rem 2rem; display: flex; justify-content: space-between; align-items: center; margin-top: 3rem; margin-bottom: 2rem; }
        @media (max-width: 576px) { .total-box { flex-direction: column; text-align: center; gap: 1rem; } }
        .total-lbl { font-size: 1.1rem; font-weight: 700; color: var(--indigo-700); margin: 0; }
        .total-val { font-size: 1.75rem; font-weight: 800; color: var(--indigo-600); margin: 0; }

        .terms-box { display: flex; gap: 12px; align-items: flex-start; background: #f9fafb; padding: 1.5rem; border-radius: 12px; border: 1px solid var(--gray-200); margin-bottom: 2.5rem; }
        .terms-box input[type="checkbox"] { width: 20px; height: 20px; accent-color: var(--indigo-600); margin-top: 2px; }
        .terms-box label { font-size: 0.9rem; color: var(--gray-500); line-height: 1.5; cursor: pointer; }
        .terms-box a { color: var(--indigo-600); font-weight: 600; text-decoration: none; }

        .action-bar { display: flex; justify-content: space-between; align-items: center; gap: 1rem; }
        @media (max-width: 576px) { .action-bar { flex-direction: column-reverse; } .action-bar .btn { width: 100%; } }
        
        .btn-outline { border: 2px solid var(--gray-200); color: var(--gray-900); background: transparent; padding: 0.875rem 2rem; font-weight: 600; border-radius: 50px; transition: all 0.2s; text-decoration: none; display: inline-block; }
        .btn-outline:hover { background: var(--gray-100); border-color: var(--gray-300); }
        
        .btn-primary-solid { background: linear-gradient(135deg, #6366f1, #4f46e5); color: #fff; border: none; padding: 0.875rem 2.5rem; font-size: 1.05rem; font-weight: 700; border-radius: 50px; transition: all 0.2s; box-shadow: 0 4px 12px rgba(79,70,229,0.25); text-decoration: none; display: inline-block; }
        .btn-primary-solid:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(79,70,229,0.35); color: #fff; }

        /* ===== FOOTER ===== */
        footer { background: #f9fafb; border-top: 1px solid #e5e7eb; margin-top: 0; }
        .footer-brand span { font-size: 1.2rem; font-weight: 800; color: var(--indigo-600); }
        .footer-link { font-size: 0.875rem; color: var(--gray-500); text-decoration: none; display: block; transition: color 0.15s; }
        .footer-link:hover { color: var(--indigo-600); }
        .footer-copy { font-size: 0.875rem; color: var(--gray-500); }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav id="navbar" class="navbar navbar-expand-md fixed-top py-2">
        <div class="container-xl px-4 px-md-5">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <div class="logo-box">
                    <svg width="18" height="16" viewBox="0 0 24 20" fill="none"><path d="M21 8H19.5L17.5 3C17.19 2.4 16.56 2 15.86 2H8.14C7.44 2 6.81 2.4 6.5 3L4.5 8H3C2.45 8 2 8.45 2 9C2 9.55 2.45 10 3 10H3.5L3 10.5V17C3 17.55 3.45 18 4 18H5C5.55 18 6 17.55 6 17V16H18V17C18 17.55 18.45 18 19 18H20C20.55 18 21 17.55 21 17V10.5L20.5 10H21C21.55 10 22 9.55 22 9C22 8.45 21.55 8 21 8ZM7.5 13C6.67 13 6 12.33 6 11.5C6 10.67 6.67 10 7.5 10C8.33 10 9 10.67 9 11.5C9 12.33 8.33 13 7.5 13ZM16.5 13C15.67 13 15 12.33 15 11.5C15 10.67 15.67 10 16.5 10C17.33 10 18 10.67 18 11.5C18 12.33 17.33 13 16.5 13ZM5 8L7.5 3H16.5L19 8H5Z" fill="white"/></svg>
                </div>
                <span>AutoRent</span>
            </a>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto gap-md-4 gap-2 py-3 py-md-0">
                    <li class="nav-item"><a class="nav-link" href="/">Sewa Mobil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tentang Kami</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3 py-2 py-md-0">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-nav-login text-decoration-none">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-nav-login text-decoration-none">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-nav-register text-decoration-none">Daftar</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <main class="page-content">
        <div class="container-xl px-4 px-md-5">
            
            <!-- STEP INDICATOR -->
            <div class="step-indicator-wrapper">
                <div class="step-progress-bar">
                    <div class="step-progress-fill"></div>
                </div>
                <div class="step-items">
                    <div class="step-item completed">
                        <div class="step-circle"><i class="bi bi-check-lg"></i></div>
                        <div class="step-label">Data Diri</div>
                    </div>
                    <div class="step-item active">
                        <div class="step-circle">2</div>
                        <div class="step-label">Konfirmasi</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle">3</div>
                        <div class="step-label">Pembayaran</div>
                    </div>
                </div>
            </div>

            <div class="conf-wrapper">
                <h1 class="conf-title">Review Pesanan Anda</h1>
                <p class="conf-subtitle">Pastikan semua informasi di bawah ini sudah benar sebelum melanjutkan pembayaran.</p>

                <!-- Data Pemesan -->
                <div class="data-group">
                    <div class="data-group-title"><i class="bi bi-person-badge-fill"></i> Data Pemesan</div>
                    <div class="data-grid">
                        <div>
                            <div class="data-item-lbl">Nama Lengkap</div>
                            <div class="data-item-val">Andi Wijaya</div>
                        </div>
                        <div>
                            <div class="data-item-lbl">Email</div>
                            <div class="data-item-val">andi@email.com</div>
                        </div>
                        <div>
                            <div class="data-item-lbl">No. HP</div>
                            <div class="data-item-val">+62 812 3456 7890</div>
                        </div>
                        <div>
                            <div class="data-item-lbl">NIK (KTP)</div>
                            <div class="data-item-val">3273069009000001</div>
                        </div>
                    </div>
                </div>

                <!-- Detail Mobil -->
                <div class="data-group">
                    <div class="data-group-title"><i class="bi bi-car-front-fill"></i> Detail Mobil</div>
                    <div class="car-review-card">
                        <div class="car-review-img">
                            <img src="{{ asset('img/tesla_model3.png') }}" alt="Tesla Model 3">
                        </div>
                        <div class="car-review-info">
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="data-item-lbl">Unit Mobil</div>
                                    <div class="data-item-val">Tesla Model 3 (Standard Range Plus)</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="data-item-lbl">Durasi Sewa</div>
                                    <div class="data-item-val">12 - 15 Okt 2024 (3 Hari)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metode Pengambilan -->
                <div class="data-group">
                    <div class="data-group-title"><i class="bi bi-geo-alt-fill"></i> Metode Pengambilan</div>
                    <div>
                        <div class="data-item-lbl">Lokasi Penjemputan</div>
                        <div class="data-item-val">Ambil Sendiri - Kantor Pusat AutoRent (SCBD, Jakarta Selatan)</div>
                    </div>
                </div>

                <!-- Total -->
                <div class="total-box">
                    <h3 class="total-lbl">Total Pembayaran</h3>
                    <h2 class="total-val">Rp 3.625.000</h2>
                </div>

                <!-- Terms -->
                <div class="terms-box">
                    <input type="checkbox" id="terms" name="terms">
                    <label for="terms">
                        Saya menyetujui <a href="#">Syarat &amp; Ketentuan</a> yang berlaku di AutoRent, termasuk kebijakan pembatalan dan asuransi kendaraan yang telah disediakan.
                    </label>
                </div>

                <!-- Actions -->
                <div class="action-bar">
                    <a href="/checkout" class="btn-outline">Kembali</a>
                    <a href="/checkout-pembayaran" class="btn-primary-solid" id="btnBayar">Konfirmasi &amp; Bayar <i class="bi bi-arrow-right ms-2"></i></a>
                </div>

            </div>

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="py-4 mt-5">
        <div class="container-xl px-4 px-md-5">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0 d-flex align-items-center gap-3">
                    <div class="footer-brand d-flex align-items-center gap-2"><span>AutoRent</span></div>
                    <p class="footer-copy mb-0">© 2024 AutoRent. Semua Hak Dilindungi.</p>
                </div>
                <div class="col-md-6 d-flex justify-content-md-end gap-4 flex-wrap">
                    <a href="#" class="footer-link mb-0">Syarat &amp; Ketentuan</a>
                    <a href="#" class="footer-link mb-0">Kebijakan Privasi</a>
                    <a href="#" class="footer-link mb-0">Bantuan</a>
                    <a href="#" class="footer-link mb-0">Kontak</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('btnBayar').addEventListener('click', function(e) {
            const cb = document.getElementById('terms');
            if(!cb.checked) {
                e.preventDefault();
                alert('Silakan setujui Syarat & Ketentuan terlebih dahulu.');
                cb.parentElement.style.borderColor = 'red';
            }
        });
        document.getElementById('terms').addEventListener('change', function() {
            if(this.checked) {
                this.parentElement.style.borderColor = 'var(--gray-200)';
            }
        });
    </script>
</body>
</html>
