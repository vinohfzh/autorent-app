<x-guest-layout>
    <div class="text-center mb-4">
        <h2 class="fw-bold fs-4 mb-1">Selamat datang kembali</h2>
        <p class="text-muted small">Masuk untuk melanjutkan perjalananmu.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label small fw-medium">Alamat Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <label for="password" class="form-label small fw-medium mb-0">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="small text-decoration-none text-indigo">Lupa password?</a>
                @endif
            </div>
            <div class="input-group mt-1">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="••••••••" required autocomplete="current-password">
                <button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1">
                    <i class="bi bi-eye"></i>
                </button>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
            <label class="form-check-label small text-muted" for="remember_me">
                Ingat saya di perangkat ini
            </label>
        </div>

        <button type="submit" class="btn btn-primary-custom w-100 text-white mb-4">Masuk</button>

        <div class="position-relative text-center mb-4">
            <hr class="text-secondary opacity-25">
            <span class="position-absolute top-50 start-50 translate-middle bg-white px-2 text-muted" style="font-size: 0.75rem;">atau lanjut dengan</span>
        </div>

        <button type="button" class="btn btn-outline-secondary w-100 rounded-pill mb-4 d-flex align-items-center justify-content-center gap-2" style="font-size: 0.9rem;">
            <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            Google
        </button>

        <p class="text-center small text-muted mb-0">
            Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none fw-medium text-indigo">Daftar</a>
        </p>
    </form>
</x-guest-layout>
