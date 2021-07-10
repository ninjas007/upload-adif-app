<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class MemberController extends Controller
{
    public function getMembers()
    {
        $user = User::where('category', '!=', 'admin')->get();

        return response()->json($user);
    }
}
