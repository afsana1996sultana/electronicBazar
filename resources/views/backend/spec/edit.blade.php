@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Specification Edit</h2>
        <div class="">
            <a href="{{ route('specifications.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left mt-0"></i> Specification List</a>
        </div>
    </div> 
    <div class="row justify-content-center">
    	<div class="col-sm-6">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <form method="post" action="{{ route('specifications.update',$spec->id) }}" enctype="multipart/form-data">
		                    	@csrf
		                    	@method('PUT')
		                        <div class="mb-4">
		                           	<label for="name" class="col-form-label col-md-2" style="font-weight: bold;"> Name:</label>
		                            <input class="form-control" id="name" type="text" name="name" placeholder="Write attribute name" value="{{$spec->name}}">
		                            @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
		                        </div>

		                        <div class="mb-4">
                                    <div class="demo-checkbox">             
                                        <input type="checkbox" id="md_checkbox_29" class="form-check-input cursor" name="is_featured" {{ $spec->is_featured == 1 ? 'checked': '' }} value="1">
                                        <label for="md_checkbox_29" class="form-check-label cursor" style="font-weight: bold; padding-left: 8px;"> Is Featured</label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" {{ $spec->status == 1 ? 'checked': '' }} value="1">
                                        <label class="form-check-label cursor" for="status" style="font-weight: bold; padding-left: 8px;">Status</label>
                                    </div>
                                </div>
		                        
		                        <div class="row mb-4 justify-content-sm-end">
									<div class="col-6 col-md-4">
										<input type="submit" name="" class="btn btn-primary" value="Update">
									</div>
								</div>
		                    </form>
		                </div>
		            </div>
		            <!-- .row // -->
		        </div>
		        <!-- card body .// -->
		    </div>
		    <!-- card .// -->
    	</div>
    </div>
</section>

@endsection