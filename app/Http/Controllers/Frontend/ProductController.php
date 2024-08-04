<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Header Category Start
        $categories = Category::orderBy('name_en','DESC')->where('status', 1)->get();

        $sort_by = $request->sort_by;
        $brand_id = $request->brand;

        $conditions = ['status' => 1];

        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }elseif ($request->brand != null) {
            $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        $products_sort_by = Product::where($conditions);

        switch ($sort_by) {
            case 'newest':
                $products_sort_by->orderBy('created_at', 'desc')->paginate(10);
                break;
            case 'oldest':
                $products_sort_by->orderBy('created_at', 'asc')->paginate(10);
                break;
            case 'price-asc':
                $products_sort_by->orderBy('regular_price', 'asc')->paginate(10);
                break;
            case 'price-desc':
                $products_sort_by->orderBy('regular_price', 'desc')->paginate(10);
                break;
            default:
                $products_sort_by->orderBy('id', 'desc')->paginate(10);
                break;
        }


        // Start Shop Product //
        $products = Product::orderBy('name_en', 'ASC')->where('status', 1)->latest()->paginate(10);

        // Category Filter Start
        if ($request->get('filtercategory')){

            $checked = $_GET['filtercategory'];
            // filter With name start
            $category_filter = Category::whereIn('name_en', $checked)->get();
            $catId = [];
            foreach($category_filter as $cat_list){
                array_push($catId, $cat_list->id);
            }
            // filter With name end

            $products = Product::whereIn('category_id', $catId)->where('status', 1)->latest()->paginate(10);
            // dd($products);
        }
        // Category Filter End

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();
        // End Shop Product //

        return view('frontend.product.product_shop', compact('categories','attributes','products','sort_by','brand_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $varient
     * @return \Illuminate\Http\Response
     */
    public function getVarient($id, $varient)
    {
        //dd($varient);
        $stock = ProductStock::where('product_id', $id)->where('varient', $varient)->with('product')->first();
       // dd($stock);
        if($stock){
            return $stock;
        }else{
            return null;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function wholesell_price(Request $request){
        $product = Product::where('id', $request->product_id)->first();
        if ($product->is_wholesell == 1) {
            if ($product->wholesell_minimum_qty == $request->qty || $product->wholesell_minimum_qty < $request->qty) {
                $wholePrice = $product->wholesell_price;
                return response()->json(['wholePrice' => $wholePrice]);
            }
            elseif($product->wholesell_minimum_qty > $request->qty) {
                $wholePrice = $request->product_price;
                return response()->json(['wholePrice' => $wholePrice]);
            }
        } else {
            $wholePrice = $request->product_price;
            return response()->json(['wholePrice' => $wholePrice]);
        }
    }
    
}
