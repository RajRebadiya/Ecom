<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\addtocart;
use App\Models\product;
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
            $addtocart->p_qty = $req->p_qty ? $req->p_qty : 1;
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
            ->select('addtocart.*', 'products.*', ) // Select columns from both tables
            ->get();
        // dd($cart);
        // store cart value in session
        session()->put('cart', $cart);

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

    public function updateCart(Request $request, $itemId)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'p_qty' => 'required|integer|min:1|max:100',
        ]);

        // Get the logged-in user
        $user = user_data::where('email', session('email'))->first();

        if (!$user) {
            return redirect('login')->with('error', 'Please login first');
        }

        $user_id = $user->id;

        // Find the cart item by user_id and product_id
        $cartItem = addtocart::where('user_id', $user_id)->where('product_id', $itemId)->first();

        if ($cartItem) {
            // Update the quantity
            $cartItem->p_qty = $request->p_qty;
            $cartItem->save();

            // Calculate the total price of the updated item using a join query
            $itemTotalPrice = DB::table('addtocart')
                ->join('products', 'addtocart.product_id', '=', 'products.id')
                ->where('addtocart.user_id', $user_id)
                ->where('addtocart.product_id', $itemId)
                ->select(DB::raw('addtocart.p_qty * products.price as itemTotalPrice'))
                ->first()
                ->itemTotalPrice;

            // Calculate the total price of all items in the cart for the user
            $totalPrice = DB::table('addtocart')
                ->join('products', 'addtocart.product_id', '=', 'products.id')
                ->where('addtocart.user_id', $user_id)
                ->select(DB::raw('SUM(addtocart.p_qty * products.price) as totalPrice'))
                ->first()
                ->totalPrice;

            // Return a JSON response indicating success
            return response()->json([
                'success' => true,
                'cart' => $cartItem,
                'itemTotalPrice' => $itemTotalPrice,
                'totalPrice' => $totalPrice
            ]);
        } else {
            // Handle the case where the cart item is not found
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found.'
            ]);
        }
    }
}
