<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - {{ $kendaraan->nama_mobil }} - AutoRent</title>

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

        /* ===== NAVBAR OVERRIDES (untuk align dengan layout) ===== */
        .page-content { padding-top: 7rem; padding-bottom: 5rem; }

        /* ===== STEP INDICATOR ===== */
        .step-indicator-wrapper { max-width: 600px; margin: 0 auto 3rem; position: relative; }
        .step-progress-bar { position: absolute; top: 20px; left: 10%; right: 10%; height: 3px; background: var(--gray-200); z-index: 1; }
        .step-progress-fill { position: absolute; top: 0; left: 0; height: 100%; background: var(--indigo-600); width: 0%; transition: width 0.3s ease; }
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
    </style>
</head>
<body>

    @include('layouts.navigation')

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
                        <div class="step-label">Pembayaran</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle">3</div>
                        <div class="step-label">Selesai</div>
                    </div>
                </div>
            </div>

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <input type="hidden" name="kendaraan_id" value="{{ $kendaraan->id }}">

                <div class="row g-5">
                    
                    <!-- ================= LEFT COLUMN ================= -->
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

                        <div class="form-section mb-4">
                            <!-- Jadwal Sewa -->
                            <h2 class="section-title"><i class="bi bi-calendar-event text-indigo me-2"></i>Jadwal Sewa</h2>
                            <div class="row g-4 mb-2">
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Mulai</label>
                                    <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" value="{{ old('tgl_mulai', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Selesai</label>
                                    <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" value="{{ old('tgl_selesai', date('Y-m-d', strtotime('+1 day'))) }}" min="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <!-- Informasi Pemesan -->
                            <h2 class="section-title"><i class="bi bi-person text-indigo me-2"></i>Informasi Pemesan</h2>
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap Sesuai KTP</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Contoh: Andi Wijaya" value="{{ old('nama', Auth::user()->name) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Induk Kependudukan (NIK)</label>
                                    <input type="text" name="no_ktp" class="form-control" placeholder="16 Digit NIK KTP" value="{{ old('no_ktp') }}" required maxlength="20">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Handphone / WhatsApp</label>
                                    <input type="text" name="no_hp" class="form-control" placeholder="+62 812 3456 7890" value="{{ old('no_hp') }}" required maxlength="20">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat Lengkap (Sesuai KTP)</label>
                                    <textarea name="alamat" class="form-control" rows="3" placeholder="Jl. Sudirman No. 123..." required>{{ old('alamat') }}</textarea>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <button type="submit" class="btn btn-continue d-block text-center text-decoration-none">Lanjut ke Pembayaran</button>

                        </div>
                    </div>

                    <!-- ================= RIGHT COLUMN (STICKY) ================= -->
                    <div class="col-lg-5 col-xl-4">
                        <div class="summary-wrapper">
                            <div class="summary-card">
                                
                                <!-- Car Image -->
                                <div class="summary-img-box">
                                    @if($kendaraan->foto)
                                        <img src="{{ Storage::url($kendaraan->foto) }}" alt="{{ $kendaraan->nama_mobil }}">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                                            <i class="bi bi-car-front text-muted" style="font-size:3rem"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="summary-body">
                                    <h3 class="summary-car-title">{{ $kendaraan->nama_mobil }}</h3>
                                    <div class="summary-car-type"><i class="bi bi-tag-fill text-indigo"></i> {{ $kendaraan->merek }} • {{ $kendaraan->kategori?->nama_kategori ?? 'Umum' }}</div>
                                    
                                    <div class="summary-dates">
                                        <div class="date-col">
                                            <div class="date-lbl">Sewa Per Hari</div>
                                            <div class="date-val">Rp <span id="harga_per_hari">{{ number_format($kendaraan->harga_sewa, 0, ',', '.') }}</span></div>
                                        </div>
                                        <div class="date-col">
                                            <div class="date-lbl">Durasi Sewa</div>
                                            <div class="date-val"><span id="lbl_durasi">1</span> Hari</div>
                                        </div>
                                    </div>

                                    <div class="summary-price-box">
                                        <h4 class="section-title mt-0 mb-3" style="font-size: 1rem;">Rincian Harga</h4>
                                        <div class="price-row"><span>Sewa <span id="lbl_hari">1</span> Hari</span><span>Rp <span id="lbl_total_sewa">{{ number_format($kendaraan->harga_sewa, 0, ',', '.') }}</span></span></div>
                                        <div class="price-total"><span>Total Pembayaran</span><span>Rp <span id="lbl_grand_total">{{ number_format($kendaraan->harga_sewa, 0, ',', '.') }}</span></span></div>
                                    </div>
                                </div>

                                <!-- Note -->
                                <div class="summary-note">
                                    <i class="bi bi-shield-check"></i>
                                    <p>Pastikan data diri Anda sesuai dengan KTP untuk keperluan validasi oleh tim kami saat penyerahan unit.</p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div> <!-- End Row -->
            </form>
        </div>
    </main>

    @include('layouts.footer')

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tglMulai = document.getElementById('tgl_mulai');
            const tglSelesai = document.getElementById('tgl_selesai');
            const lblDurasi = document.getElementById('lbl_durasi');
            const lblHari = document.getElementById('lbl_hari');
            const lblTotalSewa = document.getElementById('lbl_total_sewa');
            const lblGrandTotal = document.getElementById('lbl_grand_total');
            const hargaSewa = {{ $kendaraan->harga_sewa }};

            function calculatePrice() {
                const start = new Date(tglMulai.value);
                const end = new Date(tglSelesai.value);
                
                // Pastikan end date >= start date
                if (end < start) {
                    tglSelesai.value = tglMulai.value;
                    end.setTime(start.getTime());
                }

                const diffTime = Math.abs(end - start);
                let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                
                if (diffDays === 0) diffDays = 1; // Minimal sewa 1 hari
                if (isNaN(diffDays)) diffDays = 1;

                lblDurasi.textContent = diffDays;
                lblHari.textContent = diffDays;
                
                const total = diffDays * hargaSewa;
                const formattedTotal = new Intl.NumberFormat('id-ID').format(total);
                
                lblTotalSewa.textContent = formattedTotal;
                lblGrandTotal.textContent = formattedTotal;
            }

            tglMulai.addEventListener('change', calculatePrice);
            tglSelesai.addEventListener('change', calculatePrice);
            
            // Initial calculation
            calculatePrice();
        });
    </script>
</body>
</html>
