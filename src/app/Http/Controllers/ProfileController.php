<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Imagick;

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
            $fileName = 'icon_image.jpg';
            $storagePath = 'public/icon_image/' . $user->id;

            // ディレクトリが存在しない場合は作成
            //S3では不要
            if (!Storage::disk('local')->exists($storagePath)) {
                Storage::disk('local')->makeDirectory($storagePath);
            }

            $tempPath = $file->storeAs('temp', $file->getClientOriginalName());
            $img = new Imagick(storage_path('app/' . $tempPath));
            $img->setImageFormat('jpg');

            $storagePathWithFileName = $storagePath . '/' . $fileName;
            Storage::disk('local')->put($storagePathWithFileName, $img->getImageBlob());
            // S3本番環境の場合
            ///Storage::disk('s3')->put($storagePathWithFileName, $img->getImageBlob());

            $image_url = Storage::url($storagePathWithFileName);

            $profileData['icon_image'] = $image_url;

            Storage::delete($tempPath);
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
