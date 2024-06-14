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
}
