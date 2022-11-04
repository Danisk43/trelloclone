<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->reset_password_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from()->subject()->view('verification');
        return $this->from('daniyalsheikh4399@gmail.com', 'TrelloClone team')->subject('[Important Action Required] Reset your Taskit password')->view('reset-password-mail', ['mail_data' => $this->reset_password_data]);
    }
}
