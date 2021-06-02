<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanGaji extends Model
{
    use HasFactory;

    protected $table = 'laporan_gaji';

    protected $guarded = ['id'];
}
