
@php 
       $featured_products= App\Models\Product::where('featured',1)->orderBy('id','DESC')->get();


       @endphp
        
        <section class="section featured-product wow fadeInUp">
  <h3 class="section-title">Featured products</h3>
  <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
  
   @foreach($featured_products as $product)
   <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image"> <a href="detail.html"><img  src="{{asset($product->product_thambnail)}}" alt=""></a> </div>
                    <!-- /.image -->
                    
                    <div class="tag new"><span>new</span></div>
                  </div>
                  <!-- /.product-image -->
                  
                  <div class="product-info text-left">
                  <h3 class="name"><a href="{{url('product/details/'.$product->id .'/'.$product->product_slug)}}
                    ">{{$product->product_name}}</a></h3>                    <div class="rating rateit-small"></div>
                    <div class="description"></div>

                    @if($product->discount_price == NULL)
                    <div class="product-price"> 
                      <span class="price"> ${{$product->selling_price}}</span> 
                      
                    </div>

                    @else 
                    <div class="product-price"> 
                      <span style="color:green" class="price"> ${{$product->discount_price}} </span> 
                      <span style="color:red" class="price-before-discount">${{$product->selling_price}}</span> 
                    </div>



                    @endif
                    <!-- /.product-price --> 
                    
                  </div>
                  <!-- /.product-info -->
                  <div class="cart clearfix animate-effect">
                    <div class="action">
                    <ul class="list-unstyled">
                        
                      </ul>
                    </div>
                    <!-- /.action --> 
                  </div>
                  <!-- /.cart --> 
                </div>
                <!-- /.product --> 
                
              </div>
              <!-- /.products --> 
            </div>
    <!-- /.item -->
    @endforeach
   
    <!-- /.item -->
    
   
    <!-- /.item -->
    
    
    <!-- /.item -->
    
   
    <!-- /.item -->
    
   
    <!-- /.item --> 
  </div>
  <!-- /.home-owl-carousel --> 
</section>
