<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticateable;

class Siswa extends Authenticateable 
{
    protected $fillable = [
        'nisn',
        'nama',
        'password',
        'kelas'
    ];
}
