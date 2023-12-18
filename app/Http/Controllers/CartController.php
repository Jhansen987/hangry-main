<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    //
    public function viewCart(){
        if(Auth::check() && Auth::user()->account_type == 'customer'){
            if(Auth::user()->account_status == 'active'){
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
                Auth::logout();
                session()->flash('success','Your account has been blocked by the Administrator.');
                return view('auth/login');
            }
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function viewCheckoutItems(){
        if(Auth::check() && Auth::user()->account_type == 'customer'){
            if(Auth::user()->account_status == 'active'){
                $carts = Cart::where('username',Auth::user()->username)->with('product')->get();
                if($carts->isNotEmpty()){
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
                    return view('checkout',compact('carts','totalCartPrice')); 
                }else{
                    return Redirect()->route('cart');
                }
            }else{
                Auth::logout();
                session()->flash('success','Your account has been blocked by the Administrator.');
                return view('auth/login');
            }
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }


    public function addCart($id){
        if(Auth::check() && Auth::user()->account_type == 'customer'){
            if(Auth::user()->account_status == 'active'){

                $product = Product::find($id);
                if($product->stocks > 0){
                    $cart = Cart::where('username',Auth::user()->username)
                            ->where('product_id',$id)->with('product')->first();

                    if($cart === null){
                        $cart = Cart::create([
                            'username' => Auth::user()->username,
                            'product_id' => $id,
                            'quantity' => 1
                        ]);

                        return response()->json([
                            'success' => "The item has been successfully added to your cart!"
                        ]);
                        
                    }else{
                        if($cart->quantity == $product->stocks){
                            return response()->json([
                                'success' => "This item in your cart already reached the maximum number of available stocks."
                            ]);
                        }else{
                            if($cart->quantity > $product->stocks){
                                $currentItemQuantity = $product->stocks;
                            }else{
                                $currentItemQuantity = $cart->quantity + 1;
                            }
                            
                            $cart->update([
                                'quantity' => $currentItemQuantity
                            ]);

                            return response()->json([
                                'success' => "The item has been successfully added to your cart!"
                            ]);
                        }
                    }
                }else{
                    return response()->json([
                        'success' => "Sorry, it seems that this product already ran out of stock!"
                    ]);
                }

            }else{
                Auth::logout();
                session()->flash('success','Your account has been blocked by the Administrator.');
                return view('auth/login');
            }
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function deleteCartItem($id){
        if(Auth::check() && Auth::user()->account_type == 'customer'){
            if(Auth::user()->account_status == 'active'){
                $cart = Cart::find($id)->delete();
                if($cart){
                    return Redirect()->back()->with(['success'=>'Item has been successfully removed from your cart!']);
                }
            }else{
                Auth::logout();
                session()->flash('success','Your account has been blocked by the Administrator.');
                return view('auth/login');
            }
        }else{
            Auth::logout();
            return view('auth/login');
        }

    }

    public function deleteAllCartItems(){
        if(Auth::check() && Auth::user()->account_type == 'customer'){
            if(Auth::user()->account_status == 'active'){
                $deleteAll = Cart::where('username', Auth::user()->username)->delete();
                return Redirect()->back()->with(['success'=>'All items have been successfully removed from your cart!']);
            }else{
                Auth::logout();
                session()->flash('success','Your account has been blocked by the Administrator.');
                return view('auth/login');
            }
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function updateCartItems(Request $request){
        if(Auth::check() && Auth::user()->account_type == 'customer'){
            if(Auth::user()->account_status == 'active'){
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
            }else{
                Auth::logout();
                session()->flash('success','Your account has been blocked by the Administrator.');
                return view('auth/login');
            }
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function viewBuyNowCart($id){
        if(Auth::check() && Auth::user()->account_type == 'customer'){
            if(Auth::user()->account_status == 'active'){
                
                $product = Product::find($id);

                if($product->status == 'Visible to Public'){

                    if($product->stocks <= 0){
                        return Redirect()->back()->with(['success'=> 'Sorry, the product already ran out of stock just now.']);
                    }else{
                        $cart = Cart::where('username',Auth::user()->username)
                        ->where('product_id',$id)
                        ->with('product')
                        ->first();
                        $totalCartPrice = 0;

                        if($cart === null){
                            Cart::create([
                                'username' => Auth::user()->username,
                                'product_id' => $id,
                                'quantity' => 1
                            ]);

                            $cart = Cart::where('username',Auth::user()->username)
                            ->where('product_id',$id)
                            ->with('product')
                            ->first();

                            $totalItemPrice = $cart->product->price * $cart->quantity;
                            $totalCartPrice = $totalCartPrice + $totalItemPrice;
                            return view('buynow-cart',compact('cart','totalCartPrice'));
                        }else{
                            $totalItemPrice = $cart->product->price * $cart->quantity;
                            $totalCartPrice = $totalCartPrice + $totalItemPrice;
                            return view('buynow-cart',compact('cart','totalCartPrice'));
                        }

            
                    }
            
                }else{
                    return Redirect()->url('menu')->with(['success'=> 'Sorry, the product has been made temporary unavailable by the Administrator just now.']);
                }
                
            }else{
                Auth::logout();
                session()->flash('success','Your account has been blocked by the Administrator.');
                return view('auth/login');
            }
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }

    public function viewBuyNowCheckoutItem($id){
        if(Auth::check() && Auth::user()->account_type == 'customer'){
            if(Auth::user()->account_status == 'active'){

                $cart = Cart::where('username',Auth::user()->username)
                        ->where('product_id',$id)
                        ->with('product')
                        ->first();
                
                if($cart->product->stocks == 0){
                    $cart->delete();
                    return Redirect()->url('viewproduct'.$id)->with(['success'=> 'Sorry, the product already ran out of stock just now.']);
                }else if($cart->product->stocks < $cart->quantity){
                    
                    $cart->update([
                        'quantity' => $cart->product->stocks
                    ]);
                    $totalCartPrice = 0;
                    $totalItemPrice = 0;
                    $totalItemPrice = $cart->product->price * $cart->quantity;
                    $totalCartPrice = $totalCartPrice + $totalItemPrice;
                    return view('buynow-checkout',compact('cart','totalCartPrice'));
                }else{
                    $totalCartPrice = 0;
                    $totalItemPrice = 0;
                    $totalItemPrice = $cart->product->price * $cart->quantity;
                    $totalCartPrice = $totalCartPrice + $totalItemPrice;
                    return view('buynow-checkout',compact('cart','totalCartPrice'));
                }

            }else{
                Auth::logout();
                session()->flash('success','Your account has been blocked by the Administrator.');
                return view('auth/login');
            }
        }else{
            Auth::logout();
            return view('auth/login');
        }
    }
 
}
