@include('../headers.admin-header')
<!DOCTYPE html>
<html>
    <head>
        <title>View Order | Hangry</title>
    </head>
<body class="orange-background-admin"><!--orange-background-->
<div id="black-screen-3" class="black-screen-3"> <!-- For the popup of setting delivery fee and estimated date of delivery -->
	<div id="deliveryFeePopup" class="box-popup-1">
		<div class="content-box-header">
			SET DELIVERY FEE
			<button class="btn-popup" onClick="closeDeliveryFeePopup()">X</button>
		</div><br>
			
		<form action ="{{route('setdeliveryfee')}}" method="POST">
        @csrf
            <input type="hidden" id="orderid" name="id" value="{{$order->id}}">
			<label for="deliveryFee" class="popup-label-1">Shipping Fee *</label><br>
			<input type="number" min="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" id="deliveryFee" class="delivery-fee-field" name="deliveryFee" required><br><br><br>
			<button type="submit" class="btn-popup-2">SUBMIT</button>
		</form>
	</div>
	
	<div id="dateOfDeliveryPopup" class="box-popup-2">
		<div class="content-box-header">
			SET DATE OF DELIVERY
			<button class="btn-popup" onClick="closeDateOfDeliveryPopup()">X</button>
		</div><br>
		<form action ="{{route('setdeliverydate')}}" method="POST">
        @csrf
            <input type="hidden" id="orderid" name="id" value="{{$order->id}}">
			<label for="deliveryDate" class="popup-label-1">Estimated Date of Delivery *</label><br>
			<input type="date" min="" class="delivery-fee-field" id="deliveryDate" name="deliveryDate" required><br><br><br>
			<button type="submit" class="btn-popup-2">SUBMIT</button>
		</form>
	</div>

    <div id="dateOfDeliveryPopup2" class="box-popup-3">
		<div class="content-box-header">
			EDIT DATE OF DELIVERY
			<button class="btn-popup" onClick="closeDateOfDeliveryPopup2()">X</button>
		</div><br>
		<form action ="{{route('editdeliverydate')}}" method="POST">
        @csrf
            <input type="hidden" id="orderid" name="id" value="{{$order->id}}">
			<label for="deliveryDate" class="popup-label-1">Estimated Date of Delivery *</label><br>
			<input type="date" min="" class="delivery-fee-field" id="deliveryDate2" name="deliveryDate" required><br><br><br>
			<button type="submit" class="btn-popup-2">SUBMIT</button>
		</form>
	</div>
</div> 

<!--End of HTML for setting shipping fee and estimated date of delivery-->


<div class="main-body-content">
    <div class="content-box-5">
		<a href="{{url('admin-manageOrders')}}">&laquo; BACK</a>
	</div>
	<div class="content-box-7">
		<div class="content-box-main-header" style="height:2.1rem;background-color:#e22f14;font-size:1.1rem;"><b>ORDER ID # {{$order->order_id}}</b></div><br>
		
        <div class="box-info-3">
			<p class="txt-checkout-content-1">
				<span class="txt-content-header-2">CUSTOMER NAME</span><br>
				{{$order->firstname}} {{$order->lastname}}
			</p>
		</div>

        <div class="box-info-3">
			<p class="txt-checkout-content-1">
				<span class="txt-content-header-2">USERNAME</span><br>
				{{$order->username}}
			</p>
		</div>

        <div class="box-info-3">
			<p class="txt-checkout-content-1">
				<span class="txt-content-header-2">GENDER</span><br>
				{{$order->gender}}
			</p>
		</div>
        
        <div class="box-info-3">
			<p class="txt-checkout-content-1">
				<span class="txt-content-header-2">EMAIL ADDRESS</span><br>
				{{$order->email}}
			</p>
		</div>

        <div class="box-info-3">
			<p class="txt-checkout-content-1">
				<span class="txt-content-header-2">CONTACT NUMBER</span><br>
				{{$order->contactnumber}}
			</p>
		</div>

        

        <br>
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
                       {{ \Carbon\Carbon::parse($order->delivery_date)->format('F d, Y') }}
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
                        <button onclick="window.location.href='readyForOnsitePayment/{{$order->id}}';" class="btn-available-action">Set Order Status to <b>READY FOR ONSITE PAYMENT</b></button>
                        <button onclick="window.location.href='cancelorder/{{$order->id}}';" class="btn-available-action">Cancel Order</button>
                        @break
                    
                    @case("Ready for Onsite Payment")
                        <button onclick="window.location.href='delivered/{{$order->id}}';" class="btn-available-action">Set Order Status to <b>DELIVERED</b></button>
                        <button onclick="window.location.href='pending/{{$order->id}}';" class="btn-available-action">Set Order Status back to <b>PENDING</b></button>
                        <button onclick="window.location.href='cancelorder/{{$order->id}}';" class="btn-available-action">Cancel Order</button>
						<a href="{{ route('admin-viewReceipt', ['id' => $order->id]) }}" target="_blank" class="btn-available-action">View Bill</a>
                        @break
                    
                    @case("Delivered")
						<a href="{{ route('admin-viewReceipt', ['id' => $order->id]) }}" target="_blank" class="btn-available-action">View Receipt</a>
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
                        <button class="btn-available-action" onclick="setDeliveryFee()">Set Delivery Fee</button>
                        <button onclick="window.location.href='cancelorder/{{$order->id}}';" class="btn-available-action">Cancel Order</button>
                        @break
                    
                    @case("Processing")
                        @if($order->delivery_date === null)
                            <button class="btn-available-action" onclick="setDateOfDelivery()">Set Estimated Date of Delivery</button>
                        @else
                            <button class="btn-available-action" onclick="editDateOfDelivery()">Edit Estimated Date of Delivery</button>
                        @endif
                            <button onclick="window.location.href='shipped/{{$order->id}}';" class="btn-available-action">Set Order Status to <b>SHIPPED</b></button>
                            <button onclick="window.location.href='cancelorder/{{$order->id}}';" class="btn-available-action">Cancel Order</button>
                        @break
                    
                    @case("Shipped")
                        <button onclick="window.location.href='delivered/{{$order->id}}';" class="btn-available-action">Set Order Status to <b>DELIVERED</b></button>
                        <button class="btn-available-action" onclick="editDateOfDelivery()">Edit Estimated Date of Delivery</button>
                        <button onclick="window.location.href='processing/{{$order->id}}';" class="btn-available-action">Set Order Status Back to <b>PROCESSING</b></button>
                        @break

                    @case("Delivered")
					<a href="{{ route('admin-viewReceipt', ['id' => $order->id]) }}" target="_blank" class="btn-available-action">View Receipt</a>
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
@include ('../footers.admin-footer')
<script>
const blackScreen2 = document.getElementById('black-screen-3');
const deliveryFeePopup = document.getElementById('deliveryFeePopup');
const dateOfDeliveryPopup = document.getElementById('dateOfDeliveryPopup');
const dateOfDeliveryPopup2 = document.getElementById('dateOfDeliveryPopup2');

//This is to ensure that if admin will set a delivery date on the order, it can only pick its current day and the future dates..
let today = new Date().toISOString().split('T')[0];
document.getElementById('deliveryDate').min = today;
document.getElementById('deliveryDate2').min = today;

function setDeliveryFee(){
	blackScreen2.classList.toggle('fade-in-2');
	deliveryFeePopup.style.display = 'block';
	dateOfDeliveryPopup.style.display = 'none';
}

function setDateOfDelivery(){
	blackScreen2.classList.toggle('fade-in-2');
	deliveryFeePopup.style.display = 'none';
    dateOfDeliveryPopup2.style.display = 'none';
	dateOfDeliveryPopup.style.display = 'block';
}

function editDateOfDelivery(){
	blackScreen2.classList.toggle('fade-in-2');
	deliveryFeePopup.style.display = 'none';
    dateOfDeliveryPopup.style.display = 'none';
	dateOfDeliveryPopup2.style.display = 'block';
}

function closeDeliveryFeePopup(){
	blackScreen2.classList.toggle('fade-in-2');
	deliveryFeePopup.style.display ='none';
}

function closeDateOfDeliveryPopup(){
	blackScreen2.classList.toggle('fade-in-2');
	dateOfDeliveryPopup.style.display = 'none';
}

function closeDateOfDeliveryPopup2(){
	blackScreen2.classList.toggle('fade-in-2');
	dateOfDeliveryPopup2.style.display = 'none';
}
</script>
</body>
</html>