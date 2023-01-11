<?php

namespace App\Http\Controllers;

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
}
