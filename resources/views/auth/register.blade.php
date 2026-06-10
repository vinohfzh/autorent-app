<x-guest-layout>
    <div class="text-center mb-4">
        <h2 class="fw-bold fs-4 mb-1">Buat akun AutoRent</h2>
        <p class="text-muted small">Nikmati kemudahan sewa mobil premium dalam hitungan menit.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label small fw-medium">Nama Lengkap</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label small fw-medium">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="contoh@email.com" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Phone Number -->
        <div class="mb-3">
            <label for="phone" class="form-label small fw-medium">No. HP</label>
            <div class="input-group">
                <span class="input-group-text bg-light text-muted" id="basic-addon1">+62</span>
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="812-3456-7890" required autocomplete="tel">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label small fw-medium">Password</label>
            <div class="input-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Min. 8 karakter" required autocomplete="new-password">
                <button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1">
                    <i class="bi bi-eye"></i>
                </button>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label small fw-medium">Konfirmasi Password</label>
            <div class="input-group">
                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Ulangi password Anda" required autocomplete="new-password">
                <button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1">
                    <i class="bi bi-eye"></i>
                </button>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Terms -->
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="terms" required>
            <label class="form-check-label small text-muted" for="terms">
                Saya menyetujui <a href="#" class="text-decoration-none text-indigo">Syarat & Ketentuan</a> serta Kebijakan Privasi yang berlaku.
            </label>
        </div>

        <button type="submit" class="btn btn-primary-custom w-100 text-white mb-4">Buat Akun</button>

        <p class="text-center small text-muted mb-0">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-medium text-indigo">Masuk</a>
        </p>
    </form>
</x-guest-layout>
