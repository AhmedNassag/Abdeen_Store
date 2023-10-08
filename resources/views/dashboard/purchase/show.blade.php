@extends('layouts.master')



@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
    @section('title')
        {{ trans('main.Invoice') }}
    @stop
@endsection



@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('main.Dashboard') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main.Invoice') }} {{ trans('main.Purchases') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection



@section('content')
            <!-- row -->
            <div class="row row-xs wd-xl-60p">
                <div class="col-sm-6 col-md-12">
                    <a class="btn btn-primary btn-ripple mb-3 notPrint" href="{{ route('purchases.index') }}">
                        <i class="typcn typcn-arrow-right-outline"></i>&nbsp;{{ trans('main.Back') }}
                    </a>
                </div>
            </div>
            <div class="row row-sm">
                <div class="col-xl-12">
                    <div class=" main-content-body-invoice" id="print">
                        <div class="card card-invoice">
                            <div class="card-body">
                                <div class="invoice-header">
                                    <h1 class="invoice-title">{{ trans('main.Invoice') }} {{ trans('main.Purchases') }}</h1>
                                    <div class="billed-from">
                                        <h6>{{ $purchase->warehouse->name }}</h6>
                                        <p>
                                            {{ $purchase->warehouse->city }}, {{ $purchase->warehouse->country }}<br>
                                            {{ $purchase->warehouse->mobile }}<br>
                                        </p>
                                    </div><!-- billed-from -->
                                </div><!-- invoice-header -->
                                <div class="row mg-t-20">
                                    <div class="col-md">
                                        <label class="tx-gray-600">Billed From</label>
                                        <div class="billed-to">
                                            <h6>{{ $purchase->provider->name }}</h6>
                                            <p>
                                                {{ $purchase->provider->adresse }}, {{ $purchase->provider->city }}, {{ $purchase->provider->country }}<br>
                                                {{ $purchase->provider->phone }}<br>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <label class="tx-gray-600">{{ trans('main.Informations') }} {{ trans('main.The') }}{{ trans('main.Invoice') }}</label>
                                        <p class="invoice-info-row">
                                            <span>{{ trans('main.Number')}} {{ trans('main.The') }}{{ trans('main.Invoice') }}</span>
                                            <span>{{ $purchase->Ref }}</span>
                                        </p>
                                        <p class="invoice-info-row">
                                            <span>{{ trans('main.date') }} {{ trans('main.The') }}{{ trans('main.Invoice') }}</span>
                                            <span>{{ $purchase->date }}</span>
                                        </p>
                                        @if($purchase->payment_status != 'paid')
                                            <p class="invoice-info-row">
                                                <span>{{ trans('main.Due') }}</span>
                                                <span>{{ $purchase->GrandTotal - $purchase->paid_amount }} {{$currency->symol}}</span>
                                            </p>
                                        @endif
                                        <p class="invoice-info-row">
                                            <span>{{ trans('main.Payment Status') }}</span>
                                            @if($purchase->payment_status == 'paid')
                                                <span class="badge badge-success p-2">{{ trans('main.Paid') }}</span>
                                            @elseif ($purchase->payment_status == 'unpaid')
                                                <span class="badge badge-danger p-2">{{ trans('main.Unpaid') }}</span>
                                            @else
                                                <span class="badge badge-warning p-2">{{ trans('main.Partial') }}</span>
                                            @endif
                                        </p>
                                        <p class="invoice-info-row">
                                            <span>{{ trans('main.Added By') }}</span>
                                            <span>{{ $purchase->user->name }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="table-responsive mg-t-40">
                                    <table class="table table-invoice border text-md-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th class="tx-center">#</th>
                                                <th class="tx-center">{{ trans('main.Product') }}</th>
                                                <th class="tx-center">{{ trans('main.Machine Number') }}</th>
                                                <th class="tx-center">{{ trans('main.Motor Number') }}</th>
                                                <th class="tx-center">{{ trans('main.Cost') }}</th>
                                                <th class="tx-center">{{ trans('main.Quantity') }}</th>
                                                <th class="tx-center">{{ trans('main.Total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($purchase->purchase_details as $details)
                                                <tr>
                                                    <td>1</td>
                                                    <td class="tx-center">{{ $details->product->name }}</td>
                                                    <td class="tx-center">{{ $details->product->machine_number }}</td>
                                                    <td class="tx-center">{{ $details->product->motor_number }}</td>
                                                    <td class="tx-center">{{ $details->product->cost }}</td>
                                                    <td class="tx-center">{{ $details->quantity }} ({{ $details->product->unitPurchase->name }})</td>
                                                    <td class="tx-center">{{ $details->total }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="valign-middle" colspan="4" rowspan="6">
                                                    <div class="invoice-notes">
                                                        @if($purchase->notes)
                                                            <label class="main-content-label tx-13">{{ trans('main.Notes') }}</label>
                                                            <br>
                                                            <span>{{ $purchase->notes }}</span>
                                                        @endif
                                                    </div><!-- invoice-notes -->
                                                </td>
                                                <td class="tx-right">{{ trans('main.Tax') }} ({{ $purchase->tax_rate }} %)</td>
                                                <td class="tx-right" colspan="2">{{ $purchase->TaxNet }}</td>
                                            </tr>
                                            <tr>
                                                <td class="tx-right">{{ trans('main.Discount') }}</td>
                                                <td class="tx-right" colspan="2">{{ $purchase->discount }}</td>
                                            </tr>
                                            <tr>
                                                <td class="tx-right">{{ trans('main.Shipping') }}</td>
                                                <td class="tx-right" colspan="2">{{ $purchase->shipping }}</td>
                                            </tr>
                                            <tr>
                                                <td class="tx-right tx-uppercase tx-bold tx-inverse">{{ trans('main.Grand Total') }}</td>
                                                <td class="tx-right" colspan="2">
                                                    <h4 class="tx-primary tx-bold">{{ $purchase->GrandTotal }} ({{$currency->symbol}})</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr class="mg-b-40">
                                <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i class="mdi mdi-printer ml-1"></i>{{ trans('main.Print') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->

        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection



@section('js')
    <script type="text/javascript">
        function printDiv() {
            var printContents       = document.getElementById('print').innerHTML;
            var originalContents    = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection