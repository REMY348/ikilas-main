<?php

namespace App\Http\Controllers;

use App\Models\JenisPengemaskinian;
use App\Models\KategoriMaklumat;
use App\Models\KategoriSaluran;
use App\Models\LamanWeb;
use App\Models\User;
use App\Notifications\LamanwebNotification;
use BaconQrCode\Renderer\Path\Move;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;

class SokonganController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function allSokonganLamanWeb()
    {
        $jabatan = Auth::user()->jabatan->id;
        $data['mohon_lamanweb'] = DB::table('laman_webs')
        ->select('users.*','laman_webs.*')
        ->join('users' , 'users.id' , 'laman_webs.user_id')
        ->where('laman_webs.jabatan_id','like',$jabatan)
        ->get()
        ;

        return view('admin.sokongan.index_sokongan_lamanweb',$data);
    }
    

    public function PermohonanLamanWebView($id)
    {
        $data['lamanweb'] = LamanWeb::find($id);

        return view('admin.permohonan.view_permohonan',$data);
    }

    public function editSokonganLamanWeb($id)
    {
        $data['katmaklumat'] = KategoriMaklumat::all();
        $data['katsaluran'] = KategoriSaluran::all();
        $data['jenkemaskini'] = JenisPengemaskinian::all();
        $data['sokong'] = LamanWeb::find($id);

        return view('admin.sokongan.edit_sokongan_lamanweb',$data);
    }

    public function updateSokonganLamanWeb(Request $request,$id)
    {
        $validatedData = $request->validate([
            'status' => 'required',
            'ulasan' => 'required'
        ]);
        
        
        $lamanweb = LamanWeb::find($id);
        $lamanweb->status = $request->status;
        $lamanweb->sokong_by = Auth::user()->name;
        $lamanweb->tarikh_disokong = Carbon::now();
        $lamanweb->ulasan = $request->ulasan;
        $lamanweb->save();

        

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->unreadNotifications()->update(['read_at' => now()]);

        if ($request->status == 'disokong') {
            # code...
            $user = User::where('jabatan_id',Auth::user()->jabatan_id)->where('role','pentadbir')->get();
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
        

        return redirect()->route('all.sokongan.lamanweb')->with('success','Data Laman Web Anda Telah Berjaya Disokong');
    }
}
