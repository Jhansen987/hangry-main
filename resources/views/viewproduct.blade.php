@include ('headers.customer-header')
<!DOCTYPE html>
<html>
    <head>
        <title>View Menu | Hangry</title>
        <meta name="csrf-token" content="{{csrf_token()}}">
    </head>
<body class="orange-background">
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
<br><br><br>
<div class="main-body-content">
    <div class="viewproduct-content-box-1">
		<div class="div-for-viewproduct-image-display"><!-- This is the div for the main image displayed in the page that can be zoomed in by your cursor upon hovering over it -->
			<img id="viewproduct-main-image" src="{{asset('storage/'.$product->product_image_path)}}" class="viewproduct-main-image">
		</div>
	</div>
	
	<div class="viewproduct-content-box-2">
		<br>
		<a href="{{url('/menu')}}" class="back-hyperlink">&#10094; BACK</a>
		<p class="txt-viewproduct-product-name">
			{{$product->product_name}}
		</p>
		<p class="txt-viewproduct-product-stock">STOCKS: {{$product->stocks}}</p>
		<div class="div-viewproduct-rating">
            @if($product->rating == 5)
			<ul>
				<li><img src="icons/star-fill.svg" class="icon-star"></li>
				<li><img src="icons/star-fill.svg" class="icon-star"></li>
				<li><img src="icons/star-fill.svg" class="icon-star"></li>
				<li><img src="icons/star-fill.svg" class="icon-star"></li>
                <li><img src="icons/star-fill.svg" class="icon-star"></li>
				<!-- <li><a href="#review">(39 Ratings)</a></li> -->
			</ul>

            @elseif($product->rating < 5 && $product->rating > 4)
            <ul>
				<li><img src="icons/star-fill.svg" class="icon-star"></li>
				<li><img src="icons/star-fill.svg" class="icon-star"></li>
				<li><img src="icons/star-fill.svg" class="icon-star"></li>
                <li><img src="icons/star-half.svg" class="icon-star"></li>
                <!-- <li><a href="#review">(39 Ratings)</a></li> -->
            </ul>

            @elseif($product->rating == 4)
            <ul>
				<li><img src="icons/star-fill.svg" class="icon-star"></li>
				<li><img src="icons/star-fill.svg" class="icon-star"></li>
				<li><img src="icons/star-fill.svg" class="icon-star"></li>
                <li><img src="icons/star-fill.svg" class="icon-star"></li>
                <!-- <li><a href="#review">(39 Ratings)</a></li> -->
            </ul>

            @elseif($product->rating < 4 && $product->rating > 3)
            <ul>
                <li><img src="icons/star-fill.svg" class="icon-star"></li>
				<li><img src="icons/star-fill.svg" class="icon-star"></li>
				<li><img src="icons/star-half.svg" class="icon-star"></li>
                <!-- <li><a href="#review">(39 Ratings)</a></li> -->
            </ul>

            @elseif($product->rating == 3)
            <ul>
                <li><img src="icons/star-fill.svg" class="icon-star"></li>
				<li><img src="icons/star-fill.svg" class="icon-star"></li>
				<li><img src="icons/star-fill.svg" class="icon-star"></li>
                <!-- <li><a href="#review">(39 Ratings)</a></li> -->
            </ul>

            @elseif($product->rating < 3 && $product->rating > 2)
            <ul>
                <li><img src="icons/star-fill.svg" class="icon-star"></li>
				<li><img src="icons/star-half.svg" class="icon-star"></li>
                <!-- <li><a href="#review">(39 Ratings)</a></li> -->
            </ul>

            @elseif($product->rating == 2)
            <ul>
                <li><img src="icons/star-fill.svg" class="icon-star"></li>
                <li><img src="icons/star-fill.svg" class="icon-star"></li>
                <!-- <li><a href="#review">(39 Ratings)</a></li> -->
            </ul>

            @elseif($product->rating < 2 && $product->rating > 1)
            <ul>
                <li><img src="icons/star-half.svg" class="icon-star"></li>
            </ul>

            @elseif($product->rating == 1)
            <ul>
                <li><img src="icons/star-fill.svg" class="icon-star"></li>
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
            @if($product->stocks > 0)
			<button class="btn-action-viewproduct" onclick="window.location.href='{{url('buynow-cart/'.$product->id)}}';">Buy Now</button>
			<button class="btn-action-viewproduct viewproduct-add-to-cart" id="item[{{$product->id}}]" value="{{$product->id}}">Add to Cart</button>
            @endif
		</div>
		<br>
		<p class="txt-viewproduct-header">PRODUCT DESCRIPTION</p><hr style="border:2px solid #6a6a69;">
		<p class="txt-viewproduct-product-description">
            {!! nl2br($product->description) !!}
		</p>
	</div>
    
    <!-- RATINGS AND REVIEWS ARE BELOW -->
    <!-- <div class="viewproduct-content-box-3">

    </div> -->
    
