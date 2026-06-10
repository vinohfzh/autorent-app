@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4 rounded-3 border-0 shadow-sm" role="alert" style="background-color: #f0fdf4; color: #166534;">
            <i class="bi bi-check-circle-fill"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif
    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="fw-bold fs-3 mb-1">Pelanggan</h1>
            <p class="text-muted small mb-0">Daftar pelanggan terdaftar di AutoRent.</p>
        </div>
        <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-primary-custom text-white d-flex align-items-center gap-2">
            <i class="bi bi-person-plus-fill"></i> Tambah Pelanggan
        </a>
    </div>

    <div class="card card-custom p-4">
        @if($pelanggans->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-people text-muted mb-3 d-block" style="font-size: 4rem; opacity: 0.3;"></i>
                <h5 class="fw-bold text-dark mb-2">Belum Ada Pelanggan</h5>
                <p class="text-muted">Data pelanggan akan muncul secara otomatis ketika user memesan kendaraan.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-borderless align-middle table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Nama</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">No KTP</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">No Handphone</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Alamat</th>
                            <th class="small fw-semibold text-muted text-uppercase" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Email</th>
                            <th class="small fw-semibold text-muted text-uppercase text-end" style="letter-spacing: 0.5px; border-bottom: 2px solid #f4f7fe !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelanggans as $p)
                            <tr class="border-bottom" style="border-color: #f4f7fe !important;">
                                <td class="py-3" style="max-width: 150px;">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center fw-bold text-indigo flex-shrink-0" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                            {{ strtoupper(substr($p->nama, 0, 1)) }}
                                        </div>
                                        <span class="small fw-semibold text-truncate" title="{{ $p->nama }}">{{ $p->nama }}</span>
                                    </div>
                                </td>
                                <td class="small fw-medium text-muted py-3">{{ $p->no_ktp }}</td>
                                <td class="small py-3">{{ $p->no_hp }}</td>
                                <td class="small text-muted py-3 text-truncate" style="max-width: 200px;" title="{{ $p->alamat }}">{{ $p->alamat }}</td>
                                <td class="small py-3 text-truncate" style="max-width: 150px;">
                                    <a href="mailto:{{ $p->email }}" class="text-indigo text-decoration-none" title="{{ $p->email }}">{{ $p->email ?? '-' }}</a>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <a href="{{ route('admin.pelanggan.edit', $p->id) }}" class="btn btn-light btn-sm rounded-pill px-3" style="font-size: 0.75rem;">
                                            <i class="bi bi-pencil me-1"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.pelanggan.destroy', $p->id) }}" class="needs-loading" onsubmit="return confirmAction(event, this, 'Hapus Pelanggan?', 'Data pelanggan {{ $p->nama }} akan dihapus permanen.', 'Ya, Hapus', '#dc2626');">
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

            <!-- Pagination -->
            @if($pelanggans->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $pelanggans->links() }}
                </div>
            @endif
        @endif
    </div>

</div>
@endsection
