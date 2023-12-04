@include ('headers.customer-header')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="csrf-token" content="{{csrf_token()}}">
        <title>My Cart | Hangry</title>
        <link rel="stylesheet" href="css/style-main.css">
    </head>
<body class="orange-background">
@if(session('success'))

<div class="toast-container position-fixed top-0 p-3" style="width:100%;">
  <div id="liveToast" class="toast" style="margin:auto;background-color:#fff;" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header" style="background-color:#dbdadb;">
      <img src="../icons/notification-gray-fill_icon.svg" class="rounded me-2" alt="...">
      <small class="me-auto" style="color:#5e5b5e;">Notification</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <span style="color:#5e5b5e;">{{session('success')}}</span>
    </div>
  </div>
</div>
<script>
    const toastLiveExample = document.getElementById('liveToast');
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
    toastBootstrap.show();
    const audio = new Audio("{{asset('sounds/alert-sound.mp3')}}");
    audio.play();
</script>
@endif
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
						<button onclick="decreaseQuantity({{$cart->id}})" class="btn-cart-quantity left">-</button>
						<input type="number" id="cartQuantity[{{$cart->id}}]" name = "cartQuantity[{{$cart->id}}]" 
						value="{{$cart->quantity}}" min="1" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" 
						oninput="checkInputValue(this,{{$cart->product->stocks}})">
						<button onclick="increaseQuantity({{$cart->id}},{{$cart->product->stocks}})" class="btn-cart-quantity right">+</button>
					</div>
				</div>
				
				<div class="cart-action-column">
					<button onclick="window.location.href='{{url('cart/delete/'.$cart->id)}}';" class="btn-remove-item-2">
						<img src="icons/trash-red_icon.svg" class="btn-icons">
					</button>
				</div>
			</div>
			@endforeach
		@endif
		</div>
	</div>

	<div class="content-box-4">
		<div class="content-box-2">
			<div class="content-box-main-header">CART ACTIONS</div><br>
			<p class="txt-note">Whenever you change the quantities of your products, always click on <b>UPDATE CART</b> to save your changes.</p>
			<button class="btn-danger" id="btn-update-cart">UPDATE CART</button> <!-- btn-cart-1 class -->
			<button class="btn-danger">REMOVE ALL</button>
		</div>
	
		<div class="content-box-2">
			<div class="content-box-main-header">ORDER DETAILS</div><br>
			<table class="cart-order-details-table">
				<tr>
					<td class="txt-order-details" width="45%">SUBTOTAL:</td>
					<td class="txt-order-details-2">
						PHP 
						<span id="subtotal">
							<?php echo number_format((float)$totalCartPrice,2) ?>
						</span>
					</td>
				</tr>
				<tr>
					<td class="txt-order-details">SHIPPING FEE:</td>
					<td class="txt-order-details-2">To be set by Admin</td>
				</tr>
			</table>
			<hr width="97%">
			<table class="cart-order-details-table">
				<tr>
					<td class="txt-order-details-3" width="23%">TOTAL</td>
					<td class="txt-order-details-4">
						<b>PHP 
							<span id="totalCartPrice">
								<?php echo number_format((float)$totalCartPrice,2) ?>
							</span>
						</b>
					</td>
				</tr>
			</table>
			
			<button class="btn-cart-full-width" onclick="window.location.href = '{{url('checkout')}}';">PROCEED TO CHECKOUT</button>
		</div>
	</div>
</div>
@include ('footers.footer')
<script> //for increase, decrease, and checking user's input in the product quantity field..
	function decreaseQuantity(cartID){
		var inputQuantityField = document.getElementById('cartQuantity['+ cartID + ']');
		var currentQuantityValue = parseInt(inputQuantityField.value);

		if(currentQuantityValue > 1){
			inputQuantityField.value--;
		}
	}

	function increaseQuantity(cartID,maxStocksAvailable){
		var inputQuantityField = document.getElementById('cartQuantity['+ cartID + ']');
		var currentQuantityValue = parseInt(inputQuantityField.value);

		if(currentQuantityValue >= 1 && currentQuantityValue < maxStocksAvailable){
			inputQuantityField.value++;
		}
	}

	function checkInputValue(inputQuantityField,maxStocksAvailable) {
    if (inputQuantityField.value === '0') { //prevents 0 quantity input..
    	inputQuantityField.value = 1;
    }else if(inputQuantityField.value > maxStocksAvailable){ 
		//if user's input is more than the number of available stocks for the product, 
		//it will auto set to the max number of available stocks for that product
		inputQuantityField.value = maxStocksAvailable;
	}
  }
