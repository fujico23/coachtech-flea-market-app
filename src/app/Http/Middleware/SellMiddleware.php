<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SellMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $item = $request->route('item');
        $orders = $item->orders;

        foreach ($orders as $order) {
            if ($order->status == 2 || $order->status == 3) {
                return redirect()->route('detail', ['item' => $item->id])->with('error', 'アクセス出来ません');
            }
        }
        return $next($request);
    }
}
