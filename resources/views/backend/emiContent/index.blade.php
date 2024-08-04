@extends('admin.admin_master')
@section('admin')
@push('css')
<style>
    .hidden {
        display: none;
    }
span.select2.select2-container.select2-container--default {
    width: 100% !important;
}
</style>
@endpush
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Emi Content</h2>
        <div class="">
            <a href="{{ route('coupons.index') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Coupon List</a>
        </div>
    </div>
    <div class="row justify-content-center">
        @if (!$emiContent)
        <div class="row">
            <div class="col-md-12 mx-auto">
				<form method="post" action="{{ route('emiContent.store') }}"  method="post" enctype="multipart/form-data" enctype="multipart/form-data">
					@csrf
					<div class="card">
						<div class="card-header">
							<h3>Emi Content</h3>
						</div>
			        	<div class="card-body">
			        		<div class="row">
			                	<div class="col-md-6 mb-4">
			                        <label for="coupon_code" class="col-form-label" style="font-weight: bold;">Header Title:<span class="text-danger">*</span> </label>
			                        <input class="form-control" id="coupon_code" type="text" value="{{ old('headertitle') }}" name="headertitle" placeholder="Write Coupon Code" required>
			                        @error('headertitle')
			                            <p class="text-danger">{{$message}}</p>
			                        @enderror
			                    </div>
			        		</div>
			        		<div class="row">
			                	<div class="col-md-6 mb-4">
			                        <label for="title1" class="col-form-label" style="font-weight: bold;">Title One:<span class="text-danger">*</span></label>
			                        <input class="form-control" id="title1" type="text" value="{{ old('title1') }}" name="title1" placeholder="Write Title One" required>
			                        @error('title1')
			                            <p class="text-danger">{{$message}}</p>
			                        @enderror
			                    </div>
			                	<div class="col-md-6 mb-4">
			                        <label for="title2" class="col-form-label" style="font-weight: bold;">Title Two:<span class="text-danger">*</span></label>
			                        <input class="form-control" id="title2" type="text" value="{{ old('title2') }}" name="title2" placeholder="Write Title Two" required>
			                        @error('title2')
			                            <p class="text-danger">{{$message}}</p>
			                        @enderror
			                    </div>
			        		</div>
			        		<!-- Row //-->
			        		<div class="row">
                                <!-- Description Start -->
                                <div class="col-md-6 mb-4">
                                    <label for="long_descp_en" class="col-form-label" style="font-weight: bold;">
                                        Description (One): <span class="text-danger">*</span></label>
                                    <textarea name="description1" rows="2" cols="2" class="form-control summernote"
                                        placeholder="Write First description here">{{ old('description1') }}</textarea>
                                    @error('description1')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="long_descp_bn" class="col-form-label" style="font-weight: bold;">
                                        Description (Two):<span class="text-danger">*</span></label>
                                    <textarea name="description2" id="" rows="2" cols="2" class="form-control summernote"
                                        placeholder="Write Second Description here">{{ old('description2') }}</textarea>
                                    @error('description2')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Description End -->
                            </div>
			        		{{-- <div class="row">
                          		<div class="custom-control custom-switch">
                                    <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" checked value="1">
                                    <label class="form-check-label cursor" for="status">Status</label>
                                </div>
	                        </div> --}}
	                        <!-- Row //-->
			        	</div>
			        	<!-- card body .// -->
				    </div>
				    <!-- card .// -->

				    <div class="row mb-4 justify-content-sm-end">
						<div class="col-lg-3 col-md-4 col-sm-5 col-6">
							<input type="submit" class="btn btn-primary" value="Submit">
						</div>
					</div>
			    </form>
			</div>
        </div>
        @else
        <div class="row">
            <div class="col-md-12 mx-auto">
				<form method="post" action="{{ route('emiContent.update',$emiContent->id) }}"  method="post" enctype="multipart/form-data" enctype="multipart/form-data">
					@csrf
                    @method('put')
					<div class="card">
						<div class="card-header">
							<h3>Emi Content</h3>
						</div>
			        	<div class="card-body">
			        		<div class="row">
			                	<div class="col-md-6 mb-4">
			                        <label for="coupon_code" class="col-form-label" style="font-weight: bold;">Header Title:<span class="text-danger">*</span> </label>
			                        <input class="form-control" id="coupon_code" type="text" value="{{$emiContent->headertitle}}" name="headertitle" placeholder="Write Coupon Code" required>
			                        @error('headertitle')
			                            <p class="text-danger">{{$message}}</p>
			                        @enderror
			                    </div>
			        		</div>
			        		<div class="row">
			                	<div class="col-md-6 mb-4">
			                        <label for="title1" class="col-form-label" style="font-weight: bold;">Title One:<span class="text-danger">*</span></label>
			                        <input class="form-control" id="title1" type="text" value="{{$emiContent->title1}}" name="title1" placeholder="Write Title One" required>
			                        @error('title1')
			                            <p class="text-danger">{{$message}}</p>
			                        @enderror
			                    </div>
			                	<div class="col-md-6 mb-4">
			                        <label for="title2" class="col-form-label" style="font-weight: bold;">Title Two:<span class="text-danger">*</span></label>
			                        <input class="form-control" id="title2" type="text" value="{{$emiContent->title2}}" name="title2" placeholder="Write Title Two" required>
			                        @error('title2')
			                            <p class="text-danger">{{$message}}</p>
			                        @enderror
			                    </div>
			        		</div>
			        		<!-- Row //-->
			        		<div class="row">
                                <!-- Description Start -->
                                <div class="col-md-6 mb-4">
                                    <label for="long_descp_en" class="col-form-label" style="font-weight: bold;">
                                        Description (One): <span class="text-danger">*</span></label>
                                    <textarea name="description1" rows="2" cols="2" class="form-control summernote"
                                        placeholder="Write First description here">{{$emiContent->description1}}</textarea>
                                    @error('description1')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="long_descp_bn" class="col-form-label" style="font-weight: bold;">
                                        Description (Two):<span class="text-danger">*</span></label>
                                    <textarea name="description2" id="" rows="2" cols="2" class="form-control summernote"
                                        placeholder="Write Second Description here">{{$emiContent->description2}}</textarea>
                                    @error('description2')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Description End -->
                            </div>
			        		{{-- <div class="row">
                          		<div class="custom-control custom-switch">
                                    <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" checked value="1">
                                    <label class="form-check-label cursor" for="status">Status</label>
                                </div>
	                        </div> --}}
	                        <!-- Row //-->
			        	</div>
			        	<!-- card body .// -->
				    </div>
				    <!-- card .// -->

				    <div class="row mb-4 justify-content-sm-end">
						<div class="col-lg-3 col-md-4 col-sm-5 col-6">
							<input type="submit" class="btn btn-primary" value="Submit">
						</div>
					</div>
			    </form>
			</div>
        </div>
        @endif
        <!-- .row // -->
    </div>
</section>
@push('footer-script')

@endpush
@endsection
