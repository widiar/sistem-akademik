<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $guarded = ['id'];

    public function dosen()
    {
        return $this->belongsToMany(KategoriDosen::class, 'dosen', 'pegawai_id', 'kategori_id')->withPivot('semester_ganjil', 'semester_genap');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'pegawai_id', 'id');
    }

    public function matakuliah()
    {
        return $this->belongsToMany(MataKuliah::class, 'dosen_matakuliah', 'pegawai_id', 'matakuliah_id');
    }

    public function absenDosen()
    {
        return $this->hasMany(AbsenDosen::class, 'pegawai_id');
    }

    public function absenStaff()
    {
        return $this->hasMany(AbsenStaff::class, 'pegawai_id');
    }

    public function detailDosen()
    {
        return $this->hasOne(DetailDosen::class, 'pegawai_id', 'id');
    }
    public function detailStaff()
    {
        return $this->hasOne(DetailStaff::class, 'pegawai_id', 'id');
    }

    public function slipDosen()
    {
        return $this->hasMany(SlipGajiDosen::class);
    }
}
