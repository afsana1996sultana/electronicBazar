<?php

namespace App\Models;

use App\Models\PCBuilding;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function brand(){
    	return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function warranty(){
    	return $this->belongsTo(Warranty::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }
    public function multi_imgs()
    {
        return $this->hasMany(MultiImg::class);
    }

    public function specs()
    {
        return $this->belongsToMany(Spec::class);
    }
    public function pcBuild()
    {
        return $this->belongsTo(PCBuilding::class,'pc_building_id');
    }

}
