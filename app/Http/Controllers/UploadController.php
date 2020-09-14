<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;
use App\User;
use Validator;
use Auth;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        $rules = [
            'adif' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response([
                'msg' => 'File upload required',
                'status' => http_response_code(400)
            ], 400);
        }

        $file = $request->file('adif');
        $fileName = time() . $file->getClientOriginalName();

        $explode = explode('.',$fileName);

        if (end($explode) != 'adi') {
            return response([
                'msg' => 'Upload file .adi',
                'status' => 400
            ], 400);
        }

        $user = User::where('id', Auth::user()->id)->first();
        
         $data = [
            'nama' => $user->name,
            'no_hp' => $user->no_hp,
            'alamat' => $user->alamat,
            'kategori' => $user->category,
            'callsign' => $user->callsign,
            'file' => $file
        ];
        
        $send = \Mail::to('tiliztiadi@gmail.com')->send(new \App\Mail\UploadFileMail($data));

        return response([
            'msg' => 'File for a successful award claim, please wait while in progress',
            'status' => 200
        ], 200);
        
    }
}
