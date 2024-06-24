<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Illuminate\Http\Request;
use Stripe\Webhook;
use Stripe\Stripe;

class WebhookController extends CashierController
{

    public function handleWebhook(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.st_key'));
        $payload = @file_get_contents('php://input');
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook.secret');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $this->handleCheckoutSessionCompleted($session);
                break;
                // 他のイベントも必要に応じて追加
            default:
                return response()->json(['message' => 'Event not handled'], 200);
        }

        return response()->json(['message' => 'Success'], 200);
    }

    protected function handleCheckoutSessionCompleted($session)
    {
        $order = Order::where('stripe_session_id', $session->id)->first();

        if ($order) {
            if ($session->payment_method_types[0] === 'card') {
                $order->pay_method = 3;
                $order->status = 3;
            } else {
                $order->pay_method = 2;
                $order->status = 2;

                if ($session->payment_method_types[0] === 'konbini') {
                    $order->customer_number = $session->payment_intent->charges->data[0]->payment_method_details->konbini->reference_number;
                } elseif ($session->payment_method_types[0] === 'customer_balance') {
                    // 銀行振り込みの詳細を取得
                    $order->customer_number = $session->payment_intent->charges->data[0]->payment_method_details->customer_balance->bank_transfer->bank_name;
                }
            }
            $order->save();
        }
    }

    protected function handlePaymentIntentSucceeded($paymentIntent)
    {
        // 支払い成功時の処理
        // 例: 注文のステータスを更新するなど
    }

    protected function handlePaymentIntentFailed($paymentIntent)
    {
        // 支払い失敗時の処理
        // 例: 注文のステータスを更新するなど
    }
}
