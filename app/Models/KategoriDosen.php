<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriDosen extends Model
{
    use HasFactory;

    protected $table = 'kategori_dosen';

    protected $fillable = [
        'kategori'
    ];

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'dosen_kategoridosen', 'kategori_id', 'dosen_id');
    }
}
