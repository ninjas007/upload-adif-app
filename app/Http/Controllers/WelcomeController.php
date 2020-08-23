<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Award;
use App\User;
use App\Banner;
// use DataTables;

class WelcomeController extends Controller
{
    public function index()
    {
        $data['awards'] = Award::paginate(6);
        $data['banners'] = Banner::all();

        return view('welcome.awards', $data);
    }

    public function members()
    {
        $data['members'] = User::where('role', 1)->get();
        $data['banners'] = Banner::all();

        return view('welcome.members', $data);
    }

    public function jsonDetailMember(Request $request)
    {
        $member = User::where('callsign', $request->get('callsign'))->with('awards')->first();

        $data['member'] = [
            'name' => $member->name,
            'callsign' => $member->callsign,
            'alamat' => $member->alamat,
            'foto' => $member->foto,
            'category' => ucfirst($member->category)
        ];

        return response()->json($data);
    }
    // public function userJson()
    // {
    // 	$users = User::where('category', 'member')->get();

    // 	foreach ($users as $key => $user) {
    // 		$data[] = [
    // 			'no' => ++$key,
    // 			'name' => $user->name,
    // 			'role' => ($user->role == 1) ? 'Free' : 'Premium',
    // 			'callsign' => $user->callsign,
    // 			'register' => ($user->register == null) ? '-' : $user->register,
    // 		];
    // 	}

    // 	return Datatables::of($data)->make(true);
    // }
}
