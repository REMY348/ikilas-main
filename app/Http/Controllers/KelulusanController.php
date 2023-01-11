<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriMaklumat;
use App\Models\KategoriSaluran;
use App\Models\JenisPengemaskinian;
use App\Models\LamanWeb;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LamanwebNotification;

class KelulusanController extends Controller
{
    //

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function allKelulusanLamanWeb()
    {
        $jabatan = Auth::user()->jabatan->id;
        $data['lulus_lamanweb'] = DB::table('laman_webs')
        ->select('users.*','laman_webs.*')
        ->join('users' , 'users.id' , 'laman_webs.user_id')
        ->where('laman_webs.jabatan_id','like',$jabatan)
        ->get();

        return view('admin.kelulusan.index_kelulusan_lamanweb',$data);
    }

    public function editKelulusanLamanWeb($id)
    {
        $data['katmaklumat'] = KategoriMaklumat::all();
        $data['katsaluran'] = KategoriSaluran::all();
        $data['jenkemaskini'] = JenisPengemaskinian::all();
        $data['lulus'] = LamanWeb::find($id);
        $data['admin'] = User::where('role','like','pentadbir')->get();

        return view('admin.kelulusan.edit_kelulusan_lamanweb',$data);
    }

    public function updateKelulusanLamanWeb(Request $request,$id)
    {
        $validatedData = $request->validate([
            'status' => 'required',
            'url' => 'required'
        ]);
        
        
        $lamanweb = LamanWeb::find($id);
        $lamanweb->status = $request->status;
        $lamanweb->lulus_by = $request->lulus_by;
        $lamanweb->tindakan_by = Auth::user()->name;
        $lamanweb->tarikh_lulus = Carbon::now();
        $lamanweb->url = $request->url;
        $lamanweb->save();

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->unreadNotifications()->update(['read_at' => now()]);

        if ($request->status == 'baru') {
            # code...
            $user = User::where('jabatan_id',Auth::user()->jabatan_id)->where('role','pegawai jabatan')->get();
            $id_lamanweb = $lamanweb->id;
        // dd($user);
            Notification::send($user,new LamanwebNotification($lamanweb->tajuk,$id_lamanweb));
        }
        if ($request->status == 'baru_r') {
            # code...
            $user = User::where('jabatan_id',Auth::user()->jabatan_id)->where('role','pengguna')->get();
            $id_lamanweb = $lamanweb->id;
        // dd($user);
            Notification::send($user,new LamanwebNotification($lamanweb->tajuk,$id_lamanweb));
        }
        // if ($request->status == 'diluluskan') {
        //     # code...
        //     $user = User::where('jabatan_id',Auth::user()->jabatan_id)->where('id',$lamanweb->user->id)->get();
        //     $id_lamanweb = $lamanweb->id;
        // // dd($user);
        //     Notification::send($user,new LamanwebNotification($lamanweb->tajuk,$id_lamanweb));
        // }
            
        return redirect()->route('all.kelulusan.lamanweb')->with('success','Data Laman Web Anda Telah Berjaya Diluluskan');
    }





}
