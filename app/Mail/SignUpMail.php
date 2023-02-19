<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SignUpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $data)
    {

        return $this
            ->from('no-reply@github.com')
            ->to('jimipulsar@github.com')
            ->subject("New registration from ". config('app.name'))
            ->markdown('emails.signup')->with('data', $this->data);
    }
}
