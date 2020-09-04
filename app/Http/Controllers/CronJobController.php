<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CronJobController extends Controller
{
    public function index()
    {
    	$users = User::all();

    	foreach ($users as $user) {    		
    		 $data = [
    		    'nama' => $user->name,
    		    'kategori' => $user->category,
    		    'callsign' => $user->callsign
    		];

    		if ($user->register == date('Y-m-d')) {
    			// \Mail::to($user->email)->send(new \App\Mail\ExpiredMail($data));
    			$return['users'][] = [
    				'name' => $user->name,
    				'category' => $user->category,
    				'callsign' => $user->callsign,
    				'no_hp' => $user->no_hp
    			];
    		}
    	}

    	$return['count'] = count($return['users']);

    	\Mail::to('tiliztiadi@gmail.com')->send(new \App\Mail\ExpiredAdminNotifMail($return));
    }
}
