<section>
    <header>
        <h2 class="fw-bold fs-4 text-dark mb-1">
            Informasi Profil
        </h2>
        <p class="text-muted small">
            Perbarui informasi profil, alamat email, nomor telepon, dan foto profil akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('patch')

        <!-- Avatar Upload -->
        <div class="mb-4">
            <label class="form-label small fw-medium">Foto Profil</label>
            <div class="d-flex align-items-center gap-3">
                @if($user->avatar)
                    <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="rounded-circle object-fit-cover shadow-sm" width="64" height="64">
                @else
                    <div class="bg-indigo text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width:64px; height:64px; font-size:24px; font-weight:600;">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
                <div class="flex-grow-1">
                    <input class="form-control form-control-sm @error('avatar') is-invalid @enderror" type="file" id="avatar" name="avatar" accept="image/*">
                    <div class="form-text">Maksimal ukuran file 2MB (JPG, PNG).</div>
                    @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label small fw-medium">Nama Lengkap</label>
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autocomplete="name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label small fw-medium">No. HP</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted">+62</span>
                    <input id="phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" required autocomplete="tel">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mt-3 mb-4">
            <label for="email" class="form-label small fw-medium">Email</label>
            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="small text-warning mb-1">
                        Alamat email Anda belum diverifikasi.
                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline text-decoration-none small fw-medium">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="small text-success fw-medium">
                            Link verifikasi baru telah dikirim ke alamat email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary-custom text-white">Simpan Perubahan</button>
        </div>
    </form>
</section>
