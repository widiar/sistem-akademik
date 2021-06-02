<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsToMany(KategoriDosen::class, 'dosen_kategoridosen', 'dosen_id', 'kategori_id');
    }

    public function sks()
    {
        return $this->hasMany(SksDosen::class, 'dosen_id', 'id');
    }
    public function pembimbing()
    {
        return $this->hasMany(PDosen::class, 'dosen_id', 'id');
    }
    public function penguji()
    {
        return $this->hasMany(PjDosen::class, 'dosen_id', 'id');
    }
    public function koordinator()
    {
        return $this->hasMany(KDosen::class, 'dosen_id', 'id');
    }
    public function wali()
    {
        return $this->hasMany(WDosen::class, 'dosen_id', 'id');
    }
    public function absen()
    {
        return $this->hasMany(AbsenDosen::class, 'dosen_id', 'id');
    }
}
