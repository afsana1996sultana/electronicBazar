<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Compare;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class CompareController extends Controller
{
    public function add_comparelist($id){
        $s_id = session()->get('session_id');
        if ($s_id == null) {
            session()->put('session_id', uniqid());
            $s_id = session()->get('session_id');
        }
        $user_id = auth()->user()->id??null;
        if(!$user_id){
             return response()->json(['error'=> "You have to login first"]);
        }
        if($user_id != null){
            $comparelist = Compare::where('user_id', $user_id)
            ->where('product_id', $id)
            ->first();
        }else{
            $comparelist = Compare::where('session_id', $s_id)
            ->where('product_id', $id)
            ->first();
        }
        if($comparelist){
           return response()->json(['error'=> "This Product already Added to Your comparelist"]);
        }else{
            Compare::create([
                'session_id'=>$s_id,
                'user_id'=>auth()->user()->id??null,
                'product_id'=>$id,
            ]);
            return response()->json([
                'success' => "Product Added to comparelist successfully",
            ]);
        }
    }
    public function listViewCompareList()
    {
        $user_id = auth()->user()->id ?? null;
        $s_id = session()->get('session_id');
        if ($user_id != null) {
            $compareCount = Compare::where('user_id', $user_id)->get();
        } else {
            $compareCount = Compare::where('session_id', $s_id)->get();
        }
        return response()->json([
            'compare_data' => view('frontend.common.comparedata', compact('compareCount'))->render(),
        ]);
    }
    public function getcompareCount()
    {
        $user_id = auth()->user()->id ?? null;
        $s_id = session()->get('session_id');
        if ($user_id != null) {
            $compareCount = Compare::where('user_id', $user_id)->count();
        } else {
            $compareCount = Compare::where('session_id', $s_id)->count();
        }
        return response()->json(['compare_count' => $compareCount]);
    }
    public function removeFromCompareList($id)
    {
        $Compare   = Compare::findorFail($id);
        Artisan::call('cache:clear');
        if($Compare) {
            $Compare->delete();
            return response()->json(['error' => 'Deleted From Comparelist']);
        }
        return response()->json(['error' => 'This product isn\'t available in your Comparelsit']);
    }
}