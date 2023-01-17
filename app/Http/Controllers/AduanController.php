<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aduan;
use App\Models\LamanWeb;
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

    public function allPermohonanAduan()
    {
        $jabatan = Auth::user()->jabatan->id;
        // dd($jabatan);
        $data['mohon_aduan'] = DB::table('aduans')
        ->select('users.*','aduans.*')
        ->join('users' , 'users.id' , 'aduans.user_id')
        ->where('aduans.jabatan_id','like',$jabatan)
        ->orderBy('aduans.tarikh_mohon','asc')
        ->get()
        ;

        return view('admin.permohonan.index_permohonan_aduan',$data);
    }

    public function addPermohonanAduan()
    {
       
        $data['jenAduan'] = JenisAduan::all();
        $data['katmaklumat'] = KategoriMaklumat::all();
        $data['katsaluran'] = KategoriSaluran::all();
        $data['jenkemaskini'] = JenisPengemaskinian::all();

        return view('admin.permohonan.add_permohonan_aduan',$data,);
    }

    public function createPermohonanAduan(Request $request){
        $validatedData = $request->validate([

            'no_rujukan' => 'required',
            'jenis_aduan_id' => 'required',
            'uploaded_image' => 'required|max:255',
            'keterangan' => 'required|max:255',

            // 'tajuk' => 'required|max:255', 
            // 'kategori_saluran_id' => 'required',
            // 'kategori_maklumat_id' => 'required',
            // 'jenis_kemaskini_id' => 'required',
            // 'tarikh_mula' => 'required',
            // 'tarikh_tamat' => 'required',
            // 'uploaded_image' => 'required|max:255',
            // 'keterangan' => 'required|max:255',
        ]);
        
        $multimage = $request->uploaded_image;
        $countimage = count($multimage);

        for ($i=0; $i < $countimage; $i++) { 
            # code...
        
            $direction = 'assets/doc_upload/';
            $imageName[] = $multimage[$i]->hashName();
            $name = $multimage[$i]->hashName();
            $fullName[] = $direction.$imageName[$i];
            $multimage[$i]->move($direction,$name);
            
        }


        DB::table('aduans')->insert([

            'user_id'=>Auth::user()->id,
            'jabatan_id'=>Auth::user()->jabatan->id,
            'no_rujukan'=>$request->no_rujukan,
            'jenis_aduan_id'=>$request->jenis_aduan_id,
            'keterangan'=>$request->keterangan,
            'uploaded_image'=>implode(',',$fullName),
            'status'=>'baru',
            'mohon_by'=>Auth::user()->name,
            'sesi'=>Carbon::now()->format('Y'),
            'tarikh_mohon'=>Carbon::now(),

        ]);
        return redirect()->route('all.permohonan.aduan')->with('success','Data Aduan Anda Telah Berjaya Dimasukkan');

    }

    public function PermohonanAduanView($id){
        $data['lamanweb'] = LamanWeb::find($id);

        $data['aduan'] = Aduan::find($id);

        return view('admin.permohonan.view_permohonan_aduan',$data);

    }

    public function editPermohonanAduan($id){
        $data['katmaklumat'] = KategoriMaklumat::all();
        $data['katsaluran'] = KategoriSaluran::all();
        $data['jenkemaskini'] = JenisPengemaskinian::all();
        $data['mohon'] = LamanWeb::find($id);

        return view('admin.permohonan.edit_permohonan_aduan',$data);
    }

}
