<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'isi_laporan',
        'lokasi',
        'foto',
        'status',
        'tanggapan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'user_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}