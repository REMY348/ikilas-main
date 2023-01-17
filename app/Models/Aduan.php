<?php

namespace App\Models;

use App\Models\JenisAduan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aduan extends Model
{
    use HasFactory;

    public function jenisAduan()
    {
        return $this->belongsTo(JenisAduan::class,'jenis_aduan_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class,'jabatan_id','id');
    }
}
