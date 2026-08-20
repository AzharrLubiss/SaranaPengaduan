<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NGADU!</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8fafc;
            color: #334155;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Card Auth Modern (Radius 18px) */
        .auth-card {
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            background: #ffffff;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            width: 100%;
            max-width: 420px;
            padding: 2.5rem 2rem;
        }

        /* Brand Logo Badge */
        .brand-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            color: #ffffff;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 12px;
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.25);
        }

        /* Label Form */
        .report-label {
            font-size: .75rem;
            font-weight: 700;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 6px;
            display: block;
        }

        /* Input Group & Custom Input (Radius 10px) */
        .custom-input {
            border-radius: 0 10px 10px 0 !important;
            padding: 10px 14px;
            border: 1px solid #ced4da;
            font-size: 0.875rem;
            background-color: #fff;
            transition: all 0.2s ease-in-out;
        }

        .input-group-text {
            border-radius: 10px 0 0 10px !important;
            background-color: #f8fafc;
            border: 1px solid #ced4da;
            color: #6c757d;
        }

        .custom-input:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            outline: none;
        }

        .custom-btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 16px;
        }

        .link-registrasi {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .link-registrasi:hover {
            color: #0a58ca;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="auth-card">
        {{-- Header / Brand --}}
        <div class="text-center mb-4">
            <div class="brand-icon">
                <i class="bi bi-megaphone-fill"></i>
            </div>
            <h3 class="fw-bold mb-1 text-dark">NGADU!</h3>
            <p class="text-muted small mb-0">Masuk dengan NISN untuk menyampaikan aspirasi</p>
        </div>

        {{-- Alert Notifikasi Error --}}
        @session('error')
            <div class="alert alert-danger border-0 text-center small fw-semibold mb-4" style="border-radius: 10px; background-color: #f8d7da; color: #842029;">
                <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('error') }}
            </div>
        @endsession

        {{-- Form Login --}}
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="report-label">NISN</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                    <input type="text" class="form-control custom-input" placeholder="Masukkan NISN Anda" name="nisn" value="{{ old('nisn') }}" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label class="report-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control custom-input" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <div class="d-grid gap-2 mb-4">
                <button class="btn btn-primary custom-btn shadow-sm" type="submit">
                    Masuk Sekarang
                </button>
            </div>

            <div class="text-center small text-muted">
                Belum punya akun? 
                <a href="{{ route('registrasi') }}" class="link-registrasi">Daftar Akun</a>
            </div>
        </form>

        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>