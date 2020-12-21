<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;
use Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admin = User::where('id', Auth::user()->id)->first();

        return view('admin.setting.index', compact('admin'));
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
            'email' => 'required'
        ];

        if (!is_null($request->password_lama) && !is_null($request->password_baru)) {
            $rules['password_baru'] = 'min:8';
            $rules['password_lama'] = 'min:8';
        }

        $validator = Validator::make($request->all(), $rules);

        // jika validasinya ada yang tidak terpenuhi
        if ($validator->fails()) {
            return redirect('admin/setting')->withErrors($validator->errors());
        }

        $admin = User::findOrFail(Auth::user()->id);

        $admin->name = $request->nama;
        $admin->email = $request->email;

        if (!is_null($request->password_lama) && !is_null($request->password_baru)) {
            if (Hash::check($request->password_lama, $admin->password) == false) {
                return redirect('profile')->with('error', 'Password lama tidak sesuai');
            }

            $admin->password = Hash::make($request->password_baru);
        }

        $admin->save();

        return redirect('admin/setting')->with('success', 'Berhasil mengupdate data admin');
    }
}
