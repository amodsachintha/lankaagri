@extends('layouts.app')
@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="alert alert-success">
                    {{\App\Http\Controllers\CartController::getCartCount()}} item(s) in your cart!
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
                                    <small>added on {{date('d M Y h:m A',strtotime($item->created_at))}}</small>
                                </div>
                                <h6>Rs.{{number_format($item->item->unit_price,2)}} @<code>{{$item->item->discount == null ? '0': $item->item->discount }}% discount</code></h6>
                                <p>Discounted price: <strong> Rs.{{number_format(($item->item->unit_price-($item->item->unit_price * $item->item->discount /100.0)),2)}}</strong> each </p>
                                <p class="mb-1">
                                    <input id="{{$item->id}}" type="number" min="1" max="{{$item->item->quantity}}" style="border-radius: 5px" value="{{$item->quantity}}"> items
                                    <button class="btn btn-sm btn-outline-primary" onclick="updateCount('{{$item->id}}')">Update</button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="if(confirm('Are you sure?'))removeFromCart('{{$item->id}}')">Remove</button>
                                </p>
                                <small>{{$item->item->quantity}} in stock currently.</small>
                            </div>
                        @endforeach
                        <div class="list-group-item  flex-column align-items-start bg-white">
                            <div class="d-flex w-100 justify-content-between mb-2">
                                <h5 class="mb-1">Cart Summary</h5>
                                <small></small>
                            </div>
                            <div class="d-flex w-100 justify-content-between mb-2">
                                <p>Savings: Rs. {{number_format($savings,2)}} </p>
                                <h4>Subtotal :<strong>Rs. {{number_format($totalWithDiscount,2)}}</strong></h4>
                            </div>
                            <div class="d-flex w-100 justify-content-between mb-2">
                                <a href="/" class="btn btn-secondary">Home</a>
                                @if($totalWithDiscount != 0)
                                    <a href="/checkout" class="btn btn-success">Checkout</a>
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
                    alert('Failed to update quantity!')
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
                    alert('Failed to remove item from cart!')
                }
            };
            ajax.send();

        }
    </script>




@endsection