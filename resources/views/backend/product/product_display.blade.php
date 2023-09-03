@extends('admin.admin_master')
@section('admin')

<style>
.preview-image{
	width:90px
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.4.2/tinymce.min.js" integrity="sha512-sWydClczl0KPyMWlARx1JaxJo2upoMYb9oh5IHwudGfICJ/8qaCyqhNTP5aa9Xx0aCRBwh71eZchgz0a4unoyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">View Product </h4>

			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">

				<div class="col">
		<form method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data" >
		 	@csrf
			

			 <input type="hidden" name="old_image" value="{{ $product->product_thambnail }}">
			 <input type="hidden" name="id" value="{{ $product->id }}">
			 <input type="hidden" name="multi_image" value="$multiImgs->photo_name">

					  <div class="row">
	<div class="col-12">	


		<div class="row"> <!-- start 1st row  -->
			<div class="col-md-4">

	 <div class="form-group">
	<h5>Brand Select <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="brand_id" class="form-control">
			<option value="" selected="" disabled="">Select Brand</option>
			@foreach($brands as $brand)
				<option value="{{$brand->id}}" {{$product->brand_id == $brand->id?'selected':''}}>
					{{$brand->brand_name}}
				</option>
			  
			 @endforeach  
		</select>
		
	 <span class="text-danger"></span>

	 </div>
		 </div>

			</div> <!-- end col md 4 -->

			<div class="col-md-4">

				 <div class="form-group">
	<h5>Category Select <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="category_id" class="form-control"  >
			<option value="" selected="" disabled="">Select Category</option>
			
				@foreach($categories as $category)
			  
				<option value="{{$category->id}}" {{$product->category_id == $category->id?'selected':''}}>
					{{$category->category_name}}
				</option>
			  @endforeach
		</select>
	 
	 <span class="text-danger"></span>
	
	 </div>
		 </div>

			</div> <!-- end col md 4 -->


			<div class="col-md-4">

				 <div class="form-group">
	<h5>SubCategory Select <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="subcategory_id" class="form-control"  >

			<option value="" selected="" disabled="">Select SubCategory</option>

			@foreach($subcategories as $subcategory)
			  
				<option value="{{$subcategory->id}}" {{$product->subcategory_id == $subcategory->id?'selected':''}}>
					{{$subcategory->subcategory_name}}
				</option>
			  @endforeach
		</select>

		
		@error('subcategory_id') 
	 <span class="text-danger"></span>
	 @enderror 
	 </div>
		 </div>

			</div> <!-- end col md 4 -->

		</div> <!-- end 1st row  -->


 <div class="row"> <!-- start 2nd row  -->
			<div class="col-md-4">

	 <div class="form-group">
	<h5>SubSubCategory Select <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="subsubcategory_id" class="form-control"  >
			<option value="" selected="" disabled="">Select SubSubCategory</option>

			@foreach($subsubcategories as $subsubcategory)
			  
				<option value="{{$subsubcategory->id}}" {{$product->subsubcategory_id == $subsubcategory->id?'selected':''}}>
					{{$subsubcategory->subsubcategory_name}}
				</option>
			  @endforeach
		</select>
		@error('subsubcategory_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div>

			</div> <!-- end col md 4 -->

			<div class="col-md-4">

      	<div class="form-group">
			<h5>Product Name English <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text" name="product_name" class="form-control" value="{{$product->product_name}}"> 
          @error('product_name') 
	       <span class="text-danger">{{ $message }}</span>
	      @enderror
			</div>
		</div>

			</div> <!-- end col md 4 -->

			
   
			<div class="col-md-4">

			<div class="form-group">
			<h5>Product Code <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text" name="product_code" class="form-control"  value="{{$product->product_code}}"> 
          @error('product_code') 
	       <span class="text-danger">{{ $message }}</span>
	      @enderror
			</div>
		</div>
      

			</div> 
			
		</div> <!-- end 2nd row  -->

	<div class="row"> <!-- start 3rd row  -->
			<div class="col-md-4">

			<div class="form-group">
			<h5>Product Quntity <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text" name="product_qty" class="form-control" value="{{$product->product_qty}}"> 
          @error('product_qty') 
	       <span class="text-danger">{{ $message }}</span>
	      @enderror
			</div>
		</div>

	   

			</div> <!-- end col md 4 -->

			<div class="col-md-4">

			<div class="form-group">
			<h5>Product Tag English <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text" name="product_tags" data-role="tagsinput" placeholder="add tags" class="form-control" value="{{$product->product_tags}}">

			</div>
		  @error('product_tags') 
	       <span class="text-danger">{{ $message }}</span>
	      @enderror
		</div>

			</div> <!-- end col md 4 -->


			<div class="col-md-4">

			<div class="form-group">
			<h5>Product Size English</span></h5>
			<div class="controls">
				<input type="text" name="product_size" data-role="tagsinput" placeholder="add tags" value="Large,Medium,Small" class="form-control"> 
          @error('product_size') 
	       <span class="text-danger">{{ $message }}</span>
	      @enderror
			</div>
		</div>

			</div> <!-- end col md 4 -->

		</div> <!-- end 3rd row  -->


		<div class="row"> <!-- start 4th row  -->
			
			<div class="col-md-4">

			<div class="form-group">
			<h5>Product Color English <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text" name="product_color"  data-role="tagsinput" placeholder="add tags" value="{{$product->product_color}}" class="form-control">
          @error('product_color') 
	       <span class="text-danger">{{ $message }}</span>
	      @enderror
			</div>
		</div>


			</div> <!-- end col md 4 -->


			<div class="col-md-4">
			<div class="form-group">
			<h5>Product Selling Price <span class="text-danger">*</span></h5>
			<div class="controls">
				<input type="text" name="selling_price" class="form-control" value="{{$product->selling_price}}"> 
          @error('selling_price') 
	       <span class="text-danger">{{ $message }}</span>
	      @enderror
			</div>


		    </div>
	     
			</div> 


			<div class="col-md-4">

<div class="form-group">
 <h5>Product Discount Price <span class="text-danger">*</span></h5>
 <div class="controls">
	<input type="text" name="discount_price"  class="form-control" value="{{$product->discount_price}}">
@error('discount_price') 
<span class="text-danger">{{ $message }}</span>
@enderror
 </div>
</div>

		</div> <!-- end 4th row  -->
</div>






    <div class="row"> <!-- start 7th row  -->
    <div class="col-md-12">

    <div class="form-group">
			<h5>Specifications<span class="text-danger">*</span></h5>
			<div class="controls">
				<textarea name="specifications" id="specifications" class="form-control" value="">{{$product->specifications}}</textarea>
				@error('specifications') 
	              <span class="text-danger">{{ $message }}</span>
	            @enderror
			</div>
    </div>

   </div> <!-- end col md 6 -->

   </div> <!-- end 7th row  -->

<div class="row"> <!-- start 8th row  -->
<div class="col-md-12">

<div class="form-group">
			<h5>Long Description English<span class="text-danger">*</span></h5>
			<div class="controls">
				<textarea name="long_descp"  id="long_descp" rows="10" cols="80" class="form-control" >{{$product->long_descp}}</textarea>
				@error('long_descp') 
	              <span class="text-danger">{{ $message }}</span>
	            @enderror
			</div>
</div>

</div> <!-- end col md 6 -->


</div> <!-- end 8th row  -->


<hr>
	<div class="row">

<div class="col-md-6">
			<div class="form-group">
			 
		<div class="controls">
			<fieldset>
				<input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{ $product->hot_deals == 1 ? 'checked': '' }}>
				<label for="checkbox_2">Hot Deals</label>
			</fieldset>
			<fieldset>
				<input type="checkbox" id="checkbox_3" name="featured" value="1" {{ $product->featured == 1 ? 'checked': '' }}>
				<label for="checkbox_3">Featured</label>
			</fieldset>
		</div>
	</div>
</div>



<div class="col-md-6">
	<div class="form-group">
		 
		<div class="controls">
			<fieldset>
				<input type="checkbox" id="checkbox_4" name="special_offer" value="1" {{ $product->special_offer == 1 ? 'checked': '' }}>
				<label for="checkbox_4">Special Offer</label>
			</fieldset>
			<fieldset>
				<input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ $product->special_deals == 1 ? 'checked': '' }}>
				<label for="checkbox_5">Special Deals</label>
			</fieldset>
		</div>
			</div>
		</div>
		 </div>



