<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\reviews;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //

    public function index()
    {
        $data = category::all();
        $product = product::all();
        return view('admin.layout.product.product', compact('data'), compact('product'));
    }

    public function index_2()
    {
        $data = category::all();
        $product = product::all();
        return view('admin.layout.product.add_product', compact('data'), compact('product'));
    }

    public function index_3()
    {
        // dd(Auth::user());
        // if (Auth::check()) {
        //     echo "logged in";
        //     die();
        // } else {
        //     echo "not logged in";
        //     die();
        // }
        $category = category::all();
        $product = product::all();
        // dd($product);
        return view('index', compact('product'), compact('category'));
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
            $imageName = $image->getClientOriginalName();
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
            $imageName = $image->getClientOriginalName();
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
        // dd($id);
        $datas = product::findOrFail($id);
        $reviews = reviews::where('p_id', $id)->get();
        return view('product_detail', compact('datas'), compact('reviews'));
    }



    public function filter(Request $req)
    {
        // dd($req->all());
        // Validate the incoming request data
        $validatedData = $req->validate([
            'min_price' => 'nullable',
            'max_price' => 'nullable',
            'size' => 'nullable',
            'color' => 'nullable|array',
            'category' => 'nullable|array',
        ]);
        // dd($validatedData);

        // Retrieve the validated data
        $minPrice = $validatedData['min_price'] ?? null;
        $maxPrice = $validatedData['max_price'] ?? null;
        $sizes = $validatedData['size'] ?? [];
        $colors = $validatedData['color'] ?? [];
        $categories = $validatedData['category'] ?? [];

        // Remove the dollar sign from the input values
        $minPrice = preg_replace('/^\$/', '', $minPrice);
        $maxPrice = preg_replace('/^\$/', '', $maxPrice);
        // dd($minPrice, $maxPrice);

        // Start building the query
        $queryBuilder = Product::query();
        // dd($categories);

        // Get all products first
        $allProducts = $queryBuilder->get();
        // dd($allProducts);

        // Filter the products based on the selected criteria
        // dd($categories);

        $product = $allProducts->filter(function ($product) use ($minPrice, $maxPrice, $sizes, $colors, $categories) {
            $matchesPrice = true;
            $matchesSize = true;
            $matchesColor = true;
            $matchesCategory = true;

            // dd($product);


            if ($minPrice !== null) {
                $matchesPrice = $product->price >= $minPrice;
            }

            if ($maxPrice !== null) {
                $matchesPrice = $matchesPrice && $product->price <= $maxPrice;
            }

            if (!empty($sizes)) {
                $matchesSize = in_array($product->size, $sizes);
            }

            if (!empty($colors)) {
                // dd($product->color);
                // dd($colors);
                $matchesColor = in_array($product->color, $colors);
                // dd($matchesColor);
            }

            if (!empty($categories)) {
                // dd($categories);
                $data = category::whereIn('name', $categories)->pluck('id')->toArray();
                // dd($data);
                // $data = $product->whereIn('c_id', Category::whereIn('name', $categories)->pluck('id'));
                // $sql = $data->toSql();
                // dd(array($product->c_id));

                $matchesCategory = in_array($product->c_id, $data);

                // dd($matchesCategory);

                // $matchesCategory = $data->count() > 0;
                // dd($matchesCategory);
            }
            // dd($matchesPrice, $matchesSize, $matchesColor, $matchesCategory);
            return $matchesPrice && $matchesSize && $matchesColor && $matchesCategory;
        });

        // dd($product);

        // Get all categories
        $data = Category::all();
        // how to provide pagination

        $products = Product::all();

        if (count($products) > 5) {
            $products = Product::paginate(5);
        } else {
            $products = $products->all();
        }
        // dd($products);
        // dd($sizes);

        // Return the filtered products and categories to the view
        return view('shop', compact('product', 'data', 'sizes', 'colors', 'products', 'minPrice', 'maxPrice', 'categories'));
    }



    public function shop_show()
    {
        $data = category::all();
        $product = product::paginate(5);

        // dd($product);
        return view('shop', compact('product'), compact('data'));
    }

    public function reset_shop()
    {
        $data = category::all();
        $product = product::all();

        // dd($product);
        return redirect('shop')->with('data', $data)->with('product', $product);
        // return view('shop', compact('product'), compact('data') );
    }

    public function latest_product(Request $request)
    {
        $data = product::where('c_id', $request->id)->orderBy('id', 'desc')->get();
        return response()->json($data);
    }

    public function getAllProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }


}
