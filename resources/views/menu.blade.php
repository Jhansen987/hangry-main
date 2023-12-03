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
                        <p class="menu-status">OUT OF STOCK</p>
                    @endif
                    <!-- <button class="btn-menu-1">ADD TO CART</button>-->
                    <button class="btn-menu-1" onclick="window.location.href='{{url('viewproduct/'.$product->id)}}';">VIEW MENU</button>
                    <button class="btn-menu-1" onclick="window.location.href='#';">ADD TO CART</button>
                </div>
            </div>
        </div>
    @endforeach

    </div>
</div>
@include ('footers.footer')
</body>
</html>