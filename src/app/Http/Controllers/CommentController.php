<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class CommentController extends Controller
{
    public function show(Item $item)
    {
        $item->getDetailItem();
        $item->favorites_count = $item->favorites()->count();
        return view('comment', compact('item'));
    }
}
