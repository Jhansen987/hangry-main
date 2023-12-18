<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta charset="ISO-8859-1">
	<title>Edit FAQ | Hangry</title>
	<link rel="stylesheet" href="{{asset('css/style-forms.css')}}">
</head>
<body class="orange-background-admin">
<div class="box-form-3">
    <div class="form-header">
        Edit FAQ
        <button class="btn-cancel" onclick="location.href='{{route('admin-manageFAQ')}}';">Cancel</button>
    </div>
    <form action="{{route('updateFAQ')}}" method = "POST">
        @csrf
        <input type="hidden" name="faqid" value="{{$faq->id}}">
        <label for="faqquestion"><b>Frequently Asked Question *</b></label><br>
		<input type="text" id="faqquestion" name="faqquestion" value="{{$faq->question}}" required><br>
        @error('faqquestion')
    	<div class="div-for-error">
    		<span class="error">{{ $message }}</span><br>
		</div>
		@enderror
        <label for="faqanswer"><b>Answer *</b></label><br>
		<textarea class="textarea-announcement" id="faqanswer" name="faqanswer" rows="5" cols="58" placeholder="Input answer here.." required>{{old('faqanswer',$faq->answer)}}</textarea>
        <input type="submit" class="btn-submit" value="Save Changes">
    </form>
</div>
</body>
</html>