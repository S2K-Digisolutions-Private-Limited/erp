<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OptCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $optCode;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @param int $optCode
     * @return void
     */
    public function __construct($optCode)
    {
        $this->optCode = $optCode;
        $this->subject = 'Email Verification OTP';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->markdown('email.opt_code')
            ->with(['optCode' => $this->optCode])
            ->bcc('system@skweb.ninja');
    }
}
