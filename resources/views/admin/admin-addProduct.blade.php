<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta charset="ISO-8859-1">
	<title>Add New Menu | Hangry</title>
	<link rel="stylesheet" href="css/style-forms.css">
</head>
<body>
<div class="box-form-1">
    <div class="form-header">
        New Menu
        <button class="btn-cancel" onclick="location.href='{{url('admin-manageProducts')}}';">Cancel</button>
    </div>
    <form action="{{route('addProduct')}}" method = "POST" enctype="multipart/form-data">
        @csrf   
        <label for="menuImage"><b>Menu Image *</b></label><br>
        <div style="text-align:left;margin-left:1rem;">
		<input type="file" id="menuImage" name="menuImage" required><br><br>
        </div>
			
		<label for="menuName"><b>Menu Name *</b></label><br>
		<input type="text" id="menuName" name="menuName" required><br>
			
		<label for="menuPrice"><b>Price *</b></label><br>
		<input type="number" step="any" min="0" id="menuPrice" name="menuPrice" required><br>
			
		<label for="menuStock"><b>Number of Stocks Available *</b></label><br>
		<input type="number" min="0" step="1" oninput="validity.valid||(value='');" id="menuStock" name="menuStock" required><br>
				
		<label for="menuDescription"><b>Menu Description *</b></label><br>
		<textarea id="menuDescription" name="menuDescription" rows="5" cols="58"></textarea>

		<!-- <div class="error-container"><p class="errorMessage">The menu already exists.</p></div> -->
		<input type="submit" class="btn-submit" value="Create Menu">
    </form>
</div>
</body>
</html>