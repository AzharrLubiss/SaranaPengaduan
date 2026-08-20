<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin NGADU!</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8fafc;
            color: #334155;
        }

        /* --- NAVBAR ADMIN DARK MODERN --- */
        .navbar-admin {
            background-color: #0f172a;
            border-bottom: 1px solid #1e293b;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.15);
            padding: 12px 0;
        }

        .brand-badge {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid #334155;
            color: #38bdf8;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .admin-tag {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            background-color: rgba(56, 189, 248, 0.15);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.3);
            padding: 3px 8px;
            border-radius: 6px;
        }

        .nav-link-admin {
            font-weight: 500;
            font-size: 0.9rem;
            color: #94a3b8 !important;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .nav-link-admin:hover, 
        .nav-link-admin.active {
            color: #ffffff !important;
            background-color: #1e293b;
        }

        /* Avatar Circle Admin */
        .avatar-admin {
            width: 34px;
            height: 34px;
            background-color: #1e293b;
            border: 1px solid #334155;
            color: #38bdf8;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        /* Tombol Logout Admin */
        .btn-logout-admin {
            border: 1px solid rgba(239, 68, 68, 0.3);
            background-color: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 6px 14px;
            transition: all 0.2s ease;
        }

        .btn-logout-admin:hover {
            background-color: #ef4444;
            border-color: #ef4444;
            color: #ffffff;
        }

        /* Styling Flash Alert */
        .custom-alert {
            border-radius: 12px;
            border: none;
            font-weight: 500;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Navbar Admin --}}
    <nav class="navbar navbar-expand-lg navbar-dark navbar-admin sticky-top">
        <div class="container">
            {{-- Brand Logo & Admin Badge --}}
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                <div class="brand-badge">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <span class="text-white fs-5">NGADU!</span>
                <span class="admin-tag">ADMIN</span>
            </a>

            {{-- Hamburger Toggler Mobile --}}
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbar">
                {{-- Menu Navigasi --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
                    <li class="nav-item">
                        <a class="nav-link nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-grid-1x2 me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-admin {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" href="{{ route('admin.kategori.create') }}">
                            <i class="bi bi-tags me-1"></i> Tambah Kategori
                        </a>
                    </li>
                </ul>

                {{-- User Profil & Logout --}}
                <div class="d-flex align-items-center gap-3 pt-2 pt-lg-0 border-top border-secondary border-opacity-25 border-lg-0">
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar-admin">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <span class="small" style="color: #94a3b8;">
                            Halo, <strong class="text-white">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</strong>
                        </span>
                    </div>

                    <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-logout-admin">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="container py-4 flex-grow-1">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success custom-alert shadow-sm alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger custom-alert shadow-sm alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer Admin --}}
    <footer class="bg-white border-top text-center text-muted small py-3 mt-auto">
        <div class="container">
            &copy; {{ date('Y') }} <strong>NGADU!</strong> Admin Portal — Sistem Pengaduan Sekolah.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>