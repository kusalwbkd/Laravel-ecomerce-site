

@php
$hot_deals = App\Models\Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
     @endphp

     <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
          <h3 class="section-title">hot deals</h3>
          <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">


   
        @foreach($hot_deals as $product)
            <div class="item">
              <div class="products">
                <div class="hot-deal-wrapper"> 
                  <div class="image"> <img src="{{ asset($product->product_thambnail) }}" alt=""> </div>

        @php
        $amount = $product->selling_price - $product->discount_price;
        $discount = ($amount/$product->selling_price) * 100;
        @endphp   
                  
              @if ($product->discount_price == NULL)
                <div class="tag new"><span>new</span></div>
              @else
              <div class="sale-offer-tag"><span>{{ round($discount) }}%<br>
                    off</span></div>
              @endif
                  



                </div>
                <!-- /.hot-deal-wrapper -->
                
  <div class="product-info text-left m-t-20">
    <h3 class="name"><a href="{{url('product/details/'.$product->id .'/'.$product->product_slug)}}">
      {{ $product->product_name }} </a></h3>
    <div class="rating rateit-small"></div>

     @if ($product->discount_price == NULL)
 <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span>  </div>
     @else
 <div class="product-price"> <span class="price"> ${{ $product->discount_price }} </span> <span class="price-before-discount">${{ $product->selling_price }}</span> </div>
     @endif

   
    <!-- /.product-price --> 
                  
                </div>
                <!-- /.product-info -->
                
                <div class="cart clearfix animate-effect">
                  <div class="action">
                    <div class="add-cart-button btn-group">
                    </div>
                  </div>
                  <!-- /.action --> 
                </div>
                <!-- /.cart --> 
              </div>
            </div>
             @endforeach <!-- // end hot deals foreach -->





          </div>
          <!-- /.sidebar-widget --> 
        </div>