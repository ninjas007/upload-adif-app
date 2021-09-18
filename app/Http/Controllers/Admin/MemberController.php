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
use App\HakAkses;
use Auth;
use Storage;

class MemberController extends Controller
{
    private function hakAkses()
    {
        // hak akses untuk menu member
        $hak_akses = HakAkses::where('user_id', auth()->user()->id)->where('menu', 'members')->first();
        if($hak_akses == null) {
            $return = json_encode([]);

            return $return;
        }
        $fitur_akses = json_decode($hak_akses->fitur_akses);

        return $fitur_akses;
    }

    public function jsonAdminMembers(Request $request)
    {
        $columns = [
            'name', 'category', 'callsign', 'class_premium', 'register'
        ];

        $totalData = User::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $members = User::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        // search
        else {
            $search = $request->input('search.value');

            $members =  User::where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('callsign', 'LIKE',"%{$search}%")
                            ->orWhere('class_premium', 'LIKE',"%{$search}%")
                            ->orWhere('category', 'LIKE',"%{$search}%")
                            ->orWhere('register', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = User::where('id','LIKE',"%{$search}%")
                             ->orWhere('name', 'LIKE',"%{$search}%")
                             ->orWhere('callsign', 'LIKE',"%{$search}%")
                            ->orWhere('class_premium', 'LIKE',"%{$search}%")
                             ->orWhere('category', 'LIKE',"%{$search}%")
                            ->orWhere('register', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        $url = url('');

        $fitur_akses = $this->hakAkses();


        if(!empty($members))
        {
            foreach ($members as $key => $member)
            {
                if($member->id != 1) {
                    $nestedData['member'] = '<a href="#" class="detail" data-id="'.$member->id.'" data-toggle="modal" data-target="#detailModal">'.$member->name.'  <br> '.$member->no_hp.'</a>';

                    if ($member->callsign == null) {
                        $callsign = '-';
                    } else {
                        $callsign = $member->callsign;
                    }

                    $nestedData['info'] = '<div class="font-weight-bold">Callsign : '.$callsign.'</div>';
                    $nestedData['info'] .= '<div class="font-weight-bold">Kategori : '.ucfirst($member->category).'</div>';

                    if ($member->life_time == 1) {
                        $nestedData['info'] .= 'Life Time : Aktif';
                    }

                    if (!is_null($member->class_premium)) {
                        $nestedData['info'] .= '<div class="font-weight-bold">Class Premium : '.ucfirst($member->class_premium).'</div>';
                    }

                    $nestedData['registrasi'] = ($member->register == null) ? '-' : date('d M Y', strtotime($member->register));
                    if(isset($fitur_akses->award)) {
                        $nestedData['award'] = '<a href="'.$url.'/admin/member/award-update/'.$member->id.'" class="btn btn-success btn-sm">Update</a>';
                    } else {
                        $nestedData['award'] = '<a href="#" class="btn btn-success btn-sm">Not Access</a>';
                    }

                    if(isset($fitur_akses->update)) {
                        $nestedData['action'] = '<a href="'.$url.'/admin/member/edit/'.$member->id.'" class="btn btn-primary btn-sm text-center mr-2">Edit</a>';
                    } else {
                        $nestedData['action'] = '<a href="#" class="btn btn-success btn-sm">Not Access</a>';
                    }


                    if(isset($fitur_akses->delete)) {
                        $nestedData['action'] .= '<a href="'.$url.'/admin/member/hapus/'.$member->id.'" class="btn btn-danger btn-sm text-center">Hapus</a>';
                    } else {
                        $nestedData['action'] .= '<a href="#" class="btn btn-success btn-sm">Not Access</a>';
                    }

                    $data[] = $nestedData;
                }
            }
        }

        $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData - 1),
                    "recordsFiltered" => intval($totalFiltered - 1),
                    "data"            => $data
                    );

        return response()->json($json_data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $members = User::where('role', 1)->get();

        return view('admin.member.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkAdmin();

        return view('admin.member.create');
    }

    /**
     * Show members
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data['user'] = User::where('id', $request->input('id'))->first();

        return view('admin/member/detail', $data);
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
            'category' => 'required|string',
            'member_id' => 'required|string|max:20'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/member/tambah')->withErrors($validator->errors());
        }

        $user = User::create([
        	'member_id' => strtoupper($request->member_id),
            'name' => $request->nama,
            'email' => $request->email,
            'callsign' => $request->callsign,
            'password' => Hash::make($request->password),
            'category' => $request->category,
            'class_premium' => $request->class_premium,
            'life_time' => $request->life_time,
            'role' => 1,
            'foto' => 'profile.jpg',
            'register' => $request->register,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'certificate' => $request->certificate
        ]);

        $user->save();

        return redirect('admin/members')->with('success', 'Berhasil menambah member')->with('user');
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
        // $fitur_akses = $this->hakAkses();

        // // jika update award di klik cek apakah ada hak akses dari user ini
        // if($fitur_akses->award != 'on') {
        //     die('Not Access');
        // }

        $data['id'] = $id;
        $data['awards'] = Award::get();
        $data['userAwards'] = UserAward::where('user_id', $id)->get();

        return view('admin.member.update', $data);
    }

    public function edit($id)
    {
        // $fitur_akses = $this->hakAkses();

        // // jika update update di klik cek apakah ada hak akses dari user ini
        // if(!isset($fitur_akses->update)) {
        //     die('Not Access');
        // }

        $user = User::where('id', $id)->first();

        return view('admin.member.edit', compact('user'));
    }

    public function updateUser(Request $request)
    {
        // $fitur_akses = $this->hakAkses();

        // // jika update update di klik cek apakah ada hak akses dari user ini
        // if(!isset($fitur_akses->update)) {
        //     die('Not Access');
        // }

        $rules = [
            'nama' => 'required|string|max:100',
            'email' => 'required|string|max:255',
            'callsign' => 'required|string|min:4|max:10',
            'category' => 'required|string',
            'member_id' => 'required|string|max:20'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/member/edit/'.$request->id.'')->withErrors($validator->errors());
        }

        $user = User::findOrFail($request->id);
        $user->member_id = strtoupper($request->member_id);
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->callsign = $request->callsign;
        $user->category = $request->category;
        $user->class_premium = $request->class_premium;
        $user->life_time = $request->life_time;
        $user->register = $request->register;
        $user->active = $request->active;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->certificate = $request->certificate;

        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('admin/members')->with('success', 'Berhasil mengupdate member');
    }

    public function destroy($id)
    {
        $fitur_akses = $this->hakAkses();

        // jika update update di klik cek apakah ada hak akses dari user ini
        if(!isset($fitur_akses->delete)) {
            die('Not Access');
        }

        $this->checkAdmin();

        $user = User::findOrFail($id);
        $userAwards = UserAward::where('user_id', $id)->get();

        if (count($userAwards) > 0) {
            DB::table('user_awards')->where('user_id', $id)->delete();
        }

        if ($user->foto != 'profile.jpg') {
            Storage::delete('public/foto/'.$user->foto);
        }

        $user->delete();

        return redirect('admin/members')->with('success', 'Berhasil menghapus member');
    }

    private function checkAdmin()
    {
        if (Auth::user()->manager == 1 && Auth::user()->category == 'admin') {
            echo 'Bukan super admin';
            die;
        }
    }
}
