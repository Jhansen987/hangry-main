<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta charset="ISO-8859-1">
	<link rel="stylesheet" href="{{asset('css/style-printBill.css')}}" media="screen,print">
	<title>Printer Friendly Receipt | Hangry</title>
</head>
<body>
<div class="bill-content">
<img src="{{asset('images/hangry-black-logo.png')}}" alt="" class="business-logo-printbill"><br><br>
	<p><b>ORDER ID:</b> {{$order->order_id}}</p>
	<p><b>Name:</b> {{$order->firstname}} {{$order->lastname}}</p>
	<p><b>Date Ordered:</b> {{ \Carbon\Carbon::parse($order->created_at)->format('F d, Y') }}</p>
	<p><b>Shipping Address:</b><br>
    {{$order->shipping_address}}
	</p>
	<p><b>Estimated Date of Delivery:</b> 
    @if($order->delivery_date === null)
    None
    @else
    {{ \Carbon\Carbon::parse($order->delivery_date)->format('F d, Y') }}
    @endif
    </p>
	<p><b>Mode of Payment:</b> {{$order->payment_method}}</p>
	<p><b>Order Status:</b> {{$order->order_status}}</p>
	<p><b>Payment Status:</b> {{$order->payment_status}}</p>
	
	<table class="myorders">
		<tr>
			<th>PRODUCT NAME</th>
			<th>QUANTITY</th>
			<th>PRICE</th>
		</tr>
		@foreach($orderedproducts as $orderedproduct)
		<tr>
			<td>{{$orderedproduct->product_name}}</td> <!-- product name -->
			<td class="txt-center">{{$orderedproduct->quantity}}</td> <!-- product quantity -->
			<td class="txt-center">PHP {{$orderedproduct->price}}</td> <!-- product price -->
		</tr>
        @endforeach
	</table>
	<br>
    <p><b>Subtotal:</b> &#8369 {{$order->subtotal}}</p>
	<p><b>Shipping Fee:</b> 
    @if($order->shipping_fee === null)
    &#8369 0.00
    @else
    &#8369 {{$order->shipping_fee}}
    @endif
    </p>
	<p><b>VAT:</b> &#8369 <?php echo number_format($vat,2) ?></p>
	<hr style="background-color:#000;">
	<p><b>GRAND TOTAL:</b> &#8369 {{$order->grand_total}}</p>
	<br>
</div>
</body>
</html>