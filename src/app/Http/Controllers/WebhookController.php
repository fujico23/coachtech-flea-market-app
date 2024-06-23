<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Illuminate\Http\Request;
use Stripe\Webhook;

class WebhookController extends CashierController
{
    public function handleCustomerUpdated($payload)
    {
    }
    public function handleWebhook(Request $request)
    {
        $payload = @file_get_contents('php://input');
        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $webhookSecret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $webhookSecret
            );
        } catch (\Exception $e) {
            return response('Invalid payload', 400);
        }

        // 受信したイベントを処理する
        switch ($event->type) {
            case 'checkout.session.completed':
                $checkoutSession = $event->data->object;
                $reservationId = $checkoutSession->metadata->reservation_id;
                $this->handleCheckoutSessionCompleted($reservationId);
                break;
                // ...
            default:
                // 未処理のイベントタイプの場合は無視
                break;
        }

        return response('Webhook handled', 200);
    }
    private function handleCheckoutSessionCompleted($reservationId)
    {
        // reservationsテーブルのpayment_statusを更新する処理をここに書く
        $order = Order::findOrFail($reservationId);
        $order->payment_status = 'paid';
        $order->save();
    }
}
