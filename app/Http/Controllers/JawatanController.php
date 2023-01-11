<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jawatan;

class JawatanController extends Controller
{
    //
    public function _construct()
    {
        return $this->middleware('auth');
    }

    public function allJawatan()
    {
        $data['allData'] = Jawatan::all();
        return view('admin.jawatan.index',$data);
    }

    public function addJawatan()
    {
        return view('admin.jawatan.add');
    }

    public function createJawatan(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $Jawatan = new Jawatan();
        $Jawatan->name = $request->name;
        $Jawatan->save();

        return redirect()->route('all.jawatan')->with('success','Data Jawatan Anda Telah Berjaya Dimasukkan');
    }

    public function editJawatan($id)
    {
        $data['jawatan'] = Jawatan::find($id);

        return view('admin.jawatan.edit',$data);
    }

    public function updateJawatan(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $Jawatan = Jawatan::find($id);
        $Jawatan->name = $request->name;
        $Jawatan->save();

        return redirect()->route('all.jawatan')->with('success','Data Jawatan Anda Telah Berjaya Diubahsuai');
    }
}
