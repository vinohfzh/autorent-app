<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold fs-4 mb-0 text-dark">Dashboard</h2>
    </x-slot>

    <div class="container-xl px-4 px-md-5 py-5">

        <!-- Welcome Card with Avatar -->
        <div class="card card-custom p-4 p-md-5 mb-4">
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-4">
                <!-- Avatar -->
                <div class="flex-shrink-0">
                    @if(Auth::user()->avatar)
                        <img src="{{ Storage::url(Auth::user()->avatar) }}"
                             alt="Avatar {{ Auth::user()->name }}"
                             class="rounded-circle object-fit-cover shadow"
                             style="width: 80px; height: 80px;">
                    @else
                        <div class="bg-indigo text-white rounded-circle d-flex align-items-center justify-content-center shadow"
                             style="width: 80px; height: 80px; font-size: 2rem; font-weight: 700;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <!-- User Info -->
                <div class="flex-grow-1">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                        <h4 class="fw-bold mb-0">{{ Auth::user()->name }}</h4>
                        <span class="badge rounded-pill"
                              style="background-color: #eef2ff; color: #4338ca; font-weight: 600; font-size: 0.7rem; padding: 4px 10px;">
                            <i class="bi bi-person-check me-1"></i>{{ ucfirst(Auth::user()->role ?? 'User') }}
                        </span>
                    </div>
                    <p class="text-muted small mb-1">
                        <i class="bi bi-envelope me-1"></i>{{ Auth::user()->email }}
                    </p>
                    @if(Auth::user()->phone)
                    <p class="text-muted small mb-0">
                        <i class="bi bi-telephone me-1"></i>{{ Auth::user()->phone }}
                    </p>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-2 flex-shrink-0">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary-custom text-white">
                        <i class="bi bi-pencil me-2"></i>Edit Profil
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card card-custom p-4 text-center h-100 d-flex flex-column" style="transition: transform 0.2s, box-shadow 0.2s;">
                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3"
                             style="width:56px; height:56px; background:#eef2ff;">
                            <i class="bi bi-car-front fs-3 text-indigo"></i>
                        </div>
                        <h5 class="fw-bold mb-1">Pesan Mobil</h5>
                        <p class="text-muted small mb-0">Mulai petualangan Anda dengan memilih armada premium kami.</p>
                    </div>
                    <div class="mt-auto">
                        <a href="{{ route('katalog') }}" class="btn btn-primary-custom w-100 text-white">
                            <i class="bi bi-search me-2"></i>Lihat Katalog
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-custom p-4 text-center h-100 d-flex flex-column" style="transition: transform 0.2s, box-shadow 0.2s;">
                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3"
                             style="width:56px; height:56px; background:#f0fdf4;">
                            <i class="bi bi-clock-history fs-3" style="color: #16a34a;"></i>
                        </div>
                        <h5 class="fw-bold mb-1">Riwayat Sewa</h5>
                        <p class="text-muted small mb-0">Pantau status pesanan dan riwayat perjalanan Anda.</p>
                    </div>
                    <div class="mt-auto">
                        <a href="{{ route('riwayat') }}" class="btn btn-outline-custom w-100">
                            <i class="bi bi-list-ul me-2"></i>Lihat Riwayat
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-custom p-4 text-center h-100 d-flex flex-column" style="transition: transform 0.2s, box-shadow 0.2s;">
                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3"
                             style="width:56px; height:56px; background:#fff7ed;">
                            <i class="bi bi-person-gear fs-3" style="color: #ea580c;"></i>
                        </div>
                        <h5 class="fw-bold mb-1">Pengaturan Akun</h5>
                        <p class="text-muted small mb-0">Perbarui data diri, password, dan foto profil Anda.</p>
                    </div>
                    <div class="mt-auto">
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-custom w-100">
                            <i class="bi bi-gear me-2"></i>Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
