@include ('headers.customer-header')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Cart | Hangry</title>
        <link rel="stylesheet" href="css/style-main.css">
    </head>
<body class="orange-background">
<div class="main-body-content">
	<div class="home-title-header-2">MY CART</div>
	<div class="content-box-1">			
		<div class="table-content-box-1">

		@if($carts->isEmpty())
		<img src="{{asset('images/sad-face.png')}}" alt="" class="general-empty-image">
		<p class="no-cart-message"><b>You currently have no items in your cart..</b></p>
		
		@else
			@foreach($carts as $cart)
			<div class="box-cart-item"> <!-- Generate this whole div for every cart item found in customer's cart -->
				<div class="cart-product-image-column">
					<img src="{{asset('storage/'.$cart->product->product_image_path)}}" class="cart-product-image">
				</div>
				
				<div class="cart-product-column">
					<p>{{$cart->product->product_name}}</p>
				</div>
				
				<div class="cart-price-column">Php {{$cart->product->price}}</div>
				
				<div class="cart-quantity-column">
					<div class="div-cart-quantity">
						<button class="btn-cart-quantity left">-</button>
						<input type="number" id="cartQuantity" name = "cartQuantity" value="{{$cart->quantity}}" min="1" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
						<button class="btn-cart-quantity right">+</button>
					</div>
				</div>
				
				<div class="cart-action-column">
					<button class="btn-remove-item-2"><img src="icons/trash-red_icon.svg" class="btn-icons"></button>
				</div>
			</div>
			@endforeach
		@endif
		</div>
	</div>

	<div class="content-box-4">
		<div class="content-box-2">
			<div class="content-box-main-header">CART ACTIONS</div><br>
			<p class="txt-note">Whenever you change the quantities of your product, always click on UPDATE CART to save your changes.</p>
			<button class="btn-danger">UPDATE CART</button> <!-- btn-cart-1 class -->
			<button class="btn-danger">REMOVE ALL</button>
		</div>
	
		<div class="content-box-2">
			<div class="content-box-main-header">ORDER DETAILS</div><br>
			<table class="cart-order-details-table">
				<tr>
					<td class="txt-order-details" width="45%">SUBTOTAL:</td>
					<td class="txt-order-details-2">PHP 0.00</td>
				</tr>
				<tr>
					<td class="txt-order-details">SHIPPING FEE:</td>
					<td class="txt-order-details-2">PHP 0.00</td>
				</tr>
			</table>
			<hr width="97%">
			<table class="cart-order-details-table">
				<tr>
					<td class="txt-order-details-3" width="23%">TOTAL</td>
					<td class="txt-order-details-4"><b>PHP 0.00</b></td>
				</tr>
			</table>
			
			<button class="btn-cart-full-width" onclick="window.location.href = 'checkout.php';">PROCEED TO CHECKOUT</button>
		</div>
	</div>
	<!-- <div class="content-box-3">
		<div class="div-no-items">
			<img src="icons/x-circle-blue-fill_icon.svg" class="no-item-icon">
			<p class="txt-no-item"><b>You have no items in your cart</b></p>
		</div>
	</div> -->
</div>
@include ('footers.footer')
</body>
</html>