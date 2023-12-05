@include ('../headers.admin-header')
<!DOCTYPE html>
<html>
    <head>
        <title>View Menu | Hangry</title>
    </head>
<body class="orange-background"> 
<div class="main-body-content">
    <br><br><br><br>
    <div class="viewproduct-content-box-1">
		<div class="div-for-viewproduct-image-display"><!-- This is the div for the main image displayed in the page that can be zoomed in by your cursor upon hovering over it -->
			<img id="viewproduct-main-image" src="{{asset('storage/'.$product->product_image_path)}}" class="viewproduct-main-image">
		</div>
	</div>
	
	<div class="viewproduct-content-box-2">
		<br>
		<a href="{{url('admin-manageProducts')}}" class="back-hyperlink">&#10094; BACK</a>
		<p class="txt-viewproduct-product-name">
			{{$product->product_name}}
		</p>
		<p class="txt-viewproduct-product-stock">STOCKS: {{$product->stocks}}</p>
		<div class="div-viewproduct-rating">
            @if($product->rating == 5)
			<ul>
				<li><img src="../icons/star-fill.svg" class="icon-star"></li>
				<li><img src="../icons/star-fill.svg" class="icon-star"></li>
				<li><img src="../icons/star-fill.svg" class="icon-star"></li>
				<li><img src="../icons/star-fill.svg" class="icon-star"></li>
                <li><img src="../icons/star-fill.svg" class="icon-star"></li>
				<!-- <li><a href="#review">(39 Ratings)</a></li> -->
			</ul>

            @elseif($product->rating < 5 && $product->rating > 4)
            <ul>
				<li><img src="../icons/star-fill.svg" class="icon-star"></li>
				<li><img src="../icons/star-fill.svg" class="icon-star"></li>
				<li><img src="../icons/star-fill.svg" class="icon-star"></li>
                <li><img src="../icons/star-half.svg" class="icon-star"></li>
                <!-- <li><a href="#review">(39 Ratings)</a></li> -->
            </ul>

            @elseif($product->rating == 4)
            <ul>
				<li><img src="../icons/star-fill.svg" class="icon-star"></li>
				<li><img src="../icons/star-fill.svg" class="icon-star"></li>
				<li><img src="../icons/star-fill.svg" class="icon-star"></li>
                <li><img src="../icons/star-fill.svg" class="icon-star"></li>
                <!-- <li><a href="#review">(39 Ratings)</a></li> -->
            </ul>

            @elseif($product->rating < 4 && $product->rating > 3)
            <ul>
                <li><img src="../icons/star-fill.svg" class="icon-star"></li>
				<li><img src="../icons/star-fill.svg" class="icon-star"></li>
				<li><img src="../icons/star-half.svg" class="icon-star"></li>
                <!-- <li><a href="#review">(39 Ratings)</a></li> -->
            </ul>

            @elseif($product->rating == 3)
            <ul>
                <li><img src="../icons/star-fill.svg" class="icon-star"></li>
				<li><img src="../icons/star-fill.svg" class="icon-star"></li>
				<li><img src="../icons/star-fill.svg" class="icon-star"></li>
                <!-- <li><a href="#review">(39 Ratings)</a></li> -->
            </ul>

            @elseif($product->rating < 3 && $product->rating > 2)
            <ul>
                <li><img src="../icons/star-fill.svg" class="icon-star"></li>
				<li><img src="../icons/star-half.svg" class="icon-star"></li>
                <!-- <li><a href="#review">(39 Ratings)</a></li> -->
            </ul>

            @elseif($product->rating == 2)
            <ul>
                <li><img src="../icons/star-fill.svg" class="icon-star"></li>
                <li><img src="../icons/star-fill.svg" class="icon-star"></li>
                <!-- <li><a href="#review">(39 Ratings)</a></li> -->
            </ul>

            @elseif($product->rating < 2 && $product->rating > 1)
            <ul>
                <li><img src="../icons/star-half.svg" class="icon-star"></li>
            </ul>

            @elseif($product->rating == 1)
            <ul>
                <li><img src="../icons/star-fill.svg" class="icon-star"></li>
            </ul>

            @else
                <ul>
                    <li><a href="#review">No Ratings</a></li>
                </ul>
            @endif
		</div>
		<p class="txt-viewproduct-product-price">
            &#8369 {{$product->price}}
		</p>
		<div class="div-viewproduct-1">
			<button class="btn-action-viewproduct" onclick="window.location.href='{{url('admin-editProduct/'.$product->id)}}';">Edit Product</button>
            <button class="btn-action-viewproduct">Delete Product</button>
		</div>
		<br>
		<p class="txt-viewproduct-header">Product Description</p><hr style="border:2px solid #6a6a69;">
		<p class="txt-viewproduct-product-description">
            {!! nl2br($product->description) !!}
		</p>
	</div>
    
    <!-- RATINGS AND REVIEWS ARE BELOW -->
    <!-- <div class="viewproduct-content-box-3">

    </div> -->
    
</div>
@include ('../footers.admin-footer')
</body>
</html>