<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReqRevMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inidata)
    {
        $this->data=$inidata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('untuk.aplikasi.kiki@gmail.com')->
            subject('Permohonan Review Jurnal')->
            view('mail.req_rev_mail')->with('data',$this->data);
    }
}
