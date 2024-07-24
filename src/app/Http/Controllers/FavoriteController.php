<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = Favorite::with(['item', 'item.itemImages'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $items = $favorites->map(function ($favorite) {
            return $favorite->item;
        });

        return view('favorite_index', compact('items', 'user'));
    }

    public function store(Item $item)
    {
        Favorite::favorite(Auth::id(), $item->id);
        return redirect()->back();
    }
    public function destroy(Item $item)
    {
        Favorite::where('user_id', Auth::id())->where('item_id', $item->id)->delete();
        return redirect()->back();
    }
}
