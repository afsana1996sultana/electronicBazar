@extends('layouts.frontend')
@push('css')
    <style>
        .builder__header {
            background: #F4F4F4;
        }

        .builder__icon span {
            font-size: 10px;
            text-transform: capitalize;
            display: inline-block;
        }

        .builder__icon:first-child {
            margin-left: 0;
        }

        .builder__icon {
            display: block;
            text-align: center;
            line-height: 1;
            box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;
            padding: 5px;
            margin-left: 10px;
            border-radius: 3px;
            transition: all .5s ease-in-out;
            width: 60px;
            height: 50px;
        }

        .builder__icon:hover {
            cursor: pointer;
            transform: translateY(-2px);
            color: purple;
        }

        .builder__icon i {
            font-size: 20px;
        }

        .single__builder.builder__btn {
            display: flex;
            justify-content: end;
        }

        .builder__count {
            border: 2px solid purple;
            padding: 5px 10px;
            display: inline-block;
            border-radius: 3px;
            font-weight: 700;
        }

        .single__builder h3 {
            margin-bottom: 0;
            font-weight: 600;
        }

        .single__builder p {
            font-size: 14px;
            margin-bottom: 0;
        }

        .product__card__left img {
            width: 50px;
            margin-right: 10px;
        }

        .single__card {
            display: flex;
            border: 1px solid #ddd;
            align-items: center;
            justify-content: space-between;
            border-radius: 3px;
        }

        .product__card__right a {
            text-decoration: none;
            border: 1px solid purple;
            color: #000;
            transition: all .5s ease-in-out;
            display: inline-block;
            padding: 2px 10px;
            border-radius: 3px;
            text-transform: capitalize;
        }

        .product__card__right a:hover {
            color: #fff;
            background: purple;
        }

        .product__card__left {
            text-decoration: none;
            color: #000;
            font-weight: 600;
        }

        .product__card__left span {
            transition: all .5s ease-in-out;
        }

        .product__card__left span:hover {
            color: purple;
        }

        .select2-selection.select2-selection--single {
            border-radius: 0;
        }

        .instrument__header {
            text-align: center;
            background: #F4F4F4;
            padding: 10px;
        }

        .instrument__header h5 {
            margin-bottom: 0;
            font-weight: 600;
        }

        /* Normal desktop :1200px. */
        @media (min-width: 1200px) and (max-width: 1500px) {}


        /* Normal desktop :992px. */
        @media (min-width: 992px) and (max-width: 1200px) {}


        /* Tablet desktop :768px. */
        @media (min-width: 768px) and (max-width: 991px) {}


        /* Large Mobile :480px. */
        @media only screen and (min-width: 480px) and (max-width: 767px) {}

        /* small mobile :320px. */
        @media (max-width: 767px) {
            .shareButton {
                position: absolute;
                right: 30px;
                width: 100%;
            }

            .builder__icon {
                height: auto !important;
                padding: 10px;
            }

            .product__card__right {
                margin-top: 15px;
            }

            .builder__icon i {
                font-size: 15px;
            }

            .builder__btn span {
                display: none;
            }

            .single__builder.heading__name {
                margin-bottom: 10px;
            }

            span.input-group-text {
                display: block;
                padding: 0 !important;
                margin: 0 !important;
            }

            .product___card .input-group {
                width: auto;
            }
        }


        .product__card__right span.input-group-text {
            padding: 0;
            width: 30px;
            height: 30px;
            margin: auto;
            justify-content: center;
            border-radius: 0;
            cursor: pointer;
        }

        .product__card__right input {
            padding: 0;
            height: auto;
            border: 1px solid #ddd;
            text-align: center;
            max-width: 80px;
        }

        a.product__remove {
            padding: 5px 7px;
            line-height: 1;
        }

        .link__product h5 {
            text-transform: capitalize;
            font-size: 18px
        }

        .link__product a {
            color: #000;
            font-size: 15px;
        }

        .link__product {
            max-width: 500px;
            line-height: 1.2;
        }

        div#social-links ul {
            display: flex;
            background: #fff;
            /* padding: 10px; */
            border: 1px solid #3892cf;
            width: max-content;
            position: relative;
            border-radius: 5px;
            margin-top: 30px;
            z-index: 9;
        }

        div#social-links {
            position: relative;
            right: 100%;
            transition: all .5s ease-in-out;
        }

        div#social-links ul li a span {
            font-size: 20px;
            display: inline-block;
            padding: 10px;
        }

        span.select2-selection.select2-selection--single {
            border: 1px solid #ddd;
            padding: 0px 15px;
            width: 300%;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            right: -250px;
        }

        .select2-dropdown {
            min-width: 400px;
        }
    </style>
@endpush

