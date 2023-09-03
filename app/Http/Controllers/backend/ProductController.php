<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Multiimage;
use Image;
use Carbon\Carbon;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StorePostRequest;
use Illuminate\Validation\Rule;
use App\Rules\ProductsValidation;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function ProductAdd(){

       $categories = Category::latest()->get();
       $brands = Brand::latest()->get();
       return view('backend.product.product_add',compact('categories','brands'));

    }//end method

    public function ProductStore( StorePostRequest $request){

        //$validated = $request->validated();

         $image = $request->file('product_thambnail');
         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
         $image->move(public_path('upload/products/thambnail/'),$name_gen);
         $save_url = 'upload/products/thambnail/'.$name_gen;

        $product_id = Product::insertGetId([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name' => $request->product_name,
            
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
           
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'specifications' => $request->specifications,
            'long_descp' => $request->long_descp,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'product_thambnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        /****multiple image upload************/
        
        $images = $request->file('multi_img');
        foreach ($images as $img) {
         $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
         $img->move(public_path('upload/products/multi-image/'),$make_name);         
         $upload_path = 'upload/products/multi-image/'.$make_name;

         Multiimage::insert([
            
            'product_id' => $product_id,
            'photo_name' => $upload_path,
            'created_at' => Carbon::now(),

        ]);

        }
       
       

        /****************************************************/

        $notification = array(
           'message' => 'New product Added Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('manage.product')->with($notification);

    }//end method

    public function ManageProduct(){

        $products = Product::latest()->get();
        return view('backend.product.product_view',compact('products'));

    }//end method

    public function ProductDisplay($id){
        
        $multiImgs = Multiimage::where('product_id',$id)->get();
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $product = Product::findOrFail($id);
        return view('backend.product.product_display',compact('categories','brands','subcategories','subsubcategories','product','multiImgs'));

    }//end method in php

    public function ProductUpdate(UpdateUserRequest  $request,Product $product){
  
    
         $id=$request->id;
     
        $validated = $request->validated();

        
            Product::find($id)->update([

        
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_id' => $request->subsubcategory_id,
                'product_name' => $request->product_name,
                
                'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),
                'product_code' => $request->product_code,
                'product_qty' => $request->product_qty,
                'product_tags' => $request->product_tags,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,
        
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'specifications' => $request->specifications,
                'long_descp' => $request->long_descp,
        
                'hot_deals' => $request->hot_deals,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'special_deals' => $request->special_deals,
        
                
                'status' => 1,
                'created_at' => Carbon::now(),
        
        
            ]);
     
            $notification = array(
                'message' => 'Product Updated Successfully',
                'alert-type' => 'success'
             );
        
             return redirect()->route('manage.product')->with($notification);




        }
       
    
         
   

        public function ThambnailImageUpdate(Request $request){
            $pro_id = $request->id;
            $oldImage = $request->old_img;
            unlink($oldImage);
        
            $image = $request->file('product_thambnail');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('upload/products/thambnail/'),$name_gen);
                $save_url = 'upload/products/thambnail/'.$name_gen;
        
                Product::findOrFail($pro_id)->update([
                    'product_thambnail' => $save_url,
                    'updated_at' => Carbon::now(),
        
                ]);
        
                 $notification = array(
                    'message' => 'Product Image Thambnail Updated Successfully',
                    'alert-type' => 'info'
                );
        
                return redirect()->back()->with($notification);
        
             } // end method
    

             public function MultiImageUpdate(Request $request){
                $imgs = $request->multi_img;
        
                foreach($imgs as $id => $img) {
                $imgDel = Multiimage::findOrFail($id);
                unlink($imgDel->photo_name);
        
                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                $img->move(public_path('upload/products/multi-image/'),$make_name);         
                $uploadPath = 'upload/products/multi-image/'.$make_name;
        
                Multiimage::where('id',$id)->update([
                    'photo_name' => $uploadPath,
                    'updated_at' => Carbon::now(),
        
                ]);
        
             } // end foreach 


             $notification = array(
                'message' => 'product images Updated Successfully',
                'alert-type' => 'info'
            );
    
            return redirect()->back()->with($notification);
    
            }
    

          
        
    

     //// Multi Image Delete ////
     public function MultiImageDelete($id){
        $oldimg = Multiimage::findOrFail($id);
        unlink($oldimg->photo_name);
        Multiimage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Image Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);

     } // end method 


    public function ProductInactive($id){
        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

     }//end method


  public function ProductActive($id){
    Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method


  
  public function ProductDelete($id){
    
        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        Product::findOrFail($id)->delete();

        $images = Multiimage::where('product_id',$id)->get();
        foreach ($images as $img) {
            unlink($img->photo_name);
            Multiimage::where('product_id',$id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);

     }// end method 

}