@include('../headers.admin-header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | Hangry</title>
</head>
<body class="orange-background-admin">
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

<div class="home-title-header-1 body-margin-top">
    Manage Menus<br>
    <button class="btn-action-general-2" onclick="window.location.href='{{url('admin-addProduct')}}';">+ Add New Menu</button>
</div>
<div class="div-for-general-table">
<table class="general-table">

  <tr>
    <th width="8%">Actions</th>
    <th width="12%">Product Image</th>
    <th width="30%">Name</th>
    <th width="12%">Status</th>
    <th width="13%">Stocks</th>
    <th width="15%">Price</th>
    <th width="10%">Ratings</th>
  </tr>

@foreach($products as $product)
  <tr>
    <td>
    <button class="btn-action-general-3" onclick="window.location.href='{{url('admin-viewProduct/'.$product->id)}}';">
        <img src="../icons/eye-orange-icon.svg" class="btn-icons-3">
        <p class="position-absolute-message-1">View Product</p>
      </button>
      <button class="btn-action-general-3" onclick="window.location.href='{{url('admin-editProduct/'.$product->id)}}';">
        <img src="../icons/edit-orange-icon.svg" class="btn-icons-3">
        <p class="position-absolute-message-1">Edit</p>
      </button>
      <button class="btn-action-general-3">
        <img src="../icons/trash-orange-icon.svg" class="btn-icons-3">
        <p class="position-absolute-message-1">Delete</p>
      </button>
    </td>
    <td><img src = "{{asset('storage/'.$product->product_image_path)}}" alt="" class="small-prod-image"></td>
    <td>{{$product->product_name}}</td>
    <td>{{$product->status}}</td>
    <td>{{$product->stocks}}</td>
    <td>&#8369 {{$product->price}}</td>
    <td>{{$product->rating}}</td>
  </tr>
@endforeach
</table>
</div>
@include ('../footers.admin-footer')
</body>
</html>