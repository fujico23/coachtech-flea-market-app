<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::getItems();
        return view('index', compact('items'));
    }

    public function detail(Item $item)
    {
        $item->getDetailItem();
        $item->favorites_count = $item->favorites()->count();
        return view('detail', compact('item'));
    }
}
