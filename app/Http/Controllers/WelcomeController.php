<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Award;
use App\User;
// use DataTables;

class WelcomeController extends Controller
{
    public function index()
    {
    	$data['members'] = User::where('category', 'member')->get();

    	return view('welcome.members', $data);
    }

    public function awards()
    {
    	$data['awards'] = Award::paginate(6);

    	return view('welcome.awards', $data);
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
