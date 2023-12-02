<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta charset="ISO-8859-1">
	<title>Add New Announcement | Hangry</title>
	<link rel="stylesheet" href="css/style-forms.css">
</head>
<body class="orange-background-admin">
<div class="box-form-3">
    <div class="form-header">
        New Announcement
        <button class="btn-cancel" onclick="location.href='{{url('admin-manageAnnouncements')}}';">Cancel</button>
    </div>
    <form action="{{route('addAnnouncement')}}" method = "POST">
        @csrf   
        <label for="announcementContent"><b>Announcement Content *</b></label><br>
		<textarea class="textarea-announcement" id="announcementContent" name="announcementContent" rows="5" cols="58" placeholder="Input content of announcement here.." required></textarea>
        <input type="submit" class="btn-submit" value="Create" name="login">
    </form>
</div>
</body>
</html>