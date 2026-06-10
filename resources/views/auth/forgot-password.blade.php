<x-guest-layout>
    <div class="text-center mb-4">
        <h2 class="fw-bold fs-4 mb-1">Reset Password</h2>
        <p class="text-muted small">Masukkan email kamu, kami kirim link reset.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label small fw-medium">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary-custom w-100 text-white mb-4">Kirim Link</button>

        <div class="text-center">
            <a href="{{ route('login') }}" class="text-decoration-none small fw-medium text-indigo d-inline-flex align-items-center gap-1">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Masuk
            </a>
        </div>
    </form>
</x-guest-layout>
