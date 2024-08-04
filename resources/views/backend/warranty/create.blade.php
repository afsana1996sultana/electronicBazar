@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-12 col-9">
            <div class="content-header">
                <h2 class="content-title">Warranty Add</h2>
                <div>
                    <a href="{{ route('warranty.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left mt-0"></i> Warranty List</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mx-auto">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="text-white">Warranty</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('warranty.store') }}" enctype="multipart/form-data">
                    	@csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="value" class="col-form-label col-md-2" style="font-weight: bold;"> Value:</label>
                                    <input class="form-control" id="value" type="text" name="value" placeholder="Write value name" value="{{old('value')}}">
                                    @error('value')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="label" class="col-form-label" style="font-weight: bold;">Label:</label>
                                    <div class="custom_select">
                                        <select class="form-control select-active w-100 form-select select-nice" name="label" id="label">
                                            <option value="">--Select Warranty Label--</option>
                                            <option value="Years Official">Year(s) Official</option>
                                            <option value="Year Official">Year Official</option>
                                            <option value="Months Official">Month(s) Official</option>
                                            <option value="Month Official">Month Official</option>
                                            <option value="Years Saller">Year(s) Seller</option>
                                            <option value="Year Saller">Year Seller</option>
                                            <option value="Months Saller">Month(s) Seller</option>
                                            <option value="Month Saller">Month Seller</option>
                                            <option value="Day">Day</option>
                                            <option></option>
                                        </select>
                                        @error('label')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
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