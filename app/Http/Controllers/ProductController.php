<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Product;

class ProductController extends Controller
{
    //

    public function displayAllProducts(){
        $products = Product::latest()->paginate(6);
        if(Auth::check() && Auth::user()->account_type == 'admin'){
            return view('admin/admin-manageProducts',compact('products'));
        }else if(Auth::check() && Auth::user()->account_type == 'customer'){
            return view('menu',compact('products'));
        }else{
            return view('guest-menu',compact('products'));
        }
    }

    public function createProduct(Request $request){
        $validated = $request->validate([
            'menuImage' => 'required|image|max:2048|mimes:jpg,png,jpeg',
            'menuName' => 'required|string|unique:products,product_name',
            'menuPrice' => 'required|numeric|min:0',
            'menuStock' => 'required|numeric|min:0',
            'menuDescription' => 'string',
        ]);

        //checks if product-images folder has already been created in the storage disk, if not, create one..
        if(!Storage::exists('public/product-images')){
             Storage::makeDirectory('public/product-images');
        }

        //get the image path of the user's uploaded image to save later in the database
        $imagepath = $request->file('menuImage')->store('product-images','public'); //('directory on storage disk', 'storage disk name')
        $products = Product::create([
            'product_image_path' => $imagepath,
            'product_name' => $request->menuName,
            'price' => $request->menuPrice,
            'stocks' => $request->menuStock,
            'status' => "normal",
            'description' => $request->menuDescription,
            'created_at' => Carbon::now()
        ]);

        if($products){
        return Redirect()->route('admin-manageProducts')->with(['success'=>'Menu Created Successfully!']);
        }else{
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create menu.']);
        }
    }

    public function editProduct($id){

            $product = Product::find($id);
            return view('admin/admin-editProduct',compact('product'));
    }


    //updates the product in the database..
    public function updateProduct(Request $request , $id){
        $validated = $request->validate([
            'menuImage' => 'nullable|image|max:2048|mimes:jpg,png,jpeg',
            'menuName' => 'required|string|unique:products,product_name',
            'menuPrice' => 'required|numeric|min:0',
            'menuStock' => 'required|numeric|min:0',
            'menuDescription' => 'string',
        ]);

        //get the image path of the user's newly uploaded image for a product..
        if($request->hasFile('menuImage')){
            $imagepath = $request->file('menuImage')->store('product-images','public');
            $update = Product::find($id)->update([
                'product_image_path'=> $imagepath,
                'product_name'=> $request->menuName,
                'price'=> $request->menuPrice,
                'stocks'=> $request->menuStock,
                'description'=> $request->menuDescription,
            ]);
        }else{
            $update = Product::find($id)->update([
                'product_name'=> $request->menuName,
                'price'=> $request->menuPrice,
                'stocks'=> $request->menuStock,
                'description'=> $request->menuDescription,
            ]);
        }
        // return Redirect()->route('admin-manageProducts')->with('success','Product Updated Succesfully!');
        if($update){
            return Redirect()->route('admin-manageProducts')->with(['success'=>'Menu Updated Successfully!']);
            }else{
                return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create menu.']);
            }
    }

    public function viewProduct($id){
        $product = Product::find($id);
        if(Auth::check() && Auth::user()->account_type == 'admin'){
            return view('admin/admin-viewProduct',compact('product'));
        }else if(Auth::check() && Auth::user()->account_type == 'customer'){
            return view('viewproduct',compact('product'));
        }else{
            return view('guest-viewproduct',compact('product'));
        }
    }
}
