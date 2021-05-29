<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapAbsenDosen extends Model
{
    use HasFactory;

    protected $table = 'rekap_absen_dosen';

    protected $guarded = ['id'];
}
