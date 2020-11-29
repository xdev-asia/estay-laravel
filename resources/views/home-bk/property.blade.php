@extends('layouts.home_layout', ['static_data', $static_data])
@section('title')
    <title>{{$static_data['strings']['property'] .' - '. $property->contentload->name}}</title>
    <meta name="title" content="@if($property->meta_title) {{ $property->meta_title }} @else {{$static_data['strings']['property'] .' - '. $property->contentload->name}} @endif">
    <meta name="description" content="@if($property->meta_description) {{ $property->meta_description }} @else {{strip_tags(str_limit($property->contentload->description, 200))}} @endif">
    <meta name="keywords" content="@if($property->meta_keywords) {{ $property->meta_keywords }} @else {{ $static_data['site_settings']['site_keywords'] }} @endif">
    <meta name="author" content="{{ $static_data['site_settings']['site_name'] }}">
    <meta property="og:title" content="@if($property->meta_title) {{ $property->meta_title }} @else {{$static_data['strings']['property'] .' - '. $property->contentload->name}} @endif" />
    <meta property="og:image" content="@if(count($property->images)) {{ URL::asset('images/data').'/'.$property->images[0]->image }} @else{{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}} @endif" />
    <meta property="og:description" content="@if($property->meta_description) {{ $property->meta_description }} @else {{strip_tags(str_limit($property->contentload->description, 200))}} @endif">
