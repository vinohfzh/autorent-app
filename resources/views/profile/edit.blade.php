<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="fw-bold fs-4 mb-0 text-dark">Profil Saya</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-indigo">Dashboard</a></li>
                    <li class="breadcrumb-item active text-muted">Profil</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="container-xl px-4 px-md-5 py-5">
        <div class="row g-4">

            <!-- Sidebar: Profile Summary -->
            <div class="col-12 col-lg-4">
                <div class="card card-custom p-4 text-center mb-4">
                    <!-- Avatar Display -->
                    <div class="mb-3">
                        @if(Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}"
                                 alt="Avatar"
                                 class="rounded-circle object-fit-cover shadow mb-2"
                                 style="width: 96px; height: 96px;">
                        @else
                            <div class="bg-indigo text-white rounded-circle d-flex align-items-center justify-content-center shadow mx-auto mb-2"
                                 style="width: 96px; height: 96px; font-size: 2.5rem; font-weight: 700;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                    <p class="text-muted small mb-2">{{ Auth::user()->email }}</p>

                    <span class="badge rounded-pill d-inline-block mb-3"
                          style="background-color:#eef2ff; color:#4338ca; font-weight:600; font-size:0.7rem; padding: 5px 12px;">
                        <i class="bi bi-person-check me-1"></i>{{ ucfirst(Auth::user()->role ?? 'User') }}
                    </span>

                    @if(Auth::user()->phone)
                    <div class="d-flex align-items-center justify-content-center gap-2 text-muted small mb-3">
                        <i class="bi bi-telephone"></i>
                        <span>{{ Auth::user()->phone }}</span>
                    </div>
                    @endif

                    <div class="text-muted small border-top pt-3">
                        <i class="bi bi-calendar3 me-1"></i>
                        Bergabung sejak {{ Auth::user()->created_at->format('M Y') }}
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="card card-custom p-0 overflow-hidden">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-2 border-0">
                            <i class="bi bi-speedometer2 text-indigo"></i>
                            <span class="small fw-medium">Dashboard</span>
                        </a>
                        <a href="{{ route('katalog') }}" class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-2 border-0">
                            <i class="bi bi-car-front text-indigo"></i>
                            <span class="small fw-medium">Katalog Mobil</span>
                        </a>
                        <a href="{{ route('riwayat') }}" class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-2 border-0">
                            <i class="bi bi-clock-history text-indigo"></i>
                            <span class="small fw-medium">Riwayat Sewa</span>
                        </a>
                        <div class="list-group-item py-3 px-4 d-flex align-items-center gap-2 border-0" style="background: #eef2ff;">
                            <i class="bi bi-person-gear text-indigo"></i>
                            <span class="small fw-bold text-indigo">Edit Profil</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main: Forms -->
            <div class="col-12 col-lg-8">

                <!-- Flash Success Toast -->
                @if (session('status') && session('status') !== 'profile-updated')
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
                        <i class="bi bi-check-circle-fill"></i>
                        <div>{{ session('status') }}</div>
                    </div>
                @endif

                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
                        <i class="bi bi-check-circle-fill"></i>
                        <div>Profil berhasil diperbarui!</div>
                    </div>
                @endif

                <!-- Update Profile Info -->
                <div class="card card-custom p-4 p-md-5 mb-4">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Update Password -->
                <div class="card card-custom p-4 p-md-5 mb-4">
                    @include('profile.partials.update-password-form')
                </div>

                <!-- Danger Zone: Delete Account -->
                <div class="card p-4 p-md-5" style="border: 1px solid #fee2e2; border-radius: 1rem; background: #fff;">
                    @include('profile.partials.delete-user-form')
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
