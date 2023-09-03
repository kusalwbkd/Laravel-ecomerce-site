@extends('frontend.main_master')
@section('content')

@section('title')
{{ $product->product_name }} Product Details
@endsection

        <!-- ===== ======== HEADER : END ============================================== -->
<div class="breadcrumb">
 <div class="container">
 <div class="breadcrumb-inner">
                    <ul class="list-inline list-unstyled">

                    </ul>
                </div><!-- /.breadcrumb-inner -->
            </div><!-- /.container -->
        </div><!-- /.breadcrumb -->
        <div class="body-content outer-top-xs">
            <div class='container'>
                <div class='row single-product'>
                    <div class='col-md-3 sidebar'>
                        <div class="sidebar-module-container">
                        <div class="home-banner outer-top-n">
    
        </div>		
          
            
            
                <!-- ============================================== HOT DEALS ============================================== -->
                @include('frontend.common.hot_deals')
        <!-- ============================================== HOT DEALS: END ============================================== -->					
        
        <!-- ============================================== NEWSLETTER ============================================== -->

        <!-- ============================================== NEWSLETTER: END ============================================== -->
        
        <!-- ============================================== Testimonials============================================== -->
       
            
        <!-- ============================================== Testimonials: END ============================================== -->
        
         
        
                        </div>
                    </div><!-- /.sidebar -->
                    <div class='col-md-9'>
                    <div class="detail-block">
                        <div class="row  wow fadeInUp">
                        
                                 <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
            <div class="product-item-holder size-big single-product-gallery small-gallery">
        
                <div id="owl-single-product">

                @foreach($multiimg as $img)
                    <div class="single-product-gallery-item" id="slide{{$img->id}}">
                        <a data-lightbox="image-1" data-title="Gallery" href="{{asset($img->photo_name)}}">
                            <img class="img-responsive" alt="" src="{{asset($img->photo_name)}}" data-echo="{{asset($img->photo_name)}}"  />
                        </a>
                    </div><!-- /.single-product-gallery-item -->
@endforeach
                   
                </div><!-- /.single-product-slider -->
        
        
                <div class="single-product-gallery-thumbs gallery-thumbs">
        
                    <div id="owl-single-product-thumbnails">

                    @foreach($multiimg as $img)
                        <div class="item">
                            <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide{{$img->id}}">
                                <img class="img-responsive" style="width:80px;height:80px" alt="" src="{{asset($img->photo_name)}}" data-echo="{{asset($img->photo_name)}}" />
                            </a>
                        </div>
        @endforeach
  
                    </div><!-- /#owl-single-product-thumbnails -->
        
                    
        
                </div><!-- /.gallery-thumbs -->
        
            </div><!-- /.single-product-gallery -->
        </div><!-- /.gallery-holder -->        			
                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name">{{$product->product_name}}</h1>
                                    
                                    <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="rating rateit-small"></div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    <a href="#" class="lnk">(13 Reviews)</a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->		
                                    </div><!-- /.rating-reviews -->
        
                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>	
                                            </div>
                                            <div class="col-sm-9">
                                            @if($product->status === 1)
                                                <div class="stock-box">

                                               
                                                    <span style="color:green" class="value">In Stock</span>
                                                </div>	

                                                @else
                                                <span style="color:red" class="value">Out of Stock</span>

