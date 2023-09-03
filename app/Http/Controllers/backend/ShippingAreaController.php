<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipdivison;
use Carbon\Carbon;


class ShippingAreaController extends Controller
{
    public function DivsionView(){
      
        $divisions=Shipdivison::orderBy('id','DESC')->get();
        return view('backend.shipping.shipping_view',compact('divisions'));
    }

    public function DivisionStore(Request $request){
        $validated = $request->validate([
            'division_name' => 'required|min:3|string',
           
        ]);

        Shipdivison::insert([
            'shipping_division'=>$request->division_name,
            'created_at'=>Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Division  Added Successfully',
            'alert-type' => 'success',
         );
 
         return redirect()->route('manage.division')->with($notification);


    }

    public function DivisionDelete($id){
        Shipdivison::find($id)->delete();

        $notification = array(
            'message' => 'Division  deleted Successfully',
            'alert-type' => 'warning',
         );
 
         return redirect()->route('manage.division')->with($notification);

    }

    public function DivisionEdit($id){
        $division=Shipdivison::findOrFail($id);
        return view('backend.shipping.shipping_edit',compact('division'));
    }

    public function DivisionUpdate(Request $request,$id){
        $validated = $request->validate([
            'division_name' => 'required|min:3|string',
           
        ]);
        Shipdivison::find($id)->update([
            'shipping_division'=>$request->division_name,
            'created_at'=>Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Division  updated Successfully',
            'alert-type' => 'info',
         );

         return redirect()->route('manage.division')->with($notification);


    }

    
}
