<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\UserAward;
use App\Award;
use App\User;
use Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = User::where('role', 1)->paginate(5);

        return view('admin.member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Tambah data user
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tambah(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:100',
            'email' => 'required|string|max:255|unique:users',
            'callsign' => 'required|string|min:4|max:10|unique:users',
            'password' => 'required|string|min:8',
            'category' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/member/tambah')->withErrors($validator->errors());
        }

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'callsign' => $request->callsign,
            'password' => Hash::make($request->password),
            'category' => $request->category,
            'role' => 1,
            'foto' => 'profile.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $user->save();

        return redirect('admin/members')->with('success', 'Berhasil menambah member');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $userAward = UserAward::where('user_id', $id);
        $userAward->delete();

        // jika ada inputan yang di set
        if (isset($request->award_id)) {
            $rows = count($request->award_id);

            for ($i = 0; $i < $rows; $i++) {
                // jika form inputan kosong, abaikan
                if (is_null($request->post('link_googledrive')[$i])) {
                   continue;
                }
               
                $data[] = [
                   'award_id' => $request->post('award_id')[$i],
                   'user_id' => $id,
                   'link_googledrive' => $request->post('link_googledrive')[$i]
                ];
            }
            
            UserAward::insert($data);
        }

        return redirect('admin/members');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $data['id'] = $id;
        $data['awards'] = Award::get();
        $data['userAwards'] = UserAward::where('user_id', $id)->get();

        return view('admin.member.update', $data);
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        return view('admin.member.edit', compact('user'));
    }

    public function updateUser(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:100',
            'email' => 'required|string|max:255',
            'callsign' => 'required|string|min:4|max:10',
            'category' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/member/edit/'.$request->id.'')->withErrors($validator->errors());
        }

        $user = User::findOrFail($request->id);
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->callsign = $request->callsign;
        $user->category = $request->category;
        $user->updated_at = date('Y-m-d H:i:s');

        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('admin/members')->with('success', 'Berhasil mengupdate member');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $userAwards = UserAward::where('user_id', $id)->get();

        if (count($userAwards) > 0) {
            DB::table('user_awards')->where('user_id', $id)->delete();
        }

        $user->delete();

        return redirect('admin/members')->with('success', 'Berhasil menghapus member');
    }
}   
