<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\product;
use App\Models\orderitem;
use App\Models\user_data;
use Illuminate\Support\Facades\DB;

class OrderHistoryController extends Controller
{
    //

    public function show_order()
    {
        $user = user_data::where('email', session('email'))->first();
        $user_id = $user->id;
        $data = DB::table('order_detail')
            ->join('order_item', 'order_detail.order_id', '=', 'order_item.order_id')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->where('order_detail.user_id', $user_id)
            ->select('products.image', 'order_detail.*')
            ->distinct()
            ->get();
        return view('orders', ['data' => $data]);
    }

    public function full_order(Request $req)
    {
        // dd($req->all());
        $user = user_data::where('email', session('email'))->first();
        $user_id = $user->id;
        // dd($user_id);
        $data = orderdetail::where('order_id', $req->order_id)->where('user_id', $user_id)->first();
        // dd($data);
        $order_item = DB::table('order_item')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->where('order_item.order_id', $req->order_id)
            ->select('products.*', 'order_item.*')
            ->get();
        // dd($order_item);
        $product_id = $order_item->pluck('id');
        // dd($product_id);

        // $product = product::whereIn('id', $product_id)->get();
        // dd($product);
        return view('full_order', ['data' => $data, 'order_item' => $order_item, 'product_id' => $product_id]);
    }
}
