<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $homeAddress = Address::where('user_id', $user->id)->where('type', '自宅')->first();
        return view('profile', compact('user', 'homeAddress'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        $profileData = $request->only(['name']);

        // 画像を保存
        if ($request->hasFile('icon_image')) {
            $file = $request->file('icon_image');
            $path = $file->store('public/icon_image/' . $user->id);
            $image_url = Storage::url($path);
            $profileData['icon_image'] = $image_url;
        }

        // ユーザーのプロフィール情報を更新
        $user->update($profileData);

        $addressData = $request->only(['postal_code', 'address', 'building_name', 'type']);

        // 自宅の住所データがあれば更新、なければ新規作成
        if ($homeAddress = $user->addresses()->where('type', '自宅')->first()) {
            $homeAddress->update($addressData);
        } else {
            $user->addresses()->create($addressData);
        }

        return redirect()->back()->with('success', 'プロフィールが更新されました');
    }
}
