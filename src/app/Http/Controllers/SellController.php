<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SellRequest;
use App\Models\Item;
use App\Models\Condition;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ItemImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Imagick;


class SellController extends Controller
{
    public function show(User $user)
    {
        $items = Item::getItemByUserId($user->id);
        return view('mypage', compact('items', 'user'));
    }
    public function edit()
    {
        $conditions = Condition::all();
        $colors = Color::all();
        $brands = Brand::all();
        $categories = Category::whereNull('parent_id')->get();
        $childCategories = Category::whereNotNull('parent_id')->get();
        $grandchildCategories = Category::whereNotNull('parent_id')->get();
        return view('sell', compact('conditions', 'colors', 'brands', 'categories', 'childCategories', 'grandchildCategories'));
    }

    public function store(SellRequest $request)
    {
        $item = Item::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'price' => $request->price,
            'description' => $request->description,
            'color_id' => $request->color_id,
            'category_id' => $request->grandchild_category_id,
            'condition_id' => $request->condition_id,
        ]);

        // 画像を保存
        if ($request->hasFile('image_url')) {
            foreach ($request->file('image_url') as $file) {
                $filename = uniqid() . '.jpg';

                // 環境がproductionの場合はS3に保存、それ以外はローカルに保存
                if (config('app.env') === 'production') {
                    $path = 'items/' . $item->id . '/' . $filename;
                    $disk = 's3';
                } else {
                    $path = 'public/items/' . $item->id . '/' . $filename;
                    $disk = 'local';
                }

                // 画像をjpgに変換
                $img = new Imagick($file->getRealPath());
                $img->setImageFormat('jpg');

                // ローカルに保存する場合の処理
                if ($disk === 'local') {
                    $tempPath = storage_path('app/temp/' . $filename);

                    if (!Storage::disk('local')->exists(dirname($tempPath))) {
                        Storage::disk('local')->makeDirectory(dirname($tempPath));
                    }

                    $img->writeImage($tempPath);

                    // ローカルにアップロード
                    Storage::disk('local')->put($path, file_get_contents($tempPath));

                    // 一時ファイルを削除
                    Storage::disk('local')->delete($tempPath);
                } else {
                    // S3に直接アップロード
                    $imageData = $img->getImagesBlob();
                    Storage::disk('s3')->put($path, $imageData, 'public');
                }

                // URLを取得
                $image_url = Storage::disk($disk)->url($path);

                ItemImage::create([
                    'item_id' => $item->id,
                    'image_url' => $image_url,
                ]);
            }
        }
        return redirect()->back()->with('success', '商品が出品されました!');
    }
}
