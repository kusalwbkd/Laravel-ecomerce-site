<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_id',
        
        'category_id',
    
        'subcategory_id',
        'subsubcategory_id',
        'product_name',
        'product_slug',
        'product_code',
        'product_qty',
        'product_tags',
        'product_size',
        'product_color',
        'selling_price',
        'discount_price',
        'short_descp',
        'long_descp',
        'product_thambnail',
        'hot_deals',
        'featured',
        'special_offer',
        'special_deals',
        'status'


















    ];




    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }


    public function brand(){
    	return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class,'product_id','id');
    }

    public function cart(){
        return $this->hasMany(Cart::class,'product_id','id');

    }

}