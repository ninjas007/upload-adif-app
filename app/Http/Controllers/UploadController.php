<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'adif' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('upload')->with('error', 'File upload tidak boleh kosong');
        }

        $user = User::where('id', Auth::user()->id)->first();
        
        $file = $request->file('adif');
        $fileName = time() . $file->getClientOriginalName();
        
        $path = $file->storeAs('public/adif', $fileName);
        $attachment = storage_path('app/public/adif/'.$fileName);

        $mail = new PHPMailer(true);

        try {

            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'tiliztiadi@gmail.com';
            $mail->Password   = 'aimjzbcoulkanohb';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom($user->email, $user->name);
            $mail->addAddress('tiliztiadi@gmail.com');
            $mail->addReplyTo($user->email, $user->name);

            // Attachments
            $mail->addAttachment($attachment);

            // Content
            $mail->isHTML('Berhasil');
            $mail->Subject = 'File Adif';
            $mail->Body    = 'File Adif Member 
                                <br> <b> Nama : '.$user->name.'</b>
                                <br> <b> No Hp : '.$user->no_hp.'</b>
                                <br> <b> Alamat : '.$user->alamat.'</b>';

            $mail->send();

            Storage::delete('public/adif/'.$fileName);

            return redirect('upload')->with('success', 'Berhasil mengirim file');
            
        } catch (Exception $e) {

            return redirect('upload')->with('error', 'Gagal mengirim file. silahkan contact admin');
        }
    }
}
