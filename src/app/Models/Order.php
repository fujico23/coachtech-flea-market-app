<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 'user_id', 'status', 'pay_method', 'stripe_session_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //pay_methodカラムのカスタム
    protected $appends = ['custom_pay_method', 'fee'];
    public function getCustomPayMethodAttribute()
    {
        $PayMethod = [
            'card' => 'クレジットカード決済',
            'konbini' => 'コンビニ',
            'customer_balance' => '銀行振込',
        ];
        return $PayMethod[$this->attributes['pay_method']] ?? '不明な支払い方法';
    }
    //コンビニ・銀行振込の手数料計算
    public function getFeeAttribute()
    {
        $item = Item::find($this->attributes['item_id']);
        $price = $item->price;

        if (in_array($this->attributes['pay_method'], ['konbini', 'customer_balance'])) {
            if ($price <= 5000) {
                return 100;
            } elseif ($price <= 10000) {
                return 200;
            } elseif ($price <= 20000) {
                return 300;
            } elseif ($price <= 30000) {
                return 500;
            } elseif ($price <= 40000) {
                return 700;
            } else {
                return 880;
            }
        }
        return 0;
    }

    //ログインユーザーの全購入アイテムレコードの取得メソッド
    public static function getUserPurchasedItems()
    {
        return self::with('item.itemImages')
            ->where('user_id', Auth::id())
            ->where('status', 2)
            ->orWhere('status', 3)
            ->select('item_id', 'user_id', 'status', 'pay_method',)
            ->get();
    }
    //ログインユーザーの特定アイテムレコードの取得メソッド
    public static function orderUserItem($item)
    {
        return self::where('user_id', Auth::id())
            ->where('item_id', $item->id)
            ->first();
    }

    //ログインユーザーが特定アイテムに対して支払い方法を選択しているか確認するメソッド
    public static function orderPayMethod(Request $request, $user_id, $item_id)
    {
        $existingOrder = self::where('item_id', $item_id)->first();

        if ($existingOrder) {
            $existingOrder->update([
                'user_id' => $user_id,
                'pay_method' => $request->pay_method,
            ]);
            return $existingOrder;
        }

        $param = [
            'user_id' => $user_id,
            'item_id' => $item_id,
            'status' => 1,
            'pay_method' => $request->pay_method,
        ];
        $order = self::create($param);

        return $order;
    }
}
