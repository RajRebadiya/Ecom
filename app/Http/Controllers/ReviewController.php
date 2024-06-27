<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reviews;

class ReviewController extends Controller
{
    //
    public function index()
    {
        $reviews = reviews::all();
        return view("", compact("reviews"));
    }
    public function add_review(Request $request)
    {
        // dd($request->all());
        $review = new reviews();
        $review->user_name = $request->user_name;
        $review->detail = $request->detail;
        $review->p_id = $request->product_id;
        $review->user_id = $request->user_id;
        $review->save();
        // dd($review);
        return redirect("product-detail/{$request->product_id}")->with("success", "Review Added Successfully");
    }
}
