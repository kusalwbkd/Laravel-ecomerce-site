@extends('frontend.main_master')
@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Shopping Cart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row ">
			<div class="shopping-cart">
				<div class="shopping-cart-table ">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th class="cart-romove item">Remove</th>
					<th class="cart-description item">Image</th>
					<th class="cart-product-name item">Product Name</th>
					<th class="cart-edit item">Brand </th>
					<th class="cart-qty item">Colour</th>
                    	<th class="cart-qty item">Price</th>
					<th class="cart-sub-total item">Number of Items</th>
					<th class="cart-total last-item">Grand total</th>
				</tr>
			</thead><!-- /thead -->
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="shopping-cart-btn">
							
						</div><!-- /.shopping-cart-btn -->
					</td>
				</tr>
			</tfoot>
			<tbody>

            @foreach ($cart_items as $item )
                
				<tr data-id="{{ $item->id }}">
					<td class="romove-item" >
				 <a href="{{route('product.remove',$item->id)}}" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a>
					
					</td>
					<td class="cart-image">
						<a class="entry-thumbnail" href="detail.html">
<img src="{{ asset($item['product']['product_thambnail']) }}" alt="">
						</a>
					</td>
					<td class="cart-product-name-info">
						<h4 class='cart-product-description'>{{$item['product']['product_name']}}</h4>
						<!-- /.row -->
						
					</td>
					<td class="cart-product-edit">{{$item['product']['brand']['brand_name']}}</td>
					<td class="cart-product-quantity">
						{{$item->product_color}}
		            </td>
                
                        @if ($item['product']['discount_price'] == NULL)
                    <td class="cart-product-sub-total"><span class="cart-sub-total-price">{{$item['product']['selling_price']}}</span></td>
                    @else
                    <td class="cart-product-sub-total"><span class="cart-sub-total-price">{{$item['product']['discount_price']}}</span></td>

                        @endif
            
					<td class="cart-product-grand-total"><span class="cart-grand-total-price">{{$item->amount}}</span></td>
                    
					
					@php
					
                       $amount=$item->amount;
                    if ($item['product']['discount_price'] == NULL){

                     $price=$item['product']['selling_price'] * $amount;
					}
                     else{
                     $price=$item['product']['discount_price']*$amount;
					 }
              
                    @endphp
                    

                    @if ($item['product']['discount_price'] == NULL)
                    <td class="cart-product-grand-total"><span class="cart-grand-total-price">{{$price}}</span></td>
   
                    @else
                    <td class="cart-product-grand-total"><span class="cart-grand-total-price">{{$price}}</span></td>

                    @endif

				</tr>

                @endforeach

				<td colspan="4" style="background-color: #f5f5f5;">The full total is</td>
        
        <!-- Second part with a different background color -->
        <td colspan="4" style="background-color: #e0e0e0;">{{$amount_total}}</td>
				
			</tbody><!-- /tbody -->
		</table><!-- /table -->
	</div>
</div><!-- /.shopping-cart-table -->				

 

<div class="col-md-4 col-sm-12 estimate-ship-tax">
@if(Session::has('coupon'))

@else


<table class="table">
	<thead>		
			<tr>
				<th>
					<span class="estimate-title">Discount Code</span>
					<p>Enter your coupon code if you have one..</p>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
							<input type="text" class="form-control unicase-form-control text-input" id="coupon_name" placeholder="You Coupon..">
						</div>
						<div class="clearfix pull-right">
							<button type="submit" class="btn-upper btn btn-primary" id="coupon" onclick=" applyCoupon()" >APPLY COUPON</button>
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->

@endif
	
</div><!-- /.estimate-ship-tax -->



<div class="col-md-4 col-sm-12 cart-shopping-total">
	<table class="table">
	

		<thead id="coupon_data">
			
		</thead><!-- /thead -->

		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
							<a href="{{route('checkout')}}" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</a>
							<span class="">Checkout with multiples address!</span>
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div><!-- /.cart-shopping-total -->			





</div><!-- /.shopping-cart -->
		</div> 

<script>


calculateCoupon();
const coupon_btn=document.getElementById("coupon");


 //coupon_btn.addEventListener("click",(e)=>{
  //    console.log("coupon button clicked");
   //applyCoupon();
   

  	
	
		

 //})








     async function applyCoupon() {
    const coupon_name = document.getElementById("coupon_name"); // Replace with the actual coupon name from your form input
  
    console.log(coupon_name.value);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    try {
      const response = await fetch('/coupon/add', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        // Convert coupon to JSON and send it in the request body
        body: JSON.stringify({ coupon_name: coupon_name.value })
      });
  
      if (response.status === 200) {
        const data = await response.json();
       
      
        if (data.success) {
          console.log(data.success);
          toastr.success(data.success);
		   console.log(data);
		    location.reload();


        } 


		
		  
		
		else if (data.error) {
          console.log(data.error);
          toastr.error(data.error);
		   //calculateCoupon();
        }

      }
    } 
	catch (error) {
      // Handle any errors that occurred during the fetch request
      console.error(error);
    }

   
  }
      

 

async function calculateCoupon() {
	const coupon_item=document.getElementById("coupon_data");
  try {
    const response = await fetch('/coupon/calculation');
    if (response.status === 200) {
      const data = await response.json();
	  console.log(data)
	  
	  let html='';

	  
if(data.total){

	html=`<tr>
        <th>
            <div class="cart-sub-total">
                Subtotal<span class="inner-left-md">$ ${data.total}</span>
            </div>
           
        </th>
            </tr>`

}

else{
html=`<tr>
        <th>
            <div class="cart-sub-total">
                Subtotal<span class="inner-left-md">$ ${data.subtotal}</span>
            </div>
            <div class="cart-sub-total">
                Coupon<span class="inner-left-md">$ ${data.coupon_name}</span>
                <button type="submit" onclick="couponRemove()"><i class="fa fa-times"></i>  </button>
            </div>

             <div class="cart-sub-total">
                Discount Amount<span class="inner-left-md">$ ${data.discount_amount}</span>
            </div>


            <div class="cart-grand-total">
                Grand Total<span class="inner-left-md">$ ${data.total_amount}</span>
            </div>
        </th>
            </tr>`
}
      
	  
	  
	

	  coupon_item.innerHTML = html;
	 
    }
	
  } catch (error) {
    // Handle any errors that occurred during the fetch request
    console.error(error);
  }

}


async function couponRemove(){

    try {
        const response=await fetch('/coupon/remove')
        if(response.status === 200){
            const data = await response.json();
            console.log(data)
            
        if (data.warning) {
            console.log(data.success);
            toastr.warning(data.warning);
            calculateCoupon();
			location.reload();


             
  
  
          } 
            
        }
    } catch (error) {
        
    }
	
}


async function removeItem(){
	const item=document.getElementsByClassName('shopping-cart-table');

 

  item.addEventListener("click",(e)=>{
	 e.preventDefault();
// const id=e.target.dataset.id;
console.log("trash button clicked")

})
}
removeItem();
 </script>





@endsection



