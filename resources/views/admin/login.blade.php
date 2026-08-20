<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - NGADU!</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        /* Background Utama Terang & Bersih */
        body {
            background-color: #f8fafc;
            color: #334155;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Card Login Admin Bernuansa Hitam/GelaP */
        .auth-card {
            border: 1px solid #1e293b;
            border-radius: 18px;
            background: #0f172a; /* Warna Hitam-Biru Gelap */
            box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.25), 0 8px 10px -6px rgba(15, 23, 42, 0.15);
            width: 100%;
            max-width: 420px;
            padding: 2.5rem 2rem;
            color: #f8fafc;
        }

        /* Brand Icon Badge Admin */
        .brand-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid #334155;
            color: #38bdf8;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        /* Label Form */
        .report-label {
            font-size: .75rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 6px;
            display: block;
        }

        /* Input Group & Custom Input (Dark Theme di Dalam Card) */
        .custom-input {
            border-radius: 0 10px 10px 0 !important;
            padding: 10px 14px;
            border: 1px solid #334155;
            background-color: #1e293b;
            color: #f8fafc;
            font-size: 0.875rem;
            transition: all 0.2s ease-in-out;
        }

        .custom-input::placeholder {
            color: #64748b;
        }

        .input-group-text {
            border-radius: 10px 0 0 10px !important;
            background-color: #0f172a;
            border: 1px solid #334155;
            color: #94a3b8;
        }

        .custom-input:focus {
            background-color: #1e293b;
            color: #ffffff;
            border-color: #38bdf8;
            box-shadow: 0 0 0 0.25rem rgba(56, 189, 248, 0.15);
            outline: none;
        }

        /* Tombol Dark Admin */
        .btn-admin-dark {
            background: linear-gradient(135deg, #334155 0%, #1e293b 100%);
            border: 1px solid #475569;
            color: #ffffff;
            border-radius: 10px;
            font-weight: 600;
            padding: 11px 16px;
            transition: all 0.2s ease;
        }

        .btn-admin-dark:hover {
            background: #334155;
            border-color: #64748b;
            color: #38bdf8;
        }

        .link-siswa {
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .link-siswa:hover {
            color: #38bdf8;
        }

        /* Alert Error Dark Mode */
        .alert-dark-danger {
            background-color: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="auth-card">
        {{-- Header / Brand --}}
        <div class="text-center mb-4">
            <div class="brand-icon">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <h3 class="fw-bold mb-1 text-white">NGADU!</h3>
            <p class="text-slate-400 small mb-0" style="color: #94a3b8;">Portal Otentikasi Administrator</p>
        </div>

        {{-- Alert Notifikasi Error --}}
        @session('error')
            <div class="alert alert-dark-danger text-center small fw-semibold mb-4 p-3">
                <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('error') }}
            </div>
        @endsession

        {{-- Form Login Admin --}}
        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label class="report-label">Email Admin</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control custom-input" placeholder="admin@sekolah.sch.id" name="email" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label class="report-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-key"></i></span>
                    <input type="password" class="form-control custom-input" name="password" placeholder="••••••••" required>
                </div>
            </div>

            {{-- Tombol Login Admin --}}
            <div class="d-grid gap-2 mb-4">
                <button class="btn btn-admin-dark shadow-sm" type="submit">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login sebagai Admin
                </button>
            </div>

            {{-- Switch ke Portal Siswa --}}
            <div class="text-center small">
                <a href="{{ route('login') }}" class="link-siswa">
                    <i class="bi bi-person me-1"></i> Switch ke Login Siswa
                </a>
            </div>
        </form>

        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>