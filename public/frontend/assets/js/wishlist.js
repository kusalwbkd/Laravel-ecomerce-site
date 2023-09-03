
document.addEventListener("DOMContentLoaded", () => {
    
    
    function wishlist(){
    
    const wishlist_buttons=document.querySelectorAll("#add_to_wishlist");
    wishlist_buttons.forEach(button=>{
      button.addEventListener("click",addtowishlist);
    
      });
    
    }
    
    async function addtowishlist(event) {
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const button = event.target; // Get the button that triggered the click event
      
      try {
        const product_id = parseInt(button.dataset.id);
        const response = await fetch('/wishlist/add/' + product_id, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
          },
        });
    
        if (response.status === 200) {
         const data = await response.json();
          console.log(data.error);
    
          if(data.error){
            toastr.error(data.error)
    
          }
    
          else if (data.warning) {
            toastr.warning(data.warning)
    
          }
    
          else if(data.success){
            toastr.success(data.success)
          }
         
        }
         
      } catch (error) {
        //console.error(error);
      }
    }
    
      wishlist();
      
    })