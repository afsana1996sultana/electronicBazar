@extends('layouts.frontend')
@push('css')
    <style>
        .app-figure {
            width: 100% !important;
            margin: 0px auto;
            border: 0px solid red;
            padding: 20px;
            position: relative;
            text-align: center;
        }

        .MagicZoom {
            display: none;
        }

        .MagicZoom.Active {
            display: block;
        }

        .selectors {
            margin-top: 10px;
        }

        .selectors .mz-thumb img {
            max-width: 56px;
        }
        
         .selectors {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .rating i {
            color: #ffb301;
        }

        .single-review-item {
            border-top: 1px solid #ffb301;
        }

        .single-review-item {
            padding: 10px 0;
        }

        .review_list {
            margin-top: 20px;
        }

        .selectors .mz-thumb img {
            max-width: 56px;
        }
        a[data-zoom-id],
        .mz-thumb,
        .mz-thumb:focus {
            margin-top: 0 !important;
        }

        @media screen and (max-width: 1023px) {
            .app-figure {
                width: 99% !important;
                margin: 20px auto;
                padding: 0;
            }
        }
    </style>
    <!-- Image zoom -->
    <link rel="stylesheet" href="{{ asset('frontend/magiczoomplus/magiczoomplus.css') }}" />
@endpush
@section('meta')
    <meta property="og:title" content="{{ $product->name_en }}">
    <meta property="og:image" content="{{ asset($product->product_thumbnail) }}">
@endsection
@section('content-frontend')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    @if ($product->category->type == 3)
                        @php
                            $child_cat = App\Models\Category::where('id', $product->category->parent_id)->first();
                        @endphp
                        @php
                            $sub_cat = App\Models\Category::where('id', $child_cat->parent_id)->first();
                        @endphp
                        @if ($child_cat->type == 2)
                            <a href="{{ route('product.category', $sub_cat->slug ?? '') }}"><i class="fi-rs-home mr-5"></i>
                                @if (session()->get('language') == 'bangla')
                                    {{ $sub_cat->name_bn ?? 'No Category' }}
                                @else
                                    {{ $sub_cat->name_en ?? 'No Category' }}
                                @endif
                            </a>
                        @endif
                        <span></span>
                        <a href="{{ route('product.category', $child_cat->slug) }}">
                            @if (session()->get('language') == 'bangla')
                                {{ $child_cat->name_bn ?? 'No Category' }}
                            @else
                                {{ $child_cat->name_en ?? 'No Category' }}
                            @endif
                        </a>
                        <span></span>
                        <a href="{{ route('product.category', $product->category->slug) }}">
                            @if (session()->get('language') == 'bangla')
                                {{ $product->category->name_bn ?? 'No Category' }}
                            @else
                                {{ $product->category->name_en ?? 'No Category' }}
                            @endif
                        </a>
                    @endif
                    @if ($product->category->type == 2)
                        @php
                            $sub_cat = App\Models\Category::where('id', $product->category->parent_id)->first();
                        @endphp
                        <a href="{{ route('product.category', $sub_cat->slug ?? '') }}"><i class="fi-rs-home mr-5"></i>
                            @if (session()->get('language') == 'bangla')
                                {{ $sub_cat->name_bn ?? 'No Category' }}
                            @else
                                {{ $sub_cat->name_en ?? 'No Category' }}
                            @endif
                        </a>
                        <span></span>
                        <a href="{{ route('product.category', $product->category->slug) }}">
                            @if (session()->get('language') == 'bangla')
                                {{ $product->category->name_bn ?? 'No Category' }}
                            @else
                                {{ $product->category->name_en ?? 'No Category' }}
                            @endif
                        </a>
                    @endif
                    @if ($product->category->type == 1)
                        <a href="{{ route('product.category', $product->category->slug ?? '') }}"><i
                                class="fi-rs-home mr-5"></i>
                            @if (session()->get('language') == 'bangla')
                                {{ $product->category->name_bn ?? 'No Category' }}
                            @else
                                {{ $product->category->name_en ?? 'No Category' }}
                            @endif
                        </a>
                    @endif

                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-11 col-lg-12 m-auto">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="product-detail accordion-detail">
                                <div class="row mb-20 mt-20">
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0">
                                        <!-- Product Zoom Image -->
                                        <div class="product__details__page">
                                            {{--  <a rel="selectors-effect-speed: 600; disable-zoom: true;" id="Zoom-1" class="MagicZoom Active" data-options="zoomWidth: 300; zoomHeight: 300; expandZoomMode: magnifier; expandZoomOn: always; variableZoom: true; rightClick: true;" title="Show your product in stunning detail with {{config('app.name')}} Zoom." style="max-width: 438px; max-height: 438px;"
								            href="{{ asset($product->product_thumbnail) }}?h=1400"
								            data-zoom-image-2x="{{ asset($product->product_thumbnail) }}"
								            data-image-2x="{{ asset($product->product_thumbnail) }}"
								        >
								            <img id="product_zoom_img" style="max-width: 438px; max-height: 438px;" src="{{ asset($product->product_thumbnail ) }}" srcset="{{ asset($product->product_thumbnail) }}" alt="">
								        </a>  --}}
                                            <img src="{{ asset($product->product_thumbnail) }}" alt="">

                                            <div class="product___gallery">
                                                @foreach ($product->multi_imgs as $img)
                                                    <a href="{{ asset($img->photo_name) }}" class="gallery-item">
                                                        <img src="{{ asset($img->photo_name) }}" alt="">
                                                    </a>
                                                @endforeach

                                            </div>

                                            {{--  <div class="selectors mt-30">
								        	@foreach ($product->multi_imgs as $img)
								            <a rel="selectors-effect-speed: 600; disable-zoom: true;"
								            	class="me-4"
								                data-zoom-id="Zoom-1"
								                href="{{ asset($img->photo_name ) }}"
								                data-image="{{ asset($img->photo_name ) }}"
								                data-zoom-image-2x="{{ asset($img->photo_name ) }}"
								                data-image-2x="{{ asset($img->photo_name ) }}"
								            >
								                <img style="height: 80px !important;" srcset="{{ asset($img->photo_name ) }}">
								            </a>
								            @endforeach
								        </div>  --}}
                                        </div>
                                        <!-- Product Zoom Image End -->
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="detail-info pr-30 pl-30">
                                            @php
                                                $discount = 0;
                                                $amount = $product->regular_price;
                                                if ($product->discount_price > 0) {
                                                    if ($product->discount_type == 1) {
                                                        $discount = $product->discount_price;
                                                        $amount = $product->regular_price - $discount;
                                                    } elseif ($product->discount_type == 2) {
                                                        $discount = ($product->regular_price * $product->discount_price) / 100;
                                                        $amount = $product->regular_price - $discount;
                                                    } else {
                                                        $amount = $product->regular_price;
                                                    }
                                                }

                                            @endphp

                                            {{-- @if ($product->discount_price > 0)
		                          			@if ($product->discount_type == 1)
	                                			<span class="stock-status out-stock"> ৳{{ $discount }} Off </span>
	                                		@elseif ($product->discount_type == 2)
	                                			<span class="stock-status out-stock"> {{ $product->discount_price }}% Off </span>
	                                		@endif
			                            @endif --}}

                                            <input type="hidden" id="discount_amount" value="{{ $discount }}">

                                            <h2 class="title-detail">
                                                @if (session()->get('language') == 'bangla')
                                                    {{ $product->name_bn }}
                                                @else
                                                    {{ $product->name_en }}
                                                @endif
                                            </h2>
                                            <h6 class="pt-4">Product ID:{{ $product->product_code }}</h6>
                                            <div class="clearfix product-price-cover">
                                                <div class="product-price primary-color float-left">
                                                    @if ($product->discount_price <= 0)
                                                        <span class="text-brand"
                                                            style="font-size:18px;font-weight:bold">৳<span
                                                                class="current-price text-brand">{{ $product->regular_price }}</span></span>
                                                        <input type="hidden" id="hidden-price"
                                                            value="{{ $product->regular_price }}">
                                                    @else
                                                        <span class="ml-3"
                                                            style="font-size: 13px; font-weight: 600;">Discount
                                                            Price:</span>&nbsp;
                                                        <input type="hidden" id="hidden-price"
                                                            value="{{ $amount }}">
                                                        <span class="text-brand"
                                                            style="font-size:18px;font-weight:bold">৳<span
                                                                class="current-price text-brand"
                                                                style="color: #e27e23 !important;">{{ $amount }}</span></span>
                                                        @if ($product->discount_type == 1)
                                                            <span class="save-price font-md color3 ml-15"
                                                                style="color: #000000 !important;"> ৳{{ $discount }}
                                                                Off </span>
                                                        @elseif ($product->discount_type == 2)
                                                            <span class="save-price font-md color3 ml-15"
                                                                style="color: #000000 !important;">{{ $product->discount_price }}%
                                                                Off</span>
                                                        @endif
                                                        <span class="ml-15"
                                                            style="font-size: 13px; font-weight: 600;">Regular
                                                            Price:</span>&nbsp;<span class="old-price font-md ml-0"
                                                            id="oldprice">৳{{ $product->regular_price }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="short-desc mb-30">
                                                <span
                                                    style="font-size: 13px; color: #DD1D21 !important; font-weight: bold;">Key
                                                    Points</span>
                                                <p class="font-lg">
                                                    @if (session()->get('language') == 'bangla')
                                                        {!! $product->short_description_bn ?? 'No Decsription' !!}
                                                    @else
                                                        {!! $product->short_description_en ?? 'No Decsription' !!}
                                                    @endif
                                                </p>
                                            </div>
                                            <form id="choice_form">
                                                <div class="row " id="choice_attributes">
                                                    @if ($product->is_varient)
                                                        @php $i=0; @endphp
                                                        @foreach (json_decode($product->attribute_values) as $attribute)
                                                            @php
                                                                $attr = get_attribute_by_id($attribute->attribute_id);
                                                                $i++;
                                                            @endphp
                                                            <div class="attr-detail attr-size mb-30">
                                                                <strong class="mr-10">{{ $attr->name }}: </strong>
                                                                <input type="hidden" name="attribute_ids[]"
                                                                    id="attribute_id_{{ $i }}"
                                                                    value="{{ $attribute->attribute_id }}">
                                                                <input type="hidden" name="attribute_names[]"
                                                                    id="attribute_name_{{ $i }}"
                                                                    value="{{ $attr->name }}">
                                                                <input type="hidden"
                                                                    id="attribute_check_{{ $i }}"
                                                                    value="0">
                                                                <input type="hidden"
                                                                    id="attribute_check_attr_{{ $i }}"
                                                                    value="0">
                                                                <ul class="list-filter size-filter font-small">
                                                                    @foreach ($attribute->values as $value)
                                                                        <li>
                                                                            <a href="#"
                                                                                onclick="selectAttribute('{{ $attribute->attribute_id }}{{ $attr->name }}', '{{ $value }}', '{{ $product->id }}', '{{ $i }}')"
                                                                                style="border: 1px solid #7E7E7E;">{{ $value }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                    <input type="hidden" name="attribute_options[]"
                                                                        id="{{ $attribute->attribute_id }}{{ $attr->name }}"
                                                                        class="attr_value_{{ $i }}">
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                        <input type="hidden" id="total_attributes"
                                                            value="{{ count(json_decode($product->attribute_values)) }}">
                                                    @endif
                                                </div>
                                            </form>

                                            <div class="row" id="attribute_alert"></div>
                                            <div class="detail-extralink align-items-baseline d-flex">
                                                <div class="mr-10">
                                                    <span style="color:#e27e23 !important;">Quantity:</span>
                                                </div>
                                                <div class="detail-qty border radius">
                                                    <a href="#" class="qty-down"><i
                                                            class="fi-rs-angle-small-down"></i></a>
                                                    <input type="text" name="quantity" class="qty-val" value="1"
                                                        min="1" id="qty">
                                                    <a href="#" class="qty-up"><i
                                                            class="fi-rs-angle-small-up"></i></a>
                                                </div>

                                            </div>
                                            <div class="detail-extralink">
                                                <div class="product-extra-link2 special_links mb-20">

                                                    <input type="hidden" id="product_id" value="{{ $product->id }}"
                                                        min="1">
                                                    <input type="hidden" id="pname"
                                                        value="{{ $product->name_en }}">
                                                    <input type="hidden" id="product_price"
                                                        value="{{ $amount }}">
                                                    <input type="hidden" id="minimum_buy_qty"
                                                        value="{{ $product->minimum_buy_qty }}">
                                                    <input type="hidden" id="stock_qty"
                                                        value="{{ $product->stock_qty }}">
                                                    <input type="hidden" id="pvarient" value="">
                                                    <input type="hidden" id="buyNowCheck" value="0">
                                                    <button type="submit" class="button button-add-to-cart"
                                                        onclick="addToCart()">Add to cart</button>
                                                    <button type="submit"
                                                        class="button button-add-to-cart ml-5 bg-danger buy_now-btn"
                                                        onclick="buyNow()"></i>Buy Now</button>

                                                    <!--share wrapper-->
                                                    <div class="share_wrapper">
                                                        <div class="share_button">
                                                            <i class="fa-solid fa-share-nodes"></i>
                                                        </div>
                                                        <div class="share_app">
                                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                                                target="_blank">
                                                                <button type="submit"
                                                                    class="button button-add-to-cart bg-primary"><i
                                                                        class="fa-brands fa-facebook-f"></i></button>
                                                            </a>
                                                            <a href="https://api.whatsapp.com/send?text={{ urlencode($product->name_en . ' - ' . url()->current()) }}"
                                                                class="whatsapp" target="_blank">
                                                                <button type="submit"
                                                                    class="button button-add-to-cart bg-primary"><i
                                                                        class="fa-brands fa-whatsapp"></i></button>
                                                            </a>

                                                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($product->name_en) }}&url={{ urlencode(url()->current()) }}"
                                                                class="twitter" target="_blank">
                                                                <button type="submit"
                                                                    class="button button-add-to-cart bg-primary"><i
                                                                        class="fa-brands fa-twitter"></i></button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="font-xs">
                                                <ul class="mr-50 float-start">
                                                    {{-- @if (isset($product->warranty->value))
	                                                <li class="mb-5" style="font-size: 16px;">Warranty Type : <span class="" style="font-size: 16px; color: #DD1D21; font-weight: bold;">{{ $product->warranty->value ?? ' '}} {{ $product->warranty->label ?? ' '}}</span></li>
	                                            @endif --}}
                                                    <li class="mb-5">
                                                        Warranty Type :
                                                        <span class="text-brand">
                                                            {{ $product->warranty->value ?? 'No Warranty' }}
                                                            {{ $product->warranty->label ?? ' ' }}
                                                        </span>
                                                    </li>
                                                    <li class="mb-5">Regular Price: <span
                                                            class="text-brand">{{ $product->regular_price }} ৳</span></li>
                                                    <li class="mb-5">Stock:
                                                        @if ($product->stock_qty > 0)
                                                            <span class="badge badge-pill badge-success"
                                                                style="background: green; color: white;">In Stock</span>
                                                        @else
                                                            <span class="badge badge-pill badge-danger"
                                                                style="background: red; color: white;">Stock Out</span>
                                                        @endif
                                                    </li>
                                                    <li class="mb-5">Category:<span class="text-brand">
                                                            {{ $product->category->name_en ?? 'No Category' }}
                                                        </span></li>
                                                </ul>
                                                <ul class="float-start">
                                                    @if ($product->emi_price > 0)
                                                        <li class="mb-5">
                                                            <a href="{{ route('emi.information') }}">EMI SYSTEM IS AVAILABLE</a>
                                                        </li>
                                                        <li class="mb-5">
                                                            EMI Monthly Price:
                                                            <span rel="tag" style="color: #e27e23 !important;">
                                                                {{ $product->emi_price }}৳
                                                            </span>
                                                        </li>
                                                    @endif
                                                    <li class="mb-5">Brand:
                                                        <span rel="tag" style="color: #e27e23 !important;">
                                                            {{ $product->brand->name_en ?? 'No Brand' }}
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Detail Info -->
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <div class="tab-style3">
                                            <ul class="nav nav-tabs text-uppercase">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                                        href="#Specification">Specification</a>
                                                </li>
                                               <!--<li class="nav-item">-->
                                               <!--     <a class="nav-link " id="Description-tab" data-bs-toggle="tab"-->
                                               <!--         href="#Description">Description</a>-->
                                               <!-- </li>-->
                                                <li class="nav-item">
                                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                                                        href="#Additional-info">Additional info</a>
                                                </li>
                                                 <li class="nav-item">
                                                    @php
                                                        $data = \App\Models\Review::where('product_id', $product->id)
                                                            ->where('status', 1)
                                                            ->get();
                                                    @endphp
                                                    <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab"
                                                        href="#reviews">reviews ({{ $data->count() }})</a>
                                                </li>
                                                @if (get_setting('multi_vendor')->value)
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab"
                                                            href="#Vendor-info">Seller</a>
                                                    </li>
                                                @endif
                                            </ul>
                                            <div class="tab-content shop_info_tab entry-main-content">
                                                <div class="tab-pane fade show active" id="Specification">
                                                    <div class="row">
                                                        <!--@if (count($specs) > 0)-->
                                                            <table class="table table-hover">
                                                                @foreach ($specs as $key => $spec)
                                                                    <tr>
                                                                        <td style="color: #888; width: 30%;">
                                                                            {{ $spec->spec }}</td>
                                                                        <td>{{ $spec->spec_value }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        <!--@else-->
                                                        <!--    <p>No specification added.</p>-->
                                                        <!--@endif-->
                                                        <h5 style="padding-bottom:5px">Description :</h5>
                                                        
                                                        <p>
                                                            @if (session()->get('language') == 'bangla')
                                                                {!! $product->description_en ?? 'No Product Long Descrption' !!}
                                                            @else
                                                                {!! $product->description_bn ?? 'No Product Logn Descrption' !!}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <!--<div class="tab-pane fade show " id="Description">-->
                                                <!--    <div class="">-->
                                                <!--        <p>-->
                                                <!--            @if (session()->get('language') == 'bangla')-->
                                                <!--                {!! $product->description_en ?? 'No Product Long Descrption' !!}-->
                                                <!--            @else-->
                                                <!--                {!! $product->description_bn ?? 'No Product Logn Descrption' !!}-->
                                                <!--            @endif-->
                                                <!--        </p>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <div class="tab-pane fade" id="Additional-info">
                                                    <table class="font-md">
                                                        <tbody>
                                                            <tr class="stand-up">
                                                                <th>Product Code</th>
                                                                <td>
                                                                    <p>{{ $product->product_code ?? 'No Product Code' }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr class="folded-wo-wheels">
                                                                <th>Product Size</th>
                                                                <td>
                                                                    <p>{{ $product->product_size_en ?? 'No Product Size' }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr class="folded-w-wheels">
                                                                <th>Product Color</th>
                                                                <td>
                                                                    <p>{{ $product->product_color_en ?? 'No Product Color' }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane fade" id="reviews">
                                                    <div class="product__review__system">
                                                        <h6>Youre reviewing:</h6>
                                                        <h5>
                                                            @if (session()->get('language') == 'bangla')
                                                                {{ $product->name_bn }}
                                                            @else
                                                                {{ $product->name_en }}
                                                            @endif
                                                        </h5>
                                                        <form action="{{ route('review.store') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ Auth::user()->id ?? 'null' }}">
                                                            <div class="product__rating">
                                                                <label for="rating">Rating <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="rating-checked">
                                                                    <input type="radio" name="rating"
                                                                        value="5" style="--r: #ffb301" />
                                                                    <input type="radio" name="rating"
                                                                        value="4" style="--r: #ffb301" />
                                                                    <input type="radio" name="rating"
                                                                        value="3" style="--r: #ffb301" />
                                                                    <input type="radio" name="rating"
                                                                        value="2" style="--r: #ffb301" />
                                                                    <input type="radio" name="rating"
                                                                        value="1" style="--r: #ffb301" />
                                                                </div>
                                                                @error('rating')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="review__form">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="name">Name <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" name="name"
                                                                                id="name"
                                                                                value="{{ old('name') }}">
                                                                            @error('name')
                                                                                <p class="text-danger">{{ $message }}
                                                                                </p>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        {{-- <div class="form-group">
                                                                            <label for="summary">Summary <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" name="summary"
                                                                                id="summary"
                                                                                value="{{ old('summary') }}">
                                                                            @error('summary')
                                                                                <p class="text-danger">{{ $message }}
                                                                                </p>
                                                                            @enderror
                                                                        </div> --}}
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="review">Review <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" name="review"
                                                                                id="review"
                                                                                value="{{ old('review') }}">
                                                                            @error('review')
                                                                                <p class="text-danger">{{ $message }}
                                                                                </p>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn btn-info">Submit
                                                                    Review</button>
                                                            </div>
                                                        </form>
                                                        <div class="review_list">
                                                            @php
                                                                $data = \App\Models\Review::where('product_id', $product->id)
                                                                    ->latest()
                                                                    ->get();
                                                            @endphp
                                                            @foreach ($data as $value)
                                                                @if ($value->status == 1)
                                                                    <div class="single-review-item">
                                                                        <h6 class="review-user" style="font-size: 16px">{{ $value->name }}
                                                                        <div class="rating">
                                                                            @if ($value->rating == '1')
                                                                                <i class="fa fa-star"></i>
                                                                            @elseif($value->rating == '2')
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                            @elseif($value->rating == '3')
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                            @elseif($value->rating == '4')
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                            @elseif($value->rating == '5')
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                            @endif
                                                                        </div>
                                                                        {{-- <h5 class="review-title">{{ $value->summary }}
                                                                        </h5> --}}

                                                                        </h6>
                                                                        <span
                                                                            class="review-description" style="font-size: 16px">{!! $value->review !!}</span>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                @if (get_setting('multi_vendor')->value)
                                                    <div class="tab-pane fade" id="Vendor-info">
                                                        <div class="vendor-logo d-flex mb-30">
                                                            <img src="{{ asset('frontend') }}/assets/imgs/vendor/vendor-18.svg"
                                                                alt="" />
                                                            <div class="vendor-name ml-15">
                                                                <h6>
                                                                    <a href="#">Noodles Co.</a>
                                                                </h6>
                                                                <div class="product-rate-cover text-end">
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: 90%">
                                                                        </div>
                                                                    </div>
                                                                    <span class="font-small ml-5 text-muted"> (32
                                                                        reviews)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="contact-infor mb-50">
                                                            <li><img src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-location.svg"
                                                                    alt="" /><strong>Address: </strong> <span>5171
                                                                    W Campbell Ave undefined Kent, Utah 53127 United
                                                                    States</span></li>
                                                            <li><img src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-contact.svg"
                                                                    alt="" /><strong>Contact
                                                                    Seller:</strong><span>(+91) - 540-025-553</span></li>
                                                        </ul>
                                                        <div class="d-flex mb-55">
                                                            <div class="mr-30">
                                                                <p class="text-brand font-xs">Rating</p>
                                                                <h4 class="mb-0">92%</h4>
                                                            </div>
                                                            <div class="mr-30">
                                                                <p class="text-brand font-xs">Ship on time</p>
                                                                <h4 class="mb-0">100%</h4>
                                                            </div>
                                                            <div>
                                                                <p class="text-brand font-xs">Chat response</p>
                                                                <h4 class="mb-0">89%</h4>
                                                            </div>
                                                        </div>
                                                        <p>
                                                            Noodles & Company is an American fast-casual restaurant that
                                                            offers international and American noodle dishes and pasta in
                                                            addition to soups and salads. Noodles & Company was founded in
                                                            1995 by Aaron Kennedy and is headquartered in Broomfield,
                                                            Colorado. The company went public in 2013 and recorded a $457
                                                            million revenue in 2017.In late 2018, there were 460 Noodles &
                                                            Company locations across 29 states and Washington, D.C.
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-30">
                                        <div class="col-12">
                                            <h2 class="section-title style-1 mb-30">Related products</h2>
                                        </div>
                                        <div class="col-12">
                                            <div class="row related-products product-row">
                                                @forelse($relatedProduct as $product)
                                                    @include('frontend.common.product_grid_view', [
                                                        'product' => $product,
                                                    ])
                                                @empty
                                                    @if (session()->get('language') == 'bangla')
                                                        <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5>
                                                    @else
                                                        <h5 class="text-danger">No products were found here!</h5>
                                                    @endif
                                                @endforelse
                                            </div>
                                            <button class="btn btn-xs d-flex mx-auto" id="seemore">Load More <i
                                                    class="fi-rs-arrow-small-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection

@push('footer-script')
    <!-- Image zoom -->
    <script src="{{ asset('frontend/magiczoomplus/magiczoomplus.js') }}"></script>
    <script>
        $('.product___gallery').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            arrows: true,
            prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-left"></i></span>',
            nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-arrow-right"></i></span>',
            autoplaySpeed: 2000,
        });
    </script>
    <script>
        $('.gallery-item').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    </script>
    <script>
        var mzOptions = {
            zoomWidth: "400px",
            zoomHeight: "400px",
            zoomDistance: 15,
            expandZoomMode: "magnifier",
            expandZoomOn: "always",
            variableZoom: true,
            // lazyZoom: true,
            selectorTrigger: "hover"
        };
    </script>
    <script type="text/javascript">
        /* ================ Load More Product show ============ */
        jQuery(".product-row .product-row-list").hide();
        jQuery(".product-row .product-row-list").slice(0, 15).show();

        jQuery("#seemore").click(function() {
            jQuery(".product-row .product-row-list:hidden")
                .slice(0, 15)
                .slideDown();

            if (jQuery(".product-row .product-row-list:hidden").length === 0) {
                jQuery("#seemore").addClass("d-none");
            }
        });
    </script>
@endpush