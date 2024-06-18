<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'item_id', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    /* 新着順のコメント取得 */
    public function scopeUserComment($query, $userId)
    {
        return $query->where('user_id', $userId)->orderBy('created_at', 'desc');
    }
}
