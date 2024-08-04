<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @php
        $logo = get_setting('site_favicon');
    @endphp
    @if ($logo != null)
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset(get_setting('site_favicon')->value ?? ' ') }}" />
    @else
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('upload/no_image.jpg') }}"
            alt="{{ env('APP_NAME') }}" />
    @endif
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap');
    </style>
    <style>
        * {
            margin: 0;
            padding: 0;
            outline: none;
            box-sizing: border-box;
            font-size: 14px;
            font-family: 'Roboto Slab', serif;
        }

        .page {
            background-color: white;
            display: block;
            margin: 0 auto;
            position: relative;
            /*box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;*/
        }

        .page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            position: relative;
        }

        ul {
            padding: 0;
            margin: 0;
        }

        li {
            list-style: none;
        }

        .customer__info ul li {
            float: left;
            margin-bottom: 5px;
            width: 50%;
        }

        .customer__info ul li h4 {
            font-size: 18px;
            font-weight: 500;
        }

        .customer__info ul li h4 span {
            font-weight: normal;
            font-size: 18px;
        }

        .customer__info {
            padding: 25px 45px;
            padding-top:10px;
        }

        .invoice__body {
            padding-top: 0px;
        }

      .img_center {
    padding: 10px;
    text-align: center;
    padding-bottom: 0;
}

        .img_center img {
            max-width: 150px !important;
        }

      .invoice__body h1 {
    background: #0F75BC;
    text-align: center;
    color: #fff;
    text-transform: uppercase;
    font-weight: 700;
    padding: 5px 0;
    font-size: 25px;
}

        .table__space {
            padding: 25px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            text-align: center;
            border-collapse: collapse;
            padding: 5px;
        }

        .signature {
            padding-right: 40px;
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            text-align: center;
        }

        .signature h6 {
            font-weight: 700;
            font-size: 11px;
        }

        .signature a {
            font-weight: 700;
            font-size: 11px;
        }

        .header_address {
            text-align: center;
            margin-bottom: 10px;
        }

        .web_link {
            text-align: center;
            margin-bottom: 10px;
        }

        .web_link p {
            font-size: 15px;
            font-weight: 600;
        }

        @media print {
            .graph-img img {
                display: inline;
            }

            * {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="my-page page" size="A4"
        style="background-position: center;background-size: cover;background-repeat: no-repeat;">
        <div class="invoice__body">
            @php
                $logo = get_setting('site_footer_logo');
            @endphp
            <div class="img_center">
                @if ($logo != null)
                    <img src="{{ asset(get_setting('site_footer_logo')->value ?? 'null') }}"
                        alt="{{ env('APP_NAME') }}">
                @else
                    <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}">
                @endif
            </div>
            <div class="header_address">
                <p>Address:{{ get_setting('business_address')->value ?? 'null' }}</p>
                <p>Call Us:{{ get_setting('phone')->value ?? 'null' }}
                    Email:{{ get_setting('email')->value ?? 'null' }}</p>
                <p>Open:{{ get_setting('business_hours')->value ?? 'null' }}</p>
            </div>
            <div class="web_link">
                <p>Website:<a href="{{ route('home') }}">daratechbd.com</a></p>
            </div>
            <h1>Pc Build Items</h1>

            <div class="customer__info">
                <ul>
                    <li>
                        @if ($latestDateTime)
                            <h6>Date: <span>{{ $latestDateTime->created_at->format('Y-m-d') }}</span></h6>
                            <h6>Time: <span>{{ $latestDateTime->created_at->format('H:i:s') }}</span></h6>
                        @else
                            <h6>No records found</h6>
                        @endif
                    </li>
                </ul>
            </div>

            <div class="table__space">
                <table style="width:100%;padding-bottom:0px">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Category</th>
                        <th scope="col">Product</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Amount</th>
                    </tr>
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach ($pc_Cart as $key => $cart)
                        @php
                            if ($cart->product->discount_type == 1) {
                                $price_after_discount = $cart->product->regular_price - $cart->product->discount_price;
                            } elseif ($cart->product->discount_type == 2) {
                                $price_after_discount = $cart->product->regular_price - ($cart->product->regular_price * $cart->product->discount_price) / 100;
                            }
                            if ($cart->product->discount_price > 0) {
                                $subtotal = $price_after_discount * $cart->qty;
                            } else {
                                $subtotal = $cart->product->regular_price * $cart->qty;
                            }
                            $totalPrice += $subtotal;
                        @endphp
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $cart->product->pcBuild->name }}</td>
                            <td>
                                <img src="{{ $cart->product->product_thumbnail }}" alt="" width="30px">
                                {{ $cart->product->name_en }}
                            </td>
                            <td>{{ $cart->qty }}</td>
                            <td>{{ $price_after_discount }} TK</td>
                            <td>{{ $subtotal }} TK</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="table__space" style="float: right; padding:0">
                <table style="width:300px;margin-right:30px">
                    <tr>
                        <th style="width: 50%;text-align: left;">Total Price</th>
                        <th style="width: 50%;text-align: right;">{{ $totalPrice }} TK</th>
                    </tr>
                </table>
            </div>
            <div class="signature">
                <h6> Developed by : <a target="_blank" href="https://classicit.com.bd/">Classic IT & Sky Mart Ltd</a>
                </h6>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    window.onload = function() {
        window.print();
    };
</script>