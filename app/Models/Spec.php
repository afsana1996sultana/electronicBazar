<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function spec_values()
    {
        return $this->hasMany('App\Models\SpecValue');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
