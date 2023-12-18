<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta charset="ISO-8859-1">
	<title>Edit Announcement | Hangry</title>
	<link rel="stylesheet" href="{{asset('css/style-forms.css')}}">
</head>
<body class="orange-background-admin">
<div class="box-form-3">
    <div class="form-header">
        Edit Announcement
        <button class="btn-cancel" onclick="location.href='{{url('admin-manageAnnouncements')}}';">Cancel</button>
    </div>
    <form action="{{route('updateAnnouncement')}}" method = "POST">
        @csrf
        <input type="hidden" id="announcement_id" name="announcement_id" value="{{$announcement->id}}">
        <label for="announcementContent"><b>Announcement Content *</b></label><br>
		<textarea class="textarea-announcement" id="announcementContent" name="announcementContent" rows="5" cols="58" placeholder="Input content of announcement here.." required>{{old('announcementContent',$announcement->announcement_content)}}</textarea>
        <input type="submit" class="btn-submit" value="Save Changes" name="btn_submit">
    </form>
</div>
</body>
</html>