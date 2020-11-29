@extends('layouts.home_layout', ['static_data', $static_data])
<?php $max_price = get_setting('price_range_max', 'property') ?>
@section('title')
    <title>{{$static_data['strings']['search_results']}}</title>
    <meta charset="UTF-8">
    <meta name="title" content="{{ $static_data['site_settings']['site_name'] }}">
    <meta name="description" content="{{ $static_data['site_settings']['site_description'] }}">
    <meta name="keywords" content="{{ $static_data['site_settings']['site_keywords'] }}">
    <meta name="author" content="{{ $static_data['site_settings']['site_name'] }}">
    <meta property="og:title" content="{{ $static_data['site_settings']['site_name'] }}" />
    <meta property="og:image" content="{{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}" />
@endsection
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/jquery-ui.min.css') }}">
@endsection
@section('bg')
    {{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}
@endsection
@section('content')
    <div class="row header-tabs">
        <div class="col-sm-12">
            <ul class="nav nav-tabs" id="header-tabs">
                @if(isset($properties) && count($properties))<li class="nav-item"><a class="nav-link active" href="#accordion-properties" data-toggle="tab" aria-expanded="true"><i class="fa fa-building-o"></i><span>{{ $static_data['strings']['properties'] }}</span></a></li>@endif
                @if(isset($services) && count($services))<li class="nav-item"><a class="nav-link @if(!count($properties)) active @endif" href="#accordion-services" data-toggle="tab" aria-expanded="false"><i class="fa fa-cutlery"></i><span>{{ $static_data['strings']['services'] }}</span></a></li>@endif
            </ul>
        </div>
    </div>
    <div class="row marginalized">
        <div class="col-sm-12">
            <h1 class="section-title-dark">{{$static_data['strings']['search_results']}}</h1>
            <div class="tab-content">
                <div class="tab-pane active" id="accordion-properties" role="tabpanel">
                    <div class="row">
                        @if(count($properties))
                            <div class="col-sm-12">
                                <h3 class="section-type text-uppercase">{{ $static_data['strings']['properties'] }}</h3>
                            </div>
                            <div class="col-sm-12 filter-box">
                                {!! Form::open(['method' => 'post', 'url' => route('search')]) !!}
                                    <div class="form-group not-after">
                                        <div class="input-group">
                                            <span class="fa fa-font input-group-addon"></span>
                                            <input type="text" value="" name="keyword" class="form-control slider-field" placeholder="{{$static_data['strings']['keywords']}} ...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="fa fa-map-marker input-group-addon"></span>
                                            <input type="text" readonly name="location_id_value" class="form-control filter-field" placeholder="{{$static_data['strings']['choose_your_location']}}">
                                        </div>
                                        <input type="hidden" name="location_id" value="0" class="form-control filter-hidden hidden" placeholder="{{$static_data['strings']['choose_your_location']}}">
                                        <ul class="dropdown-filter-menu">
                                            <li data-id="" data-name="{{ $static_data['strings']['all'] }}">
                                                <a href="#" class="location_id_picker">
                                                    <span>{{ $static_data['strings']['all'] }}</span>
                                                </a>
                                            </li>
                                            @foreach($static_data['locations'] as $location)
                                                <li data-id="{{ $location->id }}" data-name="{{ $location->contentload->location }}">
                                                    <a href="#" class="location_id_picker">
                                                        <span>{{ $location->contentload->location }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="fa fa-map-marker input-group-addon"></span>
                                            <input type="text" readonly name="category_id_value" class="form-control filter-field" placeholder="{{$static_data['strings']['choose_your_category']}}">
                                        </div>
                                        <input type="hidden" name="category_id" value="0" class="form-control filter-hidden hidden" placeholder="{{$static_data['strings']['choose_your_category']}}">
                                        <ul class="dropdown-filter-menu">
                                            <li data-id="" data-name="{{ $static_data['strings']['all'] }}">
                                                <a href="#" class="category_id_picker">
                                                    <span>{{ $static_data['strings']['all'] }}</span>
                                                </a>
                                            </li>
                                            @foreach($static_data['categories'] as $category)
                                                <li data-id="{{ $category->id }}" data-name="{{ $category->contentload->name }}">
                                                    <a href="#" class="category_id_picker">
                                                        <span>{{ $category->contentload->name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <button type="submit" class="primary-button"><i class="fa fa-search"></i> {{$static_data['strings']['search']}}</button>
                                {!! Form::close() !!}
                            </div>
                            <div id="filtered-properties" class="row">
                                @foreach($properties as $property)
                                    
                                    @include('home.partials.property')

                                @endforeach
                            </div>
                        @else
                            @if(!count($properties) && !count($services))<div class="col-sm-12 text-centered"><strong class="center-align">{{$static_data['strings']['no_results']}}</strong></div>@endif
                        @endif
                    </div>
                </div>
                @if(get_setting('services_allowed', 'service'))
                    <div class="tab-pane @if(!count($properties)) active @endif" id="accordion-services" role="tabpanel">
                        <div class="row">
                            @if(isset($services) && count($services))
                                <div class="col-sm-12 mbot10"><h3 class="section-type text-uppercase">{{ $static_data['strings']['services'] }}</h3></div>
                                <div class="col-sm-12 filter-box">
                                    {!! Form::open(['method' => 'post', 'url' => route('search')]) !!}
                                    <div class="form-group not-after">
                                        <div class="input-group">
                                            <span class="fa fa-font input-group-addon"></span>
                                            <input type="text" value="" name="keyword" class="form-control slider-field" placeholder="{{$static_data['strings']['keywords']}} ...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="fa fa-map-marker input-group-addon"></span>
                                            <input type="text" readonly name="location_id_value" class="form-control filter-field" placeholder="{{$static_data['strings']['choose_your_location']}}">
                                        </div>
                                        <input type="hidden" name="location_id" value="0" class="form-control filter-hidden hidden" placeholder="{{$static_data['strings']['choose_your_location']}}">
                                        <ul class="dropdown-filter-menu">
                                            <li data-id="" data-name="{{ $static_data['strings']['all'] }}">
                                                <a href="#" class="location_id_picker">
                                                    <span>{{ $static_data['strings']['all'] }}</span>
                                                </a>
                                            </li>
                                            @foreach($static_data['locations'] as $location)
                                                <li data-id="{{ $location->id }}" data-name="{{ $location->contentload->location }}">
                                                    <a href="#" class="location_id_picker">
                                                        <span>{{ $location->contentload->location }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="fa fa-map-marker input-group-addon"></span>
                                            <input type="text" readonly name="category_id_value" class="form-control filter-field" placeholder="{{$static_data['strings']['choose_your_category']}}">
                                        </div>
                                        <input type="hidden" name="category_id" value="0" class="form-control filter-hidden hidden" placeholder="{{$static_data['strings']['choose_your_category']}}">
                                        <ul class="dropdown-filter-menu">
                                            <li data-id="" data-name="{{ $static_data['strings']['all'] }}">
                                                <a href="#" class="category_id_picker">
                                                    <span>{{ $static_data['strings']['all'] }}</span>
                                                </a>
                                            </li>
                                            @foreach($static_data['categories'] as $category)
                                                <li data-id="{{ $category->id }}" data-name="{{ $category->contentload->name }}">
                                                    <a href="#" class="category_id_picker">
                                                        <span>{{ $category->contentload->name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <button type="submit" class="primary-button"><i class="fa fa-search"></i> {{$static_data['strings']['search']}}</button>
                                    {!! Form::close() !!}
                                </div>
                        </div>
                        <div class="row" id="filtered-services">
                            @foreach($services as $service)
                                @include('home.partials.service_grid')
                            @endforeach
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection