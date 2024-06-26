<?php

namespace App\Http\Controllers;

use App\Models\Order;
//use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Illuminate\Http\Request;
use Stripe\Webhook;
use Stripe\Stripe;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{

    public function handleWebhook(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.st_key'));
        Log::info('Stripe Webhook request: ' . json_encode($request->all()));
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
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }
        Log::info('Stripe Webhook event: ' . json_encode($event));

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $this->handleCheckoutSessionCompleted($event->data->object);
                break;
            case 'payment_intent.succeeded':
                $this->handlePaymentIntentSucceeded($event->data->object);
                break;
            case 'payment_intent.amount_capturable_updated':
                $this->handlePaymentIntentCapturableUpdated($event->data->object);
                break;
                // Add more cases to handle other event types as needed
            default:
                Log::warning('Unhandled event type: ' . $event->type);
                return response()->json(['error' => 'Unhandled event type'], 400);
        }

        return response()->json(['status' => 'success'], 200);
    }

    protected function handleCheckoutSessionCompleted($session)
    {
        Log::info('Checkout Session Completed: ' . json_encode($session));
        $order = Order::where('stripe_session_id', $session->id)->first();
        if ($order) {
            // 支払い方法のタイプをログ出力
            $paymentMethodType = $session->payment_method_types[0];
            Log::info('Payment Method Type: ' . $paymentMethodType);

            // 支払い方法に応じてステータスを設定
            if ($paymentMethodType === 'konbini' || $paymentMethodType === 'customer_balance') {
                $order->status = 2; // 2は「処理中」ステータスの仮定
                Log::info('Order status set to 2 for konbini or customer_balance');
            } else {
                $order->status = 3; // 3は「支払い完了」ステータスの仮定
                Log::info('Order status set to 3 for other payment methods');
            }
            $order->save();
        } else {
            Log::warning('Order not found for session: ' . $session->id);
        }
    }

    protected function handlePaymentIntentSucceeded($paymentIntent)
    {
        Log::info('Payment Intent Succeeded: ' . json_encode($paymentIntent));
        $order = Order::where('stripe_session_id', $paymentIntent->id)->first();
        if ($order) {
            // 支払い方法のタイプをログ出力
            $paymentMethodType = $paymentIntent->payment_method_types[0];
            Log::info('Payment Method Type: ' . $paymentMethodType);

            // 支払い方法に応じてステータスを設定
            if ($paymentMethodType === 'konbini' || $paymentMethodType === 'customer_balance') {
                $order->status = 2; // 2は「処理中」ステータスの仮定
                Log::info('Order status set to 2 for konbini or customer_balance');
            } else {
                $order->status = 3; // 3は「支払い完了」ステータスの仮定
                Log::info('Order status set to 3 for other payment methods');
            }
            $order->save();
        } else {
            Log::warning('Order not found for payment intent: ' . $paymentIntent->id);
        }
    }

    protected function handlePaymentIntentCapturableUpdated($paymentIntent)
    {
        Log::info('Payment Intent Capturable Updated: ' . json_encode($paymentIntent));
        $order = Order::where('stripe_session_id', $paymentIntent->id)->first();
        if ($order) {
            // 支払い方法のタイプをログ出力
            $paymentMethodType = $paymentIntent->payment_method_types[0];
            Log::info('Payment Method Type: ' . $paymentMethodType);

            // 支払い方法に応じてステータスを設定
            if ($paymentMethodType === 'konbini' || $paymentMethodType === 'customer_balance') {
                $order->status = 2; // 2は「処理中」ステータスの仮定
                Log::info('Order status set to 2 for konbini or customer_balance');
            } else {
                $order->status = 3; // 3は「支払い完了」ステータスの仮定
                Log::info('Order status set to 3 for other payment methods');
            }
            $order->save();
        } else {
            Log::warning('Order not found for payment intent: ' . $paymentIntent->id);
        }
    }
}
