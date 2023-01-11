<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriSaluran;

class KategoriSaluranController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function allKategoriSaluran()
    {
        $data['katsaluran'] = KategoriSaluran::all();
        return view('admin.kategori_saluran.index',$data);
    }

    public function addKategoriSaluran()
    {
        return view('admin.kategori_saluran.add');
    }

    public function createKategoriSaluran(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        $kategori = new KategoriSaluran();
        $kategori->name = $request->name;
        $kategori->save();

        return redirect()->route('admin.all.kategorisaluran')->with('success','Data Kategori Saluran Anda Telah Berjaya Dimasukkan');
    }

    public function editKategoriSaluran($id)
    {
        $data['saluran'] = KategoriSaluran::find($id);
        return view('admin.kategori_saluran.edit',$data);
    }

    public function updateKategoriSaluran(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        $kategori = KategoriSaluran::find($id);
        $kategori->name = $request->name;
        $kategori->save();

        return redirect()->route('admin.all.kategorisaluran')->with('success','Data Kategori Saluran Anda Telah Berjaya Diubahsuai');
    }
}
