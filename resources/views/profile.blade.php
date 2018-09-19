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
                        <img src="{{asset('storage/avatars/'.Auth::user()->avatar)}}" class="img-responsive" alt="">
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
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <button type="button" class="btn btn-success btn-sm">Follow</button>
                        <button type="button" class="btn btn-danger btn-sm">Message</button>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
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
                                <a href="?tab=cust_orders">
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
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    <div class="row">
                        @if(isset($_GET['tab']))

                            @if($_GET['tab'] == 'overview')
                                <div class="col-md">
                                    <div class="alert alert-success" role="alert">
                                        <h4 class="alert-heading">Overview for <strong>{{date('F')}}</strong></h4>
                                        <p>Active Items: {{$activeItemCount}}</p>
                                        <p>Pending Items: {{$pendingItemCount}}</p>
                                        <hr>
                                        <div class="progress" style="height: 40px">
                                            <div class="progress-bar bg-success " role="progressbar" style="width: {{number_format($deliveredPercent,2)}}%; font-size: 15px" aria-valuenow="15" aria-valuemin="0"
                                                 aria-valuemax="100"><strong>{{number_format($deliveredPercent,2)}}%</strong>
                                            </div>
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{number_format($undeliveredPercent,2)}}%; font-size: 15px" aria-valuenow="30" aria-valuemin="0"
                                                 aria-valuemax="100"><strong>{{number_format($undeliveredPercent,2)}}%</strong>
                                            </div>
                                        </div>
                                        <p class="mb-1"><span class="badge badge-success">Fulfilled Orders</span>
                                            <span class="badge badge-danger">Waiting to be delivered</span>
                                        </p>

                                    </div>
                                </div>
                            @endif
                            @if($_GET['tab'] == 'my_items')
                                @if(isset($items))
                                    <div class="col-lg-8 offset-2" align="center">
                                        {{$items->links()}}
                                    </div>
                                    @foreach($items as $item)
                                        <div class="col-lg-4 col-md-6 mb-4" style="-webkit-filter: drop-shadow(1px 2px 2px #b6b6b6);">
                                            <div class="card bg-success text-dark" style="width: 15rem;">
                                                <img class="card-img-top" src="{{asset('storage/'.$item->image)}}" alt="Card image cap">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$item->name}}</h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">Rs. {{$item->unit_price}} <span class="badge badge-danger">{{random_int(3,20)}}</span></h6>
                                                    <p class="card-text">Some quick example text to bulk of the card's content.</p>
                                                    <a href="#" class="btn btn-primary">View Item</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No items!</p>
                                @endif
                            @endif

                            @if($_GET['tab'] == 'pending')
                                @if(isset($pending))
                                    <div class="col-lg-8 offset-2" align="center">
                                        {{$pending->links()}}
                                    </div>
                                    @foreach($pending as $item)
                                        <div class="col-lg-4 col-md-6 mb-4 text-white" style="-webkit-filter: drop-shadow(1px 2px 2px #b6b6b6);">
                                            <div class="card bg-secondary" style="width: 15rem;">
                                                <img class="card-img-top" src="{{asset('storage/'.$item->image)}}" alt="Card image cap">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$item->name}}</h5>
                                                    <h6 class="card-subtitle mb-2 text-dark"><strong>Rs. {{$item->unit_price}}</strong></h6>
                                                    <p class="card-text">Some quick example text to bulk of the card's content.</p>
                                                    <a href="#" class="btn btn-primary">View Item</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No items!</p>
                                @endif
                            @endif


                            @if($_GET['tab'] == 'cust_orders')
                                @if(isset($orderlines))
                                    <table class="table table-hover table-responsive bg-white" style="-webkit-filter: drop-shadow(1px 2px 2px #7a7a7a);">
                                        <thead>
                                        <tr>
                                            <th>line_id</th>
                                            <th>order_id</th>
                                            <th>cust_name</th>
                                            <th>item_name</th>
                                            <th>quantity</th>
                                            <th>unit_price</th>
                                            <th>total</th>
                                            <th>Fulfill</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orderlines as $orderline)
                                            <tr>
                                                <td>{{$orderline['orderline_id']}}</td>
                                                <td>{{$orderline['order_id']}}</td>
                                                <td>{{$orderline['cust_name']}}</td>
                                                <td>{{$orderline['item_name']}}</td>
                                                <td>{{$orderline['quantity']}}</td>
                                                <td>{{$orderline['unit_price']}}</td>
                                                <td>{{$orderline['total']}}</td>
                                                <td>
                                                    <button class="btn btn-outline-success">Fulfill</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>No items!</p>
                                @endif
                            @endif


                            @if($_GET['tab'] == 'summary')
                                @if(isset($purchases))
                                    <table class="table table-hover bg-white text-center" style="-webkit-filter: drop-shadow(1px 2px 2px #006c0e);">
                                        <thead>
                                        <tr>
                                            <th colspan="3">PURCHASES</th>
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
                                                    <button class="btn btn-default">{{$purchase->id}}</button>
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
                                    <table class="table table-hover bg-white text-center" style="-webkit-filter: drop-shadow(1px 2px 2px #f4b200);">
                                        <thead>
                                        <tr>
                                            <th colspan="3">ITEMS SOLD</th>
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
                                    <div class="col-md">
                                        <form action="/user/update" method="POST">
                                            {{csrf_field()}}
                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$user->name}}" required
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
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ $user->mobile }}"
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
                                                    <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ $user->city }}" required>
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

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                @endif
                            @endif


                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection