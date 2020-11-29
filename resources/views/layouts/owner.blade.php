<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

    @yield('title')

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,500,600,700&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/plugins/backend_materialize.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/plugins/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/plugins/toast.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/plugins/summernote.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/plugins/dropzone.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/backend_style.css')}}" rel="stylesheet">
    @if(get_setting('google_analytics', 'site'))
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', '{{ get_setting('google_analytics', 'site') }}', 'auto');
            ga('send', 'pageview');

        </script>
    @endif

    @yield('style')

</head>
<body class="mtop20">
<div class="cover"></div>
    <div class="container header-container z-depth-1">
        <div class="row no-pad-bot mbot0">
            <nav>
                <div id="header-left" class="col l10 m12 s12 header-col">
                    <div id="logo" class="col s6 m6">
                        <p class="date-text">{{date('l, jS \of F Y')}}</p>
                        <a href="{{route('owner_dashboard')}}" class="brand-logo">{{get_string('booksi')}}<span>{{get_string('cms')}}</span></a>
                    </div>
                    <div id="navigation">
                        <ul class="hide-on-med-and-down clearfix">
                            <li class="{{ setActive('owner/dashboard') }}"><a href="{{route('owner_dashboard')}}">{{get_string('dashboard')}}</a></li>
                                @if(get_setting('show_add_points_menu','payment'))<li  class="{{ setActive('owner/points') }}"><a href="{{route('owner_points')}}" class="">{{get_string('add_points')}} <i class="material-icons tiny color-white" style="vertical-align: text-top;">add_circle</i></a></li>@endif
                                @if(get_setting('show_price_menu','payment'))<li  class="{{ setActive('owner/prices') }}"><a href="{{route('owner_prices')}}" class="">{{get_string('prices')}}</a></li>@endif
                                <li class="{{ setActive('owner/property') }}"><a href="{{route('owner.property.index')}}">{{get_string('properties')}}</a></li>
                                @if(get_setting('services_allowed', 'service') && get_setting('allow_owners_services', 'owner'))<li class="{{ setActive('owner/service') }}"><a href="{{route('owner.service.index')}}">{{get_string('services')}}</a></li>@endif
                                <li  class="{{ setActive('owner/booking') }}"><a href="{{route('owner_booking')}}">{{get_string('bookings')}}</a></li>
                                <li  class="{{ setActive('owner/review') }}"><a href="{{route('owner_review')}}">{{get_string('reviews')}}</a></li>
                                <li  class="{{ setActive('owner/purchase') }}"><a href="{{route('owner_purchases')}}">{{get_string('purchases')}}</a></li>

                                @if(get_setting('enable_messages', 'user'))
                                    <li class="{{ setActive('owner/message') }}"><a href="{{route('owner_message')}}">{{get_string('messages')}}</a></li>
                                @endif
                                <li  class="{{ setActive('owner/activity') }}"><a href="{{route('owner_activities')}}">{{get_string('activities')}}</a></li>
                                <li  class="{{ setActive('owner/withdrawal') }}"><a href="{{route('owner_withdrawal')}}">{{get_string('withdrawals')}}</a></li>
                                 <li  class="{{ setActive('owner/list-payment') }}"><a href="{{route('owner_list_payment')}}">{{get_string('payments')}}</a></li>
                                <li  class="{{ setActive('owner/faq') }}"><a href="{{route('owner_faq')}}">{{get_string('faq')}}</a></li>
                        </ul>
                    </div>
                    <div class="col s6 show-on-small">
                        <ul id="slide-out" class="side-nav">
                            <li class="{{ setActive('owner/dashboard') }}"><a href="{{route('owner_dashboard')}}">{{get_string('dashboard')}}</a></li>
                                @if(get_setting('show_add_points_menu','payment'))<li  class="{{ setActive('owner/points') }}"><a href="{{route('owner_points')}}" class="">{{get_string('add_points')}} <i class="material-icons tiny color-white" style="vertical-align: text-top;">add_circle</i></a></li>@endif
                                @if(get_setting('show_price_menu','payment'))<li  class="{{ setActive('owner/prices') }}"><a href="{{route('owner_prices')}}" class="">{{get_string('prices')}}</a></li>@endif
                                <li class="{{ setActive('owner/property') }}"><a href="{{route('owner.property.index')}}">{{get_string('properties')}}</a></li>
                                @if(get_setting('services_allowed', 'service') && get_setting('allow_owners_services', 'owner'))<li class="{{ setActive('owner/service') }}"><a href="{{route('owner.service.index')}}">{{get_string('services')}}</a></li>@endif
                                <li  class="{{ setActive('owner/booking') }}"><a href="{{route('owner_booking')}}">{{get_string('bookings')}}</a></li>
                                <li  class="{{ setActive('owner/review') }}"><a href="{{route('owner_review')}}">{{get_string('reviews')}}</a></li>
                                <li  class="{{ setActive('owner/purchase') }}"><a href="{{route('owner_purchases')}}">{{get_string('purchases')}}</a></li>
                                <li class="{{ setActive('owner/message') }}"><a href="{{route('owner_message')}}">{{get_string('messages')}}</a></li>
                                <li  class="{{ setActive('owner/activity') }}"><a href="{{route('owner_activities')}}">{{get_string('activities')}}</a></li>
                                <li  class="{{ setActive('owner/withdrawal') }}"><a href="{{route('owner_withdrawal')}}">{{get_string('withdrawals')}}</a></li>
                                <li  class="{{ setActive('owner/list-payment') }}"><a href="{{route('owner_list_payment')}}">{{get_string('payments')}}</a></li>
                                <li  class="{{ setActive('owner/faq') }}"><a href="{{route('owner_faq')}}">{{get_string('faq')}}</a></li>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header {{ setActive('owner/my_account') }}" href="#">{{get_string('my_account')}}<i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li class="{{ setActive('owner/my_account') }}"><a href="{{route('owner_my_account')}}">{{get_string('my_account')}}</a></li>
                                                <li><a href="{{route('owner_logout')}}">{{get_string('logout')}}</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#">{{get_string('my_website')}}</a></li>
                        </ul>
                        <a href="#" data-activates="slide-out" class="button-collapse menu-button"><i class="material-icons">menu</i></a>
                    </div>
                </div>
                <div id="header-right" class="col s2 header-col hide-on-med-and-down">
                    <div class="user-box">
                        @if(Auth::user()->owner)
                        <div class="user-img">
                            <img src="{{ Auth::user()->owner->logo}}" alt="user-img" title="{{Auth::user()->username}}" class="responsive-img">
                        </div>
                        @endif
                        <div class="user-icons">
                                <span class="user-name">{{Auth::user()->username}}</span>
                                <span class="user-role">{{ get_string('points') }}: {{Auth::user()->owner->points}} </span>
                                <a href="{{config('app.url')}}" title="{{get_string('my_website')}}"><i class="material-icons tiny color-white">input</i></a>
                                <a href="{{route('owner_my_account')}}" title="{{get_string('my_account')}}"><i class="material-icons tiny color-white">settings</i></a>
                                <a href="{{route('owner_logout')}}" title="{{get_string('logout')}}"><i class="material-icons tiny color-red">power_settings_new</i></a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="container home-container z-depth-1">
        <div class="row mbot0">
            <div class="col s12">
    @yield('page_title')
            </div>
    @yield('content')
        </div>
    </div>
    <div class="container footer-container">
        <div class="row">
            <div class="col s12 text-centered">
                <p> {{ get_string('copyright') . date('Y') . ' ' . get_string('rights_reserved') . get_setting('site_name', 'site')}} | {!! get_string('powered_by')  !!}</p>
            </div>
        </div>
    </div>
<!--  Scripts-->
<script src="{{URL::asset('assets/js/plugins/jquery.min.js')}}"></script>
<script type="text/javascript">
    window.paceOptions = {
        ajax: false,
        restartOnRequestAfter: false,
    };
</script>
<script src="{{URL::asset('assets/js/plugins/backend_bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/backend_plugins.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/waypoints.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/waves.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/toast.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/jquery-ui.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/counter.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/summernote.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/dropzone.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/bootbox.min.js')}}"></script>
<script src="{{URL::asset('assets/js/backend_init.js')}}"></script>

<script type="text/javascript">
    // Mobile Menu
$('.button-collapse').sideNav({
    menuWidth: 240,
    edge: 'right',
    closeOnClick: true,
    draggable: true
});
</script>
    @yield('footer')
</body>
</html>
