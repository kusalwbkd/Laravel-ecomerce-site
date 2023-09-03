

@php
$special_offers = App\Models\Product::where('special_offer',1)->orderBy('id','DESC')->get();
     @endphp

    
<div class="sidebar-widget outer-bottom-small wow fadeInUp">
          <h3 class="section-title">Special Offer</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
            @foreach($special_offers as $product)
            <div class="item">
                <div class="products special-product">


                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="{{url('product/details/'.$product->id .'/'.$product->product_slug)}}"> <img src="{{asset($product->product_thambnail)}}" alt=""> </a> </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="{{url('product/details/'.$product->id .'/'.$product->product_slug)}}">{{$product->product_name}}</a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="product-price">

                            @if($product->discount_price == NULL)
                                <span class="price">${{$product->selling_price}} </span> 

                                @else
                                <span class="price">$ {{$product->discount_price}} </span>
@endif
</div>


                            <!-- /.product-price --> 

                            
                            
                          </div>
                        </div>
                        <!-- /.col --> 

                    
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 

                    
                    
                  </div>
                  <div class="cart clearfix animate-effect">
                  <div class="action">
                    <div class="add-cart-button btn-group">
                    </div>
                  </div>
                  <!-- /.action --> 
                </div>
                 
                </div>
              </div>
             
              @endforeach
            </div>
          </div>
          <!-- /.sidebar-widget-body --> 
        </div>