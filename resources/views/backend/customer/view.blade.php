@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Customer Edit</h2>
        <div class="">
            <a href="{{ route('customer.index') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Customer List</a>
        </div>
    </div> 
    <div class="row justify-content-center">
    	<div class="col-sm-8">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="name" class="col-form-label" style="font-weight: bold;"> Customer Name </label>
                                    <input class="form-control" id="name" type="text" name="name" placeholder="Write customer name" value="{{$customer->name}}" readonly>
                                    @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="username" class="col-form-label" style="font-weight: bold;"> User Name</label>
                                    <input class="form-control" id="username" type="text" name="username" placeholder="Write customer username" value="{{$customer->username}}" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="phone" class="col-form-label" style="font-weight: bold;"> Phone</label>
                                    <input class="form-control" id="phone" type="number" name="phone" placeholder="Write customer phone" value="{{$customer->phone}}" readonly>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="email" class="col-form-label" style="font-weight: bold;"> Email</label>
                                    <input class="form-control" id="email" type="email" name="email" placeholder="Write customer email" value="{{$customer->email}}" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="role" class="col-form-label" style="font-weight: bold;"> Role:</label>
                                    <div class="custom_select">
                                        <select class="form-control select-active w-100" name="role" readonly>
                                            <option value="1" @if($customer->role == "1") selected @endif>Admin</option>
                                            <option value="2" @if($customer->role == "2") selected @endif>Vendor</option>
                                            <option value="3" @if($customer->role == "3") selected @endif>Cutomer</option>
                                            <option value="4" @if($customer->role == "4") selected @endif>Guest User</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="address" class="col-form-label" style="font-weight: bold;"> Address</label>
                                    <input class="form-control" id="address" type="text" name="address" placeholder="Write customer address" value="{{$customer->address ?? 'No Address'}}" readonly>
                                </div>
                            </div>


                            <div class="col-md-6 mb-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" value="1" {{ $customer->status == 1 ? 'checked': '' }}>
                                    <label class="form-check-label cursor" for="status">Status</label>
                                </div>
                            </div>
		                        
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