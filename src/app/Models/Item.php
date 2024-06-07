<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    use HasFactory;


    public static function getItems()
    {
        return self::all();
    }
    public function getDetailItem()
    {
        return $this->load(['brand', 'category', 'color', 'condition', 'favorites', 'comments.user']);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class, 'condition_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /* お気に入りメソッド */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    /* お気に入り登録している商品を処理する */
    public static function getFavoriteItems()
    {
        $items = Item::with('favorites', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();
        return $items;
    }
    /*　お気に入り登録している商品の数をカウントする　*/
    public static function favoriteCount()
    {
        return self::withCount('favorites')->get();
    }
    /* ログインユーザーがお気に入り登録しているかチェックする */
    public function isFavoriteByAuthUser()
    {
        if (!Auth::check()) {
            return false;
        }
        return $this->favorites->where('user_id', Auth::id())->isNotEmpty();
    }

    /* コメントメソッド */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /* コメントされている数をカウントする */
    public static function CommentCount()
    {
        return self::withCount('comments')->get();
    }
}
