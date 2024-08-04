@extends('admin.admin_master')
@section('admin')
<style>
.card-body .pagination-area nav {
    word-wrap: initial !important;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Product List <span class="badge rounded-pill alert-success">{{ $p_count }}</span></h2>
        <div>
            @if(Auth::guard('admin')->user()->role == '1' || in_array('1', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                <a href="{{ route('product.add') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Add Product</a>
            @endif
        </div>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="">
               <table class="table table-bordered table-hover" id="example" width="100%">
                   <div class="d-flex justify-content-end mb-20 ms-auto w-50 product-search-box">
                        <form action="" method="get" class="d-flex">
                            <input type="text" name="search" class="form-control product-search-input">
                            <button type="submit" class="btn btn-primary position: relative;">Search</button>
                        </form>
                    </div>
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Name (English)</th>
                            <th scope="col">Category</th>
                            <th scope="col">Product Price </th>
							<th scope="col">Quantity </th>
							<th scope="col">Discount </th>
							<th scope="col">Warranty </th>
							<th scope="col">Featured</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $item)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td width="15%">
                                <a href="#" class="itemside">
                                    <div class="left">
                                        <img src="{{ asset($item->product_thumbnail) }}" class="img-sm" alt="Userpic" style="width: 80px; height: 70px;">
                                    </div>
                                </a>
                            </td>
                            <td><a href="{{ route('product.details',$item->slug) }}">{{ $item->name_en ?? 'NULL' }}</a></td>
                            {{-- <td> {{ $item->name_bn ?? 'NULL' }} </td> --}}
                            <td> {{ $item->category->name_en }} </td>
                            <td> {{ $item->regular_price ?? 'NULL' }} </td>
                            <td>
                                @if($item->is_varient)
                                    Varient Product
                                @else
                                    {{ $item->stock_qty ?? 'NULL' }}
                                @endif
                            </td>
                            <td>
                            	@if($item->discount_price > 0)
                                    @if($item->discount_type == 1)
                                        <span class="badge rounded-pill alert-info">৳{{ $item->discount_price }} off</span>
                                    @elseif($item->discount_type == 2)
                                        <span class="badge rounded-pill alert-success">{{ $item->discount_price }}% off</span>
                                    @endif
                                @else
								 	<span class="badge rounded-pill alert-danger">No Discount</span>
								@endif
                            </td>
                            <td>
                                {{ $item->warranty->value ?? ' '}} {{ $item->warranty->label ?? ' '}}
                            </td>
                            <td>
                                @if(Auth::guard('admin')->user()->role == '1' || in_array('62', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                    @if($item->is_featured == 1)
                                      <a href="{{ route('product.featured',['id'=>$item->id]) }}">
                                        <span class="badge rounded-pill alert-success"><i class="material-icons md-check"></i></span>
                                      </a>
                                    @else
                                      <a href="{{ route('product.featured',['id'=>$item->id]) }}" > <span class="badge rounded-pill alert-danger"><i class="material-icons md-close"></i></span></a>
                                    @endif
                                @else
                                    @if($item->is_featured == 1)
                                      <a>
                                        <span class="badge rounded-pill alert-success"><i class="material-icons md-check"></i></span>
                                      </a>
                                    @else
                                      <a> <span class="badge rounded-pill alert-danger"><i class="material-icons md-close"></i></span></a>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if(Auth::guard('admin')->user()->role == '1' || in_array('62', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                    @if($item->status == 1)
                                      <a href="{{ route('product.in_active',['id'=>$item->id]) }}">
                                        <span class="badge rounded-pill alert-success">Active</span>
                                      </a>
                                    @else
                                      <a href="{{ route('product.active',['id'=>$item->id]) }}" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                    @endif
                                @else
                                    @if($item->status == 1)
                                      <a>
                                        <span class="badge rounded-pill alert-success">Active</span>
                                      </a>
                                    @else
                                      <a> <span class="badge rounded-pill alert-danger">Disable</span></a>
                                    @endif
                                @endif
                            </td>
                            <td class="text-end">
                                @if(Auth::guard('admin')->user()->role == '1' || in_array('3', json_decode(Auth::guard('admin')->user()->staff->role->permissions)) || in_array('4', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                    <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                        <div class="dropdown-menu">
                                            @if(Auth::guard('admin')->user()->role == '1' || in_array('3', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                                <a class="dropdown-item" href="{{ route('product.edit',$item->id) }}">Edit info</a>
                                            @endif
                                            <!-- <a class="dropdown-item" href="">View Details</a> -->
                                            @if(Auth::guard('admin')->user()->role == '1' || in_array('4', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                                <a class="dropdown-item text-danger" href="{{ route('product.delete',$item->id) }}" id="delete">Delete</a>
                                            @endif
                                        </div>
                                    </div>
                                <!-- dropdown //end -->
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--<div class="pagination-area mt-25 mb-50">-->
                <!--    <nav aria-label="Page navigation example">-->
                <!--        <ul class="pagination justify-content-center">-->
                <!--            {{ $products->links() }}-->
                <!--        </ul>-->
                <!--    </nav>-->
                <!--</div>-->
            </div>
            <!-- table-responsive //end -->
        </div>
        <!-- card-body end// -->
    </div>
</section>
@endsection