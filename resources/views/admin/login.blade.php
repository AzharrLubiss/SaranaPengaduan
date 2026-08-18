<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Ngadu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">

        <div class="card shadow bg-white rounded-4 p-4" style="width: 420px;">

            <h3 class="mb-1 text-center h2 fw-bold">NGADU!</h3>
            <p class="text-center text-muted mb-4">Login Admin</p>

            <form action="{{ route('admin.login.submit') }}" method="post">
                @csrf

                <span>Email</span>
                <input type="email" class="form-control mb-3" placeholder="admin@sekolah.sch.id" name="email" value="{{ old('email') }}" required autofocus>

                <span>Password</span>
                <input type="password" class="form-control mb-4" name="password" placeholder="******" required>

                <div class="d-grid gap-2">
                    <button class="btn btn-dark" type="submit">
                        Login sebagai Admin
                    </button>
                    <a href="{{ route('login') }}" class="text-center small" style="text-decoration: none;">Login sebagai siswa</a>
                </div>

                @session('error')
                    <div class="alert alert-danger my-3 text-center text-danger fw-semibold">
                        {{ session('error') }}
                    </div>
                @endsession

            </form>

        </div>

    </div>

</body>
</html>