<!-- <div class="col-md-6">

	    <div class="form-group">
			<h5>Digital Product <span class="text-danger">pdf,xlx,csv*</span></h5>
			<div class="controls">
	 <input type="file" name="file" class="form-control" > 
	  
	 		 </div>
		</div>
				 
				
			</div> -->

						<div class="text-xs-right">
<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Product">
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->


		<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box bt-3 border-info">
				<div class="box-header">
					<h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
				</div>
				<form method="post" action="{{ route('update.product.image') }}" enctype="multipart/form-data">
				@csrf
					<div class="row row-sm container">
						@foreach($multiImgs as $img)
						<div class="col-md-3">
							<div class="card">
								<img src="{{ asset($img->photo_name) }}" class="card-img-top" style="height: 130px; width: 280px;">
								<div class="card-body">
									<h5 class="card-title">
									<a href="{{ route('product.multiimg.delete',$img->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i> </a>
									</h5>
									<p class="card-text">
										<div class="form-group">
											<label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
											<input class="form-control" type="file" name="multi_img[{{ $img->id }}]">
										</div>
									</p>
								</div>
							</div>
							</div><!--  end col md 3		 -->
							@endforeach
						</div>
						<div class="text-xs-right container">
							<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
						</div>
						<br><br>
					</form>
				</div>
			</div>
			</div> <!-- // end row  -->
		</section>



		<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box bt-3 border-info">
				<div class="box-header">
					<h4 class="box-title">Product Thambnail Image <strong>Update</strong></h4>
				</div>
				<form method="post" action="{{ route('update.product.thambnail') }}" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="id" value="{{ $product->id }}">
					<input type="hidden" name="old_img" value="{{ $product->product_thambnail }}">
					<div class="row row-sm container">
						<div class="col-md-3">
							<div class="card">
								<img src="{{ asset($product->product_thambnail) }}" class="card-img-top" style="height: 130px; width: 280px;">
								<div class="card-body">
									<p class="card-text">
										<div class="form-group">
											<label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
											<input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)"  >
											<img src="" id="mainThmb">
										</div>
									</p>
								</div>
							</div>
							</div><!--  end col md 3		 -->
						</div>
						<div class="text-xs-right container">
							<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
						</div>
						<br><br>
					</form>
				</div>
			</div>
		</div>
		</div> <!-- // end row  -->
	</section>
	<!-- ///////////////// End Start Thambnail Image Update Area ///////// -->

	  </div>
	  </div>
