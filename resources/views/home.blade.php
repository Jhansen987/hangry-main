@include ('headers.customer-header')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Hangry</title>
    <!-- <link rel="stylesheet" href="css/style-main.css"> -->
</head>
<!-- <body style="background-color:#e9aa00;"> -->
<body style="background-color:#ffad2f;">
<div class="main-body-content">
    <div class="div-carousel" data-carousel>
		<ul data-slides>
			<li class="slide" data-active>
				<img src="images/carousel-1.png" class="carousel-img">
			</li>
		</ul>
		<div class="div-carousel-content-box">
            <img src="images/Hangry Logo.png" alt="" class="business-logo-2">
			<p class="txt-carousel">
            Dive into a world of flavors and elevate your dining experience with Hangry Restaurant. 
            Your next culinary adventure is just a click away!
			</p>
			<!-- <button class="btn-shop-now-1" onClick="window.location.href='menu.php'">BROWSE MENU</button> -->
            <button class="btn-shop-now-1" onClick="window.location.href='{{url('menu')}}'">BROWSE MENU</button>
        </div>
	</div>

    <div class="home-title-header-1">
        Announcements
    </div>
    <br>

    <!-- <div class="home-title-subheader-1">
        International Cuisine Inspired Restaurant
    </div> -->

    <!-- <div class="about-our-food-section">
        <img src="images/about.png" alt="" class="about-image">
        <div class="box-about-our-food-content">
            <p class="home-title-subheader-2">ABOUT OUR FOOD</p>
            <p class="txt-about-content">
            Our food comes from various cuisines 
            from all over the world. It’s a platform that caters to people who are 
            feeling both hungry and adventurous, allowing them to experience different 
            flavors delivered in the comfort of their homes.
            <br><br>
            “Let HANGRY satisfy your wanderlust for flavors, delivered right at your door.”
            </p>
        </div>
    </div> -->
    @foreach ($announcements as $announcement)
    <div class="box-announcement"> <!-- generate this div for every announcement made -->
        <div class="col-announcement-1">
            <img src="../icons/megaphone-orange-fill_icon.svg" class="table-icons">
        </div>
        <div class="col-announcement-2">
            <b style="margin-right:0.2rem;">{{$announcement->created_at->format('F d, Y')}}</b>
            <span class="announcement-time"><b>{{$announcement->created_at->format('g:i a')}}</b></span><br>
            {!! nl2br($announcement->announcement_content) !!}
        </div>
    </div>
    
    @endforeach
</div>
@include ('footers.footer')
</body>
</html>