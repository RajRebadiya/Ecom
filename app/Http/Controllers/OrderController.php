<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user_order;
use App\Models\orderitem;
use App\Models\user_data;

class OrderController extends Controller
{
    //
    public function placeOrder(Request $request)
    {
        // dd($request->all());
        $user = user_data::where('email', session('email'))->first();
        if (!$user) {
            return redirect('login')->with('error', 'Please login first');
        }

        $cart = session()->get('cart', []);

        if (!$cart || empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Create a new order
        $order = new user_order();
        $order->user_id = $user->id;
        $order->final_total = $request->input('final_total');
        $order->main_total = $request->input('main_total');
        $order->discount = $request->input('discount');
        // Mark the order as temporary
        $order->status = 'temporary'; // Add this line
        $order->save();

        // Create order items
        foreach ($cart as $item) {
            $orderItem = new orderitem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->name = $item->name;
            $orderItem->qty = $item->p_qty;
            $orderItem->price = $item->price;
            $orderItem->total = $item->price * $item->p_qty;

            $orderItem->save();
            // dd($orderItem);
        }

        // Clear the cart session
        session()->forget('cart');

        // Store the order ID in session
        session()->put('order_id', $order->id);

        // Redirect to the checkout page
        return redirect()->route('checkout');
    }

    public function checkout()
    {
        // Retrieve the order ID from session
        $orderId = session('order_id');
        // dd($orderId);

        if (!$orderId) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        $order = user_order::find($orderId);
        // dd($order);

        // Check if the order is temporary
        if ($order && $order->status === 'temporary') {

            return view('checkout', compact('order'));
        } else {
            // Delete the related order items first
            $orderItems = orderitem::where('order_id', $orderId)->get();
            // dd($orderItems);
            foreach ($orderItems as $orderItem) {
                $orderItem->delete();
            }

            // Delete the order
            $order->delete();

            // Clear the order ID from session
            session()->forget('order_id');

            // return redirect()->back()->with('error', 'Order abandoned.');
        }

        // Pass the order data to the checkout view
        return redirect()->back()->with('error', 'Order not found.');
    }

    // OrderController.php
    public function deleteTemporaryOrder()
    {
        $orderId = session('order_id');

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
                session()->forget('order_id');
            }
        }

        return response()->json(['status' => 'success']);
    }
}