</script>

<script>
	function numberFormat(number) {
    return number.toLocaleString(); // Using toLocaleString to add comma separators
}
</script>

<script> //to update all items in user's cart in a single click of a button.
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btn-update-cart').addEventListener('click', function() {
            var quantities = {};
           
			@foreach($carts as $cart)
            	quantities[{{$cart->id}}] = document.getElementById('cartQuantity[{{$cart->id}}]').value;
        	@endforeach

			var xhr = new XMLHttpRequest();
			xhr.open('post', '{{url('/cart/update')}}');
			// Make AJAX request to update quantities

			//Get the CSRF token value..
			var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
			// Set CSRF token in request headers
			xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
			xhr.setRequestHeader('Content-Type', 'application/json');
			var notificationTimer;
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Show the toast notification
					var response = JSON.parse(xhr.responseText);
					var toastContainerExists = document.querySelector('.toast-container');

					if(!toastContainerExists){ // this will check if the toast container already currently exists so it no longer needs to create a new one...
					var responseData = JSON.parse(xhr.responseText);
        			var successMessage = responseData.success;

        			// Create elements for the toast container
        			var toastContainer = document.createElement('div');
        			toastContainer.className = 'toast-container position-fixed top-0 p-3';
        			toastContainer.style.width = '100%';

        			var liveToast = document.createElement('div');
        			liveToast.id = 'liveToast';
        			liveToast.className = 'toast';
        			liveToast.style.margin = 'auto';
        			liveToast.style.backgroundColor = '#fff';
        			liveToast.setAttribute('role', 'alert');
        			liveToast.setAttribute('aria-live', 'assertive');
        			liveToast.setAttribute('aria-atomic', 'true');

        			var toastHeader = document.createElement('div');
        			toastHeader.className = 'toast-header';
        			toastHeader.style.backgroundColor = '#dbdadb';

        			var imgElement = document.createElement('img');
        			imgElement.src = '../icons/notification-gray-fill_icon.svg';
        			imgElement.className = 'rounded me-2';
        			imgElement.alt = '...';

        			var smallElement = document.createElement('small');
        			smallElement.className = 'me-auto';
        			smallElement.style.color = '#5e5b5e';
        			smallElement.textContent = 'Notification';

        			var closeButton = document.createElement('button');
        			closeButton.type = 'button';
        			closeButton.className = 'btn-close';
        			closeButton.setAttribute('data-bs-dismiss', 'toast');
        			closeButton.setAttribute('aria-label', 'Close');

        			var toastBody = document.createElement('div');
        			toastBody.className = 'toast-body';

        			var spanElement = document.createElement('span');
        			spanElement.style.color = '#5e5b5e';
        			spanElement.textContent = successMessage;

        			// Construct the hierarchy of elements
        			toastHeader.appendChild(imgElement);
        			toastHeader.appendChild(smallElement);
        			toastHeader.appendChild(closeButton);

        			toastBody.appendChild(spanElement);

        			liveToast.appendChild(toastHeader);
        			liveToast.appendChild(toastBody);

        			toastContainer.appendChild(liveToast);

        			// Append the generated elements to the body or any other container
        			document.body.appendChild(toastContainer);

        			// Make the notification appear
        			var toastBootstrap = bootstrap.Toast.getOrCreateInstance(liveToast);
        			toastBootstrap.show();

					notificationTimer = setTimeout(function() {
            			toastContainer.remove();
        			}, 6000); // remove the whole bootstrap notification container after 6 seconds..

					}else{
						clearTimeout(notificationTimer);

						notificationTimer = setTimeout(function() {
            				toastContainerExists.remove();
        				}, 6000); // remove the whole bootstrap notification container after 6 seconds..
					}

					// Play the notification sound.
					const audio = new Audio("{{ asset('sounds/alert-sound.mp3') }}");
            		audio.play();
					var cartTotalPrice = response.cartTotalPrice;
					document.getElementById('subtotal').innerHTML = cartTotalPrice;
					document.getElementById('totalCartPrice').innerHTML = cartTotalPrice;

					// getTotalCartPrice();
					console.log(xhr.response);
					// console.log('Inputted Quantities', xhr.response);
                } else {
                    // Handle error response
					console.log(xhr);
                    console.error('Request failed with status:', xhr.status);
                }
            };
            xhr.onerror = function() {
                // Handle network errors
                console.error('Request failed');
            };
            xhr.send(JSON.stringify({quantities: quantities}));
        });
    });

</script>

</body>
</html>