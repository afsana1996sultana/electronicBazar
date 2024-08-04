@extends('layouts.frontend')
@push('css')
@endpush

@section('content-frontend')
<div class="card p-5">
    <h3>{{ $emiContent->headertitle }}</h3>
    <div class="row pt-2">
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-header" style="background-color: #f37422;">
                    <h5 style="color:white">{{ $emiContent->title1 }}</h5>
                </div>
                <div class="card-body">
                    <p>{!! $emiContent->description1 !!}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-header" style="background-color: #f37422;">
                    <h5 style="color:white">{{ $emiContent->title2 }}</h5>
                </div>
                <div class="card-body">
                    <p>{!! $emiContent->description2 !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('footer-script')
@endpush