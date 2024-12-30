@extends('layouts.master')
@section('page_title')
    Orders
@endsection
@section('content')
    <!-- Main content -->
    <section class="content" id="print">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> Order Info
                                    <small class="float-right">{{$record->created_at}}</small>
                                </h4>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Restaurant
                                <address>
                                    <strong>E-commerce</strong><br>
                                    City: {{$settings->address}}<br>
                                    Phone: {{$settings->phone}}<br>
                                    Email: {{$settings->email}}
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                Client
                                <address>
                                    <strong>{{$record->client->name}}</strong><br>
{{--                                    City: {{$record->client->district->city->name}}<br>--}}
{{--                                    Region: {{$record->client->district->name}}<br>--}}
                                    Phone: {{$record->client->phone}}<br>
                                    Email: {{$record->client->email}}
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #{{$record->id}}</b><br>
                                <br>
                                <b>Order ID:</b> {{$record->id}}<br>
                                <b>Payment Method: </b> {{$record->payment_method}}<br>
                                <b>Account:</b> {{$record->client->id}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Product</th>
                                        <th>Description</th>
                                        <th>Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($record->products as $product)
                                        @php
                                            $subtotal= $product->pivot->quantity * $product->price;
                                        @endphp
                                        <tr>
                                            <td>{{$product->pivot->quantity}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->description}}</td>
                                            <td>{{$subtotal}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="lead">Payment Methods:</p>
                            </div>
                            <div class="col-6">
                                <p class="lead">{{$record->payment_method}}</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th style="width:50%">state:</th>
                                            <td> {{$record->status}}   </td>
                                        </tr>
{{--                                        <tr>--}}
{{--                                            <th>Tax ({{settings()->commission.'%'}})</th>--}}
{{--                                            <td>{{$record->commission}}</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th>Delivery:</th>--}}
{{--                                            <td>{{$record->delivery_charge}}</td>--}}
{{--                                        </tr>--}}
                                        <tr>
                                            <th>Total:</th>
                                            <td>{{$record->total_price}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row no-print">
                            <div class="col-12">
                                <button type="button" class="btn btn-success float-right">
                                    <a rel="noopener" target="_blank" onclick="printDiv()"><i
                                            class="fas fa-print"></i> Print</a>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
<script>
    function printDiv() {
        var printContents = document.getElementById('print').innerHTML;
        var orginalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = orginalContents;
        location.reload();
    }
</script>
