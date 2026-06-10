@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">

    <div class="mb-4">
        <a href="{{ route('admin.armada.index') }}" class="text-indigo text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1 mb-2">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>
        <h1 class="fw-bold fs-3 mb-1">Edit Mobil</h1>
        <p class="text-muted small mb-0">Ubah detail kendaraan {{ $armada->nama_mobil }}.</p>
    </div>

    <div class="card card-custom p-4 p-md-5">
        <form method="POST" action="{{ route('admin.armada.update', $armada->id) }}" class="needs-loading">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <!-- Nama Mobil -->
                <div class="col-md-6">
                    <label for="nama_mobil" class="form-label small fw-semibold">Nama Mobil</label>
                    <input id="nama_mobil" type="text" class="form-control @error('nama_mobil') is-invalid @enderror" name="nama_mobil" value="{{ old('nama_mobil', $armada->nama_mobil) }}" required autofocus>
                    @error('nama_mobil')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Merek -->
                <div class="col-md-6">
                    <label for="merek" class="form-label small fw-semibold">Merek</label>
                    <input id="merek" type="text" class="form-control @error('merek') is-invalid @enderror" name="merek" value="{{ old('merek', $armada->merek) }}" required>
                    @error('merek')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Plat Nomor -->
                <div class="col-md-6">
                    <label for="plat_nomor" class="form-label small fw-semibold">Plat Nomor</label>
                    <input id="plat_nomor" type="text" class="form-control @error('plat_nomor') is-invalid @enderror" name="plat_nomor" value="{{ old('plat_nomor', $armada->plat_nomor) }}" required>
                    @error('plat_nomor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kategori -->
                <div class="col-md-6">
                    <label for="kategori_id" class="form-label small fw-semibold">Kategori</label>
                    <select id="kategori_id" name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id }}" {{ old('kategori_id', $armada->kategori_id) == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Harga Sewa -->
                <div class="col-md-6">
                    <label for="harga_sewa" class="form-label small fw-semibold">Harga Sewa / Hari (Rp)</label>
                    <input id="harga_sewa" type="number" min="0" class="form-control @error('harga_sewa') is-invalid @enderror" name="harga_sewa" value="{{ old('harga_sewa', $armada->harga_sewa) }}" required>
                    @error('harga_sewa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label for="status" class="form-label small fw-semibold">Status</label>
                    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="tersedia" {{ old('status', $armada->status) === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="disewa" {{ old('status', $armada->status) === 'disewa' ? 'selected' : '' }}>Disewa</option>
                        <option value="maintenance" {{ old('status', $armada->status) === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Keterangan -->
                <div class="col-12">
                    <label for="keterangan" class="form-label small fw-semibold">Keterangan / Fasilitas</label>
                    <textarea id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3">{{ old('keterangan', $armada->keterangan) }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom text-white">Update Mobil</button>
                <a href="{{ route('admin.armada.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
            </div>
        </form>
    </div>

</div>
@endsection
