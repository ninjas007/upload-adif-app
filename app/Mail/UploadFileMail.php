<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UploadFileMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;

        if ($data['to_user_email']) {
            return $this->subject('claim confirmation YB6-DXCommunity awards')
                        ->view('emails.upload_file_notification', compact('data'));
        }

        return $this->subject('Member File '.$data['callsign'].'')
                    ->view('emails.upload_file', compact('data'))
                    ->attach($data['file']->getrealPath(), [
                        'as' => $data['file']->getClientOriginalName(),
                    ]);
    }
}
