@extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')
@section('title')
Category Nest Online Shop
@endsection
<main class="main">
    <div class="page-header mt-30 mb-50">
        <div class="container">
            {{-- <div class="archive-header" style="background-image: url({{ asset($category->image) }});"> --}}
            <div class="archive-header" @if($category) style="background-image: url('{{ asset($category->backgroundimg) ?? asset('/upload/banner/breadcrumb.jpeg') }}')"
                @else style="background-image: url('/upload/banner/breadcrumb.jpeg')" @endif>
                <div class="row align-items-center">
                    @if($category)
                    <div class="col-12">
                        <h1 class="mb-15">
                        	@if(session()->get('language') == 'bangla')
                                {{ $category->name_bn }}
                            @else
                                {{ ucwords($category->name_en) }}
                            @endif
                        </h1>
                        <div class="breadcrumb">
                            <a href="{{ route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span>
                            @if(session()->get('language') == 'bangla')
                                {{ $category->name_bn }}
                            @else
                                {{ ucwords($category->name_en) }}
                            @endif
                        </div>
                    </div>
                    @elseif($brand)
                    <div class="col-12">
                        <h1 class="mb-15">
                        	@if(session()->get('language') == 'bangla')
                                {{ $brand->name_bn }}
                            @else
                                {{ucwords($brand->name_en) }}
                            @endif
                        </h1>
                        <div class="breadcrumb">
                            <a href="{{ route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span>
                            @if(session()->get('language') == 'bangla')
                                {{ $brand->name_bn }}
                            @else
                                {{ ucwords($brand->name_en )}}
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="col-12">
                        <h1 class="mb-15">
                                {{ $pc_id->name}}
                        </h1>
                        <div class="breadcrumb">
                            <a href="{{ route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span>
                                {{ucwords( $pc_id->name)}}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar order-last order-xl-fast">
                <!-- Fillter By Price -->
                @include('frontend.common.filterby')
            	<!-- SideCategory -->
                @include('frontend.common.sidecategory')
            </div>
            <div class="col-lg-4-5 order-fast order-xl-last">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{ $products_count }}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span class="align-items-center d-flex"><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span class="align-items-center d-flex"> Featured <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                	@forelse($products as $product)
                    <div class="col-md-4 col-lg-3 col-6 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('product.details',$product->slug) }}">
                                        <img class="default-img" src="{{asset($product->product_thumbnail)}}" alt="" />
                                        <img class="hover-img" src="{{asset($product->product_thumbnail)}}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1 d-flex">
                                    <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addWishlist(this.id)"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addComparelist(this.id)"><i class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" id="{{ $product->id }}" onclick="productView(this.id)" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <!-- start product discount section -->
                                @php
                                    if($product->discount_type == 1){
                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                    }elseif($product->discount_type == 2){
                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                    }
                                @endphp
                                @if($product->discount_price > 0)
                                    <div class="product-badges-right product-badges-position-right product-badges-mrg">
                                            @if($product->discount_type == 1)
                                                <span class="hot">৳{{ $product->discount_price }} off</span>
                                            @elseif($product->discount_type == 2)
                                                <span class="hot">{{ $product->discount_price }}% off</span>
                                            @endif
                                    </div>
                                @endif
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="{{ route('product.category', $product->category->slug) }}">
                                    	@if(session()->get('language') == 'bangla')
			                                {{ $product->category->name_bn }}
			                            @else
			                                {{ $product->category->name_en }}
			                            @endif
                                    </a>
                                </div>
                                @php
                                    $couponCode = getCoupon();
                                    $coupon = \App\Models\Coupon::where('coupon_code', $couponCode)->first();
                                    $showCoupon = false;
                                    if ($coupon && $coupon->product_id != null) {
                                        $couponProductIds = explode(',', $coupon->product_id);
                                        if (in_array($product->id, $couponProductIds)) {
                                            $showCoupon = true;
                                        }
                                    }
                                @endphp
                                @if($showCoupon)
                                    <span class="coupon_code">Coupon: {{ $couponCode }}</span>
                                @endif
                                <h2>
                                	<a href="{{ route('product.details',$product->slug) }}">
                                		@if(session()->get('language') == 'bangla')
                                            {{
                                            	$product->name_bn
                                            }}
                                        @else
                                            {{
                                            	$product->name_en
                                            }}
                                        @endif
                                	</a>
                                </h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (0)</span>
                                </div>
                                <div class="product-card-bottom">
                                	@if ($product->discount_price > 0)
                                        <div class="product-price">
                                          	<span class="price">৳{{ $price_after_discount }}</span>
                                          	<span class="old-price">৳{{ $product->regular_price }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                        	<span class="price">৳{{ $product->regular_price }}</span>
                                        </div>
                                    @endif
                                    @if($pc_id)
                                        <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                                        <a class="add" onclick="addToPcCart({{ $product->id }})" style="position: relative;display: inline-block; padding: 6px 20px 6px 20px;border-radius: 4px;background-color: #ffac68;font-size: 11px;color: white;font-weight: bolder;">Add PC Building</a>
                                    @else
                                        <div class="add-cart">
                                            @if($product->is_varient == 1)
                                                <a class="add" id="{{ $product->id }}" onclick="productView(this.id)" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            @else
                                                <input type="hidden" id="pfrom" value="direct">
                                                <input type="hidden" id="product_product_id" value="{{ $product->id }}"  min="1">
                                                <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                                                <a class="add" onclick="addToCartDirect({{ $product->id }})" ><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
	                @empty
                        @if(session()->get('language') == 'bangla')
	                        <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5>
	                    @else
	                       	<h5 class="text-danger">No products were found here!</h5>
	                    @endif
	                @endforelse
                    <!--end product card-->
                </div>
                <!--product grid-->
                {{--  <div class="pagination-area mt-20 mb-20">  --}}
                <div class="pagination-area">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            {{ $products->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('footer-script')
<script>
</script>
@endpush
