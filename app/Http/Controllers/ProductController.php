<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;

class ProductController extends Controller
{
    //

    public  function index()
    {
        $data =  category::all();
        $product = product::all();
        return view('admin.layout.product.product', compact('data'), compact('product'));
    }

    // public function show_data()
    // {
    //     $product = product::all();
    //     return view('admin.layout.product.product', compact('product'));
    // }

    public function add_product(Request $req)
    {
        $req->validate([
            'product_name' => 'required|string|max:255|unique:products,name',
            'c_id' => 'required|exists:category,id',
            'description' => 'required|string',
            'color' => 'required|string',
            'size' => 'required|string',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'qty' => 'required|integer',
            'sell_price' => 'required|numeric',
        ]);

        // Handle product image upload
        if ($req->hasFile('product_image')) {
            $image = $req->file('product_image');
            $imageName =  $image->getClientOriginalName();
            $image->storeAs('public/images/product', $imageName); // Save image to storage
        } else {
            return redirect('product')->with('error', 'Product image is required.');
        }

        // Save product data to database
        $product = new Product();
        $product->name = $req->product_name;
        $product->c_id = $req->c_id;
        $product->description = $req->description;
        $product->color = $req->color;
        $product->size = $req->size;
        $product->image = $imageName;
        $product->price = $req->price;
        $product->qty = $req->qty;
        $product->sell_price = $req->sell_price;
        $product->save();

        return redirect('product')->with('success', 'Product added successfully.');
    }
}
