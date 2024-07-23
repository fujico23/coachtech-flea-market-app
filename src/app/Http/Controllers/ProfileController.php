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

        if ($request->hasFile('icon_image')) {
            $file = $request->file('icon_image');
            $fileName = 'icon_image.jpg';

            // 環境がproductionの場合はS3に保存、それ以外はローカルに保存
            if (config('app.env') === 'production') {
                $fullPath = 'icon_image/' . $user->id . '/' . $fileName;
                $disk = 's3';
            } else {
                $fullPath = 'public/icon_image/' . $user->id;
                $disk = 'local';
            }

            // ローカルに保存する場合の処理
            if ($disk === 'local') {
                if (!Storage::disk('local')->exists($fullPath)) {
                    Storage::disk('local')->makeDirectory($fullPath);
                }

                $tempPath = $file->storeAs('temp', $file->getClientOriginalName());
                $img = new Imagick(storage_path('app/' . $tempPath));
                $img->setImageFormat('jpg');

                $storagePathWithFileName = $fullPath . '/' . $fileName;
                Storage::disk('local')->put($storagePathWithFileName, $img->getImageBlob());
                $image_url = Storage::url($storagePathWithFileName);

                // 一時ファイルを削除
                Storage::delete($tempPath);
            } else {
                // S3に直接アップロード
                $img = new Imagick($file->getRealPath());
                $img->setImageFormat('jpg');
                $jpegData = $img->getImagesBlob();

                // 一時ファイルを作成
                $tempPath = tempnam(sys_get_temp_dir(), 'img');
                file_put_contents($tempPath, $jpegData);
                // 画像を直接S3に保存
                Storage::disk('s3')->putFile('images', new File($tempPath));
                $image_url = Storage::disk('s3')->url($fullPath);
                // 一時ファイルを削除
                unlink($tempPath);
            }

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
