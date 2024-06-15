<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'item_id'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function itemImages()
    {
        return $this->hasManyThrough(ItemImage::class, Item::class, 'id', 'item_id', 'item_id', 'id');
    }

    public static function favorite($user_id, $item_id)
    {
        $existingFavorite = Favorite::where('user_id', $user_id)->where('item_id', $item_id)->first();

        if ($existingFavorite) {
            return $existingFavorite;
        }
        $param = [
            'user_id' => $user_id,
            'item_id' => $item_id,
        ];
        $favorite = Favorite::create($param);

        return $favorite;
    }
}