<script>
	  tinymce.init({
    selector: 'textarea#specifications, textarea#long_descp',
    height: 300,
    plugins: 'lists',
    toolbar: 'bold italic numlist bullist',

	textcolor_map: [
        '000000', 'Black',
        'FF0000', 'Red',
        '00FF00', 'Lime',
        '0000FF', 'Blue'
    ]
});



document.addEventListener("DOMContentLoaded",()=>{

const categorySelect = document.querySelector('select[name="category_id"]');

categorySelect.addEventListener("change",handleCategoryChange);
});


async function handleCategoryChange(e){


const category_id=e.target.value;

if(category_id){

	try {

		const response=await fetch("{{url('/category/subcategory/select') }}/" + category_id);
		const data=await response.json();

		const subcategorySelect = document.querySelector('select[name="subcategory_id"]');
		subcategorySelect.innerHTML = "";

		data.forEach(item=>{

			const option = document.createElement("option");
			option.value=item.id;

			option.text=item.subcategory_name;
			subcategorySelect.appendChild(option);
		})

	} catch (error) {

		console.log("error");
		
	}

}

else{


}

}




document.addEventListener("DOMContentLoaded",()=>{

const categorySelect = document.querySelector('select[name="subcategory_id"]');

categorySelect.addEventListener("change",handleSubcategoryChange);

});

async function handleSubcategoryChange(e){

const subcategory_id= e.target.value;

if(subcategory_id){

try {

	const response=await fetch("{{url('/category/sub-subcategory/')}}/"+subcategory_id);
	 
	const data= await response.json();

	const subsubcategorySelect = document.querySelector('select[name="subsubcategory_id"]');
	subsubcategorySelect.innerHTML = "";

	data.forEach(item=>{

	const option=document.createElement("option");

	option.value=item.id;

	option.text=item.subsubcategory_name;

	subsubcategorySelect.appendChild(option);

	});


	
}
 catch (error) {
	
}


}

else{


}

}

const mainThamUrl=(input)=>{

if(input.files && input.files[0]){
const reader=new FileReader();

reader.onload =(e)=>{

    const mainThmb = document.getElementById('mainThmb');

   // const mainThmb = document.getElementById('mainThmb');
      mainThmb.src = e.target.result;
      mainThmb.width = 80;
      mainThmb.height = 80;
};

reader.readAsDataURL(input.files[0]);

    }
}


// for selecting multiple images
$(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   



</script>
@endsection 