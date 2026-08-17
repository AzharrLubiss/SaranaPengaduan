<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Ngadu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    
    <div class="container d-flex justify-content-center align-items-center vh-100">

        <div class="card shadow bg-white rounded-4 p-4" style="width: 460px;">

            <h3 class="mb-4 text-center h2 fw-bold">NGADU!</h3>
            <form action="{{ route('registrasi.submit') }}" method="post">
                @csrf

                <span>NISN</span>
                <input type="text" class="form-control mb-1" placeholder="7342" name="nisn" maxlength="4" required>
                <span>Nama</span>
                <input type="text" class="form-control mb-1" name="nama" required>
                <span>Kelas</span>
                <input type="text" class="form-control mb-1" placeholder="XII RPL A" name="kelas" required>
                <span>Password</span>
                <input type="password" class="form-control mb-4" name="password" placeholder="******" required>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">
                        Confirm
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        Reset
                    </button>
                </div>

                @session('error')
                    <div class="alert alert danger my-3 text-center">
                        {{ session('error') }}
                    </div>
                @endsession
                
            </form>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>