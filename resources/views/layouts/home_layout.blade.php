<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    @yield('title')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Exo+2:400,700,900&amp;subset=cyrillic,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&amp;subset=cyrillic,latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/tether.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/slick.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/bootstrap.min.css') }}">
    <link href="{{ URL::asset('assets/css/plugins/toast.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/home_style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/home_layout.css') }}">
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
    @yield('head')
    {!! $custom_css !!}
</head>
<body class="home-layout">
<div class="cover"></div>
<div class="wrapper">
        <div class="container-fluid header-container" style="background-image: url(@yield('bg'))">
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
                            <li><a href="{{ route('message') }}"><i class="fa fa-envelope"></i> {{$static_data['strings']['messages']}}</a></li>
                            @endif
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
                            <li><a href="{{route('home')}}">{{$static_data['strings']['home']}}</a></li>
                            @if(get_setting('services_allowed', 'service'))<li class="{{ setActive('explore') }}">
                                <a class="dropdown-toggle" id="explore-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$static_data['strings']['explore']}}</a>
                                <div class="dropdown-menu" aria-labelledby="explore-dropdown">
                                    <a href="{{ route('explore_properties') }}"><div class="dropdown-item">{{$static_data['strings']['properties']}}</div></a>
                                    <a href="{{ route('explore_services') }}"><div class="dropdown-item">{{$static_data['strings']['services']}}</div></a>
                                </div>
                            </li>
                            @else
                                <li class="{{ setActive('explore') }}"><a href="{{ route('explore_properties') }}">{{$static_data['strings']['properties']}}</a></li>
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
                @if($static_data['user'] && $static_data['user']->role->id == 3 && $owner_request)<li><a class="request-upgrade" data-toggle="modal" data-target="#upgrade-confirm-modal" >{{ $static_data['strings']['add_your_property'] }}</a></li>@endif
            </ul>
        </div>
    </div>
    <div class="container-fluid main-content">
        <div class="container main-container box-shadow">
            @yield('content')
        </div>
    </div>
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
@yield('footer')
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