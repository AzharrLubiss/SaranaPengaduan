# Cara menambahkan guard admin di config/auth.php

File `config/auth.php` kamu saat ini sepertinya sudah dimodifikasi:
provider 'users' diarahkan ke model `App\Models\Siswa` (bukan `App\Models\User`
bawaan Laravel), itu sebabnya login siswa pakai NISN bisa jalan.

Supaya admin (yang datanya ada di tabel `users`) bisa login terpisah tanpa
bentrok dengan siswa, tambahkan guard & provider baru bernama "admin":

1. Di array 'guards', tambahkan:

    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],

   Jadi keseluruhan 'guards' kira-kira:

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],

2. Di array 'providers', tambahkan provider baru "admins" yang menunjuk ke
   model User (tabel `users`):

    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],

   Jadi keseluruhan 'providers' kira-kira:

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\Siswa::class, // punya kamu, jangan diubah
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

3. Simpan, lalu jalankan lagi:
    php artisan config:clear
    php artisan migrate
    php artisan db:seed

Setelah ini, login admin di /admin/login akan query ke tabel `users`
(punya kolom email) — bukan ke `siswas` lagi — jadi error
"Unknown column 'email' in siswas" akan hilang.
