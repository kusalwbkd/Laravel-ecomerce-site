<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function province(){
        return $this->belongsTo(Provice::class,'province_id','id');

    }

    public function district(){
        return $this->belongsTo(District::class,'district_id','id');

    }

    public function city(){
        return $this->belongsTo(City::class,'city_id','id');

    }
}


