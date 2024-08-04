<?php

namespace App\Http\Controllers\Frontend;

use App\Models\WishList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class WishListController extends Controller
{
    public function add_wishlist($id){

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
            $wishlist = Wishlist::where('user_id', $user_id)
            ->where('product_id', $id)
            ->first();
        }else{

            $wishlist = Wishlist::where('session_id', $s_id)
            ->where('product_id', $id)
            ->first();
        }
        if($wishlist){
           return response()->json(['error'=> "This Product already Added to Your Wishlist"]);
        }else{
            WishList::create([
                'session_id'=>$s_id,
                'user_id'=>auth()->user()->id??null,
                'product_id'=>$id,
            ]);
            return response()->json([
                'success' => "Product Added to Wishlist successfully",
            ]);
        }
    }
    public function listViewWistList()
    {
        $user_id = auth()->user()->id ?? null;
        $s_id = session()->get('session_id');
        if ($user_id != null) {
            $wishCount = WishList::where('user_id', $user_id)->get();
        } else {
            $wishCount = WishList::where('session_id', $s_id)->get();
        }
        return response()->json([
            'wish_data' => view('frontend.common.wishdata', compact('wishCount'))->render(),
        ]);
    }
    public function getWishCount()
    {
        $user_id = auth()->user()->id ?? null;
        $s_id = session()->get('session_id');
        if ($user_id != null) {
            $wishCount = WishList::where('user_id', $user_id)->count();
        } else {
            $wishCount = WishList::where('session_id', $s_id)->count();
        }
        return response()->json(['wish_count' => $wishCount]);
    }
    public function removeFromwishList($id)
    {
        $wishlist   = Wishlist::findorFail($id);
        Artisan::call('cache:clear');
        if($wishlist) {
            $wishlist->delete();
            return response()->json(['error' => 'Deleted From Wishlist']);
        }
        return response()->json(['error' => 'This product isn\'t available in your wishlsit']);
    }
}