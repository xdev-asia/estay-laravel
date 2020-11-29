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
    <link href="{{ URL::asset('assets/css/plugins/colorpicker.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/backend_style.css')}}" rel="stylesheet">
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
                        <a href="{{route('admin_dashboard')}}" class="brand-logo">{{get_string('booksi')}}<span>{{get_string('cms')}}</span></a>
                    </div>
                    <div id="navigation">
                        <ul class="hide-on-med-and-down clearfix">
                            <li class="{{ setActive('admin/dashboard') }}"><a href="{{route('admin_dashboard')}}">{{get_string('dashboard')}}</a></li>
                            <li class="{{ setActive('admin/property') }}"><a href="{{route('admin.property.index')}}">{{get_string('properties')}}</a></li>
                            @if(get_setting('services_allowed', 'service'))<li class="{{ setActive('admin/service') }}"><a href="{{route('admin.service.index')}}">{{get_string('services')}}</a></li>@endif
                            <li class="{{ setActive('admin/taxonomy') }}">
                                <a href="#">{{get_string('taxonomy')}}<i class="material-icons tiny">arrow_drop_down</i></a>
                                    <ul class="sub-menu">
                                    <li><a href="{{route('admin.taxonomy.category.index')}}">{{get_string('categories')}}</a></li>
                                    <li><a href="{{route('admin.taxonomy.location.index')}}">{{get_string('locations')}}</a></li>
                                    <li><a href="{{route('admin_taxonomy_feature')}}">{{get_string('features')}}</a></li>
                                </ul>
                            </li>
                            <li  class="{{ setActive('admin/booking') }} {{ setActive('admin/payment') }}">
                                <a href="#">{{get_string('bookings')}}<i class="material-icons tiny">arrow_drop_down</i></a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('admin_booking')}}">{{get_string('bookings')}}</a></li>
                                    <li><a href="{{route('admin_payment')}}">{{get_string('payments')}}</a></li>
                                </ul>
                            </li>
                            <li  class="{{ setActive('admin/review') }}"><a href="{{route('admin_review')}}">{{get_string('reviews')}}</a></li>
                            <li class="{{ setActive('admin/page') }}"><a href="{{route('admin.page.index')}}">{{get_string('pages')}}</a></li>
                            <li class="{{ setActive('admin/blog') }}"><a href="{{route('admin.blog.index')}}">{{get_string('blog')}}</a></li>
                            <li class="{{ setActive('admin/user') }}">
                                <a href="#">{{get_string('users')}}<i class="material-icons tiny">arrow_drop_down</i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('admin_users')}}">{{get_string('users')}}</a></li>
                                    <li><a href="{{route('admin_users_request')}}">{{get_string('requests')}}</a></li>
                                </ul>
                            </li>
                            <li class="{{ setActive('admin/owner') }} {{ setActive('admin/faq') }}">
                                <a href="#">{{get_string('owners')}}<i class="material-icons tiny">arrow_drop_down</i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('admin_owner') }}">{{get_string('owners')}}</a></li>
                                    <li><a href="{{ route('admin_owner_activity') }}">{{get_string('activities')}}</a></li>
                                    <li><a href="{{ route('admin_owner_purchase') }}">{{get_string('purchases')}}</a></li>
                                    <li><a href="{{ route('admin_user_withdrawals') }}">{{get_string('withdrawals')}}</a></li>
                                    <li><a href="{{ route('admin.faq.index') }}">{{get_string('faq')}}</a></li>
                                </ul>
                            </li>
                            <li class="{{ setActive('admin/request') }}"><a href="{{route('admin_requests')}}">{{get_string('requests')}}</a></li>
                            @if(get_setting('enable_messages', 'user'))
                                <li class="{{ setActive('admin/message') }}"><a href="{{route('admin_message')}}">{{get_string('messages')}}</a></li>
                            @endif
                            <li class="{{ setActive('admin/settings') }}">
                                <a href="#">{{get_string('settings')}}<i class="material-icons tiny">arrow_drop_down</i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('admin_site_settings')}}">{{get_string('site_settings')}}</a></li>
                                    <li><a href="{{route('admin_property_settings')}}">{{get_string('properties_settings')}}</a></li>
                                    <li><a href="{{route('admin_service_settings')}}">{{get_string('services_settings')}}</a></li>
                                    <li><a href="{{route('admin_user_settings')}}">{{get_string('user_settings')}}</a></li>
                                    <li><a href="{{route('admin_owner_settings')}}">{{get_string('owners_settings')}}</a></li>
                                    <li><a href="{{route('admin_design_settings')}}">{{get_string('design_settings')}}</a></li>
                                    <li><a href="{{route('admin_style_settings')}}">{{get_string('style_settings')}}</a></li>
                                    <li><a href="{{route('admin_translator')}}">{{get_string('translator')}}</a></li>
                                    <li><a href="{{route('admin_language_settings')}}">{{get_string('lang_settings')}}</a></li>
                                    <li><a href="{{route('admin_payment_settings')}}">{{get_string('payment_settings')}}</a></li>
                                    <li><a href="{{route('admin_currency')}}">{{get_string('currencies')}}</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col s6 show-on-small">
                        <ul id="slide-out" class="side-nav">
                            <li class="{{ setActive('admin/dashboard') }}"><a href="{{route('admin_dashboard')}}">{{get_string('dashboard')}}</a></li>
                            <li class="{{ setActive('admin/property') }}"><a href="{{route('admin.property.index')}}">{{get_string('property')}}</a></li>
                            @if(get_setting('services_allowed', 'service'))<li class="{{ setActive('admin/service') }}"><a href="{{route('admin.service.index')}}">{{get_string('service')}}</a></li>@endif
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header {{ setActive('admin/taxonomy') }}" href="#">{{get_string('taxonomy')}}<i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li><a href="{{route('admin.taxonomy.category.index')}}">{{get_string('categories')}}</a></li>
                                                <li><a href="{{route('admin.taxonomy.location.index')}}">{{get_string('locations')}}</a></li>
                                                <li><a href="{{route('admin_taxonomy_feature')}}">{{get_string('features')}}</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header {{ setActive('admin/booking') }} {{ setActive('admin/payment') }}" href="#">{{get_string('bookings')}}<i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li><a href="{{route('admin_booking')}}">{{get_string('bookings')}}</a></li>
                                                <li><a href="{{route('admin_payment')}}">{{get_string('payments')}}</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ setActive('admin/review') }}"><a href="{{route('admin_review')}}">{{get_string('property')}}</a></li>
                            <li class="{{ setActive('admin/page') }}"><a href="{{route('admin.page.index')}}">{{get_string('pages')}}</a></li>
                            <li class="{{ setActive('admin/blog') }}"><a href="{{route('admin.blog.index')}}">{{get_string('blog')}}</a></li>
                            <li class="{{ setActive('admin/request') }}"><a href="{{route('admin_requests')}}">{{get_string('requests')}}</a></li>
                             @if(get_setting('enable_messages', 'user'))
                                <li class="{{ setActive('admin/message') }}"><a href="{{route('admin_message')}}">{{get_string('messages')}}</a></li>
                            @endif
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header" href="#">{{get_string('users')}}<i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li class="{{ setActive('admin/user') }}"><a href="{{route('admin_users')}}">{{get_string('users')}}</a></li>
                                                <li><a href="{{route('admin_users_request')}}">{{get_string('requests')}}</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header {{ setActive('admin/owner') }}" href="#">{{get_string('owners')}}<i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li><a href="{{ route('admin_owner') }}">{{get_string('owners')}}</a></li>
                                                <li><a href="{{ route('admin_owner_activity') }}">{{get_string('activities')}}</a></li>
                                                <li><a href="{{ route('admin_owner_purchase') }}">{{get_string('purchases')}}</a></li>
                                                <li><a href="{{ route('admin_user_withdrawals') }}">{{get_string('withdrawals')}}</a></li>
                                                <li><a href="{{ route('admin.faq.index') }}">{{get_string('faq')}}</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header {{ setActive('admin/settings') }}" href="#">{{get_string('settings')}}<i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li><a href="{{route('admin_site_settings')}}">{{get_string('site_settings')}}</a></li>
                                                <li><a href="{{route('admin_property_settings')}}">{{get_string('properties_settings')}}</a></li>
                                                <li><a href="{{route('admin_service_settings')}}">{{get_string('services_settings')}}</a></li>
                                                <li><a href="{{route('admin_user_settings')}}">{{get_string('user_settings')}}</a></li>
                                                <li><a href="{{route('admin_owner_settings')}}">{{get_string('owners_settings')}}</a></li>
                                                <li><a href="{{route('admin_design_settings')}}">{{get_string('design_settings')}}</a></li>
                                                <li><a href="{{route('admin_style_settings')}}">{{get_string('style_settings')}}</a></li>
                                                <li><a href="{{route('admin_translator')}}">{{get_string('translator')}}</a></li>
                                                <li><a href="{{route('admin_language_settings')}}">{{get_string('lang_settings')}}</a></li>
                                                <li><a href="{{route('admin_payment_settings')}}">{{get_string('payment_settings')}}</a></li>
                                                <li><a href="{{route('admin_currency')}}">{{get_string('currencies')}}</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header {{ setActive('admin/my_account') }}" href="#">{{get_string('my_account')}}<i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li class="{{ setActive('admin/my_account') }}"><a href="{{route('admin_my_account')}}">{{get_string('my_account')}}</a></li>
                                                <li><a href="{{route('admin_logout')}}">{{get_string('logout')}}</a></li>
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
                        @if(Auth::user()->admin)
                        <div class="user-img">
                            <img src="{{ Auth::user()->admin->avatar}}" alt="user-img" title="{{Auth::user()->username}}" class="responsive-img">
                        </div>
                        @endif
                        <div class="user-icons">
                                <span class="user-name">{{Auth::user()->username}}</span>
                                <span class="user-role">{{Auth::user()->role->role}}</span>
                                <a href="{{config('app.url')}}" title="{{get_string('my_website')}}"><i class="material-icons tiny color-white">input</i></a>
                                <a href="{{route('admin_my_account')}}" title="{{get_string('my_account')}}"><i class="material-icons tiny color-white">settings</i></a>
                                <a href="{{route('admin_logout')}}" title="{{get_string('logout')}}"><i class="material-icons tiny color-red">power_settings_new</i></a>
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
            <div class="col s12">
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
<script src="{{URL::asset('assets/js/plugins/colorpicker.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins/bootbox.min.js')}}"></script>
<script src="{{URL::asset('assets/js/backend_init.js')}}"></script>

<script type="text/javascript">
    // Mobile Menu
$('.button-collapse').sideNav({
    menuWidth: 300,
    edge: 'right',
    closeOnClick: true,
    draggable: true
});
</script>
    @yield('footer')
</body>
</html>
