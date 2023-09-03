const coupon_btn=document.getElementById("coupon");

coupon_btn.addEventListener("click",()=>{

    console.log("you clicked coupon button");
})



async function couponRemove(){

    try {
        const response=await fetch('/coupon/remove')
        if(response.status === 200){
            const data = await response.json();
            console.log(data)
            
        if (data.success) {
            console.log(data.success);
            toastr.success(data.success);
            
             
  
  
          } 
            
        }
    } catch (error) {
        
    }
	
}
document.querySelector('')