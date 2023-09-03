<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\coupon;

use Carbon\Carbon;
use App\Http\Requests\CouponstoreRequest;
use App\Http\Requests\CouponupdateRequest;




class CouponController extends Controller
{
    public function CouponView(){

        $coupons=coupon::orderBy('id','DESC')->get();
        return view('backend.coupon.coupon_view',compact('coupons'));

    }

    public function CouponStore(CouponstoreRequest $request ,Coupon $coupon){


        $validated = $request->validated(); 


        coupon::insert([

            'coupon_name'=>strtoupper($request->coupon_name),
            'discount'=>$request->discount,
            'validity'=>$request->validity,
            'created_at'=>Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Added Successfully',
            'alert-type' => 'success',
         );
 
         return redirect()->route('manage.coupon')->with($notification);

    }

    public function CouponEdit($id){
        $coupons=coupon::findOrfail($id);
        return view('backend.coupon.coupon_edit',compact('coupons'));

    }

    public function CouponUpdate(CouponupdateRequest $request ,$id){

        coupon::findOrFail($id)->update([

            'coupon_name'=>strtoupper($request->coupon_name),
            'discount'=>$request->discount,
            'validity'=>$request->validity,
            'created_at'=>Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon updated Successfully',
            'alert-type' => 'info',
         );
 
         return redirect()->route('manage.coupon')->with($notification);


    }

    public function CouponDelete($id){
        coupon::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Coupon deleted Successfully',
            'alert-type' => 'warning',
         );
 
         return redirect()->route('manage.coupon')->with($notification);

    }

   
}
