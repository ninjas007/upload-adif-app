<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function checkAdmin($request)
    {
        $user = User::where('email', $request->email_admin)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return true;
            } else {

                return false;
            }
        } else {
            return false;
        }
    }

    public function getMembers(Request $request)
    {
        if($this->checkAdmin($request)){
            $user = User::where('category', '!=', 'admin')->get();

            return response()->json($user);
        }

        return response()->json(['error' => 'email admin atau password admin salah'], 401);
    }

    public function create(Request $request)
    {
        if($this->checkAdmin($request)) {
            $user_email = $request->email ?? null;
            
            if($user_email == null){
                return response()->json(['error' => 'email member tidak boleh kosong'], 401);
            }

            $check = User::where('email', $user_email)->first();

            if($check) {
                return response()->json(['error' => 'Email ada yang sama'], 401);
            }

            $user = new User;
            $user->name = $request->name ?? $user_email;
            $user->callsign = $request->callsign ?? null;
            $user->register = $request->register ?? null;
            $user->member_id = $request->member_id ?? null;
            $user->email = $user_email;
            $user->password = Hash::make('amatir123');
            $user->category = $request->category ?? 'free';
            $user->role = 1;
            $user->foto = 'profile.jpg';
            $user->class_premium = $request->class_premium ?? null;
            $user->life_time = $request->life_time ?? 0;
            $user->register = $request->register ?? null;
            $user->active = $request->active ?? 0;
            $user->no_hp = $request->no_hp ?? null;
            
            
            $user->save();

            $user_get = User::where('email', $user_email)->first();

            $data = [
                'email' => $user_get->email,
                'password' => $user_get->password,
            ];

            return response()->json($data);
        }

        return response()->json(['error' => 'email admin atau password admin salah'], 401);

    }

    public function update(Request $request)
    {
        if($this->checkAdmin($request)) {
            $user_email = $request->email ?? null;
            
            if($user_email == null){
                return response()->json(['error' => 'email member tidak boleh kosong'], 401);
            }

            // $check = User::where('email', $user_email)->first();

            // if($check) {
            //     return response()->json(['error' => 'Email ada yang sama'], 401);
            // }

            $user = User::where('callsign',  $request->callsign)->first();
            $user->name = $request->name ?? $user_email;
            $user->callsign = $request->callsign ?? null;
            $user->register = $request->register ?? null;
            $user->member_id = $request->member_id ?? null;
            $user->email = $user_email;
            $user->password = Hash::make('amatir123');
            $user->category = $request->category ?? 'free';
            $user->role = 1;
            $user->foto = 'profile.jpg';
            $user->class_premium = $request->class_premium ?? null;
            $user->life_time = $request->life_time ?? 0;
            $user->register = $request->register ?? null;
            $user->active = $request->active ?? 0;
            $user->no_hp = $request->no_hp ?? null;
            
            
            $user->save();

            $user_get = User::where('email', $user_email)->first();

            $data = [
                'email' => $user_get->email,
                'password' => $user_get->password,
            ];

            return response()->json($data);
        }

        return response()->json(['error' => 'email admin atau password admin salah'], 401);

    }
    
    public function deleteMember(Request $request)
    {
        if($this->checkAdmin($request)) {
            $callsign = $request->callsign ?? null;
            $user = User::where('callsign', $callsign)->first();
            $user->delete();

            if($user) {
                $data = [
                    'message' => 'Berhasil menghapus member dengan callsign '. $callsign. '',
                    'status' => 200
                ];
            } else {
                $data = [
                    'message' => 'Gagal menghapus member dengan callsign '. $callsign. '. kesalahan server.',
                    'status' => 200
                ];
            }

            return response()->json($data, 200);
        }

        return response()->json(['error' => 'email admin atau password admin salah'], 401);
    }

    public function getMemberById(Request $request, $id)
    {
        if($this->checkAdmin($request)) {
            $user = User::find($id);

            return response()->json($user);
        }

        return response()->json(['error' => 'email admin atau password admin salah'], 401);
    }

    public function getMemberByOffset(Request $request, $start, $limit)
    {
        if($this->checkAdmin($request)){
            $user = User::where('category', '!=', 'admin')->offset($start)->limit($limit)->get();

            return response()->json($user);
        }

        return response()->json(['error' => 'email admin atau password admin salah'], 401);
    }
}
