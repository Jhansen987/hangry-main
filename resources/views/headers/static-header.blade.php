 <!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta charset="ISO-8859-1">
	<link rel = "stylesheet" href="{{asset('css/style-static.css')}}">
	<script defer src="{{asset('js/static.js')}}"></script>
</head>
<body>
<div id="black-screen" class="black-screen"></div>
<nav>
<img src = "images/Hangry Logo.png" alt="" class="business-logo-static">
<p class="nav-header-txt">| Help Center</p>
<div class="div-nav-link">
	<ul class="ul-nav-link">
		<li><a href="{{url('faq')}}" class="underline-hover">FAQs</a></li>
		<li><a href="{{url('termsofservice')}}" class="underline-hover">Terms of Service</a></li>
		<li><a href="{{url('privacypolicy')}}" class="underline-hover">Privacy Policy</a></li>
	</ul>
</div>
<div class="div-hamburger-icon">
	<button class="btn-hamburger-icon" onClick="responsiveNav()"><img src = "icons/hamburger_icon.svg" class="btn-icons-image"></button>
</div>
</nav>

<div id="responsive-nav-menu" class="responsive-nav-menu">
	<a href="{{url('faq')}}">FAQs</a>
	<a href="{{url('termsofservice')}}">Terms of Service</a>
	<a href="{{url('privacypolicy')}}">Privacy Policy</a>
</div>
</body>
</html>