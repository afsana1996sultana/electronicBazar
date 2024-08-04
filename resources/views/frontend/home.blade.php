@extends('layouts.frontend')
@push('css')
<style>
	.preloader1 {
		background-color: #fff;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		z-index: 999999;
		-webkit-transition: .6s;
		transition: .6s;
		margin: 0 auto;
	}


.preloader-active1 {
    position: absolute;
    top: 100px;
    width: 100%;
    height: 100%;
    z-index: 100;
}

body {
	background: #f2f4f8;
}

.slider-arrow .slider-btn {
	background: #fff;
}

.popular-categories .title {
	text-align: center !important;
}

</style>
@endpush
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')
	<section class="home-slider position-relative mb-30">
		<div class="container">
			<div class="slider__active">
				@foreach($sliders as $slider)
				    <img src="{{ asset($slider->slider_img) }}" alt="{{ $slider->title_en }}">
				@endforeach
			</div>
		</div>
	</section>
	<!--End hero slider-->
	<section class="popular-categories section-padding">
	    <div class="container wow animate__animated animate__fadeIn">
	        <div class="section-title">
	            <div class="title">
	                <h3>Featured Categories</h3>
	            </div>
	        </div>
	        <div class="row g-2">
            	@foreach($featured_category as $cat)
            	<div class="col-4 col-md-3 col-lg-2">
	                <div class="feature__product card-2 bg-white d-flex flex-column justify-content-center align-items-center wow animate__animated animate__fadeInUp " data-wow-delay=".1s">
	                    <figure class="img-hover-scale overflow-hidden">
	                        <a href="{{ route('product.category', $cat->slug) }}">
	                        	@if($cat->image && $cat->image != '' && $cat->image != 'Null')
				                <img class="default-img lazyload img-responsive" data-original="{{ asset($cat->image) }}" src="{{ asset($cat->image) }}" alt="">
				                @else
				                    <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}" alt="" />
				                @endif
	                        </a>
	                    </figure>
	                    <h6>
	                    	<a href="{{ route('product.category', $cat->slug) }}">
	                    		@if(session()->get('language') == 'bangla')
	                                {{ $cat->name_bn }}
	                            @else
	                                {{ $cat->name_en }}
	                            @endif
	                    	</a>
	                    </h6>
	                  <!--   <span>26 items</span> -->
	                </div>
            	</div>
                @endforeach
	        </div>
	    </div>
	</section>

	<!-- Campaign Slider Start-->
	@php
        $campaign = \App\Models\Campaing::where('status', 1)->where('is_featured', 1)->first();
    @endphp

    @if($campaign)
    @php
        $start_diff = date_diff(date_create($campaign->flash_start), date_create(date('d-m-Y H:i:s')));
        $end_diff = date_diff(date_create(date('d-m-Y H:i:s')), date_create($campaign->flash_end));
    @endphp
    
	@if ($start_diff->invert == 0 && $end_diff->invert == 0)
	<section class="common-product section-padding">
	    <div class="container wow animate__animated animate__fadeIn">
	        <div class="section-title">
	            <div class="title">
	                 <h3>{{ $campaign->name_en ?? 'Campaign Sell'}}</h3>
	                <div class="deals-countdown-wrap">
	                    <div class="deals-countdown" data-countdown="{{ date(('Y-m-d H:i:s'), strtotime($campaign->flash_end)) }}"></div>
	                </div>
	            </div>
	        </div>
	        <div class="carausel-5-columns-cover position-relative">
	        	<div class="slider-arrow slider-arrow-2 carausel-5-columns-common-arrow" id="carausel-5-columns-common-arrows"></div>
	            <div class="carausel-5-columns-common carausel-arrow-center" id="carausel-5-columns-common">
	            	@foreach($campaign->campaing_products->take(20) as $campaing_product)
	            		@php
                            $product = \App\Models\Product::find($campaing_product->product_id);
                        @endphp
                        @if ($product != null && $product->status != 0)
	                		@include('frontend.common.product_grid_view',['product' => $product])
	                	@endif
	                @endforeach
	            </div>
	        </div>
	    </div>
	</section>
	@endif
	@endif
	<!-- Campaign Slider End-->

	<!--End category slider-->
	<section class="banners mb-25">
	    <div class="container">
	        <div class="row">
	        	@foreach($home_banners->take(3) as $banner)
	            <div class="col-lg-4 col-md-6">
	                <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
	                    <img src="{{asset($banner->banner_img)}}" class="img-fluid" alt="" style="height: 300px; width: 100%;"/>
	                    <div class="banner-text" style="padding-top: 200px; padding-left: 10px;">
	                        <a href="{{$banner->banner_url}}" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
	                    </div>
	                </div>
	            </div>
	            @endforeach
	        </div>
	    </div>
	</section>
	<!--End banners-->
	<section class="product-tabs section-padding position-relative">
	    <div class="container">
	        <div class="section-title style-2 wow animate__animated animate__fadeIn">
	            <h3>Featured Products</h3>
	        </div>
	        <!--End nav-tabs-->
	        <div class="tab-content" id="myTabContent">
	            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
	                <div class="row product-grid-4 gutters-5 product-row">
	                	@foreach($products->take(14) as $product)
	                    	@include('frontend.common.product_grid_view',['product' => $product])
	                    	<!--end product card-->
	                    @endforeach
	                </div>
	                <!--End product-grid-4-->
                    <div class="row">
                        <div class="col-5 mx-auto text-center">
                            <a class="btn btn-xs" href="{{ route('product.show') }}" id="seemore">Load More <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
	                {{-- <button class="btn btn-xs d-flex mx-auto" id="seemore">Load More <i class="fi-rs-arrow-small-right"></i></button> --}}
	            </div>
	            <!--En tab one-->
	        </div>
	        <!--End tab-content-->
	    </div>
	</section>
	<!--Products Tabs-->

	<!--End banners-->
	@if(count($digital_products) > 0)
	<section class="product-tabs section-padding position-relative">
	    <div class="container">
	        <div class="section-title style-2 wow animate__animated animate__fadeIn">
	            <h3>Digital Products</h3>
	        </div>
	        <!--End nav-tabs-->
	        <div class="tab-content" id="myTabContent">
	            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
	                <div class="row product-grid-4 gutters-5 product-row">
	                	@foreach($digital_products as $product)
	                    	@include('frontend.common.product_grid_view',['product' => $product])
	                    	<!--end product card-->
	                    @endforeach
	                </div>
	                <!--End product-grid-4-->
	                 <div class="row">
                        <div class="col-5 mx-auto text-center">
                            <a class="btn btn-xs" href="{{ route('product.show') }}" id="seemore">Load More <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
	                <!--<button class="btn btn-xs d-flex mx-auto" id="seemore">Load More <i class="fi-rs-arrow-small-right"></i></button>-->
	            </div>
	            <!--En tab one-->
	        </div>
	        <!--End tab-content-->
	    </div>
	</section>
	@endif
	<!--Products Tabs-->

	@if(count($todays_sale) > 0)
	<section class="section-padding pb-5">
	    <div class="container">
	        <div class="section-title wow animate__animated animate__fadeIn">
	            <h3 class="">Daily Best Sells</h3>
	            <ul class="nav nav-tabs links" id="myTab-2" role="tablist">
	                <li class="nav-item" role="presentation">
	                    <button class="nav-link active" id="nav-tab-one-1" data-bs-toggle="tab" data-bs-target="#tab-one-1" type="button" role="tab" aria-controls="tab-one" aria-selected="true"></button>
	                </li>
	                <li class="nav-item" role="presentation">
	                    <button class="nav-link" id="nav-tab-two-1" data-bs-toggle="tab" data-bs-target="#tab-two-1" type="button" role="tab" aria-controls="tab-two" aria-selected="false"></button>
	                </li>
	                <li class="nav-item" role="presentation">
	                    <button class="nav-link" id="nav-tab-three-1" data-bs-toggle="tab" data-bs-target="#tab-three-1" type="button" role="tab" aria-controls="tab-three" aria-selected="false"></button>
	                </li>
	            </ul>
	        </div>
	        <div class="row justify-content-center">
	            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
	                <div class="tab-content" id="myTabContent-1">
	                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
	                        <div class="carausel-4-columns-cover arrow-center position-relative">
	                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
	                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
	                            	@foreach($todays_sale as $today_product)
	                            		@php
				                            $product = \App\Models\Product::find($today_product->product_id);
				                        @endphp
		                                @include('frontend.common.product_grid_view',['product' => $product])
	                                @endforeach
	                                <!--End product Wrap-->
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <!--End tab-content-->
	            </div>
	            <!--End Col-lg-9-->
	        </div>
	    </div>
	</section>
	@endif
	<!--End Today Best Sales-->

	@if(count($hot_deals) > 0)
		<!-- Start Hot Deals -->
		<section class="section-padding pb-5">
			<div class="container">
				<div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
					<h3 class="">Ajker Deal</h3>
					<a class="show-all btn btn-primary text-white" href="{{ route('hot_deals.all') }}">
						All Deals
						<i class="fi-rs-angle-right"></i>
					</a>
				</div>
				<div class="row">
					@foreach($hot_deals as $product)
						@include('frontend.common.deals')
						<!--end product card-->
					@endforeach
				</div>
			</div>
		</section>
		<!-- End Hot Deals -->
	@endif

	@if(get_setting('multi_vendor')->value)
		<!--Start Vendors-->
		<section class="popular-categories section-padding">
			<div class="container wow animate__animated animate__fadeIn">
				<div class="section-title">
					<div class="title">
						<h3>Sellers</h3>
					</div>
					<div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow-vendors" id="carausel-10-columns-arrows-vendors"></div>
				</div>
				<div class="carausel-10-columns-cover position-relative">
					<div class="carausel-10-columns-vendors" id="carausel-10-columns-vendors">
						@foreach(get_vendors() as $vendor)
							<div class=" card-2 mx-2 bg-9 d-flex flex-column justify-content-center align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
								<figure class="img-hover-scale overflow-hidden">
									<a href="{{ route('vendor.product', $vendor->slug) }}">
										@if($vendor->shop_profile && $vendor->shop_profile != '' && $vendor->shop_profile != 'Null')
											<img class="default-img" src="{{ asset($vendor->shop_profile) }}" alt="" />
										@else
											<img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}" alt="" />
										@endif
									</a>
								</figure>
								<h6>
									<a href="{{ route('vendor.product', $vendor->slug) }}">
										@if(session()->get('language') == 'bangla')
											{{ $vendor->shop_name }}
										@else
											{{ $vendor->shop_name }}
										@endif
									</a>
								</h6>
							<!--   <span>26 items</span> -->
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</section>
		<!--End Vendors-->
	@endif

	<!--End Deals-->
	<section class="section-padding mb-30">
	    <div class="container">
	        <div class="row">
	            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
	                <h4 class="section-title style-1 mb-30 animated animated">Top Selling</h4>
	                <div class="product-list-small animated animated">
						@foreach($product_top_sellings as $product_top_selling)
							<article class="row align-items-center hover-up">
								<figure class="col-md-4 mb-0">
									<a href="{{ route('product.details',$product_top_selling->slug) }}">
										@if($product_top_selling->product_thumbnail && $product_top_selling->product_thumbnail != '' && $product_top_selling->product_thumbnail != 'Null')
	                                        <img class="default-img" src="{{ asset($product_top_selling->product_thumbnail) }}" alt="" />
	                                    @else
	                                        <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}" alt="" />
	                                    @endif
									</a>
								</figure>
								<div class="col-md-8 mb-0">
									<h6>
										<a href="{{ route('product.details',$product_top_selling->slug) }}">
											@if(session()->get('language') == 'bangla')
												{{ $product_top_selling->name_bn }}
											@else
												{{ $product_top_selling->name_en }}
											@endif
										</a>
									</h6>
									<div class="product-rate-cover">
										<div class="product-rate d-inline-block">
											<div class="product-rating" style="width: 90%"></div>
										</div>
										<span class="font-small ml-5 text-muted"> (4.0)</span>
									</div>
									@if ($product_top_selling->discount_price == 0 || $product_top_selling->discount_price == "NULL")
		                                <div class="product-price">
		                                	<span class="price"> ৳{{ $product_top_selling->regular_price }} </span>
		                                </div>
		                            @else
		                            @php
			                            $amount = $product_top_selling->regular_price - $product_top_selling->discount_price;
	                          		@endphp
		                               <div class="product-price">
		                                  	<span class="price"> ৳{{ $amount }} </span>
		                                  	<span class="old-price">৳ {{ $product_top_selling->regular_price }}</span>
		                                </div>
		                            @endif
								</div>
							</article>
						@endforeach
	                </div>
	            </div>
	            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
	                <h4 class="section-title style-1 mb-30 animated animated">Trending Products</h4>
	                <div class="product-list-small animated animated">
	                	@foreach($product_trendings as $product_trending)
	                    <article class="row align-items-center hover-up">
	                        <figure class="col-md-4 mb-0">
	                            <a href="{{ route('product.details',$product_trending->slug) }}">
	                            	@if($product_trending->product_thumbnail && $product_trending->product_thumbnail != '' && $product_trending->product_thumbnail != 'Null')
                                        <img class="default-img" src="{{ asset($product_trending->product_thumbnail) }}" alt="" />
                                    @else
                                        <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}" alt="" />
                                    @endif
	                            </a>
	                        </figure>
	                        <div class="col-md-8 mb-0">
	                            <h6>
	                                <a href="{{ route('product.details',$product_trending->slug) }}">
	                                	@if(session()->get('language') == 'bangla')
											{{ $product_trending->name_bn }}
										@else
											{{ $product_trending->name_en }}
										@endif
	                                </a>
	                            </h6>
	                            <div class="product-rate-cover">
	                                <div class="product-rate d-inline-block">
	                                    <div class="product-rating" style="width: 90%"></div>
	                                </div>
	                                <span class="font-small ml-5 text-muted"> (4.0)</span>
	                            </div>
	                            @if ($product_trending->discount_price == 0 || $product_trending->discount_price == "NULL")
	                                <div class="product-price">
	                                	<span class="price"> ৳{{ $product_trending->regular_price }} </span>
	                                </div>
	                            @else
	                            @php
		                            $amount = $product_trending->regular_price - $product_trending->discount_price;
                          		@endphp
	                               <div class="product-price">
	                                  	<span class="price"> ৳{{ $amount }} </span>
	                                  	<span class="old-price">৳ {{ $product_trending->regular_price }}</span>
	                                </div>
	                            @endif
	                        </div>
	                    </article>
	                    @endforeach
	                </div>
	            </div>
	            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
	                <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
	                <div class="product-list-small animated animated">
	                	@foreach($product_recently_adds as $product_recently_add)
	                    <article class="row align-items-center hover-up">
	                        <figure class="col-md-4 mb-0">
	                            <a href="{{ route('product.details',$product_recently_add->slug) }}">
	                            	@if($product_recently_add->product_thumbnail && $product_recently_add->product_thumbnail != '' && $product_recently_add->product_thumbnail != 'Null')
                                        <img class="default-img" src="{{ asset($product_recently_add->product_thumbnail) }}" alt="" />
                                    @else
                                        <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}" alt="" />
                                    @endif
	                            </a>
	                        </figure>
	                        <div class="col-md-8 mb-0">
	                            <h6>
	                                <a href="{{ route('product.details',$product_recently_add->slug) }}">
	                                	@if(session()->get('language') == 'bangla')
											{{ $product_recently_add->name_bn }}
										@else
											{{ $product_recently_add->name_en }}
										@endif
	                                </a>
	                            </h6>
	                            <div class="product-rate-cover">
	                                <div class="product-rate d-inline-block">
	                                    <div class="product-rating" style="width: 90%"></div>
	                                </div>
	                                <span class="font-small ml-5 text-muted"> (4.0)</span>
	                            </div>
	                            @if($product_recently_add->discount_price == 0 || $product_recently_add->discount_price == "NULL")
	                                <div class="product-price">
	                                	<span class="price"> ৳{{ $product_recently_add->regular_price }} </span>
	                                </div>
	                            @else
	                            @php
		                            $amount = $product_recently_add->regular_price - $product_recently_add->discount_price;
                          		@endphp
	                               <div class="product-price">
	                                  	<span class="price"> ৳{{ $amount }} </span>
	                                  	<span class="old-price">৳ {{ $product_recently_add->regular_price }}</span>
	                                </div>
	                            @endif
	                        </div>
	                    </article>
	                    @endforeach
	                </div>
	            </div>
	            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
	                <h4 class="section-title style-1 mb-30 animated animated">Top Rated</h4>
	                <div class="product-list-small animated animated">
	                	@foreach($product_top_rates as $product_top_rate)
	                    <article class="row align-items-center hover-up">
	                        <figure class="col-md-4 mb-0">
	                            <a href="{{ route('product.details',$product_top_rate->slug) }}">
	                            	@if($product_top_rate->product_thumbnail && $product_top_rate->product_thumbnail != '' && $product_top_rate->product_thumbnail != 'Null')
                                        <img class="default-img" src="{{ asset($product_top_rate->product_thumbnail) }}" alt="" />
                                    @else
                                        <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}" alt="" />
                                    @endif
	                            </a>
	                        </figure>
	                        <div class="col-md-8 mb-0">
	                            <h6>
	                                <a href="{{ route('product.details',$product_top_rate->slug) }}">
	                                	@if(session()->get('language') == 'bangla')
											{{ $product_top_rate->name_bn }}
										@else
											{{ $product_top_rate->name_en }}
										@endif
									</a>
	                            </h6>
	                            <div class="product-rate-cover">
	                                <div class="product-rate d-inline-block">
	                                    <div class="product-rating" style="width: 90%"></div>
	                                </div>
	                                <span class="font-small ml-5 text-muted"> (4.0)</span>
	                            </div>
	                            @if ($product_top_rate->discount_price == 0 || $product_top_rate->discount_price == "NULL")
	                                <div class="product-price">
	                                	<span class="price"> ৳{{ $product_top_rate->regular_price }} </span>
	                                </div>
	                            @else
	                            @php
		                            $amount = $product_top_rate->regular_price - $product_top_rate->discount_price;
                          		@endphp
	                               <div class="product-price">
	                                  	<span class="price"> ৳{{ $amount }} </span>
	                                  	<span class="old-price">৳ {{ $product_top_rate->regular_price }}</span>
	                                </div>
	                            @endif
	                        </div>
	                    </article>
	                    @endforeach
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
    <section>
        <div>
            <div class="category-section category-section-mobile mb-4 mt-3">
                <div class="container mb-3">
                    <div class="row">
                        <div class="col-lg-12 ps-0 ps-lg-2">
                            <div class="d-flex justify-content-between see-cat-link align-items-center">
                                <h2 class="home-header-text"><span>Top Brands</span></h2> <a href="{{ route('brand.show') }}">See all brands</a>
                            </div>
                            <div class="home-header-line"></div>
                        </div>
                    </div>
                </div>
                @php
                $brands=\App\Models\Brand::where('top_brand',1)->take(9)->get();
                @endphp
                <ul class="d-flex flex-wrap" style="justify-content: center">
                    @foreach($brands->take(11) as $brand)
                    <li class="d-flex flex-column align-items-center home-brand-slides p-0">
                        <a href="#" class="text-center">
                            <img src="{{ asset($brand->brand_image) }}" alt="brand">
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
	<!--End 4 columns-->
@endsection

@push('footer-script')

     <script type="text/javascript">
		$('.slider__active').slick({
			infinite: true,
			slidesToShow: 1,
			autoplay:true,
			fade:true,
			speed:300,
			arrows:true,
			prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-left"></i></span>',
            nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-arrow-right"></i></span>',
			dots:false,
			slidesToScroll: 1
		  });
    </script>
@endpush