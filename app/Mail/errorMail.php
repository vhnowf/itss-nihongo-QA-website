<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class errorMail extends Mailable
{
    use Queueable, SerializesModels;
    public $detail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detail)
    {
        $this->detail=$detail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $detail = $this->detail;
        return $this->view('errors.errorMail',compact('detail'));
    }
}
