<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\SendOtp;
use App\Models\orderdetail;
use App\Models\orderitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\user_data;
use App\Models\category;
use App\Models\product;
use App\Models\wishlist;
use App\Models\addtocart;
use App\Models\coupon;
use App\Models\delivery_address;
use App\Models\reviews;

use App\Models\user_order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
// use DB;
use Illuminate\Support\Facades\DB;

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

    public function ProductDetail(Request $request)
    {
        $rules = [
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
        $product = Product::find($request->product_id);
        $similar = Product::where('c_id', $product->c_id)
            ->whereNotIn('id', [$product->id])
            ->get();
        if ($product) {
            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'Product found',
                'product' => $product,
                'Similar' => $similar
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'Product not found',
            ]);
        }
    }

    public function SearchData(Request $request)
    {
        $rules = [
            'search' => 'required',
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

        $categories = category::where('name', 'like', '%' . $request->search . '%')->get();
        $products = Product::where('name', 'like', '%' . $request->search . '%')->get();
        $allData = [];

        foreach ($categories as $category) {
            $inside = product::where('c_id', $category->id)->get();
            $allData = array_merge($allData, $inside->toArray());
        }

        $allData = array_merge($allData, $products->toArray());

        if (count($allData) > 0) {
            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'Data found',
                'data' => $allData
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'Data not found',
            ]);
        }




    }

    public function SortFilter(Request $request)
    {

        $rules = [
            'type' => 'required',
            'sort_type' => 'nullable',
            'filter_type' => 'nullable',
            'color' => 'nullable',
            'size' => 'nullable',
            'min_price' => 'nullable',
            'max_price' => 'nullable',
            'c_id' => 'nullable'
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
        // dd($request->all());

        if ($request->type == 1) {
            if ($request->sort_type == 1) {
                $product = orderitem::join('products', 'products.id', '=', 'order_item.product_id')
                    ->select('products.id', 'products.name', 'products.image', 'products.price', 'products.sell_price', DB::raw('COUNT(order_item.product_id) as count'))
                    ->groupBy('products.id', 'products.name', 'products.image', 'products.price', 'products.sell_price')
                    ->orderBy('count', 'desc')
                    ->get();
                return response()->json([
                    'code' => 200,
                    'status' => 1,
                    'message' => 'Popular product found',
                    'data' => $product
                ]);
            } elseif ($request->sort_type == 2) {
                $product = product::all()->sortBy('price');
                return response()->json([
                    'code' => 200,
                    'status' => 1,
                    'message' => 'Low to high price found',
                    'data' => $product
                ]);
            } elseif ($request->sort_type == 3) {
                $product = product::all()->sortByDesc('price');
                return response()->json([
                    'code' => 200,
                    'status' => 1,
                    'message' => 'High to low price found',
                    'data' => $product
                ]);
            } elseif ($request->sort_type == 4) {
                $product = product::latest()->get();
                return response()->json([
                    'code' => 200,
                    'status' => 1,
                    'message' => 'Newest product found',
                    'data' => $product
                ]);
            } elseif ($request->sort_type == 5) {
                $product = product::all()->sortBy('created_at');
                return response()->json([
                    'code' => 200,
                    'status' => 1,
                    'message' => 'Oldest product found',
                    'data' => $product
                ]);
            }
        } elseif ($request->type == 2) {
            $product = product::query();
            if ($request->filter_type == 1) {
                $product->when($request->has('color'), function ($query) use ($request) {
                    $colors = is_array($request->color) ? $request->color : [$request->color];
                    $query->whereIn('color', $colors);
                });
                $product->when($request->has('size'), function ($query) use ($request) {
                    $sizes = is_array($request->size) ? $request->size : [$request->size];
                    $query->whereIn('size', $sizes);
                });
                $product->when($request->has('c_id'), function ($query) use ($request) {
                    $c_ids = is_array($request->c_id) ? $request->c_id : [$request->c_id];
                    $query->whereIn('c_id', $c_ids);
                });
                $product->when($request->has('min_price') && $request->has('max_price'), function ($query) use ($request) {
                    $query->whereBetween('price', [$request->min_price, $request->max_price]);
                });
            }


            $product = $product->get();

            return response()->json([
                'code' => 200,
                'tatus' => 1,
                'essage' => 'Filtered products found',
                'data' => $product
            ]);
        }
    }

    public function EditProfile(Request $request)
    {

        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|nullable',
            'mobile' => 'required|min:10|max:10',
            'city' => 'required|string',
            'user_id' => 'required'
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
        $user = user_data::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->city = $request->city;
        $user->save();
        return response()->json([
            'code' => 200,
            'status' => 1,
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }

    public function OrderHistory(Request $request)
    {

        $rules = [
            'user_id' => 'required'
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
        $order = DB::table('order_detail')
            ->join('order_item', 'order_detail.order_id', '=', 'order_item.order_id')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->where('order_detail.user_id', $request->user_id)
            ->select('products.image', 'order_detail.*')
            ->distinct()
            ->get();
        return response()->json([
            'code' => 200,
            'status' => 1,
            'message' => 'Order history found',
            'data' => $order
        ]);
    }

    public function SingleOrderHistory(Request $request)
    {

        $rules = [
            'order_id' => 'required',
            'user_id' => 'required'
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
        $order = DB::table('order_detail')
            ->join('order_item', 'order_detail.order_id', '=', 'order_item.order_id')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->where('order_detail.id', $request->order_id)
            ->where('order_detail.user_id', $request->user_id)
            ->select('products.image', 'order_detail.*')
            ->distinct()
            ->get();

        if ($order->isEmpty()) {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'Order not found'
            ]);
        } else {

            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'Order history found',
                'data' => $order
            ]);
        }
    }

    public function Coupon()
    {

        $coupon = coupon::all();
        return response()->json([
            'code' => 200,
            'status' => 1,
            'message' => 'Coupon found',
            'data' => $coupon
        ]);
    }

    public function Review(Request $request)
    {

        $rules = [

            'product_id' => 'required',
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
        $review = reviews::where('p_id', $request->product_id)
            ->where('user_id', $request->user_id)
            ->get();
        if ($review->isEmpty()) {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'Reviews not found'
            ]);
        } else {

            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'Reviews found',
                'data' => $review
            ]);

        }
    }

    public function SaveAddress(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'fullname' => 'required',
            'mobile' => 'required',
            'pincode' => 'required|min:6|max:6',
            'address' => 'required',
            'town' => 'required',
            'city' => 'required',
            'state' => 'required',
            'save_as' => 'required',
        ];
        $vali = Validator::make($request->all(), $rules);
        if ($vali->fails()) {
            $errors = $vali->errors()->all();
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => $errors
            ]);
        }

        $address = new delivery_address();

        $address->user_id = $request->user_id;
        $address->fullname = $request->fullname;
        $address->mobile = $request->mobile;
        $address->pincode = $request->pincode;
        $address->address = $request->address;
        $address->town = $request->town;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->save_as = $request->save_as;
        $address->save();

        if ($address) {
            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'Address saved successfully'
            ]);
        } else {

            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'Address not saved successfully'
            ]);
        }




    }

    public function AddReview(Request $request)
    {
        $rules = [

            'user_id' => 'required',
            'p_id' => 'required',
            'title' => 'required',
            'detail' => 'required',
            'rating' => 'required',
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

        $review = new reviews();
        $review->user_id = $request->user_id;
        $review->p_id = $request->p_id;
        $review->user_name = 'Guest';
        $review->title = $request->title;
        $review->detail = $request->detail;
        $review->rating = $request->rating;
        $review->save();
        if ($review) {
            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'Review added successfully'
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'Review not added successfully'
            ]);
        }
    }

    public function SaveAddressList()
    {
        $address = delivery_address::all();
        return response()->json([
            'code' => 200,
            'status' => 1,
            'message' => 'Address found',
            'data' => $address
        ]);
    }

    public function Checkout(Request $request)
    {
        $rules = [

            'user_id' => 'required',
            'fullname' => 'required',
            'mobile' => 'required',
            'pincode' => 'required|min:6|max:6',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'final_total' => 'required',
            'main_total' => 'required',
            'discount' => 'required',
            'product_json' => 'required',
            'p_type' => 'required'

        ];
        $vali = Validator::make($request->all(), $rules);
        if ($vali->fails()) {
            $errors = $vali->errors()->all();
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => $errors
            ]);
        }

        $user_order = new user_order();

        $user_order->user_id = $request->user_id;
        $user_order->final_total = $request->final_total;
        $user_order->main_total = $request->main_total;
        $user_order->discount = $request->discount;
        $user_order->status = 'pending';

        $user_order->save();

        $product_json = json_decode($request->product_json);
        // dd($product_json);

        foreach ($product_json as $item) {
            $order_item = new orderitem();
            $order_item->order_id = $user_order->id;
            $order_item->product_id = $item->product_id;
            $order_item->name = $item->name;
            $order_item->price = $item->price;
            $order_item->p_qty = $item->p_qty;
            $order_item->total = $item->price * $item->p_qty;
            $order_item->save();
        }
        // dd($order_item);
        $p_type = $request->p_type;
        $order_detail = new orderdetail();
        $order_detail->order_id = $user_order->id;
        $order_detail->invoice_id = $user_order->id;
        function generateUniqueInvoiceId()
        {
            do {
                $invoice_id = '#' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            } while (OrderDetail::where('invoice_id', $invoice_id)->exists());
            return $invoice_id;
        }

        $order_detail->invoice_id = generateUniqueInvoiceId();
        $order_detail->total_amount = $request->final_total;
        $order_detail->sub_total = $request->main_total;
        $order_detail->discount = $request->discount;
        $order_detail->p_type = $request->p_type;
        $order_detail->p_status = 'pending';
        $order_detail->payment_id = 'NULL';
        $order_detail->order_date = date('Y-m-d');
        $order_detail->user_id = $request->user_id;
        $order_detail->order_status = 'processing';
        $order_detail->fullname = $request->fullname;
        $order_detail->mobile = $request->mobile;
        $order_detail->pincode = $request->pincode;
        $order_detail->address = $request->address;
        $order_detail->city = $request->city;
        $order_detail->state = $request->state;
        $order_detail->country = $request->country;
        $order_detail->save();
        if ($p_type == 'cod') {
            $order_detail->p_status = 'success';
            $order_detail->payment_id = 'NULL';
            $order_detail->update();
            $user_order = user_order::where('id', $user_order->id)->first();
            // dd($user_order);
            $user_order->status = "success";
            $user_order->update();

            $this->updateProductQuantities($user_order->id);

            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'Order placed successfully'
            ]);
        }
        if ($p_type == 'razorpay') {
            return response()->json([
                'code' => 200,
                'status' => 1,
                'message' => 'Order Placed Successfully.',
                'data' => $order_detail->invoice_id
            ]);




        }


    }

    public function CheckoutPayment(Request $request)
    {
        $rules = [
            'order_id' => 'required',
            'payment_id' => 'required',
            'p_status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => $errors
            ]);
        }
        // dd($request->all());
        $order_detail = orderdetail::where('invoice_id', $request->order_id)->first();
        // dd($order_detail);
        $order_detail->payment_id = $request->payment_id;
        $order_detail->p_status = $request->p_status;
        $order_detail->update();
        $user_order = user_order::where('id', $order_detail->order_id)->first();
        // dd($user_order);
        $user_order->status = "success";
        $user_order->update();

        $this->updateProductQuantities($user_order->id);
        return response()->json([
            'code' => 200,
            'status' => 1,
            'message' => 'Payment Updated Successfully'
        ]);

    }

    public function updateProductQuantities($order_id)
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
