<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user_data;
use App\Models\user_order;
// use Hash;
use Illuminate\Support\Facades\Hash;

class UserOrderController extends Controller
{
    //

    public function user_order(Request $request)
    {
        // dd($req->all());
        $user = user_data::where('email', session('email'))->first();
        if (!$user) {
            return redirect('login')->with('error', 'Please login first');
        }
        $cart = session()->get('cart', []);
        // dd($cart);

        if (!$cart || empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Create a new order
        $order = new user_order();
        $order->user_id = $user->id;
        $order->total_price = $request->input('final_total');
        $order->save();

        // Create order items
        foreach ($cart as $item) {
            $orderItem = new user_order();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product_id'];
            $orderItem->quantity = $item['qty'];
            $orderItem->price = $item['price'];
            $orderItem->total = $item['total'];
            $orderItem->save();
        }

        // Clear the cart session
        session()->forget('cart');

        return redirect()->route('order_success')->with('success', 'Order placed successfully.');
    }

}
