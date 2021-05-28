<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'nama', 'nip'
    ];

    public function kategori()
    {
        return $this->belongsToMany(KategoriDosen::class, 'dosen_kategoridosen', 'dosen_id', 'kategori_id');
    }
}
