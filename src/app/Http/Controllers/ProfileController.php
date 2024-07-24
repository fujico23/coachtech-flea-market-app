<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
            $fileName = 'icon_image.jpg';
            if (config('app.env') === 'production') {
                $disk = 's3';
                $path = 'icon_image/' . $user->id;
            } else {
                $disk = 'local';
                $path = 'public/icon_image/' . $user->id;
            }
            Storage::disk($disk)->putFileAs($path, $request->file('icon_image'), $fileName);
            $image_url = Storage::disk($disk)->url($path . '/' . $fileName);
            $profileData['icon_image'] = $image_url;
        }

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
