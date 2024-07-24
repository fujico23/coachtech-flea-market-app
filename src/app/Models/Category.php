<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    //自己参照のリレーションを定義
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    //自己参照のリレーションでサブカテゴリーを取得
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    //自己参照のリレーションで更にカテゴリーを取得
    public function grandchildren()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->with('children');
    }

    public function getFullCategory()
    {
        $categoryNames = [];
        $category = $this;
        while ($category) {
            $categoryNames[] = $category->name;
            $category = $category->parent;
        }
        return implode('>', array_reverse($categoryNames));
    }
}
