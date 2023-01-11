<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LamanWeb extends Model
{
    use HasFactory;

    public function kategorisaluran()
    {
        return $this->belongsTo(KategoriSaluran::class,'kategori_saluran_id','id');
    }

    public function kategorimaklumat()
    {
        return $this->belongsTo(KategoriMaklumat::class,'kategori_maklumat_id','id');
    }

    public function jeniskemaskini()
    {
        return $this->belongsTo(JenisPengemaskinian::class,'jenis_kemaskini_id','id');
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
