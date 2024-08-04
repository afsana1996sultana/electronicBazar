<?php

namespace App\Http\Controllers\Admin;

use App\Models\PCBuilding;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class PCBuildingController extends Controller
{
    /*=================== Start BrandView Methoed ===================*/
    public function index(){
    	$pc_buldings = PCBuilding::orderBy('id','asc')->get();
    	return view('backend.pc-building.index',compact('pc_buldings'));
    }

    /*=================== Start BrandAdd Methoed ===================*/
    public function create(){
        return view('backend.pc-building.create');

    }

    /*=================== Start BrandStore Methoed ===================*/
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'image' => 'required',
            'priority' => 'required|unique:p_c_buildings',
        ]);

        if($request->hasfile('image')){
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(160,160)->save('upload/pc-building/'.$name_gen);
            $save_url = 'upload/pc-building/'.$name_gen;
        }else{
            $save_url = '';
        }
        $pc_building = new PCBuilding();
        $pc_building->name = $request->name;
        $pc_building->slug = Str::slug($request->name);
        $pc_building->priority = $request->priority;
        $pc_building->status = $request->status;
        $pc_building->description = $request->description;
        $pc_building->others = $request->others ? 1 : 0;
        $pc_building->image = $save_url;
        $pc_building->created_by = Auth::guard('admin')->user()->id;
        $pc_building->created_at = Carbon::now();

        $pc_building->save();

		Session::flash('success','PC Building Inserted Successfully');
		return redirect()->route('pc-building.index');

    } // end method

    /*=================== Start BrandEdit Methoed ===================*/
    public function edit($id){
    	$pc_building = PCBuilding::findOrFail($id);
    	return view('backend.pc-building.edit',compact('pc_building'));
    }

    /*=================== Start BrandUpdate Methoed ===================*/
    public function update(Request $request, $id){
        $pc_building = PCBuilding::find($id);
        
        $this->validate($request,[
            'name' => 'required',
            // 'image' => 'required',
            'priority' =>['required', Rule::unique('p_c_buildings')->ignore($pc_building->id)],
        ]);
        
        //Brand Photo Update
        if($request->hasfile('image')){
            try {
                if(file_exists($pc_building->image)){
                    unlink($pc_building->image);
                }
            } catch (Exception $e) {

            }
            $brand_image = $request->image;
            $brand_save = time().$brand_image->getClientOriginalName();
            $brand_image->move('upload/pc-building/',$brand_save);
            $pc_building->image = 'upload/pc-building/'.$brand_save;
        }else{
            $brand_save = '';
        }

        // Brand table update
        $pc_building->name = $request->name;
        $pc_building->slug = Str::slug($request->name);
        $pc_building->priority = $request->priority;
        $pc_building->status = $request->status;
        $pc_building->others = $request->others ? 1 : 0;
        $pc_building->description = $request->description;
        $pc_building->created_by = Auth::guard('admin')->user()->id;
        $pc_building->save();




        $notification = array(
            'message' => 'PC Building Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('pc-building.index')->with($notification);
    } // end method

    /*=================== Start BrandDelete Methoed ===================*/
    public function delete($id){
    	$pc_building = PCBuilding::findOrFail($id);
    	try {
            if(file_exists($pc_building->image)){
                unlink($pc_building->image);
            }
        } catch (Exception $e) {

        }

    	$pc_building->delete();

        $notification = array(
            'message' => 'PC Building Deleted Successfully.',
            'alert-type' => 'error'
        );
		return redirect()->back()->with($notification);

    } // end method

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $pc_building = PCBuilding::find($id);
        $pc_building->status = 1;
        $pc_building->save();

        Session::flash('success','PC Building Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $pc_building = PCBuilding::find($id);
        $pc_building->status = 0;
        $pc_building->save();

        Session::flash('warning','PC Building Inactive Successfully.');
        return redirect()->back();
    }
}