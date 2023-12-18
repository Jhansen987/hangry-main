<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta charset="ISO-8859-1">
	<title>Edit Menu | Hangry</title>
	<link rel="stylesheet" href="{{asset('css/style-forms.css')}}">
</head>
<body>

<div class="box-form-1">
    <div class="form-header">
        Edit Menu
        <button class="btn-cancel" onclick="location.href='{{url('admin-manageProducts')}}';">Cancel</button>
    </div>
    <form action="{{url('admin-editProduct/update/'.$product->id)}}" method = "POST" enctype="multipart/form-data">
        @csrf   

		<img src="{{asset('storage/'.$product->product_image_path)}}" alt="" class="current-product-pic">
        <br>
		<label for="menuImage"><b>New Menu Image <span class="small-form-txt">( jpg / jpeg / png )</span></b></label><br>
        <div style="text-align:left;margin-left:1rem;">
		<input type="file" id="menuImage" name="menuImage"><br><br>
		<input type="hidden" name="currentMenuImage" value="{{$product->profile_image_path}}">
        </div>
		@error('menuImage')
    	<div class="div-for-error">
    		<span class="error">{{ $message }}</span><br>
		</div>
		@enderror
			
		<label for="menuName"><b>Menu Name *</b></label><br>
		<input type="hidden" id="originalMenuName" name="originalMenuName" value="{{$product->product_name}}"><br>
		<input type="text" id="menuName" name="menuName" value="{{$product->product_name}}" required><br>
		
		@error('menuName')
		<div class="div-for-error">
    		<span class="error">{{ $message }}</span><br>
		</div>
		@enderror

		<label for="menuPrice"><b>Price *</b></label><br>
		<input type="number" min="0" step="any" id="menuPrice" name="menuPrice" value="{{$product->price}}" required><br>
		
		@error('menuPrice')
    	<div class="div-for-error">
    		<span class="error">{{ $message }}</span><br>
		</div>
		@enderror

		<label for="menuStock"><b>Number of Stocks Available *</b></label><br>
		<input type="number" value="{{$product->stocks}}" min="0" step="1" oninput="validity.valid||(value='');" id="menuStock" name="menuStock" required><br>
		
		@error('menuStock')
    	<div class="div-for-error">
    		<span class="error">{{ $message }}</span><br>
		</div>
		@enderror

		<label for="menuDescription"><b>Menu Description *</b></label><br>
		<textarea id="menuDescription" name="menuDescription" rows="5" cols="58">{{old('menuDescription',$product->description)}}</textarea>
		
		@error('menuDescription')
    	<div class="div-for-error">
    		<span class="error">{{ $message }}</span><br>
		</div>
		@enderror
		

		<!-- <div class="error-container"><p class="errorMessage">The menu already exists.</p></div> -->
		<input type="submit" class="btn-submit" value="Save Changes">
    </form>
</div>
</body>
</html>