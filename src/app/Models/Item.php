<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;


    public static function getItems()
    {
        return self::all();
    }
    public function getDetailItem()
    {
        return $this->load(['brand', 'category', 'color', 'condition']);
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
}
