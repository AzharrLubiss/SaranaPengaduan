<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sarana Pengaduan</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8fafc;
            color: #334155;
        }

        /* --- NAVBAR BIRU MODERN --- */
        .navbar-custom {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            box-shadow: 0 4px 14px rgba(13, 110, 253, 0.2);
            padding: 12px 0;
        }

        .navbar-brand-custom {
            color: #ffffff !important;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .nav-link-custom {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.85) !important;
            padding: 8px 16px !important;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .nav-link-custom:hover, 
        .nav-link-custom.active {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.18);
        }

        .btn-nav-outline {
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: #ffffff;
            border-radius: 999px;
            font-weight: 600;
            padding: 6px 18px;
            transition: all 0.2s ease;
        }

        .btn-nav-outline:hover {
            background-color: #ffffff;
            color: #0d6efd;
        }

        .btn-nav-solid {
            background-color: #ffffff;
            color: #0d6efd;
            border-radius: 999px;
            font-weight: 600;
            padding: 6px 18px;
            transition: all 0.2s ease;
        }

        .btn-nav-solid:hover {
            background-color: #f1f5f9;
            color: #0a58ca;
        }

        /* --- FOOTER SIMPEL --- */
        .footer-custom {
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 0.875rem;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand navbar-brand-custom fs-4 d-flex align-items-center gap-2" href="{{ url('/') }}">
                <div class="bg-white text-primary rounded-3 p-1 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <i class="bi bi-megaphone-fill fs-5"></i>
                </div>
                <span>NGADU!</span>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="bi bi-house-door me-1"></i> Beranda
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-center gap-2">
                    @auth
                        
                        <li class="nav-item w-100 w-lg-auto mt-2 mt-lg-0">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                @csrf
                                <button type="submit" class="btn btn-nav-outline w-100 w-lg-auto">
                                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item w-100 w-lg-auto">
                            <a class="nav-link nav-link-custom text-center" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item w-100 w-lg-auto mt-2 mt-lg-0">
                            <a class="btn btn-nav-solid w-100 w-lg-auto text-center" href="{{ route('registrasi') }}">
                                Daftar
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main class="flex-grow-1 py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <footer class="footer-custom py-3 mt-auto">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <div>
                    &copy; {{ date('Y') }} <strong>NGADU!</strong> — Sistem Pengaduan &amp; Aspirasi.
                </div>
                <div>
                    12 RPL A - Kelompok 6
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>