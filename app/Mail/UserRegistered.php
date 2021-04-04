<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;
    private $first_name;
    private $last_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->first_name='safoora';
        $this->last_name='aghabazaz';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user-registerd')->with(['full_name'=>$this->first_name.' '.$this->last_name]);
    }
}
