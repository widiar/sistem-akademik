<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntensifMarketing extends Model
{
    use HasFactory;

    protected $table = 'intensif_marketing';

    protected $guarded = ['id'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
