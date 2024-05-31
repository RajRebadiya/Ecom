<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\coupon;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    //
    public function add_coupon(Request $request)
    {
        // Retrieve coupon data from the request
        $couponCode = $request->cname;

        // Find the coupon by code
        $coupon = coupon::where('code', $couponCode)->first();


        if ($coupon) {
            // If the coupon is found, store its details in the session
            session()->flash('coupon', [
                'name' => $coupon->code,
                'type' => $coupon->type,
                'amount' => $coupon->amount
            ]);
            return ['success' => 'Coupon added successfully', 'coupon' => $coupon->code, 'type' => $coupon->type, 'amount' => $coupon->amount];
        } else {
            return ['error' => 'Coupon not found'];
        }
    }

    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('coupon');
        // dd($couponCode);
        // print_r($couponCode);

        // Find the coupon by code
        $coupon = coupon::where('code', $couponCode)->first();


        if ($coupon) {
            // If the coupon is found, store its details in the session
            session()->flash('coupon', [
                'name' => $coupon->code,
                'type' => $coupon->type,
                'amount' => $coupon->amount
            ]);
            return ['success' => 'Coupon added successfully', 'coupon' => $coupon->code, 'type' => $coupon->type, 'amount' => $coupon->amount];
        } else {
            return ['error' => 'Coupon not found'];
        }
    }
}
