<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran - {{ $transaksi->kendaraan->nama_mobil }} - AutoRent</title>

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

        .page-content { padding-top: 7rem; padding-bottom: 5rem; }

        /* ===== STEP INDICATOR ===== */
        .step-indicator-wrapper { max-width: 600px; margin: 0 auto 3rem; position: relative; }
        .step-progress-bar { position: absolute; top: 20px; left: 10%; right: 10%; height: 3px; background: var(--gray-200); z-index: 1; }
        .step-progress-fill { position: absolute; top: 0; left: 0; height: 100%; background: var(--indigo-600); width: 50%; transition: width 0.3s ease; }
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
        
        .method-card { border: 2px solid var(--gray-200); border-radius: 16px; padding: 1.25rem; cursor: pointer; transition: all 0.2s; background: #fff; display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; }
        .method-card:hover { border-color: var(--gray-300); }
        .method-card.selected { border-color: var(--indigo-600); background-color: var(--indigo-50); }
        .method-info { display: flex; align-items: center; gap: 12px; }
        .method-icon { width: 48px; height: 32px; background: #fff; border-radius: 6px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--gray-200); font-weight: 700; font-size: 0.8rem; color: var(--indigo-600); }
        .method-name { font-weight: 700; color: var(--gray-900); font-size: 1rem; }
        
        .method-details { display: none; background: #fff; border: 1px solid var(--gray-200); border-radius: 16px; padding: 1.5rem; margin-top: -0.5rem; margin-bottom: 1.5rem; border-top-left-radius: 0; border-top-right-radius: 0; border-top: none; }
        .method-card.selected + .method-details { display: block; }
        
        .va-box { background: var(--gray-50); border: 1px dashed var(--gray-300); border-radius: 12px; padding: 1rem; text-align: center; margin-bottom: 1rem; }
        .va-number { font-size: 1.5rem; font-weight: 800; color: var(--indigo-600); letter-spacing: 2px; }

        /* Upload Bukti */
        .upload-label { font-size: 0.95rem; font-weight: 700; color: var(--gray-900); margin-bottom: 0.75rem; display: block; }
        .upload-area { background-color: #fff; border: 2px dashed var(--gray-300); border-radius: 12px; padding: 2rem; text-align: center; cursor: pointer; transition: all 0.2s; position: relative; }
        .upload-area input[type="file"] { position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
        .upload-area:hover { border-color: var(--indigo-600); background-color: var(--indigo-50); }
        .upload-area i { font-size: 2rem; color: var(--gray-500); margin-bottom: 0.5rem; transition: color 0.2s; }
        .upload-area:hover i { color: var(--indigo-600); }
        .upload-desc { font-size: 0.875rem; color: var(--gray-500); margin-bottom: 0; }

        /* ===== RIGHT COLUMN (STICKY SUMMARY) ===== */
        .summary-wrapper { position: sticky; top: 6.5rem; }
        .summary-card { background: #fff; border-radius: 20px; padding: 1.5rem; border: 1px solid var(--gray-200); box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-bottom: 1.5rem; }
        
        .summary-title { font-size: 1.1rem; font-weight: 700; color: var(--gray-900); margin-bottom: 1rem; }
        .price-row { display: flex; justify-content: space-between; font-size: 0.9rem; color: var(--gray-500); margin-bottom: 0.75rem; font-weight: 500; }
        .price-row.strong { color: var(--gray-900); font-weight: 700; }
        .price-total { display: flex; justify-content: space-between; font-size: 1.15rem; font-weight: 800; color: var(--indigo-600); padding-top: 1rem; border-top: 1px solid var(--gray-200); margin-top: 0.5rem; margin-bottom: 1.5rem; }
        
        .btn-pay { background: linear-gradient(135deg, #6366f1, #4f46e5); color: #fff; border: none; width: 100%; padding: 1rem; font-size: 1.05rem; font-weight: 700; border-radius: 16px; transition: all 0.2s; box-shadow: 0 4px 12px rgba(79,70,229,0.25); margin-bottom: 1rem; }
        .btn-pay:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(79,70,229,0.35); color: #fff; }

        .mini-car-card { background: #fff; border-radius: 16px; border: 1px solid var(--gray-200); padding: 1rem; display: flex; align-items: center; gap: 1rem; }
        .mini-car-img { width: 80px; height: 50px; background: var(--gray-50); border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; }
        .mini-car-img img { width: 100%; height: 100%; object-fit: cover; }
        .mini-car-title { font-size: 0.95rem; font-weight: 700; color: var(--gray-900); margin-bottom: 2px; }
        .mini-car-desc { font-size: 0.75rem; font-weight: 500; color: var(--gray-500); }
    </style>
</head>
<body>

    @include('layouts.navigation')

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
                        <div class="step-label">Informasi</div>
                    </div>
                    <div class="step-item active">
                        <div class="step-circle">2</div>
                        <div class="step-label">Pembayaran</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle">3</div>
                        <div class="step-label">Selesai</div>
                    </div>
                </div>
            </div>

            <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="transaksi_id" value="{{ $transaksi->id }}">
                <input type="hidden" name="metode" id="input_metode" value="bca">

                <div class="row g-5">
                    
                    <!-- LEFT COLUMN: Payment Methods -->
                    <div class="col-lg-7 col-xl-8">
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4 rounded-4 border-0 shadow-sm">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <h2 class="section-title">Pilih Metode Pembayaran</h2>

                        <!-- BCA -->
                        <div class="method-card selected" onclick="selectMethod('bca', this)">
                            <div class="method-info">
                                <div class="method-icon">BCA</div>
                                <div class="method-name">BCA Virtual Account</div>
                            </div>
                            <i class="bi bi-circle-fill text-indigo-600" id="icon-bca" style="color: var(--indigo-600);"></i>
                        </div>
                        <div class="method-details">
                            <div class="va-box">
                                <p class="mb-1 text-muted">Nomor Virtual Account BCA</p>
                                <div class="va-number">8077 {{ rand(1000, 9999) }} {{ rand(1000, 9999) }}</div>
                            </div>
                            <p class="text-muted small">Lakukan pembayaran ke nomor Virtual Account di atas melalui m-BCA, KlikBCA, atau ATM BCA.</p>
                        </div>

                        <!-- MANDIRI -->
                        <div class="method-card" onclick="selectMethod('mandiri', this)">
                            <div class="method-info">
                                <div class="method-icon" style="color: #0f4c81;">MDR</div>
                                <div class="method-name">Mandiri Virtual Account</div>
                            </div>
                            <i class="bi bi-circle text-muted" id="icon-mandiri"></i>
                        </div>
                        <div class="method-details">
                            <div class="va-box">
                                <p class="mb-1 text-muted">Nomor Virtual Account Mandiri</p>
                                <div class="va-number">89508 {{ rand(1000, 9999) }} {{ rand(1000, 9999) }}</div>
                            </div>
                            <p class="text-muted small">Lakukan pembayaran melalui Livin' by Mandiri, Internet Banking, atau ATM Mandiri.</p>
                        </div>

                        <!-- BRI -->
                        <div class="method-card" onclick="selectMethod('bri', this)">
                            <div class="method-info">
                                <div class="method-icon" style="color: #0b5394;">BRI</div>
                                <div class="method-name">BRI Virtual Account (BRIVA)</div>
                            </div>
                            <i class="bi bi-circle text-muted" id="icon-bri"></i>
                        </div>
                        <div class="method-details">
                            <div class="va-box">
                                <p class="mb-1 text-muted">Nomor BRIVA</p>
                                <div class="va-number">10339 {{ rand(1000, 9999) }} {{ rand(1000, 9999) }}</div>
                            </div>
                            <p class="text-muted small">Lakukan pembayaran melalui BRImo, Internet Banking BRI, atau ATM BRI.</p>
                        </div>

                        <!-- QRIS -->
                        <div class="method-card" onclick="selectMethod('qris', this)">
                            <div class="method-info">
                                <div class="method-icon" style="color: #ed2c25;">QRIS</div>
                                <div class="method-name">QRIS (Gopay, OVO, Dana, dll)</div>
                            </div>
                            <i class="bi bi-circle text-muted" id="icon-qris"></i>
                        </div>
                        <div class="method-details">
                            <div class="text-center py-3">
                                <i class="bi bi-qr-code" style="font-size: 8rem;"></i>
                                <p class="mt-3 text-muted">Scan QR Code ini menggunakan aplikasi e-Wallet atau m-Banking Anda.</p>
                            </div>
                        </div>

                        <!-- UPLOAD BUKTI (GLOBAL) -->
                        <div class="mt-5 p-4 bg-white rounded-4 border">
                            <h4 class="mb-3" style="font-size: 1.1rem; font-weight: 700;">Upload Bukti Pembayaran</h4>
                            <p class="text-muted small mb-3">Setelah melakukan transfer/scan QRIS, wajib unggah foto/screenshot bukti pembayaran agar dapat diverifikasi oleh admin.</p>
                            <div class="upload-area">
                                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/*" required onchange="showFileName(this)">
                                <i class="bi bi-cloud-arrow-up"></i>
                                <p class="upload-desc fw-bold" id="file_name">Klik di sini untuk upload bukti</p>
                                <p class="text-muted small mt-1 mb-0">Format: JPG, PNG (Maks. 5MB)</p>
                            </div>
                        </div>

                    </div>

                    <!-- RIGHT COLUMN: Order Summary -->
                    <div class="col-lg-5 col-xl-4">
                        <div class="summary-wrapper">

                            <div class="summary-card">
                                <h3 class="summary-title">Ringkasan Pesanan</h3>
                                
                                <div class="price-row strong">
                                    <span>{{ $transaksi->kendaraan->nama_mobil }} ({{ $transaksi->total_hari }} Hari)</span>
                                    <span>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                                </div>
                                
                                <div class="price-total">
                                    <span>Total Tagihan</span>
                                    <span>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                                </div>

                                <button type="submit" class="btn-pay">Konfirmasi Pembayaran</button>
                            </div>

                            <div class="mini-car-card">
                                <div class="mini-car-img">
                                    @if($transaksi->kendaraan->foto)
                                        <img src="{{ Storage::url($transaksi->kendaraan->foto) }}" alt="{{ $transaksi->kendaraan->nama_mobil }}">
                                    @else
                                        <i class="bi bi-car-front text-muted" style="font-size: 2rem;"></i>
                                    @endif
                                </div>
                                <div>
                                    <div class="mini-car-title">{{ $transaksi->kendaraan->nama_mobil }}</div>
                                    <div class="mini-car-desc">{{ $transaksi->kendaraan->merek }}</div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div> <!-- End Row -->
            </form>
        </div>
    </main>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function selectMethod(method, element) {
            // Update hidden input
            document.getElementById('input_metode').value = method;

            // Reset all cards
            document.querySelectorAll('.method-card').forEach(card => {
                card.classList.remove('selected');
            });
            document.querySelectorAll('.method-card i.bi-circle-fill').forEach(icon => {
                icon.classList.remove('bi-circle-fill');
                icon.classList.add('bi-circle');
                icon.classList.replace('text-indigo-600', 'text-muted');
                icon.style.color = '';
            });

            // Set active card
            element.classList.add('selected');
            const activeIcon = element.querySelector('i.bi-circle');
            if(activeIcon) {
                activeIcon.classList.remove('bi-circle');
                activeIcon.classList.add('bi-circle-fill');
                activeIcon.classList.replace('text-muted', 'text-indigo-600');
                activeIcon.style.color = 'var(--indigo-600)';
            }
        }

        function showFileName(input) {
            const fileNameDisplay = document.getElementById('file_name');
            if (input.files && input.files[0]) {
                fileNameDisplay.textContent = input.files[0].name;
                fileNameDisplay.classList.add('text-indigo');
            } else {
                fileNameDisplay.textContent = 'Klik di sini untuk upload bukti';
                fileNameDisplay.classList.remove('text-indigo');
            }
        }
    </script>
</body>
</html>
