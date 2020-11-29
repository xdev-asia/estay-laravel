@extends('layouts.home_layout', ['static_data', $static_data])
@section('title')
    <title>{{$static_data['strings']['service'] .' - '. $service->contentload->name}}</title>
    <meta name="title" content="@if($service->meta_title) {{ $service->meta_title }} @else {{$static_data['strings']['service'] .' - '. $service->contentload->name}} @endif">
    <meta name="description" content="@if($service->meta_description) {{ $service->meta_description }} @else {{strip_tags(str_limit($service->contentload->description, 200))}} @endif">
    <meta name="keywords" content="@if($service->meta_keywords) {{ $service->meta_keywords }} @else {{ $static_data['site_settings']['site_keywords'] }} @endif">
    <meta name="author" content="{{ $static_data['site_settings']['site_name'] }}">
    <meta property="og:title" content="@if($service->meta_title) {{ $service->meta_title }} @else {{$static_data['strings']['service'] .' - '. $service->contentload->name}} @endif" />
    <meta property="og:image" content="@if(count($service->images)) {{ URL::asset('images/data').'/'.$service->images[0]->image }} @else{{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}} @endif" />
    <meta property="og:description" content="@if($service->meta_description) {{ $service->meta_description }} @else {{strip_tags(str_limit($service->contentload->description, 200))}} @endif">
@endsection
@section('bg')
    @if(count($service->images) && get_setting('show_first_image', 'property')) 
        {{ URL::asset('images/data').'/'.$service->images[0]->image }} 
    @else
        {{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}} 
    @endif
@endsection
<?php 
    $share_links = Share::load(Request::fullUrl(), $service->contentload->name)->services('facebook', 'gplus', 'twitter', 'pinterest', 'email', 'reddit', 'linkedin');
