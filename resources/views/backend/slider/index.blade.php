@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Slider List <span class="badge rounded-pill alert-success"> {{ count($sliders) }} </span></h2>
        <div>
            @if(Auth::guard('admin')->user()->role == '1' || in_array('38', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                <a href="{{ route('slider.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Create Slider</a>
            @endif
        </div>
    </div>
    <div class="card mb-4">
        <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                      <tr>
                        <th>Sl</th>
                        <th>Slider Img</th>
                        <th>Title (English)</th>
                        <th>Description (Bangla)</th>
                        <th>Description (English)</th>
                        <th>Status</th>
                        @if(Auth::guard('admin')->user()->role == '1' || in_array('39', json_decode(Auth::guard('admin')->user()->staff->role->permissions)) || in_array('40', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                            <th class="text-end">Action</th>
                        @endif
                      </tr>
                    </thead>
                        <tbody>
                            @foreach($sliders as $key => $slide)
                              <tr>
                                <td> {{ $key+1}} </td>
                                <td width="15%">
                                    <a href="#" class="itemside">
                                        <div class="left">
                                            <img src="{{ asset($slide->slider_img) }}" width="70px" height="70px;" class="img-sm img-avatar" alt="Userpic">
                                        </div>
                                    </a>
                                </td>
                                <td> {{ $slide->title_en ?? 'NULL' }} </td>
                                <td> {{ $slide->description_bn ?? 'NULL' }} </td>
                                <td> {{ $slide->description_en ?? 'NULL' }} </td>
                                 <td>
                                    @if(Auth::guard('admin')->user()->role == '1' || in_array('60', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                        @if($slide->status == 1)
                                          <a href="{{ route('slider.in_active',['id'=>$slide->id]) }}">
                                            <span class="badge rounded-pill alert-success">Active</span>
                                          </a>
                                        @else
                                          <a href="{{ route('slider.active',['id'=>$slide->id]) }}" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                        @endif
                                    @else
                                        @if($slide->status == 1)
                                          <a>
                                            <span class="badge rounded-pill alert-success">Active</span>
                                          </a>
                                        @else
                                          <a> <span class="badge rounded-pill alert-danger">Disable</span></a>
                                        @endif
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if(Auth::guard('admin')->user()->role == '1' || in_array('61', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                        <a href="{{ route('slider.show',$slide->id) }}" class="btn btn-md rounded font-sm">Detail</a>
                                    @endif
                                    
                                    @if(Auth::guard('admin')->user()->role == '1' || in_array('39', json_decode(Auth::guard('admin')->user()->staff->role->permissions)) || in_array('40', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                        <div class="dropdown">
                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                            <div class="dropdown-menu">
                                                @if(Auth::guard('admin')->user()->role == '1' || in_array('39', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                                    <a class="dropdown-item" href="{{ route('slider.edit',$slide->id) }}">Edit info</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->role == '1' || in_array('40', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                                    <a class="dropdown-item text-danger" href="{{ route('slider.destroy',$slide->id) }}" id="delete">Delete</a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <!-- dropdown //end -->
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- card end// -->
</section>
@endsection