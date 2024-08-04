<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Session;
use App\Models\Page;
use App\Models\Spec;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Banner;
use App\Models\PcCart;
use App\Models\Slider;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Attribute;
use App\Models\EmiContent;
use App\Models\PCBuilding;
use App\Models\OrderDetail;
use App\Models\ProductSpec;
use Illuminate\Http\Request;
use App\Utility\CategoryUtility;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class FrontendController extends Controller
{
    /*=================== Start Index Methoed ===================*/
    public function index(Request $request)
    {
        if(!Auth::check()){
            if(!Session::has('guest_user_id')){
                Session::put('guest_user_id', rand(10000000, 99999999));
            }
        }
        //Product All Status Active
        $products = Product::where('status',1)->where('is_featured',1)->orderBy('id','DESC')->get();

        // Search Start
        $sort_search =null;
        if ($request->has('search')){
            $sort_search = $request->search;
            $products = $products->where('name_en', 'like', '%'.$sort_search.'%');
            // dd($products);
        }else{
            $products = Product::where('status',1)->where('is_featured',1)->orderBy('id','DESC')->limit(30)->get();
        }
        $categories = new Collection();
        // Header Category End

        // Category Featured all
        $featured_category = Category::orderBy('name_en','DESC')->where('is_featured','=',1)->where('status','=',1)->limit(15)->get();

        //Slider
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(10)->get();
        // Product Top Selling
        $product_top_sellings = Product::where('status',1)->orderBy('id','ASC')->limit(2)->get();
        //Product Trending
        $product_trendings = Product::where('status',1)->orderBy('id','ASC')->skip(2)->limit(2)->get();
        //Product Recently Added
        $product_recently_adds = Product::where('status',1)->latest()->skip(2)->limit(2)->get();

        $product_top_rates = Product::where('status',1)->orderBy('regular_price')->limit(2)->get();
        // Home Banner
        $home_banners = Banner::where('status',1)->where('position',1)->orderBy('id','DESC')->get();

        // Daily Best Sells
        //dd(date('Y-m-d'));
        $todays_sale  = OrderDetail::where('created_at', 'like', '%'.date('Y-m-d').'%')->get();
        //$todays_sale  = DB::table('order_details')->select('*')->where('created_at', 'like', '%'.date('Y-m-d').'%')->get();
        $todays_sale = $todays_sale->unique('product_id');
        //Home2 featured category
        $home2_featured_categories = Category::orderBy('name_en','DESC')->where('is_featured','=',1)->where('status','=',1)->get();
        // Hot deals product
        $hot_deals = Product::where('status',1)->where('is_deals',1)->latest()->take(4)->get();
        $digital_products = Product::where('status',1)->where('is_digital',1)->latest()->take(12)->get();

        $home_view = 'frontend.home';
        return view($home_view, compact('categories','sliders','featured_category','products','product_top_sellings','product_trendings','product_recently_adds','product_top_rates','home_banners','sort_search','todays_sale','home2_featured_categories','hot_deals','digital_products'));
    } // end method

    public function index2(Request $request)
    {

        //Product All Status Active
        $products = Product::where('status',1)->orderBy('id','DESC')->get();

        // Search Start
        $sort_search =null;
        if ($request->has('search')){
            $sort_search = $request->search;
            $products = $products->where('name_en', 'like', '%'.$sort_search.'%');
            // dd($products);
        }else{
            $products = Product::where('status',1)->orderBy('id','DESC')->get();
        }
        // $products = $products->paginate(15);
        // Search Start

        // Header Category Start
        $categories = Category::orderBy('name_en','DESC')->where('id', '>', 1)->where('status','=',1)->limit(5)->get();
        // Header Category End

        // Category Featured all
        $featured_category = Category::orderBy('name_en','DESC')->where('is_featured','=',1)->where('status','=',1)->limit(15)->get();

        //Slider
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(10)->get();
        // Product Top Selling
        $product_top_sellings = Product::where('status',1)->orderBy('id','ASC')->limit(2)->get();
        //Product Trending
        $product_trendings = Product::where('status',1)->orderBy('id','ASC')->skip(2)->limit(2)->get();
        //Product Recently Added
        $product_recently_adds = Product::where('status',1)->latest()->skip(2)->limit(2)->get();

        $product_top_rates = Product::where('status',1)->orderBy('regular_price')->limit(2)->get();
        // Home Banner
        $home_banners = Banner::where('status',1)->where('position',1)->orderBy('id','DESC')->get();

        // Daily Best Sells
        //dd(date('Y-m-d'));
        $todays_sale  = OrderDetail::where('created_at', 'like', '%'.date('Y-m-d').'%')->get();
        // dd($todays_sale);

        //Home2 featured category
        $home2_featured_categories = Category::orderBy('name_en','DESC')->where('is_featured','=',1)->where('status','=',1)->get();
        // Hot deals product
        $hot_deals = Product::where('status',1)->where('is_deals',1)->latest()->take(4)->get();

        return view('frontend.home2', compact('categories','sliders','featured_category','products','product_top_sellings','product_trendings','product_recently_adds','product_top_rates','home_banners','sort_search','todays_sale','home2_featured_categories','hot_deals'));
    } // end method

    /* ========== Start ProductDetails Method ======== */
    public function productDetails($slug){

        $product = Product::where('slug', $slug)->first();
        // dd($product);
        if($product->id){
            $multiImg = MultiImg::where('product_id',$product->id)->get();
        }
        // dd($multiImg);

        /* ================= Product Color Eng ================== */
        $color_en = $product->product_color_en;
        $product_color_en = explode(',', $color_en);

        /* ================= Product Size Eng =================== */
        $size_en = $product->product_size_en;
        $product_size_en = explode(',', $size_en);

        /* ================= Realted Product =============== */
        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$product->id)->orderBy('id','DESC')->get();

        $specs = ProductSpec::where('product_id',$product->id)->orderBy('id','ASC')->get();
        //dd($specs);

        $categories = Category::orderBy('name_en','ASC')->where('id', '>', 1)->where('status','=',1)->limit(5)->get();
        $new_products = Product::orderBy('name_en')->where('status','=',1)->limit(3)->latest()->get();

        return view('frontend.product.product_details', compact('product','multiImg','categories','new_products','product_color_en','product_size_en','relatedProduct', 'specs'));
    }

    /* ========== Start CatWiseProduct Method ======== */
    public function CatWiseProduct(Request $request,$slug){

        $category = Category::where('slug', $slug)->first();
        $pc_id = PCBuilding::where('slug',$slug)->first();
        $brand = Brand::where('slug',$slug)->first();
        // dd($category);

        $min_price = $request->get('filter_price_start');
        $max_price = $request->get('filter_price_end');

        $conditions = ['status' => 1];

        if($request->brand_id != null && $request->brand_id>0){
            $conditions = array_merge($conditions, ['brand_id' => $request->brand_id]);
        }

        $products = Product::query();
         if($category){
            $products = $products->where($conditions);
            $category_ids = CategoryUtility::children_ids($category->id);
            $category_ids[] = $category->id;
            $products->whereIn('category_id', $category_ids);
            $products = $products->orderBy('created_at', 'desc')->paginate(20);
         }elseif($brand){
            $products = Product::where('brand_id', $brand->id)->where('status', 1)->orderBy('regular_price','asc')->paginate(20);
         }
         else{
            $products = Product::where('pc_building_id', $pc_id->id)->where('status', 1)->orderBy('regular_price','asc')->paginate(20);
         }


        if($min_price != null && $max_price != null){
            $products->where('regular_price', '>=', $min_price)->where('regular_price', '<=', $max_price);
        }
        $filter_specs = $request->get('filter_specs');
        $filter_specs_data = array();
        if($filter_specs != null){
            $filter_specs_data = explode('_', $filter_specs);
            $spec_product_ids = array();
            $product_specs_result = DB::table('product_specs')
                    ->whereIn('spec_value_id', $filter_specs_data)
                    ->get();
            $spec_product_ids = array_column($product_specs_result->toArray(), 'product_id');
            $spec_product_ids = array_unique($spec_product_ids);
            $products->whereIn('id', $spec_product_ids);
        }
        $products_count = $products->count();
        // dd($products_all);
       // $products = $products->orderBy('created_at', 'desc')->paginate(20);
        $categories = Category::orderBy('name_en','ASC')->where('status','=',1)->get();
        // dd($products)
        if($category){
            if($category->specs){
                $cat_specs = json_decode($category->specs);
                if($cat_specs && count($cat_specs)>0){
                    $specs = Spec::whereIn('id', $cat_specs)->orderBy('id', 'desc')->get();
                }else{
                    $specs = array();
                }
            }else{
                $specs = array();
            }
        } else {
            $specs = array();
        }

        return view('frontend.product.category_view',compact('products_count','products','categories','category', 'specs', 'filter_specs_data','brand','pc_id'));
    } // end method
    /* ========== End CatWiseProduct Method ======== */

     /* ========== Start CatWiseProduct Method ======== */
    public function VendorWiseProduct(Request $request,$slug){

        $vendor = Vendor::where('slug', $slug)->first();
        // dd($category);

        $products = Product::where('status', 1)->where('vendor_id',$vendor->id)->orderBy('id','DESC')->paginate(20);
        // Price Filter
        if ($request->get('filter_price_start')!== Null && $request->get('filter_price_end')!== Null ){
            $filter_price_start = $request->get('filter_price_start');
            $filter_price_end = $request->get('filter_price_end');

            if ($filter_price_start>0 && $filter_price_end>0) {
                $products = Product::where('status','=',1)->where('vendor_id',$vendor->id)->whereBetween('regular_price',[$filter_price_start,$filter_price_end])->paginate(20);
                // dd($products);
            }

        }

        $categories = Category::orderBy('name_en','ASC')->where('status','=',1)->get();
        // dd($products);

        return view('frontend.product.vendor_view',compact('products','categories','vendor'));
    } // end method
    /* ========== End CatWiseProduct Method ======== */

    /* ========== Start SubCatWiseProduct Method ======== */
    public function SubCatWiseProduct($id,$slug){

        $products = Product::where('status','=',1)->where('subcategory_id',$id)->orderBy('id','DESC')->paginate(5);
        $categories = Category::orderBy('name_en','ASC')->where('status','=',1)->limit(5)->get();
        //$subcategory = SubCategory::find($id);
        $new_products = Product::orderBy('name_en')->where('status','=',1)->limit(3)->latest()->get();

        return view('frontend.product.subcategory_view',compact('products','categories','subcategory','new_products'));
    } // end method
    /* ========== End SubCatWiseProduct Method ======== */

    /* ========== Start ChildCatWiseProduct Method ======== */
    public function ChildCatWiseProduct($id,$slug){

        $products = Product::where('status','=',1)->where('subsubcategory_id',$id)->orderBy('id','DESC')->paginate(5);
        $categories = Category::orderBy('name_en','ASC')->where('status','=',1)->limit(5)->get();
        //$subsubcategory = SubSubCategory::find($id);
        $new_products = Product::orderBy('name_en')->where('status','=',1)->limit(3)->latest()->get();

        return view('frontend.product.childcategory_view',compact('products','categories','subsubcategory','new_products'));
    } // end method
    /* ========== End ChildCatWiseProduct Method ======== */

    /* ================= Start ProductViewAjax Method ================= */
    public function ProductViewAjax($id){

        $product = Product::with('category','brand')->findOrFail($id);
        //dd($product);
        $attribute_values = json_decode($product->attribute_values);

        $attributes = new Collection;
        foreach($attribute_values as $key => $attribute_value){
            $attr = Attribute::select('id','name')->where('id',$attribute_value->attribute_id)->first();
            // $attribute->name = $attr->name;
            // $attribute->id = $attr->id;
            $attr->values = $attribute_value->values;
            $attributes->add($attr);
        }


        return response()->json(array(
            'product' => $product,
            'attributes' => $attributes,
        ));
    }
    /* ================= END PRODUCT VIEW WITH MODAL METHOD =================== */


    public function pageAbout($slug){
        $page = Page::where('slug', $slug)->first();
        return view('frontend.settings.page.about',compact('page'));
    }

    public function orderTracking()
    {
        return view('frontend.settings.page.order_tracking');
    }


    public function orderTrack(Request $request)
    {
        $this->validate($request,[
            'invoice_no' => 'required',
            'phone' => 'required',
        ]);
        $order = Order::where('invoice_no', $request->invoice_no)->where('phone', $request->phone)->first();
        if(!$order){
            $notification = array(
                'message' => 'Required Data Not Found.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        // dd($order);
        return view('frontend.settings.page.track',compact('order'));
    }

    /* ================= Start Product Search =================== */
    public function ProductSearch(Request $request){
        $item = $request->search;
        $category_id = $request->searchCategory;
        // Header Category Start //
        $categories = Category::orderBy('name_en','DESC')->where('status', 1)->get();
        $products = Product::query();
        if($category_id == 0){
            $products = $products->where('name_en','LIKE',"%$item%")->where('status'
            , 1);
        }else{
            $products = $products->where('name_en','LIKE',"%$item%")->where('category_id', $category_id)->where('status'
            , 1);
        }
        $products_count = $products->count();
        $products = $products->latest()->paginate(20);
        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();
        return view('frontend.product.search',compact('products','categories','attributes','products_count'));

    } // end method

    /* ================= End Product Search =================== */

    /* ================= Start Advance Product Search =================== */
    public function advanceProduct(Request $request)
    {
        // return $request;
        $request->validate(["search" => "required"]);

        $item = $request->search;
        $category_id = $request->category;

        if($category_id == 0){
            $products = Product::where('name_en','LIKE',"%$item%")->where('status'
            , 1)->latest()->get();
        }else{
            $products = Product::where('name_en','LIKE',"%$item%")->where('category_id', $category_id)->where('status'
            , 1)->latest()->get();
        }
        return json_decode($products);

    } // end method

    /* ================= End Advance Product Search =================== */

    /* ================= Start Hot Deals Page Show =================== */
    public function hotDeals(Request $request){

        // Hot deals product
        $products = Product::where('status',1)->where('is_deals',1)->paginate(5);

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

            $products = Product::whereIn('category_id', $catId)->where('status', 1)->where('is_deals',1)->latest()->paginate(10);
            // dd($products);
        }
        // Category Filter End

        $attributes = Attribute::orderBy('name', 'DESC')->where('status', 1)->latest()->get();
        // End Shop Product //
        return view('frontend.deals.hot_deals',compact('attributes','products'));

    } // end method


    public function pcBuilding(){
        $s_id = session()->get('session_id');
        $pc_Cart = PcCart::where('session_id', $s_id)->get();
        $excludedBuildingIds = $pc_Cart->pluck('product.pc_building_id')->toArray();
        $pc_buildings = PCBuilding::whereNotIn('id', $excludedBuildingIds)
            ->orderBy('priority', 'ASC')
            ->get();
        //dd($pc_buildings);
        $share = new \Jorenvh\Share\Share();
        $shareButton = $share->page(url('/sharePdfPage'), 'Pc Build Products')
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp();
        return view('frontend.product.pc_building',compact('pc_buildings','shareButton','pc_Cart'));
    }
    public function sharePdfPage(){
        $s_id = session()->get('session_id');
        $pc_Cart = PcCart::where('session_id', $s_id)->get();
        $latestDateTime = PcCart::where('session_id', $s_id)->orderBy('created_at', 'desc')->first();
        return view('frontend.common.sharepdf',compact('pc_Cart','latestDateTime'));
    }

    public function emi_information(){
        $emiContent=EmiContent::first();
        return view('frontend.emiContent.index',compact('emiContent'));
    }
    public function brand_show(){
        $brands=Brand::latest()->get();
        return view('frontend.brand.brand',compact('brands'));
    }
}