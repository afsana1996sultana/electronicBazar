@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h3 class="content-title">PC Building Add </h3>
        <div>
            <a href="{{ route('pc-building.index') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Back</a>
        </div>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form method="post" action="{{ route('pc-building.update',$pc_building->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                   <label for="name" class="col-form-label col-md-2" style="font-weight: bold;"> Name</label>
                                <input class="form-control" id="name" type="text" name="name" placeholder="Write Name" value="{{ $pc_building->name ?? ""}}">
                                @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="priority" class="col-form-label col-md-2" style="font-weight: bold;">Priority</label>
                                <input class="form-control" id="priority" type="text" name="priority" placeholder="Write priority" value="{{ $pc_building->priority ?? ""}}">
                                @error('priority')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                             <div class="mb-4">
                                @if ($pc_building->image)
                                <img id="showImage" class="rounded avatar-lg" src="{{ asset($pc_building->image) }}" alt="Card image cap" width="100px" height="80px;">
                                 @else
                                 <img id="showImage" class="rounded avatar-lg" src="{{ asset('upload/no_image.jpg') }}" alt="Card image cap" width="100px" height="80px;">
                                @endif
                            </div>
                            <div class="mb-4">
                                 <label for="image" class="col-form-label col-md-2" style="font-weight: bold;">Image:</label>
                                <input name="image" class="form-control" type="file" id="image" >
                                @error('image')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="priority" class="col-form-label col-md-2" style="font-weight: bold;">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ $pc_building->status == "1" ? "active" : "" }}>Active</option>
                                    <option value="0" {{ $pc_building->status == "0" ? "active" : "" }}>Inactive</option>
                                </select>
                                @error('status')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="form-check-input me-2 cursor" name="others"
                                        id="others" {{ $pc_building->others == 1 ? 'checked' : '' }} value="1">
                                    <label class="form-check-label cursor" for="status">Show in Others Option</label>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="description_bn" class="col-form-label col-md-2" style="font-weight: bold;">Description</label>
                              <textarea name="description" id="description" cols="5" placeholder="Write description" class="form-control">{{ $pc_building->description ?? ""}}</textarea>
                          </div>
                            <div class="row mb-4 justify-content-sm-end">
                                <div class="col-lg-3 col-md-4 col-sm-5 col-6">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- table-responsive //end -->
        </div>
        <!-- card-body end// -->
    </div>
</section>

@endsection