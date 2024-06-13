<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_siswa',
        'kelas_id',
        'user_id',
        'jenis_kelamin',
        'agama',
        'alamat',
        'validasi',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function alternatives()
    {
        return $this->hasMany(Alternative::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}