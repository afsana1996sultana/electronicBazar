@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-12 col-9">
            <div class="content-header">
                <h2 class="content-title">Specifications Add</h2>
                <div>
                    <a href="{{ route('specifications.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left mt-0"></i> Specifications List</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mx-auto">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="text-white">Specification</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('specifications.store') }}" enctype="multipart/form-data">
                    	@csrf
                        <div class="mb-4">
                            <label for="name" class="col-form-label col-md-2" style="font-weight: bold;"> Name:</label>
                            <input class="form-control" id="name" type="text" name="name" placeholder="Write attribute name" value="{{old('name')}}">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <div class="demo-checkbox">             
                                <input type="checkbox" id="md_checkbox_29" class="form-check-input cursor" name="is_featured" value="1">
                                <label for="md_checkbox_29" class="form-check-label cursor" style="font-weight: bold; padding-left: 8px;"> Is Features</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" checked value="1">
                                <label class="form-check-label cursor" for="status" style="font-weight: bold; padding-left: 8px;">Status</label>
                            </div>
                        </div>

                        <div class="row mb-4 justify-content-sm-end">
							<div class="col-4">
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
@endsection