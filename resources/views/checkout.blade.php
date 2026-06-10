<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Informasi Pemesanan - AutoRent">
    <title>Checkout - AutoRent</title>

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
        
        .btn-nav-login { font-size: 0.875rem; font-weight: 500; color: #374151; border: none; background: none; transition: color 0.15s ease; }
        .btn-nav-login:hover { color: var(--indigo-600); }
        .btn-nav-register {
            background: linear-gradient(135deg, #6366f1, #4f46e5); color: #fff; border: none;
            font-size: 0.875rem; font-weight: 500; padding: 0.5rem 1.5rem; border-radius: 50px;
            transition: all 0.2s ease; box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .btn-nav-register:hover { background: linear-gradient(135deg, #4f46e5, #4338ca); color: #fff; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,0.35); }

        /* ===== MAIN LAYOUT ===== */
        .page-content { padding-top: 7rem; padding-bottom: 5rem; }

        /* ===== STEP INDICATOR ===== */
        .step-indicator-wrapper { max-width: 600px; margin: 0 auto 3rem; position: relative; }
        .step-progress-bar { position: absolute; top: 20px; left: 10%; right: 10%; height: 3px; background: var(--gray-200); z-index: 1; }
        .step-progress-fill { position: absolute; top: 0; left: 0; height: 100%; background: var(--indigo-600); width: 0%; transition: width 0.3s ease; } /* 0% for step 1 */
        .step-items { display: flex; justify-content: space-between; position: relative; z-index: 2; }
        .step-item { display: flex; flex-direction: column; align-items: center; gap: 8px; }
        .step-circle { width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; transition: all 0.3s; background: #fff; border: 3px solid var(--gray-200); color: var(--gray-500); }
        .step-label { font-size: 0.85rem; font-weight: 600; color: var(--gray-500); }
        
        .step-item.active .step-circle { border-color: var(--indigo-600); color: var(--indigo-600); box-shadow: 0 0 0 4px var(--indigo-50); }
        .step-item.active .step-label { color: var(--indigo-600); }
        .step-item.completed .step-circle { background: var(--indigo-600); border-color: var(--indigo-600); color: #fff; }
        .step-item.completed .step-label { color: var(--gray-900); }

        /* ===== FORM SECTION ===== */
        .form-section { background: #fff; border-radius: 20px; padding: 2.5rem; border: 1px solid var(--gray-200); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); }
        .section-title { font-size: 1.25rem; font-weight: 700; color: var(--gray-900); margin-bottom: 1.5rem; }
        
        .form-label { font-size: 0.875rem; font-weight: 600; color: #4b5563; margin-bottom: 0.5rem; }
        .form-control { background-color: var(--gray-50); border: 1px solid var(--gray-200); border-radius: 12px; padding: 0.875rem 1rem; font-size: 0.95rem; transition: all 0.2s; }
        .form-control:focus { background-color: #fff; border-color: var(--indigo-600); box-shadow: 0 0 0 4px var(--indigo-50); outline: none; }
        .form-control::placeholder { color: #9ca3af; }

        /* Drag & Drop Upload */
        .upload-area { background-color: var(--gray-50); border: 2px dashed var(--gray-300); border-radius: 16px; padding: 2rem; text-align: center; cursor: pointer; transition: all 0.2s; }
        .upload-area:hover { border-color: var(--indigo-600); background-color: var(--indigo-50); }
        .upload-icon { font-size: 2.5rem; color: var(--indigo-600); margin-bottom: 0.5rem; }
        .upload-title { font-weight: 700; color: var(--gray-900); font-size: 1rem; margin-bottom: 0.25rem; }
        .upload-desc { font-size: 0.875rem; color: var(--gray-500); margin-bottom: 0; }

        /* Radio Cards */
        .radio-card-wrapper { display: flex; gap: 1rem; }
        @media (max-width: 576px) { .radio-card-wrapper { flex-direction: column; } }
        .radio-card { flex: 1; position: relative; border: 2px solid var(--gray-200); border-radius: 16px; padding: 1.25rem; cursor: pointer; transition: all 0.2s; background: #fff; display: flex; align-items: flex-start; gap: 12px; }
        .radio-card:hover { border-color: var(--gray-300); }
        .radio-card input[type="radio"] { position: absolute; opacity: 0; }
        .radio-card.selected { border-color: var(--indigo-600); background-color: var(--indigo-50); }
        .radio-icon { width: 40px; height: 40px; border-radius: 10px; background: var(--gray-100); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; color: var(--gray-500); transition: all 0.2s; flex-shrink: 0; }
        .radio-card.selected .radio-icon { background: var(--indigo-600); color: #fff; }
        .radio-title { font-weight: 700; color: var(--gray-900); font-size: 1rem; margin-bottom: 0.1rem; }
        .radio-desc { font-size: 0.8rem; color: var(--gray-500); }
        
        .radio-card.selected .radio-title { color: var(--indigo-700); }
        .radio-card.selected .radio-desc { color: var(--indigo-600); opacity: 0.8; }

        /* Button Action */
        .btn-continue { background: linear-gradient(135deg, #6366f1, #4f46e5); color: #fff; border: none; width: 100%; padding: 1.25rem; font-size: 1.1rem; font-weight: 700; border-radius: 16px; transition: all 0.2s; box-shadow: 0 4px 12px rgba(79,70,229,0.25); margin-top: 1rem; }
        .btn-continue:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(79,70,229,0.35); color: #fff; }

        /* ===== RIGHT COLUMN (STICKY SUMMARY) ===== */
        .summary-wrapper { position: sticky; top: 6.5rem; }
        .summary-card { background: #fff; border-radius: 20px; border: 1px solid var(--gray-200); box-shadow: 0 10px 25px rgba(0,0,0,0.05); overflow: hidden; }
        
        .summary-img-box { width: 100%; aspect-ratio: 16/9; background: var(--gray-50); position: relative; }
        .summary-img-box img { width: 100%; height: 100%; object-fit: cover; }
        
        .summary-body { padding: 1.5rem; }
        .summary-car-title { font-size: 1.25rem; font-weight: 800; color: var(--gray-900); margin-bottom: 0.25rem; }
        .summary-car-type { display: inline-flex; align-items: center; gap: 6px; font-size: 0.8rem; font-weight: 600; color: var(--gray-500); }
        
        .summary-dates { display: flex; gap: 1rem; margin-top: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px dashed var(--gray-200); }
        .date-col { flex: 1; }
        .date-lbl { font-size: 0.75rem; font-weight: 700; color: var(--gray-500); text-transform: uppercase; margin-bottom: 0.25rem; }
        .date-val { font-size: 0.95rem; font-weight: 700; color: var(--gray-900); }

        .summary-price-box { padding: 1.5rem 0; }
        .price-row { display: flex; justify-content: space-between; font-size: 0.95rem; color: var(--gray-500); margin-bottom: 0.75rem; font-weight: 500; }
        .price-total { display: flex; justify-content: space-between; font-size: 1.25rem; font-weight: 800; color: var(--gray-900); padding-top: 1rem; border-top: 1px solid var(--gray-200); margin-top: 0.5rem; }
        
        .summary-note { background: var(--indigo-50); padding: 1rem; display: flex; gap: 12px; align-items: flex-start; }
        .summary-note i { color: var(--indigo-600); font-size: 1.25rem; margin-top: -2px; }
        .summary-note p { margin: 0; font-size: 0.8rem; font-weight: 500; color: #4338ca; line-height: 1.5; }

        /* ===== FOOTER ===== */
        footer { background: #f9fafb; border-top: 1px solid #e5e7eb; margin-top: 0; }
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

    <!-- ===================== PAGE CONTENT ===================== -->
    <main class="page-content">
        <div class="container-xl px-4 px-md-5">
            
            <!-- STEP INDICATOR -->
            <div class="step-indicator-wrapper">
                <div class="step-progress-bar">
                    <div class="step-progress-fill"></div>
                </div>
                <div class="step-items">
                    <div class="step-item active">
                        <div class="step-circle">1</div>
                        <div class="step-label">Informasi</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle">2</div>
                        <div class="step-label">Konfirmasi</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle">3</div>
                        <div class="step-label">Pembayaran</div>
                    </div>
                </div>
            </div>

            <div class="row g-5">
                
                <!-- ================= LEFT COLUMN ================= -->
                <div class="col-lg-7 col-xl-8">
                    <div class="form-section">
                        
                        <!-- Informasi Pemesan -->
                        <h2 class="section-title">Informasi Pemesan</h2>
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" placeholder="Contoh: Andi Wijaya">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="andi@email.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Handphone</label>
                                <input type="text" class="form-control" placeholder="+62 812 3456 7890">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIK (Nomor Induk Kependudukan)</label>
                                <input type="text" class="form-control" placeholder="16 Digit Nomor Induk Kependudukan">
                            </div>
                        </div>

                        <!-- Dokumen Identitas -->
                        <h2 class="section-title">Dokumen Identitas</h2>
                        <div class="mb-5">
                            <div class="upload-area">
                                <i class="bi bi-cloud-arrow-up upload-icon"></i>
                                <div class="upload-title">Upload KTP</div>
                                <p class="upload-desc">Tarik file ke sini atau klik untuk memilih file.<br>Mendukung JPG, PNG, atau PDF (Maks. 5MB)</p>
                            </div>
                        </div>

                        <!-- Metode Pengiriman -->
                        <h2 class="section-title">Metode Pengiriman</h2>
                        <div class="radio-card-wrapper mb-5">
                            <!-- Option 1 -->
                            <label class="radio-card selected" onclick="selectRadio(this)">
                                <input type="radio" name="delivery" value="pickup" checked>
                                <div class="radio-icon"><i class="bi bi-shop"></i></div>
                                <div>
                                    <div class="radio-title">Ambil Sendiri</div>
                                    <div class="radio-desc">Ambil di pool terdekat AutoRent</div>
                                </div>
                            </label>
                            
                            <!-- Option 2 -->
                            <label class="radio-card" onclick="selectRadio(this)">
                                <input type="radio" name="delivery" value="delivery">
                                <div class="radio-icon"><i class="bi bi-truck"></i></div>
                                <div>
                                    <div class="radio-title">Diantar</div>
                                    <div class="radio-desc">Antar langsung ke lokasi Anda</div>
                                </div>
                            </label>
                        </div>

                        <!-- Catatan -->
                        <h2 class="section-title">Catatan (Opsional)</h2>
                        <div class="mb-5">
                            <textarea class="form-control" rows="4" placeholder="Tulis catatan tambahan untuk penyewaan ini..."></textarea>
                        </div>

                        <!-- Action Button -->
                        <a href="/checkout-konfirmasi" class="btn btn-continue d-block text-center text-decoration-none">Lanjut ke Konfirmasi</a>

                    </div>
                </div>

                <!-- ================= RIGHT COLUMN (STICKY) ================= -->
                <div class="col-lg-5 col-xl-4">
                    <div class="summary-wrapper">
                        <div class="summary-card">
                            
                            <!-- Car Image -->
                            <div class="summary-img-box">
                                <img src="{{ asset('img/tesla_model3.png') }}" alt="Tesla Model 3">
                            </div>

                            <div class="summary-body">
                                <h3 class="summary-car-title">Tesla Model 3</h3>
                                <div class="summary-car-type"><i class="bi bi-lightning-charge-fill text-warning"></i> Listrik • Sedan</div>
                                
                                <div class="summary-dates">
                                    <div class="date-col">
                                        <div class="date-lbl">Tanggal Sewa</div>
                                        <div class="date-val">12 Okt - 15 Okt</div>
                                    </div>
                                    <div class="date-col">
                                        <div class="date-lbl">Durasi</div>
                                        <div class="date-val">3 Hari</div>
                                    </div>
                                </div>

                                <div class="summary-price-box">
                                    <h4 class="section-title mt-0 mb-3" style="font-size: 1rem;">Rincian Harga</h4>
                                    <div class="price-row"><span>Sewa 3 Hari</span><span>Rp 3.500.000</span></div>
                                    <div class="price-row"><span>Biaya Layanan</span><span>Rp 125.000</span></div>
                                    <div class="price-total"><span>Total</span><span>Rp 3.625.000</span></div>
                                </div>
                            </div>

                            <!-- Note -->
                            <div class="summary-note">
                                <i class="bi bi-shield-check"></i>
                                <p>Harga sudah termasuk asuransi dasar dan pajak kendaraan.</p>
                            </div>

                        </div>
                    </div>
                </div>

            </div> <!-- End Row -->

        </div>
    </main>

    <!-- ===================== FOOTER ===================== -->
    <footer class="py-5">
        <div class="container-xl px-4 px-md-5">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0 d-flex align-items-center gap-3">
                    <div class="footer-brand d-flex align-items-center gap-2">
                        <span>Drivo</span>
                    </div>
                    <p class="footer-copy mb-0">© 2024 Drivo Rental. Semua Hak Dilindungi.</p>
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

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Radio Card Selection Logic
        function selectRadio(selectedLabel) {
            // Remove 'selected' class from all radio cards
            document.querySelectorAll('.radio-card').forEach(card => {
                card.classList.remove('selected');
            });
            // Add 'selected' class to the clicked one
            selectedLabel.classList.add('selected');
        }
    </script>
</body>
</html>
