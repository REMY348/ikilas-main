<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPengemaskinian extends Model
{
    use HasFactory;

    public function lamanweb()
    {
        return $this->hasOne(LamanWeb::class,'jenis_kemaskini_id','id');
    }
}
