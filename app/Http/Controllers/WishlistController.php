<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\wishlist;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Models\category;
use App\Models\user_data;

class WishlistController extends Controller
{
    //      
    public function add_to_wishlist(Request $req)
    {

        $user =  user_data::where('email', session()->get('email'))->first();
        // dd($user);

        if (!$user) {
            return redirect()->back()->with(['error' => 'Please login first.']);
        }
        $user_id = $user->id;
        // dd($user_id);

        $req->validate([
            'user_id' => 'required|exists:users,email',
            'product_id' => 'required|exists:products,id',
        ]);

        $existingWishlistItem = wishlist::where('user_id', $user_id)
            ->where('product_id', $req->product_id)
            ->first();

        if ($existingWishlistItem) {
            $existingWishlistItem->delete();
            return redirect()->back()->with(['success' => 'Product removed from wishlist.']);
        }


        $wishlist = new wishlist();
        $wishlist->user_id = $user_id;
        $wishlist->product_id = $req->product_id;
        $wishlist->save();
        return redirect()->back()->with(['success' => 'Product added to wishlist.']);
    }

    public function wishlist()
    {
        // Store the intended URL in the session
        session(['intended_url' => 'wishlist']);

        // Check if the user is logged in
        if (!session()->has('email')) {
            return redirect('login')->with(['error' => 'Please login first.']);
        }
        $user =  user_data::where('email', session()->get('email'))->first();
        $user_id = $user->id;

        $wishlist = DB::table('wishlist')
            ->join('products', 'wishlist.product_id', '=', 'products.id')
            ->select('products.*', 'wishlist.user_id') // Select all columns from products and user_id from wishlist
            ->where('wishlist.user_id', '=', $user_id) // Filter by user_id
            ->get();
        return view('wishlist', compact('wishlist'));

        // return view('wishlist');
    }
    public function remove_all_wishlist()
    {
        $user =  user_data::where('email', session()->get('email'))->first();
        $user_id = $user->id;
        $remove_all = wishlist::where('user_id', $user_id)->delete();
        return redirect()->back()->with(['success' => 'All products removed from wishlist.']);
    }
}
