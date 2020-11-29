@extends('layouts.home_explore', ['static_data', $static_data])
<?php $max_price = get_setting('price_range_max', 'property') ?>
@section('title')
    <title>{{$static_data['strings']['explore'] .' - '. $static_data['strings']['services']}}</title>
    <meta name="title" content="{{$static_data['strings']['explore'] .' - '. $static_data['strings']['services']}}">
    <meta name="description" content="{{$static_data['strings']['services']}}">
    <meta name="keywords" content="{{ $static_data['site_settings']['site_keywords'] }}">
    <meta name="author" content="{{ $static_data['site_settings']['site_name'] }}">
    <meta property="og:title" content="{{$static_data['strings']['explore'] .' - '. $static_data['strings']['services']}}" />
    <meta property="og:image" content="{{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}" />
@endsection
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/jquery-ui.min.css') }}">
@endsection
@section('content')
    @if(count($services))
        <div class="col-sm-12">
            <h3 class="section-type text-uppercase">{{ $static_data['strings']['services'] }}</h3>
        </div>
        <div class="col-sm-12 filter-box">
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
            <a href="#" class="primary-button property-filter">{{$static_data['strings']['search']}}</a>
        </div>
        @if(isset($featured_services))
            <div id="half-map-featured" class="col-sm-12 items-grid">
                @foreach($featured_services as $service)
                    <div class="item box-shadow" data-id="{{ $service->id }}">
                        <div id="carousel-_{{$service->id}}" class="main-image bg-overlay carousel slide" data-ride="carousel" data-interval="false">
                            <div class="featured-sign">
                                {{ $static_data['strings']['featured'] }}
                            </div>
                            @if(count($service->images))
                            <div class="carousel-inner" role="listbox">
                                <?php $c = 0; ?>
                                @foreach($service->images as $image)
                                    <div class="carousel-item @if(!$c) active <?php $c++; ?> @endif">
                                        <img class="responsive-img" src="{{ URL::asset('images/data').'/'.$image->image }}"/>
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carousel-_{{$service->id}}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">{{$static_data['strings']['previous']}}</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-_{{$service->id}}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">{{$static_data['strings']['next']}}</span>
                            </a>
                            @else
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img class="responsive-img" src="{{ URL::asset('images/').'/no_image.jpg' }}"/>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="data">
                            <a href="{{url('/service').'/'.$service->alias}}"><h3 class="item-title primary-color">{{ $service->contentload->name }}</h3></a>
                            <div class="item-category">{{$service->location['address'].', '.$service->location['city'] .' - '. $service->location['country']}}</div>
                            <div class="item-category">{{ $static_data['strings']['category'] .': '. $service->category->contentload->name .' | ' }}
                                {{ $static_data['strings']['location'] .': '. $service->ser_location->contentload->location }}</div>
                            @if($service->user)<div class="small-text">{{ $static_data['strings']['posted_by'] .': '. $service->user->username }}</div>@endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div id="filtered-services" class="row">
            @foreach($services as $service)
                <div class="col-md-6 col-sm-6 items-grid">
                    <div class="item box-shadow" data-id="{{ $service->id }}">
                        <div id="carousel-{{$service->id}}" class="main-image bg-overlay carousel slide" data-ride="carousel" data-interval="false">
                            @if($service->featured)
                                <div class="featured-sign">
                                    {{ $static_data['strings']['featured'] }}
                                </div>
                            @endif
                            @if(count($service->images))
                                <div class="carousel-inner" role="listbox">
                                    <?php $c = 0; ?>
                                    @foreach($service->images as $image)
                                        <div class="carousel-item @if(!$c) active <?php $c++; ?> @endif">
                                            <img class="responsive-img" src="{{ URL::asset('images/data').'/'.$image->image }}"/>
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carousel-{{$service->id}}" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">{{$static_data['strings']['previous']}}</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-{{$service->id}}" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">{{$static_data['strings']['next']}}</span>
                                </a>
                            @else
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img class="responsive-img" src="{{ URL::asset('images/').'/no_image.jpg' }}"/>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="data">
                            <a href="{{url('/service').'/'.$service->alias}}"><h3 class="item-title primary-color">{{ $service->contentload->name }}</h3></a>
                            <div class="item-category">{{$service->location['address'].', '.$service->location['city'] .' - '. $service->location['country']}}</div>
                            <div class="item-category">{{ $static_data['strings']['category'] .': '. $service->category->contentload->name .' | ' }}
                                {{ $static_data['strings']['location'] .': '. $service->ser_location->contentload->location }}</div>
                            <div class="small-text">{{ $static_data['strings']['posted_by'] .': '. $service->user->username }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-sm-12 mtop5 text-centered"><a href="#" class="black-button load-more-services">{{ $static_data['strings']['load_more'] }}</a><img src="{{URL::asset('assets/images/ajax-loader.gif')}}" class="ajax-loader"/></div>
    @else
        @if(!count($services))<div class="col-sm-12 text-centered"><strong class="center-align">{{$static_data['strings']['no_results']}}</strong></div>@endif
    @endif
@endsection
@section('footer')
    <input type="hidden" class="hidden token" value="{{ csrf_token() }}"/>
    <input type="hidden" class="hidden" name="isExplore" value="1"/>
    <script src="{{URL::asset('assets/js/plugins/nouislider.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/plugins/jquery-ui.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{$static_data['site_settings']['google_map_key']}}&libraries=places"></script>
    <script src="{{URL::asset('assets/js/plugins/richmarkers.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/plugins/clusters.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            // Load more services
            var page_service = 4;
            $('.load-more-services').click(function(e){
                var $this = $(this);
                var ajax_loader = $(this).parent().find('.ajax-loader');
                e.preventDefault();
                $.ajax({
                    url: '{{ url('explore') .'/getservices?page=' }}' + page_service,
                    beforeSend: function(){
                        $this.hide(); ajax_loader.show();
                        $('#google-map').addClass('loading');
                    }
                }).done(function(data){
                    $('#google-map').removeClass('loading');
                    if(data){$this.show();$('#filtered-services').append(data);}else{$('#filtered-services').append('<div class="col-sm-12 info-message text-centered">{{$static_data['strings']['no_results']}}</div>');setTimeout(function(){$('.info-message').slideUp()}, 2000);}
                    page_service++;
                    ajax_loader.hide();
                    mapClusters.clearMarkers();
                    var options = {
                        imagePath: '/images/home/icons/m'
                    };
                    mapClusters = new MarkerClusterer(map, allmarkers, options);
                });
            });

            // Property Filter
            $('.property-filter').click(function(e){
                e.preventDefault();
                var parent = $(this).parent(),
                        token = $('.token').val(),
                        location_id = $('[name="location_id"]').val(),
                        category_id = $('[name="category_id"]').val();
                $.ajax({
                    url: '{{ url('filter') }}/services',
                    type: 'post',
                    data: {isExplore: 1,_token: token,location_id: location_id, category_id: category_id},
                    beforeSend: function(){
                        parent.addClass('loading');
                        $('#google-map').addClass('loading');
                        removeMarkers();
                    }
                }).done(function(data){
                    parent.removeClass('loading');
                    $('#google-map').removeClass('loading');
                    $('.load-more-services').hide();
                    if(data){$('#filtered-services').html(data);}else{$('#filtered-services').html('<div class="col-sm-12 info-message text-centered">{{$static_data['strings']['no_results']}}</div>');}
                    @if($featured_markers)
                        fmarkers = [];
                        for(var i = 0; i < featured_markers.length; i++ ) {
                            addMarkerToMap(featured_markers[i][0], featured_markers[i][1], featured_infoWindowContent[i], 'services');
                        }
                    @endif
                    var target = $('#filtered-services');
                    $('html, body').animate({
                        scrollTop: target.offset().top - 150
                    }, 1000);
                    var options = {
                        imagePath: '/images/home/icons/m'
                    };
                    mapClusters = new MarkerClusterer(map, allmarkers, options);
                });
            });

            // Datepickers
            $('.start_date-picker').datepicker({
                dateFormat: 'dd/mm/yy',
                minDate: 0,
                onSelect: function(dateText, inst) {
                    var startDate = $(this).datepicker('getDate');
                    startDate.setDate(startDate.getDate() + 1);
                    $("[name='start_date']").val(dateText);
                    $("[name='end_date']").removeAttr('disabled');
                    $('.end_date-picker').datepicker({
                        dateFormat: 'dd/mm/yy',
                        minDate: startDate,
                        onSelect: function(dateText, inst) {
                            $("[name='end_date']").val(dateText);
                        }
                    });
                }
            });

            // Load price range
            price_range({{ $max_price }});

            var markers = [@foreach ($markers as $marker)[{{$marker['geo_lon']}}, {{$marker['geo_lat']}}], @endforeach],
                    infoWindowContent = [@foreach ($services as $service)[{"id" : "{{$service->id}}","alias":"{{ $service->alias }}","name":{!! json_encode($service->contentload->name) !!},"address":"{{ $service->location['address'] }}" ,"city":"{{ $service->location['city'] }}" ,"country":"{{ $service->location['country'] }}" ,"phone":"{{ $service->contact['tel1'] }}", "icon":"{{ $service->category->map_icon }}", "featured":"{{ $service->featured }}", "image":@if(count($service->images))"{{ $service->images[0]->image }}" @else "no_image.jpg" @endif}], @endforeach], map_lon = {{ $static_data['site_settings']['contact_map_lon'] }}, map_lat = {{ $static_data['site_settings']['contact_map_lat'] }};

            explore_map(map_lat, map_lon, markers, infoWindowContent, 'service');

            @if($featured_markers)
                var featured_markers = [@foreach ($featured_markers as $marker)[{{$marker['geo_lon']}}, {{$marker['geo_lat']}}], @endforeach],
                        featured_infoWindowContent = [@foreach ($featured_services as $service)[{"id" : "{{$service->id}}","alias":"{{ $service->alias }}","name":{!! json_encode($service->contentload->name) !!},"address":"{{ $service->location['address'] }}" ,"city":"{{ $service->location['city'] }}" ,"country":"{{ $service->location['country'] }}" ,"phone":"{{ $service->contact['tel1'] }}", "icon":"{{ $service->category->map_icon }}", "featured":"{{ $service->featured }}", "image":@if(count($service->images))"{{ $service->images[0]->image }}" @else "no_image.jpg" @endif}], @endforeach];
                for(i = 0; i < featured_markers.length; i++ ) {
                    addMarkerToMap(featured_markers[i][0], featured_markers[i][1], featured_infoWindowContent[i], 'service');
                }
            @endif
        });
    </script>
@endsection