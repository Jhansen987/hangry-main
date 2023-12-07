@include ('headers.customer-header')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{csrf_token()}}"> <!--Needed for Javascript AJAX form submissions-->
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
                    <p class="menu-price" style="color:red;"><b>&#8369 {{$product->price}}</b></p>

                    @if($product->stocks == 0)
                        <p class="menu-status">OUT OF STOCK</p><br>
                    @else
                        <button class="btn-menu-1 btn-add-to-cart" id="item[{{$product->id}}]" value="{{$product->id}}">ADD TO CART</button>
                    @endif
                    
                    <button class="btn-menu-1" onclick="window.location.href='{{url('viewproduct/'.$product->id)}}';">VIEW MENU</button> 
                </div>
            </div>
        </div>
    @endforeach

    </div>
</div>

<!-- For pagination of products -->
{{$products->links()}}

@include ('footers.footer')

<script> //to update all items in user's cart in a single click of a button.
    document.addEventListener('DOMContentLoaded', function() {
        var addToCartButtons = document.querySelectorAll('.btn-add-to-cart');

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