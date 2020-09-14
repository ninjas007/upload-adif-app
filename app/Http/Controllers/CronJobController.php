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

            $date = date('Y-m-d', strtotime('+335 day', strtotime($user->register)));                
    		
            if ($date == date('Y-m-d')) {
    			\Mail::to($user->email)->send(new \App\Mail\ExpiredMail($data));
    			$return['users'][] = [
    				'name' => $user->name,
    				'category' => $user->category,
    				'callsign' => $user->callsign,
    				'no_hp' => $user->no_hp
    			];
    		}
    	}

    	$return['count'] = count($return['users']);

    	\Mail::to(User::find(1)->first()->email)->send(new \App\Mail\ExpiredAdminNotifMail($return));
    }
}
