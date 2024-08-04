<style>
.main-search-box .card {
    background-color: #fff;
    padding: 15px;
    border: none
}
.main-search-box .input-box {
    position: relative
}
.main-search-box .input-box i {
    position: absolute;
    right: 13px;
    top: 15px;
    color: #ced4da
}
.main-search-box .form-control {
    height: 50px;
    background-color: #eeeeee69
}
.main-search-box .form-control:focus {
    background-color: #eeeeee69;
    box-shadow: none;
    border-color: #eee
}
.main-search-box .list {
    padding-top: 20px;
    padding-bottom: 10px;
    display: flex;
    align-items: center
}
.main-search-box .border-bottom {
    border-bottom: 2px solid #eee;
}
.main-search-box .list i {
    font-size: 19px;
    color: red
}
.main-search-box .list small {
    color: #dedddd

}
.main-search-box .price{
    font-size: 18px;
    font-weight: bold;
    color: #3BB77E;
}
.main-search-box .old-price{
    font-size: 14px;
    color: #adadad;
    margin: 0 0 0 7px;
    text-decoration: line-through;
}
.pc__builder {
    border: 2px solid #e27e23;
    padding: 0 !important;
    border-radius: 5px;
    margin-left:20px;
}

    .pc__builder a {padding: 2px 10px;padding-bottom: 8px;font-weight: bold;text-transform:uppercase;transition: all .5s ease-in-out;letter-spacing:1px}

.pc__builder:hover a {
    background: #e27e23;
}
</style>
@php
    $couponCode = getCoupon();
