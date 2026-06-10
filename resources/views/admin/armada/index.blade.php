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
            <h1 class="fw-bold fs-3 mb-1">Armada</h1>
            <p class="text-muted small mb-0">Kelola daftar kendaraan sewa AutoRent.</p>
        </div>
        <a href="{{ route('admin.armada.create') }}" class="btn btn-primary-custom text-white d-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> Tambah Mobil
        </a>
    </div>

    <div class="card card-custom p-4">
        @if($kendaraans->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-car-front text-muted mb-3 d-block" style="font-size: 4rem; opacity: 0.3;"></i>
                <h5 class="fw-bold text-dark mb-2">Belum Ada Armada</h5>
                <p class="text-muted mb-4">Silakan tambahkan kendaraan baru ke sistem.</p>
                <a href="{{ route('admin.armada.create') }}" class="btn btn-primary-custom text-white">Tambah Mobil</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-borderless align-middle table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Mobil / Merek</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Kategori</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Plat Nomor</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Harga Sewa</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Status</th>
                            <th class="small fw-semibold text-muted text-uppercase text-end" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kendaraans as $k)
                            <tr class="border-bottom" style="border-color: #f4f7fe !important;">
                                <td class="py-3" style="max-width: 200px;">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-light rounded-3 p-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                                            <i class="bi bi-car-front text-indigo fs-5"></i>
                                        </div>
                                        <div class="overflow-hidden">
                                            <h6 class="fw-bold mb-0 small text-truncate" title="{{ $k->nama_mobil }}">{{ $k->nama_mobil }}</h6>
                                            <span class="text-muted d-block text-truncate" style="font-size: 0.75rem;">{{ $k->merek }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="small py-3">{{ $k->kategori?->nama_kategori }}</td>
                                <td class="small fw-medium py-3">{{ $k->plat_nomor }}</td>
                                <td class="small fw-semibold text-indigo py-3">Rp {{ number_format($k->harga_sewa, 0, ',', '.') }}<span class="text-muted font-normal" style="font-size:0.75rem;">/hari</span></td>
                                <td class="py-3">
                                    <span class="status-badge status-{{ $k->status === 'tersedia' ? 'selesai' : ($k->status === 'disewa' ? 'aktif' : 'dibatalkan') }}">
                                        {{ $k->status === 'tersedia' ? 'Tersedia' : ($k->status === 'disewa' ? 'Disewa' : 'Maintenance') }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <a href="{{ route('admin.armada.edit', $k->id) }}" class="btn btn-light btn-sm rounded-pill px-3" style="font-size: 0.75rem;">
                                            <i class="bi bi-pencil me-1"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.armada.destroy', $k->id) }}" class="needs-loading" onsubmit="return confirmAction(event, this, 'Hapus Armada?', 'Data mobil {{ $k->nama_mobil }} akan dihapus permanen.', 'Ya, Hapus', '#dc2626');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3" style="font-size: 0.75rem;">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
@endsection
