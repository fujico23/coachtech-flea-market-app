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
        'item_id', 'user_id', 'status', 'pay_method', 'stripe_session_id', 'customer_number'
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

    //注文済みアイテムの取得
    public static function getOrderForItem($item)
    {
        return self::where('item_id', $item->id)
            ->where('status', 1)
            ->first();
    }

    //ログインユーザーの購入アイテムレコードの取得メソッド
    public static function getUserPurchasedItems()
    {
        return self::where('user_id', Auth::id())
            ->where('status', 1)
            ->select('item_id', 'user_id', 'status', 'pay_method')
            ->get();
    }
    //ログインユーザーの特定アイテムレコードの取得メソッド
    public static function orderUserItem($item)
    {
        return self::where('user_id', Auth::id())
            ->where('item_id', $item->id)
            ->first();
    }

    //ログインユーザーの特定アイテムに対するレコードが存在するか確認するメソッド
    public static function order(Request $request, $user_id, $item_id)
    {
        $existingOrder = self::where('user_id', $user_id)->where('item_id', $item_id)->first();

        if ($existingOrder) {
            $existingOrder->update([
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
