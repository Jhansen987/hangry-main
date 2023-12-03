<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<link rel = "stylesheet" href="{{asset('css/navheader.css')}}">
    <link rel = "stylesheet" href="{{asset('css/style-main.css')}}">
    <script defer src="{{asset('js/header.js')}}"></script>
</head>
<body>

<div id="black-screen" class="black-screen"></div>
<div id="black-screen-2" class="black-screen-2">
    <div class="box-searchbar-popup">
        <div class="box-popup-header">
            <button class="btn-close-popup" onclick="searchbarPopup()">X</button>
        </div>
        <form action="menu.php" method="get">
            <input type="text" id="nav-searchproduct" name="nav-searchproduct" class="nav-searchbar" placeholder="Search a Product..">
            <input type="submit" class="btn-nav-search" value="Search">
        </form>
    </div>
</div>
<nav class="main-nav">
    <div class="div-account-username">
        <a href="#">
            <img src="{{asset('icons/user_icon.svg')}}" class="header-icons-1">
            {{Auth::user()->username}}
        </a>
        <ul>
            <li><a href="{{route('myprofile')}}">My Profile</a></li>
            <li><a href="{{url('myorders')}}">My Orders</a></li>
            <li><a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a></li>
            <form id="logout-form" action="{{route('logout')}}" method="POST">@csrf</form>
        </ul>
    </div>
    <div class="div-account-features">
        <button class="btn-search" onclick="searchbarPopup()">
            <img src="{{asset('icons/search-icon.svg')}}" class="header-icons-1">
        </button>
        <a href="{{url('cart')}}">
            <img src="{{asset('icons/cart_icon.svg')}}" class="header-icons-1">
        </a>
    </div>
    <div class="div-hamburger">
        <button class="btn-hamburger" onclick="responsiveNav()">
            <img src="{{asset('icons/hamburger_icon.svg')}}" alt="" class="header-icons-1">
        </button>
    </div>

    <!-- BUSINESS LOGO -->
    <div class="div-business-logo">
        <a href="{{url('home')}}">
            <img src="{{asset('images/Hangry Logo.png')}}" alt="" class="business-logo">
        </a>
    </div>
    <div class="nav-links">
        <ul>
            <li><a href="{{url('home')}}">HOME</a></li>
            <li><a href="{{url('menu')}}">MENU</a></li>
            <li><a href="{{url('about')}}">ABOUT</a></li>
            <li>
                <a href="#">OTHERS
                    <img src="{{asset('icons/down-arrow-white-icon.svg')}}" alt="" class="header-icons-2">
                </a>
                <ul>
                    <li><a href="{{url('faq')}}" target="_blank" rel="noopener noreferrer">FAQs</a></li>
                    <li><a href="{{url('privacypolicy')}}" target="_blank" rel="noopener noreferrer">Privacy Policy</a></li>
                    <li><a href="{{url('termsofservice')}}" target="_blank" rel="noopener noreferrer">Terms of Service</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<!-- MOBILE NAV MENU -->
<nav id="mobile-nav-menu" class="mobile-nav-menu">
    <div class="div-for-close-button">
        <button class="btn-close-nav" onclick="responsiveNav()">X</button>
    </div>
    <div class="mobile-div-username">
        <img src="{{asset('icons/user_icon-gray.svg')}}" class="header-icons-1">
        {{Auth::user()->username}}
    </div>
    <ul>
        <li><a href="{{url('home')}}">Home</a></li>
        <li><a href="{{url('menu')}}">Menu</a></li>
        <li><a href="{{url('about')}}">About</a></li>
        <li><a href="{{route('myprofile')}}">My Profile</a></li>
        <li><a href="{{url('cart')}}">My Cart</a></li>
        <li><a href="{{url('myorders')}}">My Orders</a></li>
    </ul>
    <button id="mobile-subdropdown-btn-1" class="btn-mobile-nav-link" onclick="responsiveSubDropdown1()">
        Others
        <img src="{{asset('icons/down-arrow-icon-gray.svg')}}" alt="" id="nav-arrow-1" class="mobile-nav-icon-1">
    </button>
    <div id="mobile-subdropdown-1" class="mobile-nav-subdropdown">
        <ul>
            <li><a href="{{url('faq')}}" target="_blank" rel="noopener noreferrer">FAQs</a></li>
            <li><a href="{{url('privacypolicy')}}" target="_blank" rel="noopener noreferrer">Privacy Policy</a></li>
            <li><a href="{{url('termsofservice')}}" target="_blank" rel="noopener noreferrer">Terms of Service</a></li>
        </ul>   
    </div>
    <button class="btn-mobile-nav-link" onclick="document.getElementById('logout-form').submit();">Logout</button>
    <br><br><br>
</nav>

</body>
</html>