@endif
                                            </div>
                                        </div><!-- /.row -->	
                                    </div><!-- /.stock-container -->
        
                                    <div class="description-container m-t-20">
{{$specifications}}
                                
                                </div><!-- /.description-container -->
        
                                    <div class="price-container info-container m-t-20">
                                        <div class="row">
                                            
        
                                            <div class="col-sm-6">
                                                <div class="price-box">


                                                @if($product->discount_price== NULL)
                                                <span class="price">{{$product->selling_price}}$</span>
                                                    


                                                    @else
                                                    <span class="price">{{$product->discount_price}}$</span>
                                                    <span class="price-strike">{{$product->selling_price}}$</span>

                                                    @endif
                                                </div>
                                            </div>
        
                                          
        
                                        </div><!-- /.row -->
                                    </div><!-- /.price-container -->



                                    <div class="row">
									

                                    <div class="col-sm-6">
                                
                                <div class="form-group">
                                
                                    
                                          
  <label class="info-title control-label">Choose Color <span> </span></label>
  <select class="form-control " style="" id="color" require>
      <option selected="" disabled="">--Choose Color--</option>
      @foreach($product_color as $color)
      <option value="{{$color}}">{{$color}}</option>
       @endforeach
  </select> 

                                
                                </div> <!-- // end form group -->
                                         
                                    </div> <!-- // end col 6 -->
                                
                                        <div class="col-sm-6">
                                
                                <div class="form-group">
                                   	
                                
                                   
                                
                                    
                                </div> <!-- // end form group -->
                                
                                             
                                        </div> <!-- // end col 6 -->
                                
                                     </div><!-- /.row -->
                                
        
                                    <div class="quantity-container info-container">
                                        
                                            
                                            <div class="row">
                                         
        
                                            <div class="col-sm-6">
                                                <button class="btn btn-primary" data-id="{{$product->id}}" id="add_to_cart" ><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                            </div>
                                             


                                            <div class="col-sm-6">
                                                <button class="btn btn-primary" data-id="{{$product->id}}" id="add_to_wishlist" ><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO WISHLIST</button>
                                            </div>
                                            
                                          
                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->
                                      
                                      
                                                  
        
                                    
                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                        </div>
                        
                        <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                            <div class="row">
                                <div class="col-sm-3">
                                    <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                        <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                        <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                        <li><a data-toggle="tab" href="#tags">TAGS</a></li>
                                    </ul><!-- /.nav-tabs #product-tabs -->
                                </div>
                                <div class="col-sm-9">
        
                                    <div class="tab-content">
                                        
                                        <div id="description" class="tab-pane in active">
                                            <div class="product-tab">
                                                <p class="text">{{ $long_description}}</p>
                                            </div>	
                                        </div><!-- /.tab-pane -->
        
                                        <div id="review" class="tab-pane">
                                            <div class="product-tab">
                                                                                        
                                                <div class="product-reviews">
                                                    <h4 class="title">Customer Reviews</h4>
        
                                                    <div class="reviews">
                                                        <div class="review">
                                                            <div class="review-title"><span class="summary">We love this product</span><span class="date"><i class="fa fa-calendar"></i><span>1 days ago</span></span></div>
                                                            <div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit."</div>
                                                                                                                </div>
                                                    
                                                    </div><!-- /.reviews -->
                                                </div><!-- /.product-reviews -->
                                                
        
                                                
                                                <div class="product-add-review">
                                                    <h4 class="title">Write your own review</h4>
                                                    <div class="review-table">
                                                        <div class="table-responsive">
                                                            <table class="table">	
                                                                <thead>
                                                                    <tr>
                                                                        <th class="cell-label">&nbsp;</th>
                                                                        <th>1 star</th>
                                                                        <th>2 stars</th>
                                                                        <th>3 stars</th>
                                                                        <th>4 stars</th>
                                                                        <th>5 stars</th>
                                                                    </tr>
                                                                </thead>	
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="cell-label">Quality</td>
                                                                        <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                        <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                        <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                        <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                        <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="cell-label">Price</td>
                                                                        <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                        <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                        <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                        <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                        <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="cell-label">Value</td>
                                                                        <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                        <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                        <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                        <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                        <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table><!-- /.table .table-bordered -->
                                                        </div><!-- /.table-responsive -->
                                                    </div><!-- /.review-table -->
                                                    
                                                    <div class="review-form">
                                                        <div class="form-container">
                                                            <form role="form" class="cnt-form">
                                                                
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputName">Your Name <span class="astk">*</span></label>
                                                                            <input type="text" class="form-control txt" id="exampleInputName" placeholder="">
                                                                        </div><!-- /.form-group -->
                                                                        <div class="form-group">
                                                                            <label for="exampleInputSummary">Summary <span class="astk">*</span></label>
                                                                            <input type="text" class="form-control txt" id="exampleInputSummary" placeholder="">
                                                                        </div><!-- /.form-group -->
                                                                    </div>
        
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputReview">Review <span class="astk">*</span></label>
                                                                            <textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
                                                                        </div><!-- /.form-group -->
                                                                    </div>
                                                                </div><!-- /.row -->
                                                                
                                                                <div class="action text-right">
                                                                    <button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                                                                </div><!-- /.action -->
        
                                                            </form><!-- /.cnt-form -->
                                                        </div><!-- /.form-container -->
                                                    </div><!-- /.review-form -->
        
                                                </div><!-- /.product-add-review -->										
                                                
                                            </div><!-- /.product-tab -->
                                        </div><!-- /.tab-pane -->
        
                                        <div id="tags" class="tab-pane">
                                            <div class="product-tag">
                                                
                                                <h4 class="title">Product Tags</h4>
                                                <form role="form" class="form-inline form-cnt">
                                                    <div class="form-container">
                                            
                                                        <div class="form-group">
                                                            <label for="exampleInputTag">Add Your Tags: </label>
                                                            <input type="email" id="exampleInputTag" class="form-control txt">
                                                            
        
                                                        </div>
        
                                                        <button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
                                                    </div><!-- /.form-container -->
                                                </form><!-- /.form-cnt -->
        
                                                <form role="form" class="form-inline form-cnt">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
                                                    </div>
                                                </form><!-- /.form-cnt -->
        
                                            </div><!-- /.product-tab -->
                                        </div><!-- /.tab-pane -->
        
                                    </div><!-- /.tab-content -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.product-tabs -->
        
                        <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                        <section class="section featured-product wow fadeInUp">
	<h3 class="section-title">Releted products</h3>
	<div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">



		@foreach($relatedProduct as $product)
	    	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug ) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
			</div><!-- /.image -->			

			            <div class="tag sale"><span>sale</span></div>            		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug ) }}">
			{{ $product->product_name }} </a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>


 @if ($product->discount_price == NULL)
<div class="product-price">	
				<span class="price">
					${{ $product->selling_price }}	 </span> 
			</div><!-- /.product-price -->
 @else

<div class="product-price">	
				<span class="price">
					${{ $product->discount_price }}	 </span>
			  <span class="price-before-discount">$ {{ $product->selling_price }}</span>								
			</div><!-- /.product-price -->
 @endif


			
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						
	                  
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
	
	 	@endforeach





			</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->


        <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
                    
                    </div><!-- /.col -->
                    <div class="clearfix"></div>
                </div><!-- /.row -->
        



@endsection
