<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        return view('home', compact('shops'));
    }

    public function detail($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);
        return view('shops.detail', compact('shop'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:shops',
            'password' => 'required|string|min:8',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        Shop::create($request->all());

        return redirect('/')->with('success', '飲食店が登録されました。');
    }

}
