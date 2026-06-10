<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 – Akses Ditolak | AutoRent</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .brand-logo-box { width:32px; height:32px; background:#4f46e5; border-radius:8px; display:flex; align-items:center; justify-content:center; }
        .brand-text { font-size:1.25rem; font-weight:800; color:#4f46e5; letter-spacing:-0.5px; }
        .error-code { font-size: 8rem; font-weight: 800; color: #fee2e2; line-height: 1; letter-spacing: -0.05em; }
        .btn-primary-custom { background-color:#4f46e5; border-color:#4f46e5; border-radius:50px; padding:0.6rem 1.5rem; font-weight:500; transition:all 0.2s; }
        .btn-primary-custom:hover { background-color:#4338ca; border-color:#4338ca; }
    </style>
</head>
<body>
    <nav class="navbar bg-white border-bottom py-2">
        <div class="container-xl px-4 px-md-5">
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center gap-2 text-decoration-none">
                <div class="brand-logo-box">
                    <svg width="18" height="16" viewBox="0 0 24 20" fill="none"><path d="M21 8H19.5L17.5 3C17.19 2.4 16.56 2 15.86 2H8.14C7.44 2 6.81 2.4 6.5 3L4.5 8H3C2.45 8 2 8.45 2 9C2 9.55 2.45 10 3 10H3.5L3 10.5V17C3 17.55 3.45 18 4 18H5C5.55 18 6 17.55 6 17V16H18V17C18 17.55 18.45 18 19 18H20C20.55 18 21 17.55 21 17V10.5L20.5 10H21C21.55 10 22 9.55 22 9C22 8.45 21.55 8 21 8ZM7.5 13C6.67 13 6 12.33 6 11.5C6 10.67 6.67 10 7.5 10C8.33 10 9 10.67 9 11.5C9 12.33 8.33 13 7.5 13ZM16.5 13C15.67 13 15 12.33 15 11.5C15 10.67 15.67 10 16.5 10C17.33 10 18 10.67 18 11.5C18 12.33 17.33 13 16.5 13ZM5 8L7.5 3H16.5L19 8H5Z" fill="white"/></svg>
                </div>
                <span class="brand-text">AutoRent</span>
            </a>
        </div>
    </nav>
    <div class="min-vh-100 d-flex align-items-center justify-content-center text-center px-4" style="padding-top: 4rem; padding-bottom: 4rem;">
        <div>
            <div class="error-code mb-2">403</div>
            <i class="bi bi-shield-x text-danger mb-3 d-block" style="font-size: 3rem;"></i>
            <h1 class="fw-bold fs-2 text-dark mb-2">Akses Ditolak</h1>
            <p class="text-muted mb-5" style="max-width: 400px; margin: 0 auto;">
                Anda tidak memiliki izin untuk mengakses halaman ini. Silakan login terlebih dahulu atau hubungi administrator.
            </p>
            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                <a href="{{ url('/') }}" class="btn btn-primary-custom text-white"><i class="bi bi-house me-2"></i>Kembali ke Beranda</a>
                @guest
                <a href="{{ route('login') }}" class="btn btn-outline-secondary rounded-pill"><i class="bi bi-box-arrow-in-right me-2"></i>Login</a>
                @endguest
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
