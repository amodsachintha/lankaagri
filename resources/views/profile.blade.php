@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic" align="center">
                        <img src="http://placehold.it/400x400" class="img-responsive" alt="">
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
                            <li class="list-group-item active">
                                <a href="#">
                                    <i class="glyphicon glyphicon-home"></i>
                                    Overview </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Account Settings </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" target="_blank">
                                    <i class="glyphicon glyphicon-ok"></i>
                                    Tasks </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">
                                    <i class="glyphicon glyphicon-flag"></i>
                                    Help </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    Some user related content goes here...
                </div>
            </div>
        </div>
    </div>
@endsection