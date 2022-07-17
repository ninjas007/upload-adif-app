<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class MemberController extends Controller
{
    public function certificate(Request $request)
    {
        $password = base64_decode($request->token);
        $callsign = $request->callsign;

        $user = User::where('callsign', $callsign)->where('password', $password)->first();

        return view('admin.member.certificate', compact('user'));
    }
}
