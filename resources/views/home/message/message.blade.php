@extends('layouts.home_layout', ['static_data', $static_data])
@section('title')
    <title>{{$static_data['strings']['message']}} - {{ $static_data['site_settings']['site_name'] }}</title>
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
    <div class="row  marginalized">
        <div class="col-sm-12">
            <h1 class="section-title-dark">{{$static_data['strings']['write_your_message']}}</h1>
        </div>
        <div class="col-sm-12">
            {!! Form::open(['method' => 'post', 'url' => route('message_reply', $thread->id)]) !!}
            <div class="form-group">
                {!! Form::textarea('message', null, ['class' => 'form-control', 'required', 'placeholder' => $static_data['strings']['write_your_message']]) !!}
            </div>
                        <button type="submit" name="action" class="primary-button">{{ $static_data['strings']['reply'] }}</button>
            {!! Form::close() !!}
        </div>
        <div class="col-sm-12">
            <h1 class="section-title-dark">{{$static_data['strings']['messages']}}</h1>
        </div>
        <div class="col-sm-12">
            <div id="messages">
                @foreach($messages as $message)
                    <div class="message {{ $message->user ? 'owner-message' : 'user-message' }} ">{{ $message->message }}</div>
                @endforeach  
            </div>
        </div>
    </div>
@endsection