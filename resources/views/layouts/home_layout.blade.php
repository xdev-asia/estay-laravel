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
    <meta property="og:image" content="{{URL::asset('//assets/images/home/').'/'.$static_data['design_settings']['slider_background']}}" />
    {{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Exo+2:400,700,900&amp;subset=cyrillic,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&amp;subset=cyrillic,latin-ext" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{ URL::asset('/assets/estay/css/normalize.css') }}" >
    <link rel="stylesheet" href="{{ URL::asset('/assets/estay/css/bootstrap.min.css') }}" >
    <link rel="stylesheet" href="{{ URL::asset('/assets/estay/css/daterangepicker.css') }}" >
    <link rel="stylesheet" href="{{ URL::asset('/assets/estay/css/slick.css') }}" >
    <link rel="stylesheet" href="{{ URL::asset('/assets/estay/css/main.css') }}" >

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
    <header>
    <!-- Navigation -->
    <nav class="navbar navbar-home navbar-expand-lg bg-white fixed-top">
      <div class="w-100 px-5">
        <a class="navbar-brand position-absolute" href="#">
          <img class="logo hover-translate-y-n3" src="/assets/estay/images/logo/footer-logo.png" alt="estay logo">
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
              <a class="nav-link" href="{{ $static_data['site_settings']['social_facebook'] }}">
                <img class="icon hover-translate-y-n3" src="/assets/estay/images/icon/twitter.png" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{$static_data['site_settings']['social_twitter']}}">
                <img class="icon hover-translate-y-n3" src="/assets/estay/images/icon/facebook.png" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{$static_data['site_settings']['social_instagram']}}">
                <img class="icon hover-translate-y-n3" src="/assets/estay/images/icon/instagram.png" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" hhref="{{$static_data['site_settings']['social_youtube']}}">
                <img class="icon hover-translate-y-n3" src="/assets/estay/images/icon/youtube.png" />
              </a>
            </li>
          </ul>

          <div class="dropdown ml-auto">
            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Giao diện khác
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="/">Giao diện 1</a>
              <a class="dropdown-item" href="/explore/properties">Giao diện 2</a>
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
              <img class="logo hover-translate-y-n3 shadow-primary" src="/assets/estay/images/icon/menu.png"/ alt="estay">
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
        @yield('content')
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
<script src="{{URL::asset('assets/estay/js/plugins.js')}}"></script>
<script src="{{URL::asset('assets/estay/js/main.js')}}"></script>


</body>
</html>