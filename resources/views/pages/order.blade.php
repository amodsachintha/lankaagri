@extends('layouts.app')
@section('content')

    <div class="container" style="margin-bottom: 50px">
        <div class="col-md-8 offset-2">
            <div class="list-group">

                <div class="list-group-item  flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-center mb-2">
                        <h5 class="mb-1"><strong>Order ID #{{$order->id}}</strong></h5>
                    </div>
                </div>
                <div class="list-group-item  flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-center mb-2">
                        <h5 class="mb-1"><strong>Payment Details</strong></h5>
                    </div>
                    <div class="d-flex w-100 justify-content-between mb-2">
                        <p>Payment method: <strong>{{$purchase->payment_method}}</strong></p>
                        <p>Payment date: <strong>{{$purchase->created_at}}</strong></p>
                    </div>
                    <div class="d-flex w-100 justify-content-between mb-2">
                        <p class="mr-2">Shipping address:<br> <strong>{{$purchase->shipping_address}}</strong></p>
                        <p class="ml-2 text-right">Billing address:<br> <strong>{{$purchase->billing_address}}</strong></p>
                    </div>
                </div>

                <hr>

                @foreach($orderlines as $orderline)
                    <div class="list-group-item  flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between mb-2">
                            <small>orderline id: #{{$orderline->id}}</small>
                            <small>#{{$loop->iteration}}</small>
                        </div>
                        <div class="d-flex w-100 justify-content-between mb-2">
                            <h5 class="mb-1"><strong>{{$orderline->item->name}}</strong></h5>
                        </div>
                        <div class="d-flex w-100 justify-content-between mb-2">
                            <h6>{{$orderline->quantity}} units</h6>
                            <h4>Rs. {{number_format($orderline->total,2)}}</h4>
                        </div>
                        <div>
                            @if($orderline->delivered == true)
                                <span class="badge badge-success">Delivered</span>
                            @else
                                <span class="badge badge-warning">Processing</span>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="d-flex w-100 justify-content-center mb-2 mt-3">
                @if(isset($_SERVER['HTTP_REFERER']))
                    <a href="{{$_SERVER['HTTP_REFERER']}}" class="btn btn-outline-secondary">Back</a>
                @endif
            </div>
        </div>
    </div>

@endsection