<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\ShopRequest;
use App\Http\Requests\CreateManagerRequest;

class ManagerController extends Controller
{
    public function dashboard()
    {
        return view('manager.dashboard');
    }

    public function shops()
    {
        $user = Auth::user();
        $shops = Shop::where('user_id', $user->id)->get();
        return view('manager.shops', compact('shops'));
    }

    public function createShop()
    {
        $user = Auth::user();
        $shopCount = Shop::where('user_id', $user->id)->count();
        $maxShops = 1;

        if ($shopCount >= $maxShops) {
            return redirect()->route('manager.shops')->withErrors(['error' => '作成できる店舗は１店舗のみです']);
        }

        return view('manager.create-shop');
    }

    public function createManager()
    {
        $shops = Shop::all();
        return view('manager.create-manager', compact('shops'));
    }

    public function storeManager(CreateManagerRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'is_admin' => false,
            'is_store_representative' => true,
        ]);

        return redirect()->route('manager.dashboard')->with('success', '店舗代表者が作成されました。');
    }

    public function storeShop(ShopRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        $existingShop = Shop::where('user_id', $user->id)->first();

        if ($existingShop) {
            return redirect()->route('manager.shops')->withErrors('作成できる店舗は１店舗のみです');
        }

        Shop::create([
            'name' => $data['name'],
            'location' => $data['location'],
            'genre' => $data['genre'],
            'category' => $data['category'],
            'user_id' => $user->id,
        ]);

        return redirect()->route('manager.shops')->with('success', '店舗が作成されました。');
    }

    public function editShop(Shop $shop)
    {
        if (Auth::user()->id !== $shop->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('manager.edit-shop', compact('shop'));
    }

    public function updateShop(ShopRequest $request, Shop $shop)
    {
        if (Auth::user()->id !== $shop->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $shop->update($request->validated());

        return redirect()->route('manager.shops')->with('success', '店舗情報が更新されました。');
    }

    public function reservations()
    {
        $user = Auth::user();
        $reservations = Reservation::whereHas('shop', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('manager.reservations', compact('reservations'));
    }

    public function saveImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shop = Shop::findOrFail($id);
        $imagePath = $request->file('image')->store('shops', 'public');

        $shop->image = $imagePath;
        $shop->save();

        return redirect()->route('manager.shops')->with('success', '画像が保存されました。');
    }
}
