<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Auth;
use Carbon\Carbon;

class WishlistController extends Controller
{
    public function WishlistView(){
        return view('frontend.wishlist.wishlist_view');
    }

    public function AddtoWishlist(Request $request,$product_id){

        if(Auth::check()){
    
            $exits=Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();
    
    
            if($exits){
                return response()->json(['warning'=>'Already Item is in the wishlist']);
    
            }
            else{
                Wishlist::insert([
                    'user_id'=>Auth::id(),
                    'product_id'=>$product_id,
                    'created_at'=>Carbon::now(),
        
                ]);
                return response()->json(['success'=>'Added to the wishlist']);
    
            }
            
    
        
        }
    
        else{
      
    
            return response()->json(['error'=>'Please log to your account']);
        }
    
    }

    

    public function UserWishlistView(){
        $wishlists=Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
    
       return view('frontend.wishlist.wishlist_view',compact('wishlists'));


    }
    public function WishlistDelete($id){
            $wishlist=Wishlist::findOrfail($id);
            $wishlist->delete();
           
            
            $notification=array(
                'message' => 'Wishlist Item removed Sucesfully!',
                'alert-type' => 'warning'
             );

             return redirect()->route('wishlist.view')->with($notification);
        }
        
    }
    

    


    

