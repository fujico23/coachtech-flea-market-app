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

        $customer = \Stripe\Customer::create([
            'email' => $request->user()->email,
        ]);

        $checkoutSessionParams = [
            'customer' => $customer->id,
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
            'success_url' => route('purchase', compact('item')), // 成功時のリダイレクトURL
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
        $checkout_session = Session::create($checkoutSessionParams);

        return redirect($checkout_session->url);
    }
}
