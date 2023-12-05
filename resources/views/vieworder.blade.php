@include('headers.customer-header')
<!DOCTYPE html>
<html>
    <head>
        <title>View Order | Hangry</title>
    </head>
<body class="orange-background">
<div class="main-body-content">
    <div class="content-box-5">
		<a href="{{url('myorders')}}">&laquo; BACK</a>
	</div>
	<div class="content-box-7">
		<div class="content-box-main-header" style="height:2.1rem;background-color:#e22f14;font-size:1.1rem;"><b>ORDER ID # {{$order->order_id}}</b></div><br>
		<div class="box-info-3">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2">DATE ORDERED</span><br>
					{{$order->created_at->format('F d, Y')}}<br>
					{{$order->created_at->format('g:i a')}}
				</p>
		</div>

        <div class="box-info-3">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2">MODE OF PAYMENT</span><br>
					{{$order->payment_method}}
				</p>
		</div>

        <div class="box-info-3">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2">ORDER STATUS</span><br>
					{{$order->order_status}}
				</p>
		</div>

        <div class="box-info-3">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2">PAYMENT STATUS</span><br>
					{{$order->payment_status}}
				</p>
		</div><br>
		
		<div class="content-box-main-header">Delivery Details</div><br>
		<div class="box-info-3">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2">DELIVERY DATE</span><br>
					@if($order->delivery_date === null)
						None
					@else
						{{$order->delivery_date->format('F d, Y')}}
					@endif
				</p>
		</div>

		<div class="box-checkout-info-1">
			<div class="box-shipping-address">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-1">SHIPPING ADDRESS</span><br>
					{{$order->shipping_address}}
				</p>
			</div>
		</div>
		<div class="content-box-main-header">Payment Details</div><br>

		<div class="box-info-3">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2">SUBTOTAL</span><br>
					&#8369 {{$order->subtotal}}
				</p>
		</div><br>

		<div class="box-info-3">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2">SHIPPING FEE</span><br>
					@if($order->shipping_fee === null)
						None
					@else
						&#8369 {{$order->shipping_fee}}
					@endif
				</p>
		</div><br>
		<hr>
		<div class="box-info-3">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2 red-txt">GRAND TOTAL: &#8369 {{$order->grand_total}}</span><br>
					<span class="txt-content-header-2" style="font-weight:normal;">Value Added Tax (12%): 
					&#8369 <?php echo number_format($vat,2) ?></span>
				</p>
		</div><br>

        <br>
        <div class="content-box-main-header">Ordered Items</div><br>
		<br>
		<div class="div-for-ordered-items">
			
        @foreach($orderedproducts as $orderedproduct)
			<div class="checkout-box-product">
				<div class="div-checkout-product-image"><img src="{{asset('storage/'.$orderedproduct->product_image_path)}}" alt="" class="checkout-product-image"></div>
				<div class="div-checkout-product-info">
					{{$orderedproduct->product_name}}
				</div>
				<div class="div-checkout-product-info quantity">x {{$orderedproduct->quantity}}</div>
				<div class="div-checkout-product-info price">&#8369 {{$orderedproduct->price}}</div>
			</div>
        @endforeach
        <br>
		</div>

		<div class="content-box-main-header">Available Actions</div><br>
        @switch($order->payment_method)
            @case("Onsite Payment")
                @switch($order->order_status)
                    @case("Pending")
                        <button onclick="window.location.href='customercancelorder/{{$order->id}}';" class="btn-available-action">Cancel Order</button>
                        @break
                    
                    @case("Ready for Onsite Payment")
                        <button onclick="window.location.href='customercancelorder/{{$order->id}}';" class="btn-available-action">Cancel Order</button>
                        @break
                    
                    @case("Delivered")
                        <a href="#" target="_blank" class="btn-available-action">View Receipt</a>
                        @break
                    @case("Cancelled")
                        <br>
                        <div style="text-align:center;">
                            <span style="font-size:1rem;color:red;"><b>No further actions can be made for this order.</b></span>
                        </div>
                        @break
                
                @endswitch <!--end switch for order status-->
                @break

            @case("Cash on Delivery")
                @switch($order->order_status)
                    @case("Pending")
                        <button onclick="window.location.href='customercancelorder/{{$order->id}}';" class="btn-available-action">Cancel Order</button>
                        @break
                    
                    @case("Processing")
                            <button onclick="window.location.href='customercancelorder/{{$order->id}}';" class="btn-available-action">Cancel Order</button>
                        @break
                    
                    @case("Shipped")
						<br>
                        <div style="text-align:center;">
                            <span style="font-size:1rem;color:red;"><b>No further actions can be made for this order.</b></span>
                        </div>
                        @break

                    @case("Delivered")
                        <a href="#" target="_blank" class="btn-available-action">View Receipt</a>
                        @break

                    @case("Cancelled")
                        <br>
                        <div style="text-align:center;">
                            <span style="font-size:1rem;color:red;"><b>No further actions can be made for this order.</b></span>
                        </div>
                        @break
                
                @endswitch <!--end switch for order status-->
                @break
        @endswitch <!--end switch for payment method-->
	</div>
</div>
@include ('footers.footer')
</body>
</html>