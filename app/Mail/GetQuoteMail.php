<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GetQuoteMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $email)
    {
        $this->details = $details;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->markdown('emails.getQuoteMail')->subject('Request For Quotation')->replyTo(['email'=>$this->email])->with('details', $this->details);
    }
}
