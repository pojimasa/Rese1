<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RatingRequest;

class RatingController extends Controller
{
    public function store(RatingRequest $request)
    {
        $validated = $request->validated();

        $reservationExists = Reservation::where('user_id', auth()->id())
                                        ->where('shop_id', $request->shop_id)
                                        ->where('reservation_date', '<=', now())
                                        ->exists();

        if (!$reservationExists) {
        return redirect()->back()->with('reservation_error', '※過去に予約 & 来店した店舗のみ評価することができます。');
    }

        Rating::create([
            'shop_id' => $request->shop_id,
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->back()->with('success', '評価が投稿されました！');
    }
}
