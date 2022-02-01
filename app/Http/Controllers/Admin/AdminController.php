<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Award;
use App\User;
use App\HakAkses;
use Validator;
use Hash;
use Illuminate\Support\Facades\DB;

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
    
    public function edit(Request $request, $id)
    {
        $data['user'] = User::findOrFail($id);
        $hak_akses = HakAkses::where('user_id', $id)->get();

        $data['fitur_akses'] = $hak_akses;

        return view('admin.admins.edit', $data);
    }

    public function update(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:100',
            'email' => 'required|string|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->to('admin/admin-edit/'.$request->user_id)->withErrors($validator->errors())->withInput();
        }
        DB::beginTransaction();
        try {

            $user = User::findOrFail($request->user_id);
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;

            $user->save();

            // cek jika sudah ada hak akses di user ini
            $hak_akses = HakAkses::where('user_id', $request->user_id)->get();
            foreach($request->menu as $menu => $fitur) {
                if(count($hak_akses) <= 0) {
                    $hak_akses = new HakAkses;
                } else {
                    $hak_akses = HakAkses::where('menu', $menu)->where('user_id', $request->user_id)->first();
                }

                $hak_akses->user_id = $request->user_id;
                $hak_akses->menu = $menu;
                $hak_akses->fitur_akses = json_encode($fitur);

                $hak_akses->save();
            }

            DB::commit();

            return redirect()->to('admin/admin-edit/'.$request->user_id)->with('success', 'Berhasil menyimpan data admin');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
        }

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
