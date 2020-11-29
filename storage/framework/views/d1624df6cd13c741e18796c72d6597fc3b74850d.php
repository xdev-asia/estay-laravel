<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

    <?php echo $__env->yieldContent('title'); ?>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,500,600,700&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/plugins/backend_materialize.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/plugins/jquery-ui.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/plugins/toast.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/plugins/summernote.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/plugins/dropzone.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/plugins/colorpicker.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/backend_style.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('style'); ?>

</head>
<body class="mtop20">
<div class="cover"></div>
    <div class="container header-container z-depth-1">
        <div class="row no-pad-bot mbot0">
            <nav>
                <div id="header-left" class="col l10 m12 s12 header-col">
                    <div id="logo" class="col s6 m6">
                        <p class="date-text"><?php echo e(date('l, jS \of F Y')); ?></p>
                        <a href="<?php echo e(route('admin_dashboard')); ?>" class="brand-logo"><?php echo e(get_string('booksi')); ?><span><?php echo e(get_string('cms')); ?></span></a>
                    </div>
                    <div id="navigation">
                        <ul class="hide-on-med-and-down clearfix">
                            <li class="<?php echo e(setActive('admin/dashboard')); ?>"><a href="<?php echo e(route('admin_dashboard')); ?>"><?php echo e(get_string('dashboard')); ?></a></li>
                            <li class="<?php echo e(setActive('admin/property')); ?>"><a href="<?php echo e(route('admin.property.index')); ?>"><?php echo e(get_string('properties')); ?></a></li>
                            <?php if(get_setting('services_allowed', 'service')): ?><li class="<?php echo e(setActive('admin/service')); ?>"><a href="<?php echo e(route('admin.service.index')); ?>"><?php echo e(get_string('services')); ?></a></li><?php endif; ?>
                            <li class="<?php echo e(setActive('admin/taxonomy')); ?>">
                                <a href="#"><?php echo e(get_string('taxonomy')); ?><i class="material-icons tiny">arrow_drop_down</i></a>
                                    <ul class="sub-menu">
                                    <li><a href="<?php echo e(route('admin.taxonomy.category.index')); ?>"><?php echo e(get_string('categories')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin.taxonomy.location.index')); ?>"><?php echo e(get_string('locations')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_taxonomy_feature')); ?>"><?php echo e(get_string('features')); ?></a></li>
                                </ul>
                            </li>
                            <li  class="<?php echo e(setActive('admin/booking')); ?> <?php echo e(setActive('admin/payment')); ?>">
                                <a href="#"><?php echo e(get_string('bookings')); ?><i class="material-icons tiny">arrow_drop_down</i></a>
                                <ul class="sub-menu">
                                    <li><a href="<?php echo e(route('admin_booking')); ?>"><?php echo e(get_string('bookings')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_payment')); ?>"><?php echo e(get_string('payments')); ?></a></li>
                                </ul>
                            </li>
                            <li  class="<?php echo e(setActive('admin/review')); ?>"><a href="<?php echo e(route('admin_review')); ?>"><?php echo e(get_string('reviews')); ?></a></li>
                            <li class="<?php echo e(setActive('admin/page')); ?>"><a href="<?php echo e(route('admin.page.index')); ?>"><?php echo e(get_string('pages')); ?></a></li>
                            <li class="<?php echo e(setActive('admin/blog')); ?>"><a href="<?php echo e(route('admin.blog.index')); ?>"><?php echo e(get_string('blog')); ?></a></li>
                            <li class="<?php echo e(setActive('admin/user')); ?>">
                                <a href="#"><?php echo e(get_string('users')); ?><i class="material-icons tiny">arrow_drop_down</i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="<?php echo e(route('admin_users')); ?>"><?php echo e(get_string('users')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_users_request')); ?>"><?php echo e(get_string('requests')); ?></a></li>
                                </ul>
                            </li>
                            <li class="<?php echo e(setActive('admin/owner')); ?> <?php echo e(setActive('admin/faq')); ?>">
                                <a href="#"><?php echo e(get_string('owners')); ?><i class="material-icons tiny">arrow_drop_down</i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="<?php echo e(route('admin_owner')); ?>"><?php echo e(get_string('owners')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_owner_activity')); ?>"><?php echo e(get_string('activities')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_owner_purchase')); ?>"><?php echo e(get_string('purchases')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_user_withdrawals')); ?>"><?php echo e(get_string('withdrawals')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin.faq.index')); ?>"><?php echo e(get_string('faq')); ?></a></li>
                                </ul>
                            </li>
                            <li class="<?php echo e(setActive('admin/request')); ?>"><a href="<?php echo e(route('admin_requests')); ?>"><?php echo e(get_string('requests')); ?></a></li>
                            <?php if(get_setting('enable_messages', 'user')): ?>
                                <li class="<?php echo e(setActive('admin/message')); ?>"><a href="<?php echo e(route('admin_message')); ?>"><?php echo e(get_string('messages')); ?></a></li>
                            <?php endif; ?>
                            <li class="<?php echo e(setActive('admin/settings')); ?>">
                                <a href="#"><?php echo e(get_string('settings')); ?><i class="material-icons tiny">arrow_drop_down</i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="<?php echo e(route('admin_site_settings')); ?>"><?php echo e(get_string('site_settings')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_property_settings')); ?>"><?php echo e(get_string('properties_settings')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_service_settings')); ?>"><?php echo e(get_string('services_settings')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_user_settings')); ?>"><?php echo e(get_string('user_settings')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_owner_settings')); ?>"><?php echo e(get_string('owners_settings')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_design_settings')); ?>"><?php echo e(get_string('design_settings')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_style_settings')); ?>"><?php echo e(get_string('style_settings')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_translator')); ?>"><?php echo e(get_string('translator')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_language_settings')); ?>"><?php echo e(get_string('lang_settings')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_payment_settings')); ?>"><?php echo e(get_string('payment_settings')); ?></a></li>
                                    <li><a href="<?php echo e(route('admin_currency')); ?>"><?php echo e(get_string('currencies')); ?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col s6 show-on-small">
                        <ul id="slide-out" class="side-nav">
                            <li class="<?php echo e(setActive('admin/dashboard')); ?>"><a href="<?php echo e(route('admin_dashboard')); ?>"><?php echo e(get_string('dashboard')); ?></a></li>
                            <li class="<?php echo e(setActive('admin/property')); ?>"><a href="<?php echo e(route('admin.property.index')); ?>"><?php echo e(get_string('property')); ?></a></li>
                            <?php if(get_setting('services_allowed', 'service')): ?><li class="<?php echo e(setActive('admin/service')); ?>"><a href="<?php echo e(route('admin.service.index')); ?>"><?php echo e(get_string('service')); ?></a></li><?php endif; ?>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header <?php echo e(setActive('admin/taxonomy')); ?>" href="#"><?php echo e(get_string('taxonomy')); ?><i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li><a href="<?php echo e(route('admin.taxonomy.category.index')); ?>"><?php echo e(get_string('categories')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin.taxonomy.location.index')); ?>"><?php echo e(get_string('locations')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_taxonomy_feature')); ?>"><?php echo e(get_string('features')); ?></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header <?php echo e(setActive('admin/booking')); ?> <?php echo e(setActive('admin/payment')); ?>" href="#"><?php echo e(get_string('bookings')); ?><i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li><a href="<?php echo e(route('admin_booking')); ?>"><?php echo e(get_string('bookings')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_payment')); ?>"><?php echo e(get_string('payments')); ?></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?php echo e(setActive('admin/review')); ?>"><a href="<?php echo e(route('admin_review')); ?>"><?php echo e(get_string('property')); ?></a></li>
                            <li class="<?php echo e(setActive('admin/page')); ?>"><a href="<?php echo e(route('admin.page.index')); ?>"><?php echo e(get_string('pages')); ?></a></li>
                            <li class="<?php echo e(setActive('admin/blog')); ?>"><a href="<?php echo e(route('admin.blog.index')); ?>"><?php echo e(get_string('blog')); ?></a></li>
                            <li class="<?php echo e(setActive('admin/request')); ?>"><a href="<?php echo e(route('admin_requests')); ?>"><?php echo e(get_string('requests')); ?></a></li>
                             <?php if(get_setting('enable_messages', 'user')): ?>
                                <li class="<?php echo e(setActive('admin/message')); ?>"><a href="<?php echo e(route('admin_message')); ?>"><?php echo e(get_string('messages')); ?></a></li>
                            <?php endif; ?>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header" href="#"><?php echo e(get_string('users')); ?><i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li class="<?php echo e(setActive('admin/user')); ?>"><a href="<?php echo e(route('admin_users')); ?>"><?php echo e(get_string('users')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_users_request')); ?>"><?php echo e(get_string('requests')); ?></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header <?php echo e(setActive('admin/owner')); ?>" href="#"><?php echo e(get_string('owners')); ?><i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li><a href="<?php echo e(route('admin_owner')); ?>"><?php echo e(get_string('owners')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_owner_activity')); ?>"><?php echo e(get_string('activities')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_owner_purchase')); ?>"><?php echo e(get_string('purchases')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_user_withdrawals')); ?>"><?php echo e(get_string('withdrawals')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin.faq.index')); ?>"><?php echo e(get_string('faq')); ?></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header <?php echo e(setActive('admin/settings')); ?>" href="#"><?php echo e(get_string('settings')); ?><i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li><a href="<?php echo e(route('admin_site_settings')); ?>"><?php echo e(get_string('site_settings')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_property_settings')); ?>"><?php echo e(get_string('properties_settings')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_service_settings')); ?>"><?php echo e(get_string('services_settings')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_user_settings')); ?>"><?php echo e(get_string('user_settings')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_owner_settings')); ?>"><?php echo e(get_string('owners_settings')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_design_settings')); ?>"><?php echo e(get_string('design_settings')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_style_settings')); ?>"><?php echo e(get_string('style_settings')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_translator')); ?>"><?php echo e(get_string('translator')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_language_settings')); ?>"><?php echo e(get_string('lang_settings')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_payment_settings')); ?>"><?php echo e(get_string('payment_settings')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_currency')); ?>"><?php echo e(get_string('currencies')); ?></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li>
                                        <a class="collapsible-header <?php echo e(setActive('admin/my_account')); ?>" href="#"><?php echo e(get_string('my_account')); ?><i class="material-icons tiny">arrow_drop_down</i></a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li class="<?php echo e(setActive('admin/my_account')); ?>"><a href="<?php echo e(route('admin_my_account')); ?>"><?php echo e(get_string('my_account')); ?></a></li>
                                                <li><a href="<?php echo e(route('admin_logout')); ?>"><?php echo e(get_string('logout')); ?></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#"><?php echo e(get_string('my_website')); ?></a></li>
                        </ul>
                        <a href="#" data-activates="slide-out" class="button-collapse menu-button"><i class="material-icons">menu</i></a>
                    </div>
                </div>
                <div id="header-right" class="col s2 header-col hide-on-med-and-down">
                    <div class="user-box">
                        <?php if(Auth::user()->admin): ?>
                        <div class="user-img">
                            <img src="<?php echo e(Auth::user()->admin->avatar); ?>" alt="user-img" title="<?php echo e(Auth::user()->username); ?>" class="responsive-img">
                        </div>
                        <?php endif; ?>
                        <div class="user-icons">
                                <span class="user-name"><?php echo e(Auth::user()->username); ?></span>
                                <span class="user-role"><?php echo e(Auth::user()->role->role); ?></span>
                                <a href="<?php echo e(config('app.url')); ?>" title="<?php echo e(get_string('my_website')); ?>"><i class="material-icons tiny color-white">input</i></a>
                                <a href="<?php echo e(route('admin_my_account')); ?>" title="<?php echo e(get_string('my_account')); ?>"><i class="material-icons tiny color-white">settings</i></a>
                                <a href="<?php echo e(route('admin_logout')); ?>" title="<?php echo e(get_string('logout')); ?>"><i class="material-icons tiny color-red">power_settings_new</i></a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="container home-container z-depth-1">
        <div class="row mbot0">
            <div class="col s12">
    <?php echo $__env->yieldContent('page_title'); ?>
            </div>
    <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <div class="container footer-container">
        <div class="row">
            <div class="col s12">
                <p> <?php echo e(get_string('copyright') . date('Y') . ' ' . get_string('rights_reserved') . get_setting('site_name', 'site')); ?> | <?php echo get_string('powered_by'); ?></p>
            </div>
        </div>
    </div>
<!--  Scripts-->
<script src="<?php echo e(URL::asset('assets/js/plugins/jquery.min.js')); ?>"></script>
<script type="text/javascript">
    window.paceOptions = {
        ajax: false,
        restartOnRequestAfter: false,
    };
</script>
<script src="<?php echo e(URL::asset('assets/js/plugins/backend_bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/plugins/backend_plugins.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/plugins/waypoints.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/plugins/waves.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/plugins/toast.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/plugins/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/plugins/counter.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/plugins/summernote.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/plugins/dropzone.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/plugins/colorpicker.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/plugins/bootbox.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/backend_init.js')); ?>"></script>

<script type="text/javascript">
    // Mobile Menu
$('.button-collapse').sideNav({
    menuWidth: 300,
    edge: 'right',
    closeOnClick: true,
    draggable: true
});
</script>
    <?php echo $__env->yieldContent('footer'); ?>
</body>
</html>
