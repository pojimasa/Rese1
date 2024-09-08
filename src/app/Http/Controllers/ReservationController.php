<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmation;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    public function done($reservation_id, Request $request)
    {
        $reservation = Reservation::with('shop')->findOrFail($reservation_id);
        $shop_id = $request->session()->get('shop_id');
        return view('reservations.done', compact('reservation', 'shop_id'));
    }

    public function store(ReservationRequest $request)
    {
        $validatedData = $request->validated();

        $reservationDateTime = $validatedData['reservation_date'] . ' ' . $validatedData['reservation_time'];

        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->shop_id = $validatedData['shop_id'];
        $reservation->reservation_date = $reservationDateTime;
        $reservation->number_of_people = $validatedData['number_of_people'];
        $reservation->save();

        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode(route('reservation.done', ['reservation_id' => $reservation->id]));

        Mail::to(Auth::user()->email)->send(new ReservationConfirmation($reservation, $qrCodeUrl));

        return redirect()->route('reservation.done', ['reservation_id' => $reservation->id])
            ->with('shop_id', $reservation->shop_id);
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
