@extends('layouts.app')
@section('content')

    <div class="container" style="margin-bottom: 50px">
        <div class="col-md-8 offset-2">
            @if($errors->any())
                <div class="card">
                    <div class="card-body">
                        <code>
                            @foreach($errors->all() as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </code>
                    </div>
                </div>
                <hr>
            @endif

            <div class="card">
                <div class="card-header">
                    @if(isset($item))
                        <h5>Edit Item: {{$item->name}}</h5>
                    @else
                        <h5>Add new Item</h5>
                    @endif
                </div>

                <div class="card-body">
                    @if(isset($item))
                        <form enctype="multipart/form-data" action="/items/update" method="POST">
                            <input type="hidden" value="{{$item->id}}" name="item_id">
                            @else
                                <form enctype="multipart/form-data" action="/items/add" method="POST">
                                    @endif
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Item name</label>
                                        @if(isset($item))
                                            <input type="text" name="name" class="form-control" value="{{$item->name}}" required>
                                        @else
                                            <input type="text" name="name" class="form-control" required>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        @if(isset($item))
                                            <div style="display: inline-block">
                                                <img src="{{asset($item->image)}}" width="200" class="img-thumbnail mr-4">
                                            </div>
                                            <div style="display: inline-block">
                                                <label>Item image</label>
                                                <input type="file" name="image" class="form-control-file">
                                            </div>
                                        @else
                                            <label>Item image</label>
                                            <input type="file" name="image" class="form-control-file" required>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category_id" class="form-control" required>
                                            @if(isset($item))
                                                @foreach($categories as $category)
                                                    @if($category->id == $item->category_id)
                                                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                                    @else
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Quantity</label>
                                        @if(isset($item))
                                            <input type="number" name="quantity" class="form-control" min="1" value="{{$item->quantity}}" required>
                                        @else
                                            <input type="number" name="quantity" class="form-control" min="1" value="1" required>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Unit Price</label>
                                        @if(isset($item))
                                            <input type="number" name="unit_price" class="form-control" min="1" value="{{$item->unit_price}}" step="0.01" required>
                                        @else
                                            <input type="number" name="unit_price" class="form-control" min="1" step="0.01" required>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Discount %</label>
                                        @if(isset($item))
                                            <input type="number" name="discount" class="form-control" min="1" max="100" value="{{$item->discount}}" step="0.01" required>
                                        @else
                                            <input type="number" name="discount" class="form-control" min="1" max="100" value="1" step="0.01" required>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Price per quantity</label>
                                        @if(isset($item))
                                            <input type="number" name="ppq" class="form-control" min="1" value="{{$item->ppq}}" step="0.01" required>
                                        @else
                                            <input type="number" name="ppq" class="form-control" min="1" value="1" step="0.01" required>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        @if(isset($item))
                                            <input type="text" name="description" class="form-control"  value="{{$item->description}}">
                                        @else
                                            <input type="text" name="description" class="form-control">
                                        @endif
                                    </div>


                                    <div class="col-md" align="center">
                                        @if(isset($item))
                                            <input type="submit" class="btn btn-success" value="Update Item">
                                        @else
                                            <input type="submit" class="btn btn-success">
                                        @endif
                                    </div>
                                </form>
                </div>
            </div>
        </div>
    </div>

@endsection