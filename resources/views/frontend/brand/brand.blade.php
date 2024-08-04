@extends('layouts.frontend')
@section('content-frontend')
    @include('frontend.common.add_to_cart_modal')
@section('title')
    Brand
@endsection
<style>
    #context mark {
        background: #ff8d30;
        color: #000;
    }
</style>
<div class="brand__page">
    <div class="container">
        <div class="row" style="padding-top:20px">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-lg-9 col-12 d-flex align-items-center">
                                <p class="brand-index mb-0">
                                    <strong style="font-size: 20px;margin-right:5px">Brand Index : </strong>
                                    <a href="#letter_1">A</a>
                                    <a href="#letter_2">B</a>
                                    <a href="#letter_3">C</a>
                                    <a href="#letter_4">D</a>
                                    <a href="#letter_5">E</a>
                                    <a href="#letter_6">F</a>
                                    <a href="#letter_7">G</a>
                                    <a href="#letter_8">H</a>
                                    <a href="#letter_9">I</a>
                                    <a href="#letter_10">J</a>
                                    <a href="#letter_11">K</a>
                                    <a href="#letter_12">L</a>
                                    <a href="#letter_13">M</a>
                                    <a href="#letter_14">N</a>
                                    <a href="#letter_15">O</a>
                                    <a href="#letter_16">P</a>
                                    <a href="#letter_17">Q</a>
                                    <a href="#letter_18">R</a>
                                    <a href="#letter_19">S</a>
                                    <a href="#letter_20">T</a>
                                    <a href="#letter_21">U</a>
                                    <a href="#letter_22">V</a>
                                    <a href="#letter_23">W</a>
                                    <a href="#letter_24">X</a>
                                    <a href="#letter_25">Y</a>
                                    <a href="#letter_26">Z</a>
                                    <a href="#letter_28">0 - 9</a>
                                </p>
                            </div>
                            <div class="col-lg-3 col-12 mt-lg-0 mt-2">
                                <input type="text" placeholder="Search Brand" class="form-control" name="markSearch"
                                    id="markSearch">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="context">
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 id="letter_0">Top Brands</h4>
                            <div class="row">
                                @foreach ($brands->where('top_brand',1) as $brand)
                                    <div class="col-lg-3 col-6">
                                        <div class="brand-links">
                                            <a href="{{ route('product.category',$brand->slug) }}">{{ ucfirst($brand->name_en) }}</a>
                                        </div>
                                    </div>
                                 @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 id="letter_1">Latest Brands</h4>
                            <div class="row">
                                @foreach ($brands->take(15) as $brand)
                                    <div class="col-lg-3 col-6">
                                        <div class="brand-links">
                                            <a href="{{ route('product.category',$brand->slug) }}">{{ ucfirst($brand->name_en) }}</a>
                                        </div>
                                    </div>
                                 @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 id="letter_2">Oldest Brands</h4>
                            <div class="row">
                                @foreach ($brands->sortBy('created_at')->take(15) as $brand)
                                    <div class="col-lg-3 col-6">
                                        <div class="brand-links">
                                            <a href="{{ route('product.category',$brand->slug) }}">{{ ucfirst($brand->name_en) }}</a>
                                        </div>
                                    </div>
                                 @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_3">A</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'A') || Str::startsWith($brand->name_en, 'a'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="{{ route('product.category',$brand->slug) }}">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_4">B</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'B') || Str::startsWith($brand->name_en, 'b'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_5">C</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'C') || Str::startsWith($brand->name_en, 'c'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_6">D</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'D') || Str::startsWith($brand->name_en, 'd'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_7">E</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'E') || Str::startsWith($brand->name_en, 'e'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_8">F</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'F') || Str::startsWith($brand->name_en, 'f'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_9">G</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'G') || Str::startsWith($brand->name_en, 'g'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_10">H</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'H') || Str::startsWith($brand->name_en, 'h'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_11">I</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'I') || Str::startsWith($brand->name_en, 'i'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_12">J</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'J') || Str::startsWith($brand->name_en, 'j'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_13">K</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'K') || Str::startsWith($brand->name_en, 'k'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_14">L</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'L') || Str::startsWith($brand->name_en, 'l'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_15">M</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'M') || Str::startsWith($brand->name_en, 'm'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_16">N</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'N') || Str::startsWith($brand->name_en, 'n'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_17">O</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'O') || Str::startsWith($brand->name_en, 'o'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_18">P</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'P') || Str::startsWith($brand->name_en, 'p'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_19">Q</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'Q') || Str::startsWith($brand->name_en, 'q'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_20">R</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'R') || Str::startsWith($brand->name_en, 'r'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_21">S</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'S') || Str::startsWith($brand->name_en, 's'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_22">T</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'T') || Str::startsWith($brand->name_en, 't'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_23">U</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'U') || Str::startsWith($brand->name_en, 'u'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_24">V</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'V') || Str::startsWith($brand->name_en, 'v'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_25">W</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'W') || Str::startsWith($brand->name_en, 'w'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_26">X</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'X') || Str::startsWith($brand->name_en, 'x'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_27">Y</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'Y') || Str::startsWith($brand->name_en, 'y'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h1 id="letter_28">Z</h1>
                            <div class="row">
                                @foreach ($brands as $brand)
                                    @if (Str::startsWith($brand->name_en, 'Z') || Str::startsWith($brand->name_en, 'z'))
                                        <div class="col-lg-3 col-6">
                                            <div class="brand-links">
                                                <a href="brand/bang--olufsen">{{ ucfirst($brand->name_en) }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/mark.js/8.6.0/jquery.mark.min.js"></script>
<script>
    $(function() {
        var $input = $("#markSearch"),
            $context = $("#context .card");
            $input.on("input", function() {
            var term = $(this).val();
            $context.show().unmark();
            if (term) {
                $context.mark(term, {
                    done: function() {
                        $context.not(":has(mark)").hide();
                    }
                });
            }
        });
    });
</script>


@endsection
