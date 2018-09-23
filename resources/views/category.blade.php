@extends('layouts.app')
@section('content')
    <div class="container" style="margin-bottom: 75px">
        <div class="row">
            <div class="col-sm">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Showing items in <strong>{{$category}}</strong>. {{$count}} items(s) found!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <div class="list-group">
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <a href="/categories/{{$category->name}}" class="list-group-item list-group-item-info btn btn-outline-info text-left"><span
                                        class="fa fa-caret-right"></span> {{$category->name}}</a>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-sm">
                @if(isset($items))
                    <div class="card-columns">
                    @foreach($items as $item)
                            <div class="card shadow">
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
                                            <button class="btn btn-outline-info" onclick="addToCart('{{$item->id}}')">Add to cart</button>
                                        </div>
                                    @endif
                                @endif
                            </div>
                    @endforeach
                    </div>
                @endif
            </div>
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