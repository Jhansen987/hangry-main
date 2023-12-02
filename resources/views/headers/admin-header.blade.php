<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel = "stylesheet" href="../css/navheader.css">
    <link rel = "stylesheet" href="../css/style-main.css">
    <script defer src="../js/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>

<div id="black-screen" class="black-screen"></div>
<nav class="main-nav">
    <div class="div-account-username">
        <a href="#">
            <img src="../icons/user_icon.svg" class="header-icons-1">
            {{$user->username}}
        </a>
        <ul>
            <li><a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a></li>
            <form id="logout-form" action="{{route('logout')}}" method="POST">@csrf</form>
        </ul>
    </div>
    <div class="div-hamburger">
        <button class="btn-hamburger" onclick="responsiveNav()">
            <img src="../icons/hamburger_icon.svg" alt="" class="header-icons-1">
        </button>
    </div>

    <!-- BUSINESS LOGO -->
    <div class="div-business-logo">
        <a href="{{url('admin-home')}}">
            <img src="../images/Hangry Logo.png" alt="" class="business-logo">
        </a>
    </div>
    <div class="nav-links">
        <ul>
            <li><a href="{{url('admin-home')}}">HOME</a></li>
            <li>
                <a href="#">MANAGE
                    <img src="../icons/down-arrow-white-icon.svg" alt="" class="header-icons-2">
                </a>
                <ul>
                    <li><a href="{{route('admin-manageProducts')}}">Menus</a></li>
                    <li><a href="#">Orders</a></li>
                    <li><a href="#">Customers</a></li>
                    <li><a href="{{route('admin-manageAnnouncements')}}">Announcements</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
            </li>
            <li><a href="admin-about.php">ABOUT</a></li>
            <li>
                <a href="#">OTHERS
                    <img src="../icons/down-arrow-white-icon.svg" alt="" class="header-icons-2">
                </a>
                </a>
                <ul>
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
        <img src="../icons/user_icon-gray.svg" class="header-icons-1">
        {{$user->username}}
    </div>
    <ul>
        <li><a href="{{url('admin-home')}}">Home</a></li>   
        <li><a href="admin-about.php">About</a></li>
    </ul>
    <button id="mobile-subdropdown-btn-1" class="btn-mobile-nav-link" onclick="adminResponsiveSubDropdown1()">
        Manage
        <img src="../icons/down-arrow-icon-gray.svg" alt="" id="nav-arrow-1" class="mobile-nav-icon-1">
    </button>
    <div id="mobile-subdropdown-1" class="mobile-nav-subdropdown">
        <ul>
            <li><a href="{{route('admin-manageProducts')}}">Menus</a></li>
            <li><a href="#">Orders</a></li>
            <li><a href="#">Customers</a></li>
            <li><a href="{{route('admin-manageAnnouncements')}}">Announcements</a></li>
            <li><a href="#">FAQs</a></li>
        </ul>   
    </div>
    <button id="mobile-subdropdown-btn-2" class="btn-mobile-nav-link" onclick="adminResponsiveSubDropdown2()">
        Others
        <img src="../icons/down-arrow-icon-gray.svg" alt="" id="nav-arrow-2" class="mobile-nav-icon-1">
    </button>
    <div id="mobile-subdropdown-2" class="mobile-nav-subdropdown">
        <ul>
            <li><a href="{{url('privacypolicy')}}" target="_blank" rel="noopener noreferrer">Privacy Policy</a></li>
            <li><a href="{{url('termsofservice')}}" target="_blank" rel="noopener noreferrer">Terms of Service</a></li>
        </ul>   
    </div>
    <button class="btn-mobile-nav-link" onclick="document.getElementById('logout-form').submit();">Logout</button>
    <br><br><br>
</nav>
</body>
</html>