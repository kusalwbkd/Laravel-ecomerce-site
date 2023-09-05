@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('title')
My Checkout
@endsection


<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb --> 




<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->
	 
    <!-- panel-heading -->

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		

				<!-- guest-login -->			
			 <div class="col-md-6 col-sm-6 already-registered-login">
		 <h4 class="checkout-subtitle"><b>Shipping Address</b></h4>
					 
	<form class="register-form" action="{{route('checkout.store')}}" method="POST">
		@csrf


		<div class="form-group">
	    <label class="info-title" for="exampleInputEmail1"><b>Shipping Name</b>  <span>*</span></label>
	    <input type="text" name="shipping_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Full Name" value="{{ Auth::user()->name }}" required="">
	  </div>  <!-- // end form group  -->
	 

<div class="form-group">
	    <label class="info-title" for="exampleInputEmail1"><b>Email </b> <span>*</span></label>
	    <input type="email" name="shipping_email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Email" value="{{ Auth::user()->email }}" required="">
	  </div>  <!-- // end form group  -->


<div class="form-group">
	    <label class="info-title" for="exampleInputEmail1"><b>Phone</b>  <span>*</span></label>
	    <input type="number" name="shipping_phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Phone" value="{{ Auth::user()->phone }}" required="">
	  </div>  <!-- // end form group  -->


	  <div class="form-group">
	    <label class="info-title" for="exampleInputEmail1"><b>Post Code </b> <span>*</span></label>
	    <input type="text" name="post_code" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Post Code" required="">
	  </div>  <!-- // end form group  -->

	 
	 
				</div>	
				<!-- guest-login -->


 


				<!-- already-registered-login -->
				<div class="col-md-6 col-sm-6 already-registered-login">
					 

<div class="form-group">
	<h5><b>Province Select </b> <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="province_id" class="form-control" required="" >
			<option value="" selected="" disabled="">Select Provice</option>
		@foreach ($provinces as $province)
           <option value="{{$province->id}}">{{$province->name_en}}</option>	 
        @endforeach
 
			
		</select>
		@error('province_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div> <!-- // end form group -->


		 <div class="form-group">
	<h5><b>District Select</b>  <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="district_id" class="form-control" required="" >
			<option value="" selected="" disabled="">Select District</option>
			 
		</select>
		@error('district_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div> <!-- // end form group -->


		 <div class="form-group">
	<h5><b>State City</b> <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="city_id" class="form-control" required="" >
			<option value="" selected="" disabled="">Select City</option>
			 
		</select>
		@error('city_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div> <!-- // end form group -->
				 
					 
    
	  <div class="form-group">
	    <label class="info-title" for="exampleInputEmail1"><b>Street Name </b> <span>*</span></label>
	    <input type="text" name="street_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Street Name" required="">
	  </div>

         
	  <div class="form-group">
	    <label class="info-title" for="exampleInputEmail1"><b>House Name</b> <span>*</span></label>
	    <input type="text" name="house_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="House Name" required="">
	  </div>



					



					
				</div>	
				<!-- already-registered-login -->		

			</div>			
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>
<!-- End checkout-step-01  -->


					    
					  	
					</div><!-- /.checkout-steps -->
				</div>




				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Your Checkout Progress</h4>
		    </div>
		    <div class="">
				<ul class="nav nav-checkout-progress list-unstyled">

					@foreach ($cart_items as $item)
                        
                   
					<li> 
                    <strong>Product Name:</strong>{{$item['product']['product_name']}} <br/>
						<strong>Image: </strong>
						<img src="{{asset($item['product']['product_thambnail'])}}" style="height: 50px; width: 50px;">
					</li>

					<li> 
						<strong>Qty: </strong>{{$item->amount}}<br>
				

						 <strong>Color:</strong>{{$item->product_color}}  <br/>
						
						
					</li>
                   
<hr>
		 <li>
	@endforeach		 	



<strong>SubTotal: </strong> {{$amount_total}} <hr>



		 

		 </li>
 				 
					

				</ul>		
			</div>
		</div>
	</div>
</div> 
<!-- checkout-progress-sidebar --> </div>







	<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Select Payment Method</h4>
		    </div>


		    <div class="row">
		    	<div class="col-md-4">
		   <label for="">Stripe</label> 		
       <input type="radio" name="payment_method" value="stripe">
       <img src="{{ asset('frontend/assets/images/payments/4.png') }}">		    		
		    	</div> <!-- end col md 4 -->

		    	<div class="col-md-4">
		    		<label for="">Card</label> 		
       <input type="radio" name="payment_method" value="card">	
		<img src="{{ asset('frontend/assets/images/payments/3.png') }}">    		
		    	</div> <!-- end col md 4 -->

		    	<div class="col-md-4">
		    		<label for="">Cash</label> 		
       <input type="radio" name="payment_method" value="cash">	
		  <img src="{{ asset('frontend/assets/images/payments/6.png') }}">  		
		    	</div> <!-- end col md 4 -->

				 	
			</div> <!-- // end row  -->
<hr>
  <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment Step</button>


		</div>
	</div>
</div> 
<!-- checkout-progress-sidebar --> </div>



 



</form>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
		<!-- === ===== BRANDS CAROUSEL ==== ======== -->
 







<!-- ===== == BRANDS CAROUSEL : END === === -->	
</div><!-- /.container -->
</div><!-- /.body-content -->

 <script type="text/javascript">

document.addEventListener("DOMContentLoaded",()=>{

const proviceSelect = document.querySelector('select[name="province_id"]');



proviceSelect.addEventListener("change",handleProvinceChange);
});


async function handleProvinceChange(e){


const province_id=e.target.value;

if(province_id){

	try {

		const response=await fetch("{{url('/provice/district/select') }}/" +province_id );
		const data=await response.json();

		const districtSelect = document.querySelector('select[name="district_id"]');
		districtSelect.innerHTML = "";

		data.forEach(item=>{

			const option = document.createElement("option");
			option.value=item.id;

			option.text=item.name_en;
			districtSelect.appendChild(option);
		})

	} catch (error) {

		console.log("error");
		
	}

}

else{


}

}



    </script>


 
<script type="text/javascript">

document.addEventListener("DOMContentLoaded",()=>{

const districtSelect = document.querySelector('select[name="district_id"]');



districtSelect.addEventListener("change",handleDistrictChange);
});


async function handleDistrictChange(e){


const district_id=e.target.value;

if(district_id){

	try {

		const response=await fetch("{{url('/district/city/select') }}/" +district_id );
		const data=await response.json();

		const citySelect = document.querySelector('select[name="city_id"]');
		citySelect.innerHTML = "";

		data.forEach(item=>{

			const option = document.createElement("option");
			option.value=item.id;

			option.text=item.name_en;
			citySelect.appendChild(option);
		})

	} catch (error) {

		console.log("error");
		
	}

}

else{


}

}



    </script>

 




@endsection