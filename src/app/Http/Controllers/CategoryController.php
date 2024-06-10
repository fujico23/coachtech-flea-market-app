<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getSubCategories($parentId)
    {
        $subCategories = Category::where('parent_id', $parentId)->get();
        return response()->json($subCategories);
    }
    /*    public function selectParent()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('categories.parent_select', compact('categories'));
    }

    public function selectChild($parentId)
    {
        $categories = Category::where('parent_id', $parentId)->get();
        return view('categories.child_select', compact('categories', 'parentId'));
    }

    public function selectGrandchild($childId)
    {
        $categories = Category::where('parent_id', $childId)->get();
        $childCategory = Category::find($childId);
        $parentId = $childCategory ? $childCategory->parent_id : null;  // 親カテゴリーIDを取得
        return view('categories.grandchild_select', compact('categories', 'childId', 'parentId'));
    }
        */
}
