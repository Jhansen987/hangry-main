<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    //
    public function viewCart(){
        if(Auth::check() && Auth::user()->account_type == 'customer'){
            $carts = Cart::where('username',Auth::user()->username)->with('product')->get();
            return view('cart',compact('carts')); 
        }else{
            return view('auth/login');
        }
    }

    public function addCart($id){
        $cart = Cart::create([
            'username' => Auth::user()->username,
            'product_id' => $id,
            'quantity' => 1
        ]);

        if($cart){
            return Redirect()->back()->with(['success'=>'Item added to your cart successfully!']);
        }
    }
}
