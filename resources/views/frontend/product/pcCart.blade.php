@foreach ($pc_Cart as $data)
    @php
        if($data->product->discount_type == 1){
            $price_after_discount = $data->product->regular_price - $data->product->discount_price;
        }elseif($data->product->discount_type == 2){
            $price_after_discount = $data->product->regular_price - ($data->product->regular_price * $data->product->discount_price / 100);
        }
    @endphp
<div class="col-12">
    <div class="p-3 single__card">
        <div class="d-flex align-items-center gap-5">
            <img src="{{ asset($data->product->product_thumbnail) }}" style="width: 45px"
                alt="">
            <div class="link__product">
                <h5>{{ $data->product->pcBuild->name }}</h6>
                    <a href="{{ route('product.details',$data->product->slug) }}">{{ $data->product->name_en }}</a>
            </div>
        </div>
        <div class="product__card__right">
            <div class="d-flex align-items-center gap-4 product___card">
                <div class="input-group">
                    <input type="hidden" value="{{ $data->product_id }}" class="product_id">
                    <span class="input-group-text changeQty" data-type="-"><i class="fa fa-minus"></i></span>
                    <input type="text" class="form-control" value="{{ $data->qty}}"
                        aria-label="Amount (to the nearest dollar)">
                    <span class="input-group-text changeQty" data-type="+"><i class="fa fa-plus"></i></span>
                </div>
                <span class="fs-6 product_price"
                    style="color: #000000;font-weight:bold">
                        @php
                             if ($data->product->discount_price > 0) {
                                    $subtotal = $price_after_discount * $data->qty;
                                } else {
                                    $subtotal = $data->product->regular_price * $data->qty;
                                }
                        @endphp
                        {{ $subtotal }}
                </span>
                <a  class="product__remove" data-id="{{ $data->id }}">
                    <i class="fa fa-close"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach
