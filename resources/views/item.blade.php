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
                                            <span class="badge badge-danger">Pending</span>
                                        @else
                                            <span class="badge badge-success">Active</span>
                                        @endif
                                    </p>
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
                                        <a href="/profile?tab=my_items" class="btn btn-secondary mr-3">Back</a>
                                        @if(\Illuminate\Support\Facades\Auth::user()->id != $item->user_id)
                                            <a href="#" class="btn btn-primary ml-3">Add to cart</a>
                                        @endif
                                        @if(\Illuminate\Support\Facades\Auth::user()->id == $item->user_id)
                                            @if(!$item->deleted)
                                            <a href="/items/update?id={{$item->id}}" class="btn btn-primary ml-3">Edit Item</a>
                                                <button onclick="if(confirm('Are you sure?'))deleteItem('{{$item->id}}')" class="btn btn-danger ml-3">Delete Item</button>
                                            @endif
                                        @endif
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
                            alert('Failed to delete item!')
                        }
                    };
                    ajax.send();
                }
            </script>


    @endif

@endsection