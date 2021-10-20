<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGajiStaff extends Model
{
    use HasFactory;

    protected $table = 'master_gaji_staff';

    protected $guarded = ['id'];
}
