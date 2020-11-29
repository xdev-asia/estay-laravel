<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>{{ $static_data['site_settings']['site_name'] }}</title>
    <meta charset="UTF-8">
    <meta name="title" content="{{ $static_data['site_settings']['site_name'] }}">
    <meta name="description" content="{{ $static_data['site_settings']['site_description'] }}">
    <meta name="keywords" content="{{ $static_data['site_settings']['site_keywords'] }}">
    <meta name="author" content="{{ $static_data['site_settings']['site_name'] }}">
    <meta property="og:title" content="{{ $static_data['site_settings']['site_name'] }}" />
    <meta property="og:image" content="{{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}" />
    {{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Exo+2:400,700,900&amp;subset=cyrillic,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&amp;subset=cyrillic,latin-ext" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{ URL::asset('assets/estay/css/normalize.css') }}" >
    <link rel="stylesheet" href="{{ URL::asset('assets/estay/css/bootstrap.min.css') }}" >
    <link rel="stylesheet" href="{{ URL::asset('assets/estay/css/daterangepicker.css') }}" >
    <link rel="stylesheet" href="{{ URL::asset('assets/estay/css/slick.css') }}" >
    <link rel="stylesheet" href="{{ URL::asset('assets/estay/css/main.css') }}" >

  <meta name="theme-color" content="#fafafa">

    @if($static_data['site_settings']['google_analytics'])
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', '{{ $static_data['site_settings']['google_analytics'] }}', 'auto');
            ga('send', 'pageview');

        </script>
    @endif
    {!! $custom_css !!}
</head>
<body class="home-page">
 {{-- <div class="cover"></div>
<div class="wrapper">
    <div class="container-fluid header-container" @if($static_data['design_settings']['slider_background']) style="background-image: url('{{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}')" @endif>
        <div id="top" class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <span class="top-text">{{$static_data['strings']['opt_welcome_text']}} @if($static_data['user'] ){{$static_data['user']->username}}@else{{$static_data['strings']['guest']}}@endif</span>
                        <ul class="top-social">
                           @if($static_data['design_settings']['show_social_top_bar'])
                           @if($static_data['site_settings']['social_facebook']) <li><a href="{{ $static_data['site_settings']['social_facebook'] }}" target="_blank"><i class="fa fa-facebook"></i></a></li> @endif
                           @if($static_data['site_settings']['social_twitter']) <li><a href="{{ $static_data['site_settings']['social_twitter'] }}"  target="_blank"><i class="fa fa-twitter"></i></a></li>@endif
                           @if($static_data['site_settings']['social_youtube'])  <li><a href="{{ $static_data['site_settings']['social_youtube'] }}"  target="_blank"><i class="fa fa-youtube"></i></a></li>@endif
                           @if($static_data['site_settings']['social_instagram'])  <li><a href="{{ $static_data['site_settings']['social_instagram'] }}" target="_blank"><i class="fa fa-instagram"></i></a></li>@endif
                           @if($static_data['site_settings']['social_google_plus'])  <li><a href="{{ $static_data['site_settings']['social_google_plus'] }}" target="_blank"><i class="fa fa-google-plus"></i></a></li>@endif
                           @if($static_data['site_settings']['social_pinterest'])  <li><a href="{{ $static_data['site_settings']['social_pinterest'] }}" target="_blank"><i class="fa fa-pinterest"></i></a></li>@endif
                           @if($static_data['site_settings']['social_linkedin'])  <li><a href="{{ $static_data['site_settings']['social_linkedin'] }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>@endif
                           @if($static_data['site_settings']['social_tripadvisor'])  <li><a href="{{ $static_data['site_settings']['social_tripadvisor'] }}" target="_blank"><i class="fa fa-tripadvisor"></i></a></li>@endif
                        @endif
                        </ul>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <ul class="top-menu">
                            @if($static_data['user'] && $static_data['user']->role->id == 2) <li><a href="{{ route('owner_dashboard') }}"><i class="fa fa-tachometer"></i> {{$static_data['strings']['dashboard']}}</a></li> @endif
                            @if(!$static_data['user'])<li class="{{ setActive('register') }}"><a href={{ route('register') }}><i class="fa fa-plus-circle"></i> {{$static_data['strings']['register']}}</a></li>
                            @else<li><a href="{{ route('logout') }}"><i class="fa fa-power-off red-color"></i> {{$static_data['strings']['logout']}}</a></li>@endif
                            @if($static_data['user'] && $static_data['user']->role->id == 3)<li class="{{ setActive('my-account') }}"><a href="{{ route('my_account') }}"><i class="fa fa-user"></i> {{$static_data['strings']['my_account']}}</a></li>
                            <li><a href="{{ route('message') }}"><i class="fa fa-envelope"></i> {{$static_data['strings']['messages']}}</a></li>@endif
                            @if(count($static_data['languages']) > 1)
                                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" id="language-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-language"></i>
                                    @if(Session::has('language'))
                                    @foreach($static_data['languages'] as $language)
                                        @if(Session::get('language'))
                                            @if(strpos(Session::get('language'), $language->code) !== false)
                                                {{$language->language}}
                                            @endif
                                        @endif
                                    @endforeach
                                    @else
                                        {{$default_language->language}}
                                    @endif
                                </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="language-dropdown">
                                        @foreach($static_data['languages'] as $language)
                                            <a class="dropdown-item language-switcher" data-code="{{$language->code}}" href="#">{{$language->language}}</a>
                                        @endforeach
                                    </div>
                                </li>
                                    {!! csrf_field() !!}
                             @endif
                             @if(count($currencies) > 1)
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" id="language-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-usd"></i>
                                        {{ currency()->getUserCurrency() }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="language-dropdown">
                                        @foreach($currencies as $currency)
                                            <a class="dropdown-item currency-switcher" data-code="{{$currency['code']}}" href="#">{{ $currency['symbol'] }}</a>
                                        @endforeach
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="header-phantom" class="hidden"></div>
        <div id="header" class="row sticky-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-3">
                        <div id="logo">
                        <a href="{{ url('/') }}"><img class="img-fluid" src="{{ URL::asset('assets/images/home/logo.png') }}"/></a>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-9">
                        <ul class="main-menu">
                            <li class="active"><a href="{{route('home')}}">{{$static_data['strings']['home']}}</a></li>
                            @if(get_setting('services_allowed', 'service'))<li>
                                <a class="dropdown-toggle" id="explore-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$static_data['strings']['explore']}}</a>
                                <div class="dropdown-menu" aria-labelledby="explore-dropdown">
                                    <a href="{{ route('explore_properties') }}"><div class="dropdown-item">{{$static_data['strings']['properties']}}</div></a>
                                    <a href="{{ route('explore_services') }}"><div class="dropdown-item">{{$static_data['strings']['services']}}</div></a>
                                </div>
                            </li>
                            @else
                                <li><a href="{{ route('explore_properties') }}">{{$static_data['strings']['properties']}}</a></li>
                            @endif
                            <li>
                                <a class="dropdown-toggle" id="properties-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$static_data['strings']['locations']}}</a>
                                <div class="dropdown-menu" aria-labelledby="properties-dropdown">
                                    @foreach($static_data['locations'] as $location)
                                        <a href="{{url('/location').'/'.$location->alias}}"><div class="dropdown-item">{{ $location->contentload->location }}</div></a>
                                    @endforeach
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-toggle" id="categories-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $static_data['strings']['categories'] }}</a>
                                <div class="dropdown-menu" aria-labelledby="categories-dropdown">
                                    @foreach($static_data['categories'] as $category)
                                        <a href="{{url('/category').'/'.$category->alias}}"><div class="dropdown-item">{{ $category->contentload->name }}</div></a>
                                    @endforeach
                                </div>
                            </li>
                        <!-- <li><a href="#">{{$static_data['strings']['owners']}}</a></li> -->
                            @if($static_data['site_settings']['allow_blog']) <li class="{{ setActive('blog') }}"><a href="{{route('blog')}}">{{$static_data['strings']['blog']}}</a></li>@endif
                            <li class="{{ setActive('contact') }}"><a href="{{route('contact')}}">{{$static_data['strings']['contact']}}</a></li>
                            @if(!$static_data['user'])<li class="{{ setActive('login') }}"><a href="{{ route('login') }}" class="white-button">{{ $static_data['strings']['sign_in'] }}</a></li>@endif
                            @if($static_data['user'] && $static_data['user']->role->id == 3 && $owner_request)<li><a class="white-button request-upgrade" data-toggle="modal" data-target="#upgrade-confirm-modal" >{{ $static_data['strings']['add_your_property'] }}</a></li>@endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 hidden-md-up">
                <a href="#" class="mobile-menu-button"><i class="fa fa-bars"></i></a>
            </div>
            <div class="mobile-menu">
                <ul class="mobile-main-menu">
                    <li class="active"><a href="{{route('home')}}"><i class="fa fa-home"></i> {{$static_data['strings']['home']}}</a></li>
                    @if(get_setting('services_allowed', 'service'))<li>
                        <a class="dropdown-toggle" id="explore-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-binoculars"></i> {{$static_data['strings']['explore']}}</a>
                        <div class="dropdown-menu" aria-labelledby="explore-dropdown">
                            <a href="{{ route('explore_properties') }}"><div class="dropdown-item">{{$static_data['strings']['properties']}}</div></a>
                            <a href="{{ route('explore_services') }}"><div class="dropdown-item">{{$static_data['strings']['services']}}</div></a>
                        </div>
                    </li>
                    @else
                        <li><a href="{{ route('explore_properties') }}"><i class="fa fa-building"></i> {{$static_data['strings']['properties']}}</a></li>
                    @endif
                    <li>
                        <a class="dropdown-toggle" id="properties-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-map-o"></i> {{$static_data['strings']['locations']}}</a>
                        <div class="dropdown-menu" aria-labelledby="properties-dropdown">
                            @foreach($static_data['locations'] as $location)
                                <a href="{{url('/location').'/'.$location->alias}}"><div class="dropdown-item">{{ $location->contentload->location }}</div></a>
                            @endforeach
                        </div>
                    </li>
                    <li>
                        <a class="dropdown-toggle" id="categories-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cube"></i> {{ $static_data['strings']['categories'] }}</a>
                        <div class="dropdown-menu" aria-labelledby="categories-dropdown">
                            @foreach($static_data['categories'] as $category)
                                <a href="{{url('/category').'/'.$category->alias}}"><div class="dropdown-item">{{ $category->contentload->name }}</div></a>
                            @endforeach
                        </div>
                    </li>
                <!-- <li><a href="#">{{$static_data['strings']['owners']}}</a></li> -->
                    @if($static_data['site_settings']['allow_blog']) <li class="{{ setActive('blog') }}"><a href="{{route('blog')}}"><i class="fa fa-newspaper-o"></i> {{$static_data['strings']['blog']}}</a></li>@endif
                    <li class="{{ setActive('contact') }}"><a href="{{route('contact')}}"><i class="fa fa-envelope"></i> {{$static_data['strings']['contact']}}</a></li>
                    @if(!$static_data['user'])<li class="{{ setActive('login') }}"><a href="{{ route('login') }}"> <i class="fa fa-user"></i> {{ $static_data['strings']['sign_in'] }}</a></li>@endif
                    @if($static_data['user'] && $static_data['user']->role->id == 3 && $owner_request)<li><a class="white-button request-upgrade" data-toggle="modal" data-target="#upgrade-confirm-modal" >{{ $static_data['strings']['add_your_property'] }}</a></li>@endif
                </ul>
            </div>
        </div>
        <div class="container" id="slider">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="slider-heading">{{$static_data['strings']['opt_slider_heading']}}</h1>
                    <h4 class="slider-subheading">{{$static_data['strings']['opt_slider_subheading']}}</h4>
                    {!! Form::open(['method' => 'post', 'url' => route('search'), 'id' => 'slider-search-form']) !!}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="slider-box">
                                    <div class="form-group not-after">
                                        <input type="text" value="" name="keyword" class="form-control slider-field" placeholder="{{$static_data['strings']['keywords']}} ...">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" value="" readonly class="form-control slider-field" placeholder="{{$static_data['strings']['choose_your_location']}}">
                                        <input type="hidden" name="location_id" value="0" class="form-control slider-hidden hidden" placeholder="{{$static_data['strings']['choose_your_category']}}">
                                        <ul class="dropdown-slider-menu">
                                            <li data-id="" data-name="{{ $static_data['strings']['all'] }}">
                                                <a href="#" class="location_id_picker">
                                                    <i class="fa fa-map-marker"></i>
                                                    <span>{{ $static_data['strings']['all'] }}</span>
                                                </a>
                                            </li>
                                            @foreach($static_data['locations'] as $location)
                                                <li data-id="{{ $location->id }}" data-name="{{ $location->contentload->location }}">
                                                    <a href="#">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span>{{ $location->contentload->location }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control slider-field" placeholder="{{$static_data['strings']['choose_your_category']}}">
                                        <input type="hidden" name="category_id" value="0" class="form-control slider-hidden hidden" placeholder="{{$static_data['strings']['choose_your_category']}}">
                                        <ul class="dropdown-slider-menu">
                                            <li data-id="" data-name="{{ $static_data['strings']['all'] }}">
                                                <a href="#" class="category_id_picker">
                                                    <i class="fa fa-th-large"></i>
                                                    <span>{{ $static_data['strings']['all'] }}</span>
                                                </a>
                                            </li>
                                            @foreach($static_data['categories'] as $category)
                                                <li data-id="{{ $category->id }}" data-name="{{ $category->contentload->name }}">
                                                    <a href="#">
                                                        <i class="fa fa-th-large"></i>
                                                        <span>{{ $category->contentload->name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <button type="submit" class="primary-button"><i class="fa fa-search"></i> {{$static_data['strings']['search']}}</button>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div id="scroll-down" class="col-sm-12 text-centered">
                    <a class="scroll-down-button" href="#first-section"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <div class="discover-more"></div>
                </div>
            </div>
        </div>
    </div>
    @if($static_data['design_settings']['show_featured_locations'])
    <div id="first-section" class="container-fluid first-section">
        <div class="container first-container">
            <div class="row">
                <div class="col-sm-12 mbot20">
                    <h2 class="section-title-dark">{{$static_data['strings']['opt_fl_heading']}}</h2>
                    <p class="section-description-dark">{{$static_data['strings']['opt_fl_subheading']}}</p>
                </div>
                @foreach($f_locations as $location)
                    <div class="col-sm-6 col-md-4">
                        <div class="featured-location box-shadow">
                            <div class="inner bg-overlay">
                                <a href="{{ url('/location') .'/'. $location->alias }}">
                                    <img src="{{ url('/') .'/'. $location->home_image  }}" class="responsive-img">
                                    <h1 class="title">{{ $location->contentload->location  }}</h1>
                                    <div class="hover-overlay">
                                        <div class="hover-overlay-inner"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    @if($static_data['design_settings']['show_featured_properties'])
    <div class="container-fluid second-section">
        <div class="container second-container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="section-title-dark">{{$static_data['strings']['opt_fp_heading']}}</h2>
                    <p class="section-description-dark">{{$static_data['strings']['opt_fp_subheading']}}</p>
                </div>
            </div>
            <div class="row">
                <div id="featured-properties" class="col-sm-12 items-grid">
                    @foreach($properties as $property)
                    
                        @include('home.partials.property_grid')

                    @endforeach
                </div>
            </div>
            <div class="col-sm-12 text-centered">
                <div class="dots-navigation-1"></div>
            </div>
        </div>
    </div>
    @endif
    @if($static_data['design_settings']['show_quick_boxes'])
    <div class="container-fluid third-section bg-overlay" @if($static_data['design_settings']['qs_background']) style="background-image: url('{{URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['qs_background']}}')" @endif>
        <div class="container third-container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="section-title-light">{{$static_data['strings']['opt_qs_heading']}}</h2>
                    <p class="section-description-light">{{$static_data['strings']['opt_qs_subheading']}}</p>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="quick-boxes">
                        <div class="heading-number">1.</div>
                        <div class="main-heading">{{$static_data['strings']['opt_qs_box1_head']}}</div>
                        <div class="main-subheading">{{$static_data['strings']['opt_qs_box1_sub']}}</div>
                        <div class="description">{{$static_data['strings']['opt_qs_box1_text']}}</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="quick-boxes">
                        <div class="heading-number">2.</div>
                        <div class="main-heading">{{$static_data['strings']['opt_qs_box2_head']}}</div>
                        <div class="main-subheading">{{$static_data['strings']['opt_qs_box2_sub']}}</div>
                        <div class="description">{{$static_data['strings']['opt_qs_box2_text']}}</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="quick-boxes">
                        <div class="heading-number">3.</div>
                        <div class="main-heading">{{$static_data['strings']['opt_qs_box3_head']}}</div>
                        <div class="main-subheading">{{$static_data['strings']['opt_qs_box3_sub']}}</div>
                        <div class="description">{{$static_data['strings']['opt_qs_box3_text']}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($static_data['design_settings']['show_blog_section'] && $static_data['site_settings']['allow_blog'])
    <div class="container-fluid fourth-section">
        <div class="container fourth-container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="section-title-dark">{{$static_data['strings']['opt_lb_heading']}}</h2>
                    <p class="section-description-dark">{{$static_data['strings']['opt_lb_subheading']}}</p>
                </div>
                @foreach($posts as $post)
                <div class="items-grid col-md-4 col-sm-12">
                    <div class="item box-shadow">
                        <div class="main-image bg-overlay">
                            <img class="responsive-img" src="{{url('/').$post->image }}"/>
                        </div>
                        <div class="data">
                            <a href="{{url('/blog/post').'/'.$post->alias}}"><h3 class="item-title primary-color">{{$post->contentload->title}}</h3></a>
                            <div class="item-category">{!! str_limit(strip_tags($post->contentload->content), 120)  !!}</div>
                            <div class="small-text">{{$static_data['strings']['posted_by']}} : {{$post->user->username}} | {{$post->created_at}}</div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-sm-12 mtop20 text-centered"><a href="{{ route('blog') }}" class="black-button">{{ $static_data['strings']['view_all_blog_posts'] }}</a></div>
            </div>
        </div>
    </div>
    @endif
    @if($static_data['design_settings']['show_icons_section'])
    <div class="container-fluid fifth-section">
        <div class="container fifth-container">
            <div id="icon-boxes" class="row">
                <div class="col-md-6 col-sm-12 mbot20">
                    <div class="icon"><i class="fa {{$static_data['design_settings']['is_icon1_icon']}} 2x primary-color"></i></div>
                    <div class="title">{{$static_data['design_settings']['is_icon1_head']}}</div>
                    <div class="description">{{$static_data['design_settings']['is_icon1_text']}}</div>
                </div>
                <div class="col-md-6 col-sm-12 mbot20">
                    <div class="icon"><i class="fa {{$static_data['design_settings']['is_icon2_icon']}} 2x primary-color"></i></div>
                    <div class="title">{{$static_data['design_settings']['is_icon2_head']}}</div>
                    <div class="description">{{$static_data['design_settings']['is_icon2_text']}}</div>
                </div>
                <div class="col-md-6 col-sm-12 mtop20">
                    <div class="icon"><i class="fa {{$static_data['design_settings']['is_icon4_icon']}} 2x primary-color"></i></div>
                    <div class="title">{{$static_data['design_settings']['is_icon3_head']}}</div>
                    <div class="description">{{$static_data['design_settings']['is_icon3_text']}}</div>
                </div>
                <div class="col-md-6 col-sm-12 mtop20">
                    <div class="icon"><i class="fa {{$static_data['design_settings']['is_icon4_icon']}} 2x primary-color"></i></div>
                    <div class="title">{{$static_data['design_settings']['is_icon4_head']}}</div>
                    <div class="description">{{$static_data['design_settings']['is_icon4_text']}}</div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<div class="container-fluid footer-container">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12 footer-widgets">
                <h2 class="widget-title">{{ $static_data['strings']['about_us'] }}</h2>
                <p>{{$static_data['strings']['opt_site_description']}}</p>
            </div>
            <div class="col-md-3 col-sm-12 footer-widgets">
                <h2 class="widget-title">{{ $static_data['strings']['opt_footer_menu1_head'] }}</h2>
                <ul class="footer-menu">
                    <li><a href="{{$static_data['design_settings']['footer_menu1_link1']}}">{{$static_data['strings']['opt_footer_menu1_text1']}}</a></li>
                    <li><a href="{{$static_data['design_settings']['footer_menu1_link2']}}">{{$static_data['strings']['opt_footer_menu1_text2']}}</a></li>
                    <li><a href="{{$static_data['design_settings']['footer_menu1_link3']}}">{{$static_data['strings']['opt_footer_menu1_text3']}}</a></li>
                    <li><a href="{{$static_data['design_settings']['footer_menu1_link4']}}">{{$static_data['strings']['opt_footer_menu1_text4']}}</a></li>
                    <li><a href="{{$static_data['design_settings']['footer_menu1_link5']}}">{{$static_data['strings']['opt_footer_menu1_text5']}}</a></li>                    </ul>
            </div>
            <div class="col-md-3 col-sm-12 footer-widgets">
                <h2 class="widget-title">{{ $static_data['strings']['opt_footer_menu2_head'] }}</h2>
                <ul class="footer-menu">
                    <li><a href="{{$static_data['design_settings']['footer_menu2_link1']}}">{{$static_data['strings']['opt_footer_menu2_text1']}}</a></li>
                    <li><a href="{{$static_data['design_settings']['footer_menu2_link2']}}">{{$static_data['strings']['opt_footer_menu2_text2']}}</a></li>
                    <li><a href="{{$static_data['design_settings']['footer_menu2_link3']}}">{{$static_data['strings']['opt_footer_menu2_text3']}}</a></li>
                    <li><a href="{{$static_data['design_settings']['footer_menu2_link4']}}">{{$static_data['strings']['opt_footer_menu2_text4']}}</a></li>
                    <li><a href="{{$static_data['design_settings']['footer_menu2_link5']}}">{{$static_data['strings']['opt_footer_menu2_text5']}}</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 footer-widgets">
                <h2 class="widget-title">{{ $static_data['strings']['contact'] }}</h2>
                <ul class="footer-menu">
                    @if($static_data['site_settings']['location_address'] || $static_data['site_settings']['location_city'] || $static_data['site_settings']['location_country'])<li><a href="#"><i class="fa fa-home"></i> {{ $static_data['site_settings']['location_address'].', '.$static_data['site_settings']['location_city'].', '.$static_data['site_settings']['location_state'].' - '.$static_data['site_settings']['location_country'] }}</a></li>@endif
                    @if($static_data['site_settings']['contact_tel1'])<li><a href="tel:{{ $static_data['site_settings']['contact_tel1'] }}"><i class="fa fa-phone"></i> {{ $static_data['site_settings']['contact_tel1'] }}</a></li>@endif
                    @if($static_data['site_settings']['contact_tel2'])<li><a href="tel:{{ $static_data['site_settings']['contact_tel2'] }}"><i class="fa fa-phone"></i> {{ $static_data['site_settings']['contact_tel2'] }}</a></li>@endif
                    @if($static_data['site_settings']['contact_fax'])<li><a href="tel:{{ $static_data['site_settings']['contact_fax'] }}"><i class="fa fa-fax"></i>{{ $static_data['site_settings']['contact_fax'] }}</a></li>@endif
                    @if($static_data['site_settings']['contact_email'])<li><a href="mailto:{{ $static_data['site_settings']['contact_email'] }}"><i class="fa fa-envelope"></i>{{ $static_data['site_settings']['contact_email'] }}</a></li>@endif
                    @if($static_data['site_settings']['contact_web'])<li><a href="{{ $static_data['site_settings']['contact_web'] }}"><i class="fa fa-globe"></i> {{ $static_data['site_settings']['contact_web'] }}</a></li>@endif
                </ul>
            </div>
            @if($static_data['design_settings']['footer_social'])
                <div class="col-sm-12 footer-divider"></div>
                <div class="col-sm-12 footer-social footer-widgets">
                    <h2 class="widget-title">{{ $static_data['strings']['follow_us'] }}</h2>
                    <ul class="social-icons">
                        @if($static_data['site_settings']['social_facebook']) <li><a href="{{ $static_data['site_settings']['social_facebook'] }}" target="_blank"><i class="fa fa-facebook"></i></a></li> @endif
                        @if($static_data['site_settings']['social_twitter']) <li><a href="{{ $static_data['site_settings']['social_twitter'] }}" target="_blank"><i class="fa fa-twitter"></i></a></li>@endif
                        @if($static_data['site_settings']['social_youtube'])  <li><a href="{{ $static_data['site_settings']['social_youtube'] }}" target="_blank"><i class="fa fa-youtube"></i></a></li>@endif
                        @if($static_data['site_settings']['social_instagram'])  <li><a href="{{ $static_data['site_settings']['social_instagram'] }}" target="_blank"><i class="fa fa-instagram"></i></a></li>@endif
                        @if($static_data['site_settings']['social_google_plus'])  <li><a href="{{ $static_data['site_settings']['social_google_plus'] }}" target="_blank"><i class="fa fa-google-plus"></i></a></li>@endif
                        @if($static_data['site_settings']['social_pinterest'])  <li><a href="{{ $static_data['site_settings']['social_pinterest'] }}" target="_blank"><i class="fa fa-pinterest"></i></a></li>@endif
                        @if($static_data['site_settings']['social_linkedin'])  <li><a href="{{ $static_data['site_settings']['social_linkedin'] }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>@endif
                        @if($static_data['site_settings']['social_tripadvisor'])  <li><a href="{{ $static_data['site_settings']['social_tripadvisor'] }}" target="_blank"><i class="fa fa-tripadvisor"></i></a></li>@endif
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="row copyright-row">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 copyright">
                    <p>{{ $static_data['strings']['copyright'] . date('Y') . ' ' . $static_data['strings']['rights_reserved'] . get_setting('site_name', 'site')}}</p>
                </div>
                <div class="col-sm-6 powered-by">
                    <p>{!! $static_data['strings']['powered_by'] !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>  --}}
{{-- {{dd($properties)}} --}}

{{-- new --}}

      <header>
    <!-- Navigation -->
    <nav class="navbar navbar-home navbar-expand-lg bg-white fixed-top">
      <div class="w-100 px-5">
        <a class="navbar-brand position-absolute" href="#">
          <img class="logo hover-translate-y-n3" src="assets/estay/images/logo/footer-logo.png" alt="estay logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
          aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="nav-social navbar-nav d-flex align-items-center">
            <li class="nav-item">
              <a class="nav-link text-primary-1">Theo dõi chúng tôi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img class="icon hover-translate-y-n3" src="assets/estay/images/icon/twitter.png" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img class="icon hover-translate-y-n3" src="assets/estay/images/icon/facebook.png" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img class="icon hover-translate-y-n3" src="assets/estay/images/icon/instagram.png" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <img class="icon hover-translate-y-n3" src="assets/estay/images/icon/youtube.png" />
              </a>
            </li>
          </ul>

          <div class="dropdown ml-auto">
            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Giao diện khác
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="home-1.html">Giao diện 1</a>
              <a class="dropdown-item" href="home-2.html">Giao diện 2</a>
              <a class="dropdown-item" href="#">Giao diện 3</a>
            </div>
          </div>

          <ul class="nav-action navbar-nav d-flex align-items-center ml-auto">
            <li class="nav-item">
              <a class="m-2 btn btn-primary-2 hover-btn">Đăng Ký Cho Thuê Nhà</a>
            </li>
                                <li class="nav-item dropdown dropdown-lg border-left">
                                <a href="#" class="nav-link dropdown-toggle text-dark" id="language-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if(Session::has('language'))
                                    @foreach($static_data['languages'] as $language)
                                        @if(Session::get('language'))
                                            @if(strpos(Session::get('language'), $language->code) !== false)
                                                <img class="icon hover-translate-y-n3" src="{{$language->flag}}" /> {{$language->language}}
                                            @endif
                                        @endif
                                    @endforeach
                                    @else
                                        {{$default_language->language}}
                                    @endif
                                </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="language-dropdown">
                                        @foreach($static_data['languages'] as $language)
                                            <a class="dropdown-item language-switcher" data-code="{{$language->code}}" href="#"><img class="icon hover-translate-y-n3" src="{{$language->flag}}" /> {{$language->language}}</a>
                                        @endforeach
                                    </div>
                                </li>
            <li class="nav-item border-left">
              <a href="{{ route('login') }}" class="nav-link text-primary-1 text-uppercase font-weight-bold" href="#">
               {{ $static_data['strings']['sign_in'] }}
              </a>
            </li>
            <li class="nav-item border-left">
              <a href="{{ route('register')}}" class="m-2 btn btn-primary-2 hover-btn text-uppercase font-weight-bold">
               {{$static_data['strings']['register']}}
              </a>
            </li>
          </ul>
        </div>
        <div class="megamenu navbar-menu position-absolute">
            <a href="#" id="dropdownMegamenu" data-toggle="dropdown">
              <img class="logo hover-translate-y-n3 shadow-primary" src="assets/estay/images/icon/menu.png"/ alt="estay">
            </a>
            <div class="dropdown-menu py-4" aria-labelledby="dropdownMegamenu">
              <div class="container">
                <div class="row w-100">
                  <div class="col-md-4">
                    <div class="megamenu-title mb-3">Về Estay</div>
                    <ul class="list-unstyled">
                        <li class="nav-item"><a class="nav-link" href="#">Câu chuyện của Estay</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Địa chỉ</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Tin tưởng & An toàn</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Tin tức</a></li>
                    </ul>
                  </div>
                  <div class="col-md-4">
                    <div class="megamenu-title mb-3">Người dùng</div>
                    <ul class="list-unstyled">
                        <li class="nav-item"><a class="nav-link" href="#">Đăng ký</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Đăng nhập</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Thanh toán</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Trung tâm trợ giúp</a></li>
                    </ul>
                  </div>
                  <div class="col-md-4">
                    <div class="megamenu-title mb-3">Đối tác</div>
                    <ul class="list-unstyled">
                        <li class="nav-item"><a class="nav-link" href="#">Đăng ký đối tác</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Trung tâm đối tác</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Chính sách</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Điều khoản dịch vụ</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    </nav>
    <!-- END NAV -->
    <div class="hero">
      <img class="slogan-banner" src="assets/estay/images/banner/banner01.png" />
      <a class="btn-change-bg">Thay đổi hình nền</a>

    </div>
    <!-- END HERO -->
    <div class="search-form-wrapper w-100 px-5 py-3">
      <form class="search-form">
        <div class="row p-2">
          <div class="col-lg-3 col-md-12">
            <div class="form-group form-icon search mb-0">
              <input type="text" class="form-control mh-50" placeholder="Nhập địa điểm du lịch hoặc tên khách sạn">
            </div>
          </div>
          <div class="col-lg-3 col-md-12">
            <div class="form-group form-icon date mb-0">
              <span class="check-in">Check-in</span>
              <span class="check-out">Check-out</span>
              <input type="datetime" readonly class="form-control mh-50" name="daterange" value="" />
            </div>
          </div>
          <div class="col-lg-3 col-md-12">
            <div class="dropdown form-group form-icon guests mb-0">
              <button class="btn-block form-control mh-50" type="button" id="guestsdropdown" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span>2 người lớn</span> -
                <span>1 trẻ em</span> -
                <span>1 phòng</span>
              </button>
              <div id="dropdownOpen" class="dropdown-menu w-100 p-3" aria-labelledby="guestsdropdown">
                <div class="row">
                  <div class="col-md-12 py-2">
                    <div class="row">
                      <div class="col-md-7 col-sm-12">
                        Người lớn
                      </div>
                      <div class="col-md-5 col-sm-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-primary-2">+</button>
                          <input type="text" readonly value="0" class="form-control" />
                          <button type="button" class="btn btn-primary-2">-</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 py-2">
                    <div class="row">
                      <div class="col-md-7 col-sm-12">
                        Trẻ em
                      </div>
                      <div class="col-md-5 col-sm-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-primary-2">+</button>
                          <input type="text" readonly value="0" class="form-control" />
                          <button type="button" class="btn btn-primary-2">-</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 py-2">
                    <div class="row">
                      <div class="col-md-7 col-sm-12">
                        Phòng
                      </div>
                      <div class="col-md-5 col-sm-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-primary-2">+</button>
                          <input type="text" readonly value="0" class="form-control" />
                          <button type="button" class="btn btn-primary-2">-</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 py-2">
                    <label for="childrenSelect">Chọn tuổi của trẻ đi cùng</label>
                    <select class="form-control" id="childrenSelect">
                      <option value="0">0 tuổi</option>
                      <option value="1">1 tuổi</option>
                      <option value="2">2 tuổi</option>
                      <option value="3">3 tuổi</option>
                      <option value="4">4 tuổi</option>
                      <option value="5">5 tuổi</option>
                      <option value="6">6 tuổi</option>
                      <option value="7">7 tuổi</option>
                      <option value="8">8 tuổi</option>
                      <option value="9">9 tuổi</option>
                      <option value="10">10 tuổi</option>
                      <option value="11">11 tuổi</option>
                      <option value="12">12 tuổi</option>
                      <option value="13">13 tuổi</option>
                      <option value="14">14 tuổi</option>
                      <option value="15">15 tuổi</option>
                      <option value="16">16 tuổi</option>
                      <option value="17">17 tuổi</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-12">
            <button type="button" class="btn btn-search btn-primary-2 btn-block mh-50">TÌM</button>
          </div>
          <div class="col-lg-1 col-md-3 text-right">
            <button type="button" class="btn btn-chat btn-primary-2">
              <img class="icon" src="assets/estay/images/icon/chat.png" />
            </button>
          </div>
        </div>
      </form>
    </div>
    <!-- END SEARCH FORM -->
  </header>
  <!-- End header -->
  
  <!-- Chat Box-->
  <div class="chatbox-wrapper card shadow-secondary">
    <div class="chatbox-header p-2">Chat
      <a class="btn-chat float-right"><img class="icon-sm" src="assets/estay/images/icon/close-primary.svg"/></a>
    </div>
    <div class="px-4 py-5 chat-box card-body">
      <!-- Sender Message-->
      <div class="media mb-3"><img src="assets/estay/images/icon/vector-avatars-1.png" alt="user" width="50"
          class="rounded-circle">
        <div class="media-body ml-3">
          <div class="bg-light rounded py-2 px-3 mb-2">
            <p class="text-small mb-0 text-muted">Anh và tôi thật ra gặp nhau và quen nhau cũng đã được mấy
              năm, mà chẳng có chi hơn lời hỏi thăm</p>
          </div>
          <p class="small text-muted">12:00 PM | Aug 13</p>
        </div>
      </div>

      <!-- Reciever Message-->
      <div class="media ml-auto mb-3">
        <div class="media-body">
          <div class="bg-primary rounded py-2 px-3 mb-2">
            <p class="text-small mb-0 text-white">rằng giờ này đã ăn sáng chưa? ở bên đấy nắng hay mưa?</p>
          </div>
          <p class="small text-muted">12:00 PM | Aug 13</p>
        </div>
      </div>

      <!-- Sender Message-->
      <div class="media mb-3"><img src="assets/estay/images/icon/vector-avatars-1.png" alt="user" width="50"
          class="rounded-circle">
        <div class="media-body ml-3">
          <div class="bg-light rounded py-2 px-3 mb-2">
            <p class="text-small mb-0 text-muted">Anh và tôi thật ra Mm, Mmm mải mê nhìn lén nhau, Và không
              một ai nói nên câu</p>
          </div>
          <p class="small text-muted">12:00 PM | Aug 13</p>
        </div>
      </div>

      <!-- Reciever Message-->
      <div class="media ml-auto mb-3">
        <div class="media-body">
          <div class="bg-primary rounded py-2 px-3 mb-2">
            <p class="text-small mb-0 text-white">Rằng người ơi tôi đang nhớ anh, Và anh có nhớ tôi không?</p>
          </div>
          <p class="small text-muted">12:00 PM | Aug 13</p>
        </div>
      </div>

      <!-- Sender Message-->
      <div class="media mb-3"><img src="assets/estay/images/icon/vector-avatars-1.png" alt="user" width="50"
          class="rounded-circle">
        <div class="media-body ml-3">
          <div class="bg-light rounded py-2 px-3 mb-2">
            <p class="text-small mb-0 text-muted">Tôi... từ lâu đã thích anh rồi, Chỉ mong hai ta thành đôi
            </p>
          </div>
          <p class="small text-muted">12:00 PM | Aug 13</p>
        </div>
      </div>

      <!-- Reciever Message-->
      <div class="media ml-auto mb-3">
        <div class="media-body">
          <div class="bg-primary rounded py-2 px-3 mb-2">
            <p class="text-small mb-0 text-white">Anh nhà ở đâu thế?</p>
          </div>
          <p class="small text-muted">12:00 PM | Aug 13</p>
        </div>
      </div>

    </div>

    <!-- Typing area -->
    <form action="#" class="bg-light">
      <div class="input-group">
        <div contentEditable="true" placeholder="Type a message" aria-describedby="button-addon2"
          class="form-control chatinput rounded-0 border-0 py-2 bg-light">
          Anh nhà ở đâu...
        </div>
        <div class="input-group-append">
          <input class="d-none" type="file" id="FileUpload"/>
          <button onclick='$("#FileUpload").click()' id="button-addon2" type="file" class="btn btn-link">
            <img class="icon-sm" src="assets/estay/images/icon/attach.svg" />
          </button>
        </div>
        <div class="input-group-append">
          <button id="button-addon2" type="submit" class="btn btn-link">
            <img class="icon-sm" src="assets/estay/images/icon/send.svg" />
          </button>
        </div>
      </div>
    </form>

  </div>
  <!-- End Chat Box -->

  <!-- Main -->
  <div class="main">
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-12 text-left">
            <div class="section-title mb-4 pb-2">
              <h4 class="title mb-1">Voucher Hấp Dẫn</h4>
              <div class="d-flex justify-content-between">
                <p class="para-desc mb-0 d-block w-100">Nhận giá tốt nhất cho > 2.000.000 chổ nghỉ, trên toàn cầu.</p>
                <a href="#" class="btn btn-estay-primary">Xem tất cả</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="item-slider d-flex justify-content-center">

         @foreach($properties as $property)
           @include('home.partials.property_grid')
         @endforeach   
    </section>

    <section class="section">
      <div class="container">
        <div class="col-12 text-left">
          <div class="section-title mb-4 pb-2">
            <h4 class="title mb-1">Tìm Theo Loại Chổ Nghỉ</h4>
            <div class="d-flex justify-content-between">
              <p class="para-desc mb-0 d-block w-100">Nhận giá tốt nhất cho > 2.000.000 chổ nghỉ, trên toàn cầu.</p>
              <a href="#" class="btn btn-estay-primary">Xem tất cả</a>
            </div>
          </div>
        </div>
      </div>
      <div class="category-slider d-flex justify-content-center">
        <div class="item">
          <a href="listing.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/canho.jpg"/>
          </a>
          <div class="item-body p-3">
            <h3 class="item-title">
              <img class="icon-sm mr-1" src="assets/estay/images/icon/pin-dark.svg"/>
              <a href="listing.html">Căn hộ</a>
            </h3>
            <p class="mb-0 amount">1500 resort</p>
          </div>
        </div>
        <!-- End item -->
        <div class="item">
          <a href="listing.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/canho.jpg"/>
          </a>
          <div class="item-body p-3">
            <h3 class="item-title">
              <img class="icon-sm mr-1" src="assets/estay/images/icon/pin-dark.svg"/>
              <a href="listing.html">Căn hộ</a>
            </h3>
            <p class="mb-0 amount">1500 resort</p>
          </div>
        </div>
        <!-- End item -->
        <div class="item">
          <a href="listing.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/canho.jpg"/>
          </a>
          <div class="item-body p-3">
            <h3 class="item-title">
              <img class="icon-sm mr-1" src="assets/estay/images/icon/pin-dark.svg"/>
              <a href="listing.html">Căn hộ</a>
            </h3>
            <p class="mb-0 amount">1500 resort</p>
          </div>
        </div>
        <!-- End item -->
        <div class="item">
          <a href="listing.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/canho.jpg"/>
          </a>
          <div class="item-body p-3">
            <h3 class="item-title">
              <img class="icon-sm mr-1" src="assets/estay/images/icon/pin-dark.svg"/>
              <a href="listing.html">Căn hộ</a>
            </h3>
            <p class="mb-0 amount">1500 resort</p>
          </div>
        </div>
        <!-- End item -->
        <div class="item">
          <a href="listing.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/canho.jpg"/>
          </a>
          <div class="item-body p-3">
            <h3 class="item-title">
              <img class="icon-sm mr-1" src="assets/estay/images/icon/pin-dark.svg"/>
              <a href="listing.html">Căn hộ</a>
            </h3>
            <p class="mb-0 amount">1500 resort</p>
          </div>
        </div>
        <!-- End item -->
        <div class="item">
          <a href="listing.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/canho.jpg"/>
          </a>
          <div class="item-body p-3">
            <h3 class="item-title">
              <img class="icon-sm mr-1" src="assets/estay/images/icon/pin-dark.svg"/>
              <a href="listing.html">Căn hộ</a>
            </h3>
            <p class="mb-0 amount">1500 resort</p>
          </div>
        </div>
        <!-- End item -->
      </div>
    </section>

  </div>
  
  <footer>
    <section class="section bg-light footer-top-menu">
      <div class="container">
        <div class="row">
            <div class="col">
              <h5>Trợ giúp</h5>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
            </div>
            <div class="col">
              <h5>Trợ giúp</h5>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
            </div>
            <div class="col">
              <h5>Trợ giúp</h5>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
            </div>
            <div class="col">
              <h5>Trợ giúp</h5>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
            </div>
            <div class="col">
              <h5>Trợ giúp</h5>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
              <p class="mb-0">
                <a href="#">Trung tâm trợ giúp</a>
              </p>
            </div>
        </div>
      </div>
    </section>
    <section class="section footer-secondary-menu">
      <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6">
              <h6>Quốc gia/Vùng lãnh thổ</h6>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
            </div>
        </div>
      </div>
    </section>
    <section class="section bg-light copyright">
      <div class="container-fluid px-5">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 text-right text">
            Bản Quyền Thuộc <b>Công Ty TNHH ABC</b>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 text-right">
            <a href="{{ $static_data['site_settings']['social_facebook'] }}" class="m-1 img-social">
              <img class="icon-md" src="assets/estay/images/icon/facebook.png"/>
            </a>
            <a href="{{$static_data['site_settings']['social_twitter']}}" class="m-1 img-social">
              <img class="icon-md" src="assets/estay/images/icon/twitter.png"/>
            </a>
            <a href="{{$static_data['site_settings']['social_instagram']}}" class="m-1 img-social">
              <img class="icon-md" src="assets/estay/images/icon/instagram.png"/>
            </a>
            <a href="{{$static_data['site_settings']['social_youtube']}}" class="m-1 img-social">
              <img class="icon-md" src="assets/estay/images/icon/youtube.png"/>
            </a>
          </div>
        </div>
      </div>
    </section>

  </footer>


  <script src="{{URL::asset('assets/estay/js/vendor/modernizr-3.8.0.min.js')}}"></script>
<script src="{{URL::asset('assets/estay/js/vendor/jquery-3.4.1.min.js')}}"></script>

<script src="{{URL::asset('assets/js/plugins/tether.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/slick.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/slidereveal.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/toast.min.js')}}"></script>
<script type="text/javascript">
    window.paceOptions = {
        ajax: false,
        restartOnRequestAfter: false,
    };
</script>

<script src="{{URL::asset('assets/estay/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::asset('assets/estay/js/vendor/moment.min.js')}}"></script>
<script src="{{URL::asset('assets/estay/js/vendor/daterangepicker.min.js')}}"></script>
<script src="{{URL::asset('assets/estay/js/vendor/js/vendor/slick.min.js')}}"></script>
<script src="{{URL::asset('assets/estay/js/js/plugins.js')}}"></script>
<script src="{{URL::asset('assets/estay/js/main.js')}}"></script>


{{-- <script src="{{URL::asset('assets/js/plugins/jquery.min.js')}}"></script> --}} --}}
{{-- <script src="{{URL::asset('assets/js/plugins/bootstrap.min.js')}}"></script> --}}
<script src="{{URL::asset('assets/js/home_init.js')}}"></script>
<script type="text/javascript">
</script>
{!! csrf_field() !!}
@if($static_data['user'] && $owner_request)
<div class="modal fade" id="upgrade-confirm-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ $static_data['strings']['confirm_action'] }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $static_data['strings']['upgrade_request_confirm'] }}
            </div>
            <div class="modal-footer">
                <button type="button" class="primary-button" data-dismiss="modal">{{ $static_data['strings']['close'] }}</button>
                <a href="#" data-id="{{ $static_data['user']->id }}" class="primary-button confirm-request" data-dismiss="modal">{{ $static_data['strings']['request'] }}</a>
            </div>
            <script type="text/javascript">
                $(document).ready(function(){
                    $('.confirm-request').click(function(e){
                        e.preventDefault();
                        var id = $(this).data('id'),
                            token = $('[name="_token"]').val();
                        $.ajax({
                            url: '{{ url('/user-request') }}',
                            type: 'post',
                            data: {_token: token, id: id},
                               success: function(){
                               toastr.success('{{ $static_data['strings']['text_for_request'] }}');
                                setTimeout(function(){location.reload();}, 1200);

                        }
                    });
                });
                });
            </script>
        </div>
    </div>
</div>
@endif
</body>
</html>