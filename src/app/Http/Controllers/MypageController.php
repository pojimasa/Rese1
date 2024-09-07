<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $reservations = Reservation::where('user_id', $user->id)->get();
            $favorites = Like::where('user_id', $user->id)->with('shop')->get();
        } else {
            $reservations = [];
            $favorites = [];
        }

        return view('mypage', compact('reservations', 'favorites'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if ($reservation && $reservation->user_id == Auth::id()) {
            $reservation->delete();
            return redirect()->route('mypage')->with('success', '予約を削除しました。');
        } else {
            return redirect()->route('mypage')->with('error', '予約の削除に失敗しました。');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_people' => 'required|integer|min:1',
        ]);

        $reservation = Reservation::find($id);

        if ($reservation && $reservation->user_id == Auth::id()) {
            $reservationDateTime = $request->input('reservation_date') . ' ' . $request->input('reservation_time');
            $reservation->reservation_date = $reservationDateTime;
            $reservation->number_of_people = $request->input('number_of_people');
            $reservation->save();
            return redirect()->route('mypage')->with('success', '予約を更新しました。');
        } else {
            return redirect()->route('mypage')->with('error', '予約の更新に失敗しました。');
        }
    }
}
