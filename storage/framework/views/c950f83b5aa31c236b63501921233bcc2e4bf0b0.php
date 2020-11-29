<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <?php echo $__env->yieldContent('title'); ?>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Exo+2:400,700,900&amp;subset=cyrillic,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&amp;subset=cyrillic,latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/plugins/tether.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/plugins/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/plugins/slick.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/plugins/bootstrap.min.css')); ?>">
    <link href="<?php echo e(URL::asset('assets/css/plugins/toast.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/home_style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/home_layout.css')); ?>">
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
    <?php echo $__env->yieldContent('head'); ?>
    <?php echo $custom_css; ?>

</head>
<body class="home-explore">
<div class="cover"></div>
<div class="wrapper">
    <div class="container-fluid header-container">
        <!-- <div id="top" class="row">
            <div class="col-md-12 col-lg-6">
                <span class="top-text"><?php echo e($static_data['strings']['opt_welcome_text']); ?> <?php if($static_data['user'] ): ?><?php echo e($static_data['user']->username); ?><?php else: ?><?php echo e($static_data['strings']['guest']); ?><?php endif; ?></span>
                <ul class="top-social">
                    <?php if($static_data['design_settings']['show_social_top_bar']): ?>
                        <?php if($static_data['site_settings']['social_facebook']): ?> <li><a href="<?php echo e($static_data['site_settings']['social_facebook']); ?>"><i class="fa fa-facebook"></i></a></li> <?php endif; ?>
                        <?php if($static_data['site_settings']['social_twitter']): ?> <li><a href="<?php echo e($static_data['site_settings']['social_twitter']); ?>"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
                        <?php if($static_data['site_settings']['social_youtube']): ?>  <li><a href="<?php echo e($static_data['site_settings']['social_youtube']); ?>"><i class="fa fa-youtube"></i></a></li><?php endif; ?>
                        <?php if($static_data['site_settings']['social_instagram']): ?>  <li><a href="<?php echo e($static_data['site_settings']['social_instagram']); ?>"><i class="fa fa-instagram"></i></a></li><?php endif; ?>
                        <?php if($static_data['site_settings']['social_google_plus']): ?>  <li><a href="<?php echo e($static_data['site_settings']['social_google_plus']); ?>"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
                        <?php if($static_data['site_settings']['social_pinterest']): ?>  <li><a href="<?php echo e($static_data['site_settings']['social_pinterest']); ?>"><i class="fa fa-pinterest"></i></a></li><?php endif; ?>
                        <?php if($static_data['site_settings']['social_linkedin']): ?>  <li><a href="<?php echo e($static_data['site_settings']['social_linkedin']); ?>"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
                        <?php if($static_data['site_settings']['social_tripadvisor']): ?>  <li><a href="<?php echo e($static_data['site_settings']['social_tripadvisor']); ?>"><i class="fa fa-tripadvisor"></i></a></li><?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-12 col-lg-6">
                <ul class="top-menu">
                    <?php if($static_data['user'] && $static_data['user']->role->id == 2): ?> <li><a href="<?php echo e(route('owner_dashboard')); ?>"><i class="fa fa-tachometer"></i> <?php echo e($static_data['strings']['dashboard']); ?></a></li> <?php endif; ?>
                    <?php if(!$static_data['user']): ?><li class="<?php echo e(setActive('register')); ?>"><a href=<?php echo e(route('register')); ?>><i class="fa fa-plus-circle"></i> <?php echo e($static_data['strings']['register']); ?></a></li>
                    <?php else: ?><li><a href="<?php echo e(route('logout')); ?>"><i class="fa fa-power-off red-color"></i> <?php echo e($static_data['strings']['logout']); ?></a></li><?php endif; ?>
                    <?php if($static_data['user'] && $static_data['user']->role->id == 3): ?><li class="<?php echo e(setActive('my-account')); ?>"><a href="<?php echo e(route('my_account')); ?>"><i class="fa fa-user"></i> <?php echo e($static_data['strings']['my_account']); ?></a></li><?php endif; ?>
                    <?php if(count($static_data['languages']) > 1): ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" id="language-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-language"></i>
                                <?php if(Session::has('language')): ?>
                                    <?php $__currentLoopData = $static_data['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php if(Session::get('language')): ?>
                                            <?php if(strpos(Session::get('language'), $language->code) !== false): ?>
                                                <?php echo e($language->language); ?>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                <?php else: ?>
                                    <?php echo e($default_language->language); ?>

                                <?php endif; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="language-dropdown">
                                <?php $__currentLoopData = $static_data['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <a class="dropdown-item" href="#"><?php echo e($language->language); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div> -->
        <div id="header-phantom" class="hidden"></div>
        <div id="header" class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-3">
                        <div id="logo">
                            <a href="<?php echo e(url('/')); ?>"><img class="img-fluid" src="<?php echo e(URL::asset('assets/images/home/logo.png')); ?>"/></a>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-9">
                        <ul class="main-menu">
                            <li><a href="<?php echo e(route('home')); ?>"><?php echo e($static_data['strings']['home']); ?></a></li>
                            <?php if(get_setting('services_allowed', 'service')): ?><li class="<?php echo e(setActive('explore')); ?>">
                                <a class="dropdown-toggle" id="explore-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($static_data['strings']['explore']); ?></a>
                                <div class="dropdown-menu" aria-labelledby="explore-dropdown">
                                    <a href="<?php echo e(route('explore_properties')); ?>"><div class="dropdown-item"><?php echo e($static_data['strings']['properties']); ?></div></a>
                                    <a href="<?php echo e(route('explore_services')); ?>"><div class="dropdown-item"><?php echo e($static_data['strings']['services']); ?></div></a>
                                </div>
                            </li>
                            <?php else: ?>
                                <li class="<?php echo e(setActive('explore')); ?>"><a href="<?php echo e(route('explore_properties')); ?>"><?php echo e($static_data['strings']['properties']); ?></a></li>
                            <?php endif; ?>
                            <li>
                                <a class="dropdown-toggle" id="properties-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($static_data['strings']['locations']); ?></a>
                                <div class="dropdown-menu" aria-labelledby="properties-dropdown">
                                    <?php $__currentLoopData = $static_data['locations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <a href="<?php echo e(url('/location').'/'.$location->alias); ?>"><div class="dropdown-item"><?php echo e($location->contentload->location); ?></div></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-toggle" id="categories-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($static_data['strings']['categories']); ?></a>
                                <div class="dropdown-menu" aria-labelledby="categories-dropdown">
                                    <?php $__currentLoopData = $static_data['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <a href="<?php echo e(url('/category').'/'.$category->alias); ?>"><div class="dropdown-item"><?php echo e($category->contentload->name); ?></div></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </div>
                            </li>
                            <!-- <li><a href="#"><?php echo e($static_data['strings']['owners']); ?></a></li> -->
                            <?php if($static_data['site_settings']['allow_blog']): ?> <li class="<?php echo e(setActive('blog')); ?>"><a href="<?php echo e(route('blog')); ?>"><?php echo e($static_data['strings']['blog']); ?></a></li><?php endif; ?>
                            <li class="<?php echo e(setActive('contact')); ?>"><a href="<?php echo e(route('contact')); ?>"><?php echo e($static_data['strings']['contact']); ?></a></li>
                            <?php if(!$static_data['user']): ?><li class="<?php echo e(setActive('login')); ?>"><a href="<?php echo e(route('login')); ?>" class="white-button"><?php echo e($static_data['strings']['sign_in']); ?></a></li><?php endif; ?>
                            <?php if($static_data['user'] && $static_data['user']->role->id == 3 && $owner_request): ?><li><a class="white-button request-upgrade" data-toggle="modal" data-target="#upgrade-confirm-modal" ><?php echo e($static_data['strings']['add_your_property']); ?></a></li><?php endif; ?>
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
                <li class="active"><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> <?php echo e($static_data['strings']['home']); ?></a></li>
                <?php if(get_setting('services_allowed', 'service')): ?><li>
                    <a class="dropdown-toggle" id="explore-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-binoculars"></i> <?php echo e($static_data['strings']['explore']); ?></a>
                    <div class="dropdown-menu" aria-labelledby="explore-dropdown">
                        <a href="<?php echo e(route('explore_properties')); ?>"><div class="dropdown-item"><?php echo e($static_data['strings']['properties']); ?></div></a>
                        <a href="<?php echo e(route('explore_services')); ?>"><div class="dropdown-item"><?php echo e($static_data['strings']['services']); ?></div></a>
                    </div>
                </li>
                <?php else: ?>
                    <li><a href="<?php echo e(route('explore_properties')); ?>"><i class="fa fa-building"></i> <?php echo e($static_data['strings']['properties']); ?></a></li>
                <?php endif; ?>
                <li>
                    <a class="dropdown-toggle" id="properties-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-map-o"></i> <?php echo e($static_data['strings']['locations']); ?></a>
                    <div class="dropdown-menu" aria-labelledby="properties-dropdown">
                        <?php $__currentLoopData = $static_data['locations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <a href="<?php echo e(url('/location').'/'.$location->alias); ?>"><div class="dropdown-item"><?php echo e($location->contentload->location); ?></div></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </div>
                </li>
                <li>
                    <a class="dropdown-toggle" id="categories-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cube"></i> <?php echo e($static_data['strings']['categories']); ?></a>
                    <div class="dropdown-menu" aria-labelledby="categories-dropdown">
                        <?php $__currentLoopData = $static_data['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <a href="<?php echo e(url('/category').'/'.$category->alias); ?>"><div class="dropdown-item"><?php echo e($category->contentload->name); ?></div></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </div>
                </li>
            <!-- <li><a href="#"><?php echo e($static_data['strings']['owners']); ?></a></li> -->
                <?php if($static_data['site_settings']['allow_blog']): ?> <li class="<?php echo e(setActive('blog')); ?>"><a href="<?php echo e(route('blog')); ?>"><i class="fa fa-newspaper-o"></i> <?php echo e($static_data['strings']['blog']); ?></a></li><?php endif; ?>
                <li class="<?php echo e(setActive('contact')); ?>"><a href="<?php echo e(route('contact')); ?>"><i class="fa fa-envelope"></i> <?php echo e($static_data['strings']['contact']); ?></a></li>
                <?php if(!$static_data['user']): ?><li class="<?php echo e(setActive('login')); ?>"><a href="<?php echo e(route('login')); ?>"> <i class="fa fa-user"></i> <?php echo e($static_data['strings']['sign_in']); ?></a></li><?php endif; ?>
                <?php if($static_data['user'] && $static_data['user']->role->id == 3 && $owner_request): ?><li><a class="request-upgrade" data-toggle="modal" data-target="#upgrade-confirm-modal" ><?php echo e($static_data['strings']['add_your_property']); ?></a></li><?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid main-content">
        <div class="row">
            <div id="half-map" class="col-sm-12 col-md-5">
                <div id="google-map"></div>
            </div>
            <div id="half-map-content" class="offset-md-5 col-sm-12 col-md-7 float-right">
                <div class="half-map-inner">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid footer-container">
    <div class="row copyright-row">
        <div class="col-sm-6 copyright">
            <p><?php echo e($static_data['strings']['copyright'] . date('Y') . ' ' . $static_data['strings']['rights_reserved'] . get_setting('site_name', 'site')); ?></p>
        </div>
        <div class="col-sm-6 powered-by">
            <p><?php echo $static_data['strings']['powered_by']; ?></p>
        </div>
    </div>
</div>
</div>
<script src="<?php echo e(URL::asset('assets/js/plugins/jquery.min.js')); ?>"></script>
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
<script src="<?php echo e(URL::asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/home_init.js')); ?>"></script>
<?php echo $__env->yieldContent('footer'); ?>
<?php echo csrf_field(); ?>

<?php if($static_data['user'] && $owner_request): ?>
<div class="modal fade" id="upgrade-confirm-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e($static_data['strings']['confirm_action']); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo e($static_data['strings']['upgrade_request_confirm']); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="primary-button" data-dismiss="modal"><?php echo e($static_data['strings']['close']); ?></button>
                <a href="#" data-id="<?php echo e($static_data['user']->id); ?>" class="primary-button confirm-request" data-dismiss="modal"><?php echo e($static_data['strings']['request']); ?></a>
            </div>
            <script type="text/javascript">
                $(document).ready(function(){
                    $('.confirm-request').click(function(e){
                        e.preventDefault();
                        var id = $(this).data('id'),
                            token = $('[name="_token"]').val();
                        $.ajax({
                            url: '<?php echo e(url('/user-request')); ?>',
                            type: 'post',
                            data: {_token: token, id: id},
                               success: function(){
                               toastr.success('<?php echo e($static_data['strings']['text_for_request']); ?>');
                                                            setTimeout(function(){location.reload();}, 1200);

                        }
                    });
                });
                });
            </script>
        </div>
    </div>
</div>
<?php endif; ?>
</body>
</html>