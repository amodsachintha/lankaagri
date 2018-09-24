@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('layout.register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('profile.name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('profile.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('auth.nic') }}</label>

                            <div class="col-md-6">
                                <input id="nic" type="text" class="form-control{{ $errors->has('nic') ? ' is-invalid' : '' }}" name="nic" value="{{ old('nic') }}" required>

                                @if ($errors->has('nic'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('admindash.mobile') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required>

                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="province" class="col-md-4 col-form-label text-md-right">{{ __('profile.province') }}</label>

                            <div class="col-md-6">
                                <select id="province"  class="form-control{{ $errors->has('province') ? ' is-invalid' : '' }}" name="province" value="{{ old('province') }}" required>
                                    <option value="Central">{{__('provinces.central')}}</option>
                                    <option value="Eastern">{{__('provinces.eastern')}}</option>
                                    <option value="North Central">{{__('provinces.northcentral')}}</option>
                                    <option value="Northern">{{__('provinces.northern')}}</option>
                                    <option value="North Western">{{__('provinces.northwestern')}}</option>
                                    <option value="Sabaragamuwa">{{__('provinces.sabaragamuwa')}}</option>
                                    <option value="Southern">{{__('provinces.sabaragamuwa')}}</option>
                                    <option value="Uva">{{__('provinces.uva')}}</option>
                                    <option value="Western">{{__('provinces.western')}}</option>
                                </select>
                                @if ($errors->has('province'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('province') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">{{ __('profile.district') }}</label>

                            <div class="col-md-6">
                                <select id="district" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" name="district" value="{{ old('district') }}" required>
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
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('profile.city') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" required>
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="st_address" class="col-md-4 col-form-label text-md-right">{{ __('profile.stddr') }}</label>

                            <div class="col-md-6">
                                <input id="st_address" type="text" class="form-control{{ $errors->has('st_address') ? ' is-invalid' : '' }}" name="st_address" value="{{ old('st_address') }}" required>
                                @if ($errors->has('st_address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('st_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('auth.pwd') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('profile.confirmpwd') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('layout.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
