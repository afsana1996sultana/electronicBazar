@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h3 class="content-title">Warranty list <span class="badge rounded-pill alert-success"> {{ count($warrantys) }}</span></h3>
        <div>
            <a href="{{ route('warranty.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Warranty Create</a>
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
                            <th scope="col">Value</th>
                            <th scope="col">Label</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($warrantys as $key => $warranty)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $warranty->value ?? '' }} </td>
                            <td> {{ $warranty->label ?? '' }} </td>

                            <td class="text-end">
                                <a href="{{ route('warranty.delete',$warranty->id) }}" class="btn btn-md rounded font-sm" id="delete">Delete</a>
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