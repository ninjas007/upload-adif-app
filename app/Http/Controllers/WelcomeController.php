<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Award;

class WelcomeController extends Controller
{
    public function index()
    {
    	$data['awards'] = Award::paginate(6);

    	return view('welcome', $data);
    }
}
