<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'brand_id', 'price', 'description', 'color_id', 'condition_id', 'category_id'];


    public static function getItems()
    {
        return self::query()
            ->leftJoin('orders', 'items.id', '=', 'orders.item_id')
            ->select('items.*', DB::raw('orders.item_id IS NULL as no_order'))
            ->orderBy('no_order', 'desc')
            ->orderBy('items.created_at', 'desc')
            ->get();
    }

    public function getDetailItem()
    {
        return $this
            ->load([
                'user',
                'brand',
                'category',
                'color',
                'condition',
                'favorites',
                'itemImages',
                'comments.user',
                'orders',
            ]);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /* ログインユーザーの出品商品一覧取得 */
    public static function getItemByUserId($userId)
    {
        return self::where('user_id', $userId)->with('itemImages')->orderBy('created_at', 'desc')->get();
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
    public function itemImages()
    {
        return $this->hasMany(ItemImage::class, 'item_id');
    }

    /* 注文メソッド */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    /* 全ユーザーの注文アイテム */
    public function orderItems()
    {
        return Order::where('item_id', $this->id)->get();
    }
    /* 購入するボタン切り替えorders status判別用メソッド */
    public function getOrderStatus($status)
    {
        return $this->orderItems()->where('status', $status)->isNotEmpty();
    }

    /* ordersテーブルのstatusが2か3の時SOLD OUTを表示させるメソッド */
    public function isSoldOut()
    {
        foreach ($this->orders as $order) {
            if (in_array($order->status, [2, 3]))
                return true;
        }
        return false;
    }

    /* お気に入りメソッド */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
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

    /* 検索機能 */
    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('items.name', 'like', '%' . $keyword . '%')
                    ->orWhereHas('category', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('brand', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    });
            });
        }
    }
}
