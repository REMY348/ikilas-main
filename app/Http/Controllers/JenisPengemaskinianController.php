<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPengemaskinian;

class JenisPengemaskinianController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function allJenisPengemaskinian()
    {
        $data['jenis'] = JenisPengemaskinian::all();
        return view('admin.jenis_pengemaskinian.index',$data);
    }

    public function addJenisPengemaskinian()
    {
        return view('admin.jenis_pengemaskinian.add');
    }

    public function createJenisPengemaskinian(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        $jenis = new JenisPengemaskinian();
        $jenis->name = $request->name;
        $jenis->save();

        return redirect()->route('admin.all.jenispengemaskinian')->with('success','Data Jenis Pengemaskinian Anda Telah Berjaya Dimasukkan');
    }

    public function editJenisPengemaskinian($id)
    {
        $data['jenis'] = JenisPengemaskinian::find($id);
        return view('admin.jenis_pengemaskinian.edit',$data);
    }

    public function updateJenisPengemaskinian(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        $jenis = JenisPengemaskinian::find($id);
        $jenis->name = $request->name;
        $jenis->save();

        return redirect()->route('admin.all.jenispengemaskinian')->with('success','Data Jenis Pengemaskinian Anda Telah Berjaya Diubahsuai');
    }
}
