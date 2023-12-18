@include('../headers.admin-header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders | Hangry</title>
</head>
<body class="orange-background-admin">
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

<div class="home-title-header-1 body-margin-top">
    Manage Orders<br>
</div>

<div class="div-for-searchbar">
    <form action = "{{route('searchorder')}}" method="get">
        <input id="searchorder" class="searchbar-2" type="text" name="searchorder" placeholder = "Search an Order ID..">
		    <button type="submit" class="btn-search-icon"><img src="icons/search-icon-red.svg" alt="" class="search-icon"></button>
    </form>
</div>


@if($orders->isEmpty())
  <div class="div-for-no-items-found">
      <img src="{{asset('icons/three-dots-red.svg')}}" alt="" style="margin-top:2rem;height:5rem;width:5rem;"><br>
      No Customer Orders have been Placed yet in your Website.
  </div>
  <div style="height:1rem;width:100%;"></div>
@else
<div class="div-for-general-table">
<table class="general-table">

  <tr>
    <th width="5%">Actions</th>
    <th width="8%">Order ID</th>
    <th width="15%">Date Ordered</th>
    <th width="12%">Customer Name</th>
    <th width="13%">Price to Pay</th>
    <th width="10%">Payment Method</th>
    <th width="11%">Order Status</th>
    <th width="11%">Payment Status</th>
    <th width="15%">Delivery Date</th>
  </tr>

  @foreach($orders as $order)

  <tr>
    <td>
        <button class="btn-action-general-3" onclick="window.location.href='{{url('admin-viewOrder/'.$order->order_id)}}';">
        <img src="../icons/eye-orange-icon.svg" class="btn-icons-3">
        <p class="position-absolute-message-2">View Details</p>
      </button>
    </td>
    <td style="color:red;"><b>{{$order->order_id}}</b></td>
    <td>
        {{$order->created_at->format('F d, Y')}}<br>
        {{$order->created_at->format('g:i a')}}
    </td>
    <td>{{$order->firstname}} {{$order->lastname}}</td>
    <td>Php {{$order->grand_total}}</td>
    <td>{{$order->payment_method}}</td>
    <td>{{$order->order_status}}</td>
    <td>{{$order->payment_status}}</td>
    <td>
        @if($order->delivery_date === null)
            None
        @else
            {{ \Carbon\Carbon::parse($order->delivery_date)->format('F d, Y') }}
        @endif
    </td>
  </tr>

  @endforeach

</table>
</div>
@endif
<!-- Pagination for customer orders -->
{{$orders->links()}}
<div style="height:1rem;width:100%;margin-top:10rem;"></div>
@include ('../footers.admin-footer')
</body>
</html>