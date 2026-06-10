@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">

    <div class="mb-4">
        <a href="{{ route('admin.pelanggan.index') }}" class="text-indigo text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1 mb-2">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>
        <h1 class="fw-bold fs-3 mb-1">Tambah Pelanggan</h1>
        <p class="text-muted small mb-0">Tambahkan data pelanggan secara manual ke dalam sistem.</p>
    </div>

    <div class="card card-custom p-4 p-md-5 max-w-2xl">
        <form method="POST" action="{{ route('admin.pelanggan.store') }}" class="needs-loading">
            @csrf

            <div class="row g-3">
                <!-- Nama Lengkap -->
                <div class="col-md-6">
                    <label for="nama" class="form-label small fw-semibold">Nama Lengkap</label>
                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autofocus>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- No KTP -->
                <div class="col-md-6">
                    <label for="no_ktp" class="form-label small fw-semibold">No. Identitas (KTP)</label>
                    <input id="no_ktp" type="text" class="form-control @error('no_ktp') is-invalid @enderror" name="no_ktp" value="{{ old('no_ktp') }}" required>
                    @error('no_ktp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- No Handphone -->
                <div class="col-md-6">
                    <label for="no_hp" class="form-label small fw-semibold">No. Handphone / WhatsApp</label>
                    <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" required>
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label small fw-semibold">Email <span class="text-muted fw-normal">(Opsional)</span></label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="col-12">
                    <label for="alamat" class="form-label small fw-semibold">Alamat Lengkap</label>
                    <textarea id="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom text-white">Simpan Pelanggan</button>
                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
            </div>
        </form>
    </div>

</div>
@endsection
