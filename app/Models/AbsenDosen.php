<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenDosen extends Model
{
    use HasFactory;

    protected $table = 'absen_dosen';
    protected $guarded = ['id'];

    public function matkul()
    {
        return $this->belongsTo(MataKuliah::class, 'matakuliah_id', 'id');
    }

    public function dosen()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }
}
