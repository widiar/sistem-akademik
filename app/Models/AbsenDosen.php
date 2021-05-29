<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenDosen extends Model
{
    use HasFactory;

    protected $table = 'absen_dosen';

    protected $guarded = ['id'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
