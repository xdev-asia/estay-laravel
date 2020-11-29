@extends('layouts.home_layout', ['static_data', $static_data])
<?php $max_price = get_setting('price_range_max', 'property') ?>
@section('title')
    <title>{{$static_data['strings']['location'] . ' - ' . $location->contentload->location}}</title>
    <meta name="title" content="{{$static_data['strings']['location'] . ' - ' . $location->contentload->location}}">
    <meta name="description" content="{{strip_tags($location->contentload->description)}}">
    <meta name="keywords" content="{{ $static_data['site_settings']['site_keywords'] }}">
    <meta name="author" content="{{ $static_data['site_settings']['site_name'] }}">
    <meta property="og:title" content="{{$static_data['strings']['location'] . ' - ' . $location->contentload->location}}" />
    <meta property="og:image" content="{{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}" />
    <meta property="og:description" content="{{strip_tags($location->contentload->description)}}">
@endsection
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/jquery-ui.min.css') }}">
@endsection
@section('bg')
    @if($location->featured_image)
        {{ $location->featured_image }}
    @else
        {{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}
    @endif
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
            <h1 class="section-title-dark">{{$static_data['strings']['location'] . ' - ' . $location->contentload->location}}</h1>
            <div class="tab-content">
                <div class="tab-pane active" id="accordion-properties" role="tabpanel">
                    <div class="row">
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
                                    </div>                                </div>
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
                                <div class="col-sm-12 featured-grid-properties items-grid">
                                    @foreach($featured_properties as $property)
                                        
                                        @include('home.partials.property_grid')

                                    @endforeach
                                </div>
                            @endif
                            <div id="filtered-properties" class="row">
                                @foreach($properties as $property)
                                    
                                    @include('home.partials.property')

                                @endforeach
                            </div>
                            <div class="col-sm-12 mtop5 text-centered"><a href="#" class="black-button load-more-properties">{{ $static_data['strings']['load_more'] }}</a><img src="{{URL::asset('assets/images/ajax-loader.gif')}}" class="ajax-loader"/></div>
                        @endif
                    </div>
                </div>
                @if(get_setting('services_allowed', 'service'))
                    <div class="tab-pane @if(!count($properties)) active @endif" id="accordion-services" role="tabpanel">
                        <div class="row">
                            @if(isset($services) && count($services))
                                <div class="col-sm-12 mbot10"><h3 class="section-type text-uppercase">{{ $static_data['strings']['services'] }}</h3></div>
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
                                    <a href="#" class="primary-button service-filter">{{$static_data['strings']['search']}}</a>
                                </div>
                                @if(isset($featured_services))
                                    <div class="col-sm-12 featured-grid-services items-grid">
                                        @foreach($featured_services as $service)

                                            @include('home.partials.service_grid')

                                        @endforeach
                                    </div>
                                @endif
                        </div>
                        <div class="row" id="filtered-services">
                            @foreach($services as $service)

                                @include('home.partials.service')

                            @endforeach
                            </div>
                            <div class="col-sm-12 mtop5 text-centered"><a href="#" class="black-button load-more-services">{{ $static_data['strings']['load_more'] }}</a><img src="{{URL::asset('assets/images/ajax-loader.gif')}}" class="ajax-loader"/></div>
                            @endif
                                @if(!count($properties) && !count($services))<div class="col-sm-12 text-centered"><strong class="center-align">{{$static_data['strings']['no_results']}}</strong></div>@endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <input type="hidden" class="hidden token" value="{{ csrf_token() }}"/>
    <input type="hidden" name="location_id" class="hidden location_id" value="{{ $location->id }}"/>
    <input type="hidden" class="hidden" name="isExplore" value="0"/>
    <script src="{{URL::asset('assets/js/plugins/nouislider.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/plugins/jquery-ui.min.js')}}"></script>
    <script type="text/javascript">
        $('document').ready(function(){

             $('.more-options').click(function(e){
                e.preventDefault();
                $('.features-filter-box').slideToggle();
            });
            
            // Load more properties
            var page_property = 3;
            $('.load-more-properties').click(function(e){
                var $this = $(this);
                var ajax_loader = $(this).parent().find('.ajax-loader');
                e.preventDefault();
                $.ajax({
                    url: '{{ url('location') .'/'. $location->id .'/properties?page=' }}' + page_property,
                    beforeSend: function(){
                        $this.hide(); ajax_loader.show();
                    }
                }).done(function(data){
                    if(data){$this.show();$('#filtered-properties').append(data);}else{$('#filtered-properties').append('<div class="col-sm-12 info-message text-centered">{{$static_data['strings']['no_results']}}</div>');setTimeout(function(){$('.info-message').slideUp()}, 2000);}
                    page_property++;
                    ajax_loader.hide();
                });
            });

            // Load more services
            var page_service = 3;
            $('.load-more-services').click(function(e){
                var $this = $(this);
                var ajax_loader = $(this).parent().find('.ajax-loader');
                e.preventDefault();
                $.ajax({
                    url: '{{ url('location') .'/'. $location->id .'/services?page=' }}' + page_service,
                    beforeSend: function(){
                        $this.hide();
                        ajax_loader.show();
                    }
                }).done(function(data){
                    if(data){
                        $this.show();
                        $('#filtered-services').append(data);
                    }else{
                        $('#filtered-services').append('<div class="col-sm-12 info-message text-centered">{{$static_data['strings']['no_results']}}</div>');
                        setTimeout(function(){$('.info-message').slideUp()}, 2000);
                    }
                    page_service++;
                    ajax_loader.hide();
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
                        location_id = $('[name="location_id"]').val(),
                        sort_id = $('[name="sort_id"]').val(),
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
                    data: {features: features, rooms: rooms, sort_id: sort_id, guest_number: guest_number, price_min: price_min, price_max: price_max, _token: token,location_id: location_id, category_id: category_id, start_date: start_date, end_date: end_date},
                    beforeSend: function(){
                        parent.addClass('loading');
                    }
                }).done(function(data){
                    parent.removeClass('loading');
                    $('.load-more-properties').hide();
                    if(data){$('#filtered-properties').html(data);}else{$('#filtered-properties').html('<div class="col-sm-12 info-message text-centered">{{$static_data['strings']['no_results']}}</div>');}
                    var target = $('#filtered-properties');
                    $('html, body').animate({
                        scrollTop: target.offset().top - 150
                    }, 1000);
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

            // Service Filter
            $('.service-filter').click(function(e){
                e.preventDefault();
                var parent = $(this).parent(),
                        token = $('.token').val(),
                        location_id = $('[name="location_id"]').val(),
                        category_id = $('[name="category_id"]').val();
                $.ajax({
                    url: '{{ url('filter') }}/services',
                    type: 'post',
                    data: {_token: token, location_id: location_id, category_id: category_id},
                    beforeSend: function(){
                        parent.addClass('loading');
                    }
                }).done(function(data){
                    parent.removeClass('loading');
                    $('.load-more-services').hide();
                    if(data){$('#filtered-services').html(data);}else{$('#filtered-services').html('<div class="col-sm-12 info-message text-centered">{{$static_data['strings']['no_results']}}</div>');}
                    var target = $('#filtered-services');
                    $('html, body').animate({
                        scrollTop: target.offset().top - 150
                    }, 1000);
                });
            });

            // Load price range
            price_range({{ $max_price }});

        });
    </script>
@endsection