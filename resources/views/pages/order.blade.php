@extends('layouts.app')
@section('content')

    <div class="container" style="margin-bottom: 50px">

        @if(isset($_SERVER['HTTP_REFERER']))
            @if(str_contains($_SERVER['HTTP_REFERER'],['checkout']))
                <div class="col-md-8 offset-2">
                    <div class="alert alert-success">
                        {{__('order.ordersuccess')}}
                    </div>
                </div>
            @endif
        @endif

        <div class="col-md-8 offset-2">
            <div class="list-group">
                <div class="list-group-item  flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-center mb-2">
                        <h5 class="mb-1"><strong>{{__('order.orderid')}} #{{$order->id}}</strong></h5>
                    </div>
                </div>
                <div class="list-group-item  flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-center mb-2">
                        <h5 class="mb-1"><strong>{{__('order.paydetails')}}</strong></h5>
                    </div>
                    <div class="d-flex w-100 justify-content-between mb-2">
                        <p>{{__('checkout.paymethod')}} <strong>{{$purchase->payment_method}}</strong></p>
                        <p>{{__('order.paydate')}} <strong>{{$purchase->created_at}}</strong></p>
                    </div>
                    <div class="d-flex w-100 justify-content-between mb-2">
                        <p class="mr-2">{{__('checkout.shipaddr')}}<br> <strong>{{$purchase->shipping_address}}</strong></p>
                        <p class="ml-2 text-right">{{__('checkout.billaddr')}}<br> <strong>{{$purchase->billing_address}}</strong></p>
                    </div>
                </div>

                <hr>

                @foreach($orderlines as $orderline)
                    <div class="list-group-item  flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between mb-2">
                            <small>{{__('profile.orderlineid')}} #{{$orderline->id}}</small>
                            <small>#{{$loop->iteration}}</small>
                        </div>
                        <div>
                            <h5 class="mb-1"><strong>{{$orderline->item->name}}</strong></h5>
                            <h6 class="mb-1">{{__('item.soldby')}} {{$orderline->item->user->name}}</h6>
                        </div>
                        <div class="d-flex w-100 justify-content-between mb-2">
                            <h6>{{$orderline->quantity}} {{__('profile.units')}}</h6>
                            <h4>Rs. {{number_format($orderline->total,2)}}</h4>
                        </div>
                        <div>
                            @if($orderline->delivered == true)
                                <span class="badge badge-success">{{__('order.delivered')}}</span>
                            @else
                                <span class="badge badge-warning">{{__('order.processing')}}</span>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="d-flex w-100 justify-content-center mb-2 mt-3">

                @if(isset($_SERVER['HTTP_REFERER']))
                    @if(!str_contains($_SERVER['HTTP_REFERER'],['checkout']))
                        <a href="{{$_SERVER['HTTP_REFERER']}}" class="btn btn-outline-secondary">{{__('checkout.back')}}</a>
                    @else
                        <a href="/profile?tab=summary" class="btn btn-outline-secondary">{{__('checkout.back')}}</a>
                    @endif
                @endif
            </div>
        </div>
    </div>

@endsection