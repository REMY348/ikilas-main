<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Jawatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function logout(Request $request)
    {
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
    }

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function allPengguna()
    {
        $data['allData'] = User::all();
        return view('admin.tambah_pengguna.index',$data);
    }

    public function addPengguna()
    {
        $data['jabatan'] = Jabatan::all();
        $data['jawatan'] = Jawatan::all();
        return view('admin.tambah_pengguna.add',$data);
    }

    public function createPengguna(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'no_tel' => 'required|digits_between:10,11',
            'jantina' => 'required',
            'no_kp' => 'required|integer|digits_between:11,12|unique:users,no_kp',
            'jabatan_id' => 'required',
            'jawatan_id'  => 'required',
            'peranan' => 'required',
            'status' => 'required',
        ]);

        $pengguna = new User();
        $pengguna->name = $request->name;
        $pengguna->email = $request->email;
        $pengguna->no_tel = $request->no_tel;
        $pengguna->jantina = $request->jantina;
        $pengguna->no_kp = $request->no_kp;
        $pengguna->jabatan_id = $request->jabatan_id;
        $pengguna->jawatan_id = $request->jawatan_id;
        $pengguna->role = $request->peranan;
        $pengguna->status = $request->status;
        $pengguna->password = Hash::make($request->no_kp);
        $pengguna->save();

        return redirect()->route('admin.all.pengguna')->with('success','Data Pengguna Telah Berjaya Dimasukkan');
    }

    public function editPengguna($id)
    {
        $data['jabatan'] = Jabatan::all();
        $data['jawatan'] = Jawatan::all();
        $data['pengguna'] = User::find($id); 
        
        return view('admin.tambah_pengguna.edit',$data); 
    }

    public function updatePengguna(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'no_tel' => 'required|digits_between:10,11',
            'jantina' => 'required',
            'no_kp' => 'required|integer|digits_between:11,12',
            'jabatan_id' => 'required',
            'jawatan_id'  => 'required',
            'peranan' => 'required',
            'status' => 'required',
        ]);

        $pengguna = User::find($id);
        $pengguna->name = $request->name;
        $pengguna->email = $request->email;
        $pengguna->no_tel = $request->no_tel;
        $pengguna->jantina = $request->jantina;
        $pengguna->no_kp = $request->no_kp;
        $pengguna->jabatan_id = $request->jabatan_id;
        $pengguna->jawatan_id = $request->jawatan_id;
        $pengguna->role = $request->peranan;
        $pengguna->status = $request->status;
        $pengguna->password = Hash::make($request->no_kp);
        $pengguna->save();

        return redirect()->route('admin.all.pengguna')->with('success','Data Pengguna Telah Berjaya Diubahsuai');
    }
}
