// Add use statement for the new model
use App\Models\CouponData; // Replace with the actual model name

public function CouponAdd(Request $request){
    // Existing code...
    
    if($coupon){
        // Store coupon data in the database
        CouponData::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'coupon_name' => $coupon->coupon_name,
                'discount_amount' => ($amount_total * $coupon->discount) / 100,
                'total_amount' => $amount_total - ($amount_total * $coupon->discount) / 100,
            ]
        );

        return response()->json(['success' => 'Coupon applied successfully']);
    } else {
        return response()->json(['error' => 'Coupon is not valid']);
    }
}

public function CouponCalculation(){
    // Fetch coupon data from the database
    $couponData = CouponData::where('user_id', Auth::id())->first();

    $amount_total = FullCarttotal::where('user_id', Auth::id())->value('carttotal');

    if ($couponData) {
        return response()->json([
            'subtotal' => $amount_total,
            'coupon_name' => $couponData->coupon_name,
            'discount_amount' => $couponData->discount_amount,
            'total_amount' => $couponData->total_amount,
        ]);
    } else {
        return response()->json([
            'subtotal' => $amount_total,
        ]);
    }
}









const coupon_btn=document.getElementById("coupon");



 coupon_btn.addEventListener("click",(e)=>{
      console.log("coupon button clicked");
     applyCoupon();
		
		  
	 })



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
		   	calculateCoupon();
		

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
	   const div = document.createElement("div");
  coupon_item.innerHTML =`<tr>
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
  } catch (error) {
    // Handle any errors that occurred during the fetch request
    console.error(error);
  }
}



