<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Notifications\ReservationReminder;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;

class SendReminders extends Command
{
    protected $signature = 'send:reminders';
    protected $description = 'Send reservation reminders for the day';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::today();
        $reservations = Reservation::whereDate('reservation_date', $today)->get();

        foreach ($reservations as $reservation) {
            $reservation->user->notify(new ReservationReminder($reservation));
        }

        $this->info('Reservation reminders sent successfully!');
    }
}
