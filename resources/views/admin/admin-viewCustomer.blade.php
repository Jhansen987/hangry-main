@include ('../headers.admin-header')
<!DOCTYPE html>
<html>
    <head>
        <title>{{$user->firstname}}'s Profile' | Hangry</title>
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

<div class="main-body-content-2 orange-background-admin" style="padding-top:3rem;">
    <div class="dashboard-header">
        @if($user->profile_photo_path == null)
            <img src="{{asset('images/default-userpic.jpg')}}" class="myprofile-picture">
        @else
            <img src="{{asset('storage/'.$user->profile_photo_path)}}" class="myprofile-picture">
        @endif
        <h1><b>{{$user->firstname}} {{$user->lastname}}</b></h1><br>
        
        @if($user->account_status == 'active')
            <h2 style="font-size:1.3rem;font-weight:bold;">Status: <span class="green-txt">ACTIVE</span></h2>
            <button onclick="window.location.href='blockCustomer/{{$user->id}}';" class="btn-available-action">BLOCK</button><br>
        @else
        <h2 style="font-size:1.3rem;font-weight:bold;">Status: <span class="red-txt">BLOCKED</span></h2>
            <button onclick="window.location.href='unblockCustomer/{{$user->id}}';" class="btn-available-action">UNBLOCK</button><br>
        @endif
    </div>
    <div class="profile-section">
        <div class="box-info-1 border-red">
            FIRST NAME<br>
            <span class="txt-box-info">
                {{$user->firstname}}
            </span>
        </div>

        <div class="box-info-1 border-red">
            LAST NAME<br>
            <span class="txt-box-info">
                {{$user->lastname}}
            </span>
        </div>

        <div class="box-info-1 border-red">
            GENDER<br>
            <span class="txt-box-info">
                {{$user->gender}}
            </span>
        </div>

        <div class="box-info-1 border-red">
            USERNAME<br>
            <span class="txt-box-info">
                {{$user->username}}
            </span>
        </div>

        <div class="box-info-1 border-red">
            CONTACT NUMBER<br>
            <span class="txt-box-info">
                {{$user->contactnumber}}
            </span>
        </div>

        <div class="box-info-1 border-red">
            COUNTRY<br>
            <span class="txt-box-info">
                Philippines
            </span>
        </div>

        <div class="box-info-1-v2 border-red">
             HOME ADDRESS<br>
            <span class="txt-box-info">
                {{$user->address}}
            </span>
        </div>

        <div class="box-info-1-v2 border-red">
            EMAIL ADDRESS<br>
            <span class="txt-box-info-email">
                {{$user->email}}
            </span>
        </div>
        
        <br><br><br><br>
    </div>
</div>
@include ('../footers.admin-footer')
</body>
</html>