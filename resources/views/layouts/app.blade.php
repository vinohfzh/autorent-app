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
            .brand-logo-box {
                width: 32px; height: 32px;
                background: #4f46e5;
                border-radius: 8px;
                display: flex; align-items: center; justify-content: center;
            }
            .brand-text {
                font-size: 1.25rem; font-weight: 800; color: #4f46e5; letter-spacing: -0.5px;
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
            .btn-outline-custom {
                color: #4f46e5;
                border-color: #4f46e5;
                border-radius: 50px;
                padding: 0.6rem 1.5rem;
                font-weight: 500;
                transition: all 0.2s;
            }
            .btn-outline-custom:hover {
                background-color: #4f46e5;
                color: #fff;
            }
            .text-indigo { color: #4f46e5; }
            .bg-indigo { background-color: #4f46e5; }
            .card-custom {
                border: none;
                border-radius: 1rem;
                box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            }
        </style>
    </head>
    <body>
        <div class="min-vh-100 d-flex flex-column">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm py-3 mb-4">
                    <div class="container-xl px-4 px-md-5">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow-1">
                {{ $slot }}
            </main>
            
            @include('layouts.footer')
        </div>

        <!-- Bootstrap 5 JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Toast Container for Flash Messages -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1060">
            @if (session('status'))
                <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('status') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
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
