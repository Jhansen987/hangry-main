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
        <div class="box-menu">
            <div class="menu-table">
                <div class="div-menu-image">
                    <img src="images/Savory Southwest Fiesta Bowl.png" alt="" class="menu-image">
                </div>
                <div class="div-menu-info">
                    <p class="menu-name">
                        Savory Southwest Fiesta Bowl
                    </p>
                    <p class="menu-price">Php 250.00</p>
                    <p class="menu-status">OUT OF STOCK</p>
                    <!-- <button class="btn-menu-1">ADD TO CART</button>-->
                    <button class="btn-menu-1" onclick="window.location.href='viewmenu.php';">VIEW MENU</button>
                </div>
            </div>
        </div>

        <div class="box-menu">
            <div class="menu-table">
                <div class="div-menu-image">
                    <img src="images/Tropical Mango Tango.png" alt="" class="menu-image">
                </div>
                <div class="div-menu-info">
                    <p class="menu-name">Tropical Mango Tango</p>
                    <p class="menu-price">Php 350.00</p>
                    <button class="btn-menu-1">ADD TO CART</button>
                    <button class="btn-menu-1" onclick="window.location.href='viewmenu.php';">VIEW MENU</button>
                </div>
            </div>
        </div>

        <div class="box-menu">
            <div class="menu-table">
                <div class="div-menu-image">
                    <img src="images/Asian Fusion Umami.png" alt="" class="menu-image">
                </div>
                <div class="div-menu-info">
                    <p class="menu-name">Asian Fusion Umami</p>
                    <p class="menu-price">Php 250.00</p>
                    <button class="btn-menu-1">ADD TO CART</button>
                    <button class="btn-menu-1" onclick="window.location.href='viewmenu.php';">VIEW MENU</button>
                </div>
            </div>
        </div>

        <div class="box-menu">
            <div class="menu-table">
                <div class="div-menu-image">
                    <img src="images/Spicy Thai Basil Delight.png" alt="" class="menu-image">
                </div>
                <div class="div-menu-info">
                    <p class="menu-name">Spicy Thai Basil Delight</p>
                    <p class="menu-price">Php 200.00</p>
                    <button class="btn-menu-1">ADD TO CART</button>
                    <button class="btn-menu-1" onclick="window.location.href='viewmenu.php';">VIEW MENU</button>
                </div>
            </div>
        </div>

        <div class="box-menu">
            <div class="menu-table">
                <div class="div-menu-image">
                    <img src="images/Mediterranean Mezze Medley Bowl.png" alt="" class="menu-image">
                </div>
                <div class="div-menu-info">
                    <p class="menu-name">Mediterranean Mezze Medley Bowl</p>
                    <p class="menu-price">Php 300.00</p>
                    <button class="btn-menu-1">ADD TO CART</button>
                    <button class="btn-menu-1" onclick="window.location.href='viewmenu.php';">VIEW MENU</button>
                </div>
            </div>
        </div>

        <div class="box-menu">
            <div class="menu-table">
                <div class="div-menu-image">
                    <img src="images/Zen Garden Delight.png" alt="" class="menu-image">
                </div>
                <div class="div-menu-info">
                    <p class="menu-name">Zen Garden Delight</p>
                    <p class="menu-price">Php 450.00</p>
                    <button class="btn-menu-1">ADD TO CART</button>
                    <button class="btn-menu-1" onclick="window.location.href='viewmenu.php';">VIEW MENU</button>
                </div>
            </div>
        </div>

    </div>
</div>
@include ('footers.footer')
</body>
</html>