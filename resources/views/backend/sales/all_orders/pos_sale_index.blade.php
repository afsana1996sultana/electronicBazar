@extends('admin.admin_master')
@section('admin')
@push('css')
    <style type="text/css">
        table,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td {
            border: 1px solid #dee2e6 !important;
        }

        th {
            font-weight: bolder !important;
        }
        
        @media print {
            #example_wrapper .dataTables_length,
            #example_wrapper .dataTables_filter,
            #example_wrapper .dataTables_info,
            #example_wrapper .dataTables_paginate {
                display: none !important;
            }
            .text-end{
                display: none !important;
            }
        }
        .btn.btn-primary {
            padding: 10px 35px;
        }
    </style>
@endpush
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">POS Order List</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form class="" action="" method="GET">
                            <div class="form-group row mb-3">
                                <div class="col-md-2">
                                    <label class="col-form-label"><span>All Orders :</span></label>
                                </div>
                                <div class="col-md-2 mt-2">
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="custom_select">
                                        <select class="form-select d-inline-block select-active select-nice mb-lg-0 mr-5 mw-200" name="delivery_status" id="delivery_status">
                                            <option value="" selected="">Delivery Status</option>
                                            <option value="pending" @if ($delivery_status == 'pending') selected @endif>Pending</option>
                                            <option value="confirmed" @if ($delivery_status == 'confirmed') selected @endif>Confirmed</option>
                                            <option value="processing" @if ($delivery_status == 'processing') selected @endif>Processing</option>
                                            <option value="picked_up" @if ($delivery_status == 'picked_up') selected @endif>Picked Up</option>
                                            <option value="shipped" @if ($delivery_status =='shipped') selected @endif>Shipped</option>
                                            <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>Delivered</option>
                                            <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>Cancel</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="custom_select">
                                       <select class=" select-active select-nice form-select d-inline-block mb-lg-0 mr-5 mw-200" name="payment_status" id="payment_status">
                                            <option value="" selected="">Payment Status</option>
                                            <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>Unpaid</option>
                                            <option value="paid" @if ($payment_status == 'paid') selected @endif>Paid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="custom_select">
                                        <input type="text"   id="reportrange" class="form-control"  name="date" placeholder="Filter by date" data-format="DD-MM-Y" value="Filter by date" data-separator=" - " autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-1 mt-2">
                                    <button class="btn btn-primary" type="submit">Filter</button>
                                </div>
                                <div class="col-md-1 mt-2">
                                    <button class="btn btn-primary" onclick="invoiceFunction('order_print')">Print</button>
                                </div>
                            </div>
                            <div class="table-responsive-sm" id="order_print">
                                <table id="example" class="table table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer name</th>
                                            <th>Customer Phone</th>
                                            <th>Amount</th>
                                            <th>Profit</th>
                                            <th>Paid</th>
                                            <th>Due</th>
                                            <th>Sell By</th>
                                            <th class="text-end">Options</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $amount = 0;
                                        $sum1 = 0;
                                    @endphp
                                    <tbody>
                                        @foreach ($orders as $key => $order)
                                            <tr>
                                                <td>PO-{{ $order->invoice_no }}</td>
                                                <td><b>{{ $order->user->name }}</b></td>
                                                <td><b>{{ $order->user->phone }}</b></td>
                                                <td>{{ $order->grand_total }}</td>
                                                <td>{{ $order->grand_total - ($order->shipping_charge + $order->pur_sub_total) }}</td>
                                                <td>
                                                     @if ($order->payment_status == 'unpaid')
                                                    {{ $order->paid_amount ?? ''  }}
                                                     @else
                                                     {{ $order->grand_total ?? ''  }}
                                                     @endif
                                                </td>
                                                <td>
                                                     @if ($order->payment_status == 'unpaid')
                                                       {{ $order->due_amount ?? '' }}
                                                     @else
                                                       0.00
                                                     @endif
                                                    
                                                </td>
                                                <td>{{ $order->staff->user->name ?? 'Admin' }}</td>
                                                {{-- <td>
                                                    @php
                                                        $status = $order->delivery_status;
                                                        if ($order->delivery_status == 'cancelled') {
                                                            $status = '<span class="badge rounded-pill alert-success">Cancelled</span>';
                                                        }
                                                    @endphp
                                                    {!! $status !!}
                                                </td> --}}
                                                {{-- <td>
                                                    @php
                                                        $status = $order->payment_status;
                                                        if ($order->payment_status == 'unpaid') {
                                                            $status = '<span class="badge rounded-pill alert-danger">Unpaid</span>';
                                                        } elseif ($order->payment_status == 'paid') {
                                                            $status = '<span class="badge rounded-pill alert-success">Paid</span>';
                                                        }
                                                    @endphp
                                                    {!! $status !!}
                                                </td> --}}
                                                <td class="text-end">
                                                    <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs"
                                                        href="{{ route('all_orders.show', $order->id) }}">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" target="blank"
                                                        href="{{ route('print.invoice.download', $order->id) }}">
                                                        <i class="icon material-icons md-print"></i>
                                                    </a>
                                                    <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" href="{{ route('delete.orders',$order->id) }}" id="delete"><i class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @php
                                                $amount += $order->grand_total;
                                                $sum1 += $order->grand_total - ($order->shipping_charge + $order->pur_sub_total);
                                            @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-center"></td>
                                            <td>Sum : {{ $amount }}</td>
                                            <td>Sum : {{ $sum1 }}</td>
                                            <td colspan="4"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                        <!-- table-responsive //end -->
                    </div>
                    <!-- card-body end// -->
                </div>
                <!-- card end// -->
            </div>
        </div>
    </section>
@push('footer-script')
<script type="text/javascript">
    $(function() {
        var start = moment();
        var end = moment();

        $('input[name="date"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        function cb(start, end) {
            $('#reportrange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);
    });
</script>

<script>
    function invoiceFunction(el) {
        let restorepage = document.body.innerHTML;
        let printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
        location.reload()
    }
</script>
@endpush
@endsection