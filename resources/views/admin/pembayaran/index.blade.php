@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4 rounded-3 border-0 shadow-sm" role="alert" style="background-color: #f0fdf4; color: #166534;">
            <i class="bi bi-check-circle-fill"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if(session('status'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4 rounded-3 border-0 shadow-sm" role="alert" style="background-color: #f0fdf4; color: #166534;">
            <i class="bi bi-check-circle-fill"></i>
            <div>{{ session('status') }}</div>
        </div>
    @endif

    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="fw-bold fs-3 mb-1">Pembayaran</h1>
            <p class="text-muted small mb-0">Kelola dan pantau seluruh transaksi pembayaran pelanggan.</p>
        </div>
    </div>

    <div class="card card-custom p-4">
        @if($pembayarans->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-credit-card text-muted mb-3 d-block" style="font-size: 4rem; opacity: 0.3;"></i>
                <h5 class="fw-bold text-dark mb-2">Belum Ada Pembayaran</h5>
                <p class="text-muted">Data transaksi pembayaran akan tercatat di sini.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-borderless align-middle table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">ID Bayar</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Order ID</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Pelanggan</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Jumlah Bayar</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Metode</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Tanggal Bayar</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Status</th>
                            <th class="small fw-semibold text-muted text-uppercase text-end" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayarans as $p)
                            <tr class="border-bottom" style="border-color: #f4f7fe !important;">
                                <td class="small fw-bold py-3">#PAY-{{ str_pad($p->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td class="small fw-semibold py-3">#{{ str_pad($p->transaksi_id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td class="py-3" style="max-width: 150px;">
                                    <div class="small fw-medium text-truncate" title="{{ $p->transaksi?->pelanggan?->nama ?? '-' }}">{{ $p->transaksi?->pelanggan?->nama ?? '-' }}</div>
                                </td>
                                <td class="small fw-bold text-indigo py-3">Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                                <td class="small py-3"><span class="badge bg-light text-dark">{{ strtoupper($p->metode) }}</span></td>
                                <td class="small text-muted py-3">{{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d M Y') }}</td>
                                <td class="py-3">
                                    <span class="status-badge status-{{ $p->status_bayar === 'lunas' ? 'selesai' : ($p->status_bayar === 'dp' ? 'aktif' : 'menunggu') }}">
                                        {{ ucfirst($p->status_bayar) }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center justify-content-end gap-1">
                                        @if($p->status_bayar !== 'lunas')
                                            <form method="POST" action="{{ route('admin.pembayaran.approve', $p->id) }}" class="needs-loading" onsubmit="return confirmAction(event, this, 'Approve Pembayaran?', 'Dana sudah masuk dan valid?', 'Ya, Setujui', '#166534');">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm rounded-pill px-3" style="font-size: 0.72rem;">Setujui</button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.pembayaran.reject', $p->id) }}" class="needs-loading" onsubmit="return confirmAction(event, this, 'Tolak Pembayaran?', 'Pembayaran ini akan ditolak.', 'Ya, Tolak', '#dc2626');">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3" style="font-size: 0.72rem;">Tolak</button>
                                            </form>
                                        @else
                                            <span class="text-muted small px-2">-</span>
                                        @endif
                                        
                                        <form method="POST" action="{{ route('admin.pembayaran.destroy', $p->id) }}" class="needs-loading ms-1" onsubmit="return confirmAction(event, this, 'Hapus Pembayaran?', 'Catatan pembayaran ini akan dihapus permanen.', 'Ya, Hapus', '#dc2626');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle" style="width: 28px; height: 28px; padding: 0; display: flex; align-items: center; justify-content: center;" title="Hapus">
                                                <i class="bi bi-trash" style="font-size: 0.75rem;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($pembayarans->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $pembayarans->links() }}
                </div>
            @endif
        @endif
    </div>

</div>
@endsection
