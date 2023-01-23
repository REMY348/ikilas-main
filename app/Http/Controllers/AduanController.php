<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aduan;
use App\Models\LamanWeb;
use App\Models\JenisAduan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Notifications\AduanNotification;
use Illuminate\Support\Facades\Notification;


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
        

        return view('admin.permohonan.add_permohonan_aduan',$data,);
    }

    public function createPermohonanAduan(Request $request){
        $validatedData = $request->validate([
            'tajuk' => 'required|max:255', 
            'jenis_aduan_id' => 'required',
            'uploaded_image' => 'required|max:8000',
            'keterangan' => 'required|max:255',

           
        ]);
        
        $rujuk_initial = 'MPK/A19/'.Carbon::now()->format('d'.'/'.'m'.'/'.'Y'.'/');
        $run_num = 0;
        $mohon_tahun = Aduan::where('sesi', 'like' ,Carbon::now()->format('Y'))->get();
        $kira = count($mohon_tahun);

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
        
        if ($kira <= 8) {
            # code...
            $num = '00'.$kira + 1;
            $full_no = $rujuk_initial.$num;
            $no_rujukan = $full_no;
            
        }elseif ($kira >= 10 && $kira<=98) {
            # code...
            $num = '0'.$kira + 1;
            $full_no = $rujuk_initial.$num;
            $no_rujukan = $full_no;

        }else {
            # code...
            $num = $kira + 1;
            $full_no = $rujuk_initial.$num;
            $no_rujukan = $full_no;
        }

        DB::table('aduans')->insert([

            'user_id'=>Auth::user()->id,
            'jabatan_id'=>Auth::user()->jabatan->id,
            'tajuk'=>$request->tajuk,
            'no_rujukan'=>$no_rujukan,
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


        $data['jenaduan'] = JenisAduan::all();
       
        $data['mohon'] = Aduan::find($id);

        return view('admin.permohonan.edit_permohonan_aduan',$data);
    }

    public function updatePermohonanAduan(Request $request,$id)
    {
       
        if ($request->uploaded_image) {
            # code...
            
         

        $multimage = $request->uploaded_image;
        $countimage = count($multimage);

        $web = Aduan::find($id);
        $web_image = explode(',',$web->uploaded_image);

        foreach ($web_image as $images) {
            # code...
            File::delete($images);
        }
        
        for ($i=0; $i < $countimage; $i++) { 
            # code...
            
            $direction = 'assets/doc_upload/';
            $imageName[] = $multimage[$i]->hashName();
            $name = $multimage[$i]->hashName();
            $fullName[] = $direction.$imageName[$i];
            $multimage[$i]->move($direction,$name);
            
        }

        // dd($web_image);
        
        $data= Aduan::find($id)->update([

            'user_id'=>Auth::user()->id,
            'jabatan_id'=>Auth::user()->jabatan->id,
            'tajuk'=>$request->tajuk,
            'no_rujukan'=>$request->no_rujukan,
            'jenis_aduan_id'=>$request->jenis_aduan_id,
            'keterangan'=>$request->keterangan,
            'uploaded_image'=>implode(',',$fullName),
            'status'=>'baru',
            'mohon_by'=>Auth::user()->name,
            'sesi'=>Carbon::now()->format('Y'),
            'tarikh_mohon'=>Carbon::now(),

        ]);
     
        }else {
            # code...


        $web = Aduan::find($id);
        $web_image = explode(',',$web->uploaded_image);

        DB::table('aduans')->update([

            'user_id'=>Auth::user()->id,
            'jabatan_id'=>Auth::user()->jabatan->id,
            'tajuk'=>$request->tajuk,
            'no_rujukan'=>$request->no_rujukan,
            'jenis_aduan_id'=>$request->jenis_aduan_id,
            'keterangan'=>$request->keterangan,
            'status'=>'baru',
            'mohon_by'=>Auth::user()->name,
            'sesi'=>Carbon::now()->format('Y'),
            'tarikh_mohon'=>Carbon::now(),

        ]);

        }

        $user_id = Auth::user()->id;
        $user2 = User::find($user_id);
        $user2->unreadNotifications()->update(['read_at' => now()]);


        $user2 = User::where('jabatan_id',Auth::user()->jabatan_id)->where('role','pegawai jabatan')->get();
        $id_aduan = Aduan::find($id);
        // dd($user);

        Notification::send($user2,new AduanNotification($request->tajuk,$id_aduan));

        return redirect()->route('all.permohonan.aduan')->with('success','Data Aduan Anda Telah Berjaya Dikemaskini');

}


}