<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAduan extends Model
{
    use HasFactory;

    public function aduan()
    {
        return $this->hasMany(Aduan::class,'jenis_aduan_id','id');
    }
}
