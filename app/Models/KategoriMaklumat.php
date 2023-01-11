<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMaklumat extends Model
{
    use HasFactory;

    public function lamanweb()
    {
        return $this->hasOne(LamanWeb::class,'kategori_maklumat_id','id');
    }
}
