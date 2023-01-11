<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisAduan;

class JenisAduanController extends Controller
{
    //

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function allJenisAduan()
    {
        $data['jenis'] = JenisAduan::all();
        return view('admin.jenis_aduan.index',$data);
    }

    public function addJenisAduan()
    {
        return view('admin.jenis_aduan.add');
    }

    public function createJenisAduan(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        $jenis = new JenisAduan();
        $jenis->name = $request->name;
        $jenis->save();

        return redirect()->route('admin.all.jenisaduan')->with('success','Data Jenis Aduan Anda Telah Berjaya Dimasukkan');
    }

    public function editJenisAduan($id)
    {
        $data['jenis'] = JenisAduan::find($id);
        return view('admin.jenis_aduan.edit',$data);
    }

    public function updateJenisAduan(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        $jenis = JenisAduan::find($id);
        $jenis->name = $request->name;
        $jenis->save();

        return redirect()->route('admin.all.jenisaduan')->with('success','Data Jenis Aduan Anda Telah Berjaya Diubahsuai');
    }
}
