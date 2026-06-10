@extends('layouts.admin')

@section('title', 'Pengaturan Profil Admin')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="fw-bold fs-4 mb-1 text-dark">Pengaturan Profil</h1>
</div>

<!-- Flash Success Toast -->
@if (session('status') && session('status') !== 'profile-updated')
    <div class="alert alert-success d-flex align-items-center gap-2 mb-4 rounded-3 border-0 shadow-sm" role="alert" style="background-color: #f0fdf4; color: #166534;">
        <i class="bi bi-check-circle-fill"></i>
        <div>{{ session('status') }}</div>
    </div>
@endif

@if (session('status') === 'profile-updated')
    <div class="alert alert-success d-flex align-items-center gap-2 mb-4 rounded-3 border-0 shadow-sm" role="alert" style="background-color: #f0fdf4; color: #166534;">
        <i class="bi bi-check-circle-fill"></i>
        <div>Profil berhasil diperbarui!</div>
    </div>
@endif

<div class="row g-4">
    <div class="col-12 col-xl-8">
        <!-- Update Profile Info -->
        <div class="card card-custom p-4 p-md-5 mb-4">
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Update Password -->
        <div class="card card-custom p-4 p-md-5 mb-4">
            @include('profile.partials.update-password-form')
        </div>
    </div>
    
    <div class="col-12 col-xl-4">
        <!-- Danger Zone: Delete Account -->
        <div class="card p-4 p-md-5 shadow-sm" style="border: 1px solid #fee2e2; border-radius: 20px; background: #fff;">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
