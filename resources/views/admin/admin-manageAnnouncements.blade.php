@include('../headers.admin-header')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Announcements | Hangry</title>
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
    Manage Announcements<br>
    <button class="btn-action-general-2" onclick="window.location.href='{{url('admin-addAnnouncement')}}';">+ Add New Announcement</button>
</div>

@if($announcements->isEmpty())
  <div class="div-for-no-items-found">
      <img src="{{asset('icons/three-dots-red.svg')}}" alt="" style="margin-top:2rem;height:5rem;width:5rem;"><br>
      You have no announcements in the website.
  </div>
  <div style="height:1rem;width:100%;"></div>
@else
  <br><br>
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
      <div class="col-announcement-3">
          <button class="btn-action-general-1" onclick="window.location.href='{{route('admin-editAnnouncement',array('id' => $announcement->id))}}';">
              <img src="../icons/edit-orange-icon.svg" class="btn-icons">
              <p class="position-absolute-message-1 edit-msg">Edit</p>
          </button>
          <form action="{{route('deleteAnnouncement')}}" method="POST">
          @csrf
              <input type="hidden" id="announcement_id" name="announcement_id" value="{{$announcement->id}}">
              <button type="submit" class="btn-action-general-1">
                  <img src="../icons/trash-orange-icon.svg" class="btn-icons">
                  <p class="position-absolute-message-1">Delete</p>
              </button>
          </form>
      </div>
  </div>
  @endforeach
  
  <!-- For pagination of announcements -->
  {{$announcements->links()}}

  <div style="height:1rem;width:100%;margin-top:13rem;"></div>
@endif
@include ('../footers.admin-footer')
</body>
</html>
