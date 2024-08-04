<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('admin')->user()->role != '1'){
            abort(404);
        }
        $customers = User::where('role', 3)->latest()->get();
    	return view('backend.customer.index',compact('customers'));
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
        $customer = User::findOrFail($id);
    }
    
    public function view($id)
    {
        $customer = User::findOrFail($id);
        return view('backend.customer.view',compact('customer'));
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
     
    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $customers = User::find($id);
        $customers->status = 1;
        $customers->save();

        Session::flash('success','Customer Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $customers = User::find($id);
        $customers->status = 0;
        $customers->save();

        Session::flash('warning','Customer Inactive Successfully.');
        return redirect()->back();
    }
    
    public function destroy($id)
    {
       	$customers = User::findOrFail($id);
    	try {
            if(file_exists($customers->brand_image)){
                unlink($customers->brand_image);
            }
        } catch (Exception $e) {
            
        }

    	$customers->delete();

        $notification = array(
            'message' => 'Customer Deleted Successfully.',
            'alert-type' => 'error'
        );
		return redirect()->back()->with($notification);
    }
}