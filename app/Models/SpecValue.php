<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecValue extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function spec(){
        return $this->belongsTo(Spec::class,'spec_id','id');
    }
}
