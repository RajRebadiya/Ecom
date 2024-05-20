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

    public  function index_2()
    {
        $data =  category::all();
        $product = product::all();
        return view('admin.layout.product.add_product', compact('data'), compact('product'));
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
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif',
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

    public function delete($id)
    {
        $data = product::find($id);
        $data->destroy($id);
        return redirect('product')->with('success', 'Product deleted successfully.');
    }

    public function edit($id)
    {
        $data = product::find($id);
        $category = category::all();
        return view('admin.layout.product.edit_product', compact('data'), compact('category'));
    }

    public function update(Request $req)
    {
        $req->validate([
            'product_name' => 'required|string|max:255',
            'c_id' => 'required|exists:category,id',
            'description' => 'required|string',
            'color' => 'required|string',
            'size' => 'required|string',

            'price' => 'required|numeric',
            'qty' => 'required|integer',
            'sell_price' => 'required|numeric',
        ]);

        // Handle product image upload
        if ($req->hasFile('product_image')) {
            $req->validate([
                'product_image' => 'required|image|mimes:jpeg,png,jpg,gif'
            ]);
            $image = $req->file('product_image');
            $imageName =  $image->getClientOriginalName();
            $image->storeAs('public/images/product', $imageName); // Save image to storage
        } else {
            $product = Product::find($req->id);
            // dd($product);
            $imageName = $product->image;
            // return redirect('product')->with('error', 'Product image is required.');
        }

        // Save product data to database
        $product = Product::find($req->id);
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


        return redirect('product')->with('success', 'Product updated successfully.');
    }

    public function show_product()
    {

        $data = product::all();
        // dd($data);

        return view('Category.all_product', compact('data'));
    }

    public function show_product_cat($name)
    {
        // print_r($name);
        $category = category::where('name', $name)->first();
        // dd($category);
        $category_id = $category->id;
        $data = product::where('c_id', $category_id)->get();


        // dd($data);
        return view('Category.all_product', compact('data'));
    }

    public function product_detail($id)
    {
        $datas = product::findOrFail($id);
        return view('product_detail', compact('datas'));
    }

    // public function update(Request $req)
    // {
    //     $req->validate([
    //         'product_name' => 'required|string|max:255',
    //         'c_id' => 'required|exists:category,id',
    //         'description' => 'required|string',
    //         'color' => 'required|string',
    //         'size' => 'required|string',
    //         'price' => 'required|numeric',
    //         'qty' => 'required|integer',
    //         'sell_price' => 'required|numeric',
    //     ]);

    //     // Check if a new image is uploaded
    //     if ($req->hasFile('product_image')) {
    //         $req->validate([
    //             'product_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //         ]);

    //         // Handle product image upload
    //         $image = $req->file('product_image');
    //         $imageName = $image->getClientOriginalName();
    //         $image->storeAs('public/images/product', $imageName); // Save image to storage
    //     } else {
    //         // If no new image is uploaded, keep the existing image
    //         $product = Product::findOrFail($req->id); // Assuming you have product_id in your form
    //         $imageName = $product->image;
    //     }

    //     // Update product data in the database
    //     $product = Product::findOrFail($req->id);
    //     $product->name = $req->product_name;
    //     $product->c_id = $req->c_id;
    //     $product->description = $req->description;
    //     $product->color = $req->color;
    //     $product->size = $req->size;
    //     $product->image = $imageName; // Use the new or existing image name
    //     $product->price = $req->price;
    //     $product->qty = $req->qty;
    //     $product->sell_price = $req->sell_price;
    //     $product->save();

    //     return redirect('product')->with('success', 'Product updated successfully.');
    // }
}
