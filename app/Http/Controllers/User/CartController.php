<?php
//some changes done
namespace App\Http\Controllers\User;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Multiimage;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\FullCarttotal;
use App\Models\Checkoutcart;
use App\Models\Provice;
use App\Models\District;
use App\Models\City;
use Auth;
use Illuminate\Support\Facades\Hash;
use Mews\Purifier\Facades\Purifier;
use Carbon\Carbon;
use App\Models\coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    public function AddoCart(Request $request){

        $full_total=0;
  
        if(Auth::check()){

        $alldata=$request->json()->all();
        $products = [];
          
            foreach($alldata as $data){
            $color=$data['color'];
            $product_id=$data['id'];
           
           $amount=$data['amount'];
           $product=Product::find($product_id);
          

           if($product){
            $products[]=$product;

            if($product->discount_price == NULL){
                $price = $product->selling_price;

            }
            else{
                $price = $product->discount_price;

            }
            $product_total = $price * $amount;
            $full_total += $product_total;
           }
          
         // DB::table('carts')->truncate();
             $cart_id=Cart::insertGetId([
               
            'user_id'=>Auth::id(),
            'product_id'=>$product_id,
            'product_color'=>$color,
            'amount'=>$amount,
           
    
        ]);   

        
      
       
           
         
    }
   // DB::table('full_carttotals')->truncate();
     FullCarttotal::insert([

        'user_id'=>Auth::id(),
        'carttotal'=>$full_total,
       
    ]);
     
       

   
    
    return response()->json(['success' => 'inserted to db']);
             
     
        }
        else{
           // return response()->json(['error'=>'please login','redirect' => route('login')']);
           return response()->json(['error' => 'Please login', 'redirect' => route('login')]);

        }

       
    }
    public function Checkout(){
        $amount_total=0;
        $cart_items=Cart::with('product')->where('user_id',Auth::id())->get();
        $amount_total = FullCarttotal::where('user_id', Auth::id())->sum('carttotal'); // Fetch a single value
        return view('frontend.checkout.checkout', compact('cart_items', 'amount_total'));
    }

    public function CouponAdd(Request $request){

  
        //dd($request->coupon_text);
        $coupon = coupon::where('coupon_name', $request->coupon_name)->where('validity','>=',Carbon::now()->format('Y-m-d'))->first();
        $amount_total = FullCarttotal::where('user_id', Auth::id())->sum('carttotal'); // Fetch a single value
      
        if($coupon){
        
            $final_total=$amount_total-($amount_total*$coupon->discount)/100;
           Session::put('coupon',[

            'coupon_name'=>$coupon->coupon_name,
            'coupon->discount'=>$coupon->discount,
            'discount_amount'=> ($amount_total*$coupon->discount)/100,
            'total_amount'=>$amount_total-($amount_total*$coupon->discount)/100,



           ]);

           FullCarttotal::where('user_id',Auth::id())->update([
            'carttotal'=>$final_total,
            'coupon_id'=>$coupon->id,
           ]);

     return response()->json(['success'=>'Coupon applied succesfully']);

    
        }
        else{
            return response()->json(['error'=>'Coupon is not valid']);
    
        }
       
    }

    public function CouponCalculation(){
        $amount_total = FullCarttotal::where('user_id', Auth::id())->sum('carttotal'); // Fetch a single value

        if(Session::has('coupon')){
             return response()->json(array(
      
            'subtotal'=>$amount_total,
            'coupon_name'=>session()->get('coupon')['coupon_name'],
            'discount_amount'=>session()->get('coupon')['discount_amount'],
            'total_amount'=>session()->get('coupon')['total_amount'],
       

             ) ); 

            
             return response()->json(['success'=>'applied']);
        }
        else{
            return response()->json(array(
                'total'=>$amount_total,
             
                
            ));
            
        }

    }

    
public function CouponRemove(){
    Session::forget('coupon');
    return response()-> json(['warning'=>'coupon removed sucessfully!']);
}



public function ProductRemove($id){
   
    $cart_item=Cart::findOrfail($id);
    $cart_total=FullCarttotal::where('user_id',Auth::id())->sum('carttotal');
$coupon_id=FullCarttotal::where('user_id',Auth::id())->value('coupon_id');

$discount=Coupon::where('id',$coupon_id)->sum('discount');
    $amount=$cart_item->amount;
    $product_id=$cart_item->product_id;
   // $amount_total = FullCarttotal::where('user_id', Auth::id())->sum('carttotal'); // Fetch a single value



    $product=Product::find($product_id);

if($product){


    if($coupon_id){

        if($product->discount_price == NULL){
            $price =$product->selling_price- ($product->selling_price*($discount/100));
    
        }
        else{
            $price = $product->discount_price- ($product->discount_price*($discount/100));
    
        }
    }

    else{

        if($product->discount_price == NULL){
            $price = $product->selling_price;
    
        }
        else{
            $price = $product->discount_price;
    
        }

    }
   
$new_total=$cart_total-($price*$amount);

    FullCarttotal::where('user_id',Auth::id())->update([
        'carttotal'=>$new_total,
       ]);

       $cart_item->delete();

    
       $notification=array(
        'message' => 'Product removed Successfully',
'alert-type' => 'danger'
);

return redirect()->back()->with($notification);
//here i have done some changes!
}
}

public function ProceedCheckout(){
    $amount_total = FullCarttotal::where('user_id', Auth::id())->sum('carttotal'); // Fetch a single value
$cart_items=Cart::where('user_id',Auth::id())->get();
$provinces=Provice::all();
    if ($amount_total >0) {
        return view('frontend.checkout.final_checkout',compact('cart_items','amount_total','provinces'));
    }

    else{
        $notification=array(
            'message' => 'You dont have any items in your cart!',
            'alert-type' => 'error'
         );

         return redirect()->to('/')->with($notification);
    }
   
}

public function DistrictSelect($province_id){

    $districts = District::where('province_id',$province_id)->orderBy('name_en','ASC')->get();
    return json_encode($districts);


}
public function CitySelect($district_id){

    $cities = City::where('district_id',$district_id)->orderBy('name_en','ASC')->get();
    return json_encode($cities);


}

public function FinalCheckout(Request $request){
   $data=array();

   $data['shipping_name']=$request->shipping_name;
   $data['shipping_email']=$request->shipping_email;
   $data['shipping_phone']=$request->shipping_phone;
   $data['post_code']=$request->post_code;
   $data['province_id']=$request->province_id;
   $data['district_id']=$request->district_id;
   $data['city_id']=$request->city_id;
   $data['street_name']=$request->street_name;
   $data['house_name']=$request->house_name;

   if($request->payment_method == 'stripe'){
    return view('frontend.payment.stripe',compact('data'));
   }

   elseif ($request->payment_method == 'card') {
    return view('frontend.payment.card',compact('data'));
   }
   else{
    return view('frontend.payment.cash',compact('data'));
   }
   

}

}
