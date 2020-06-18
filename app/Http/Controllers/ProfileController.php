<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = User::find(Auth::user()->id);

        return view('profile', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'nama' => 'required|max:100',
            'email' => 'required',
            'foto' => 'max:500|mimes:jpeg,jpg,png',
        ];

        if (!is_null($request->password_lama) && !is_null($request->password_baru)) {
            $rules['password_baru'] = 'min:8';
            $rules['password_lama'] = 'min:8';
        }

        $validator = Validator::make($request->all(), $rules);

        // jika validasinya ada yang tidak terpenuhi
        if ($validator->fails()) {
            return redirect('profile')->withErrors($validator->errors());
        }

        $user = User::where('email', $request->email)->first();

        // jika ada email yg sama
        if (!empty($user) && $user->id != Auth::user()->id) {
           return redirect('profile')->with('error', 'Email already exist');
        }

        $user = User::findOrFail(Auth::user()->id);
        $fotoLama = $user->foto;
        $hapus = false;

        // jika file di upload
        if (!is_null($request->file('foto'))) {
            $file = $request->file('foto');
            $foto = time() . $file->getClientOriginalName();
            $path = $file->storeAs('public/foto', $foto);
            $hapus = true;
        } else {
            $foto = $user->foto;
        }

        $user->name = $request->nama;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->foto = $foto;

        if (!is_null($request->password_lama) && !is_null($request->password_baru)) {
            if (Hash::check($request->password_lama, $user->password) == false) {
                return redirect('profile')->with('error', 'Old password not match');
            }

            $user->password = Hash::make($request->password_baru);
        }

        $user->save();

        if ($fotoLama != 'profile.jpg' && $hapus) {
            Storage::delete('public/foto/'.$fotoLama);
        }
        
        return redirect('profile')->with('success', 'Success update profile');
    }

}
