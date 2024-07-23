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

        if ($request->hasFile('image_url')) {
            foreach ($request->file('image_url') as $file) {
                $path = $file->store('public/items/' . $item->id);
                $image_url = Storage::url($path);
                $filename = uniqid() . '.jpg';

                if (config("app.env") === "production") {
                    $storagePath = 'items/' . $item->id . '/' . $filename;
                } else {
                    $storagePath = 'public/items/' . $item->id;
                }
                //開発環境
                //$storagePath = 'public/items/' . $item->id;
                //S3本番環境の場合
                //$storagePath = 'items/' . $item->id . '/' . $filename;

                //S3では不要
                if (config("app.env") === "production") {
                } else {
                    if (!Storage::disk('local')->exists($storagePath)) {
                        Storage::disk('local')->makeDirectory($storagePath);
                    }
                }
                //if (!Storage::disk('local')->exists($storagePath)) {
                //    Storage::disk('local')->makeDirectory($storagePath);
                //}
                // 画像をjpgに変換
                $img = new Imagick($file->getRealPath());
                $img->setImageFormat('jpg');
                if (config("app.env") === "production") {
                    $fullPath = storage_path('app/temp/' . $filename);
                } else {
                    $fullPath = storage_path('app/' . $storagePath . '/' . $filename);
                }
                //開発環境
                //$fullPath = storage_path('app/' . $storagePath . '/' . $filename);
                // S3本番環境の場合
                // $fullPath = storage_path('app/temp/' . $filename);
                $img->writeImage($fullPath);

                if (config("app.env") === "production") {
                    Storage::disk('s3')->put($storagePath, file_get_contents($fullPath), 'public');
                    unlink($fullPath);
                }
                //S3本番環境の場合
                // Storage::disk('s3')->put($storagePath, file_get_contents($fullPath), 'public');
                //unlink($fullPath);

                if (config("app.env") === "production") {
                    $image_url = Storage::disk('s3')->url($storagePath);
                } else {
                    $image_url = Storage::url($storagePath . '/' . $filename);
                }
                // 開発環境
                //$image_url = Storage::url($storagePath . '/' . $filename);
                // S3本番環境の場合
                //$image_url = Storage::disk('s3')->url($storagePath);

                ItemImage::create([
                    'item_id' => $item->id,
                    'image_url' => $image_url,
                ]);
            }
        }
        return redirect()->back()->with('success', '商品が出品されました!');
    }
}
