@extends('layouts.home_layout', ['static_data', $static_data])
@section('title')
    <title>{{$static_data['strings']['blog']}} - {{ $static_data['site_settings']['site_name'] }}</title>
    <meta charset="UTF-8">
    <meta name="title" content="{{$static_data['strings']['blog']}} - {{ $static_data['site_settings']['site_name'] }}">
    <meta name="description" content="{{ $static_data['site_settings']['site_description'] }}">
    <meta name="keywords" content="{{ $static_data['site_settings']['site_keywords'] }}">
    <meta name="author" content="{{ $static_data['site_settings']['site_name'] }}">
    <meta property="og:title" content="{{$static_data['strings']['blog']}} - {{ $static_data['site_settings']['site_name'] }}" />
    <meta property="og:image" content="{{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}" />
@endsection
@section('bg')
    {{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}
@endsection
@section('content')
    <div class="row  marginalized">
        <div class="col-sm-12">
            <h1 class="section-title-dark">{{$static_data['strings']['blog']}}</h1>
            <div class="row">
            @if($posts->count())
                @foreach($posts as $post)
                    <div class="items-grid col-md-4 col-sm-12">
                        <div class="item box-shadow">
                            <div class="main-image bg-overlay">
                                <img class="responsive-img" src="{{ url('/').$post->image }}"/>
                            </div>
                            <div class="data">
                                <a href="{{url('/blog/post').'/'.$post->alias}}"><h3 class="item-title primary-color">{{$post->contentload->title}}</h3></a>
                                <div class="item-category">{!! str_limit(strip_tags($post->contentload->content), 120)  !!}</div>
                                @if($post->user)<div class="small-text">{{$static_data['strings']['posted_by']}} : {{$post->user->username}} | {{$post->created_at}}</div>@endif
                            </div>
                        </div>
                    </div>
                @endforeach
                {{$posts->links()}}
                @else
                    <div class="col-sm-12"><strong class="center-align">{{$static_data['strings']['no_results']}}</strong></div>
                @endif
            </div>
        </div>
    </div>
@endsection