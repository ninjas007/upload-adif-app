<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CronJobController extends Controller
{
    public function index()
    {
    	$users = User::where('life_time', 0)->where('category', 'premium')->get();
        
        $return['users'] = [];
    	foreach ($users as $user) {
    	    $data = [
                    'nama' => $user->name,
                    'kategori' => $user->category,
                    'callsign' => $user->callsign
                ];

            $date = date('Y-m-d', strtotime('+335 day', strtotime($user->register)));                
            
            if ($date == date('Y-m-d')) {
                
                $data['expired'] = false;

                \Mail::to($user->email)->send(new \App\Mail\ExpiredMail($data));
                $return['users'][] = [
                    'name' => $user->name,
                    'category' => $user->category,
                    'callsign' => $user->callsign,
                    'no_hp' => $user->no_hp
                ];
            }

            $date2 = date('Y-m-d', strtotime('+366 day', strtotime($user->register)));

            if ($date2 == date('Y-m-d')) {
                
                $data['expired'] = true;

                // update inactive user
                $u = User::findOrFail($user->id);
                $u->active = 0;
                $u->updated_at = date('Y-m-d H:i:s');
                $u->save();

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
    	if($return['count'] > 0) {
    	    \Mail::to(User::find(1)->first()->email)->send(new \App\Mail\ExpiredAdminNotifMail($return));
    	}

    }
}
