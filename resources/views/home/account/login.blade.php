@extends('layouts.home_layout', ['static_data', $static_data])
@section('title')
    <title>{{$static_data['strings']['login']}} - {{ $static_data['site_settings']['site_name'] }}</title>
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
            <h1 class="section-title-dark">{{$static_data['strings']['login']}}</h1>
            @if (Session::has('activationSuccess'))
                <p class="section-subtitle-light text-centered green-color"><strong>{{ $static_data['strings']['account_successfully_activated'] }}</strong></p>
            @endif
            @if (Session::has('activationStatus'))
                <p class="section-subtitle-light text-centered green-color"><strong>{{ $static_data['strings']['activation_mail_sent'] }}</strong></p>
            @endif
            @if (Session::has('activationWarning'))
                <p class="section-subtitle-light text-centered red-color"><strong>{{ $static_data['strings']['please_activate_account_first'] }}</strong></p>
            @endif
        </div>
        <div class="col-sm-12 col-md-8 input-style user-action-form">
            {!! Form::open(['method' => 'post', 'url' => route('login')]) !!}
            <div class="row">
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
                <div class="col-sm-12">
                    <div class="form-group  {{$errors->has('password') ? 'has-error' : ''}}">
                        <div class="input-group">
                            <span class="fa fa-key input-group-addon"></span>
                            {{Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => $static_data['strings']['password']])}}
                        </div>
                        @if($errors->has('password'))
                            <span class="wrong-error">* {{$errors->first('password')}}</span>
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
                <div class="col-sm-12 text-centered clearfix">
                    <button type="submit" name="action" class="primary-button">{{ $static_data['strings']['submit'] }}</button>
                </div>
                <div class="col-sm-12 text-centered mtop20">
                    <a href="{{ route('reset_password') }}"> {{ $static_data['strings']['forgot_password'] }} |</a>
                    <a href="{{ route('resend_activation_mail') }}"> {{ $static_data['strings']['resend_activation_mail'] }} </a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection