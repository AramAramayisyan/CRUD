<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IsAdminMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function build() : Mailable
    {
        return $this->view('mails.isAdmin')->with(['request' => $this->request]);
    }
}
