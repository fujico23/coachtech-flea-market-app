<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;


class PurchaseController extends Controller
{
    public function create(Item $item)
    {
        $shippingAddress = Address::where('user_id', Auth::id())
            ->where('is_default', true)
            ->first();

        $item->getDetailItem();
        $order = Order::orderUserItem($item);

        return view('purchase', compact('item', 'shippingAddress', 'order'));
    }

    public function selectPurchase(Item $item)
    {
        return view('purchase_list', compact('item'));
    }
    public function updatePaymentMethod(Request $request, Item $item)
    {
        Order::order($request, Auth::id(), $item->id);
        return redirect()->back()->with('success', '支払い方法が選択されました');
    }


    public function updatePaymentForm(Request $request, Item $item)
    {
        // Stripeキーの設定
        Stripe::setApiKey(config('services.stripe.st_key'));
        $totalAmount = intval(str_replace(['¥', ','], '', $request->total_amount));

        $pay_method = $request->pay_method;

        // ユーザーが既にStripeの顧客IDを持っていない場合、顧客を作成する
        $user = auth()->user();
        if (!$user->stripe_id) {
            $customer = \Stripe\Customer::create([
                'email' => $user->email,
                'name' => $user->name,
            ]);
            // 顧客IDをユーザーに保存
            $user->stripe_id = $customer->id;
            $user->save();
        }

        $checkoutSessionParams = [
            'customer' => $user->stripe_id,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $totalAmount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
        ];

        switch ($pay_method) {
            case 'クレジットカード決済':
                $checkoutSessionParams['payment_method_types'] = ['card'];
                break;
            case 'コンビニ':
                $checkoutSessionParams['payment_method_types'] = ['konbini'];
                break;
            case '銀行振込':
                $checkoutSessionParams['payment_method_types'] = ['customer_balance'];
                $checkoutSessionParams['payment_method_options'] = [
                    'customer_balance' => [
                        'funding_type' => 'bank_transfer',
                        'bank_transfer' => [
                            'type' => 'jp_bank_transfer'
                        ],
                    ],
                ];
                break;
            default:
                abort(400, 'Unsupported payment method');
        }
        $checkout_session = \Stripe\Checkout\Session::create($checkoutSessionParams);

        // 注文の作成または更新
        $order = Order::order($request, auth()->id(), $item->id);
        $order->stripe_session_id = $checkout_session->id;
        $order->save();

        return redirect($checkout_session->url);
    }

    public function paymentSuccess(Request $request)
    {
        $session_id = $request->input('session_id');
        dd($session_id);
        Stripe::setApiKey(config('services.stripe.st_key'));
        $session = Session::retrieve($session_id);


        if ($session->payment_status === 'paid') {
            Order::where('stripe_session_id', $session_id)->update(['status' => 3]);
        }

        // 支払い成功ページを表示する
        return view('success');
    }
}
