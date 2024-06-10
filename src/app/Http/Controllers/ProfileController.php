<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        $profileData = $request->only(['name', 'postal_code', 'address', 'building_name']);
        // 画像を保存
        if ($request->hasFile('icon_image')) {
            $file = $request->file('icon_image');
            $path = $file->store('public/icon_image/' . $user->id);
            $image_url = Storage::url($path);
            $profileData['icon_image'] = $image_url;
        }
        // ユーザーのプロフィール情報を更新
        $user->update($profileData);

        return redirect()->back()->with('success', 'プロフィールが更新されました');
    }
}
