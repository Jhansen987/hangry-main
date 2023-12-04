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
            $totalCartPrice = 0;
            foreach($carts as $cart){
                if($cart->product->stocks == 0){
                    Cart::find($cart->id)->delete();
                    continue;
                }else if($cart->quantity > $cart->product->stocks){
                    $cart->update([
                        'quantity' => $cart->product->stocks
                    ]);
                }

                $totalItemPrice = $cart->product->price * $cart->quantity;
                $totalCartPrice = $totalCartPrice + $totalItemPrice;
            }
            return view('cart',compact('carts','totalCartPrice')); 
        }else{
            return view('auth/login');
        }
    }

    public function addCart($id){
        $cart = Cart::where('username',Auth::user()->username)
                ->where('product_id',$id)->with('product')->first();

        if($cart === null){
            $cart = Cart::create([
                'username' => Auth::user()->username,
                'product_id' => $id,
                'quantity' => 1
            ]);
        }else{
            $currentItemQuantity = $cart->quantity + 1;
            $cart->update([
                'quantity' => $currentItemQuantity
            ]);
        }

        if($cart){
            return Redirect()->back()->with(['success'=>'Item added to your cart successfully!']);
        }
    }

    public function deleteCartItem($id){
        $cart = Cart::find($id)->delete();
        if($cart){
            return Redirect()->back()->with(['success'=>'Item has been successfully removed from your cart!']);
        }

    }

    public function updateCartItems(Request $request){
        $inputtedItemQuantities = $request->input('quantities');
        $carts = Cart::where('username',Auth::user()->username)->with('product')->get();
        $totalCartPrice = 0;
        foreach($carts as $cart){
            $currentProductStocks = $cart->product->stocks;
            $inputProductQuantity = $inputtedItemQuantities[$cart->id];

            if($inputProductQuantity > $currentProductStocks){
                $inputProductQuantity = $currentProductStocks;
            }

            $update = Cart::find($cart->id)->update([
                'quantity' => $inputProductQuantity
            ]);

            $totalItemPrice = $inputProductQuantity * $cart->product->price;
            $totalCartPrice += $totalItemPrice;
        }
        
        $displayTotalCartPrice = number_format($totalCartPrice,2);

        return response()->json([
            'success' => "Your items have been updated in your cart successfully!",
            'cartTotalPrice' => $displayTotalCartPrice
        ]);
    }

    // public function getTotalCartPrice(){
    //     $carts = Cart::where('username',Auth::user()->username)->with('product')->get();
    //     $totalCartPrice = 0;
    //     foreach($carts as $cart){
    //         $totalItemPrice = $cart->quantity * $cart->product->price;
    //         $totalCartPrice += $totalItemPrice;
    //     }

    //     return response()->json([
    //         'cartTotalPrice' => $totalCartPrice
    //     ]);
    // }
}
