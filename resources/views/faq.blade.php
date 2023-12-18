@include ('headers.static-header') 

<!DOCTYPE html>
<html>
<head>
<title>FAQs | Hangry</title>
</head>
<body>
<div class="static-body-content">

	

	<div class="static-content-box">
		<div class="static-content-box-main-header">FREQUENTLY ASKED QUESTIONS</div><br>

		@if($faqs->isEmpty())
			<div class="div-for-nothing-message">
				<p class="nothing-message"><b>There is no Frequently Asked Question yet in the website.</b></p>
			</div>
			<br>
		@else
			@foreach($faqs as $faq)
			<p class="sub-header-text">{{$faq->question}}</p>
			<p class="static-long-text">{!! nl2br($faq->answer) !!}</p>
			@endforeach
		@endif
		
	</div>
</div>
@include ('footers.helpcenter-footer')
</body>
</html>