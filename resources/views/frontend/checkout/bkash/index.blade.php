@extends('layouts.frontend')
@section('title')
    Checkout Nest Online Shop
@endsection
@push('css')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> 
<script src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
@endpush
@section('content-frontend')

  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="card mt-4">
        <div class="card-body">
          <h1 class="text-center font-weight-bold" style="font-size: 20px">Order Invoice # <span class="text-danger">{{ session()->get('invoice_no') }}</span></h1>
          <h1 class="text-center mt-3">Amount to be paid: <span class="text-danger">BDT {{ session()->get('payment_amount') }}</span></h1>
          <h1 class="text-center mt-1">Payment Method: <span class="text-danger">bKash Online</span></h1>
          <h1 class="text-center mt-3"><a class="btn btn-primary" href="{{ URL::previous() }}">Back</a></h1>
        </div>
      </div>
    </div>
  </div>
  

  <button id="bKash_button" class="d-none" style="display: none">Pay With bKash</button>

@endsection

@push('footer-script')
<script type="text/javascript">

  $(document).ready(function(){
      $('#bKash_button').trigger('click');
  });

  var paymentID = '';
  bKash.init({
  paymentMode: 'checkout', //fixed value ‘checkout’
  //paymentRequest format: {amount: AMOUNT, intent: INTENT}
  //intent options
  //1) ‘sale’ – immediate transaction (2 API calls)
  //2) ‘authorization’ – deferred transaction (3 API calls)
  paymentRequest: {
      amount: '{{ Session::get('payment_amount') }}', //max two decimal points allowed
      intent: 'sale'
  },
  createRequest: function(request) { //request object is basically the paymentRequest object, automatically pushed by the script in createRequest method
  $.ajaxSetup({
    headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url: '{{ route('bkash.checkout') }}',
    type: 'POST',
    contentType: 'application/json',
    success: function(data) {
      //console.log(data);
      data = JSON.parse(data);
      if (data && data.paymentID != null) {
          paymentID = data.paymentID;
          bKash.create().onSuccess(data); //pass the whole response data in bKash.create().onSucess() method as a parameter
      } else {
          window.location.href = "{{ route('bkash.error') }}?error_message="+data;
          bKash.create().onError();
      }
    },
    error: function() {
      bKash.create().onError();
    }
  });
  },
  executeRequestOnAuthorization: function() {
  $.ajax({
    url: '{{ route('bkash.excecute') }}',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({
      "paymentID": paymentID
    }),
    success: function(data) {
      //console.log(data);
      result = JSON.parse(data);
      if (result && result.paymentID != null) {
          window.location.href = "{{ route('bkash.success') }}?payment_details="+data; //Merchant’s success page
      } else {
          window.location.href = "{{ route('bkash.error') }}?error_message="+data;
          bKash.execute().onError();
      }
    },
    error: function() {
      window.location.href = "{{ route('bkash.error') }}";
      //bKash.execute().onError();
    }
  });
  }
  });
</script>
@endpush
