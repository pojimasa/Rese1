<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    public function __construct($content)
    {
        $this->content = $content;
    }

    public function build()
    {
        return $this->subject('お知らせメール')
                    ->view('emails.notification')
                    ->with(['content' => $this->content]);
    }
}
