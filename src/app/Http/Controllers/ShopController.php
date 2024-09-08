<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function detail($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);
        $reservation = Reservation::where('shop_id', $shop_id)
            ->where('user_id', Auth::id())
            ->first();
        return view('shops.detail', compact('shop', 'reservation'));
    }

    public function show($id)
    {
        $shop = Shop::findOrFail($id);

        $canRate = false;
        if (Auth::check()) {
            $reservation = Reservation::where('user_id', Auth::id())
                ->where('shop_id', $shop->id)
                ->where('reservation_date', '<', Carbon::now())
                ->first();
            $canRate = $reservation !== null;
        }

        return view('shops.detail', compact('shop', 'canRate'));
    }

    public function saveImage(Request $request, $shopId)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shop = Shop::findOrFail($shopId);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            $shop->image = $imagePath;
            Log::info('Saved image path: ' . $imagePath);
        }

        $shop->save();

        return redirect()->back()->with('status', '画像が保存されました。');
    }

    public function done($reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);
        $shop_id = $reservation->shop_id;

        return view('reservations.done', [
            'reservation' => $reservation,
            'shop_id' => $shop_id
        ]);
    }
}
