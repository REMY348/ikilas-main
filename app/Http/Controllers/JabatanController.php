<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;
use Illuminate\Auth\Events\Validated;

class JabatanController extends Controller
{
    //
    public function _construct()
    {
        return $this->middleware('auth');
    }

    public function allJabatan()
    {
        $data['allData'] = Jabatan::all();
        return view('admin.jabatan.index',$data);
    }

    public function addJabatan()
    {
        return view('admin.jabatan.add');
    }

    public function createJabatan(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $jabatan = new Jabatan();
        $jabatan->name = $request->name;
        $jabatan->save();

        return redirect()->route('all.jabatan')->with('success','Data Jabatan Anda Telah Berjaya Dimasukkan');
    }

    public function editJabatan($id)
    {
        $data['jabatan'] = Jabatan::find($id);

        return view('admin.jabatan.edit',$data);
    }

    public function updateJabatan(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $jabatan = Jabatan::find($id);
        $jabatan->name = $request->name;
        $jabatan->save();

        return redirect()->route('all.jabatan')->with('success','Data Jabatan Anda Telah Berjaya Diubahsuai');
    }
}
