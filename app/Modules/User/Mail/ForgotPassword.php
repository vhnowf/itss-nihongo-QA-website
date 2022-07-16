<?php

namespace App\Modules\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $randomPass;

    public function __construct($user, $randomPass)
    {
        $this->user = $user;
        $this->randomPass = $randomPass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $randomPass = $this->randomPass;

        return $this->view('User::mails.forgot-pass', compact('user', 'randomPass'))->subject(__('Yêu cầu lấy lại mật khẩu'));
    }
}
