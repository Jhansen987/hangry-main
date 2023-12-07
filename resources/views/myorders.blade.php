@include('headers.customer-header')
<!DOCTYPE html>
<html>
    <head>
        <title>My Orders | Hangry</title>
    </head>
<body class="orange-background">
<div class="main-body-content">
    <div class="home-title-header-2">MY ORDERS</div>
    
    <div class="div-for-searchbar">
        <input id="searchorderID" class="searchbar" type="text" name="searchorderID" placeholder = "Search Order ID..">
		<button class="btn-search-icon"><img src="icons/search-icon-yellow.svg" alt="" class="search-icon"></button>
    </div><!--hdsadsasjhdsahj-->

    <div class="myorders-section">
    @foreach($orders as $order)
        <div class="box-order">
            <p class="box-order-id">
                ORDER ID<br>{{$order->order_id}}
            </p>
            <p class="box-order-txt-subheader">
                Date Ordered<br>
                <span class="box-order-txt-info">{{$order->created_at->format('F d, Y')}}</span>
                <span class="box-order-txt-info" style="margin-top:-1.3rem;">{{$order->created_at->format('g:i a')}}</span>
            </p>
            <p class="box-order-txt-subheader">
                Mode of Payment<br>
                <span class="box-order-txt-info">{{$order->payment_method}}</span>
            </p>
            <p class="box-order-txt-subheader">
                Price to Pay<br>
                <span class="box-order-txt-info">&#8369 {{$order->grand_total}}</span>
            </p>
            <p class="box-order-txt-subheader">
                Order Status<br>
                <span class="box-order-txt-info">{{$order->order_status}}</span>
            </p>

            <p class="box-order-txt-subheader">
                Payment Status<br>
                <span class="box-order-txt-info">{{$order->payment_status}}</span>
            </p>
            <button class="btn-box-order" onclick="window.location.href='{{url('vieworder/'.$order->order_id)}}';">VIEW DETAILS</button>
        </div>
    @endforeach

    </div>
</div>

<!-- For pagination of products -->
{{$orders->links()}}

@include ('footers.footer')
</body>
</html>