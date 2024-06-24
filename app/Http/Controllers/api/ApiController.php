<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\SendOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\user_data;
use App\Models\category;
use App\Models\product;
use App\Models\wishlist;
use App\Models\addtocart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

// use Hash;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    //
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'mobile' => 'required|min:10|max:10',
        ];

        // Validate the incoming request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode(' ', $errors);
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => $errorMessage,
            ]);
        }

        $user = new user_data();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->mobile = $request->mobile;
        $user->save();

        return response()->json([
            'code' => 200,
            'status' => 1,
            'message' => 'Registration successful',
            'data' => $user
        ]);
    }
    public function login(Request $request)
    {
        $rulse = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validation = Validator::make($request->all(), $rulse);

        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $errorMessage = implode(' ', $errors);
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => $errorMessage
            ]);
        }
        $user = user_data::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'Login successful',
                'data' => [
                    "id" => $user->id,
                    'name' => $user->name
                ]
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'Login failed'
            ]);
        }
    }


    public function forgetPassword(Request $request)
    {
        $rules = [
            'email' => 'required|email',
        ];
        $validation = validator::make($request->all(), $rules);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $errorMessage = implode(' ', $errors);
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => $errorMessage
            ]);
        }
        $user = user_data::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'User not found'
            ]);
        }
        $otp = random_int(1000, 9999);
        $num = 123;
        Cache::put('otp_' . $otp, $otp, now()->addMinutes(5));
        Cache::put('email_' . $num, $user->email, now()->addMinutes(120));

        $email_send = Mail::to($request->email)->send(new SendOtp($otp, $user));
        if ($email_send) {
            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'OTP send successfully',
                // 'data' => $otp
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'OTP send failed'
            ]);
        }
    }

    public function verifyPassword(Request $request)
    {
        $rules = [
            'otp' => 'required',
        ];
        $validation = validator::make($request->all(), $rules);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $errorMessage = implode(' ', $errors);
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => $errorMessage
            ]);
        }
        // dd(Cache::get('otp_' . $request->otp));

        if ($request->otp == Cache::get('otp_' . $request->otp)) {
            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'OTP verified successfully',
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'OTP verified failed'
            ]);
        }
    }

    public function NewPassword(Request $request)
    {
        $rules = [
            'password' => 'required|string',
            'cpassword' => 'required|string|same:password',
        ];
        $validation = validator::make($request->all(), $rules);
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            $errorMessage = implode(' ', $errors);
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => $errorMessage
            ]);
        }
        $num = 123;
        // dd(Cache::get('email_' . $num));
        $user = user_data::where('email', Cache::get('email_' . $num))->first();

        // dd($user);
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'code' => 200,
            'status' => 1,
            'message' => 'Password changed successfully',
        ]);
        // dd($user);

    }

    public function category()
    {
        $category = category::select('id', 'name', 'image')->get();
        return response()->json([
            'code' => 200,
            'status' => 1,
            'message' => 'Category List',
            'data' => $category
        ]);
    }

    public function NewArrival()
    {
        $product = product::select('id', 'name', 'image', 'price', 'sell_price')->latest()->get();
        return response()->json([
            'code' => 200,
            'status' => 1,
            'message' => 'New Arrival product',
            'data' => $product
        ]);
    }

    public function wishlist(Request $request)
    {
        $rules = [
            'user_id' => 'required',

        ];
        $vali = Validator::make($request->all(), $rules);
        if ($vali->fails()) {
            $errors = $vali->errors()->all();
            $errorMessage = implode(' ', $errors);
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => $errorMessage
            ]);
        }
        $wishlist = Wishlist::where('user_id', $request->user_id)
            ->join('products', 'wishlist.product_id', '=', 'products.id')
            ->select('products.id', 'products.name', 'products.image', 'products.price', 'products.sell_price')
            ->get();
        if ($wishlist->isEmpty()) {
            return response()->json([
                'code' => 200,
                'status' => 0,
                'message' => 'Wishlist not found',
                'data' => $wishlist
            ]);
        } else {
            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'Wishlist found',
                'data' => $wishlist
            ]);
        }

    }

    public function cart(Request $request)
    {
        $rules = [
            'user_id' => 'required',
        ];
        $vali = Validator::make($request->all(), $rules);
        if ($vali->fails()) {
            $errors = $vali->errors()->all();
            $errorMessage = implode(' ', $errors);
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => $errorMessage
            ]);
        }
        $cart = addtocart::where('user_id', $request->user_id)
            ->join('products', 'addtocart.product_id', '=', 'products.id')
            ->select('products.id', 'products.name', 'products.image', 'products.price', 'products.sell_price', 'addtocart.p_qty')
            ->get();
        if ($cart->isEmpty()) {
            return response()->json([
                'code' => 200,
                'status' => 0,
                'message' => 'Cart not found',
                'data' => $cart
            ]);
        } else {
            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'Cart found',
                'data' => $cart
            ]);
        }
    }

    public function SingleDeleteCart(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'product_id' => 'required',
        ];
        $vali = Validator::make($request->all(), $rules);
        if ($vali->fails()) {
            $errors = $vali->errors()->all();
            $errorMessage = implode(' ', $errors);
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => $errorMessage
            ]);
        }
        $cart = addtocart::where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->delete();
        if ($cart) {
            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'Cart deleted successfully',
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'Cart deleted failed',
            ]);
        }
    }

    public function RemoveAllCart(Request $request)
    {
        $rules = [
            'user_id' => 'required',
        ];
        $vali = Validator::make($request->all(), $rules);
        if ($vali->fails()) {
            $errors = $vali->errors()->all();
            $errorMessage = implode(' ', $errors);
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => $errorMessage
            ]);
        }
        $cart = addtocart::where('user_id', $request->user_id)
            ->delete();
        if ($cart) {
            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'Cart deleted successfully',
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'Cart deleted failed',
            ]);
        }
    }
}
