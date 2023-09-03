

@extends('frontend.main_master')
    @section('content')
    
    
    <div class="container">
      
    <div class="row">
        <div class="col-md-6">
            <h1>Product Wish List</h1>
        </div>
      
    </div>
  

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Product Price</th>
              <th>Product Image</th>
              <th>Product color</th>
              <th>Add to cart </th>
              <th>Remove Item</th>
            </tr>
          </thead>
          <tbody id="wishlist">
    
          @foreach($wishlists as $wishlist)
            <tr>
              <td><a href="{{url('product/details/'.$wishlist['product']['id'] .'/'.$wishlist['product']['product_slug'])}}">{{$wishlist['product']['product_name']}}</td>
              @if($wishlist['product']['discount_price']=== NULL)
              <td>{{$wishlist['product']['selling_price']}}</td>
    
              @else
    
              <td>{{$wishlist['product']['discount_price']}}</td>
    
              @endif
    
              @php 
    
             $img=$wishlist['product']['product_thambnail']
            
              @endphp


              <td><img src="{{asset($img)}}" style="width:100px;height:100px" alt="Product 1"></td>

              <td>


              @php 
              $color=$wishlist['product']['product_color'];

              $product_color=explode(',',$color);

              @endphp
              <select class="form-control " style="" id="color" require>
      <option selected="" disabled="">--Choose Color--</option>
      @foreach($product_color as $color)
      <option value="{{$color}}">{{$color}}</option>
       @endforeach
  </select> 

              </td>
               
            <td>
    <button class="btn btn-primary" data-id="{{$wishlist['product']['id']}}" id="add_to_cart" ><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
    </td>
              <td><a href="{{route('wishlist.delete',$wishlist->id)}}" class="btn btn-danger" data-id="{{$wishlist->id}}" id="remove">Remove</button></td>
            
           
            
    
          
            
            </tr>
           @endforeach
            <!-- Add more product rows as needed -->
    
    
    
     
          </tbody>
        </table>
      </div>
     
      <script>

document.addEventListener("DOMContentLoaded",()=>{

const removebtns=[...document.querySelectorAll("#remove")]

removebtns.forEach(btn=>{




btn.addEventListener("click",removeWishlist())




})

async function removeWishlist(id) {
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const button = event.target; // Get the button that triggered the click event
      
      try {
        const product_id = parseInt(button.dataset.id);
        const response = await fetch('/user/wishlist/remove/' + product_id, {
          method: 'GET',
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
         
        } else {
          
        }
      } catch (error) {
        //console.error(error);
      }
    }
})
        </script>
    @endsection