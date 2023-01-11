<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class,'Jabatan_id','id');
    }
    public function lamanweb()
    {
        return $this->hasOne(LamanWeb::class,'Jabatan_id','id');
    }
}
