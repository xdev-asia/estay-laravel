@extends('layouts.home_layout', ['static_data', $static_data])
@section('title')
    <title>{{$static_data['strings']['post'] .' - '. $post->contentload->title}}</title>
    <meta charset="UTF-8">
    <meta name="title" content="{{$static_data['strings']['post'] .' - '. $post->contentload->title}}">
    <meta name="description" content="{{ strip_tags(str_limit($post->contentload->content, 200)) }}">
    <meta name="keywords" content="{{ $static_data['site_settings']['site_keywords'] }}">
    <meta name="author" content="{{ $static_data['site_settings']['site_name'] }}">
    <meta property="og:title" content="{{$static_data['strings']['post'] .' - '. $post->contentload->title}}" />
    <meta property="og:image" content="{{ url('images/data').'/'.$post->image }}" />
    <meta property="og:description" content="{{ strip_tags(str_limit($post->contentload->content, 200)) }}" />
@endsection
<?php 
    $share_links = Share::load(Request::fullUrl(), $post->contentload->title)->services('facebook', 'gplus', 'twitter', 'pinterest', 'email', 'reddit', 'linkedin');
?>
@section('bg')
    {{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}
@endsection
@section('content')
    <div class="row  marginalized">
            <div class="col-sm-12">
            <h1 class="section-title-dark">{{ $post->contentload->title }}</h1>
            <p class="meta-data">@if($post->user){{ $static_data['strings']['posted_by'].': '.$post->user->username}} @endif {{' | '.$post->created_at }}</p>
            <div class="row">
                <div class="post-image col-md-4 col-sm-12">
                    <img class="img-fluid" src="{{$post->image }}"/>
                </div>
                <div class="col-md-8 col-sm-12">{!! $post->contentload->content !!}</div>
                <div class="col-sm-12">
                    <div class="social-buttons">
                        <h3 class="section-type">{{ $static_data['strings']['share'] }} - {{ $post->contentload->title }}</h3>
                        <a href="{{ $share_links['facebook'] }}" target="_blank" class="primary-color"><i class="fa fa-facebook-official"></i></a>
                        <a href="{{ $share_links['twitter'] }}" target="_blank" class="primary-color"> <i class="fa fa-twitter-square"></i></a>
                        <a href="{{ $share_links['gplus'] }}" target="_blank" class="primary-color"><i class="fa fa-google-plus-square"></i></a>
                        <a href="{{ $share_links['pinterest'] }}" target="_blank" class="primary-color"><i class="fa fa-pinterest-square"></i></a>
                        <a href="{{ $share_links['reddit'] }}" target="_blank" class="primary-color"><i class="fa fa-reddit-square"></i></a>
                        <a href="{{ $share_links['linkedin'] }}" target="_blank" class="primary-color"><i class="fa fa-linkedin-square"></i></a>
                        <a href="{{ $share_links['email'] }}" target="_blank" class="primary-color"><i class="fa fa-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection