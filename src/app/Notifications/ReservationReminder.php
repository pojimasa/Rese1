<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class ReservationReminder extends Notification
{
    use Queueable;

    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject('予約リマインダー')
                ->greeting("こんにちは、{$this->reservation->user->name}様")
                ->line('以下の予約があります。')
                ->line('店舗名: ' . $this->reservation->shop->name)
                ->line('予約日時: ' . Carbon::parse($this->reservation->reservation_date)->format('Y-m-d H:i'))
                ->line('お忘れなくご来店ください。');
    }

    public function toArray($notifiable)
    {
        return [
            'reservation_id' => $this->reservation->id,
            'reservation_date' => $this->reservation->reservation_date,
        ];
    }
}
