@extends('layouts.home_layout', ['static_data', $static_data])
@section('title')
    <title>{{$static_data['strings']['resend_activation_mail']}} - {{ $static_data['site_settings']['site_name'] }}</title>
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
        <div class="col-sm-12"><h1 class="section-title-dark">{{$static_data['strings']['resend_activation_mail']}}</h1></div>
        <div class="col-sm-12 col-md-8 input-style">
            @if (Session::has('notFoundEmail'))
                <p class="section-subtitle-light text-centered red-color"><strong>{{ $static_data['strings']['wrong_email'] }}</strong></p>
            @endif
            {!! Form::open(['method' => 'post', 'url' => route('resend_activation')]) !!}
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
                <div class="col-sm-12 text-centered">
                    <button type="submit" name="action" class="primary-button">{{ $static_data['strings']['submit'] }}</button>
                </div>
                <div class="col-sm-12 text-centered mtop20">
                    <a href="{{ route('login') }}"> {{ $static_data['strings']['login'] }}</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection