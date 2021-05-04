<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $token;
     public $url;
     public $user;

    public function __construct($token, $url, $user)
    {    
        $this->token = $token;
        $this->url = $url;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Validar Cuenta - Arquiconstruye')
                    ->markdown('mail.register', [
                        'token' => $this->token,
                        'url' => $this->url,
                        'user' => $this->user,
                    ]);
    }
}
