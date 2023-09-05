<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provice extends Model
{
    use HasFactory;
    protected $guarded=[];

public function district(){

    return $this->hasMany(Provice::class,'province_id','id');

}

}