<section>
    <header>
        <h2 class="fw-bold fs-4 text-dark mb-1">
            Perbarui Password
        </h2>
        <p class="text-muted small">
            Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label small fw-medium">Password Saat Ini</label>
            <div class="input-group">
                <input id="current_password" name="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
                <button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1">
                    <i class="bi bi-eye"></i>
                </button>
                @error('current_password', 'updatePassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label small fw-medium">Password Baru</label>
            <div class="input-group">
                <input id="password" name="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                <button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1">
                    <i class="bi bi-eye"></i>
                </button>
                @error('password', 'updatePassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label small fw-medium">Konfirmasi Password</label>
            <div class="input-group">
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                <button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1">
                    <i class="bi bi-eye"></i>
                </button>
                @error('password_confirmation', 'updatePassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary-custom text-white">Simpan Password</button>
        </div>
    </form>
</section>
