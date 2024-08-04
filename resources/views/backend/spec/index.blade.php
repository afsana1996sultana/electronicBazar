@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h3 class="content-title">Specifications list <span class="badge rounded-pill alert-success"> {{ count($specifications) }}</span></h3>
        <div>
            <a href="{{ route('specifications.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Specifications Create</a>
        </div>
    </div>
    </div>
    <div class="card mb-4 col-10 mx-auto">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Featured</th>
                            <th scope="col">Value</th> 
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($specifications as $key => $spec)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $spec->name ?? 'NULL' }} </td>

                            <td>
                                @if($spec->status == 1)
                                  <a href="{{ route('spec.changeStatus',['id'=>$spec->id]) }}">
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('spec.changeStatus',['id'=>$spec->id]) }}" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td>
                                @if($spec->is_featured == 1)
                                  <a href="{{ route('spec.changeFeatureStatus',['id'=>$spec->id]) }}">
                                    <span class="badge rounded-pill alert-success"><i class="material-icons md-check"></i></span>
                                  </a>
                                @else
                                  <a href="{{ route('spec.changeFeatureStatus',['id'=>$spec->id]) }}" > <span class="badge rounded-pill alert-danger"><i class="material-icons md-close"></i></span></a>
                                @endif
                            </td>

                            <td>
                            @foreach($spec->spec_values as $value)
                                 {{ $value->value ?? ' ' }} ,
                            @endforeach
                            </td>
                            <td class="text-end">
                                <a href="{{ route('specifications.show',$spec->id) }}" class="btn btn-md rounded font-sm">Detail</a>
                                {{-- <a class="text-white btn bg-danger rounded font-sm" href="{{ route('spec.delete',$spec->id) }}" id="delete">Delete</a> --}}
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('specifications.edit',$spec->id) }}">Edit info</a>
                                        <a class="dropdown-item text-danger" href="{{ route('spec.delete',$spec->id) }}" id="delete">Delete</a>
                                    </div>
                                </div> 
                                <!-- dropdown //end -->
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
</section>

@endsection