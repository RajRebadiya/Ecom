<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\addtocart;
use App\Models\orderitem;
use App\Models\product;
use App\Models\user_order;
use Razorpay\Api\Api;


class OrderDetailController extends Controller
{
    //

    public function payment(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required',
            'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required|digits:6',
            'mobile' => 'required|digits:10',
            'total_amount' => 'required|numeric',
            'sub_total' => 'required|numeric',
            'discount' => 'required|numeric',
            'order_id' => 'required|numeric',
            'p_type' => 'required',
        ]);

        $order_detail = new OrderDetail();
        $order_detail->address = $request->address;
        $order_detail->mobile = $request->mobile;
        $order_detail->pincode = $request->pincode;
        $order_detail->fullname = $request->fullname;
        $order_detail->state = $request->state;
        $order_detail->city = $request->city;
        $order_detail->country = $request->country;
        $order_detail->user_id = $request->user_id;
        $order_detail->total_amount = $request->total_amount;
        $order_detail->sub_total = $request->sub_total;
        $order_detail->discount = $request->discount;
        $order_detail->order_id = $request->order_id;

        function generateUniqueInvoiceId()
        {
            do {
                $invoice_id = '#' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            } while (OrderDetail::where('invoice_id', $invoice_id)->exists());
            return $invoice_id;
        }

        $order_detail->invoice_id = generateUniqueInvoiceId();
        $order_detail->p_type = $request->p_type;
        $order_detail->save();

        if ($order_detail->p_type == 'COD') {
            $order_detail->p_status = 'success';
            $order_detail->update();

            $user_order = user_order::where('id', $request->order_id)->first();
            $user_order->status = "success";
            $user_order->update();

            $this->updateProductQuantities($request->order_id);

            AddToCart::where('user_id', $request->user_id)->delete();

            return redirect('home')->with('success', 'Payment successful.');
        } elseif ($order_detail->p_type == 'Razorpay') {
            $razorpay_key_id = env('RAZORPAY_KEY');
            $razorpay_key_secret = env('RAZORPAY_SECRET');

            $api = new Api($razorpay_key_id, $razorpay_key_secret);

            $orderData = [
                'amount' => $request->input('total_amount') * 100, // Amount in paisa
                'currency' => 'INR',
            ];

            $order = $api->order->create($orderData);

            return view('razorpay_payment', ['order' => $order, 'order_id' => $order_detail->order_id, 'user_id' => $request->user_id]);
        } else {
            return redirect('home')->with('error', 'Payment failed.');
        }
    }

    public function paymentSuccess(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|string',
            'order_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        $order = OrderDetail::where('order_id', $request->order_id)->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        $order->payment_id = $request->payment_id;
        $order->p_status = 'success';
        $order->save();

        $user_order = user_order::where('id', $request->order_id)->first();
        $user_order->status = "success";
        $user_order->save();

        $this->updateProductQuantities($request->order_id);

        AddToCart::where('user_id', $order->user_id)->delete();

        return response()->json(['success' => true]);
    }

    private function updateProductQuantities($order_id)
    {
        $orderItems = orderitem::where('order_id', $order_id)->get();
        // dd($orderItems);

        foreach ($orderItems as $orderItem) {
            $product = product::find($orderItem->product_id);
            // dd($product);

            if ($product) {
                $product->qty -= $orderItem->p_qty;
                $product->save();
            }
        }
    }
}
