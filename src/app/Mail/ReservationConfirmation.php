<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $qrCodeUrl;

    public function __construct($reservation, $qrCodeUrl)
    {
        $this->reservation = $reservation;
        $this->qrCodeUrl = $qrCodeUrl;
    }

    public function build()
    {
        return $this->view('emails.reservation_confirmation')
                    ->with([
                        'reservation' => $this->reservation,
                        'qrCodeUrl' => $this->qrCodeUrl,
                    ]);
    }
}
