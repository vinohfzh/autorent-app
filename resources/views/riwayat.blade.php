<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="fw-bold fs-4 mb-0 text-dark">Riwayat Sewa</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-indigo">Dashboard</a></li>
                    <li class="breadcrumb-item active text-muted">Riwayat</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <style>
        :root { --indigo-600: #4f46e5; --indigo-700: #4338ca; --indigo-50: #eef2ff; }
        .booking-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: all 0.25s ease; }
        .booking-card:hover { border-color: #c7d2fe; box-shadow: 0 8px 24px rgba(79,70,229,0.08); transform: translateY(-2px); }
        .bc-img-box { width: 90px; height: 80px; background: #f9fafb; border-radius: 12px; overflow: hidden; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid #f3f4f6; }
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
        .btn-action-primary { background: var(--indigo-600); color: #fff; border: none; font-size: 0.875rem; font-weight: 600; padding: 0.55rem 1.1rem; border-radius: 50px; text-decoration: none; transition: all 0.2s; }
        .btn-action-primary:hover { background: var(--indigo-700); color: #fff; }
        .btn-action-secondary { background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; font-size: 0.875rem; font-weight: 600; padding: 0.55rem 1.1rem; border-radius: 50px; text-decoration: none; transition: all 0.2s; }
        .btn-action-secondary:hover { background: #e5e7eb; color: #111827; }
    </style>

    <div class="container-xl px-4 px-md-5 py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9">

                <!-- Flash Message -->
                @if (session('status'))
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
                        <i class="bi bi-check-circle-fill flex-shrink-0"></i>
                        <div>{{ session('status') }}</div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger d-flex align-items-center gap-2 mb-4" role="alert">
                        <i class="bi bi-exclamation-circle-fill flex-shrink-0"></i>
                        <div>{{ session('error') }}</div>
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
                    <div class="text-center py-5">
                        <i class="bi bi-calendar-x text-muted mb-3 d-block" style="font-size: 4rem; opacity: 0.4;"></i>
                        <h5 class="fw-bold text-dark mb-2">Belum Ada Riwayat Sewa</h5>
                        <p class="text-muted mb-4">Anda belum pernah melakukan pemesanan. Mulai eksplorasi armada terbaik kami sekarang!</p>
                        <a href="{{ route('katalog') }}" class="btn-action-primary text-decoration-none">
                            <i class="bi bi-car-front me-2"></i>Lihat Katalog Mobil
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
                                        @if($t->kendaraan)
                                            <i class="bi bi-car-front-fill bc-img-placeholder"></i>
                                        @else
                                            <i class="bi bi-car-front bc-img-placeholder"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="fw-bold mb-1" style="font-size: 1rem;">
                                            {{ $t->kendaraan ? $t->kendaraan->nama_mobil : 'Kendaraan tidak ditemukan' }}
                                        </h3>
                                        <p class="text-muted small mb-1">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ \Carbon\Carbon::parse($t->tgl_mulai)->format('d M Y') }}
                                            –
                                            {{ \Carbon\Carbon::parse($t->tgl_selesai)->format('d M Y') }}
                                            <span class="ms-1 text-indigo fw-medium">({{ $t->total_hari }} hari)</span>
                                        </p>
                                        <p class="text-muted mb-0" style="font-size: 0.75rem; letter-spacing: 0.04em;">
                                            ID: #{{ str_pad($t->id, 7, '0', STR_PAD_LEFT) }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Right: Price, Status, Toggle -->
                                <div class="d-flex flex-row flex-sm-column align-items-start align-items-sm-end justify-content-between gap-2 flex-shrink-0 w-100 w-sm-auto">
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
                                                <i class="bi bi-car-front text-indigo mt-1"></i>
                                                <div>
                                                    <div class="small fw-medium text-dark">{{ $t->kendaraan ? $t->kendaraan->nama_mobil : '-' }}</div>
                                                    <div class="small text-muted">{{ $t->kendaraan ? ($t->kendaraan->merek . ' · ' . $t->kendaraan->kategori?->nama_kategori) : '-' }}</div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-start gap-2 mb-2">
                                                <i class="bi bi-credit-card text-indigo mt-1"></i>
                                                <div>
                                                    <div class="small fw-medium text-dark">Biaya Sewa</div>
                                                    <div class="small text-muted">Rp {{ $t->kendaraan ? number_format($t->kendaraan->harga_sewa, 0, ',', '.') : '-' }} / hari × {{ $t->total_hari }} hari</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="fw-bold small text-muted text-uppercase mb-3" style="letter-spacing: 0.08em;">Informasi Pelanggan</h6>
                                            <div class="d-flex align-items-start gap-2 mb-2">
                                                <i class="bi bi-person text-indigo mt-1"></i>
                                                <div>
                                                    <div class="small fw-medium text-dark">{{ $t->pelanggan ? $t->pelanggan->nama : '-' }}</div>
                                                    <div class="small text-muted">{{ $t->pelanggan ? $t->pelanggan->no_hp : '-' }}</div>
                                                </div>
                                            </div>
                                            @if($t->pembayaran)
                                            <div class="d-flex align-items-start gap-2 mb-2">
                                                <i class="bi bi-receipt text-indigo mt-1"></i>
                                                <div>
                                                    <div class="small fw-medium text-dark">Pembayaran</div>
                                                    <div class="small text-muted">
                                                        {{ strtoupper($t->pembayaran->metode) }} –
                                                        <span class="fw-medium {{ $t->pembayaran->status_bayar === 'lunas' ? 'text-success' : 'text-warning' }}">
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
                                        @elseif($t->status === 'aktif')
                                            <span class="text-muted small"><i class="bi bi-clock me-1"></i>Sedang berlangsung</span>
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
</x-app-layout>
