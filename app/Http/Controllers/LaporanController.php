<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\LamanWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function allLaporanLamanWeb(Request $request)
    {
        $data['date'] = $request->input('tarikh_mula');
        $data['date_tamat'] = $request->input('tarikh_tamat');
        $data['status'] = $request->input('status');

        if ($data['date']) {
            # code...
            if ($data['status'] == NULL) {
            # code...
            // dd('yeay');
            $data['laporan'] = LamanWeb::whereDate('tarikh_mula','>=',$request->tarikh_mula)
            ->whereDate('tarikh_tamat','<=',$request->tarikh_tamat)
            ->get();
        }else {
            # code...
            // dd('no');
            $data['laporan'] = LamanWeb::whereDate('tarikh_mula','>=',$request->tarikh_mula)
            ->whereDate('tarikh_tamat','<=',$request->tarikh_tamat)
            ->where('status','like',$request->status)
            ->get();
        }
        }
        
        

        // dd($status);

        return view('admin.laporan.laman_web',$data);
    }
    public function allLaporanAduan(Request $request){

        $data['date']= $request->input('tarikh_mohon');
        $data['status']= $request->input('status');
        $data['laporan'] = Aduan::all();



        // if( $request->input($data['date'])){
        //     $data['laporan'] = Aduan::where('date', 'LIKE', "%" . $request->tarikh_mohon . "%")->get();
        // }
        // if( $request->input($data['status'])){
        //     $data['laporan'] = Aduan::where('status', 'LIKE', "%" . $request->status . "%")->get();
        // }
        // if( $request->input($data['status'] && $data['date'])){
        //     $data['laporan'] = Aduan::where('status', 'LIKE', "%" . $request->status . "%")
        //                         ->where('date', 'LIKE', "%" . $request->tarikh_mohon . "%")->get();
        // }

        // dd($data['laporan']);
        if($data['date']){

            if($data['status'] == NULL){
                $data['laporan'] = Aduan::where('tarikh_mohon','like',"%".$request->tarikh_mohon."%")
                ->where('status','like',"%".$request->status."%")
                ->get();
            }else{
                $data['laporan'] = Aduan::where('tarikh_mohon','like',"%".$request->tarikh_mohon."%")
                ->where('status','like',"%".$request->status."%")
                ->get();
            }
        }
        if($data['status']){

            if($data['date'] == NULL){
                $data['laporan'] = Aduan::where('tarikh_mohon','like',"%".$request->tarikh_mohon."%")
                ->where('status','like',"%".$request->status."%")
                ->get();
            }else{
                $data['laporan'] = Aduan::where('tarikh_mohon','like',"%".$request->tarikh_mohon."%")
                ->where('status','like',"%".$request->status."%")
                ->get();
            }
        }




        return view('admin.laporan.aduan',$data);

    
}
}
