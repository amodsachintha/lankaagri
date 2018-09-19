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
                                <a href="#"><img class="card-img-top" src="{{asset('storage/'.$item->image)}}" alt=""></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#">{{$item->name}}</a>
                                    </h4>
                                    <h5>Rs. {{$item->unit_price}}</h5>
                                    <h6><a href="#">{{'@'.str_replace(' ','',strtolower($item->user->name))}}</a></h6>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">@for($i=random_int(1,5); $i <= 5; $i++) &#9733; @endfor</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

        </div>

    </div>
@endsection