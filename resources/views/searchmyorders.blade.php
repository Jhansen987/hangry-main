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
        <form action = "{{route('searchorder')}}" method="get">
            <input id="searchorder" class="searchbar-2" type="text" name="searchorder" placeholder = "Search an Order ID..">
		    <button type="submit" class="btn-search-icon"><img src="icons/search-icon-red.svg" alt="" class="search-icon"></button>
        </form>
    </div>

    <div class="myorders-section">
@if($orders->isEmpty())
        <div class="div-for-no-items-found">
            <img src="{{asset('icons/three-dots-red.svg')}}" alt="" style="margin-top:2rem;height:5rem;width:5rem;"><br>
            No Orders Found
        </div>
        <div style="height:1rem;width:100%;"></div>
@else
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
@endif
    </div>
</div>

<!-- For pagination of products -->
{{$orders->links()}}

@include ('footers.footer')
</body>
</html>