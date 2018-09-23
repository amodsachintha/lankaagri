@extends('layouts.app')
@section('content')
    <div class="container" style="margin-bottom: 50px">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="list-group">
                    @if(isset($cartItems))
                        @foreach($cartItems as $item)
                            <div class="list-group-item  flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between mb-2">
                                    <h5 class="mb-1">{{$item->item->name}}</h5>
                                    <h6>Rs. {{number_format(($item->item->unit_price-($item->item->unit_price * $item->item->discount /100.0))  * $item->quantity,2)}} </h6>
                                </div>
                                <h6>Rs.{{number_format($item->item->unit_price,2)}} @<code>{{$item->item->discount == null ? '0': $item->item->discount }}% discount</code></h6>
                                <p>Discounted price: <strong> Rs.{{number_format(($item->item->unit_price-($item->item->unit_price * $item->item->discount /100.0)),2)}}</strong> each </p>
                                <p class="mb-1">
                                </p>
                            </div>
                        @endforeach
                        <hr>

                        <div class="list-group-item  flex-column align-items-start bg-white">
                            <div class="d-flex w-100 justify-content-between mb-2">
                                <h5 class="mb-1">Cart Summary</h5>
                                <small></small>
                            </div>
                            <div class="d-flex w-100 justify-content-between mb-2">
                                <p>Savings: Rs. {{number_format($savings,2)}} </p>
                                <h4>Subtotal :<strong>Rs. {{number_format($totalWithDiscount,2)}}</strong></h4>
                            </div>
                        </div>

                        <hr>

                        <form action="/checkout" method="POST">
                            <div class="list-group-item  flex-column align-items-start bg-white">
                                <div class="d-flex w-100 justify-content-between mb-2">
                                    <h5 class="mb-1">Shipping & Billing</h5>
                                    <small></small>
                                </div>
                                <div>
                                    {{csrf_field()}}

                                    <div class="form-group">
                                        <label>Payment Method</label>
                                        <select class="form-control" name="payment_method" required>
                                            <option>PayHere</option>
                                            <option>On Delivery</option>
                                            <option>PayPal</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Shipping Address</label>
                                        <input name="shipping_address" class="form-control" value="{{$user->st_address}}, {{$user->city}}, {{$user->district}}, {{$user->province}} Province" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Billing Address</label>
                                        <input name="billing_address" class="form-control" value="{{$user->st_address}}, {{$user->city}}, {{$user->district}}, {{$user->province}} Province" required>
                                    </div>


                                </div>
                                <div class="d-flex w-100 justify-content-between mb-2">

                                </div>

                            </div>
                            <div class="list-group-item  flex-column align-items-start bg-white">
                                <div class="d-flex w-100 justify-content-between mb-2">
                                </div>
                                <div class="d-flex w-100 justify-content-between mb-2">
                                    @if(isset($_SERVER['HTTP_REFERER']))
                                        <a href="{{$_SERVER['HTTP_REFERER']}}" class="btn btn-secondary">Back</a>
                                    @endif
                                    <button type="submit" class="btn btn-success">Pay</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection