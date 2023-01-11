<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Jawatan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function profilePengguna($id)
    {
        $id = Auth::user()->id;
        $data['pengguna'] = User::find($id);
        $data['jawatan'] = Jawatan::all();
        $data['jabatan'] = Jabatan::all();
// dd($data['pengguna'][0]->id);
        return view('admin.profile.current_profile',$data);

    }

    public function editProfilePengguna($id)
    {
        $id = Auth::user()->id;
        $data['pengguna'] = User::find($id);
        $data['jawatan'] = Jawatan::all();
        $data['jabatan'] = Jabatan::all();

        return view('admin.profile.edit',$data);
    }

    public function updateProfilePengguna(Request $request,$id)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'no_tel' => 'required|digits_between:10,11',
        //     'jantina' => 'required',
        //     'no_kp' => 'required|integer|digits_between:11,12',
        //     'jabatan_id' => 'required',
        //     'jawatan_id'  => 'required',
        //     'peranan' => 'required',
        //     'status' => 'required',
        // ]);
        $id = Auth::user()->id;
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
        $pengguna->save();
        return redirect()->back()->with('success','Data Pengguna Anda Telah Berjaya Diubahsuai');
    }

    public function editPasswordPengguna($id)
    {
        $id = Auth::user()->id;
        $data['pengguna'] = User::find($id);
        return view('admin.profile.edit_pass',$data);
    }

    public function updatePasswordPengguna(Request $request,$id)
    {
        $validatedData = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $id = Auth::user()->id;
        $user = User::find($id);
        $curr_pass = $user->password;
        $check = Hash::check($request->old_password, $curr_pass);
        // dd($curr_pass);
        if ($check) {
            # code...
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('logout')->with('success','Password Anda Telah Berjaya Diubah');
        }else {
            # code...
            return redirect()->back()->with('error','Password Anda Tidak Berjaya Diubah');
        }
    }
}
