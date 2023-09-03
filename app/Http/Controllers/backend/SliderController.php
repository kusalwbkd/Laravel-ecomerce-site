<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
use Carbon\Carbon;
class SliderController extends Controller
{
    public function SliderView(){
        $sliders=Slider::latest()->get();
        return view('backend.slider.slider_view',compact('sliders'));
    }

    public function SliderStore(Request $request){
        $validatedData=$request->validate([

           
            'slider_img'=>'required','image',

        ]);

        $slider=new Slider();


        
            $image=$request->file('slider_img');

            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload/slider/'),$name_gen);         
            $save_url = 'upload/slider/'.$name_gen;
            
            
            
                    
            
            
                    $slider->title=$request->title;
                    $slider->description=$request->description;
                    $slider->slider_image=$save_url;
            
                    $slider->save();
            
            
                    $notification=array(
                        'message' => 'Slider Inserted Succesfully!',
                        'alert-type' => 'success'
                     );
                    
                     return redirect()->route('manage.slider')->with($notification);
            
            

        

        




        


       
    }

    public function SliderInactivate($id){
$slider=Slider::findOrFail($id)->update(['status' => 0]);

$notification = array(
    'message' => 'Slider Inactive',
    'alert-type' => 'warning'
);

return redirect()->back()->with($notification);





    }

    public function Slideractivate($id){
        $slider=Slider::findOrFail($id)->update(['status' => 1]);
        
        $notification = array(
            'message' => 'Slider active',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
        
        
        
            }
    public function SliderEdit($id){

        $slider=Slider::findOrFail($id);

        return view('backend.slider.slider_edit',compact('slider'));
    }




    public function SliderUpdate(Request $request){
        $validatedData=$request->validate([

            'slider_img'=>'nullable|image',
     

        ]);



        $slider_id = $request->id;
        $old_image = $request->old_image;
        $slider=Slider::findOrfail($slider_id);


        if($request->file('slider_img')){
  @unlink($old_image);

  $image=$request->slider_img;

  $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

  $image->move(public_path('upload/slider/'),$name_gen);         
  $save_url = 'upload/slider/'.$name_gen;

$slider->title=$request->title;
$slider->description=$request->description;
$slider->slider_image=$save_url;
$slider->save();
$notification = array(
    'message' => 'Slider Update Successfully',
    'alert-type' => 'info'
 );

 return redirect()->route('manage.slider')->with($notification);
        

}


else{
    $slider->title=$request->title;
    $slider->description=$request->description;

    $slider->save();


    $notification=array(
        'message' => 'Slider Update Without image Succesfully!',
        'alert-type' => 'info'
     );
    
     return redirect()->route('manage.slider')->with($notification);

}
    }

    public function SliderDelete($id){

        $slider=Slider::findOrFail($id);

        $image=$slider->slider_image;
        @unlink($image);


        $slider->delete();

        $notification = array(
            'message' => 'Slider deleted Successfully',
            'alert-type' => 'warning'
         );
        
         return redirect()->route('manage.slider')->with($notification);
            }
    }

