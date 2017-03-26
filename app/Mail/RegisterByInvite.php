<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterByInvite extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $nickname;
    public $registerPassword;
    public function __construct($username, $nickname, $registerPassword)
    {
        $this->username = $username;
        $this->nickname = $nickname;
        $this->registerPassword = $registerPassword;
    }

    public function build()
    {
        return $this->view('mails.registerByInvite');
    }
}
