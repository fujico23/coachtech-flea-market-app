<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index(Item $item)
    {
        $addresses = Address::where('user_id', Auth::id())
            ->orderByRaw("CASE WHEN type = '自宅' THEN 1 ELSE 2 END")
            ->get();
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

    public function destroy(Address $address)
    {
        Address::where('id', $address->id)->delete();
        return redirect()->back()->with('success', '住所が削除されました。');
    }

    public function editList(Item $item)
    {
        $addresses = Address::where('user_id', Auth::id())
            ->orderByRaw("CASE WHEN type = '自宅' THEN 1 ELSE 2 END")
            ->get();
        return view('address_edit_index', compact('item', 'addresses'));
    }
    public function edit(Address $address)
    {
        return view('address_edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        $data = $request->only(['postal_code', 'address', 'building_name']);
        $address->update($data);

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
