<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGajiDosen extends Model
{
    use HasFactory;

    protected $table = 'master_gaji_dosen';

    protected $guarded = ['id'];
}
