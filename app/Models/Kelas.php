<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'kelas_name',
        'slug',
        'keterangan'
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'kelas_name'
            ]
        ];
    }
}