@include ('headers.customer-header')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menu | Hangry</title>
        <link rel="stylesheet" href="css/style-main.css">
    </head>
<body>
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

    <div class="home-title-header-1" style="color:#ed6a00;">
        Our Menus
    </div>
    <div class="home-title-subheader-1">
        International Cuisine Inspired Restaurant
    </div>

    <div class="div-for-searchbar">
        <input id="searchproduct" class="searchbar" type="text" name="searchproduct" placeholder = "Search a product..">
		<button class="btn-search-icon"><img src="icons/search-icon-yellow.svg" alt="" class="search-icon"></button>
    </div>

    <div class="menu-section">

        <!-- Generate the "box-menu" div for every menu in database -->
    @foreach($products as $product)
        <div class="box-menu">
            <div class="menu-table">
                <div class="div-menu-image">
                    <img src="{{asset('storage/'.$product->product_image_path)}}" alt="" class="menu-image">
                </div>
                <div class="div-menu-info">
                    <p class="menu-name">
                        {{$product->product_name}}
                    </p>
                    <p class="menu-price">Php {{$product->price}}</p>
                    @if($product->stocks == 0)
                        <p class="menu-status">OUT OF STOCK</p><br>
                    @endif
                    <!-- <button class="btn-menu-1">ADD TO CART</button>-->
                    <button class="btn-menu-1" onclick="window.location.href='{{url('viewproduct/'.$product->id)}}';">VIEW MENU</button>
                    <button class="btn-menu-1" onclick="window.location.href='{{url('cart/add/'.$product->id)}}';">ADD TO CART</button>
                </div>
            </div>
        </div>
    @endforeach

    </div>
</div>
@include ('footers.footer')
</body>
</html>