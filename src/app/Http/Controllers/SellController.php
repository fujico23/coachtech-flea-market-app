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
use Illuminate\Support\Facades\Log;

class SellController extends Controller
{
    public function edit()
    {
        $conditions = Condition::all();
        $colors = Color::all();
        $brands = Brand::all();
        $categories = Category::whereNull('parent_id')->get();
        return view('sell', compact('conditions', 'colors', 'brands', 'categories'));
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
            'category_id' => $request->category_id,
            'condition_id' => $request->condition_id,
        ]);

        // 画像を保存
        if ($request->hasFile('image_url')) {
            foreach ($request->file('image_url') as $file) {
                $path = $file->store('public/items/' . $item->id);
                $image_url = Storage::url($path);

                ItemImage::create([
                    'item_id' => $item->id,
                    'image_url' => $image_url,
                ]);
            }
        }

        return redirect()->back()->with('success', '商品が出品されました!');
    }
}
