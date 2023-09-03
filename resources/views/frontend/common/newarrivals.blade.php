@php
$products = App\Models\Product::where('status',1)->get();
     @endphp


     <script src="{{ asset('frontend/assets/js/cart.js')}}"></script>
<section class="section wow fadeInUp new-arriavls">
          <h3 class="section-title">New Arrivals</h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
          @foreach($products as $product) 
          
          
          <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image"> <a href="detail.html"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                    <!-- /.image -->
                    
                    <div class="tag new"><span>new</span></div>
                  </div>
                  <!-- /.product-image -->
                  
                  <div class="product-info text-left">
                    <h3 class="name"><a href="{{url('product/details/'.$product->id .'/'.$product->product_slug)}}
                    ">{{$product->product_name}}</a></h3>
                    <div class="rating rateit-small"></div>
                    <div class="description"></div>
                    <div class="product-price">


                    @if($product->discount_price == NULL)

                    <span class="price">${{ $product->selling_price}} </span>

                        
                   
                
                    @else
                    <span class="price"> ${{$product->discount_price}} </span>
                    
                    <span class="price-before-discount">${{ $product->selling_price}}</span> 

@endif
                    
                
                </div>
                    <!-- /.product-price --> 
                    
                  </div>
                  <!-- /.product-info -->
                  
                  <!-- /.cart --> 

                  <div class="cart clearfix animate-effect">
                    <div class="action">
                    

                      
                    </div>
                    <!-- /.action --> 
                  </div>


                </div>
                <!-- /.product --> 
                
              </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->
            
            @endforeach
            <!-- /.item --> 
          </div>


          
          <!-- /.home-owl-carousel --> 
        </section>