@section('content-frontend')
    <div class="builder__header py-3 my-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 col-6 order-2 order-md-1">
                    <div class="single__builder">
                        <span class="builder__count">Total Tk :<span id="allTotal">0</span></span>
                    </div>
                </div>
                <div class="col-md-3 col-12  order-1 order-md-2">
                    <div class="single__builder text-center heading__name">
                        <h3>PC Builder</h3>
                        <p>Select your Components</p>
                    </div>
                </div>
                <div class="col-md-5 col-6 order-3 order-md-3">
                    <div class="single__builder builder__btn">
                        <div class="builder__icon" title="download">
                            @if ($pc_Cart->count() > 0)
                                <a href="{{ route('sharePdfPage') }}" download>
                                    <i class="fa-solid fa-cloud-arrow-down"></i> <br>
                                    <span>download</span>
                                </a>
                            @else
                                <i class="fa-solid fa-cloud-arrow-down"></i> <br>
                                <span>download</span>
                            @endif
                        </div>
                        <div class="builder__icon" title="print">
                            @if ($pc_Cart->count() > 0)
                                <a href="{{ route('sharePdfPage') }}" target="blank">
                                    <i class="fa-solid fa-print"></i> <br>
                                    <span>print</span>
                                </a>
                            @else
                                <i class="fa-solid fa-print"></i> <br>
                                <span>print</span>
                            @endif
                        </div>
                        <div class="builder__icon share__pc" title="share">
                            {{-- @if ($pc_Cart->count() > 0) --}}
                            <a href="javascript:void(0)" class="toggle-share">
                                <i class="fa-solid fa-share"></i><br>
                                <span>Share</span>
                            </a>
                            <div class="shareButton d-none">
                                {!! $shareButton !!}
                            </div>
                            {{-- @else
                                <i class="fa-solid fa-share"></i><br>
                                <span>Share</span>
                            @endif --}}
                        </div>

                        <div class="builder__icon" title="shopping-cart">
                            @if ($pc_Cart->count() > 0)
                                <a href="{{ route('add.Pc.Main.Cart') }}">
                                    <i class="fa-solid fa-shopping-cart"></i> <br>
                                    <span>Add to Cart</span>
                                </a>
                            @else
                                <i class="fa-solid fa-shopping-cart"></i> <br>
                                <span>Add to Cart</span>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="builder__body ">
        <div class="container">
            <div class="row gy-1">
                <div class="col-12">
                    <div class="instrument__header">
                        <h5>Build Your PC ( Instruments List )</h5>
                    </div>
                </div>
                <div class="pc_cart_items">
                </div>
                <div class="select_product_option">
                    @foreach ($pc_buildings->where('others', 0) as $key => $item)
                        <div class="col-12">
                            <div class="p-3 single__card">
                                <a href="" class="product__card__left d-flex align-items-center">
                                    <img src="{{ asset($item->image) }}" alt="">
                                    <span>{{ $item->name }}</span>
                                </a>
                                <div class="product__card__right">
                                    <a href="{{ route('product.category', $item->slug) }}">select</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12">
                        <div class="p-3 single__card">
                            <div class="col-6 col-md-3">
                                {{--  <select name="" class="form-select form-select-sm selectsearch pcitem">  --}}
                                <select name="" class="form-select pcitem">
                                    <option value="">Select Other Option</option>
                                    @foreach ($pc_buildings->where('others', 1) as $key => $item)
                                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="product__card__right select-button-add mt-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".toggle-share").click(function(e) {
                e.preventDefault();
                $(".shareButton").toggleClass("d-none");
            });
        });
    </script>
    <script>
        $(document).on('change', '.pcitem', function() {
            $('.select-button-add').empty();
            var slug = $(this).val();
            if (slug) {
                $('.select-button-add').append(
                    `<a href="/category-product/${slug}">select</a>`
                );
            }
        });
    </script>
    <script>
        $(document).on('click', '.changeQty', function() {
            var product_id = $(this).closest('.product__card__right').find('.product_id').val();
            var type = $(this).data('type');
            var data = {
                'product_id': product_id,
                'type': type
            }
            $.ajax({
                method: "get",
                url: "/pc/update/cart",
                data: data,
                success: function(response) {
                    let Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1200
                    });
                    if (response.success) {
                        Toast.fire({
                            icon: 'success',
                            title: response.success
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: response.error
                        });
                    }
                    getPcCart()
                }
            })
        })

        function getPcCart() {
            $.ajax({
                method: "get",
                url: "/pc/get/cart",
                success: function(response) {
                    $('.pc_cart_items').html(response.cart_data);
                    $('#allTotal').text(response.totalPrice);
                }
            })
        }
        getPcCart()
        $(document).on('click', '.product__remove', function() {
            var remove = $(this);
            var id = remove.data('id');
            $.ajax({
                url: "{{ route('pc.cart.delete', '') }}" + '/' + id,
                method: "get",
                success: function(response) {
                    getPcCart()
                    let Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1200
                    });
                    location.reload();
                    if (response.success) {
                        Toast.fire({
                            icon: 'success',
                            title: response.success
                        });
                    }
                }
            });
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
    <script>
        $(function() {
            $(".selectsearch").select2();
        });
    </script>
@endpush