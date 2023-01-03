<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Forget_email extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($parameter)
    {
       $this->link= $parameter['link'];
       $this->email= $parameter['email'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
		->from('Maxis@web.com')
        ->subject("Forget Password")
        ->view('forget_mail')
        ->with(['link'=>$this->link,
        'email'=>$this->email,
    ]);

    }




    





}
