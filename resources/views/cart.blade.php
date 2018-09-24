@extends('layouts.app')
@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{\App\Http\Controllers\CartController::getCartCount()}}</strong> {{__('cart.alert')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="list-group">
                    @if(isset($cartItems))
                        @foreach($cartItems as $item)
                            <div class="list-group-item  flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between mb-2">
                                    <h5 class="mb-1"><a href="/item/{{$item->item->id}}">{{$item->item->name}}</a></h5>
                                    <h6>Rs. {{number_format(($item->item->unit_price-($item->item->unit_price * $item->item->discount /100.0))  * $item->quantity,2)}} </h6>
                                    <small>{{__('cart.addedon')}} {{date('d M Y h:m A',strtotime($item->created_at))}}</small>
                                </div>
                                <h6>Rs.{{number_format($item->item->unit_price,2)}} @<code>{{$item->item->discount == null ? '0': $item->item->discount }}% {{__('cart.discount')}}</code></h6>
                                <p>{{__('cart.discountedprice')}} <strong> Rs.{{number_format(($item->item->unit_price-($item->item->unit_price * $item->item->discount /100.0)),2)}}</strong> {{__('cart.each')}} </p>
                                <p class="mb-1">
                                    <input id="{{$item->id}}" type="number" min="1" max="{{$item->item->quantity}}" style="border-radius: 5px" value="{{$item->quantity}}"> {{__('cart.items')}}
                                    <button class="btn btn-sm btn-outline-primary" onclick="updateCount('{{$item->id}}')">{{__('cart.update')}}</button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="if(confirm('{{__('admindash.areyousure')}}'))removeFromCart('{{$item->id}}')">{{__('cart.remove')}}</button>
                                </p>
                                <small>{{$item->item->quantity}} {{__('cart.instockcurrently')}}</small>
                            </div>
                        @endforeach
                        <div class="list-group-item  flex-column align-items-start bg-white">
                            <div class="d-flex w-100 justify-content-between mb-2">
                                <h5 class="mb-1">{{__('cart.cartsummary')}}</h5>
                                <small></small>
                            </div>
                            <div class="d-flex w-100 justify-content-between mb-2">
                                <p>{{__('cart.savings')}} Rs. {{number_format($savings,2)}} </p>
                                <h4>{{__('cart.subtotal')}}<strong>Rs. {{number_format($totalWithDiscount,2)}}</strong></h4>
                            </div>
                            <div class="d-flex w-100 justify-content-between mb-2">
                                <a href="/" class="btn btn-secondary">{{__('cart.home')}}</a>
                                @if($totalWithDiscount != 0)
                                    <a href="/checkout" class="btn btn-success">{{__('cart.checkout')}}</a>
                                @endif
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateCount(itemId) {
            var count = document.getElementById(itemId).value;
            var ajax = new XMLHttpRequest();
            ajax.open('GET', '/cart/update/quantity?itemId=' + itemId + '&quantity=' + count, true);
            ajax.onload = function () {
                var list = JSON.parse(ajax.responseText);
                if (list['msg'] === 'ok') {
                    window.location.reload(true);
                }
                else {
                    alert('{{__('cart.updateQfail')}}')
                }
            };
            ajax.send();
        }

        function removeFromCart(itemId) {
            var ajax = new XMLHttpRequest();
            ajax.open('GET', '/cart/delete?cartItemId=' + itemId, true);
            ajax.onload = function () {
                var list = JSON.parse(ajax.responseText);
                if (list['msg'] === 'ok') {
                    window.location.reload(true);
                }
                else {
                    alert('{{__('cart.removeFromCartFail')}}')
                }
            };
            ajax.send();

        }
    </script>




@endsection