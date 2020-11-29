@extends('layouts.home_layout', ['static_data', $static_data])
@section('title')
    <title>{{$static_data['strings']['register']}} - {{ $static_data['site_settings']['site_name'] }}</title>
    <meta charset="UTF-8">
    <meta name="title" content="{{ $static_data['site_settings']['site_name'] }}">
    <meta name="description" content="{{ $static_data['site_settings']['site_description'] }}">
    <meta name="keywords" content="{{ $static_data['site_settings']['site_keywords'] }}">
    <meta name="author" content="{{ $static_data['site_settings']['site_name'] }}">
    <meta property="og:title" content="{{ $static_data['site_settings']['site_name'] }}" />
    <meta property="og:image" content="{{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}" />
@endsection
@section('bg')
    {{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}
@endsection
@section('content')
    <div class="row  marginalized justify-content-center">
        <div class="col-sm-12">
            <h1 class="section-title-dark">{{$static_data['strings']['register']}}</h1>
        </div>
        <div class="col-sm-12 col-md-8 input-style user-action-form">
            {!! Form::open(['method' => 'post', 'url' => url('/register')]) !!}
            <div class="row">
                <div class="col-sm-12"><p class="section-subtitle-light text-centered"> {{ $static_data['strings']['please_fill_all_fields'] }} </p></div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group  {{$errors->has('first_name') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-address-card-o input-group-addon"></span>
                            {{Form::text('first_name', null, ['class' => 'form-control', 'required', 'placeholder' => $static_data['strings']['first_name']])}}
                        </div>
                        @if($errors->has('first_name'))
                            <span class="wrong-error">* {{$errors->first('first_name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group  {{$errors->has('last_name') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-address-card-o input-group-addon"></span>
                            {{Form::text('last_name', null, ['class' => 'form-control', 'required', 'placeholder' => $static_data['strings']['last_name']])}}
                        </div>
                        @if($errors->has('last_name'))
                            <span class="wrong-error">* {{$errors->first('last_name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group  {{$errors->has('username') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-user input-group-addon"></span>
                            {{Form::text('username', null, ['class' => 'form-control', 'required', 'placeholder' => $static_data['strings']['username']])}}
                        </div>
                        @if($errors->has('username'))
                            <span class="wrong-error">* {{$errors->first('username')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group  {{$errors->has('phone') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-phone input-group-addon"></span>
                            {{Form::text('phone', null, ['class' => 'form-control', 'required', 'placeholder' => $static_data['strings']['phone']])}}
                        </div>
                        @if($errors->has('phone'))
                            <span class="wrong-error">* {{$errors->first('phone')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group  {{$errors->has('email') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-envelope input-group-addon"></span>
                            {{Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => $static_data['strings']['email_address']])}}
                        </div>
                        @if($errors->has('email'))
                            <span class="wrong-error">* {{$errors->first('email')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group  {{$errors->has('password') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-key input-group-addon"></span>
                            {{Form::password('password', ['class' => 'form-control', 'placeholder' => $static_data['strings']['password']])}}
                        </div>
                        @if($errors->has('password'))
                            <span class="wrong-error">* {{$errors->first('password')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group  {{$errors->has('password_confirmation') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-key input-group-addon"></span>
                            {{Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => $static_data['strings']['password_confirmation']])}}
                        </div>
                        @if($errors->has('password_confirmation'))
                            <span class="wrong-error">* {{$errors->first('password_confirmation')}}</span>
                        @endif
                    </div>
                </div>
                @if(get_setting('login_with_facebook', 'user'))
                <div class="col-md-6 col-sm-12  social-btn">
                    <a href="{{ route('facebook_redirect') }}" class="facebook-btn"><i class="fa fa-facebook"></i> {{ $static_data['strings']['login_with_facebook'] }}</a>
                </div>
                @endif
                @if(get_setting('login_with_google_plus', 'user'))
                <div class="col-md-6 col-sm-12  social-btn">
                    <a href="{{ route('google_redirect') }}" class="google-btn"><i class="fa fa-google-plus"></i> {{ $static_data['strings']['login_with_google'] }}</a>
                </div>
                @endif
                @if(get_setting('register_owner_directly', 'owner'))
                <div class="col-md-6 col-sm-12">
                    <div class="form-group  {{$errors->has('register_owner') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-building input-group-addon"></span>
                            {{Form::select('register_owner', [0 => $static_data['strings']['no'], 1 => $static_data['strings']['yes']], null, ['class' => 'form-control', 'placeholder' => $static_data['strings']['register_as_owner']])}}
                        </div>
                        @if($errors->has('register_owner'))
                            <span class="wrong-error">* {{$errors->first('register_owner')}}</span>
                        @endif
                    </div>
                </div>
                @endif
                <div class="col-sm-12 text-centered">
                    <button type="submit" name="action" class="primary-button">{{ $static_data['strings']['submit'] }}</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection