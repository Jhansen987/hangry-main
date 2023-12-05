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
    //CUSTOMER SIDE
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
            'subtotal' => $totalCartPrice,
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

            $vat = $order->grand_total * 0.12;
            return view('vieworder',compact('order','orderedproducts','vat'));

        }else if(Auth::check() && Auth::user()->account_type == 'admin'){
            $order = Order::where('order_id',$orderID)->first();
            $orderedproducts = OrderedProduct::where('order_id',$orderID)->get();
            
            $vat = $order->grand_total * 0.12;
            return view('admin/admin-viewOrder',compact('order','orderedproducts','vat'));
        
        }else{
            return view('auth/login');
        }
    }

    //ADMIN SIDE - (VIEWING AND UPDATING ORDERS...)
    public function viewAllCustomerOrders(){
        $orders = Order::latest()->paginate(10);
        return view('admin/admin-manageOrders',compact('orders'));
    }

    //Set Order Status Back to "Pending"
    public function setOrderStatusToPending($id){
        $update = Order::find($id)->update([
            'order_status'=> "Pending",
            'payment_status' => "Pending"
        ]);
        return Redirect()->back();
    }

    //Set Order Status to "Ready for Onsite Payment"
    public function setOrderStatusToReadyForOnsitePayment($id){
        $update = Order::find($id)->update([
            'order_status' => "Ready for Onsite Payment",
            'payment_status' => "Awaiting Payment"
        ]);
        return Redirect()->back();
    }

    //Set Order Status to "Delivered"
    public function setOrderStatusToDelivered($id){
        $update = Order::find($id)->update([
            'order_status'=> "Delivered",
            'payment_status' => "Paid"
        ]);
        return Redirect()->back();
    }

    //Set Order Status to "Processing"
    public function setOrderStatusToProcessing(Request $request,$id){
        $update = Order::find($id)->update([
            'order_status'=> "Processing",
            'payment_status' => "Awaiting Payment"
        ]);
        return Redirect()->back();
    }

    //Set Order Status to "Shipped"
    public function setOrderStatusToShipped($id){
        $update = Order::find($id)->update([
            'order_status'=> "Shipped"
        ]);
        return Redirect()->back();
    }

    //Cancel an Order...
    public function cancelOrder($id){
        if(Auth::check() && Auth::user()->account_type == 'customer'){
            if(Auth::user()->account_status == 'active'){
                $update = Order::find($id)->update([
                    'order_status' => "Cancelled",
                    'payment_status' => "Cancelled"
                ]);
                return Redirect()->back();
            }else{
                return view('auth/login');
            }
        }else if(Auth::check() && Auth::user()->account_type == 'admin'){
            $update = Order::find($id)->update([
                'order_status' => "Cancelled",
                'payment_status' => "Cancelled"
            ]);
            return Redirect()->back();
        }else{
            return view('auth/login');
        }
    }

    //Set Order's Delivery Fee
    public function setDeliveryFee(Request $request){
        $shippingfee = $request->deliveryFee;
        $newgrandtotal = 0;
        $order = Order::where('id',$request->id)->first();

        $newgrandtotal = $shippingfee + $order->grand_total;

        $update = Order::find($request->id)->update([
            'order_status' => "Processing",
            'shipping_fee' => $request->deliveryFee,
            'grand_total' => $newgrandtotal
        ]);
        return Redirect()->back();
    }

    //Set Order's Delivery Date
    public function setDeliveryDate(Request $request){
        $update = Order::find($request->id)->update([
            'delivery_date'=> $request->deliveryDate
        ]);
        return Redirect()->back();
    }

    //Edit Order's Delivery Date
    public function editDeliveryDate(Request $request){
        $update = Order::find($request->id)->update([
            'delivery_date'=> $request->deliveryDate
        ]);
        return Redirect()->back();
    }
}