?>
@section('content')
    <div class="row marginalized">
        <div class="col-sm-12"><h1 class="section-title-dark">{{ $service->contentload->name }}</h1>
            <p class="meta-data">{{ $service->category->contentload->name .', '. $service->ser_location->contentload->location }}</p>
            @if(Session::has('reviewDone'))<p class="field-info text-centered green-color">{{ $static_data['strings']['thank_you_for_review'] }}</p>@endif
        </div>
        <div class="col-md-8 col-sm-12">
            <div id="carousel-images" class=" bg-overlay carousel slide" data-ride="carousel" data-interval="6000">
                @if(count($service->images))
                <div class="carousel-inner" role="listbox">
                    <?php $c = 0; ?>
                    @foreach($service->images as $image)
                        <div class="carousel-item @if(!$c) active <?php $c++; ?> @endif">
                            <img class="img-fluid d-block" src="{{ URL::asset('images/data').'/'.$image->image }}"/>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carousel-images" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">{{$static_data['strings']['previous']}}</span>
                </a>
                <a class="carousel-control-next" href="#carousel-images" role="button" data-slide="next">
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
            <h3 class="section-type">{{ $static_data['strings']['description'] }}</h3>
            <div style="overflow: hidden;"><p class="description mbot0">{!! $service->contentload->description !!}</p></div>
            <div class="features">
                <div class="row">
                @foreach($features as $feature)
                    <div class="col-md-2 col-sm-3 amenity">
                        @if(isset($service->features) && in_array($feature->id, $service->features))
                            <span class="tooltip-feature" data-toggle="tooltip" data-placement="top" title="{{ $feature->feature[$default_language->id] }}"><i class="primary-color fa fa-check"></i> {{ $feature->feature[$default_language->id] }}</span>
                        @elseif(!get_setting('show_available_amenities_only', 'property'))
                            <span class="tooltip-feature" data-toggle="tooltip" data-placement="top" title="{{ $feature->feature[$default_language->id] }}"><i class="red-color fa fa-close"></i> {{ $feature->feature[$default_language->id] }}</span>
                        @endif
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 sidebar">
            <div class="features">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="map-boxed" class="map-boxed"></div>
                        <p class="listing-data">
                            <a href="#"><i class="fa primary-color fa-home"></i> {{ $service->location['address'].', '.$service->location['city'].' - '.$service->location['country'] }}</a>
                        </p>
                        @if($service->contact['tel1'])
                            <p class="listing-data">
                                <a href="tel:{{ $service->contact['tel1'] }}"><i class="fa primary-color fa-phone"></i> {{ $service->contact['tel1'] }}</a>
                                @if($service->contact['tel2'])
                                    <a href="tel:{{ $service->contact['tel2'] }}"> | {{ $service->contact['tel2'] }}</a>
                                @endif
                            </p>
                        @endif
                        @if($service->contact['fax'])
                            <p class="listing-data">
                                <a href="tel:{{ $service->contact['fax'] }}"><i class="fa primary-color fa-fax"></i> {{ $service->contact['fax'] }}</a>
                            </p>
                        @endif
                        @if($service->contact['email'])
                            <p class="listing-data">
                                <a href="mailto:{{ $service->contact['email'] }}"><i class="fa primary-color fa-envelope"></i> {{ $service->contact['email'] }}</a>
                            </p>
                        @endif
                        @if($service->contact['web'])
                            <p class="listing-data">
                                <a href="{{ $service->contact['web'] }}"><i class="fa primary-color fa-globe"></i> {{ $service->contact['web'] }}</a>
                            </p>
                        @endif
                        <div class="work-times">
                            <p class="first-data listing-data"><i class="fa fa-clock-o"></i> {{ $static_data['strings']['business_hours'] }}</p>
                            @if(isset($service->business_hours['week']))<p class="listing-data mtop5">{{ $static_data['strings']['weekdays'].': '.$service->business_hours['week'] }}</p>@endif
                            @if(isset($service->business_hours['sat'])) <p class="listing-data">{{ $static_data['strings']['saturday'].': '.$service->business_hours['sat'] }}</p>@endif
                            @if(isset($service->business_hours['sun']))<p class="listing-data">{{ $static_data['strings']['sunday'].': '.$service->business_hours['sun'] }}</p>@endif
                        </div>
                        @if($service->user)<p class="owner-info">{{ $static_data['strings']['owner'] .' - '. $service->user->username }}</p>@endif
                        <ul class="social-icons">
                            @if($service->social['facebook']) <li><a href="{{ $service->social['facebook'] }}" target="_blank"><i class="fa primary-color fa-facebook"></i></a></li> @endif 
                            @if($service->social['twitter']) <li><a href="{{ $service->social['twitter'] }}" target="_blank"><i class="fa primary-color fa-twitter"></i></a></li>@endif
                            @if($service->social['instagram'])  <li><a href="{{ $service->social['instagram'] }}" target="_blank"><i class="fa primary-color fa-instagram"></i></a></li>@endif
                            @if($service->social['gplus'])  <li><a href="{{ $service->social['gplus'] }}" target="_blank"><i class="fa primary-color fa-google-plus"></i></a></li>@endif
                            @if($service->social['pinterest'])  <li><a href="{{ $service->social['pinterest'] }}" target="_blank"><i class="fa primary-color fa-pinterest"></i></a></li>@endif
                            @if($service->social['linkedin'])  <li><a href="{{ $service->social['linkedin'] }}" target="_blank"><i class="fa primary-color fa-linkedin"></i></a></li>@endif
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-centered">
                        <div class="social-buttons">
                            <h3 class="section-type">{{ $static_data['strings']['share'] }}</h3>
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
        <div class="col-sm-12 mtop20">
            @if($similar->count())
                <div class="row hidden-md-down">
                    <div class="col-sm-12"><h3 class="section-type">{{ $static_data['strings']['similar_services'] }}</h3></div>
                    @foreach($similar as $service1)

                        @include('home.partials.service')

                    @endforeach
                </div>
            @endif
        </div>
        @if($static_data['user'])
        <div class="@if(count($reviews))col-md-6 @endif col-sm-12">
            <h3 class="section-type">{{ $static_data['strings']['review'] }}</h3>
            <div id="review">
                {!! Form::open(['method' => 'post', 'url' => route('make_review')]) !!}
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group  {{$errors->has('name') ? 'has-error' : ''}}">
                            {{Form::text('name', $static_data['user']->info->first_name, ['class' => 'form-control', 'required', 'placeholder' => $static_data['strings']['name']])}}
                            @if($errors->has('name'))
                                <span class="wrong-error">* {{$errors->first('name')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mbot10">
                            <p class="mbot0 review-label">{{ $static_data['strings']['rating'].' ' }}</p>
                            <select id="rating-select" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="rating" value="0" class="rating-value hidden" />
                <div class="form-group  {{$errors->has('review') ? 'has-error' : ''}}">
                    {{Form::textarea('review', null, ['class' => 'form-control', 'x4', 'required', 'placeholder' => $static_data['strings']['review']])}}
                    @if($errors->has('review'))
                        <span class="wrong-error">* {{$errors->first('review')}}</span>
                    @endif
                </div>
                {!! Form::hidden('service_id', $service->id) !!}
                {!! Form::hidden('user_id', $static_data['user']->id) !!}
                <button type="submit" name="action" class="primary-button">{{ $static_data['strings']['submit'] }}</button>
                {!! Form::close() !!}
            </div>
        </div>
        @endif
        @if(count($reviews))
            <div class="@if($static_data['user'])col-md-6 @endif col-sm-12">
                <h3 class="section-type mtop20">{{ $static_data['strings']['reviews'] }}</h3>
                <ul class="review-list">
                    @foreach($reviews as $review)
                            <li class="review-item">
                                <div class="review-description">
                                    <span>{{ $review->review }}</span>
                                    <div class="br-wrapper br-theme-fontawesome-stars-o">
                                        @if($review->user)<p class="meta-data"> {{ $static_data['strings']['posted_by'] .': '. $review->user->username }}</p>@endif
                                        <div class="br-widget">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <a href="#" data-rating-value="{{ $i }}" data-rating-text="{{  $i }}" class="br-active"></a>
                                                @else
                                                    <a href="#" data-rating-value="{{ $i }}" data-rating-text="{{  $i }}"></a>
                                                @endif
                                            @endfor
                                     </div>
                                    </div>
                                </div>
                            </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
@section('footer')
    <script src="{{URL::asset('assets/js/plugins/readmore.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/plugins/rating.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{$static_data['site_settings']['google_map_key']}}&libraries=places"></script>
    <script src="{{URL::asset('assets/js/plugins/richmarkers.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.description').readmore({
                speed: 100,
                collapsedHeight: 150,
                moreLink: '<a class="primary-color" href="#">{{ $static_data['strings']['read_more'] }}</a>',
                lessLink: '<a class="primary-color" href="#">{{ $static_data['strings']['read_less'] }}</a>',
            });

            // Google Map
            var position = new google.maps.LatLng({{ $mainService->location['geo_lon'] }}, {{ $mainService->location['geo_lat'] }});
            if(typeof google !== 'undefined'){
                var map = new google.maps.Map(document.getElementById('map-boxed'), {
                    center:{
                        lat: {{ $mainService->location['geo_lon'] }},
                        lng: {{ $mainService->location['geo_lat'] }}
                    },
                    zoom: {{ $static_data['site_settings']['google_map_zoom'] }},
                    styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#6195a0"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":"0"},{"saturation":"0"},{"color":"#f5f5f2"},{"gamma":"1"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"lightness":"-3"},{"gamma":"1.00"}]},{"featureType":"landscape.natural.terrain","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#bae5ce"},{"visibility":"on"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#fac9a9"},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#4e4e4e"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#787878"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.station.airport","elementType":"labels.icon","stylers":[{"hue":"#0a00ff"},{"saturation":"-77"},{"gamma":"0.57"},{"lightness":"0"}]},{"featureType":"transit.station.rail","elementType":"labels.text.fill","stylers":[{"color":"#43321e"}]},{"featureType":"transit.station.rail","elementType":"labels.icon","stylers":[{"hue":"#ff6c00"},{"lightness":"4"},{"gamma":"0.75"},{"saturation":"-68"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#eaf6f8"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#c7eced"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"lightness":"-49"},{"saturation":"-53"},{"gamma":"0.79"}]}]
                });
                @if($mainService->featured) var featured = 'featured'; @else var featured = ''; @endif
                var icon = '{{ $mainService->category->map_icon }}';
                marker = new RichMarker({
                    position: position,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    shadow: 'none',
                    content: '<div class="map-marker ' + featured + '"><i class="fa '+ icon + '"></i></div>'
                });
            }

            $('#rating-select').barrating({
                theme: 'fontawesome-stars-o',
                onSelect: function(value, text, event){
                    $('[name="rating"]').val(value);
                }
            });
        });
    </script>
@endsection
