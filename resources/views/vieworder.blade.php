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
		<div class="content-box-main-header">ORDER ID # {{$order->order_id}}</div><br>
		<div class="box-info-3">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2">DATE ORDERED</span><br>
					{{$order->created_at->format('F d, Y')}}<br>
					{{$order->created_at->format('g:i a')}}
				</p>
		</div>

        <div class="box-info-3">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2">PRICE TO PAY</span><br>
					&#8369 {{$order->grand_total}}
				</p>
		</div>

        <div class="box-info-3">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2">MODE OF PAYMENT</span><br>
					{{$order->payment_method}}
				</p>
		</div><br>

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
		</div>

        <div class="box-checkout-info-1">
				<div class="box-shipping-address">
					<p class="txt-checkout-content-1">
						<span class="txt-content-header-1">SHIPPING ADDRESS</span><br>
						{{$order->shipping_address}}
					</p>
				</div>
			</div>
        <br>
        <div class="content-box-main-header">ORDERED ITEMS</div><br>
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
	</div>
</div>
@include ('footers.footer')
</body>
</html>