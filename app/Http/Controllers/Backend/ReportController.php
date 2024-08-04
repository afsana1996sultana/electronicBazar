<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductStock;
use App\Models\Vendor;
use App\Models\Order;
use App\Models\OrderDetail;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_by =null;
        $products = Product::orderBy('created_at', 'desc');
        $categories = Category::where('id',$request->category_id)->select('id','name_en')->first();

        if(Auth::guard('admin')->user()->role == '2'){
            $products = Product::orderBy('created_at', 'desc')->where('vendor_id', Auth::guard('admin')->user()->id);
            if ($request->has('category_id')){
                $sort_by = $request->category_id;
                $products = $products->where('category_id', $sort_by);
            }
            $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
            if($vendor){
                $products = Product::where('vendor_id', $vendor->id)->latest()->paginate(20);
            }
        }else{
            if ($request->has('category_id')){
                $sort_by = $request->category_id;
                $products = $products->where('category_id', $sort_by);
            }
        }

        $products = $products->paginate(20);
        return view('backend.reports.index', compact('products','categories','sort_by'));
    }
    
    public function profitReport()
    {
        $currentMonth = Carbon::now()->month;
        
        //Today Frofit
        $today = Carbon::today();
        $ordersToday = Order::whereDate('created_at', $today)->get();
        $orderdetailsToday = collect();
        foreach ($ordersToday as $order) {
            $orderDetails = OrderDetail::where('order_id', $order->id)->get();
            $orderdetailsToday = $orderdetailsToday->merge($orderDetails);
        }
        $orderTodayTotal = $orderdetailsToday->sum(function($orderDetail) {
            return $orderDetail->price * $orderDetail->qty;
        }); 
        $orderTodayPur = $ordersToday->sum('pur_sub_total');
        $todayProfit = ($orderTodayTotal - $orderTodayPur);


        // Monthly Frofit
        $ordersMonthly = Order::whereMonth('created_at', $currentMonth)->get();
        $orderdetailsMonthly = collect();
        foreach ($ordersMonthly as $order) {
            $orderDetails = OrderDetail::where('order_id', $order->id)->get();
            $orderdetailsMonthly = $orderdetailsMonthly->merge($orderDetails);
        }
        $orderMonthlyTotal = $orderdetailsMonthly->sum(function($orderDetail) {
            return $orderDetail->price * $orderDetail->qty;
        });
        $orderMonthlyPur = $ordersMonthly->sum('pur_sub_total');
        $monthlyProfit = ($orderMonthlyTotal - $orderMonthlyPur);


        // Yearly Frofit
        $currentYear = Carbon::now()->year;
        $ordersYearly = Order::whereYear('created_at', $currentYear)->get();
        $orderdetailsYearly = collect();
        foreach ($ordersYearly as $order) {
            $orderDetails = OrderDetail::where('order_id', $order->id)->get();
            $orderdetailsYearly = $orderdetailsYearly->merge($orderDetails);
        }
        $orderYearlyTotal = $orderdetailsYearly->sum(function($orderDetail) {
            return $orderDetail->price * $orderDetail->qty;
        });
        $orderYearlyPur = $ordersYearly->sum('pur_sub_total');
        $yearlyProfit = ($orderYearlyTotal - $orderYearlyPur);
        
        return view('backend.reports.profit_report', compact('todayProfit', 'monthlyProfit', 'yearlyProfit',));
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
     * @param  int  $id
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
}