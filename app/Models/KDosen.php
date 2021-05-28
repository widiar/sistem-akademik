<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KDosen extends Model
{
    use HasFactory;

    protected $table = 'k_dosen';

    protected $fillable = [
        'dosen_id', 'semester_ganjil', 'semester_genap', 'tahun_ajaran'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
