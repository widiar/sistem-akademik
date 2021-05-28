<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PjDosen extends Model
{
    use HasFactory;

    protected $table = 'pj_dosen';

    protected $fillable = [
        'dosen_id', 'semester_ganjil', 'semester_genap', 'tahun_ajaran'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
