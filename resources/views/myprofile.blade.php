@include ('headers.customer-header')
<!DOCTYPE html>
<html>
    <head>
        <title>My Profile | Hangry</title>
    </head>
<body class="orange-background-admin">
<div class="main-body-content-2 orange-background-admin" style="padding-top:3rem;">
    <div class="dashboard-header">
        @if(Auth::user()->profile_photo_path == null)
            <img src="{{asset('images/default-userpic.jpg')}}" class="myprofile-picture">
        @else
            <img src="{{asset('storage/'.Auth::user()->profile_photo_path)}}" class="myprofile-picture">
        @endif
        <h1><b>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</b></h1><br>
        <a href="{{route('profile.show')}}">EDIT PROFILE</a>
        <br><br>
    </div>
    <div class="profile-section">
        <div class="box-info-1 border-red">
            FIRST NAME<br>
            <span class="txt-box-info">
                {{Auth::user()->firstname}}
            </span>
        </div>

        <div class="box-info-1 border-red">
            LAST NAME<br>
            <span class="txt-box-info">
                {{Auth::user()->lastname}}
            </span>
        </div>

        <div class="box-info-1 border-red">
            GENDER<br>
            <span class="txt-box-info">
                {{Auth::user()->gender}}
            </span>
        </div>

        <div class="box-info-1 border-red">
            USERNAME<br>
            <span class="txt-box-info">
                {{Auth::user()->username}}
            </span>
        </div>

        <div class="box-info-1 border-red">
            CONTACT NUMBER<br>
            <span class="txt-box-info">
                {{Auth::user()->contactnumber}}
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
                {{Auth::user()->address}}
            </span>
        </div>

        <div class="box-info-1-v2 border-red">
            EMAIL ADDRESS<br>
            <span class="txt-box-info-email">
                {{Auth::user()->email}}
            </span>
        </div>
        
        <br><br><br><br>
    </div>
</div>
@include ('footers.footer')
</body>
</html>