<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;

class CartController extends Controller
{
    //
    public function addCart(Request $request,$id){

        $cart = Cart::create([
            'username' => Auth::user()->username,
            'product_id' => $id,
            'quantity' => 1
        ]);

        if($cart){
        return Redirect()->route('viewProduct')->with(['success'=>'Item added to cart successfully!']);
        }else{
            return redirect()->back()->withInput()->withErrors(['error' => 'Oops! An error occurred, please try again later.']);
        }
    }
}
