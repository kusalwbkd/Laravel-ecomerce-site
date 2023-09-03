<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function SubCategoryView(){

        $subcategories = SubCategory::latest()->get();

        $categories = Category::orderBy('category_name','ASC')->
        get();
        return view('backend.category.subcategory_view',compact('categories','subcategories'));
    }

    public function SubCategoryStore(Request $request){
        $validatedData=$request->validate([

         'category_id'=>'required',
	     'subcategory_name'=>'required|string|min:3'],
         [
            'category_id.required'=>'Please select a category',

                    

         ]);


         $data=new SubCategory();
         $data->subcategory_name=$request->subcategory_name;
         $data->category_id=$request->category_id;
         $data->subcategory_slug=strtolower(str_replace('','-',$request->subcategory_name));

         $data->save();

         $notifications=array(
            'message'=>'Sub Category inserted succesfully',
            'alert-type' => 'success'

         );

         return redirect()->route('subcategory.view')->with($notifications);

    }

    public function SubCategoryEdit($id){
        $subcategory=SubCategory::findOrFail($id);
        $categories = Category::orderBy('category_name','ASC')->
        get();
        return view('backend.category.subcategory_edit',compact('subcategory','categories'));
    }

    public function SubCategoryUpdate(Request $request){
        $validatedData=$request->validate([

            'category_id'=>'required',
            'subcategory_name'=>'required|string|min:3'],
            [
               'category_id.required'=>'Please select a category',
   
                       
   
            ]);

            $data=SubCategory::findOrfail($request->id);

            $data->category_id=$request->category_id;
            $data->subcategory_name=$request->subcategory_name;
            $data->subcategory_slug=urlencode(strtolower(str_replace('','-',$request->subcategory_name)));
            $data->save();


            $notifications=array(
                'message'=>'Sub Category Updated succesfully',
                'alert-type' => 'info'
    
             );
    
             return redirect()->route('subcategory.view')->with($notifications);
    

    
}

public function SubCategoryDelete($id){


    $subcategory=SubCategory::findOrfail($id);

    $subcategory->subsubcategory()->delete();

$subcategory->delete();
$notifications=array(
    'message'=>'Sub Category Deleted',
    'alert-type' => 'danger'

 );

 return redirect()->route('subcategory.view')->with($notifications);

}

}
