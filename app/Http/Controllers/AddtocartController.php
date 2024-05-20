<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\addtocart;
use App\Models\user_data;
use App\Models\products;
use Illuminate\Support\Facades\DB;

class AddtocartController extends Controller
{
    //
    public function add_to_cart(Request $req)
    {
        // dd($req->all());
        $user = user_data::where('email', session('email'))->first();
        // dd($user);
        if (!$user) {
            return redirect()->back()->with('error', 'Please login first');
        } else {
            $user_id = $user->id;
            // Check if the product already exists in the cart for this user
            $existingCartItem = addtocart::where('user_id', $user_id)
                ->where('product_id', $req->product_id)
                ->first();

            // If the product already exists in the cart, return an error message
            if ($existingCartItem) {
                return redirect()->back()->with('error', 'Product is already in your cart');
            }
            $addtocart = new addtocart();
            $addtocart->product_id = $req->product_id;
            $addtocart->user_id = $user_id;
            $addtocart->save();
            return redirect()->back()->with('success', 'Product added to cart successfully');
        }
        // dd($user_id);




    }

    public function cart()
    {
        $user = user_data::where('email', session('email'))->first();
        if (!$user) {
            return redirect('login')->with('error', 'Please login first');
        }
        $cart = DB::table('addtocart')
            ->join('products', 'addtocart.product_id', '=', 'products.id')
            ->where('addtocart.user_id', $user->id)
            ->select('addtocart.*', 'products.*') // Select columns from both tables
            ->get();
        return view('add_to_cart', compact('cart'));
    }

    public function delete($id)
    {
        // dd($id);
        $delete = addtocart::where('product_id', $id)->delete();
        $user = user_data::where('email', session('email'))->first();
        if (!$user) {
            return redirect('login')->with('error', 'Please login first');
        }
        $cart = DB::table('addtocart')
            ->join('products', 'addtocart.product_id', '=', 'products.id')
            ->where('addtocart.user_id', $user->id)
            ->select('addtocart.*', 'products.*') // Select columns from both tables
            ->get();
        // return view('add_to_cart', compact('cart'));
        return redirect()->back()->with('success', 'Product deleted from cart successfully');
    }

    public function remove_all_cart()
    {
        $user = user_data::where('email', session('email'))->first();
        if (!$user) {
            return redirect('login')->with('error', 'Please login first');
        }
        $delete = addtocart::where('user_id', $user->id)->delete();
        return redirect()->back()->with('success', 'All products deleted from cart successfully');
    }
}
