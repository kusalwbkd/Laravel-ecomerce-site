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
			  <h4 class="box-title">Add Product </h4>

			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">

				<div class="col">
		<form method="post" action="{{route('product.store')}}" enctype="multipart/form-data" >
		 	@csrf
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
				<option value="{{$brand->id}}">{{$brand->brand_name}}</option>
			  
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
			  
				<option value="{{$category->id}}">{{$category->category_name}}</option>
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
				<input type="text" name="product_name" class="form-control" value="{{ old('product_name_en')}}"> 
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
				<input type="text" name="product_code" class="form-control"  value="{{ old('product_code')}}"> 
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
				<input type="text" name="product_qty" class="form-control" value="{{ old('product_qty')}}"> 
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
				<input type="text" name="product_tags" data-role="tagsinput" placeholder="add tags" class="form-control" value="{{ old('product_tags')}}">

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
				<input type="text" name="product_color"  data-role="tagsinput" placeholder="add tags" value="Red,Blue,Black,White" class="form-control">
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
				<input type="text" name="selling_price" class="form-control" value="{{ old('selling_price')}}"> 
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
	<input type="text" name="discount_price"  class="form-control">
@error('discount_price') 
<span class="text-danger">{{ $message }}</span>
@enderror
 </div>
</div>

		</div> <!-- end 4th row  -->
</div>





<div class="row">
	
<div class="col-md-6">
<div class="form-group">
<h5>Main Thambnail <span class="text-danger">*</span></h5>
<div class="controls">
			<input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)">
           @error('product_thambnail') 
	          <span class="text-danger">{{ $message }}</span>
	       @enderror
	       <img src="" id="mainThmb">
</div>
</div>
</div>


<div class="col-md-6">

<div class="form-group">
			<h5>Multiple Image <span class="text-danger">*</span></h5>
<div class="controls">
	 <input type="file" name="multi_img[]" class="form-control" multiple="" id="multiImg" onChange="previewImages(this)">
     @error('multi_img') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror
<div class="row" id="preview_img"></div>

</div>
</div>

</div> <!-- end col md 4 -->

</div> <!-- end 6th row  -->


<div class="row"> <!-- start 7th row  -->
<div class="col-md-12">

<div class="form-group">
			<h5>Specifications<span class="text-danger">*</span></h5>
			<div class="controls">
				<textarea name="specifications" id="specifications" class="form-control" ></textarea>
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
				<textarea name="long_descp" id="long_descp" rows="10" cols="80" class="form-control" >Long Description English</textarea>
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
				<input type="checkbox" id="checkbox_2" name="hot_deals" value="1">
				<label for="checkbox_2">Hot Deals</label>
			</fieldset>
			<fieldset>
				<input type="checkbox" id="checkbox_3" name="featured" value="1">
				<label for="checkbox_3">Featured</label>
			</fieldset>
		</div>
	</div>
</div>



<div class="col-md-6">
	<div class="form-group">
		 
		<div class="controls">
			<fieldset>
				<input type="checkbox" id="checkbox_4" name="special_offer" value="1">
				<label for="checkbox_4">Special Offer</label>
			</fieldset>
			<fieldset>
				<input type="checkbox" id="checkbox_5" name="special_deals" value="1">
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
<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Product">
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
	  </div>
<script>
	  tinymce.init({
    selector: 'textarea#specifications, textarea#long_descp',
    height: 300,
    plugins: 'lists',
    toolbar: 'bold italic numlist bullist',
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

const previewImages = (input) => {
  const previewDiv = document.getElementById("preview_img");
  previewDiv.innerHTML = "";

  if (input.files && input.files.length > 0) {
    Array.from(input.files).forEach((file) => {
      const reader = new FileReader();

      reader.onload = (e) => {
        const img = document.createElement("img");
        img.src = e.target.result;

        img.classList.add("preview-image");

        previewDiv.appendChild(img);


      };



      reader.readAsDataURL(file);
    });
  }
};


</script>
@endsection 