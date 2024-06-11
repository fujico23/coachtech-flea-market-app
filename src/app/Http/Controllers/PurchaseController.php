<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;


class PurchaseController extends Controller
{
    public function create(Item $item)
    {
        $shippingAddress = Address::where('user_id', Auth::id())
            ->where('is_default', true)
            ->first();

        $item->getDetailItem();
        return view('purchase', compact('item', 'shippingAddress'));
    }
}
