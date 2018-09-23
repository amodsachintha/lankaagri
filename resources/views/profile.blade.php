@extends('layouts.app')

@section('content')
    @if(!isset($_GET['tab']))
        <?php $_GET['tab'] = 'overview'; ?>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic" align="center">
                        <img src="{{asset(Auth::user()->avatar)}}" class="img-responsive img-thumbnail" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {{Auth::user()->name}}
                        </div>
                        <div class="profile-usertitle-job">
                            {{Auth::user()->city}}
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->

                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="list-group">
                            <li class="list-group-item {{$_GET['tab'] == 'overview' ? 'active':''}}">
                                <a href="?tab=overview">
                                    <i class="fa fa-grip-vertical"></i> Overview </a>
                            </li>
                            <li class="list-group-item {{$_GET['tab'] == 'my_items' ? 'active':''}}">
                                <a href="?tab=my_items">
                                    <i class="fa fa-align-justify"></i> My Items </a>
                            </li>
                            <li class="list-group-item {{$_GET['tab'] == 'pending' ? 'active':''}}">
                                <a href="?tab=pending">
                                    <i class="fa fa-clock"></i> Pending Items </a>
                            </li>
                            <li class="list-group-item {{$_GET['tab'] == 'cust_orders' ? 'active':''}}">
                                <a href="?tab=cust_orders&fulfilled=false">
                                    <i class="fa fa-file-invoice-dollar"></i> Customer Orders </a>
                            </li>
                            <li class="list-group-item {{$_GET['tab'] == 'summary' ? 'active':''}}">
                                <a href="?tab=summary">
                                    <i class="fa fa-list"></i> My Monthly Summary </a>
                            </li>
                            <li class="list-group-item {{$_GET['tab'] == 'settings' ? 'active':''}}">
                                <a href="?tab=settings">
                                    <i class="fa fa-cog"></i> Account Settings </a>
                            </li>
                            <li class="list-group-item {{$_GET['tab'] == 'help' ? 'active':''}}">
                                <a href="?tab=help">
                                    <i class="fa fa-question-circle"></i> Help </a>
                            </li>
                        </ul>

                        @if(!is_null($_GET['tab']))
                            @if($_GET['tab'] == 'cust_orders')
                                <ul class="list-group mt-3">
                                    <li class="list-group-item {{$_GET['fulfilled'] == 'false' ? 'bg-info':''}}">
                                        <a href="?tab=cust_orders&fulfilled=false">
                                            <i class="fa fa-times"></i> Pending Orders </a>
                                    </li>
                                    <li class="list-group-item {{$_GET['fulfilled'] == 'true' ? 'bg-info':''}}">
                                        <a href="?tab=cust_orders&fulfilled=true">
                                            <i class="fa fa-check"></i> Fulfilled Orders </a>
                                    </li>
                                </ul>
                            @endif
                        @endif

                        @if(!is_null($_GET['tab']))
                            @if($_GET['tab'] == 'summary')
                                <ul class="list-group mt-3">
                                    <li class="list-group-item" style="text-align: center">
                                        <a href="/summary?purchases=true" class="btn btn-outline-success">All Purchases</a>
                                    </li>
                                    <li class="list-group-item" style="text-align: center">
                                        <a href="/summary?sales=true" class="btn btn-outline-success w-50">All Sales</a>
                                    </li>
                                </ul>
                            @endif
                        @endif


                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    <div class="row">
                        @if(isset($_GET['tab']))

                            @if($_GET['tab'] == 'overview')
                                <div class="col-md-12">
                                    <div class="alert alert-success text-center mt-5 shadow-lg" role="alert">
                                        <h4 class="alert-heading">Overview for <strong>{{date('F')}}</strong></h4>
                                        <hr>
                                        <h4>Active Items: <span class="badge badge-success">&nbsp;{{$activeItemCount}}&nbsp;</span></h4>
                                        <h4>Pending Items: <span class="badge badge-secondary">&nbsp;{{$pendingItemCount}}&nbsp;</span></h4>
                                        <h4>Pending Orders: <span class="badge badge-danger">&nbsp;{{$undeliveredCount}}&nbsp;</span></h4>
                                        <hr>
                                        <div class="progress shadow mb-2" style="height: 40px">
                                            <div class="progress-bar bg-success text-dark progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{number_format($deliveredPercent,2)}}%; font-size: 15px" aria-valuenow="15"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"><strong>{{number_format($deliveredPercent,2)}}%</strong>
                                            </div>
                                            <div class="progress-bar bg-danger text-dark progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{number_format($undeliveredPercent,2)}}%; font-size: 15px"
                                                 aria-valuenow="30"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"><strong>{{number_format($undeliveredPercent,2)}}%</strong>
                                            </div>
                                        </div>
                                        <p class="mb-1" style="font-size: 18px;">
                                            <span class="badge badge-success">Fulfilled Orders</span>
                                            <span class="badge badge-danger">Waiting to be delivered</span>
                                        </p>
                                    </div>


                                </div>
                            @endif
                            @if($_GET['tab'] == 'my_items')
                                @if(isset($items))
                                    <div class="card-columns">
                                        <div class="card border-success bg-warning text-dark shadow" style="width: 15rem;">
                                            <img class="card-img-top" src="{{asset('storage/items/add.png')}}" alt="Card image cap">
                                            <div class="card-body" align="center">
                                                <a href="/items/add" class="btn btn-success">Add new Item</a>
                                            </div>
                                        </div>
                                        @foreach($items as $item)
                                            <div class="card border-success text-dark shadow" style="width: 15rem;">
                                                <img class="card-img-top" src="{{asset($item->image)}}" alt="Card image cap">
                                                <div class="card-body" align="center">
                                                    <h5 class="card-title"><a href="/item/{{$item->id}}">{{$item->name}}</a></h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">Rs. {{$item->unit_price}}</h6>
                                                    <p class="card-text">{{$item->description}}</p>
                                                    <a href="/item/{{$item->id}}" class="btn btn-primary">View Item</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>No items!</p>
                                @endif
                            @endif

                            @if($_GET['tab'] == 'pending')
                                @if(isset($pending))
                                    <div class="card-columns">
                                        @foreach($pending as $item)
                                            <div class="card border-danger shadow" style="width: 15rem;">
                                                <img class="card-img-top" src="{{asset($item->image)}}" alt="Card image cap">
                                                <div class="card-body" align="center">
                                                    <h5 class="card-title"><a href="/item/{{$item->id}}">{{$item->name}}</a></h5>
                                                    <h6 class="card-subtitle mb-2 text-dark"><strong>Rs. {{$item->unit_price}}</strong></h6>
                                                    <p class="card-text">{{$item->description}}</p>
                                                    <a href="/item/{{$item->id}}" class="btn btn-primary">View Item</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>No items!</p>
                                @endif
                            @endif


                            @if($_GET['tab'] == 'cust_orders')

                                @if($_GET['fulfilled'] == 'true')
                                    @if(isset($fullfilledItems))
                                        <div class="col-md-12">
                                            <div class="list-group">
                                                <div class="list-group-item  flex-column align-items-start bg-success">
                                                    <div class="d-flex w-100 justify-content-center mb-2">
                                                        <h5 class="mb-1"><strong>Fulfilled Customer Orders</strong></h5>
                                                    </div>
                                                </div>
                                                @foreach($fullfilledItems as $orderline)
                                                    <div class="list-group-item  flex-column align-items-start">
                                                        <div class="d-flex w-100 justify-content-between mb-2">
                                                            <small>orderline id: #{{$orderline['orderline_id']}}</small>
                                                            <small>#{{$loop->iteration}}</small>
                                                        </div>
                                                        <div class="d-flex w-100 justify-content-between mb-2">
                                                            <h5 class="mb-1"><strong>{{$orderline['item_name']}}</strong></h5>
                                                            <small>fulfilled on: <strong>{{date('d M Y',strtotime($orderline['updated_at']))}}</strong></small>
                                                        </div>
                                                        <h6>{{$orderline['cust_name']}}</h6>
                                                        <div class="d-flex w-100 justify-content-between mb-2">
                                                            <h6>{{$orderline['quantity']}} units</h6>
                                                            <h4>Rs. {{number_format($orderline['total'],2)}}</h4>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <p>No orders!</p>
                                    @endif

                                @else
                                    @if(isset($orderlines))
                                        <div class="col-md-12">
                                            <div class="list-group">
                                                <div class="list-group-item  flex-column align-items-start bg-warning">
                                                    <div class="d-flex w-100 justify-content-center mb-2">
                                                        <h5 class="mb-1"><strong>Customer Orders</strong></h5>
                                                    </div>
                                                </div>
                                                @foreach($orderlines as $orderline)
                                                    <div class="list-group-item  flex-column align-items-start">
                                                        <div class="d-flex w-100 justify-content-between mb-2">
                                                            <small>orderline id: #{{$orderline['orderline_id']}}</small>
                                                            <small>#{{$loop->iteration}}</small>
                                                        </div>
                                                        <div class="d-flex w-100 justify-content-between mb-2">
                                                            <h5 class="mb-1"><strong>{{$orderline['item_name']}}</strong></h5>
                                                            <small>{{date('d M Y',strtotime($orderline['created_at']))}}</small>
                                                        </div>
                                                        <h6>{{$orderline['cust_name']}}</h6>
                                                        <h6>{{$orderline['shipping_address']}}</h6>
                                                        <div class="d-flex w-100 justify-content-between mb-2">
                                                            <h6>{{$orderline['quantity']}} units</h6>
                                                            <h4>Rs. {{number_format($orderline['total'],2)}}</h4>
                                                        </div>
                                                        <p class="mb-1" align="right">
                                                            <button class="btn btn-outline-success" onclick="if(confirm('Are you sure?'))fulfill('{{$orderline['orderline_id']}}')">Fulfill</button>
                                                        </p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <p>No orders!</p>
                                    @endif
                                @endif

                            @endif


                            @if($_GET['tab'] == 'summary')
                                @if(isset($purchases))
                                    <table class="table table-hover table-sm bg-white text-center" style="-webkit-filter: drop-shadow(1px 2px 2px #006c0e);">
                                        <thead>
                                        <tr>
                                            <th colspan="3">PURCHASES ({{strtoupper(date('F'))}})</th>
                                        </tr>
                                        <tr>
                                            <th>order_id</th>
                                            <th>date</th>
                                            <th>total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($purchases as $purchase)
                                            <tr>
                                                <td>
                                                    <a href="/order/show/{{$purchase->id}}" class="btn btn-outline-info">{{$purchase->id}}</a>
                                                </td>
                                                <td>{{date('d M Y h:i A',strtotime($purchase->created_at))}}</td>
                                                <td>Rs. {{number_format($purchase->total,2)}}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="text-dark">
                                            <td colspan="2" class="text-right"><h4>Total</h4></td>
                                            <td><h4>Rs. {{number_format($purchaseTotal,2)}}</h4></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <p>No Purchases!</p>
                                @endif

                                @if(isset($orderlines))
                                    <table class="table table-hover table-sm bg-white text-center" style="-webkit-filter: drop-shadow(1px 2px 2px #f4b200);">
                                        <thead>
                                        <tr>
                                            <th colspan="3">ITEMS SOLD ({{strtoupper(date('F'))}}) (aggregated)</th>
                                        </tr>
                                        <tr>
                                            <th>item_name</th>
                                            <th>quantity</th>
                                            <th>total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orderlines as $orderline)
                                            <tr>
                                                <td>{{$orderline['item_name']}}</td>
                                                <td>{{$orderline['quantity']}}</td>
                                                {{--<td>{{date('d M Y h:m A',strtotime($orderline['date']))}}</td>--}}
                                                <td>Rs. {{number_format($orderline['total'],2)}}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="text-dark">
                                            <td colspan="2" class="text-right"><h4>Total</h4></td>
                                            <td><h4>Rs. {{number_format($orderlineTotal,2)}}</h4></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <p>No Items sold this month!</p>
                                @endif
                            @endif

                            @if($_GET['tab'] == 'settings')
                                @if(isset($user))
                                    <div class="col-sm-12 mt-0 mb-2">
                                        @if(session()->has('passwordUpdate'))
                                            @if(session()->get('passwordUpdate') == true)
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    Password updated!
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            @if(session()->get('passwordUpdate') == false)
                                                <div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
                                                    Password update failed! Try again.
                                                    @if(session()->has('errors'))
                                                        @foreach(session()->get('errors')->all() as $message)
                                                            <br><code>{{$message}}</code>
                                                        @endforeach
                                                    @endif
                                                    @if(session()->has('err'))
                                                        <br>
                                                        <code>{{session()->get('err')}}</code>
                                                    @endif
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col mt-1 mb-5">
                                        <form action="/user/password" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="card shadow">
                                                <div class="card-header">
                                                    <h4>Update Password</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Current Password</label>
                                                        <input type="password" name="password_old" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input type="password" name="password" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Confirm new Password</label>
                                                        <input type="password" name="password_confirmation" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="card-footer" align="center">
                                                    <input type="submit" class="btn btn-outline-primary" value="Update">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="card shadow">
                                            <form action="/user/update" method="POST">
                                                <div class="card-header">
                                                    <h4>Update details</h4>
                                                </div>
                                                <div class="card-body">

                                                    {{csrf_field()}}
                                                    <div class="form-group row">
                                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$user->name}}"
                                                                   required
                                                                   autofocus>
                                                            @if ($errors->has('name'))
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="nic" type="text" class="form-control" name="nic" value="{{ $user->nic }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile"
                                                                   value="{{ $user->mobile }}"
                                                                   required>
                                                            @if ($errors->has('mobile'))
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('mobile') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="province" class="col-md-4 col-form-label text-md-right">{{ __('Province') }}</label>
                                                        <div class="col-md-6">
                                                            <select id="province" class="form-control{{ $errors->has('province') ? ' is-invalid' : '' }}" name="province" value="{{ $user->province }}"
                                                                    required>
                                                                <option>Southern</option>
                                                                <option>Western</option>
                                                                <option>Northern</option>
                                                            </select>
                                                            @if ($errors->has('province'))
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('province') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="district" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>
                                                        <div class="col-md-6">
                                                            <select id="district" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" name="district" value="{{ $user->district }}"
                                                                    required>
                                                                <option>Galle</option>
                                                                <option>Colombo</option>
                                                                <option>Matale</option>
                                                            </select>
                                                            @if ($errors->has('district'))
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('district') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ $user->city }}"
                                                                   required>
                                                            @if ($errors->has('city'))
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('city') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="st_address" class="col-md-4 col-form-label text-md-right">{{ __('Street Address') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="st_address" type="text" class="form-control{{ $errors->has('st_address') ? ' is-invalid' : '' }}" name="st_address"
                                                                   value="{{ $user->st_address }}">
                                                            @if ($errors->has('st_address'))
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('st_address') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card-footer" align="center">
                                                    <button type="submit" class="btn btn-outline-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                <div class="col mt-3 mb-5">
                                    <form action="/user/avatar" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="card shadow">
                                            <div class="card-header">
                                                <h4>Update profile image</h4>
                                            </div>
                                            <div class="card-body">
                                                <input type="file" name="avatar" class="form-control-file" required>
                                            </div>
                                            <div class="card-footer" align="center">
                                                <input type="submit" class="btn btn-outline-primary" value="Update">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            @if($_GET['tab'] == 'help')
                                <div class="col-md">
                                    SHOW Refer the video below <code>HELP</code> HERE
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function fulfill(orderlineId) {
            var ajax = new XMLHttpRequest();
            ajax.open('GET', '/orderline/fulfill/' + orderlineId, true);
            ajax.onload = function () {
                var list = JSON.parse(ajax.responseText);
                if (list['msg'] === 'ok') {
                    alert('Order item fulfilled!');
                    window.location.reload(true);
                }
                else {
                    alert('Failed to fulfill order item!');
                }
            };
            ajax.send();

        }
    </script>

@endsection