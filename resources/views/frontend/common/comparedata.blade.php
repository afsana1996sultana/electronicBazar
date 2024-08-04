@if($compareCount->count() > 0)
    @foreach($compareCount as $key=> $item)
        <div class="col-3">
            <div class="wishlist__product position-relative">
                <i class="fa fa-close" id="{{$item->id }}" onclick="removeCompareList(this.id)"></i>
                <a href="{{ route('product.details',$item->product->slug) }}">
                <img src="{{$item->product->product_thumbnail  }}" alt="">
                <p>{{ Str::limit($item->product->name_en, 40) }}</p></a>
            </div>
        </div>
    @endforeach
@else
    <h4 class="text-center text-danger"> Empty!</h4>
@endif
