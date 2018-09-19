@extends('layouts.app')
@section('content')

    @if(isset($item))
        <div class="container mb-4">
            <div class="col-md-8 offset-2">
                <div class="card">
                    <img class="card-img-top" src="{{asset('storage/items/'.$item->image)}}" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title">{{$item->name}}</h2>
                        <p><kbd>{{$item->category->name}}</kbd></p>
                        <small>added on {{date('M d Y',strtotime($item->created_at))}}</small>
                        <h6 class="mt-2">Sold by: {{$item->user->name}}</h6>
                        <h6>{{$item->user->city.", ".$item->user->district.", ".$item->user->province." Province"}}</h6>
                        <div class="justify-content-between">
                            @if($item->quantity > 0)
                                <h5>{{$item->quantity}} in stock</h5>
                                <span class="badge badge-success"><h6>In Stock</h6></span>
                            @else
                                <span class="badge badge-danger"><h6>Out of Stock!</h6></span>
                            @endif
                            <h5 class="mt-2">Rs. {{number_format($item->unit_price,2)}}</h5>
                            <h6><code>{{$item->discount}}% discount</code></h6>
                        </div>
                        <p class="card-text">{{$item->description == null ? "Some quick example text to build on the card title and make up the bulk of the card's content." : $item->description}}</p>
                        <div class="justify-content-center" align="center">
                            <a href="{{$_SERVER['HTTP_REFERER']}}" class="btn btn-secondary mr-3">Back</a>
                            @if(\Illuminate\Support\Facades\Auth::user()->id != $item->user_id)
                                <a href="#" class="btn btn-primary ml-3">Add to cart</a>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->id == $item->user_id)
                                <a href="#" class="btn btn-primary ml-3">Edit Item</a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection