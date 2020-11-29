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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Exo+2:400,700,900&amp;subset=cyrillic,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&amp;subset=cyrillic,latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/tether.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/bootstrap.min.css') }}">
    <link href="{{ URL::asset('assets/css/plugins/toast.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/slick.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/home_style.css') }}">
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
<body>
<div class="cover"></div>
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
</div>
<script src="{{URL::asset('assets/js/plugins/jquery.min.js')}}"></script>
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
<script src="{{URL::asset('assets/js/plugins/bootstrap.min.js')}}"></script>
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