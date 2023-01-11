<?php

namespace App\Http\Controllers;

use App\Models\KategoriMaklumat;
use Illuminate\Http\Request;

class KategoriMaklumatController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function allKategoriMaklumat()
    {
        $data['katmaklumat'] = KategoriMaklumat::all();
        return view('admin.kategori_maklumat.index',$data);
    }

    public function addKategoriMaklumat()
    {
        return view('admin.kategori_maklumat.add');
    }

    public function createKategoriMaklumat(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        $kategori = new KategoriMaklumat();
        $kategori->name = $request->name;
        $kategori->save();

        return redirect()->route('admin.all.kategorimaklumat')->with('success','Data Kategori Maklumat Anda Telah Berjaya Dimasukkan');
    }

    public function editKategoriMaklumat($id)
    {
        $data['maklumat'] = KategoriMaklumat::find($id);
        return view('admin.kategori_maklumat.edit',$data);
    }

    public function updateKategoriMaklumat(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        $kategori = KategoriMaklumat::find($id);
        $kategori->name = $request->name;
        $kategori->save();

        return redirect()->route('admin.all.kategorimaklumat')->with('success','Data Kategori Maklumat Anda Telah Berjaya Diubahsuai');
    }

}
