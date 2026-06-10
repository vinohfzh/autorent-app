<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AutoRent') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

        <style>
            body { 
                font-family: 'Inter', sans-serif; 
                background-color: #f8f9fa;
                color: #111827;
            }
            .auth-wrapper {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 2rem 1rem;
            }
            .brand-logo-box {
                width: 36px; height: 36px;
                background: #4f46e5;
                border-radius: 8px;
                display: flex; align-items: center; justify-content: center;
            }
            .brand-text {
                font-size: 1.5rem; font-weight: 800; color: #4f46e5; letter-spacing: -0.5px;
            }
            .auth-card {
                width: 100%;
                max-width: 450px;
                background: #fff;
                border-radius: 1rem;
                box-shadow: 0 10px 25px rgba(79, 70, 229, 0.1);
                border: 1px solid rgba(0,0,0,0.05);
                padding: 2.5rem;
                margin-top: 2rem;
            }
            .form-control {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
                border-radius: 0.5rem;
            }
            .form-control:focus {
                border-color: #4f46e5;
                box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
            }
            .btn-primary-custom {
                background-color: #4f46e5;
                border-color: #4f46e5;
                border-radius: 50px;
                padding: 0.6rem 1.5rem;
                font-weight: 500;
                transition: all 0.2s;
            }
            .btn-primary-custom:hover {
                background-color: #4338ca;
                border-color: #4338ca;
            }
            .text-indigo { color: #4f46e5; }
            .text-indigo:hover { color: #4338ca; }
        </style>
    </head>
    <body>
        <div class="auth-wrapper">
            <div>
                <a href="/" class="text-decoration-none d-flex align-items-center gap-2">
                    <div class="brand-logo-box">
                        <svg width="20" height="18" viewBox="0 0 24 20" fill="none">
                            <path d="M21 8H19.5L17.5 3C17.19 2.4 16.56 2 15.86 2H8.14C7.44 2 6.81 2.4 6.5 3L4.5 8H3C2.45 8 2 8.45 2 9C2 9.55 2.45 10 3 10H3.5L3 10.5V17C3 17.55 3.45 18 4 18H5C5.55 18 6 17.55 6 17V16H18V17C18 17.55 18.45 18 19 18H20C20.55 18 21 17.55 21 17V10.5L20.5 10H21C21.55 10 22 9.55 22 9C22 8.45 21.55 8 21 8ZM7.5 13C6.67 13 6 12.33 6 11.5C6 10.67 6.67 10 7.5 10C8.33 10 9 10.67 9 11.5C9 12.33 8.33 13 7.5 13ZM16.5 13C15.67 13 15 12.33 15 11.5C15 10.67 15.67 10 16.5 10C17.33 10 18 10.67 18 11.5C18 12.33 17.33 13 16.5 13ZM5 8L7.5 3H16.5L19 8H5Z" fill="white"/>
                        </svg>
                    </div>
                    <span class="brand-text">AutoRent</span>
                </a>
            </div>

            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>

        <!-- Bootstrap 5 JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- UI Enhancement Scripts -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Show/Hide Password
                const togglePasswordBtns = document.querySelectorAll('.toggle-password');
                togglePasswordBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const input = this.previousElementSibling;
                        const icon = this.querySelector('i');
                        if (input.type === 'password') {
                            input.type = 'text';
                            icon.classList.remove('bi-eye');
                            icon.classList.add('bi-eye-slash');
                        } else {
                            input.type = 'password';
                            icon.classList.remove('bi-eye-slash');
                            icon.classList.add('bi-eye');
                        }
                    });
                });

                // Loading State on Submit
                const forms = document.querySelectorAll('form');
                forms.forEach(form => {
                    form.addEventListener('submit', function() {
                        const submitBtn = this.querySelector('button[type="submit"]');
                        if (submitBtn) {
                            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...';
                            submitBtn.disabled = true;
                        }
                    });
                });
            });
        </script>
    </body>
</html>
