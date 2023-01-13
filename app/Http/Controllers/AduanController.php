<?php

namespace App\Http\Controllers;

use App\Models\JenisAduan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\KategoriSaluran;
use App\Models\KategoriMaklumat;
use Illuminate\Support\Facades\DB;
use App\Models\JenisPengemaskinian;
use Illuminate\Support\Facades\Auth;

class AduanController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function allAduanLamanWeb()
    {
        $jabatan = Auth::user()->jabatan->id;
        // dd($jabatan);
        $data['mohon_lamanweb'] = DB::table('laman_webs')
        ->select('users.*','laman_webs.*')
        ->join('users' , 'users.id' , 'laman_webs.user_id')
        ->where('laman_webs.jabatan_id','like',$jabatan)
        ->orderBy('laman_webs.tarikh_mohon','asc')
        ->get()
        ;

        return view('admin.permohonan.index_permohonan_aduan',$data);
    }

    public function addAduanLamanWeb()
    {
        // $data['pengguna'] = Auth::user()->name;
        // $data['jabatan'] = Auth::user()->jabatan->id;
        // $data['rujukan'] = 'MPK/L19/'.Carbon::now()->format('d'.'/'.'m'.'/'.'Y'.'/');
        $data['jenAduan'] = JenisAduan::all();
        $data['katmaklumat'] = KategoriMaklumat::all();
        $data['katsaluran'] = KategoriSaluran::all();
        $data['jenkemaskini'] = JenisPengemaskinian::all();

        return view('admin.permohonan.add_permohonan_aduan',$data,);
    }

}
