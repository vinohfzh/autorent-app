@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">

    <!-- Flash Notification Toast/Alert -->
    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4 rounded-3 border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="fw-bold fs-4 mb-1 text-dark">Dashboard</h1>
            <p class="text-muted small mb-0">{{ now()->locale('id')->isoFormat('dddd, D MMM Y') }}</p>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row g-4 mb-4">
        <!-- Total Booking -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-custom p-4 h-100 position-relative">
                <div class="position-absolute top-0 end-0 p-3 pt-4 pe-4">
                    <span class="text-success fw-bold small"><i class="bi bi-arrow-up-short"></i>12%</span>
                </div>
                <div class="mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #f4f7fe; color: #4318FF;">
                        <i class="bi bi-calendar-check fs-5"></i>
                    </div>
                </div>
                <div>
                    <span class="text-muted small fw-medium d-block mb-1">Total Booking</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ number_format($totalBooking) }}</h3>
                </div>
            </div>
        </div>
        <!-- Total Revenue -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-custom p-4 h-100 position-relative">
                <div class="position-absolute top-0 end-0 p-3 pt-4 pe-4">
                    <span class="text-success fw-bold small"><i class="bi bi-arrow-up-short"></i>8%</span>
                </div>
                <div class="mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #f4f7fe; color: #4318FF;">
                        <i class="bi bi-cash-coin fs-5"></i>
                    </div>
                </div>
                <div>
                    <span class="text-muted small fw-medium d-block mb-1">Pendapatan</span>
                    <h3 class="fw-bold mb-0 text-dark">Rp {{ number_format($totalRevenue / 1000000, 0, ',', '.') }}M</h3>
                </div>
            </div>
        </div>
        <!-- Active Cars -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-custom p-4 h-100 position-relative">
                <div class="position-absolute top-0 end-0 p-3 pt-4 pe-4">
                    <span class="text-success fw-bold small"><i class="bi bi-arrow-up-short"></i>4%</span>
                </div>
                <div class="mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #f4f7fe; color: #4318FF;">
                        <i class="bi bi-car-front fs-5"></i>
                    </div>
                </div>
                <div>
                    <span class="text-muted small fw-medium d-block mb-1">Mobil Aktif</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $activeCars }}</h3>
                </div>
            </div>
        </div>
        <!-- New Customers -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-custom p-4 h-100 position-relative">
                <div class="position-absolute top-0 end-0 p-3 pt-4 pe-4">
                    <span class="text-success fw-bold small"><i class="bi bi-arrow-up-short"></i>15%</span>
                </div>
                <div class="mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #f4f7fe; color: #4318FF;">
                        <i class="bi bi-person-plus fs-5"></i>
                    </div>
                </div>
                <div>
                    <span class="text-muted small fw-medium d-block mb-1">Pelanggan Baru</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <!-- Monthly Revenue Chart -->
        <div class="col-12 col-lg-8">
            <div class="card card-custom p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold mb-0 text-dark">Pendapatan Bulanan</h6>
                    <div class="d-flex gap-3">
                        <div class="d-flex align-items-center gap-1"><span class="rounded-circle bg-primary" style="width:8px;height:8px;"></span><span class="small text-muted" style="font-size:0.75rem;">Proyeksi</span></div>
                        <div class="d-flex align-items-center gap-1"><span class="rounded-circle" style="width:8px;height:8px; background:#4318FF;"></span><span class="small text-muted" style="font-size:0.75rem;">Realisasi</span></div>
                    </div>
                </div>
                <div style="height: 300px; position: relative;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Category Armada Pie Chart -->
        <div class="col-12 col-lg-4">
            <div class="card card-custom p-4 h-100">
                <h6 class="fw-bold mb-4 text-dark">Kategori Armada</h6>
                <div style="height: 250px; position: relative; display: flex; align-items: center; justify-content: center;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmations & Recent Bookings -->
    <div class="row g-4">
        <!-- Booking Terbaru -->
        <div class="col-12 col-lg-8">
            <div class="card card-custom p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="fw-bold mb-0 text-dark">Booking Terbaru</h6>
                    <a href="{{ route('admin.booking.index') }}" class="text-decoration-none small fw-semibold" style="color: #4318FF;">Lihat Semua</a>
                </div>

                @if($bookingTerbaru->isEmpty())
                    <div class="text-center py-5">
                        <p class="text-muted small">Belum ada booking transaksi terbaru.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle table-borderless table-hover mb-0">
                            <thead class="border-bottom" style="border-color: #f4f7fe !important;">
                                <tr>
                                    <th class="small fw-semibold text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Order ID</th>
                                    <th class="small fw-semibold text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Customer</th>
                                    <th class="small fw-semibold text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Mobil</th>
                                    <th class="small fw-semibold text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Tanggal</th>
                                    <th class="small fw-semibold text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookingTerbaru as $b)
                                    <tr class="border-bottom" style="border-color: #f4f7fe !important;">
                                        <td class="small fw-bold text-dark py-3">#DRV-{{ str_pad($b->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td class="py-3" style="max-width: 150px;">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-dark fw-bold flex-shrink-0" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                                    {{ substr($b->pelanggan?->nama ?? 'A', 0, 1) }}
                                                </div>
                                                <div class="small fw-medium text-dark text-truncate">{{ $b->pelanggan?->nama }}</div>
                                            </div>
                                        </td>
                                        <td class="small text-muted py-3 text-truncate" style="max-width: 150px;" title="{{ $b->kendaraan?->nama_mobil }}">{{ $b->kendaraan?->nama_mobil }}</td>
                                        <td class="small text-muted py-3">
                                            {{ \Carbon\Carbon::parse($b->tgl_mulai)->format('d M Y') }}
                                        </td>
                                        <td class="py-3">
                                            @if($b->status == 'selesai')
                                                <span class="status-badge status-selesai">Selesai</span>
                                            @elseif($b->status == 'aktif')
                                                <span class="status-badge status-aktif">Aktif</span>
                                            @else
                                                <span class="status-badge status-dibatalkan">Dibatalkan</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Butuh Konfirmasi -->
        <div class="col-12 col-lg-4">
            <div class="card card-custom p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <h6 class="fw-bold mb-0 text-dark">Butuh Konfirmasi</h6>
                        @if($butuhKonfirmasi->count() > 0)
                            <span class="badge rounded-pill bg-danger" style="font-size: 0.7rem;">{{ $butuhKonfirmasi->count() }}</span>
                        @endif
                    </div>
                </div>
                
                @if($butuhKonfirmasi->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-shield-check text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
                        <p class="text-muted small mt-2 mb-3">Semua pembayaran sudah disetujui!</p>
                        <a href="{{ route('admin.booking.index') }}" class="btn btn-outline-custom btn-sm rounded-pill"><i class="bi bi-plus"></i> Buat Booking Baru</a>
                    </div>
                @else
                    <div class="d-flex flex-column gap-4">
                        @foreach($butuhKonfirmasi as $p)
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-dark fw-bold flex-shrink-0" style="width: 40px; height: 40px; font-size: 0.9rem;">
                                        {{ substr($p->transaksi?->pelanggan?->nama ?? 'A', 0, 1) }}
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="fw-bold mb-0 text-dark small text-truncate" title="{{ $p->transaksi?->pelanggan?->nama }}">{{ $p->transaksi?->pelanggan?->nama ?? 'Pelanggan' }}</h6>
                                        <span class="text-muted d-block text-truncate" style="font-size: 0.75rem;" title="{{ $p->transaksi?->kendaraan?->nama_mobil }}">{{ $p->transaksi?->kendaraan?->nama_mobil ?? 'Mobil' }}</span>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <form method="POST" action="{{ route('admin.pembayaran.approve', $p->id) }}" class="flex-grow-1 needs-loading" onsubmit="return confirmAction(event, this, 'Setujui Pembayaran?', 'Dana sudah masuk dan valid?', 'Ya, Setujui', '#4318FF');">
                                        @csrf
                                        <button type="submit" class="btn btn-primary-custom w-100 rounded-pill">Setujui</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.pembayaran.reject', $p->id) }}" class="flex-grow-1 needs-loading" onsubmit="return confirmAction(event, this, 'Tolak Pembayaran?', 'Pesanan ini akan dibatalkan.', 'Ya, Tolak', '#dc2626');">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-custom w-100 rounded-pill">Tolak</button>
                                    </form>
                                </div>
                            </div>
                            @if(!$loop->last)
                                <hr class="my-0 border-light">
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

<!-- Chart Configurations & Helpers -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Bar Chart (Pendapatan Bulanan)
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartMonths) !!},
                datasets: [{
                    label: 'Pendapatan',
                    data: {!! json_encode($chartTotals) !!},
                    backgroundColor: '#4318FF',
                    borderRadius: 4,
                    barThickness: 32,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6', drawBorder: false },
                        border: { display: false },
                        ticks: { display: false } // Hide y-axis numbers to match design
                    },
                    x: {
                        grid: { display: false, drawBorder: false },
                        border: { display: false },
                        ticks: { font: { size: 11, family: "'Inter', sans-serif" }, color: '#a3aed1' }
                    }
                }
            }
        });

        // Pie Chart (Kategori Armada)
        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCategory, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($kategoriLabels) !!},
                datasets: [{
                    data: {!! json_encode($kategoriCounts) !!},
                    backgroundColor: ['#4318FF', '#6AD2FF', '#E2E8F0'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { 
                            boxWidth: 8, 
                            boxHeight: 8, 
                            usePointStyle: true, 
                            pointStyle: 'circle',
                            font: { size: 11, family: "'Inter', sans-serif" },
                            color: '#a3aed1'
                        }
                    }
                },
                cutout: '75%'
            }
        });
    });
</script>
@endsection
