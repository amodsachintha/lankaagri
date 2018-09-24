@extends('layouts.app')
@section('content')

    @if(isset($item))
        <div class="container mb-4">
            <div class="col-md-8 offset-2">
                @if($item->deleted)
                    <div class="card bg-dark text-white">
                        @else
                            <div class="card">
                                @endif
                                <img class="card-img-top" src="{{asset($item->image)}}" alt="Card image cap">
                                <div class="card-body">
                                    <h2 class="card-title">{{$item->name}}</h2>
                                    <p><kbd>{{$item->category->name}}</kbd>
                                        @if(!$item->active)
                                            <span class="badge badge-danger">{{__('item.pending')}}</span>
                                        @else
                                            <span class="badge badge-success">{{__('item.active')}}</span>
                                        @endif
                                    </p>
                                    <small>{{__('cart.addedon')}} {{date('M d Y',strtotime($item->created_at))}}</small>
                                    <h6 class="mt-2">{{__('item.soldby')}} {{$item->user->name}}</h6>
                                    <h6>{{$item->user->city.", ".$item->user->district.", ".$item->user->province." Province"}}</h6>
                                    <div class="justify-content-between">
                                        @if($item->quantity > 0)
                                            <h5>{{$item->quantity}} {{__('cart.instockcurrently')}}</h5>
                                            <span class="badge badge-success"><h6>{{__('item.instock')}}</h6></span>
                                        @else
                                            <span class="badge badge-danger"><h6>{{__('item.outofstock')}}</h6></span>
                                        @endif
                                        <h5 class="mt-2">Rs. {{number_format($item->unit_price,2)}}</h5>
                                        <h6><code>{{$item->discount}}% {{__('cart.discount')}}</code></h6>
                                    </div>
                                    <p class="card-text">{{$item->description == null ? "Some quick text to build on the title and make up the bulk of the content." : $item->description}}</p>
                                    <div class="justify-content-center" align="center">
                                        @if(isset($_SERVER['HTTP_REFERER']))
                                            <a href="{{$_SERVER['HTTP_REFERER']}}" class="btn btn-secondary mr-3">{{__('checkout.back')}}</a>
                                        @else
                                            <a href="/profile?tab=my_items" class="btn btn-secondary mr-3">{{__('checkout.back')}}</a>
                                        @endif

                                        @if(\Illuminate\Support\Facades\Auth::user()->id != $item->user_id)
                                            <button onclick="addToCart('{{$item->id}}')" class="btn btn-primary ml-3">{{__('category.addtocart')}}</button>
                                        @endif
                                        @if(\Illuminate\Support\Facades\Auth::user()->id == $item->user_id)
                                            @if(!$item->deleted)
                                                <a href="/items/update?id={{$item->id}}" class="btn btn-primary ml-3">{{__('item.edititem')}}</a>
                                                @if($item->active)
                                                    <button onclick="disableItem('{{$item->id}}')" class="btn btn-dark ml-3">{{__('item.disable')}}</button>
                                                @else
                                                    <button onclick="enableItem('{{$item->id}}')" class="btn btn-success ml-3">{{__('item.enable')}}</button>
                                                @endif
                                                    <button onclick="if(confirm('Are you sure?'))deleteItem('{{$item->id}}')" class="btn btn-danger mt-3">{{__('item.deleteitem')}}</button>
                                            @endif
                                        @endif
                                    </div>

                                </div>
                            </div>
                    </div>
            </div>
        </div>

        <script>
            function deleteItem(itemId) {
                var ajax = new XMLHttpRequest();
                ajax.open('GET', '/items/delete?itemId=' + itemId, true);
                ajax.onload = function () {
                    var list = JSON.parse(ajax.responseText);
                    if (list['msg'] === 'ok') {
                        alert('ok');
                        window.location.reload(true);
                    }
                    else {
                        alert('{{__('item.deletefail')}}')
                    }
                };
                ajax.send();
            }

            function addToCart(itemId) {
                var ajax = new XMLHttpRequest();
                ajax.open('GET', '/cart/add?itemId=' + itemId, true);
                ajax.onload = function () {
                    var list = JSON.parse(ajax.responseText);
                    if (list['msg'] === 'ok') {
                        alert('{{__('category.addcartok')}}');
                        window.location.reload(true);
                    }
                    else {
                        alert('{{__('category.addcartfail')}}')
                    }
                };
                ajax.send();

            }

            function enableItem(itemId) {
                var ajax = new XMLHttpRequest();
                ajax.open('GET', '/admin/item/enable?itemId=' + itemId, true);
                ajax.onload = function (ev) {
                    var list = JSON.parse(ajax.responseText);
                    if (list['msg'] === 'ok') {
                        window.location.reload(true);
                    } else {
                        alert('{{__('item.enableitemfail')}}');
                    }
                };
                ajax.send();
            }

            function disableItem(itemId) {
                var ajax = new XMLHttpRequest();
                ajax.open('GET', '/admin/item/disable?itemId=' + itemId, true);
                ajax.onload = function (ev) {
                    var list = JSON.parse(ajax.responseText);
                    if (list['msg'] === 'ok') {
                        window.location.reload(true);
                    } else {
                        alert('{{__('item.disableitemfail')}}');
                    }
                };
                ajax.send();
            }


        </script>


    @endif

@endsection