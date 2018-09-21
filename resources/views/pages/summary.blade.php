@extends('layouts.app')
@section('content')

    <div class="container" style="margin-bottom: 50px">
        @if(isset($_GET['purchases']))
            <div class="row">
                <div class="col-md-10 offset-1 p-2">
                    <table class="table table-hover shadow text-center table-sm table-light">
                        <thead>
                        <tr>
                            <th colspan="5">ALL PURCHASES</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Payment method</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td><span class="badge badge-success">{{$loop->iteration}}</span></td>
                                <td><a href="/order/show/{{$order->id}}" class="btn btn-outline-primary">{{$order->id}}</a></td>
                                <td>{{date('d M Y h:m A',strtotime($order->created_at))}}</td>
                                <td>{{$order->purchase->payment_method}}</td>
                                <td>Rs. {{number_format($order->total,2)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm" align="center">
                    <a href="/profile?tab=summary" class="btn btn-outline-secondary">Go back</a>
                </div>
            </div>
        @endif

        @if(isset($_GET['sales']))
            <div class="row">
                <div class="col-md-10 offset-1 p-2">
                    <table class="table table-hover shadow text-center table-sm table-light">
                        <thead>
                        <tr>
                            <th colspan="5">ALL SALES (PER ITEM) AGGREGATED</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Item name</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderlines as $orderline)
                            <tr>
                                <td><span class="badge badge-success">{{$loop->iteration}}</span></td>
                                <td>{{$orderline['item_name']}}</td>
                                <td>{{$orderline['quantity']}}</td>
                                <td>Rs. {{number_format($orderline['total'],2)}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-right h5">Total:</td>
                            <td class="h4">Rs. {{number_format($orderlinesTotal,2)}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
                <div class="row">
                    <div class="col-sm" align="center">
                        <a href="/profile?tab=summary" class="btn btn-outline-secondary">Go back</a>
                    </div>
                </div>
        @endif


    </div>

@endsection