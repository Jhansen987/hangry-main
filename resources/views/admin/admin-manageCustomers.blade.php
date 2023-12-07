@include('../headers.admin-header')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Customers | Hangry</title>
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
    Manage Customers<br>
</div>
@if($users->isEmpty())
  <div class="div-for-no-items-found">
      <img src="{{asset('icons/three-dots-red.svg')}}" alt="" style="margin-top:2rem;height:5rem;width:5rem;"><br>
      You have no announcements in the website.
  </div>
@else
<div class="main-body-content">
    <div class="myorders-section">

    @foreach($users as $user)
        <div class="box-customer">
            @if($user->profile_photo_path == null)
                <img src="{{asset('images/default-userpic.jpg')}}" class="box-customer-profile-pic">
            @else
                <img src="{{asset('storage/'.$user->profile_photo_path)}}" alt="" class="box-customer-profile-pic">
            @endif
            <p class="box-customer-username">
                <br><br>
                {{$user->username}}
            </p><br>
            <p class="box-order-txt-subheader">
                Customer Name<br>
                <span class="box-order-txt-info">{{$user->firstname}} {{$user->lastname}}</span>
            </p>

            @if($user->account_status == 'active')
                <p class="account-status-label green-txt">ACTIVE</p>
            @else
                <p class="account-status-label red-txt">BLOCKED</p>
            @endif
            <button class="btn-view-customer" onclick="window.location.href='{{url('admin-viewCustomer/'.$user->id)}}';">VIEW CUSTOMER</button>
        </div>
    @endforeach
    <!-- For pagination of customers -->
    {{$users->links()}}
    </div>
</div>
@endif

<div style="height:1rem;width:100%;margin-top:12rem;"></div>
@include ('../footers.admin-footer')
</body>
</html>
