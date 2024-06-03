<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\addtocart;
use Razorpay\Api\Api;


class OrderDetailController extends Controller
{
    //

    public function payment(Request $request)
    {
        // dd($request->all()); 
        $validatedData = $request->validate([
            'fullname' => 'required|max:255',
            'country' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'pincode' => 'required|max:255',
            'mobile' => 'required|max:255',
            'email' => 'required|email|max:255',
            'total_amount' => 'required|numeric',
            'sub_total' => 'required|numeric',
            'discount' => 'required|numeric',
            'order_id' => 'required|numeric',
            'p_type' => 'required|max:255',
        ]);



        $order_detail = new orderdetail();
        $order_detail->address = $request->address;
        $order_detail->mobile = $request->mobile;
        $order_detail->pincode = $request->pincode;
        $order_detail->fullname = $request->fullname;
        $order_detail->user_id = $request->user_id;
        $order_detail->total_amount = $request->total_amount;
        $order_detail->sub_total = $request->sub_total;
        $order_detail->discount = $request->discount;
        $order_detail->order_id = $request->order_id;
        // Function to generate a unique invoice ID
        function generateUniqueInvoiceId()
        {
            do {
                $invoice_id = '#' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            } while (orderdetail::where('invoice_id', $invoice_id)->exists());
            return $invoice_id;
        }

        $order_detail->invoice_id = generateUniqueInvoiceId();
        $order_detail->p_type = $request->p_type;
        $order_detail->save();

        if ($order_detail->p_type == 'COD') {
            $order_detail->p_status = 'success';

            $order_detail->update();

            $lata = addtocart::where('user_id', $request->user_id)->delete();


            return redirect('home')->with('success', 'Payment successfull.');
        } elseif ($order_detail->p_type == 'Razorpay') {
            // return redirect('razorpay-payment')->with(['data' => $order_detail]);
            // Check if Razorpay payment option is selected

            $razorpay_key_id = env('RAZORPAY_KEY');
            // dd($razorpay_key_id);
            $razorpay_key_secret = env('RAZORPAY_SECRET');

            $api = new Api($razorpay_key_id, $razorpay_key_secret);
            // dd($api);

            $orderData = [
                'amount' => $request->input('total_amount') * 100, // Amount in paisa
                'currency' => 'INR',

                // Add other order details as needed
            ];
            // dd($orderData);

            // Create Razorpay order
            $order = $api->order->create($orderData);

            // dd($order);

            // Redirect user to Razorpay payment page
            return view('razorpay_payment', ['order' => $order]);
        } else {
            return redirect('home')->with('error', 'Payment failed.');
        }
    }
}
