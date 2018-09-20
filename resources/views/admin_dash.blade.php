@extends('layouts.app')
@section('content')
    @if(!isset($_GET['tab']))
        <?php $_GET['tab'] = 'summary'; ?>
    @endif
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-white p-3 rounded mb-4 text-center shadow" style="background-color: #C0392B">
                <h3>Admin Dashboard</h3>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-2">
                <ul class="list-group rounded shadow-lg" style="color: black">
                    <li class="list-group-item {{$_GET['tab'] == 'summary' ? 'active' : ''}}">
                        <a href="/admin?tab=summary" class="text-dark"><strong>Summary</strong></a>
                    </li>
                    <li class="list-group-item {{$_GET['tab'] == 'users' ? 'active' : ''}}">
                        <a href="/admin?tab=users" class="text-dark"><strong>Users</strong></a>
                    </li>
                    <li class="list-group-item {{$_GET['tab'] == 'categories' ? 'active' : ''}}">
                        <a href="/admin?tab=categories" class="text-dark"><strong>Categories</strong></a>
                    </li>
                    <li class="list-group-item {{$_GET['tab'] == 'add_item' ? 'active' : ''}}">
                        <a href="/admin?tab=add_item&showAll=false" class="text-dark"><strong>Add Item</strong></a>
                    </li>
                </ul>

                @if($_GET['tab'] == 'add_item')
                    <hr>
                    <ul class="list-group rounded shadow-lg" style="color: black">
                        <li class="list-group-item {{$_GET['showAll'] == 'true' ? 'bg-info':''}}">
                            <a href="/admin?tab=add_item&showAll=true" class="text-dark"><strong>All Items</strong></a>
                        </li>
                    </ul>
                @endif
            </div>
            <div class="col-sm">
                @if($_GET['tab'] == 'summary')
                    <div class="row shadow pb-3">
                        <div class="col-sm-6">
                            <canvas id="myChartMonthly" height="400" width="400"></canvas>
                        </div>
                        <div class="col-sm-6">
                            <canvas id="myChartYearly" height="400" width="400"></canvas>
                        </div>
                    </div>

                    <script>
                        var config1 = {
                            type: 'pie',
                            data: {
                                labels: [
                                    @foreach($orderlines as $orderline)
                                        '{{strval($orderline->item->name)}}',
                                    @endforeach
                                ],
                                datasets: [{
                                    label: 'Dataset 1',
                                    data: [
                                        @foreach($orderlines as $orderline)
                                        {{$orderline->sQuantity}},
                                        @endforeach
                                    ],
                                    backgroundColor: [
                                        @foreach($orderlines as $orderline)
                                            '#' + (Math.random() * 0xFFFFFF << 0).toString(16),
                                        @endforeach
                                    ]
                                }]

                            },
                            options: {
                                title: {
                                    display: true,
                                    text: 'Items vs Quantity ({{date('F')}})'
                                }
                            }
                        };

                        var config2 = {
                            type: 'pie',
                            data: {
                                labels: [
                                    @foreach($orderlinesY as $orderline)
                                        '{{strval($orderline->item->name)}}',
                                    @endforeach
                                ],
                                datasets: [{
                                    label: 'Dataset 2',
                                    data: [
                                        @foreach($orderlinesY as $orderline)
                                        {{$orderline->sQuantity}},
                                        @endforeach
                                    ],
                                    backgroundColor: [
                                        @foreach($orderlinesY as $orderline)
                                            '#' + (Math.random() * 0xFFFFFF << 0).toString(16),
                                        @endforeach
                                    ]
                                }]

                            },
                            options: {
                                title: {
                                    display: true,
                                    text: 'Items vs Quantity ({{date('Y')}})'
                                }
                            }

                        };


                        window.onload = function () {
                            var ctx1 = document.getElementById('myChartMonthly').getContext('2d');
                            window.myPie = new Chart(ctx1, config1);

                            var ctx2 = document.getElementById('myChartYearly').getContext('2d');
                            window.myPie = new Chart(ctx2, config2);
                        };
                    </script>
                @endif

                @if($_GET['tab'] == 'users')
                    <div class="row shadow p-2">
                        <div class="col-sm">
                            <table class="table table-hover table-sm text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>e-mail</th>
                                    <th>NIC</th>
                                    <th>Mobile</th>
                                    <th>View</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($users))
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->nic}}</td>
                                            <td>{{$user->mobile}}</td>
                                            <td><a href="/user/{{$user->id}}" class="btn btn-sm btn-outline-primary">View</a></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                @if($_GET['tab'] == 'categories')
                    <div class="row shadow p-2">
                        <div class="col-sm-3">
                            <ul class="list-group rounded shadow-lg">
                                @if(isset($categories))
                                    <li class="list-group-item text-center bg-info"><strong>Categories</strong></li>
                                    @foreach($categories as $category)
                                        <li class="list-group-item">{{$loop->iteration." - " .$category->name}}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Add New Category</label>
                                <input type="text" class="form-control" id="newCat" placeholder="Category name">
                            </div>
                            <button role="button" onclick="if(confirm('Are you sure?'))addNewCategory()" class="btn btn-outline-primary">Add new</button>
                        </div>
                    </div>

                    <script>
                        function addNewCategory() {
                            var catName = document.getElementById('newCat').value;
                            console.log(catName);
                            var ajax = new XMLHttpRequest();
                            ajax.open('GET', '/category/add?name=' + catName, true)
                            ajax.onload = function (ev) {
                                var list = JSON.parse(ajax.responseText);
                                if (list['msg'] === 'ok') {
                                    alert('Category added successfully!');
                                    window.location.reload(true);
                                }
                                else {
                                    alert('Failed to add new category!');
                                }
                            };
                            ajax.send();
                        }
                    </script>

                @endif

                @if($_GET['tab'] == 'add_item')
                    @if(isset($_GET['showAll']))
                        @if($_GET['showAll'] == 'false')
                            <div class="row shadow-sm">
                                <div class="col-sm p-0">
                                    <div class="card ">
                                        <div class="card-header">
                                            <h4>Add item as admin</h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="/admin/item/add" method="POST" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <label>Item name</label>
                                                    <input type="text" name="name" required class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <select name="category_id" required class="form-control">
                                                        @if(isset($categories))
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Unit price</label>
                                                    <input type="number" step="0.01" name="unit_price" required class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <input type="file" name="image" required class="form-control-file">
                                                </div>
                                                <div class="mt-4">
                                                    <input type="submit" value="Save Item" class="btn btn-lg btn-outline-primary">
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row shadow-sm">
                                <div class="col-sm p-0">
                                    <div class="list-group">
                                        @if(isset($adminItems))
                                            @foreach($adminItems as $adminItem)
                                                <div class="list-group-item  flex-column align-items-start">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <img src="{{asset($adminItem->image)}}" width="200" class="img-thumbnail">
                                                        </div>
                                                        <div class="col-sm">
                                                            <div class="d-flex w-100 justify-content-between mb-2">
                                                                <h2 class="mb-1">{{$adminItem->name}}</h2>
                                                                <small>#{{$loop->iteration}}</small>
                                                            </div>
                                                            <h6>added on: <strong>{{date('d M Y h:m A',strtotime($adminItem->created_at))}}</strong></h6>
                                                            <h6><code>{{$adminItem->category->name}}</code></h6>
                                                            <h6><strong>Rs. {{number_format($adminItem->unit_price,2)}}</strong></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endif


            </div>
        </div>

    </div>
@endsection