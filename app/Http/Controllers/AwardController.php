<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Award;
use App\UserAward;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $awards = Award::all();
        $userAwards = UserAward::where('user_id', Auth::user()->id)->get();

        return view('award', compact('awards', 'userAwards'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
