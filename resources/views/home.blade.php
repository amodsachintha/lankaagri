@extends('layouts.app')

@section('content')
    <div class="container" style="margin-bottom: 30px">

        <div class="row">
            <div class="col-lg-3">
                <h1 class="my-4">Lanka Agri</h1>
                <div class="list-group" >
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <a href="/category/{{$category->name}}" class="list-group-item bg-secondary text-white"><span class="fa fa-caret-right"></span> {{$category->name}}</a>
                        @endforeach
                    @endif
                </div>

            </div>
            <div class="col-lg-9">
                <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel" style="-webkit-filter: drop-shadow(1px 2px 2px #b6b6b6);">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="{{asset('storage/carousel/h1.jpg')}}" width="900" height="350" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="{{asset('storage/carousel/h2.jpg')}}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="{{asset('storage/carousel/h3.jpg')}}" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="row">

                    @if(isset($items))
                        @foreach($items as $item)
                            <div class="col-lg-4 col-md-6 mb-4" style="-webkit-filter: drop-shadow(1px 2px 2px #b6b6b6);">
                                <div class="card h-100">
                                    <a href="/item/{{$item->id}}"><img class="card-img-top" src="{{asset('storage/items/'.$item->image)}}" alt=""></a>
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
                    alert('Failed to remove item from cart!')
                }
            };
            ajax.send();

        }
    </script>

@endsection
