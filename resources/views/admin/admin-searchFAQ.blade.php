@include('../headers.admin-header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage FAQs | Hangry</title>
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
    Manage FAQs<br>
    <button class="btn-action-general-2" onclick="window.location.href='{{url('admin-addFAQ')}}';">+ Add New FAQ</button>
</div>

<div class="div-for-searchbar">
    <form action="{{route('admin-searchfaq')}}" method="get">
        <input id="searchfaq" class="searchbar-2" type="text" name="searchfaq" placeholder = "Search a Question..">
		<button type="submit" class="btn-search-icon"><img src="icons/search-icon-red.svg" alt="" class="search-icon"></button>
    </form>
</div>


@if($faqs->isEmpty())
  <div class="div-for-no-items-found">
      <img src="{{asset('icons/three-dots-red.svg')}}" alt="" style="margin-top:2rem;height:5rem;width:5rem;"><br>
      No FAQ was found
  </div>
  <div style="height:1rem;width:100%;"></div>
@else
  <div class="div-for-general-table">
  <table class="general-table">

    <tr>
      <th style="text-align:left;">Frequently Asked Question</th>
      <th style="text-align:left;">Answer</th>
      <th width="8%">Actions</th>
    </tr>

  @foreach($faqs as $faq)
    <tr>
      <td style="text-align:left;">{{$faq->question}}</td>
      <td style="text-align:left;">{{$faq->answer}}</td>
      <td>
        <button class="btn-action-general-3" onclick="window.location.href='{{url('admin-manageFAQ/edit/'.$faq->id)}}';">
          <img src="../icons/edit-orange-icon.svg" class="btn-icons-3">
          <p class="position-absolute-message-3 edit-msg-2">Edit</p>
        </button>
        <button class="btn-action-general-3" onclick="window.location.href='{{url('admin-manageFAQ/remove/'.$faq->id)}}';">
          <img src="../icons/trash-orange-icon.svg" class="btn-icons-3">
          <p class="position-absolute-message-3">Delete</p>
        </button>
      </td>
    </tr>
  @endforeach

  </table>
  </div>
    
  <!-- For pagination of faqs below -->
  {{$faqs->links()}}
  <div style="height:1rem;width:100%;margin-top:13rem;"></div>
@endif

@include ('../footers.admin-footer')
</body>
</html>
