<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Like;

class HomeController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        $genres = Shop::select('genre')->distinct()->get();
        $areas = Shop::select('location')->distinct()->get();

        return view('pages.home', compact('shops', 'genres', 'areas'));
    }

    public function detail($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);

        return view('shops.detail', compact('shop'));
    }

    public function like($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        Like::create([
            'shop_id' => $id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back();
    }

    public function unlike($id)
    {
        $like = Like::where('shop_id', $id)
                    ->where('user_id', auth()->id())
                    ->first();

        if ($like) {
            $like->delete();
        }

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $query = Shop::query();

        if ($request->filled('area')) {
            $query->where('location', 'like', '%' . $request->area . '%');
        }

        if ($request->filled('genre')) {
            $query->where('genre', 'like', '%' . $request->genre . '%');
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $shops = $query->get();
        $genres = Shop::select('genre')->distinct()->get();
        $areas = Shop::select('location')->distinct()->get();

        return view('pages.home', compact('shops', 'genres', 'areas'));
    }
}
