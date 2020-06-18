<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();

        if ($user->role == 0) {
            return redirect('admin/awards');    
        }
        
        if($user->role == 1){
            return redirect('awards');
        }
    }
}
