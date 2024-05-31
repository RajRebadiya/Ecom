<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App\Models\user_order;
use App\Models\orderitem;

class CheckForTemporaryOrder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $orderId = Session::get('order_id');

        if ($orderId) {
            $order = user_order::find($orderId);

            if ($order && $order->status === 'temporary') {
                // Delete related order items
                $orderItems = orderitem::where('order_id', $orderId)->get();
                foreach ($orderItems as $orderItem) {
                    $orderItem->delete();
                }

                // Delete the order
                $order->delete();

                // Clear the order ID from session
                Session::forget('order_id');
            }
        }

        return $next($request);
    }
}
