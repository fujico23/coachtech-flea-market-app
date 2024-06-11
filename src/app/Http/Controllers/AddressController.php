<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function update(Item $item)
    {
        $addresses = Address::where('user_id', Auth::id())->get();
        return view('address_list', compact('item', 'addresses'));
    }
    public function selectAddress(Request $request)
    {
        $userId = Auth::id();
        $addressId = $request->input('address_id');

        // ユーザーの全ての住所のデフォルトフラグをリセット
        Address::where('user_id', $userId)->update(['is_default' => false]);
        // 選択された住所をデフォルトに設定
        $address = Address::find($addressId);
        $address->is_default = true;
        $address->save();

        return redirect()->back()->with('success', '配送先が更新されました。');
    }

    public function create(Item $item)
    {
        return view('address', compact('item'));
    }
    public function store(Request $request)
    {
        Address::create([
            'user_id' => Auth::id(),
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building_name' => $request->building_name,
        ]);

        return redirect()->back()->with('success', '配送先住所が追加されました');
    }
}
