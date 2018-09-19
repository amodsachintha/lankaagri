@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="alert alert-success">
                    Showing results for "{{$_GET['param']}}". {{$count}} results found!
                </div>
            </div>
        </div>

        <div class="row">

                @if(isset($items))
                    @foreach($items as $item)
                        <div class="col-lg-3 col-md-5 mb-4" style="-webkit-filter: drop-shadow(1px 2px 2px #b6b6b6);">
                            <div class="card h-100">
                                <a href="#"><img class="card-img-top" src="{{asset('storage/items/'.$item->image)}}" alt=""></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="/item/{{$item->id}}">{{$item->name}}</a>
                                    </h4>
                                    <h5>Rs. {{$item->unit_price}}</h5>
                                    <h6><a href="#">{{'@'.str_replace(' ','',strtolower($item->user->name))}}</a></h6>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                                </div>
                                <div class="card-footer" align="center">
                                    <button class="btn btn-outline-info" onclick="addToCart('{{$item->id}}')">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

        </div>

    </div>
    <script>
        function addToCart(itemId) {
            var ajax = new XMLHttpRequest();
            ajax.open('GET', '/cart/add?itemId=' + itemId, true);
            ajax.onload = function () {
                var list = JSON.parse(ajax.responseText);
                if (list['msg'] === 'ok') {
                    alert('Item added to cart!');
                    window.location.reload(true);
                }
                else {
                    alert('Failed to add item to cart!');
                }
            };
            ajax.send();

        }
    </script>
@endsection