<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;
use Carbon\Carbon;



// In here we use eloquent modal


class CategoryController extends Controller
{
    public function CategoryView(){

        $categories= Category::latest()->get();
        return view('backend.category.category_view',compact('categories'));


    }

    public function CategoryStore(Request $request){
        $validatedData=$request->validate([

            'category_name'=>'required|string|min:3',
            ],
            [

           'category_name.required'=>'please enter category name',
           
            ]);

            $data=new Category();


           

            $data->category_name=$request->category_name;
            $data->category_slug=strtolower(str_replace('','-',$request->category_name));
           

            $data->save();

            $notification=array(

                'message' => 'Category Inserted Succesfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('category.view')->with($notification);


    }




    public function CategoryEdit($id){
        $category=Category::findOrfail($id);

        return view('backend.category.category_edit',compact('category'));

    }



    public function CategoryUpdate(Request $request){

        $validatedData=$request->validate([

            'category_name'=>'required|string|min:3',
            ],
            [

           'category_name.required'=>'please enter category name',

            ]);


            $data=Category::findOrfail($request->id);
       

           

                $data->category_name=$request->category_name;
                $data->category_slug=strtolower(str_replace('','-',$request->category_name));
               
                $data->save();

                $notification=array(
                    'message' => 'Category Updated Successfully',
            'alert-type' => 'info'
         );
        
         return redirect()->route('category.view')->with($notification);


            
    }
    public function CategoryDelete($id){

        $category=Category::findOrfail($id);


       $category->delete($id);

      // $category->truncate();

$category->subcategory()->delete();
$category->subsubcategory()->delete();





        $notification=array(
            'message' => 'Category deleted Successfully',
    'alert-type' => 'danger'
 );

 return redirect()->route('category.view')->with($notification);
    
        
        
    }
}
