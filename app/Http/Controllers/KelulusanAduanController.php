<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aduan;
use App\Models\LamanWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KelulusanAduanController extends Controller
{
    //
    public function allKelulusanAduan()
    {
        $jabatan = Auth::user()->jabatan->id;
        $data['lulus_aduan'] = DB::table('aduans')
        ->select('users.*','aduans.*')
        ->join('users' , 'users.id' , 'aduans.user_id')
        ->where('aduans.jabatan_id','like',$jabatan)
        ->get();

        

        return view('admin.kelulusan.index_kelulusan_aduan',$data);
    }

    public function editKelulusanAduan(Request $request,$id){

        // $data['lulus'] = Aduan::find($id);
        $data['aduan'] = Aduan::all();
        $data['lulus'] = Aduan::find($id);
        $data['admin'] = User::where('role','like','pentadbir')->get();




        return view('admin.kelulusan.edit_kelulusan_aduan',$data);


    }

    public function updateKelulusanAduan(Request $request,$id){

       
                $validatedData = $request->validate([
                    'lulus_by'=>'required',
                    'ulasan'=>'required',
                    'status' => 'required',
                ]);

                $aduan =Aduan::find($id)->update([
                    'ulasan' => $request->ulasan,
                    'lulus_by' => $request->lulus_by,
                    'tindakan_by' => Auth::user()->name,
                    'tarikh_lulus' => Carbon::now(),
                    'url'=> $request->url,
                  'status'=>$request->status,
                ]);


                return redirect()->route('all.permohonan.aduan')->with('success','Data Aduan Anda Telah Berjaya Dikemaskini');

    }


}