@endphp
<header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="header-info">
                            <ul>
                                <li class="contact_header">Need help? Call Us: <strong class="text-brand"> <a class="text-brand" href="tel:{{ get_setting('phone')->value ?? 'null' }}"><i class="fa fa-phone ms-1"></i> {{ get_setting('phone')->value ?? 'null'}}</a></strong></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <li><a href="{{ route('order.tracking') }}">Order Tracking</a></li>
                                <li>
                                    <a class="language-dropdown-active">Language <i class="fi-rs-angle-small-down"></i></a>
                                    <ul class="language-dropdown">
                                        <li>
                                            <a href="{{ route('english.language') }}"><img src="{{asset('frontend/assets/imgs/theme/english-flag.png')}}" alt="" />English</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('bangla.language') }}"><img src="{{asset('frontend/assets/imgs/theme/bangla-flag.png')}}" alt="" />বাংলা</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-lg-block">
            <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
                <div class="container">
                    @if ($couponCode)
                    <div class="maintain-sms text-end pt-3">
                        <h6 style="color:rgb(255, 255, 255)">Coupon Code: <span style="color:#e50505">{{ $couponCode }}</span></h6>
                    </div>
                @endif
                    <div class="header-wrap">
                        <div class="logo logo-width-1">
                            <a href="{{route('home')}}">
                                @php
                                    $logo = get_setting('site_logo');
                                @endphp
                                @if($logo != null)
                                    <img src="{{ asset(get_setting('site_logo')->value ?? 'null') }}" alt="{{ env('APP_NAME') }}">
                                @else
                                    <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}" style="height: 60px !important; width: 80px !important; min-width: 80px !important;">
                                @endif
                            </a>
                        </div>
                        @php
                            $cat_headers = \App\Models\Category::orderBy('name_en','DESC')->where('status','=',1)->where('parent_id', 0)->get();
                        @endphp
                        <div class="header-right">
                            <div class="search-style-2">
                                <div class="search-area">
                                    <form action="{{ route('product.search')
                                    }}" method="post" class="mx-auto">
                                        @csrf
                                        <select class="select-active" name="searchCategory" id="searchCategory">
                                            <option value="0">All Categories</option>
                                            @foreach ($cat_headers as $category)
    											<option value="{{ $category->id }}">{{ $category->name_en }}</option>
    											@foreach ($category->childrenCategories as $childCategory)
    												@include('backend.include.child_category', ['child_category' => $childCategory])
    											@endforeach
    										@endforeach
                                        </select>
                                        <input class="search-field search" onfocus="search_result_show()" onblur="search_result_hide()"  name="search" placeholder="Search here..." />
                                        <div>
                                            <button type="submit" class="bg-brand btn btn-primary text-white btn-sm rounded-0"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="shadow-lg searchProducts"></div>
                            </div>
                            <div class="header-action-right">
                                <div class="header-action-2">
                                    <div class="header-action-icon-2 pc__builder">
                                        <a href="{{ route('pc_building') }}"><span class="lable ml-0" style="color:#04ff5f;font-weight:bolder">PC Builder</span></a>
                                    </div>
                                    <div class="header-action-icon-2">
                                        <a  href="{{ route('dashboard') }}" >
                                            <img class="svgInject" alt="compare" src="{{asset('frontend/assets/imgs/theme/icons/icon-compare.svg')}}" />
                                            <span class="pro-count blue compare-count">0</span>
                                        </a>
                                        <a  href="{{ route('dashboard') }}" ><span class="lable ml-0">Compare</span></a>
                                    </div>
                                    <div class="header-action-icon-2">
                                        <a href="{{ route('dashboard') }}" >
                                            <img class="svgInject" alt="estore-classic" src="{{asset('frontend/assets/imgs/theme/icons/icon-heart.svg')}}" />
                                            <span class="pro-count blue wish-count">0</span>
                                        </a>
                                        <a  href="{{ route('dashboard') }}" ><span class="lable">Wishlist</span></a>
                                    </div>
                                    <div class="header-action-2 cart_hidden_mobile me-3">
                                        <div class="header-action-icon-2">
                                            <a class="mini-cart-icon" href="#">
                                                <img alt="Nest" src="{{asset('frontend/assets/imgs/theme/icons/icon-cart.svg')}}" />
                                                <span class="pro-count blue cartQty"></span>
                                            </a>
                                            <a href="{{ route('cart.show') }}"><span class="lable">Cart</span></a>
                                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                                <div id="miniCart">

                                                </div>
                                                <div class="shopping-cart-footer" id="miniCart_btn">
                                                    <div class="shopping-cart-total">
                                                        <h4>Total <span id="cartSubTotal"></span></h4>
                                                    </div>
                                                    <div class="shopping-cart-button">
                                                        <a href="{{ route('cart.show') }}" class="outline">View cart</a>
                                                        <a href="{{ route('checkout')}}">Checkout</a>
                                                    </div>
                                                </div>
                                                <div class="shopping-cart-footer" id="miniCart_empty_btn">

                                                    <div class="shopping-cart-button d-flex flex-row-reverse">
                                                        <a  href="{{ route('home')}}">Continue Shopping</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="header-action-icon-2">
                                        @auth
                                        <a href="#">
                                            <img class="svgInject" alt="Nest" src="{{asset('frontend/assets/imgs/theme/icons/icon-user.svg')}}" />
                                        </a>
                                        <a href="{{route('dashboard')}}"><span class="lable ml-0">Account</span></a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                            <ul>
                                                <li>
                                                    <a href="{{route('dashboard')}}"><i class="fi fi-rs-user mr-10"></i>My Account</a>
                                                </li>
                                                <li>
                                                    <a class=" mr-10" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        <i class="fi-rs-sign-out mr-10"></i>
                                                        {{ __('Logout') }}
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        @endauth
                                        @guest
                                            <a href="{{ route('login') }}"><span class="lable ml-0"><i class="fa-solid fa-arrow-right-to-bracket mr-10"></i>Login</span></a>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom header-bottom-bg-color sticky-bar">
                <div class="container">
                    <div class="header-wrap header-space-between position-relative">
                        <div class="logo logo-width-1 d-block d-lg-none">
                            <a href="{{route('home')}}">
                                @php
                                    $logo = get_setting('site_logo');
                                @endphp
                                @if($logo != null)
                                    <img src="{{ asset(get_setting('site_logo')->value ?? 'null') }}" alt="{{ env('APP_NAME') }}">
                                @else
                                    <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}" style="height: 60px !important; width: 80px !important; min-width: 80px !important;">
                                @endif
                            </a>
                        </div>
                        <div class="header-nav d-none d-lg-flex">
                            <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                                <nav>
                                    <ul>
                                        <li>
                                            <a href="{{ route('home') }}">
                                                @if(session()->get('language') == 'bangla')
                                                    হোম
                                                @else
                                                    <img alt="home" src="{{asset('frontend/assets/imgs/theme/icons/home-button (2).png')}}" style="padding-left: 5px;
                                                    height: 28px; width: 25px; padding-top: 10px;"/>
                                                @endif
                                            </a>
                                        </li>
                                        <!-- Start Mega Menu -->
                                        @foreach($categories->take(13) as $category)
                                            @if($category->has_sub_sub > 0)
                                                <li class="position-static">
                                                    <a href="{{ route('product.category', $category->slug) }}">
                                                        @if(session()->get('language') == 'bangla')
                                                            {{ $category->name_bn }}
                                                        @else
                                                            {{ $category->name_en }}
                                                        @endif
                                                        @if($category->sub_categories && count($category->sub_categories) > 0)
                                                            <i class="fi-rs-angle-down"></i>
                                                        @endif
                                                    </a>
                                                    @if($category->sub_categories && count($category->sub_categories) > 0)
                                                        <ul class="mega-menu">
                                                            @foreach($category->sub_categories->sortBy('id') as $sub_category)
                                                                <li class="sub-mega-menu sub-mega-menu-width-22">
                                                                    <a class="menu-title" href="{{ route('product.category', $sub_category->slug) }}">
                                                                        @if(session()->get('language') == 'bangla')
                                                                            {{ $sub_category->name_bn }}
                                                                        @else
                                                                            {{ $sub_category->name_en }}
                                                                        @endif
                                                                    </a>
                                                                    @if($sub_category->sub_sub_categories && count($sub_category->sub_sub_categories) > 0)
                                                                        <ul>
                                                                            @foreach($sub_category->sub_sub_categories->sortBy('id') as $sub_sub_category)
                                                                                <li><a href="{{ route('product.category', $sub_sub_category->slug) }}">
                                                                                    @if(session()->get('language') == 'bangla')
                                                                                        {{ $sub_sub_category->name_bn }}
                                                                                    @else
                                                                                        {{ $sub_sub_category->name_en }}
                                                                                    @endif
                                                                                </a></li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @else
                                                <li>
                                                <a href="{{ route('product.category', $category->slug) }}">
                                                @if(session()->get('language') == 'bangla')
                                                    {{ $category->name_bn }}
                                                @else
                                                    {{ $category->name_en }}
                                                @endif
                                                @if($category->sub_categories && count($category->sub_categories) > 0)
                                                <i class="fi-rs-angle-down"></i>
                                                @endif
                                                </a>

                                                @if($category->sub_categories && count($category->sub_categories) > 0)
                                                <ul class="sub-menu">
                                                    @foreach($category->sub_categories as $sub_category)
                                                    <li><a href="{{ route('product.category', $sub_category->slug) }}">{{$sub_category->name_en}}</a></li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                            @endif
                                        @endforeach
                                        <!-- End Mega Menu -->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="header-action-icon-2 d-block d-lg-none">
                            <div class="burger-icon burger-icon-white">
                                <span class="burger-icon-top"></span>
                                <span class="burger-icon-mid"></span>
                                <span class="burger-icon-bottom"></span>
                            </div>
                        </div>
                        <div class="header-action-right d-block d-lg-none">
                            <div class="header-action-2">
                                <!--Mobile Header Search start-->
                                <a class="p-2 d-block text-reset active show">
                                    <i class="fas fa-search la-flip-horizontal la-2x"></i>
                                </a>

                                <section class="advance-search" style="display: none;">
                                    <div class="search-box">
                                        <form action="{{ route('product.search') }}" method="post">
                                        @csrf
                                            <div class="input-group py-2">
                                                <span class="back_left hide"><i class="fas fa-long-arrow-left me-2"></i></span>
                                                <input class="header-search form-control search-field search" aria-label="Input group example" aria-describedby="btnGroupAddon" onfocus="search_result_show()" onblur="search_result_hide()" name="search" placeholder="Search here..." />
                                                <button type="submit" class="input-group-text btn btn-sm" id="btnGroupAddon"><i class="fas fa-search"></i></button>
                                            </div>
                                        </form>
                                        <div class="shadow-lg searchProducts"></div>
                                    </div>
                                </section>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom-1 header-bottom-bg-color sticky-bar d-lg-none">
            <div class="container">
                <ul class="mobile-hor-swipe header-wrap header-space-between position-relative">
                    @foreach($categories as $category)
                        <li class="mb-10">
                            <a class="p-10" href="{{ route('product.category', $category->slug) }}">
                                @if(session()->get('language') == 'bangla')
                                    {{ $category->name_bn }}
                                @else
                                    {{ $category->name_en }}
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </header>
    <!-- Mobile Side menu Start -->
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{route('home')}}">
                        @php
                            $logo = get_setting('site_logo');
                        @endphp
                        @if($logo != null)
                            <img src="{{ asset(get_setting('site_logo')->value ?? 'null') }}" alt="{{ env('APP_NAME') }}">
                        @else
                            <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}" style="height: 60px !important; width: 80px !important; min-width: 80px !important;">
                        @endif
                    </a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Search for items…" />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <li class="menu-item-has-children">
                                <a href="{{route('home')}}"><img alt="home" src="{{asset('frontend/assets/imgs/theme/icons/home-button (2).png')}}" style="padding-left: 5px;
                                height: 28px; width: 25px; padding-top: 10px;"/></a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('category_list.index') }}">Category</a>
                                <ul class="dropdown">
                                    @foreach($categories->take(8) as $category)
                                    <li class="menu-item-has-children">
                                        <a href="{{ route('product.category', $category->slug) }}">
                                            @if(session()->get('language') == 'bangla')
                                                {{ $category->name_bn }}
                                            @else
                                                {{ $category->name_en }}
                                            @endif
                                        </a>
                                        @if($category->sub_categories && count($category->sub_categories) > 0)
                                        <ul class="dropdown">
                                            @foreach($category->sub_categories as $subcategory)
                                            <li>
                                                <a href="{{ route('product.category', $subcategory->slug) }}">
                                                    @if(session()->get('language') == 'bangla')
                                                        {{ $subcategory->name_bn }}
                                                    @else
                                                        {{ $subcategory->name_en }}
                                                    @endif
                                                </a>
                                            </li>
                                            @endforeach
                                            @if($subcategory->sub_sub_categories && count($subcategory->sub_sub_categories) > 0)
                                                <ul class="dropdown">
                                                    @foreach($subcategory->sub_sub_categories as $subsubcategory)
                                                    <li>
                                                        <a href="{{ route('product.category', $subsubcategory->slug) }}">
                                                            @if(session()->get('language') == 'bangla')
                                                                {{ $subsubcategory->name_bn }}
                                                            @else
                                                                {{ $subsubcategory->name_en }}
                                                            @endif
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Pages</a>
                                <ul class="dropdown">
                                    @foreach(get_pages_both_footer()->take(4) as $page)
                                    <li>
                                        <a href="{{ route('page.about', $page->slug) }}">{{ $page->title }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Language</a>
                                <ul class="dropdown">
                                    @if(session()->get('language') == 'bangla')
                                        <li>
                                            <a href="{{ route('english.language') }}">English</a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('bangla.language') }}">বাংলা</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap">
                    <div class="single-mobile-header-info">
                        <a href="{{route('login')}}"><i class="fi-rs-user"></i>Log In </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="{{route('register')}}"><i class="fi-rs-user"></i>Sign Up </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="tel:{{ get_setting('phone')->value ?? 'null' }}"><i class="fi-rs-headphones"></i>{{ get_setting('phone')->value ?? 'null' }} </a>
                    </div>
                </div>
                <div class="mobile-social-icon mb-50">
                    <h6 class="mb-15">Follow Us</h6>
                    <a href="{{ get_setting('facebook_url')->value ?? 'null' }}"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg')}}" alt="" /></a>
                    <a href="{{ get_setting('youtube_url')->value ?? 'null' }}"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg')}}" alt="" /></a>
                    <a href="{{ get_setting('twitter_url')->value ?? 'null' }}"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg')}}" alt="" /></a>
                    <a href="{{ get_setting('instagram_url')->value ?? 'null' }}"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg')}}" alt="" /></a>
                    <a href="{{ get_setting('pinterest_url')->value ?? 'null' }}"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg')}}" alt="" /></a>
                </div>
                <div class="site-copyright">
                    Developed by:
                    <a target="_blank" href="{{ get_setting('developer_link')->value ?? 'null' }}">{{ get_setting('developed_by')->value ?? 'null' }}</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Side menu End -->
    <!--End header-->
@push('footer-script')
@endpush