<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\Validated;

class CategoryController extends Controller
{
    //
    public function add_category(Request $req)
    {
        $req->validate([
            'category_name' => 'required|string|max:255|unique:category,name',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // adjust validation rules as needed
        ]);


        if ($req->hasFile('category_image')) {
            $image = $req->file('category_image');
            $imageName =  $image->getClientOriginalName();
            $image->storeAs('public/images/', $imageName); // Save image to storage
        } else {
            return redirect('category')->with('error', 'Category image is required.');
        }


        // Save category data to database
        $category = new Category();
        $category->name = $req->category_name;
        $category->image = $imageName; // Save the filename to the database
        $category->save();

        // $data['category'] = Category::all();
        // dd($data);
        // exit();


        return redirect('category')->with('success', 'Category added successfully.');
    }

    public  function index()
    {
        $data =  Category::all();
        return view('admin.layout.category', compact('data'));
    }

    public function delete($id)
    {
        $data = Category::find($id);
        $data->destroy($id);
        return redirect('category')->with('success', 'Category deleted successfully.');
    }

    public function edit($id)
    {
        $data = Category::find($id);
        return view('admin.layout.edit_category', compact('data'));
    }

    public function update(Request $req)
    {
        $req->validate([
            'category_name' => 'required|string|max:255',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // adjust validation rules as needed
        ]);
        $category = Category::find($req->id);
        $category->name = $req->category_name;
        if ($req->hasFile('category_image')) {
            $image = $req->file('category_image');
            $imageName =  $image->getClientOriginalName();
            $image->storeAs('public/images/', $imageName); // Save image to storage
            $category->image = $imageName; // Save the filename to the database
        }
        $category->save();
        return redirect('category')->with('success', 'Category updated successfully.');
    }
}
