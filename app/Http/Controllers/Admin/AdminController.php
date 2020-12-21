<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Award;
use App\User;
use Validator;
use Hash;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $awards = Award::paginate(5);

        return view('admin.award.index', compact('awards'));
    }

    public function listAdmin()
    {
        $data['users'] = User::where(['role' => 0, 'category' => 'admin', 'manager' => 1])->get()->toArray();

        return view('admin.admins.list-admin', $data);
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:100',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->to('admin/admin-tambah')->withErrors($validator->errors())->withInput();
        }

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'category' => 'admin',
            'role' => 0,
            'manager' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $user->save();

        return redirect('admin/listAdmin')->with('success', 'Berhasil menambah admin');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first()->toArray();

        if ($user['manager'] == 1) {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect('admin/listAdmin')->with('success', 'Berhasil menghapus admin');
        }

        return redirect('admin/listAdmin')->with('error', 'Gagal menghapus admin');
    }
}