</div>
@include ('footers.footer')

<script> //to update all items in user's cart in a single click of a button.
    document.addEventListener('DOMContentLoaded', function() {
        var addToCartButtons = document.querySelectorAll('.viewproduct-add-to-cart');

        if(addToCartButtons){
            addToCartButtons.forEach( function(addToCartButton){
                addToCartButton.addEventListener('click', function() {

                    var chosenItem = addToCartButton.value;
                    console.log(chosenItem);
                    var url = '/cart/add/' + chosenItem;
                    console.log(url);
                    
                    var xhr = new XMLHttpRequest();
                    xhr.open('get', url);

                    //Get the CSRF token value..
                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    // Set CSRF token in request headers
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    var notificationTimer;
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            // Show the toast notification
                            var response = JSON.parse(xhr.responseText);
                            var toastContainerExists = document.querySelector('.toast-container');

                            if(!toastContainerExists){ // this will check if the toast container already currently exists so it no longer needs to create a new one...
                            var responseData = JSON.parse(xhr.responseText);
                            var successMessage = responseData.success;

                            // Create elements for the toast container
                            var toastContainer = document.createElement('div');
                            toastContainer.className = 'toast-container position-fixed top-0 p-3';
                            toastContainer.style.width = '100%';

                            var liveToast = document.createElement('div');
                            liveToast.id = 'liveToast';
                            liveToast.className = 'toast';
                            liveToast.style.margin = 'auto';
                            liveToast.style.backgroundColor = '#fff';
                            liveToast.setAttribute('role', 'alert');
                            liveToast.setAttribute('aria-live', 'assertive');
                            liveToast.setAttribute('aria-atomic', 'true');

                            var toastHeader = document.createElement('div');
                            toastHeader.className = 'toast-header';
                            toastHeader.style.backgroundColor = '#dbdadb';

                            var imgElement = document.createElement('img');
                            imgElement.src = '../icons/notification-gray-fill_icon.svg';
                            imgElement.className = 'rounded me-2';
                            imgElement.alt = '...';

                            var smallElement = document.createElement('small');
                            smallElement.className = 'me-auto';
                            smallElement.style.color = '#5e5b5e';
                            smallElement.textContent = 'Notification';

                            var closeButton = document.createElement('button');
                            closeButton.type = 'button';
                            closeButton.className = 'btn-close';
                            closeButton.setAttribute('data-bs-dismiss', 'toast');
                            closeButton.setAttribute('aria-label', 'Close');

                            var toastBody = document.createElement('div');
                            toastBody.className = 'toast-body';

                            var spanElement = document.createElement('span');
                            spanElement.style.color = '#5e5b5e';
                            spanElement.textContent = successMessage;

                            // Construct the hierarchy of elements
                            toastHeader.appendChild(imgElement);
                            toastHeader.appendChild(smallElement);
                            toastHeader.appendChild(closeButton);

                            toastBody.appendChild(spanElement);

                            liveToast.appendChild(toastHeader);
                            liveToast.appendChild(toastBody);

                            toastContainer.appendChild(liveToast);

                            // Append the generated elements to the body or any other container
                            document.body.appendChild(toastContainer);

                            // Make the notification appear
                            var toastBootstrap = bootstrap.Toast.getOrCreateInstance(liveToast);
                            toastBootstrap.show();

                            notificationTimer = setTimeout(function() {
                                toastContainer.remove();
                            }, 6000); // remove the whole bootstrap notification container after 6 seconds..

                            }else{
                                clearTimeout(notificationTimer);

                                notificationTimer = setTimeout(function() {
                                    toastContainerExists.remove();
                                }, 6000); // remove the whole bootstrap notification container after 6 seconds..
                            }

                            // Play the notification sound.
                            const audio = new Audio("{{ asset('sounds/alert-sound.mp3') }}");
                            audio.play();
                            

                            
                            console.log(xhr.response);
                            // console.log('Inputted Quantities', xhr.response);
                        } else {
                            // Handle error response
                            console.log(xhr);
                            console.error('Request failed with status:', xhr.status);
                        }
                    };
                    xhr.onerror = function() {
                        // Handle network errors
                        console.error('Request failed');
                    };
                    xhr.send();
                });
            }); //end of foreach statement...

        } //end of if else statement if there is a button with 'btn-add-to-cart' class....
    });
</script>

</body>
</html>