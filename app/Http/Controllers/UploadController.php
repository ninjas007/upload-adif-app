<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
// use App\Helpers\Adif;
use App\User;
use App\UserAdif;
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
                'msg' => 'Error upload file, file adif too large. Please send your file adif to email: hq.yb6dxc@gmail.com',
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

        // $p = new Adif;

        // $p->load_from_file($file);
        // $p->initialize();

        // // masukkan setiap baris dalam array
        // while ($row = $p->get_record()) {
        //     $records[] = [$row['call'], $row['band'], $row['mode'], $row['qso_date']];
        // }

        // $userAdif = UserAdif::updateOrCreate(
        //     ['user_id' => Auth::user()->id],
        //     ['data_adif' => json_encode($records), 'total_records' => count($records)]
        // );

        $user = User::where('id', Auth::user()->id)->first();
        
         $data = [
            'nama' => $user->name,
            'no_hp' => $user->no_hp,
            'alamat' => $user->alamat,
            'kategori' => $user->category,
            'callsign' => $user->callsign,
            'file' => $file,
            'to_user_email' => false,
        ];

        $send = \Mail::to('hq.yb6dxc@gmail.com')->send(new \App\Mail\UploadFileMail($data));

        $data = [
            'nama' => $user->name,
            'to_user_email' => true,
        ];

        $send2 = \Mail::to($user->email)->send(new \App\Mail\UploadFileMail($data));

        return response([
            'msg' => 'QSO LOGS was Successfully Updated from ADIF to Database, And your award application has been completed automatically. Please allow time for our managers to check in a maximum of 7 working days to check the award',
            'status' => 200
        ], 200);
        
    }
}
