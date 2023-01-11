<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSaluran extends Model
{
    use HasFactory;

    public function lamanweb()
    {
        return $this->hasOne(LamanWeb::class,'kategori_saluran_id','id');
    }
}
