<?php

namespace App\Http\Controllers\Backend;

use App\Models\EmiContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class EmiContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emiContent=EmiContent::first();
        return view('backend.emiContent.index', compact('emiContent'));
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
        $this->validate($request,[
            'headertitle' =>'required|max:200',
            'title1' =>'required|max:200',
            'title2' =>'required|max:200',
            'description1' =>'required|max:23000',
            'description2' =>'required|max:23000',
        ]);
        EmiContent::create([
           'headertitle'=>$request->headertitle,
           'title1'=>$request->title1,
           'title2'=>$request->title2,
           'description1'=>$request->description1,
           'description2'=>$request->description2,
        ]);
        Session::flash('success','Emi Content Inserted Successfully');
        return back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'headertitle' =>'required|max:200',
            'title1' =>'required|max:200',
            'title2' =>'required|max:200',
            'description1' =>'required|max:23000',
            'description2' =>'required|max:23000',
        ]);
        $emiContent=EmiContent::first();
        $emiContent->update([
           'headertitle'=>$request->headertitle,
           'title1'=>$request->title1,
           'title2'=>$request->title2,
           'description1'=>$request->description1,
           'description2'=>$request->description2,
        ]);
        Session::flash('success','Emi Content Update Successfully');
        return back();
    }

    public function destroy($id)
    {
        //
    }
}
