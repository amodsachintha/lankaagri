@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>[{{$city}}]</strong> {{__('category.showing')}} <strong>{{$_GET['param']}}</strong>. {{$count}} {{__('category.itemsfound')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="row">

            @if(isset($items))
                @foreach($items as $item)
                    <div class="col-lg-3 col-md-5 mb-4" style="-webkit-filter: drop-shadow(1px 2px 2px #b6b6b6);">
                        <div class="card h-100">
                            @if(Auth::check())
                                <a href="/item/{{$item->id}}"><img class="card-img-top" src="{{asset($item->image)}}" alt=""></a>
                            @else
                                <img class="card-img-top" src="{{asset($item->image)}}" alt="">
                            @endif
                            <div class="card-body">
                                <h4 class="card-title">
                                    @if(Auth::check())
                                        <a href="/item/{{$item->id}}">{{$item->name}}</a>
                                    @else
                                        {{$item->name}}
                                    @endif
                                </h4>
                                <h5>Rs. {{$item->unit_price}}</h5>
                                <h6><a href="#">{{'@'.str_replace(' ','',strtolower($item->user->name))}}</a></h6>
                                <p class="card-text">{{$item->description}}</p>
                            </div>
                            @if(\Auth::check())
                                @if(\Auth::id() != $item->user_id)
                                    <div class="card-footer" align="center">
                                        <button class="btn btn-outline-info" onclick="addToCart('{{$item->id}}')">{{__('category.addtocart')}}</button>
                                    </div>
                                @endif
                            @endif
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
                    alert('{{__('admindash.cataddsuccess')}}');
                    window.location.reload(true);
                }
                else {
                    alert('{{__('category.addcartfail')}}');
                }
            };
            ajax.send();

        }
    </script>
@endsection