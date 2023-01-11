<?php

namespace App\Http\Controllers;

use App\Models\JenisPengemaskinian;
use App\Models\KategoriMaklumat;
use App\Models\KategoriSaluran;
use App\Models\LamanWeb;
use BaconQrCode\Renderer\Path\Move;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Notifications\LamanwebNotification;
use Illuminate\Support\Facades\Notification;

class LamanWebController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function allPermohonanLamanWeb()
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

        return view('admin.permohonan.index_permohonan_lamanweb',$data);
    }
    public function addPermohonanLamanWeb()
    {

        $data['katmaklumat'] = KategoriMaklumat::all();
        $data['katsaluran'] = KategoriSaluran::all();
        $data['jenkemaskini'] = JenisPengemaskinian::all();


        return view('admin.permohonan.add_permohonan_lamanweb',$data);
    }

    public function createPermohonanLamanWeb(Request $request)
    {
        $validatedData = $request->validate([
            'tajuk' => 'required|max:255', 
            'kategori_saluran_id' => 'required',
            'kategori_maklumat_id' => 'required',
            'jenis_kemaskini_id' => 'required',
            'tarikh_mula' => 'required',
            'tarikh_tamat' => 'required',
            'uploaded_image' => 'required|max:255',
            'keterangan' => 'required|max:255',
        ]);

        

        $rujuk_initial = 'MPK/L19/'.Carbon::now()->format('d'.'/'.'m'.'/'.'Y'.'/');
        $run_num = 0;
        $mohon_tahun = LamanWeb::where('sesi', 'like' ,Carbon::now()->format('Y'))->get();
        $kira = count($mohon_tahun);

        $multiselect = $request->kategori_saluran_id;
        $saluran = implode(',',$multiselect);

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

        // dd($multiselect);

        $lamanweb = new LamanWeb();
        $lamanweb->tajuk = $request->tajuk;
        $lamanweb->kategori_saluran_id = $saluran;
        $lamanweb->kategori_maklumat_id = $request->kategori_maklumat_id;
        $lamanweb->jenis_kemaskini_id = $request->jenis_kemaskini_id;
        $lamanweb->tarikh_mula = $request->tarikh_mula;
        $lamanweb->tarikh_tamat = $request->tarikh_tamat;
        $lamanweb->uploaded_image = implode(',',$fullName);
        $lamanweb->keterangan = $request->keterangan;
        $lamanweb->status = 'baru';
        $lamanweb->jabatan_id = Auth::user()->jabatan->id;
        $lamanweb->user_id = Auth::user()->id;
        $lamanweb->mohon_by = Auth::user()->name;
        $lamanweb->sesi = Carbon::now()->format('Y');
        $lamanweb->tarikh_mohon = Carbon::now();
        
        if ($kira <= 8) {
            # code...
            $num = '00'.$kira + 1;
            $full_no = $rujuk_initial.$num;
            $lamanweb->no_rujukan = $full_no;
            
        }elseif ($kira >= 10 && $kira<=98) {
            # code...
            $num = '0'.$kira + 1;
            $full_no = $rujuk_initial.$num;
            $lamanweb->no_rujukan = $full_no;

        }else {
            # code...
            $num = $kira + 1;
            $full_no = $rujuk_initial.$num;
            $lamanweb->no_rujukan = $full_no;
        }
        $lamanweb->save();
        $user = User::where('jabatan_id',Auth::user()->jabatan_id)->where('role','pegawai jabatan')->get();
        $id_lamanweb = $lamanweb->id;
        // dd($user);
        Notification::send($user,new LamanwebNotification($request->tajuk,$id_lamanweb));
        
        return redirect()->route('all.permohonan.lamanweb')->with('success','Data Laman Web Anda Telah Berjaya Dimasukkan');
        // $test = [$request->tajuk,$lamanweb->id];
        // dd($test);
    }

    public function PermohonanLamanWebView($id)
    {
        $data['lamanweb'] = LamanWeb::find($id);

        return view('admin.permohonan.view_permohonan',$data);
    }

    public function editPermohonanLamanWeb($id)
    {
        $data['katmaklumat'] = KategoriMaklumat::all();
        $data['katsaluran'] = KategoriSaluran::all();
        $data['jenkemaskini'] = JenisPengemaskinian::all();
        $data['mohon'] = LamanWeb::find($id);

        return view('admin.permohonan.edit_permohonan_lamanweb',$data);
    }

    public function updatePermohonanLamanWeb(Request $request,$id)
    {
        
        if ($request->uploaded_image) {
            # code...
            
            $multiselect = $request->kategori_saluran_id;
            $saluran = implode(',',$multiselect);

        $multimage = $request->uploaded_image;
        $countimage = count($multimage);

        $web = LamanWeb::find($id);
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

        $lamanweb = LamanWeb::find($id);
        $lamanweb->tajuk = $request->tajuk;
        $lamanweb->kategori_saluran_id = $saluran;
        $lamanweb->kategori_maklumat_id = $request->kategori_maklumat_id;
        $lamanweb->jenis_kemaskini_id = $request->jenis_kemaskini_id;
        $lamanweb->tarikh_mula = $request->tarikh_mula;
        $lamanweb->tarikh_tamat = $request->tarikh_tamat;
        $lamanweb->uploaded_image = implode(',',$fullName);
        $lamanweb->keterangan = $request->keterangan;
        $lamanweb->status = 'baru';
        $lamanweb->jabatan_id = Auth::user()->jabatan->id;
        $lamanweb->user_id = Auth::user()->id;
        $lamanweb->mohon_by = Auth::user()->name;
        $lamanweb->sesi = Carbon::now()->format('Y');
        $lamanweb->tarikh_mohon = Carbon::now();
        $lamanweb->save();
            
        

        }else {
            # code...

        $multiselect = $request->kategori_saluran_id;
        $saluran = implode(',',$multiselect);

        $web = LamanWeb::find($id);
        $web_image = explode(',',$web->uploaded_image);

        $lamanweb = LamanWeb::find($id);
        $lamanweb->tajuk = $request->tajuk;
        $lamanweb->kategori_saluran_id = $saluran;
        $lamanweb->kategori_maklumat_id = $request->kategori_maklumat_id;
        $lamanweb->jenis_kemaskini_id = $request->jenis_kemaskini_id;
        $lamanweb->tarikh_mula = $request->tarikh_mula;
        $lamanweb->tarikh_tamat = $request->tarikh_tamat;
        $lamanweb->keterangan = $request->keterangan;
        $lamanweb->status = 'baru';
        $lamanweb->jabatan_id = Auth::user()->jabatan->id;
        $lamanweb->user_id = Auth::user()->id;
        $lamanweb->mohon_by = Auth::user()->name;
        $lamanweb->sesi = Carbon::now()->format('Y');
        $lamanweb->tarikh_mohon = Carbon::now();
        $lamanweb->save();

        }

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->unreadNotifications()->update(['read_at' => now()]);

        $user = User::where('jabatan_id',Auth::user()->jabatan_id)->where('role','pegawai jabatan')->get();
        $id_lamanweb = $lamanweb->id;
        // dd($user);
        Notification::send($user,new LamanwebNotification($request->tajuk,$id_lamanweb));

        return redirect()->route('all.permohonan.lamanweb')->with('success','Data Laman Web Anda Telah Berjaya Dikemaskini');
    }

    
}
