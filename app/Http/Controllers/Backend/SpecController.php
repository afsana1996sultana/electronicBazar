<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spec;
use App\Models\SpecValue;
use Illuminate\Support\Carbon;
use Session;
use Auth;

class SpecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specifications = Spec::oldest()->get();
        return view('backend.spec.index', compact('specifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.spec.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);

        $spec = new Spec();
        $spec->name = $request->name;

        /* ======== Status   ======= */
        if($request->status == Null){
            $request->status = 0;
        }
        $spec->status = $request->status;

        /* ======== Featured   ======= */
        if($request->is_featured == Null){
            $request->is_featured = 0;
        }
        $spec->is_featured = $request->is_featured;

        $spec->created_by = Auth::guard('admin')->user()->id;
        $spec->created_at = Carbon::now();
        $spec->save();

        Session::flash('success','Specification Inserted Successfully');
        return redirect()->route('specifications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $spec = Spec::findOrFail($id);
        $values = SpecValue::where('spec_id', $id)->get();
        return view('backend.spec.show',compact('spec', 'values'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spec = Spec::findOrFail($id);
        return view('backend.spec.edit',compact('spec'));
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
        $spec = Spec::find($id);

        // Spec table update
        $spec->name = $request->name;

        /* ======== Status   ======= */
        if($request->status == Null){
            $request->status = 0;
        }
        $spec->status = $request->status;

        /* ======== Featured   ======= */
        if($request->is_featured == Null){
            $request->is_featured = 0;
        }
        $spec->is_featured = $request->is_featured;

        $spec->created_by = Auth::guard('admin')->user()->id;
        $spec->save();

        $notification = array(
            'message' => 'Specification Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('specifications.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spec = Spec::findOrFail($id);
        $spec->delete();

        $notification = array(
            'message' => 'Specification Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // Spec Status
    public function changeStatus($id){
        $spec = Spec::find($id);
        if($spec->status == 0){
            $spec->status = 1;
        }else{
            $spec->status = 0;
        }
        $spec->save();

        Session::flash('success','Status Changed Successfully.');
        return redirect()->back();
    }

    // Spec Feature
    public function changeFeatureStatus($id){
        $spec = Spec::find($id);
        if($spec->is_featured == 0){
            $spec->is_featured = 1;
        }else{
            $spec->is_featured = 0;
        }
        $spec->save();

        Session::flash('success','Feature Status Changed Successfully.');
        return redirect()->back();
    }
    
    // Value Store
    public function value_store(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'value' => 'required',
        ]);

        $value = new SpecValue();
        $value->spec_id = $request->spec_id;
        $value->value = $request->value;
        $value->created_by = Auth::guard('admin')->user()->id;
        $value->created_at = Carbon::now();
        $value->save();

        Session::flash('success','Value Inserted Successfully');
        return redirect()->back();
    }

    // Specification Value Delete
    public function value_destroy($id)
    {
        $spec_value = SpecValue::findOrFail($id);
        $spec_value->delete();

        $notification = array(
            'message' => 'Specification Value Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    /*=================== Start Active/Inactive Methoed ===================*/
    public function value_active($id){
        $spec_value = SpecValue::find($id);
        $spec_value->status = 1;
        $spec_value->save();

        Session::flash('success','Specification Value Active Successfully.');
        return redirect()->back();
    }

    public function value_inactive($id){
        $spec_value = SpecValue::find($id);
        $spec_value->status = 0;
        $spec_value->save();

        Session::flash('warning','Specification Value Inactive Successfully.');
        return redirect()->back();
    }
}