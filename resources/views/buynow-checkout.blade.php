<!DOCTYPE html>
<html>
    <head>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
	    <meta charset="ISO-8859-1">
        <title>Checkout (Buy Now) | Hangry</title>
        <link rel="stylesheet" href="{{asset('css/style-main.css')}}">
    </head>
<body>
<div class="main-body-content-2">
	<div class="content-box-5">
		<a href="{{url('viewproduct/'.$cart->product->id)}}">&laquo; BACK</a>
	</div>
	<div class="content-box-6">
		<div class="content-box-main-header">CHECKOUT PAGE</div><br>
		<div class="div-for-ordered-items">

			<div class="checkout-box-product">
				<div class="div-checkout-product-image">
					<img src="{{asset('storage/'.$cart->product->product_image_path)}}" alt="" class="checkout-product-image">
				</div>
				<div class="div-checkout-product-info">
					{{$cart->product->product_name}}
				</div>
				<div class="div-checkout-product-info quantity">x {{$cart->quantity}}</div>
				<div class="div-checkout-product-info price">&#8369 {{$cart->product->price}}</div>
			</div><br>
			
		</div><br>
		<div class="content-box-main-header">SHIPPING ADDRESS</div><br>
			<div class="box-checkout-info-1">
				<div class="box-shipping-address">
					<p class="txt-checkout-content-1">
						<span class="txt-content-header-1">SHIPPING ADDRESS</span><br>
						{{Auth::user()->address}}
					</p>
				</div>
			</div>
		
		<br><br>
		<div class="content-box-main-header">PAYMENT DETAILS</div><br>
		<div class="box-checkout-info-2">			
			<div class="box-info-2">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2">SHIPPING FEE</span><br>
					To be set by Admin
				</p>
			</div>
				
			<div class="box-info-2">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2">SUBTOTAL</span><br>
					&#8369 <?php echo number_format((float)$totalCartPrice,2) ?>
				</p>
			</div>
		</div>
		<br>
		<div class="content-box-main-header">PAYMENT OPTIONS</div><br>
		<form action="{{route('buynow-placeOrder')}}" method="POST">
			@csrf
            <input type="hidden" name="buynowproductid" value="{{$cart->product->id}}">
			<div class="box-checkout-info-1">
				<div>
					<input type="radio" id="onsite-payment" name="paymentoption" value="Onsite Payment" required>
	  				<label for="onsite-payment" class="label-payment-option">Onsite Payment</label><br>
					<p class="txt-payment-option-details">
						Pay the amount of your order on Hangry's physical store and receive your ordered
						products immediately afterwards.
					</p>
				</div><br><br><br>

				<div>
					<input type="radio" id="onsite-payment" name="paymentoption" value="Cash on Delivery" required>
	  				<label for="onsite-payment" class="label-payment-option">Cash on Delivery</label><br>
					<p class="txt-payment-option-details">
						Pay the amount of your order to one of our person assigned for delivering the product
						to your shipping address. Wait for the Administrator to set a shipping fee for your order,
						depending on your shipping address. You have the option to cancel your order for as long
						as your order is not being shipped yet.<br><br>
						
						<span style="color:red;"><b>IMPORTANT NOTE:</b> We only deliver orders within Metro Manila, if your shipping address is
						outside Metro Manila, the Hangry team will cancel your order.</span>
					</p>
				</div><br><br><br>
			</div>
			<button type="submit" class="btn-checkout">PLACE AN ORDER</button>
		</form>
	</div>
</div>
</body>
</html>