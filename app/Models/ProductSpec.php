<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpec extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function product(){
    	return $this->belongsTo(Product::class,'product_id','id');
    }

    public function speci(){
    	return $this->belongsTo(Spec::class,'spec_id','id');
    }

    public function spec_val(){
    	return $this->belongsTo(SpecValue::class,'spec_value_id','id');
    }
}
