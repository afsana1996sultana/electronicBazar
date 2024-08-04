<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printable A4 Page</title>
    <style>
        @page {
            size: A4;
            margin: 0;
            padding: 8px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .content {
            background-color: #ffffff;
            padding: 20px;
        }

        p {
            font-size: 14px;
            margin: 0;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            vertical-align: top
        }

        .product__info table tr td {
            text-transform: capitalize;
            font-size: 14px;
        }

        .aditional__info ul li {
            list-style: decimal;
            font-size: 12px;
            line-height: 1.3;
        }

        .aditional__info ul {
            margin: 0;
            padding: 0;
            margin-left: 15px;
        }

        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            padding: 0;
        }

        .customer__info {
            display: flex;
            gap: 15px;
        }

        .signature {
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>

<body>
    <div class="content">

        @php
            $logo = get_setting('site_logo');
        @endphp

        <div style="text-align: center">
            <img src="{{ asset(get_setting('site_logo')->value ?? 'null') }}" width="150px" alt="{{ env('APP_NAME') }}">
        </div>

        <div class="owner__address" style="margin-bottom: 20px;display:flex;justify-content:space-between">
            <div>
                <h3>{{ get_setting('site_name')->value }}</h3>
                <p>{{ get_setting('business_address')->value }}</p>
                <p>Tel:{{ get_setting('phone')->value }}</p>
                <p>Email:{{ get_setting('email')->value }}</p>
                <p>Webisite: www.daratechbd.com</p>
            </div>
            <div style="align-self:flex-end;width:150px">
                <h4 style="text-align: center">Invoice/Bill</h4>
                <p style="border:1px solid #000;border-bottom:0;font-size:14px;padding:2px 4px">No:
                    {{ $order->invoice_no }}</p>
                <p style="border-top: 1px solid #000"></p>
                <p style="border: 1px solid #000;border-top:0;font-size:14px;padding:2px 4px">Date:
                    {{ date('d-m-Y', strtotime($order->created_at)) }}</p>
            </div>
        </div>

        <div class="customer__info ">
            <p><strong style="color: #000">Customer: </strong>
                @if ($order->user->role == 4)
                    Walk-in Customer
                @else
                    {{ $order->user->name ?? 'Walk-in Customer' }}
                @endif
            </p>
            <p><strong style="color: #000">Phone: </strong>{{ $order->phone ?? '' }}</p>
            <p><strong style="color: #000">Email: </strong>{{ $order->email ?? '' }}</p>
        </div>
        <div class="customer__info " style="margin-bottom: 10px">
            <p style="margin: 0"><strong style="color: #000">Address: </strong>{{ $order->address ?? '' }}.</p>
            @if($order->staff_id>0)
                <p style="margin: 0"><strong style="color: #000">Salesman: </strong>
                    {{ $order->staff->user->name ??'Admin' }}
                </p>
            @endif
        </div>

        <div class="product__info">
            <table style="width:100%">
                <tr>
                    <th style="text-align: center;width:10px;background:#023a89d1;color:white;font-size:14px">SL</th>
                    <th style="width:8px;background:#023a89d1;color:white;font-size:14px">ITEM CODE</th>
                    <th style="width:200px;background:#023a89d1;color:white;font-size:14px">ITEM</th>
                    <th
                        style="min-width: max-content;width:80px;text-align:start;background:#023a89d1;color:white;font-size:14px;text-align: center">
                        SERIAL NO.</th>
                    <th style="text-align: center;width:10px;background:#023a89d1;color:white;font-size:14px">QTY</th>
                    <th style="text-align: right;width:10px;background:#023a89d1;color:white;font-size:14px">PRICE</th>
                    <th style="text-align: right;width:10px;background:#023a89d1;color:white;font-size:14px">TOTAL</th>
                </tr>
                @foreach ($order->order_details as $key => $orderdetail)
                    <tr>
                        <td style="text-align: center">{{ $key + 1 }}</td>
                        <td>{{ $orderdetail->product->product_code }}</td>
                        <td>{{ $orderdetail->product->name_en ?? '' }}
                            @if($orderdetail->product->warranty_id >0)
                           Warranty : {{ $orderdetail->product->warranty->value  ?? '' }} {{ $orderdetail->product->warranty->label  ?? '' }} 
                           @endif
                        </td>
                        <td style="text-align: center">{{ $orderdetail->product->serial_no ?? '' }}</td>
                        <td style="text-align: center">{{ $orderdetail->qty }} </td>
                        <td style="text-align: right">{{ $orderdetail->price }}</td>
                        <td style="text-align:right">{{ $orderdetail->price * $orderdetail->qty }}</td>
                    </tr>
                @endforeach

                <tr style="text-align: right">
                    @php
                        use NumberToWords\NumberToWords;
                        $numberToWords = new NumberToWords();
                        $numberTransformer = $numberToWords->getNumberTransformer('en');
                    @endphp
                    <td rowspan="3" colspan="5" style="text-align:start;vertical-align: bottom"><strong>Amount In
                            Words: </strong>BDT {{ $numberTransformer->toWords($order->grand_total) }} taka only</td>
                    <td>Sub Total</td>
                    <td>{{ $order->sub_total }}</td>
                </tr>
                @if ($order->shipping_charge > 0)
                    <tr style="text-align: right">
                        <td>Shipping charge</td>
                        <td>{{ $order->shipping_charge }}</td>
                    </tr>
                @endif
                @if ($order->discount > 0)
                    <tr style="text-align: right">
                        <td>Discount</td>
                        <td>{{ $order->discount }}</td>
                    </tr>
                @endif
                @if ($order->coupon_discount > 0)
                    <tr style="text-align: right">
                        <td>Coupon Discount</td>
                        <td>{{ $order->coupon_discount }}</td>
                    </tr>
                @endif

                <tr style="text-align: right">
                    <td>Grand Total</td>
                    <td>{{ $order->grand_total }}</td>
                </tr>
            </table>
            <p style="text-align: end">
                @if ($order->paid_amount > 0)
                    <span style="display: inline-block;margin-left:10px"><strong>Paid:
                        </strong>{{ $order->paid_amount }} Tk</span>
                @endif
                @if ($order->due_amount > 0)
                    <span style="display: inline-block;margin-left:10px"><strong>Due: </strong>{{ $order->due_amount }}
                        Tk</span>
                @endif
            </p>
        </div>

        <p style="margin-left: 30px;margin-top:30px">Goods Received in good condition</p>

        <div class="signature" style="padding:40px 0">
            <div>
                <span style="font-size: 14px">Received by</span>
                <span style="position: relative;top:15px;border-top:1px solid #000;font-size:14px">Customer
                    Signature</span>
            </div>
            <div>
                <span style="font-size: 14px">Issued by</span>
                <span style="position: relative;top:15px;border-top:1px solid #000;font-size:14px">for DaraTech</span>
            </div>
        </div>

        <div class="payment__info">
            <h4>Payment History</h4>
            <table style="width:100%">
                <tr>
                    <th style="font-size:14px;text-align: left;width:5px;background:#023a89d1;color:white">SL</th>
                    <th style="font-size:14px;text-align: left;width:100px;background:#023a89d1;color:white">Date</th>
                    <th style="font-size:14px;text-align: left;width:20px;background:#023a89d1;color:white">Type</th>
                    <th style="font-size:14px;text-align: left;width:200px;background:#023a89d1;color:white">Details
                    </th>
                    <th
                        style="font-size:14px;text-align: left;min-width:max-content;width:60px;background:#023a89d1;color:white">
                        Cash Point</th>
                    <th style="font-size:14px;text-align: right;width:20px;background:#023a89d1;color:white">Amount</th>
                </tr>

                <tr>
                    <td style="text-align: center">1</td>
                    <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                    <td>Cash</td>
                    <td>--</td>
                    <td style="text-align: center">Uttara</td>
                    <td style="text-align: right">{{ $order->grand_total }}</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: end"><strong>Total</strong></td>
                    <td style="text-align: end">{{ $order->grand_total }}</td>
                </tr>
            </table>
        </div>
        <div class="aditional__info">
            <p style="font-size: 18px;padding:5px 0;color:#333232">VAT and TAX included if not mentioned in the item field.
            </p>
            <h4><strong>Terms & Conditions:</strong></h4>
            <ul>
                <li>Goods once sold will not be refunded & changed.</li>
                <li>The Products under warranty will be repaired or replaced by the manufactureing company.
                </li>
                <li>Timing for the Warranty process will be controlled by the manufacturing company.</li>
                <li>Manufacturer does not give warranty to Remote Control, Software, Data, Password/BIOS Password, Cartidge, Toner,
                    Head, Roller, Drum, Element Cover, Maintenance kit, Cable Supplied with Product, Gift/Free items, GPU used in data
                    mining, if Sticker-removed, Serial tempered, Compatible Toner/Ink used, Fungus and damp, Up-to 3 display dots, Liquid
                    splillage, Burnt and Physically-damaged etc.</li>
                <li>For standard Terms of Warranty in detail please visit- <strong>http://www.daratechbd.com/page/warranty</strong></li>
            </ul>
        </div>

    </div>
</body>

</html>

<script>
    window.onload = function() {
        window.print();
    };
</script>