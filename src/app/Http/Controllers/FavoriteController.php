<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favoriteItems = Favorite::with(['item', 'item.itemImages'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('favorite_index', compact('favoriteItems'));
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
