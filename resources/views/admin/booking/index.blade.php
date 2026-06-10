@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="fw-bold fs-3 mb-1">Daftar Booking</h1>
            <p class="text-muted small mb-0">Kelola dan pantau seluruh transaksi rental.</p>
        </div>
    </div>

    <!-- Filter Status Tabs -->
    <div class="d-flex gap-2 flex-wrap mb-4">
        <a href="{{ route('admin.booking.index') }}" class="btn btn-sm btn-light rounded-pill px-3 {{ !request()->filled('status') ? 'active bg-indigo text-white' : '' }}">Semua</a>
        <a href="{{ route('admin.booking.index', ['status' => 'aktif']) }}" class="btn btn-sm btn-light rounded-pill px-3 {{ request()->status === 'aktif' ? 'active bg-indigo text-white' : '' }}">Aktif</a>
        <a href="{{ route('admin.booking.index', ['status' => 'selesai']) }}" class="btn btn-sm btn-light rounded-pill px-3 {{ request()->status === 'selesai' ? 'active bg-indigo text-white' : '' }}">Selesai</a>
        <a href="{{ route('admin.booking.index', ['status' => 'dibatalkan']) }}" class="btn btn-sm btn-light rounded-pill px-3 {{ request()->status === 'dibatalkan' ? 'active bg-indigo text-white' : '' }}">Dibatalkan</a>
    </div>

    <div class="card card-custom p-4">
        @if($transaksis->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-calendar-x text-muted mb-3 d-block" style="font-size: 4rem; opacity: 0.3;"></i>
                <h5 class="fw-bold text-dark mb-2">Belum Ada Transaksi</h5>
                <p class="text-muted">Tidak ditemukan transaksi dengan kriteria pencarian Anda.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-borderless align-middle table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Order ID</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Pelanggan</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Mobil</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Tanggal Sewa</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Total Harga</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Status</th>
                            <th class="small fw-semibold text-muted text-uppercase text-end" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksis as $t)
                            <tr class="border-bottom" style="border-color: #f4f7fe !important;">
                                <td class="small fw-bold">#{{ str_pad($t->id, 7, '0', STR_PAD_LEFT) }}</td>
                                <td style="max-width: 150px;">
                                    <div class="small fw-semibold text-truncate" title="{{ $t->pelanggan?->nama ?? '-' }}">{{ $t->pelanggan?->nama ?? '-' }}</div>
                                    <div class="text-muted text-truncate" style="font-size: 0.75rem;">{{ $t->pelanggan?->no_hp ?? '-' }}</div>
                                </td>
                                <td style="max-width: 150px;">
                                    <div class="small fw-semibold text-truncate" title="{{ $t->kendaraan?->nama_mobil ?? 'Dihapus' }}">{{ $t->kendaraan?->nama_mobil ?? 'Dihapus' }}</div>
                                    <div class="text-muted text-truncate" style="font-size: 0.75rem;">{{ $t->kendaraan?->plat_nomor ?? '-' }}</div>
                                </td>
                                <td class="small text-muted">
                                    {{ \Carbon\Carbon::parse($t->tgl_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($t->tgl_selesai)->format('d M Y') }}
                                    <div class="fw-medium text-indigo" style="font-size: 0.75rem;">({{ $t->total_hari }} Hari)</div>
                                </td>
                                <td class="small fw-bold text-indigo">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="status-badge status-{{ $t->status === 'menunggu' ? 'pending' : $t->status }}">{{ ucfirst($t->status) }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-end gap-1">
                                        @if($t->status === 'aktif' || $t->status === 'menunggu')
                                            <form method="POST" action="{{ route('admin.booking.status', $t->id) }}" class="needs-loading" onsubmit="return confirmAction(event, this, 'Selesaikan Booking?', 'Pastikan pelanggan telah mengembalikan mobil.', 'Ya, Selesaikan', '#166534');">
                                                @csrf
                                                <input type="hidden" name="status" value="selesai">
                                                <button type="submit" class="btn btn-success btn-sm rounded-pill px-3" style="font-size: 0.75rem;">Selesaikan</button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.booking.status', $t->id) }}" class="needs-loading" onsubmit="return confirmAction(event, this, 'Batalkan Booking?', 'Transaksi ini akan dibatalkan.', 'Ya, Batalkan', '#dc2626');">
                                                @csrf
                                                <input type="hidden" name="status" value="dibatalkan">
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3" style="font-size: 0.75rem;">Batalkan</button>
                                            </form>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
@endsection
