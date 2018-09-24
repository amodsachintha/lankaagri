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
                                    <i class="fa fa-grip-vertical"></i> {{__('profile.overview')}} </a>
                            </li>
                            <li class="list-group-item {{$_GET['tab'] == 'my_items' ? 'active':''}}">
                                <a href="?tab=my_items">
                                    <i class="fa fa-align-justify"></i> {{__('profile.myitems')}}  </a>
                            </li>
                            <li class="list-group-item {{$_GET['tab'] == 'pending' ? 'active':''}}">
                                <a href="?tab=pending">
                                    <i class="fa fa-clock"></i> {{__('profile.pendingitems')}}  </a>
                            </li>
                            <li class="list-group-item {{$_GET['tab'] == 'cust_orders' ? 'active':''}}">
                                <a href="?tab=cust_orders&fulfilled=false">
                                    <i class="fa fa-file-invoice-dollar"></i> {{__('profile.custorders')}}  </a>
                            </li>
                            <li class="list-group-item {{$_GET['tab'] == 'summary' ? 'active':''}}">
                                <a href="?tab=summary">
                                    <i class="fa fa-list"></i> {{__('profile.monthlysummary')}}  </a>
                            </li>
                            <li class="list-group-item {{$_GET['tab'] == 'settings' ? 'active':''}}">
                                <a href="?tab=settings">
                                    <i class="fa fa-cog"></i> {{__('profile.settings')}} </a>
                            </li>
                            <li class="list-group-item {{$_GET['tab'] == 'help' ? 'active':''}}">
                                <a href="?tab=help">
                                    <i class="fa fa-question-circle"></i> {{__('profile.help')}}  </a>
                            </li>
                        </ul>

                        @if(!is_null($_GET['tab']))
                            @if($_GET['tab'] == 'cust_orders')
                                <ul class="list-group mt-3">
                                    <li class="list-group-item {{$_GET['fulfilled'] == 'false' ? 'bg-info':''}}">
                                        <a href="?tab=cust_orders&fulfilled=false">
                                            <i class="fa fa-times"></i> {{__('profile.pendingorders')}}  </a>
                                    </li>
                                    <li class="list-group-item {{$_GET['fulfilled'] == 'true' ? 'bg-info':''}}">
                                        <a href="?tab=cust_orders&fulfilled=true">
                                            <i class="fa fa-check"></i> {{__('profile.fulfilledorders')}}  </a>
                                    </li>
                                </ul>
                            @endif
                        @endif

                        @if(!is_null($_GET['tab']))
                            @if($_GET['tab'] == 'summary')
                                <ul class="list-group mt-3">
                                    <li class="list-group-item" style="text-align: center">
                                        <a href="/summary?purchases=true" class="btn btn-outline-success">{{__('profile.allpurchases')}} </a>
                                    </li>
                                    <li class="list-group-item" style="text-align: center">
                                        <a href="/summary?sales=true" class="btn btn-outline-success w-50">{{__('profile.allsales')}} </a>
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
                                        <h4 class="alert-heading">{{__('profile.overviewtitle')}} <strong>{{date('F')}}</strong></h4>
                                        <hr>
                                        <h4>{{__('profile.activeitems')}} <span class="badge badge-success">&nbsp;{{$activeItemCount}}&nbsp;</span></h4>
                                        <h4>{{__('profile.pendingitems')}}: <span class="badge badge-secondary">&nbsp;{{$pendingItemCount}}&nbsp;</span></h4>
                                        <h4>{{__('profile.pendingorders')}}: <span class="badge badge-danger">&nbsp;{{$undeliveredCount}}&nbsp;</span></h4>
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
                                            <span class="badge badge-success">{{__('profile.fulfilledorders')}}</span>
                                            <span class="badge badge-danger">{{__('profile.waiting')}}</span>
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
                                                <a href="/items/add" class="btn btn-success">{{__('profile.addnewitem')}}</a>
                                            </div>
                                        </div>
                                        @foreach($items as $item)
                                            <div class="card border-success text-dark shadow" style="width: 15rem;">
                                                <img class="card-img-top" src="{{asset($item->image)}}" alt="Card image cap">
                                                <div class="card-body" align="center">
                                                    <h5 class="card-title"><a href="/item/{{$item->id}}">{{$item->name}}</a></h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">Rs. {{$item->unit_price}}</h6>
                                                    <p class="card-text">{{$item->description}}</p>
                                                    <a href="/item/{{$item->id}}" class="btn btn-primary">{{__('profile.viewitem')}}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>{{__('profile.noitems')}}</p>
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
                                                    <a href="/item/{{$item->id}}" class="btn btn-primary">{{__('profile.viewitem')}}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>{{__('profile.noitems')}}</p>
                                @endif
                            @endif


                            @if($_GET['tab'] == 'cust_orders')

                                @if($_GET['fulfilled'] == 'true')
                                    @if(isset($fullfilledItems))
                                        <div class="col-md-12">
                                            <div class="list-group">
                                                <div class="list-group-item  flex-column align-items-start bg-success">
                                                    <div class="d-flex w-100 justify-content-center mb-2">
                                                        <h5 class="mb-1"><strong></strong>{{__('profile.fulfilledTitle')}}</h5>
                                                    </div>
                                                </div>
                                                @foreach($fullfilledItems as $orderline)
                                                    <div class="list-group-item  flex-column align-items-start">
                                                        <div class="d-flex w-100 justify-content-between mb-2">
                                                            <small>{{__('profile.orderlineid')}} #{{$orderline['orderline_id']}}</small>
                                                            <small>#{{$loop->iteration}}</small>
                                                        </div>
                                                        <div class="d-flex w-100 justify-content-between mb-2">
                                                            <h5 class="mb-1"><strong>{{$orderline['item_name']}}</strong></h5>
                                                            <small>{{__('profile.fulfilledon')}} <strong>{{date('d M Y',strtotime($orderline['updated_at']))}}</strong></small>
                                                        </div>
                                                        <h6>{{$orderline['cust_name']}}</h6>
                                                        <div class="d-flex w-100 justify-content-between mb-2">
                                                            <h6>{{$orderline['quantity']}} {{__('units')}}</h6>
                                                            <h4>Rs. {{number_format($orderline['total'],2)}}</h4>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <p>{{__('profile.noorders')}}</p>
                                    @endif

                                @else
                                    @if(isset($orderlines))
                                        <div class="col-md-12">
                                            <div class="list-group">
                                                <div class="list-group-item  flex-column align-items-start bg-warning">
                                                    <div class="d-flex w-100 justify-content-center mb-2">
                                                        <h5 class="mb-1"><strong>{{__('profile.customerOrdersTitle')}}</strong></h5>
                                                    </div>
                                                </div>
                                                @foreach($orderlines as $orderline)
                                                    <div class="list-group-item  flex-column align-items-start">
                                                        <div class="d-flex w-100 justify-content-between mb-2">
                                                            <small>{{__('profile.orderlineid')}} #{{$orderline['orderline_id']}}</small>
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
                                                            <button class="btn btn-outline-success" onclick="if(confirm('{{__('admindash.areyousure')}}'))fulfill('{{$orderline['orderline_id']}}')">{{__('profile.fulfill')}}</button>
                                                        </p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <p>{{__('profile.noorders')}}</p>
                                    @endif
                                @endif

                            @endif


                            @if($_GET['tab'] == 'summary')
                                @if(isset($purchases))
                                    <table class="table table-hover table-sm bg-white text-center" style="-webkit-filter: drop-shadow(1px 2px 2px #006c0e);">
                                        <thead>
                                        <tr>
                                            <th colspan="3">{{__('profile.purchases')}} ({{strtoupper(date('F'))}})</th>
                                        </tr>
                                        <tr>
                                            <th>{{__('profile.orderid')}}</th>
                                            <th>{{__('profile.date')}}</th>
                                            <th>{{__('profile.total')}}</th>
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
                                            <td colspan="2" class="text-right"><h4>{{__('cart.subtotal')}}</h4></td>
                                            <td><h4>Rs. {{number_format($purchaseTotal,2)}}</h4></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <p>{{__('profile.nopurchases')}}</p>
                                @endif

                                @if(isset($orderlines))
                                    <table class="table table-hover table-sm bg-white text-center" style="-webkit-filter: drop-shadow(1px 2px 2px #f4b200);">
                                        <thead>
                                        <tr>
                                            <th colspan="3">{{__('profile.itemssold')}} ({{strtoupper(date('F'))}}) (aggregated)</th>
                                        </tr>
                                        <tr>
                                            <th>{{__('profile.itemname')}}</th>
                                            <th>{{__('profile.quantity')}}</th>
                                            <th>{{__('profile.total')}}</th>
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
                                            <td colspan="2" class="text-right"><h4>{{__('cart.subtotal')}}</h4></td>
                                            <td><h4>Rs. {{number_format($orderlineTotal,2)}}</h4></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <p>{{__('profile.noitemssold')}}</p>
                                @endif
                            @endif

                            @if($_GET['tab'] == 'settings')
                                @if(isset($user))
                                    <div class="col-sm-12 mt-0 mb-2">
                                        @if(session()->has('passwordUpdate'))
                                            @if(session()->get('passwordUpdate') == true)
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{__('profile.pwdsuccessful')}}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            @if(session()->get('passwordUpdate') == false)
                                                <div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
                                                    {{__('profile.pwdfail')}}
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
                                                    <h4>{{__('profile.pwdTitle')}}</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>{{__('profile.currentpwd')}}</label>
                                                        <input type="password" name="password_old" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{__('profile.newpwd')}}</label>
                                                        <input type="password" name="password" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{__('profile.confirmpwd')}}</label>
                                                        <input type="password" name="password_confirmation" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="card-footer" align="center">
                                                    <input type="submit" class="btn btn-outline-primary" value="{{__('profile.update')}}">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="card shadow">
                                            <form action="/user/update" method="POST">
                                                <div class="card-header">
                                                    <h4>{{__('profile.detailTitle')}}</h4>
                                                </div>
                                                <div class="card-body">

                                                    {{csrf_field()}}
                                                    <div class="form-group row">
                                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('profile.name') }}</label>
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
                                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('profile.email') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('admindash.nic') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="nic" type="text" class="form-control" name="nic" value="{{ $user->nic }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('admindash.mobile') }}</label>
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
                                                        <label for="province" class="col-md-4 col-form-label text-md-right">{{ __('profile.province') }}</label>
                                                        <div class="col-md-6">
                                                            <select id="province" class="form-control{{ $errors->has('province') ? ' is-invalid' : '' }}" name="province" value="{{ $user->province }}"
                                                                    required>
                                                                <option>Central</option>
                                                                <option>Eastern</option>
                                                                <option>North Central</option>
                                                                <option>Northern</option>
                                                                <option>North Western</option>
                                                                <option>Sabaragamuwa</option>
                                                                <option>Southern</option>
                                                                <option>Uva</option>
                                                                <option>Western</option>
                                                            </select>
                                                            @if ($errors->has('province'))
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('province') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="district" class="col-md-4 col-form-label text-md-right">{{ __('profile.district') }}</label>
                                                        <div class="col-md-6">
                                                            <select id="district" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" name="district" value="{{ $user->district }}"
                                                                    required>
                                                                <option>Ampara</option>
                                                                <option>Anuradhapura</option>
                                                                <option>Badulla</option>
                                                                <option>Batticaloa</option>
                                                                <option>Colombo</option>
                                                                <option>Galle</option>
                                                                <option>Gampaha</option>
                                                                <option>Hambantota</option>
                                                                <option>Jaffna</option>
                                                                <option>Kalutara</option>
                                                                <option>Kandy</option>
                                                                <option>Kegalle</option>
                                                                <option>Kilinochchi</option>
                                                                <option>Kurunegala</option>
                                                                <option>Mannar</option>
                                                                <option>Matale</option>
                                                                <option>Matara</option>
                                                                <option>Moneragala</option>
                                                                <option>Mullaitivu</option>
                                                                <option>Nuwara Eliya</option>
                                                                <option>Polonnaruwa</option>
                                                                <option>Puttalam</option>
                                                                <option>Ratnapura</option>
                                                                <option>Trincomalee</option>
                                                                <option>Vavuniya</option>
                                                            </select>
                                                            @if ($errors->has('district'))
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('district') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('profile.city') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ $user->city }}"
                                                                   required>
                                                            @if ($errors->has('city'))
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('city') }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="st_address" class="col-md-4 col-form-label text-md-right">{{ __('profile.stddr') }}</label>
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
                                                    <button type="submit" class="btn btn-outline-primary">{{__('profile.update')}}</button>
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
                                                <h4>{{__('profile.profileImgTitle')}}</h4>
                                            </div>
                                            <div class="card-body">
                                                <input type="file" name="avatar" class="form-control-file" required>
                                            </div>
                                            <div class="card-footer" align="center">
                                                <input type="submit" class="btn btn-outline-primary" value="{{__('profile.update')}}">
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
                    alert('{{__('profile.fulfillsuccess')}}');
                    window.location.reload(true);
                }
                else {
                    alert('{{__('profile.fulfillfail')}}');
                }
            };
            ajax.send();

        }
    </script>

@endsection