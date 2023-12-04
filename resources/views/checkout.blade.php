<!DOCTYPE html>
<html>
    <head>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
	    <meta charset="ISO-8859-1">
        <title>Checkout | Hangry</title>
        <link rel="stylesheet" href="{{asset('css/style-main.css')}}">
    </head>
<body>
<div class="main-body-content-2">
	<div class="content-box-5">
		<a href="mycart.php">&laquo; BACK</a>
	</div>
	<div class="content-box-6">
		<div class="content-box-main-header">CHECKOUT PAGE</div><br>
		<div class="div-for-ordered-items">
			
			<div class="checkout-box-product">
				<div class="div-checkout-product-image"><img src="images/Savory Southwest Fiesta Bowl.png" alt="" class="checkout-product-image"></div>
				<div class="div-checkout-product-info">
					Savory Southwest Fiesta Bowl
				</div>
				<div class="div-checkout-product-info quantity">x 1</div>
				<div class="div-checkout-product-info price">PHP 250.00</div>
			</div>
			
			<div class="checkout-box-product">
				<div class="div-checkout-product-image"><img src="images/Tropical Mango Tango.png" alt="" class="checkout-product-image"></div>
				<div class="div-checkout-product-info">
					Tropical Mango Tango
				</div>
				<div class="div-checkout-product-info quantity">x 1</div>
				<div class="div-checkout-product-info price">PHP 350.00</div>
			</div>
			
			<div class="checkout-box-product">
				<div class="div-checkout-product-image"><img src="images/Spicy Thai Basil Delight.png" alt="" class="checkout-product-image"></div>
				<div class="div-checkout-product-info">
					Spicy Thai Basil Delight
				</div>
				<div class="div-checkout-product-info quantity">x 1</div>
				<div class="div-checkout-product-info price">PHP 200.00</div>
			</div>
			
			<div class="checkout-box-product">
				<div class="div-checkout-product-image"><img src="images/Asian Fusion Umami.png" alt="" class="checkout-product-image"></div>
				<div class="div-checkout-product-info">
					Asian Fusion Umami
				</div>
				<div class="div-checkout-product-info quantity">x 1</div>
				<div class="div-checkout-product-info price">PHP 250.00</div>
			</div>
			
		</div><br>
		<div class="content-box-main-header">SHIPPING ADDRESS</div><br>
			<div class="box-checkout-info-1">
				<div class="box-shipping-address">
					<p class="txt-checkout-content-1">
						<span class="txt-content-header-1">SHIPPING ADDRESS</span><br>
						#100 Benito Greenheights Subdivision Phase 3 Nangka, Marikina City
					</p>
				</div>
			</div>
		
		<br><br>
		<div class="content-box-main-header">PAYMENT DETAILS</div><br>
		<div class="box-checkout-info-2">			
			<div class="box-info-2">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2">SHIPPING FEE</span><br>
					PHP 30.00
				</p>
			</div>
				
			<div class="box-info-2">
				<p class="txt-checkout-content-1">
					<span class="txt-content-header-2">SUBTOTAL</span><br>
					PHP 1080.00
				</p>
			</div>
		</div>
		<br>
		<div class="content-box-main-header">PAYMENT OPTIONS</div><br>
		<div class="box-checkout-info-1">
			<div>
				<input type="radio" id="onsite-payment" name="payment-option" value="Onsite Payment" required>
  				<label for="onsite-payment" class="label-payment-option">Onsite Payment</label><br>
				<p class="txt-payment-option-details">
                    Pay the amount of your order on Hangry's physical store and receive your ordered
                    products immediately afterwards.
				</p>
			</div><br><br><br>

            <div>
				<input type="radio" id="onsite-payment" name="payment-option" value="Cash on Delivery" required>
  				<label for="onsite-payment" class="label-payment-option">Cash on Delivery</label><br>
				<p class="txt-payment-option-details">
                    Pay the amount of your order to one of our person assigned for delivering the product
                    to your shipping address.
				</p>
			</div><br><br><br>
		</div>
		<button class="btn-checkout" onclick="window.location.href='home.php';">PLACE AN ORDER</button>
	</div>
</div>
</body>
</html>