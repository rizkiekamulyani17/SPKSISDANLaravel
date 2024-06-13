<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'nama',
        'kelas',
        'C1',
        'C2',
        'C3',
        'C4',
        'C5',
        'C6',
        'Jumlah'
    ];



  
}