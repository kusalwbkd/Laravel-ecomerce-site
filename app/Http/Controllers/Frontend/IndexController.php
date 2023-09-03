<?php

namespace App\Http\Controllers\frontend;

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

use Auth;
use Illuminate\Support\Facades\Hash;
use Mews\Purifier\Facades\Purifier;
use Carbon\Carbon;
use App\Models\coupon;

class IndexController extends Controller
{
    public function index(){


        $sliders=Slider::where('status','1')->get();


         

         return view('frontend.index',compact('sliders'));
    }

    public function UserLogout(){

       Auth::logout();

       return redirect()->route('login');
    }

    public function UserProfile(){

        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile',compact('user'));
    }

        public function UserProfileUpdate(Request $request) {   

             $user_id=$request->id;

    
            $validatedData=$request->validate([
                'name'=>'required|string|max:255',
                'email'=>'required|string|max:255|email|unique:users,email,'.$user_id,
                'phone' => 'required|string|max:10'
                

                ]);


                $data=User::findOrFail($user_id);

                $data->email=$request->email;
                $data->name=$request->name;
                $data->phone=$request->phone;




                if($request->file('profile_photo_path')){

                    $file=$request->file('profile_photo_path');
                    @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
                    $filename=date('YmdHi').$file->getClientOriginalName();
                    $file->move(public_path('upload/user_images'),$filename);
                    $data['profile_photo_path'] = $filename;
        

                
                }

                 $data->save();

                 $notification=array(
                    'message' => 'User profile updated Successfully',
                    'alert-type' => 'success'
                 );

                 return redirect()->route('dashboard')->with($notification);
            }



public function UserPassword(){
 
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('frontend.profile.change_password',compact('user'));
}

public function UserPasswordChange(Request $request){

    $validatedData=$request->validate([

        
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        



    ]);

    $id = Auth::user()->id;


    $hashedpassword=Auth::user()->password;

    if(Hash::check($request->oldpassword,$hashedpassword)){

        $user=User::find($id);

        $user->password=Hash::make($request->password);
        $user->save();
        //Auth::logout();

        return redirect()->route('user.logout');
    }
    else{

        $notification=array(
            'message' => 'Please type your old password correcty',
            'alert-type' => 'error'
         );

         return redirect()->route('dashboard')->with($notification);
    }

}

public function ProductDetails($id,$slug){
 

$product=Product::findOrfail($id);
$multiimg= Multiimage::where('product_id',$id)->get();

$color=$product->product_color;

$product_color=explode(',',$color);


$size=$product->product_size;

$product_size=explode(',',$size);
$cat_id=$product->category_id;
$specifications= strip_tags($product->specifications);

$long_description= strip_tags($product->long_descp);
$relatedProduct = Product::where('category_id',$cat_id)->orderBy('id','DESC')->get();

return view('frontend.product.product_details',compact('product','multiimg','product_color','product_size','relatedProduct','specifications','long_description'));
}


public function TagWiseProduct($tag){

    $products = Product::where('status',1)->where('product_tags',$tag)->orderBy('id','DESC')->paginate(2);

$categories=Category::latest()->get();

$brands=Brand::latest()->get();


    return view('frontend.tags.tags_view',compact('products','categories','brands'));

}


public function SubCatWiseProduct($subcat_id,$slug){

    $products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(2);

$categories=Category::latest()->get();
return view('frontend.product.subcategory_view',compact('products','categories'));

}


public function SubSubCatWiseProduct($subsubcat_id,$slug){
    $products = Product::where('status',1)->where('subsubcategory_id',$subsubcat_id)->orderBy('id','DESC')->paginate(2);
    $categories=Category::latest()->get();
  
    return view('frontend.product.subsubcategory_view',compact('products','categories'));

}


public function Products(){
   
    $wishlist=Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
    $items= Product::with('category','brand')->get()->all();

    return response()->json(array(
'items'=>$items,
'wishlists'=>$wishlist



    ));

    
}


public function ProductViewAjax($id){



$product=Product::with('category','brand')->findOrfail($id);

$color=$product->product_color;

$product_color=explode(',',$color);
$size=$product->product_size;

$product_size=explode(',',$size);

return response()->json(array(

    'product'=>$product,
    'product_color'=>$product_color,
    'product_size'=>$product_size,



));
}


public function Brands(){
    $brands = Brand::all();
   
    return response()->json([
      'brands' => $brands,
    ]);

}

public function ViewCart(){
    return view('frontend.common.view_cart');
}







}
    


    