@extends('layouts.home_explore', ['static_data', $static_data])
<?php $max_price = get_setting('price_range_max', 'property') ?>
@section('title')
    <title>{{$static_data['strings']['explore'] .' - '. $static_data['strings']['properties']}}</title>
    <meta name="title" content="{{$static_data['strings']['explore'] .' - '. $static_data['strings']['services']}}">
    <meta name="description" content="{{$static_data['strings']['properties']}}">
    <meta name="keywords" content="{{ $static_data['site_settings']['site_keywords'] }}">
    <meta name="author" content="{{$static_data['strings']['explore'] .' - '. $static_data['strings']['services']}}">
    <meta property="og:title" content="{{$static_data['strings']['properties']}}" />
    <meta property="og:image" content="{{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}" />
@endsection
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/jquery-ui.min.css') }}">
@endsection
@section('content')
    @if(count($properties))
        <div class="col-sm-12">
            <h3 class="section-type text-uppercase">{{ $static_data['strings']['properties'] }}</h3>
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
            <div class="form-group">
                <div class="input-group">
                    <span class="fa fa-user-o input-group-addon"></span>
                    <input type="text" readonly name="guest_number_value" value="" class="form-control filter-field" placeholder="{{$static_data['strings']['guests_number']}}">
                </div>
                <input type="hidden" name="guest_number" value="0" class="form-control filter-hidden hidden" placeholder="{{$static_data['strings']['choose_your_category']}}">
                <ul class="dropdown-filter-menu">
                    @for ($i = 1; $i <= get_setting('guest_number_max','property'); $i++)
                        <li data-number="{{$i}}">
                            <a href="#" class="guest_number_picker">
                                <span>{{ $i }}</span>
                            </a>
                        </li>
                    @endfor
                </ul>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="fa fa-building-o input-group-addon"></span>
                    <input type="text" readonly name="rooms_value" class="form-control filter-field" placeholder="{{$static_data['strings']['rooms_number']}}">
                </div>
                <input type="hidden" name="rooms" value="0" class="form-control filter-hidden hidden" placeholder="{{$static_data['strings']['choose_your_category']}}">
                <ul class="dropdown-filter-menu">
                    @for ($i = 1; $i <= get_setting('rooms_number_max','property'); $i++)
                        <li data-number="{{$i}}">
                            <a href="#" class="room_number_picker">
                                <span>{{ $i }}</span>
                            </a>
                        </li>
                    @endfor
                </ul>
            </div>
            <div class="form-group not-after">
                <div class="input-group">
                    <span class="fa fa-calendar input-group-addon"></span>
                    <input type="text" name="start_date" class="form-control start_date-picker filter-field" placeholder="{{$static_data['strings']['checking_in']}}">
                </div>
            </div>
            <div class="form-group not-after">
                <div class="input-group">
                    <span class="fa fa-calendar input-group-addon"></span>
                    <input type="text" disabled name="end_date" class="form-control end_date-picker filter-field" placeholder="{{$static_data['strings']['checking_out']}}">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="fa fa-sort input-group-addon"></span>
                    <input type="text" readonly name="sort_id_value" class="form-control filter-field" placeholder="{{$static_data['strings']['sort_results']}}">
                </div>
                <input type="hidden" name="sort_id" value="0" class="form-control filter-hidden hidden" placeholder="{{$static_data['strings']['sort_results']}}">
                <ul class="dropdown-filter-menu">
                    <li data-id="0" data-name="{{ $static_data['strings']['default'] }}">
                        <a href="#" class="sort_id_picker">
                            <span>{{ $static_data['strings']['default'] }}</span>
                        </a>
                    </li>
                    <li data-id="1" data-name="{{ $static_data['strings']['price_asc'] }}">
                        <a href="#" class="sort_id_picker">
                            <span>{{ $static_data['strings']['price_asc'] }}</span>
                        </a>
                    </li>
                    <li data-id="2" data-name="{{ $static_data['strings']['price_desc'] }}">
                        <a href="#" class="sort_id_picker">
                            <span>{{ $static_data['strings']['price_desc'] }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="form-group not-after price-range">
                <p>{{$static_data['strings']['price_range']}}: <span class="min">0</span> -  <span class="max">{{get_setting('price_range_max', 'property')}}</span>{{ userCurrencySymbol() }}</p>
                <input type="hidden" value="0" class="hidden" name="price_min"/>
                <input type="hidden" value="0" class="hidden" name="price_max"/>
                <div id="price-range"></div>
            </div>
            <a href="#" class="primary-button property-filter">{{$static_data['strings']['search']}}</a>
            
            @if(get_setting('filter_by_features', 'property'))
            <div class="clearfix"></div>
                <a href="#" class="more-options">{{ $static_data['strings']['more_options'] }} <i class="fa fa-caret-down"></i></a>
                <div class="features-filter-box">
                    <div class="row">
                        @foreach($static_data['features'] as $feature)
                        <div class="col-md-3 col-sm-6 not-after">
                            <input type="checkbox" name="features[]" value="{{$feature->id}}" class="form-control" id="{{$feature->id}}" />
                            <label for="{{$feature->id}}"></label>
                            <img src="{{ $feature->icon }}" class="feature-icon"> <span class="checkbox-label">{{$feature->feature[$static_data['default_language']->id]}}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        @if(isset($featured_properties))
            <div id="half-map-featured" class="col-sm-12 items-grid">
                @foreach($featured_properties as $property)

                    @include('home.partials.property_grid')

                @endforeach
            </div>
        @endif
        <div id="filtered-properties" class="row">
            @foreach($properties as $property)

                 @include('home.partials.property', ['class' => 'col-md-6 col-sm-12 items-grid'])

            @endforeach
        </div>
        <div class="col-sm-12 mtop5 text-centered"><a href="#" class="black-button load-more-properties">{{ $static_data['strings']['load_more'] }}</a><img src="{{URL::asset('assets/images/ajax-loader.gif')}}" class="ajax-loader"/></div>
    @else
        @if(!count($properties))<div class="col-sm-12 text-centered"><strong class="center-align">{{$static_data['strings']['no_results']}}</strong></div>@endif
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

             $('.more-options').click(function(e){
                e.preventDefault();
                $('.features-filter-box').slideToggle();
            });

            // Load more properties
            var page_property = 4;
            $('.load-more-properties').click(function(e){
                var $this = $(this);
                var ajax_loader = $(this).parent().find('.ajax-loader');
                e.preventDefault();
                $.ajax({
                    url: '{{ url('explore') .'/getproperties?page=' }}' + page_property,
                    beforeSend: function(){
                        $this.hide(); ajax_loader.show();
                        $('#google-map').addClass('loading');
                    }
                }).done(function(data){
                    $('#google-map').removeClass('loading');
                    if(data){$this.show();$('#filtered-properties').append(data);}else{$('#filtered-properties').append('<div class="col-sm-12 info-message text-centered">{{$static_data['strings']['no_results']}}</div>');setTimeout(function(){$('.info-message').slideUp()}, 2000);}
                    page_property++;
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
                        rooms = $('[name="rooms"]').val(),
                        guest_number = $('[name="guest_number"]').val(),
                        price_min = $('[name="price_min"]').val(),
                        price_max = $('[name="price_max"]').val(),
                        token = $('.token').val(),
                        sort_id = $('[name="sort_id"]').val(),
                        location_id = $('[name="location_id"]').val(),
                        category_id = $('[name="category_id"]').val(),
                        start_date = $('[name="start_date"]').val(),
                        end_date = $('[name="end_date"]').val(),
                        features = [];
                $('[name^="features"]').each(function() {
                    if($(this).is(':checked')) features.push($(this).val());
                });
                $.ajax({
                    url: '{{ url('filter') }}/properties',
                    type: 'post',
                    data: {features: features, rooms: rooms, isExplore: 1, sort_id: sort_id, guest_number: guest_number, price_min: price_min, price_max: price_max, _token: token,location_id: location_id, category_id: category_id, start_date: start_date, end_date: end_date},
                    beforeSend: function(){
                        parent.addClass('loading');
                        $('#google-map').addClass('loading');
                        removeMarkers();
                    }
                }).done(function(data){
                    parent.removeClass('loading');
                    $('#google-map').removeClass('loading');
                    $('.load-more-properties').hide();
                    if(data){$('#filtered-properties').html(data);}else{$('#filtered-properties').html('<div class="col-sm-12 info-message text-centered">{{$static_data['strings']['no_results']}}</div>');}
                    @if($featured_markers)
                        fmarkers = [];
                        for(var i = 0; i < featured_markers.length; i++ ) {
                            addMarkerToMap(featured_markers[i][0], featured_markers[i][1], featured_infoWindowContent[i], 'properties');
                        }
                    @endif
                    var target = $('#filtered-properties');
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
                    if($('.end_date-picker').hasClass('hasDatePicker')){
                        $('.end_date-picker').datepicker('destroy');
                    }
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
                    infoWindowContent = [@foreach ($properties as $property)[{"id" : "{{$property->id}}","alias":"{{ $property->alias }}","name":{!! json_encode($property->contentload->name) !!},"address":"{{ $property->location['address'] }}" ,"city":"{{ $property->location['city'] }}" ,"country":"{{ $property->location['country'] }}" ,"phone":"{{ $property->contact['tel1'] }}", "icon":"{{ $property->category->map_icon }}", "featured":"{{ $property->featured }}", "image":@if(count($property->images))"{{ $property->images[0]->image }}" @else "no_image.jpg" @endif}], @endforeach], map_lon = {{ $static_data['site_settings']['contact_map_lon'] }}, map_lat = {{ $static_data['site_settings']['contact_map_lat'] }};

            explore_map(map_lat, map_lon, markers, infoWindowContent, 'property');

            @if($featured_markers)
               var featured_markers = [@foreach ($featured_markers as $marker)[{{$marker['geo_lon']}}, {{$marker['geo_lat']}}], @endforeach],
                    featured_infoWindowContent = [@foreach ($featured_properties as $property)[{"id" : "{{$property->id}}","alias":"{{ $property->alias }}","name":{!! json_encode($property->contentload->name) !!},"address":"{{ $property->location['address'] }}" ,"city":"{{ $property->location['city'] }}" ,"country":"{{ $property->location['country'] }}" ,"phone":"{{ $property->contact['tel1'] }}", "icon":"{{ $property->category->map_icon }}", "featured":"{{ $property->featured }}", "image":@if(count($property->images))"{{ $property->images[0]->image }}" @else "no_image.jpg" @endif}], @endforeach];
                for(var i = 0; i < featured_markers.length; i++ ) {
                    addMarkerToMap(featured_markers[i][0], featured_markers[i][1], featured_infoWindowContent[i], 'property');
                }
            @endif
        });
    </script>
@endsection