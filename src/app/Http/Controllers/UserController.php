<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class UserController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        $items = Item::getItemByUserId($user->id);
        return view('mypage', compact('user', 'items'));
    }
}
