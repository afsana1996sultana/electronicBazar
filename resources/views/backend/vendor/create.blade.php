@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Vendors Create</h2>
        <div class="">
            <a href="{{ route('vendor.index') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Vendor List</a>
        </div>
    </div> 
    <div class="row justify-content-center">
    	<div class="col-sm-8">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                	@if(count($errors))
		                        @foreach ($errors->all() as $error)
		                           <p class="alert alert-danger alert-dismissible fade show"> {{ $error}} </p>
		                        @endforeach
	                        @endif
		                    <form method="post" action="{{ route('vendor.store') }}" enctype="multipart/form-data">
		                    	@csrf

		                        <div class="mb-4">
		                          <label for="shop_name" class="col-form-label col-md-4" style="font-weight: bold;"> Shop Name :</label>
		                            <input class="form-control" id="shop_name" type="text" name="shop_name" placeholder="Write vendor shop name" required="" value="{{old('shop_name')}}">
		                        </div>

								<div class="mb-4">
		                          <label for="phone" class="col-form-label col-md-4" style="font-weight: bold;"> Phone :</label>
		                            <input class="form-control" id="phone" type="text" name="phone" placeholder="Write vendor phone number" required="" value="{{old('phone')}}">
		                        </div>

								<div class="mb-4">
		                          <label for="email" class="col-form-label col-md-4" style="font-weight: bold;"> Email :</label>
		                            <input class="form-control" id="email" type="email" name="email" placeholder="Write vendor email address" required="" value="{{old('email')}}">
		                        </div>

		                        <div class="mb-4 d-none">
		                          <label for="fb_url" class="col-form-label col-md-4" style="font-weight: bold;">Fb page url :</label>
		                            <input class="form-control" id="fb_url" type="text" name="fb_url" placeholder="Write fb page url" value="{{old('fb_url')}}">
		                        </div>

		                        <div class="mb-4 d-none">
		                          <label for="bank_account" class="col-form-label col-md-4" style="font-weight: bold;">Bank Account :</label>
		                            <input class="form-control" id="bank_account" type="text" name="bank_account" placeholder="Write vendor bank account" value="{{old('bank_account')}}">
		                        </div>

		                        <div class="mb-4 d-none">
		                          <label for="bank_name" class="col-form-label col-md-4" style="font-weight: bold;">Bank Name :</label>
		                            <input class="form-control" id="bank_name" type="text" name="bank_name" placeholder="Write bank name" value="{{old('bank_name')}}">
		                        </div>

		                        <div class="mb-4 d-none">
		                          <label for="holder_name" class="col-form-label col-md-4" style="font-weight: bold;">Holder Name :</label>
		                            <input class="form-control" id="holder_name" type="text" name="holder_name" placeholder="Write holder name" value="{{old('holder_name')}}">
		                        </div>

		                        <div class="mb-4 d-none">
		                          <label for="branch_name" class="col-form-label col-md-4" style="font-weight: bold;">Branch Name :</label>
		                            <input class="form-control" id="branch_name" type="text" name="branch_name" placeholder="Write branch name" value="{{old('branch_name')}}">
		                        </div>

		                        <div class="mb-4 d-none">
		                          <label for="routing_name" class="col-form-label col-md-4" style="font-weight: bold;">Routing :</label>
		                            <input class="form-control" id="routing_name" type="text" name="routing_name" placeholder="Write routing" value="{{old('routing_name')}}">
		                        </div>

		                        <div class="mb-4">
		                          <label for="address" class="col-form-label col-md-4" style="font-weight: bold;">Address :</label>
		                            <input class="form-control" id="address" type="text" name="address" placeholder="Write vendor address" required="" value="{{old('address')}}">
		                        </div>

		                        <div class="mb-4">
		                          <label for="commission" class="col-form-label col-md-4" style="font-weight: bold;">Commission (Optional):</label>
		                            <input class="form-control" id="commission" type="text" name="commission" placeholder="Write vendor commission" value="{{old('commission')}}">
		                        </div>

		                        <div class="mb-4">
		                          <label for="description" class="col-form-label col-md-4" style="font-weight: bold;">Description :</label>
		                            <textarea name="description" id="description" cols="5" placeholder="Write vendor description" class="form-control ">{{old('description')}}</textarea>
		                        </div>

		                        <div class="row">
		                        	<div class="col-md-6">
		                        		<div class="mb-4">
				                         	<img id="showImage" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap" width="100px" height="80px;">
				                        </div>
		                        		<div class="mb-4">
				                         	<label for="image" class="col-form-label" style="font-weight: bold;">Shop Profile:</label>
				                            <input name="shop_profile" class="form-control" type="file" required="" id="image">
				                        </div>
				                    </div>

				                    <div class="col-md-6">
				                    	<div class="mb-4">
				                         	<img id="showImage2" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap" width="100px" height="80px;">
				                        </div>
				                    	<div class="mb-4">
				                         	<label for="image2" class="col-form-label" style="font-weight: bold;">Shop Cover Photo:</label>
				                            <input name="shop_cover" class="form-control" type="file" required="" id="image2">
				                        </div>
				                    </div>
		                        </div>

		                       <div class="row">
		                       		<div class="col-md-6">
		                       			<div class="mb-4">
				                         	<img id="showImage3" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap" width="100px" height="80px;">
				                        </div>
		                       			<div class="mb-4">
				                         	<label for="image3" class="col-form-label" style="font-weight: bold;">Nid Card:</label>
				                            <input name="nid" class="form-control" type="file" id="image3">
				                        </div>
		                       		</div>

		                       		<div class="col-md-6">
		                       			<div class="mb-4">
				                         	<img id="showImage4" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap" width="100px" height="80px;">
				                        </div>
		                       			<div class="mb-4">
				                         	<label for="image4" class="col-form-label" style="font-weight: bold;">Trade license:</label>
				                            <input name="trade_license" class="form-control" type="file" id="image4">
				                        </div>
		                       		</div>
		                       </div>

		                       <div class="mb-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" checked value="1">
                                        <label class="form-check-label cursor" for="status">Status</label>
                                    </div>
                                </div>

		                        <div class="row mb-4 justify-content-sm-end">
									<div class="col-lg-3 col-md-4 col-sm-5 col-6">
										<input type="submit" class="btn btn-primary" value="Submit">
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

@push('footer-script')
<!-- Shop Cover Photo Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image2').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage2').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <!-- Nid Card Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image3').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage3').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <!-- Trade license Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image4').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage4').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endpush