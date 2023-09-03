<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
//use Image;



//in this controller inserting,updating , retriveving and deleting is done by using Query builder

class BrandController extends Controller
{
    public function BrandView(){

        $brands=DB::table('brands')->get();
        return view('backend.brand.brand_view',compact('brands'));
    }

    public function BrandStore(Request $request): RedirectResponse
    {
 
        $validated = $request->validate([
            'brand_name_en' => 'required|max:255',
            'brand_image'=>'required|image',
        ]);


       // 

        $image=$request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('upload/brand'),$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        //
        //
        //$file = $request->file('profile_photo_path');
        

DB::table('brands')->insert([
    'brand_name' => $request->brand_name_en,
    'brand_slug'=>strtolower(str_replace(' ','-',$request->brand_name_en)),
    'brand_image'=>$save_url



]);



$notification = array(
    'message' => 'Brand Data Inserted date Successfully',
    'alert-type' => 'success'
 );

    

        return redirect()->route('brand.view')->with($notification);

  
    }







    Public function BrandEdit($id){
       $brand=DB::table('brands')->find($id);

       return view('backend.brand.brand_edit',compact('brand'));
    }

    public function BrandUpdate(Request $request){
        $validatedData=$request->validate([
            'brand_image'=>'image',

        'brand_name_en'=>'required|string|max:255'],
        
        [
            'brand_name_en.required'=>'Please insert brand name',

        ]);

       



        $brand_id = $request->id;
        $old_image = $request->old_image;
        $brand=DB::table('brands')->find( $brand_id);

 if($request->file('brand_image')){
  @unlink($old_image);

  $image=$request->brand_image;

  $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

  $image->move(public_path('upload/brand/'),$name_gen);
  $save_url = 'upload/brand/'.$name_gen;


$updated_brands=DB::table('brands')
                ->where('id',$brand_id)
                ->update([

    'brand_name' => $request->brand_name_en,
    'brand_slug'=>strtolower(str_replace(' ','-',$request->brand_name_en)),
    'brand_image'=>$save_url



                ]);
$notification = array(
    'message' => 'Brand Data Update Successfully',
    'alert-type' => 'info'
 );

 return redirect()->route('brand.view')->with($notification);
        

}
else{
    $updated_brands=DB::table('brands')
                ->where('id',$brand_id)
                ->update([

    'brand_name' => $request->brand_name_en,
    'brand_slug'=>strtolower(str_replace(' ','-',$request->brand_name_en)),
    


                ]);
$notification=array(
'message'=>'Brand Data updated Without Image',
'alert-type'=>'warning'


);
$notification=array(
    'message'=>'Brand Data updated Without Image',
    'alert-type'=>'warning'
    
    
    );
return redirect()->route('brand.view')->with($notification);

}




    }

    public function BrandDelete($id){
$brand=Brand::findOrfail($id);

$image=$brand->brand_image;
@unlink($image);

DB::table('brands')->where('id',$id)->delete();


$notification = array(
    'message' => 'Brand deleted Successfully',
    'alert-type' => 'danger'
 );

 return redirect()->route('brand.view')->with($notification);
    }


}
