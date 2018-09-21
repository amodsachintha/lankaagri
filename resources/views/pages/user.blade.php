@extends('layouts.app')
@section('content')
    <div class="container" style="margin-bottom: 75px">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="list-group">
                    <div class="list-group-item  flex-column align-items-start">
                        <div class="row">
                            <div class="col-sm-3 mr-4">
                                <img src="{{asset($user->avatar)}}" class="img-thumbnail shadow-lg" style="position: absolute">
                            </div>
                            <div class="col-sm">
                                <div class="d-flex w-100 justify-content-between mb-2">
                                    <h2>{{$user->name}}</h2>
                                    <h5>{{$user->nic}}</h5>
                                </div>
                                <h4><a href="mailto:{{$user->email}}">{{$user->email}}</a></h4>
                                <h5>mobile: {{$user->mobile}}</h5>
                                <p>{{$user->st_address.", ".$user->city.", ".$user->district.", ".$user->province." Province"}}</p>
                                <code>Joined on: {{date('d M Y h:m A',strtotime($user->created_at))}}</code>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 60px">
            <div class="col-md-12">
                <table class="table table-hover text-center table-sm shadow">
                    <thead>
                    <tr>
                        <th colspan="8">ITEMS</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Discount</th>
                        <th>Date added</th>
                        <th>Enable/Disable</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        @if(!$item->active)
                            <tr style="background-color: #e1e8ef">
                        @else
                            <tr style="background-color: rgba(25,182,24,0.47)">
                                @endif
                                <td>{{$loop->iteration}}</td>
                                <td><strong><a href="/item/{{$item->id}}" class="text-dark">{{$item->name}}</a></strong></td>
                                <td>{{$item->category->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>Rs. {{number_format($item->unit_price,2)}}</td>
                                <td>{{number_format($item->discount,2)}}%</td>
                                <td>{{date('Y-m-d',strtotime($item->created_at))}}</td>
                                @if($item->active)
                                    <td>
                                        <button onclick="disableItem('{{$item->id}}')" class="btn btn-sm btn-danger">Disable</button>
                                    </td>
                                @else
                                    <td>
                                        <button onclick="enableItem('{{$item->id}}')" class="btn btn-sm btn-success">Enable</button>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" align="center">
                <a href="/admin?tab=users" class="btn btn-outline-dark">Back</a>
            </div>
        </div>

        <script>
            function enableItem(itemId) {
                var ajax = new XMLHttpRequest();
                ajax.open('GET', '/admin/item/enable?itemId=' + itemId, true);
                ajax.onload = function (ev) {
                  var list = JSON.parse(ajax.responseText);
                  if(list['msg'] === 'ok'){
                      window.location.reload(true);
                  }else{
                      alert('Failed to enable item. Sorry!');
                  }
                };
                ajax.send();
            }

            function disableItem(itemId) {
                var ajax = new XMLHttpRequest();
                ajax.open('GET', '/admin/item/disable?itemId=' + itemId, true);
                ajax.onload = function (ev) {
                    var list = JSON.parse(ajax.responseText);
                    if(list['msg'] === 'ok'){
                        window.location.reload(true);
                    }else{
                        alert('Failed to disable item. Sorry!');
                    }
                };
                ajax.send();
            }
        </script>


    </div>

@endsection