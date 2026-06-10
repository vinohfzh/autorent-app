<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Pembayaran - AutoRent">
    <title>Pembayaran - AutoRent</title>

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
        #navbar { background: #fff; border-bottom: 1px solid #f3f4f6; z-index: 1050; }
        .navbar-brand .logo-box { width: 32px; height: 32px; background: var(--indigo-600); border-radius: 8px; display: flex; align-items: center; justify-content: center; }
        .navbar-brand span { font-size: 1.2rem; font-weight: 800; color: var(--indigo-600); letter-spacing: -0.5px; }
        
        .timer-top-bar { background: var(--indigo-50); color: var(--indigo-700); font-weight: 700; padding: 12px 20px; border-radius: 50px; font-size: 0.95rem; display: flex; align-items: center; gap: 8px; border: 1px solid #c7d2fe; }
        
        .help-link { color: var(--gray-500); text-decoration: none; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 6px; transition: color 0.2s; }
        .help-link:hover { color: var(--indigo-600); }

        /* ===== MAIN LAYOUT ===== */
        .page-content { padding-top: 6rem; padding-bottom: 5rem; }

        /* ===== STEP INDICATOR ===== */
        .step-indicator-wrapper { max-width: 600px; margin: 2rem auto 3rem; position: relative; }
        .step-progress-bar { position: absolute; top: 20px; left: 10%; right: 10%; height: 3px; background: var(--gray-200); z-index: 1; }
        .step-progress-fill { position: absolute; top: 0; left: 0; height: 100%; background: var(--indigo-600); width: 100%; transition: width 0.3s ease; } /* 100% for step 3 */
        .step-items { display: flex; justify-content: space-between; position: relative; z-index: 2; }
        .step-item { display: flex; flex-direction: column; align-items: center; gap: 8px; }
        .step-circle { width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; transition: all 0.3s; background: #fff; border: 3px solid var(--gray-200); color: var(--gray-500); }
        .step-label { font-size: 0.85rem; font-weight: 600; color: var(--gray-500); }
        
        .step-item.active .step-circle { border-color: var(--indigo-600); color: var(--indigo-600); box-shadow: 0 0 0 4px var(--indigo-50); }
        .step-item.active .step-label { color: var(--indigo-600); }
        .step-item.completed .step-circle { background: var(--indigo-600); border-color: var(--indigo-600); color: #fff; }
        .step-item.completed .step-label { color: var(--gray-900); }

        /* ===== LEFT COLUMN ===== */
        .section-title { font-size: 1.25rem; font-weight: 700; color: var(--gray-900); margin-bottom: 1.5rem; }
        
        .accordion-item { border: 1px solid var(--gray-200); border-radius: 16px !important; margin-bottom: 1rem; overflow: hidden; transition: border-color 0.2s; box-shadow: 0 2px 4px rgba(0,0,0,0.01); }
        .accordion-button { padding: 1.25rem 1.5rem; font-weight: 700; color: var(--gray-900); background-color: #fff; border-radius: 16px !important; box-shadow: none !important; }
        .accordion-button:not(.collapsed) { background-color: var(--indigo-50); color: var(--indigo-700); }
        .accordion-button::after { background-size: 1rem; }
        .accordion-button .bank-icon { font-size: 1.5rem; margin-right: 1rem; color: var(--gray-500); }
        .accordion-button:not(.collapsed) .bank-icon { color: var(--indigo-600); }
        .accordion-body { background: #fff; padding: 1.5rem; border-top: 1px solid var(--gray-200); }

        /* QR Code Area */
        .qr-area { display: flex; flex-direction: column; align-items: center; justify-content: center; background: var(--gray-50); padding: 2rem; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid var(--gray-200); }
        .qr-box { width: 160px; height: 160px; background: #fff; border: 1px solid var(--gray-200); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .qr-box i { font-size: 4rem; color: var(--gray-900); }
        .qr-desc { font-size: 0.875rem; font-weight: 500; color: var(--gray-500); text-align: center; }

        /* Upload Bukti */
        .upload-label { font-size: 0.95rem; font-weight: 700; color: var(--gray-900); margin-bottom: 0.75rem; display: block; }
        .upload-area { background-color: #fff; border: 2px dashed var(--gray-300); border-radius: 12px; padding: 2rem; text-align: center; cursor: pointer; transition: all 0.2s; }
        .upload-area:hover { border-color: var(--indigo-600); background-color: var(--indigo-50); }
        .upload-area i { font-size: 2rem; color: var(--gray-500); margin-bottom: 0.5rem; transition: color 0.2s; }
        .upload-area:hover i { color: var(--indigo-600); }
        .upload-desc { font-size: 0.875rem; color: var(--gray-500); margin-bottom: 0; }

        /* ===== RIGHT COLUMN (STICKY SUMMARY) ===== */
        .summary-wrapper { position: sticky; top: 6.5rem; }
        .summary-card { background: #fff; border-radius: 20px; padding: 1.5rem; border: 1px solid var(--gray-200); box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-bottom: 1.5rem; }
        
        .timer-sidebar { background: var(--indigo-50); border: 1px solid #c7d2fe; border-radius: 12px; padding: 1rem; display: flex; align-items: center; justify-content: center; gap: 8px; font-weight: 700; color: var(--indigo-700); margin-bottom: 1.5rem; }

        .summary-title { font-size: 1.1rem; font-weight: 700; color: var(--gray-900); margin-bottom: 1rem; }
        .price-row { display: flex; justify-content: space-between; font-size: 0.9rem; color: var(--gray-500); margin-bottom: 0.75rem; font-weight: 500; }
        .price-row.strong { color: var(--gray-900); font-weight: 700; }
        .price-total { display: flex; justify-content: space-between; font-size: 1.15rem; font-weight: 800; color: var(--indigo-600); padding-top: 1rem; border-top: 1px solid var(--gray-200); margin-top: 0.5rem; margin-bottom: 1.5rem; }
        
        .btn-pay { background: linear-gradient(135deg, #6366f1, #4f46e5); color: #fff; border: none; width: 100%; padding: 1rem; font-size: 1.05rem; font-weight: 700; border-radius: 50px; transition: all 0.2s; box-shadow: 0 4px 12px rgba(79,70,229,0.25); margin-bottom: 1rem; }
        .btn-pay:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(79,70,229,0.35); color: #fff; }

        .terms-note { font-size: 0.75rem; color: var(--gray-500); text-align: center; line-height: 1.5; }
        .terms-note a { color: var(--indigo-600); font-weight: 600; text-decoration: none; }

        .mini-car-card { background: #fff; border-radius: 16px; border: 1px solid var(--gray-200); padding: 1rem; display: flex; align-items: center; gap: 1rem; }
        .mini-car-img { width: 80px; height: 50px; background: var(--gray-50); border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; }
        .mini-car-img img { width: 100%; height: 100%; object-fit: cover; }
        .mini-car-title { font-size: 0.95rem; font-weight: 700; color: var(--gray-900); margin-bottom: 2px; }
        .mini-car-desc { font-size: 0.75rem; font-weight: 500; color: var(--gray-500); }

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
    <nav id="navbar" class="navbar navbar-expand-md fixed-top py-3">
        <div class="container-xl px-4 px-md-5 d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <div class="logo-box">
                    <svg width="18" height="16" viewBox="0 0 24 20" fill="none"><path d="M21 8H19.5L17.5 3C17.19 2.4 16.56 2 15.86 2H8.14C7.44 2 6.81 2.4 6.5 3L4.5 8H3C2.45 8 2 8.45 2 9C2 9.55 2.45 10 3 10H3.5L3 10.5V17C3 17.55 3.45 18 4 18H5C5.55 18 6 17.55 6 17V16H18V17C18 17.55 18.45 18 19 18H20C20.55 18 21 17.55 21 17V10.5L20.5 10H21C21.55 10 22 9.55 22 9C22 8.45 21.55 8 21 8ZM7.5 13C6.67 13 6 12.33 6 11.5C6 10.67 6.67 10 7.5 10C8.33 10 9 10.67 9 11.5C9 12.33 8.33 13 7.5 13ZM16.5 13C15.67 13 15 12.33 15 11.5C15 10.67 15.67 10 16.5 10C17.33 10 18 10.67 18 11.5C18 12.33 17.33 13 16.5 13ZM5 8L7.5 3H16.5L19 8H5Z" fill="white"/></svg>
                </div>
                <span>AutoRent</span>
            </a>
            
            <div class="timer-top-bar d-none d-md-flex">
                <i class="bi bi-stopwatch"></i> Batas pembayaran: <span id="topTimer">01:59:23</span>
            </div>

            <a href="#" class="help-link"><i class="bi bi-question-circle"></i> Bantuan</a>
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
                    <div class="step-item completed">
                        <div class="step-circle"><i class="bi bi-check-lg"></i></div>
                        <div class="step-label">Konfirmasi</div>
                    </div>
                    <div class="step-item active">
                        <div class="step-circle">3</div>
                        <div class="step-label">Pembayaran</div>
                    </div>
                </div>
            </div>

            <div class="row g-5">
                
                <!-- LEFT COLUMN: Payment Methods -->
                <div class="col-lg-7 col-xl-8">
                    <h2 class="section-title">Pilih Metode Pembayaran</h2>

                    <div class="accordion" id="paymentAccordion">
                        
                        <!-- BCA -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBCA">
                                    <i class="bi bi-bank bank-icon"></i> BCA Virtual Account
                                </button>
                            </h2>
                            <div id="collapseBCA" class="accordion-collapse collapse" data-bs-parent="#paymentAccordion">
                                <div class="accordion-body">
                                    <p class="text-muted mb-0">Nomor Virtual Account BCA akan ditampilkan setelah Anda menekan tombol Konfirmasi Pembayaran.</p>
                                </div>
                            </div>
                        </div>

                        <!-- MANDIRI -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMandiri">
                                    <i class="bi bi-bank bank-icon"></i> Mandiri Virtual Account
                                </button>
                            </h2>
                            <div id="collapseMandiri" class="accordion-collapse collapse" data-bs-parent="#paymentAccordion">
                                <div class="accordion-body">
                                    <p class="text-muted mb-0">Nomor Virtual Account Mandiri akan ditampilkan setelah Anda menekan tombol Konfirmasi Pembayaran.</p>
                                </div>
                            </div>
                        </div>

                        <!-- BRI -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBRI">
                                    <i class="bi bi-bank bank-icon"></i> BRI Virtual Account
                                </button>
                            </h2>
                            <div id="collapseBRI" class="accordion-collapse collapse" data-bs-parent="#paymentAccordion">
                                <div class="accordion-body">
                                    <p class="text-muted mb-0">Nomor Virtual Account BRI (BRIVA) akan ditampilkan setelah Anda menekan tombol Konfirmasi Pembayaran.</p>
                                </div>
                            </div>
                        </div>

                        <!-- QRIS -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQRIS">
                                    <i class="bi bi-qr-code-scan bank-icon"></i> QRIS (Gopay, OVO, Dana, LinkAja)
                                </button>
                            </h2>
                            <div id="collapseQRIS" class="accordion-collapse collapse show" data-bs-parent="#paymentAccordion">
                                <div class="accordion-body">
                                    <div class="qr-area">
                                        <div class="qr-box">
                                            <i class="bi bi-qr-code"></i>
                                        </div>
                                        <p class="qr-desc">Scan QR ini melalui aplikasi bank atau e-wallet Anda.</p>
                                    </div>

                                    <div class="upload-section mt-4">
                                        <span class="upload-label">Upload Bukti Pembayaran</span>
                                        <div class="upload-area">
                                            <i class="bi bi-file-earmark-arrow-up"></i>
                                            <p class="upload-desc">Klik atau seret file ke sini (.jpg, .png, max 5MB)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- RIGHT COLUMN: Order Summary -->
                <div class="col-lg-5 col-xl-4">
                    <div class="summary-wrapper">
                        
                        <div class="timer-sidebar d-md-none">
                            <i class="bi bi-stopwatch"></i> <span id="mobileTimer">01:59:23</span>
                        </div>

                        <div class="summary-card">
                            <h3 class="summary-title">Ringkasan Pesanan</h3>
                            
                            <div class="price-row strong"><span>Tesla Model 3 (3 Hari)</span><span>Rp 3.500.000</span></div>
                            <div class="price-row"><span>Biaya Layanan</span><span>Rp 125.000</span></div>
                            
                            <div class="price-total"><span>Total Pembayaran</span><span>Rp 3.625.000</span></div>

                            <button class="btn-pay" onclick="alert('Pembayaran Berhasil Diklaim!')">Konfirmasi Pembayaran</button>
                            
                            <p class="terms-note">Dengan mengklik tombol di atas, Anda menyetujui <a href="#">Syarat &amp; Ketentuan</a> AutoRent.</p>
                        </div>

                        <div class="mini-car-card">
                            <div class="mini-car-img">
                                <img src="{{ asset('img/tesla_model3.png') }}" alt="Tesla Model 3">
                            </div>
                            <div>
                                <div class="mini-car-title">Tesla Model 3</div>
                                <div class="mini-car-desc">Sedan Listrik • 4 Kursi</div>
                            </div>
                        </div>

                    </div>
                </div>

            </div> <!-- End Row -->
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
        // Live Countdown Timer Simulation
        let timeInSecs = 1 * 3600 + 59 * 60 + 23; // 01:59:23
        
        function formatTime(secs) {
            const h = Math.floor(secs / 3600).toString().padStart(2, '0');
            const m = Math.floor((secs % 3600) / 60).toString().padStart(2, '0');
            const s = (secs % 60).toString().padStart(2, '0');
            return `${h}:${m}:${s}`;
        }

        setInterval(() => {
            if (timeInSecs > 0) {
                timeInSecs--;
                const tStr = formatTime(timeInSecs);
                document.getElementById('topTimer').textContent = tStr;
                const mobTimer = document.getElementById('mobileTimer');
                if(mobTimer) mobTimer.textContent = tStr;
            }
        }, 1000);
    </script>
</body>
</html>
