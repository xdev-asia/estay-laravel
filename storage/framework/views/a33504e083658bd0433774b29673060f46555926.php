<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?php echo e($static_data['site_settings']['site_name']); ?></title>
    <meta charset="UTF-8">
    <meta name="title" content="<?php echo e($static_data['site_settings']['site_name']); ?>">
    <meta name="description" content="<?php echo e($static_data['site_settings']['site_description']); ?>">
    <meta name="keywords" content="<?php echo e($static_data['site_settings']['site_keywords']); ?>">
    <meta name="author" content="<?php echo e($static_data['site_settings']['site_name']); ?>">
    <meta property="og:title" content="<?php echo e($static_data['site_settings']['site_name']); ?>" />
    <meta property="og:image" content="<?php echo e(URL::asset('//assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?>" />
    

    <link rel="stylesheet" href="<?php echo e(URL::asset('/assets/estay/css/normalize.css')); ?>" >
    <link rel="stylesheet" href="<?php echo e(URL::asset('/assets/estay/css/bootstrap.min.css')); ?>" >
    <link rel="stylesheet" href="<?php echo e(URL::asset('/assets/estay/css/daterangepicker.css')); ?>" >
    <link rel="stylesheet" href="<?php echo e(URL::asset('/assets/estay/css/slick.css')); ?>" >
    <link rel="stylesheet" href="<?php echo e(URL::asset('/assets/estay/css/main.css')); ?>" >

  <meta name="theme-color" content="#fafafa">

    <?php if($static_data['site_settings']['google_analytics']): ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', '<?php echo e($static_data['site_settings']['google_analytics']); ?>', 'auto');
            ga('send', 'pageview');

        </script>
    <?php endif; ?>
    <?php echo $custom_css; ?>

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
              <a class="nav-link" href="<?php echo e($static_data['site_settings']['social_facebook']); ?>">
                <img class="icon hover-translate-y-n3" src="/assets/estay/images/icon/twitter.png" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e($static_data['site_settings']['social_twitter']); ?>">
                <img class="icon hover-translate-y-n3" src="/assets/estay/images/icon/facebook.png" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e($static_data['site_settings']['social_instagram']); ?>">
                <img class="icon hover-translate-y-n3" src="/assets/estay/images/icon/instagram.png" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" hhref="<?php echo e($static_data['site_settings']['social_youtube']); ?>">
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
                                    <?php if(Session::has('language')): ?>
                                    <?php $__currentLoopData = $static_data['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php if(Session::get('language')): ?>
                                            <?php if(strpos(Session::get('language'), $language->code) !== false): ?>
                                                <img class="icon hover-translate-y-n3" src="<?php echo e($language->flag); ?>" /> <?php echo e($language->language); ?>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php else: ?>
                                        <?php echo e($default_language->language); ?>

                                    <?php endif; ?>
                                </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="language-dropdown">
                                        <?php $__currentLoopData = $static_data['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <a class="dropdown-item language-switcher" data-code="<?php echo e($language->code); ?>" href="#"><img class="icon hover-translate-y-n3" src="<?php echo e($language->flag); ?>" /> <?php echo e($language->language); ?></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </div>
                                </li>
            <li class="nav-item border-left">
              <a href="<?php echo e(route('login')); ?>" class="nav-link text-primary-1 text-uppercase font-weight-bold" href="#">
               <?php echo e($static_data['strings']['sign_in']); ?>

              </a>
            </li>
            <li class="nav-item border-left">
              <a href="<?php echo e(route('register')); ?>" class="m-2 btn btn-primary-2 hover-btn text-uppercase font-weight-bold">
               <?php echo e($static_data['strings']['register']); ?>

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
        <?php echo $__env->yieldContent('content'); ?>
         <script src="<?php echo e(URL::asset('assets/estay/js/vendor/modernizr-3.8.0.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/estay/js/vendor/jquery-3.4.1.min.js')); ?>"></script>

<script src="<?php echo e(URL::asset('assets/js/plugins/tether.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/plugins/slick.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/plugins/slidereveal.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/plugins/toast.min.js')); ?>"></script>
<script type="text/javascript">
    window.paceOptions = {
        ajax: false,
        restartOnRequestAfter: false,
    };
</script>

<script src="<?php echo e(URL::asset('assets/estay/js/vendor/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/estay/js/vendor/moment.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/estay/js/vendor/daterangepicker.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/estay/js/vendor/js/vendor/slick.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/estay/js/plugins.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/estay/js/main.js')); ?>"></script>


</body>
</html>