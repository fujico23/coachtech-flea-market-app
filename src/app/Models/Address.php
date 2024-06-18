<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'postal_code', 'address', 'building_name', 'type', 'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* 自宅の住所を取得するスコープ */
    public function scopeHomeAddress($query, $userId)
    {
        return $query->where('user_id', $userId)->where('type', '自宅');
    }
    /* 配送先の住所を取得するスコープ */
    public function scopeShippingAddress($query, $userId)
    {
        return $query->where('user_id', $userId)->where('type', 'その他');
    }
    /* 自宅住所優先で住所一覧を取得するスコープ */
    public function scopeUserAddresses($query)
    {
        return $query->where('user_id', Auth::id())
            ->orderByRaw("CASE WHEN type = '自宅' THEN 1 ELSE 2 END");
    }
    /* 郵便番号・住所・建物を改行付きで表示するアクセサ */
    public function getFullAddressAttribute()
    {
        $fullAddress = $this->postal_code .= '<br>' . $this->address;
        if ($this->building_name) {
            $fullAddress .= '<br>' . $this->building_name; // 改行タグを追加
        }
        return $fullAddress;
    }
    public function getPlainAddressAttribute()
    {
        $plainAddress = $this->address;
        return $plainAddress;
    }
}
