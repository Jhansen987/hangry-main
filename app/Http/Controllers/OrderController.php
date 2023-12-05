<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Product;
use App\Models\Cart;

class OrderController extends Controller
{
    public function addOrder(Request $request){

        //generate an Order ID...
        $orderID = '';
        $orderID .= rand(100000,999999);

        $carts = Cart::where('username',Auth::user()->username)->with('product')->get();
        $totalCartPrice = 0;
        foreach($carts as $cart){
            $availableStocksLeft = $cart->product->stocks - $cart->quantity;
            if($availableStocksLeft < 0){$availableStocksLeft = 0;}

            $cart->product->update([
                'stocks' => $availableStocksLeft
            ]);
            
            OrderedProduct::create([
                'order_id' => $orderID,
                'product_name' => $cart->product->product_name,
                'price' => $cart->product->price,
                'product_image_path' => $cart->product->product_image_path,
                'quantity' => $cart->quantity
            ]);

            $totalItemPrice = $cart->product->price * $cart->quantity;
            $totalCartPrice = $totalCartPrice + $totalItemPrice;
        }
       
        Order::create([
            'order_id' => $orderID,
            'firstname' => Auth::user()->firstname,
            'lastname' => Auth::user()->lastname,
            'username' => Auth::user()->username,
            'gender' => Auth::user()->gender,
            'email' => Auth::user()->email,
            'contactnumber' => Auth::user()->contactnumber,
            'shipping_address' => Auth::user()->address,
            'payment_method' => $request->paymentoption,
            'order_status' => "Pending",
            'payment_status' => "Pending",
            'grand_total' => $totalCartPrice,
            'created_at' => Carbon::now()
        ]);

        $deleteAll = Cart::where('username', Auth::user()->username)->delete();

        $order = Order::where('order_id',$orderID)->first();
        $orderedproducts = OrderedProduct::where('order_id',$orderID)->get();
        return view('vieworder',compact('order','orderedproducts'))->with(['success' => 'You have successfully placed an order!']);
    }

    public function viewAllMyOrders(){
        if(Auth::check() && Auth::user()->account_type == 'customer'){
            $orders = Order::latest()->where('username',Auth::user()->username)->paginate(8);
            return view('myorders',compact('orders'));
        }else{
            return view('auth/login');
        }
    }

    public function viewSpecificOrder($orderID){
        if(Auth::check() && Auth::user()->account_type == 'customer'){
            $order = Order::where('order_id',$orderID)->first();
            $orderedproducts = OrderedProduct::where('order_id',$orderID)->get();
            return view('vieworder',compact('order','orderedproducts'));
        }else{
            return view('auth/login');
        }
    }
}