@endsection
@section('bg')
    @if(count($property->images) && get_setting('show_first_image', 'property'))
        {{ URL::asset('images/data').'/'.$property->images[0]->image }}
    @else
        {{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}
    @endif
@endsection
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/jquery-ui.min.css') }}">
@endsection
<?php
    $share_links = Share::load(Request::fullUrl(), $property->contentload->name)->services('facebook', 'gplus', 'twitter', 'pinterest', 'email', 'reddit', 'linkedin');
?>
@section('content')
    <div class="row marginalized">
        <div class="col-sm-12"><h1 class="section-title-dark">{{ $property->contentload->name }}</h1>
            <p class="meta-data">{{ $property->category->contentload->name .', '. $property->prop_location->contentload->location }}</p>
            @if(Session::has('reviewDone'))<p class="field-info text-centered green-color">{{ $static_data['strings']['thank_you_for_review'] }}</p>@endif
        </div>
        <div class="col-md-8 col-sm-12">
            <div id="carousel-images" class=" bg-overlay carousel slide" data-ride="carousel" data-interval="6000">
                @if(count($property->images))
                <div class="carousel-inner" role="listbox">
                    <?php $c = 0; ?>
                    @foreach($property->images as $image)
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
            <div style="overflow: hidden;"><p class="description mbot0">{!! $property->contentload->description !!}</p></div>
            <div class="features">
                <div class="row">
                    @foreach($features as $feature)
                        <div class="col-md-2 col-sm-3 amenity">
                            @if(isset($property->features) && in_array($feature->id, $property->features))
                                <span class="tooltip-feature" data-toggle="tooltip" data-placement="top" title="{{ $feature->feature[$default_language->id] }}"><i class="primary-color fa fa-check"></i> {{ $feature->feature[$default_language->id] }}</span>
                            @elseif(!get_setting('show_available_amenities_only', 'property'))
                                <span class="tooltip-feature" data-toggle="tooltip" data-placement="top" title="{{ $feature->feature[$default_language->id] }}"><i class="red-color fa fa-close"></i> {{ $feature->feature[$default_language->id] }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="property-info mtop20">
                        <h3 class="section-type">{{ $static_data['strings']['property_info'] }}</h3>
                        @if(isset($property->property_info['size']))<p class="listing-data"><i class="primary-color fa fa-info-circle"></i> {{ $static_data['strings']['property_size'].': '}} <strong> {{$property->property_info['size'] }} {{ $static_data['site_settings']['measurement_unit'] }}</strong></p>@endif
                        @if(isset($property->property_info['guest_number']))<p class="listing-data"><i class="primary-color fa fa-info-circle"></i> {{ $static_data['strings']['guest_number'].': '}} <strong> {{$property->property_info['guest_number'] }}</strong></p>@endif
                        @if(isset($property->property_info['rooms']))<p class="listing-data"><i class="primary-color fa fa-info-circle"></i> {{ $static_data['strings']['property_rooms'].': '}}<strong> {{$property->property_info['rooms'] }} </strong></p>@endif
                        @if(isset($property->property_info['bedrooms']))<p class="listing-data"><i class="primary-color fa fa-info-circle"></i> {{ $static_data['strings']['property_bedrooms'].': '}} <strong>{{$property->property_info['bedrooms'] }} </strong></p>@endif
                        @if(isset($property->property_info['bathrooms']))<p class="listing-data"><i class="primary-color fa fa-info-circle"></i> {{ $static_data['strings']['property_bathrooms'].': '}} <strong>{{$property->property_info['bathrooms'] }}</strong></p>@endif
                        @if(isset($property->fees['city_fee']))<p class="listing-data"><i class="primary-color fa fa-info-circle"></i> {{ $static_data['strings']['city_fee'].': '}} <strong>{{ currency($property->fees['city_fee'], $static_data['site_settings']['currency_code'], Session::get('currency'), false) }}</strong>{{ userCurrencySymbol() }}</p>@endif
                        @if(isset($property->fees['cleaning_fee']))<p class="listing-data"><i class="primary-color fa fa-info-circle"></i> {{ $static_data['strings']['cleaning_fee'].': '}} <strong>{{ currency($property->fees['cleaning_fee'], $static_data['site_settings']['currency_code'], Session::get('currency'), false) }} </strong>{{ userCurrencySymbol() }}</p>@endif
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="property-info  mtop20">
                        <h3 class="section-type">{{ $static_data['strings']['property_prices'] }}</h3>
                        @if(isset($property->price_per_night))<p class="listing-data"><i class="primary-color fa fa-info-circle"></i> {{ $static_data['strings']['price_per_night'].': '}} <strong> {{ currency($property->price_per_night, $static_data['site_settings']['currency_code'], Session::get('currency'), false) }} </strong>{{ userCurrencySymbol() }}</p>@endif
                        @if(isset($property->prices['d_5']))<p class="listing-data"><i class="primary-color fa fa-info-circle"></i> {{ $static_data['strings']['price_d_5'].': '}} <strong> {{ currency($property->prices['d_5'], $static_data['site_settings']['currency_code'], Session::get('currency'), false) }} </strong>{{ userCurrencySymbol() }}</p>@endif
                        @if(isset($property->prices['d_15']))<p class="listing-data"><i class="primary-color fa fa-info-circle"></i> {{ $static_data['strings']['price_d_15'].': '}}<strong> {{ currency($property->prices['d_15'], $static_data['site_settings']['currency_code'], Session::get('currency'), false) }} </strong>{{ userCurrencySymbol() }}</p>@endif
                        @if(isset($property->prices['d_30']))<p class="listing-data"><i class="primary-color fa fa-info-circle"></i> {{ $static_data['strings']['price_d_30'].': '}} <strong>{{ currency($property->prices['d_30'], $static_data['site_settings']['currency_code'], Session::get('currency'), false) }} </strong>{{ userCurrencySymbol() }}</p>@endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 sidebar">
            @if(get_setting('guest_booking', 'user') || $static_data['user'])
            <div class="booking-form input-style filter-box mbot20">
                {!! Form::open(['method' => 'post', 'url' => route('booking_pay_page')]) !!}
                <h3 class="section-type text-centered mbot5">{{ $static_data['strings']['book_now'] }}</h3>
                <p class="field-info text-centered mbot5">{{ $static_data['strings']['fill_fields_to_book'] }}</p>
                <div class="form-group not-after">
                    <div class="input-group">
                        <span class="fa fa-user input-group-addon"></span>
                        <input type="text" value="@if($static_data['user']){{ $static_data['user']->info->first_name }}@endif" name="first_name" required class="form-control slider-field" placeholder="{{$static_data['strings']['your_name']}}">
                    </div>
                </div>
                <div class="form-group not-after">
                    <div class="input-group">
                        <span class="fa fa-envelope input-group-addon"></span>
                        <input type="email" value="@if($static_data['user']){{ $static_data['user']->email }}@endif" name="email" class="form-control slider-field" required placeholder="{{$static_data['strings']['your_email']}}">
                    </div>
                </div>
                <div class="form-group not-after">
                    <div class="input-group">
                        <span class="fa fa-phone input-group-addon"></span>
                        <input type="text" value="" required name="phone" class="form-control slider-field" placeholder="{{$static_data['strings']['your_phone']}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="fa fa-user-o input-group-addon"></span>
                        <input type="text" disabled name="guest_number_value" value="" class="form-control filter-field" placeholder="{{$static_data['strings']['guests_number']}}">
                    </div>
                    <input type="hidden" name="guest_number" value="1" class="form-control filter-hidden hidden" placeholder="{{$static_data['strings']['guests_number']}}">
                    <ul class="dropdown-filter-menu">
                        @if(isset($property->guest_number))
                            @for ($i = 1; $i <= $property->guest_number; $i++)
                                <li data-number="{{$i}}">
                                    <a href="#" class="guest_number_picker">
                                        <span>{{ $i }}</span>
                                    </a>
                                </li>
                            @endfor
                        @else
                            <li data-number="1">
                                <a href="#" class="guest_number_picker">
                                    <span>1</span>
                                </a>
                            </li>
                        @endif
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
                <input type="hidden" name="total" class="hidden total-field" >
                <input type="hidden" name="property_id" value="{{ $property->id }}" class="hidden property-field" >
                <input type="hidden" value="{{ Session::get('currency') }}" class="currency_code" name="currency_code" />
                <div class="form-group not-after booking-data">
                    <p class="wrong-error"></p>
                </div>
                <div class="row booking-total">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr><td>{{ $static_data['strings']['nights'] }} </td><td class="total-nights"><strong></strong></td></tr>
                                @if(isset($property->price_per_night))<tr><td>{{ $static_data['strings']['price_per_night'] }} </td><td class="price-per-night"><strong>{{ currency($property->price_per_night, $static_data['site_settings']['currency_code'], Session::get('currency'), false) }}</strong>{{ userCurrencySymbol() }}</td></tr>@endif
                                @if(isset($property->fees['cleaning_fee']))<tr><td>{{ $static_data['strings']['cleaning_fee'] }} </td><td class="cleaning-fee"><strong>{{ currency($property->fees['cleaning_fee'], $static_data['site_settings']['currency_code'], Session::get('currency'),false) }}</strong>{{ userCurrencySymbol() }}</td></tr>@endif
                                @if(isset($property->fees['city_fee']))<tr><td>{{ $static_data['strings']['city_fee'] }} </td><td class="city-fee"><strong>{{ currency($property->fees['city_fee'], $static_data['site_settings']['currency_code'], Session::get('currency'), false) }}</strong>{{ userCurrencySymbol() }}</td></tr>@endif
                                <tr><td>{{ $static_data['strings']['total'] }} </td><td class="total-book"><strong></strong>{{ userCurrencySymbol() }}</td></tr>
                            </table>
                        </div>
                        @if(!get_setting('booking_by_payment', 'payment')) <a href="#" class="primary-button book-now">{{ $static_data['strings']['book_now'] }}</a>
                        @else
                        <button type="submit" class="primary-button pay-now">{{ $static_data['strings']['book_now'] }}</button>
                        {!! Form::close() !!}
                        @endif
                        <p class="success-book green-color" style="display: none;">{{ $static_data['strings']['thank_you_for_book'] }}</p>
                    </div>
                </div>
            </div>
            @else
                <p class="field-info text-centered mbot5">{{ $static_data['strings']['login_to_book'] }}</p>
            @endif
            <div class="features">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="map-boxed" class="map-boxed"></div>
                        <p class="listing-data">
                            <a href="#"><i class="fa primary-color fa-home"></i> {{ $property->location['address'].', '.$property->location['city'].' - '.$property->location['country'] }}</a>
                        </p>
                        @if($property->contact['tel1'])
                            <p class="listing-data">
                                <a href="tel:{{ $property->contact['tel1'] }}"><i class="fa primary-color fa-phone"></i> {{ $property->contact['tel1'] }}</a>
                                @if($property->contact['tel2'])
                                    <a href="tel:{{ $property->contact['tel2'] }}"> | {{ $property->contact['tel2'] }}</a>
                                @endif
                            </p>
                        @endif
                        @if($property->contact['fax'])
                            <p class="listing-data">
                                <a href="tel:{{ $property->contact['fax'] }}"><i class="fa primary-color fa-fax"></i> {{ $property->contact['fax'] }}</a>
                            </p>
                        @endif
                        @if($property->contact['email'])
                            <p class="listing-data">
                                <a href="mailto:{{ $property->contact['email'] }}"><i class="fa primary-color fa-envelope"></i> {{ $property->contact['email'] }}</a>
                            </p>
                        @endif
                        @if($property->contact['web'])
                            <p class="listing-data">
                                <a href="{{ $property->contact['web'] }}"><i class="fa primary-color fa-globe"></i> {{ $property->contact['web'] }}</a>
                            </p>
                        @endif
                        @if($property->user)<p class="owner-info">{{ $static_data['strings']['owner'] .' - '. $property->user->username }}</p>@endif
                        <ul class="social-icons">
                            @if($property->social['facebook']) <li><a href="{{ $property->social['facebook'] }}" target="_blank"><i class="fa primary-color fa-facebook"></i></a></li> @endif
                            @if($property->social['twitter']) <li><a href="{{ $property->social['twitter'] }}" target="_blank"><i class="fa primary-color fa-twitter"></i></a></li>@endif
                            @if($property->social['instagram'])  <li><a href="{{ $property->social['instagram'] }}" target="_blank"><i class="fa primary-color fa-instagram"></i></a></li>@endif
                            @if($property->social['gplus'])  <li><a href="{{ $property->social['gplus'] }}" target="_blank"><i class="fa primary-color fa-google-plus"></i></a></li>@endif
                            @if($property->social['pinterest'])  <li><a href="{{ $property->social['pinterest'] }}" target="_blank"><i class="fa primary-color fa-pinterest"></i></a></li>@endif
                            @if($property->social['linkedin'])  <li><a href="{{ $property->social['linkedin'] }}" target="_blank"><i class="fa primary-color fa-linkedin"></i></a></li>@endif
                        </ul>
                    </div>
                </div>
                @if($property->user && $static_data['user'])
                    <div class="row">
                        <div class="col-sm-12 text-centered">
                            <p class="mbot0 mtop10"><a class="primary-button" href="#" data-toggle="modal" data-target="#message-modal"><i class="fa fa-envelope"></i> {{ $static_data['strings']['contact_owner'] }}</a></p>
                        </div>
                    </div>
                @endif
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
                    <div class="col-sm-12"><h3 class="section-type">{{ $static_data['strings']['similar_properties'] }}</h3></div>
                    @foreach($similar as $property)

                        @include('home.partials.property')

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
                    {!! Form::hidden('property_id', $property->id) !!}
                    {!! Form::hidden('user_id', $static_data['user']->id) !!}
                </div>
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
    {{ csrf_field() }}
@endsection
@section('footer')

    @if($static_data['user'])
        <div class="modal fade" id="message-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $static_data['strings']['write_your_message'] }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            {!! Form::open(['method' => 'post', 'url' => route('message_owner'), 'id' => 'message-form']) !!}
                            <div class="form-group">
                                {!! Form::textarea('message', null, ['class' => 'form-control form-message', 'required', 'placeholder' => $static_data['strings']['write_your_message']]) !!}
                                <span class="wrong-error hidden">{{ $static_data['strings']['required_field'] }}</span>
                            </div>
                            {!! Form::hidden('user_id', $static_data['user']->id) !!}
                            {!! Form::hidden('owner_id', $property->user_id) !!}
                            @if($static_data['site_settings']['reCaptcha'])
                            <div class="form-group" id="reCaptcha">
                                <div class="g-recaptcha" data-sitekey="{{ $static_data['site_settings']['reCaptcha_api']}}"></div>
                                <span class="wrong-error"></span>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="send-form primary-button" data-dismiss="modal">{{ $static_data['strings']['close'] }}</button>
                        <a href="#" class="send-message primary-button">{{ $static_data['strings']['submit'] }}</a>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{URL::asset('assets/js/plugins/readmore.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/plugins/rating.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{$static_data['site_settings']['google_map_key']}}&libraries=places"></script>
    <script src="{{URL::asset('assets/js/plugins/richmarkers.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/plugins/jquery-ui.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.description').readmore({
                speed: 100,
                collapsedHeight: 150,
                moreLink: '<a class="primary-color" href="#">{{ $static_data['strings']['read_more'] }}</a>',
                lessLink: '<a class="primary-color" href="#">{{ $static_data['strings']['read_less'] }}</a>',
            });

            @if($static_data['site_settings']['reCaptcha'])
            // Contact mail
            $('.send-message').click(function(e){
                e.preventDefault();
                var token = $('[name="_token"]').val();
                var parent = $('.form-message').parent();
                $('.wrong-error', parent).addClass('hidden');
                $('#reCaptcha .wrong-error').hide();
                var captcha = grecaptcha.getResponse();
                if(captcha.length){
                    $.ajax({
                        url: '{{ route('reCaptcha') }}',
                        type: 'post',
                        data: {response: captcha, _token: token},
                        success: function(msg){
                            if(msg.status){
                                if($('.form-message').val() != ''){
                                    $('#message-form').submit();
                                }else{
                                    $('.wrong-error', parent).removeClass('hidden');
                                }
                            }else{
                                $('#reCaptcha .wrong-error').show().html('{{ $static_data['strings']['refresh_and_try_again'] }}');
                            }
                        },
                    })
                }else{
                    $('#reCaptcha .wrong-error').show().html('{{ $static_data['strings']['fill_captcha'] }}');
                }
            });
            @else
            // Contact mail
            $('.send-form').click(function(e){
                e.preventDefault();
                if($('.form-message').val() != ''){
                    $('#message-form').submit();
                }else{
                    $('.wrong-error', parent).removeClass('hidden');
                }
            });
            @endif

            var array = <?php echo json_encode($dates); ?>;
            // Datepickers
            $('.start_date-picker').datepicker({
                dateFormat: 'dd/mm/yy',
                minDate: 0,
                beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
                    return [ array.indexOf(string) == -1 ]
                },
                onSelect: function(dateText, inst) {
                    if($('.end_date-picker').hasClass('hasDatepicker')){
                        $('.end_date-picker').datepicker('destroy');
                        $('.end_date-picker').val('');
                        $('.booking-total').hide();
                    }
                    var startDate = $(this).datepicker('getDate');
                    startDate.setDate(startDate.getDate() + 1);
                    $("[name='start_date']").val(dateText);
                    $("[name='end_date']").removeAttr('disabled');
                    $('.end_date-picker').datepicker({
                        dateFormat: 'dd/mm/yy',
                        minDate: startDate,
                        beforeShowDay: function(date){
                            var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
                            return [ array.indexOf(string) == -1 ]
                        },
                        onSelect: function(dateText, inst) {
                            $('.booking-form').addClass('loading');
                            $('.booking-data, .booking-total').hide();
                            $("[name='end_date']").val(dateText);
                            var endDate = $(this).datepicker('getDate');
                            var dates = getDates(startDate, endDate);
                            var condition = 1;
                            $.each(dates, function(i){
                                if(array.indexOf(dates[i]) != -1){
                                    condition = 0;
                                    return false;
                                }
                            });
                            if(condition){
                                price_per_night = {{ currency($mainProperty->price_per_night, $static_data['site_settings']['currency_code'], Session::get('currency'), false) }};
                                var days = dates.length, price = 0, total = 0, total_book = 0;
                                if(days > 5) price = @if(isset($mainProperty->prices['d_5'])) {{ currency($mainProperty->prices['d_5'], $static_data['site_settings']['currency_code'], Session::get('currency'), false) }} @else price_per_night @endif;
                                if(days > 15) price = @if(isset($mainProperty->prices['d_15'])) {{ currency($mainProperty->prices['d_15'], $static_data['site_settings']['currency_code'], Session::get('currency'), false) }} @else price_per_night @endif;
                                if(days > 30) price = @if(isset($mainProperty->prices['d_30'])) {{ currency($mainProperty->prices['d_30'], $static_data['site_settings']['currency_code'], Session::get('currency'), false) }} @else price_per_night @endif;
                                if(days < 5 || price == 0) price = price_per_night;
                                total_book = days * price;
                                total = total_book @if(isset($mainProperty->fees['city_fee']))+ {{ currency($mainProperty->fees['city_fee'], $static_data['site_settings']['currency_code'], Session::get('currency'), false) }} @endif @if(isset($mainProperty->fees['cleaning_fee'])) + {{ currency($mainProperty->fees['cleaning_fee'], $static_data['site_settings']['currency_code'], Session::get('currency'), false) }} @endif;
                                $('.booking-total').show();$('.total-nights strong').html(days);$('.price-per-night strong').html(price);$('.total-book strong').html(Math.round(total * 100) / 100);$('.total-field').val(Math.round(total * 100) / 100);
                            }else{
                                $('.booking-data').show();
                                $('.booking-data .wrong-error').html('* {{ $static_data['strings']['dates_overlap'] }}')
                            }
                            $('.booking-form').removeClass('loading');
                        },
                    });
                    setTimeout(function(){
                        $('.end_date-picker').datepicker('show');
                    }, 100);
                },
            });

            // Google Map
            var position = new google.maps.LatLng({{ $mainProperty->location['geo_lon'] }}, {{ $mainProperty->location['geo_lat'] }});
            if(typeof google !== 'undefined'){
                var map = new google.maps.Map(document.getElementById('map-boxed'), {
                    center:{
                        lat: {{ $mainProperty->location['geo_lon'] }},
                        lng: {{ $mainProperty->location['geo_lat'] }}
                    },
                    zoom: {{ $static_data['site_settings']['google_map_zoom'] }},
                    styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#6195a0"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":"0"},{"saturation":"0"},{"color":"#f5f5f2"},{"gamma":"1"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"lightness":"-3"},{"gamma":"1.00"}]},{"featureType":"landscape.natural.terrain","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#bae5ce"},{"visibility":"on"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#fac9a9"},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#4e4e4e"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#787878"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.station.airport","elementType":"labels.icon","stylers":[{"hue":"#0a00ff"},{"saturation":"-77"},{"gamma":"0.57"},{"lightness":"0"}]},{"featureType":"transit.station.rail","elementType":"labels.text.fill","stylers":[{"color":"#43321e"}]},{"featureType":"transit.station.rail","elementType":"labels.icon","stylers":[{"hue":"#ff6c00"},{"lightness":"4"},{"gamma":"0.75"},{"saturation":"-68"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#eaf6f8"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#c7eced"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"lightness":"-49"},{"saturation":"-53"},{"gamma":"0.79"}]}]
                });
                @if($mainProperty->featured) var featured = 'featured'; @else var featured = ''; @endif
                var icon = '{{ $mainProperty->category->map_icon }}';
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

            @if(!get_setting('booking_by_payment', 'payment'))
            $('.book-now').click(function(e){
                e.preventDefault();
                $('.booking-form').addClass('loading');
                var first_name = $('[name="first_name"]').val(),
                        email = $('[name="email"]').val(),
                        phone = $('[name="phone"]').val(),
                        start_date = $('[name="start_date"]').val(),
                        end_date = $('[name="end_date"]').val(),
                        total = $('[name="total"]').val(),
                        currency = $('.currency_code').val(),
                        guests = $('[name="guest_number"]').val(),
                        property_id = $('.property-field').val(),
                        token = $('[name="_token"]').val();
                if(first_name == ''){
                    $('.booking-data').show();
                    $('.booking-data .wrong-error').html('{{ $static_data['strings']['fill_fields_to_book'] }}');
                    $('.booking-form').removeClass('loading');
                }else if(!isEmail(email)){
                    $('.booking-data').show();
                    $('.booking-data .wrong-error').html('{{ $static_data['strings']['email_invalid'] }}');
                    $('.booking-form').removeClass('loading');
                }else if(phone == ''){
                    $('.booking-data').show();
                    $('.booking-data .wrong-error').html('{{ $static_data['strings']['fill_fields_to_book'] }}');
                    $('.booking-form').removeClass('loading');
                }else if(!isPhone(phone)){
                    $('.booking-data').show();
                    $('.booking-data .wrong-error').html('{{ $static_data['strings']['phone_number_validation'] }}');
                    $('.booking-form').removeClass('loading');
                }else{
                    $.ajax({
                        url: '{{ url('bookproperty') }}',
                        type: 'post',
                        data: {
                            first_name: first_name,
                            email: email,
                            property_id: property_id,
                            start_date: start_date,
                            end_date: end_date,
                            total: total,
                            guests: guests,
                            _token: token,
                            phone: phone,
                            currency: currency,
                        },
                        success: function (data) {
                            $('.booking-form').removeClass('loading');
                            $('.success-book').show();
                            $('.booking-data, .book-now').hide();
                            setTimeout(function () {
                                // window.location.reload()
                            }, 3000);
                        }, error: function (data) {
                            console.log(data);
                            $('.booking-form').removeClass('loading');
                            $('.booking-data').show();
                            $('.booking-data .wrong-error').html('{{ $static_data['strings']['something_happened'] }}');
                        }
                    });
                }
            });
            @endif
        });
    </script>
@endsection
