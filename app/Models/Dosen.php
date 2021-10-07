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
        return $this->belongsToMany(KategoriDosen::class, 'dosen_kategoridosen', 'dosen_id', 'kategori_id')->withPivot('semester_ganjil', 'semester_genap');
    }

    public function matakuliah()
    {
        return $this->belongsToMany(MataKuliah::class, 'dosen_matakuliah', 'dosen_id', 'matakuliah_id');
    }

    public function absen()
    {
        return $this->hasMany(AbsenDosen::class, 'dosen_id');
    }

    public function staff()
    {
        return $this->hasMany(AbsenStaff::class, 'dosen_id');
    }
}
