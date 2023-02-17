<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $data)
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
            ->from('no-reply@github.com', $data->name)
//            ->to('shop@mabrosrl.it')
            ->to('jimipulsar@github.com')
            ->subject("Richiesta dal form di contatto di jimipulsar@github.com")
            ->markdown('emails.sendmail')->with('data', $this->data);
    }
}
