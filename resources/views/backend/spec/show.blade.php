@extends('admin.admin_master')
@push('css')
<style type="text/css">
    .content-main {
        min-height: 50px !important;
    }
    .table-content {
        min-height: calc(100vh - 110px) !important;
    }
</style>
@endpush
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-12 col-9">
            <div class="content-header">
                <h2 class="content-title">Specification Show</h2>
                <div>
                    <a href="{{ route('specifications.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left mt-0"></i> Specifications List</a>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="text-white">Specification Edit</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('specifications.update',$spec->id) }}" enctype="multipart/form-data">
                    	@csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="col-form-label col-md-2" style="font-weight: bold;"> Name:</label>
                            <input class="form-control" id="name" type="text" name="name" placeholder="Write specification name" value="{{$spec->name}}">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="row mb-4 justify-content-end">
							<div class="col-sm-4 col-12">
								<input type="submit" name="" class="btn btn-primary" value="Update">
							</div>
						</div>
                    </form>
                </div>
            </div>
            <!-- card end// -->
        </div>
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="text-white">Specification Value Create</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('spec.value_store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="spec_id" value="{{$spec->id}}">

                        <div class="mb-4">
                            <label for="value" class="col-form-label" style="font-weight: bold;"> Value:</label>
                            <input class="form-control" id="value" type="text" name="value" placeholder="Write specification value" value="{{old('value')}}">
                            @error('value')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="row mb-4 justify-content-sm-end">
                            <div class="col-12 col-sm-3 col-md-6 me-0 me-sm-4 me-lg-0">
                                <input type="submit" name="" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- card end// -->
        </div>
    </div>
</section>
<section>
    <div class="content-main">
        <div class="row">
            <div class="col-md-12 col-9">
                <div class="content-header mb-0">
                    <h2 class="content-title">Specification Value List</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content-main table-content">
    <div class="card mb-4 col-12 mx-auto">
        <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive-sm">
                <table  class="table table-bordered table-striped" id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Value</th> 
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($values as $key => $value)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $value->value ?? 'NULL' }} </td>
                            <td>
                                @if($value->status == 1)
                                  <a href="{{ route('spec_value.in_active',$value->id) }}">
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('spec_value.active',$value->id) }}" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td class="text-end">
                                {{-- <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" href="#" data-bs-toggle="modal" data-bs-target="#value{{ $value->id }}">Edit</a> --}}
                                <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" href="{{ route('spec_value.delete',$value->id) }}" id="delete">Delete</a>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive //end -->
        </div>
        <!-- card-body end// -->
    </div>
    <!-- card end// -->
</section>

    @if(count($values) > 0)
        <!--  Specification Modal -->
        <div class="modal fade specification" id="value{{ $value->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h3>Specification Edit</h3>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="col-form-label col-md-2" style="font-weight: bold;"> Name:</label>
                            <input class="form-control" id="name" type="text" name="name" placeholder="Write specification name" value="{{ $value->id }}">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="row mb-4 justify-content-sm-end">
                            <div class="col-4">
                                <input type="submit" name="" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection