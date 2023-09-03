<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        
        'category_slug',
    
        'category_image'
    ];


    public function subcategory(){
        
        return $this->hasMany(Subcategory::class,'category_id','id');
    }

    public function subsubcategory(){
        
        return $this->hasMany(SubSubcategory::class,'category_id','id');
    }
}
