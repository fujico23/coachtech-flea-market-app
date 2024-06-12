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
    /* 住所一覧を取得(自宅住所優先で取得する) */
    public function scopeUserAddresses($query)
    {
        return $query->where('user_id', Auth::id())
            ->orderByRaw("CASE WHEN type = '自宅' THEN 1 ELSE 2 END");
    }
}
