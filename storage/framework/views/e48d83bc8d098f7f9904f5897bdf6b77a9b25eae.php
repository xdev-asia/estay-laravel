<?php $__env->startSection('title'); ?>
    <title><?php echo e($static_data['strings']['login']); ?> - <?php echo e($static_data['site_settings']['site_name']); ?></title>
    <meta charset="UTF-8">
    <meta name="title" content="<?php echo e($static_data['site_settings']['site_name']); ?>">
    <meta name="description" content="<?php echo e($static_data['site_settings']['site_description']); ?>">
    <meta name="keywords" content="<?php echo e($static_data['site_settings']['site_keywords']); ?>">
    <meta name="author" content="<?php echo e($static_data['site_settings']['site_name']); ?>">
    <meta property="og:title" content="<?php echo e($static_data['site_settings']['site_name']); ?>" />
    <meta property="og:image" content="<?php echo e(URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bg'); ?>
    <?php echo e(URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row  marginalized justify-content-center">
        <div class="col-sm-12">
            <h1 class="section-title-dark"><?php echo e($static_data['strings']['login']); ?></h1>
            <?php if(Session::has('activationSuccess')): ?>
                <p class="section-subtitle-light text-centered green-color"><strong><?php echo e($static_data['strings']['account_successfully_activated']); ?></strong></p>
            <?php endif; ?>
            <?php if(Session::has('activationStatus')): ?>
                <p class="section-subtitle-light text-centered green-color"><strong><?php echo e($static_data['strings']['activation_mail_sent']); ?></strong></p>
            <?php endif; ?>
            <?php if(Session::has('activationWarning')): ?>
                <p class="section-subtitle-light text-centered red-color"><strong><?php echo e($static_data['strings']['please_activate_account_first']); ?></strong></p>
            <?php endif; ?>
        </div>
        <div class="col-sm-12 col-md-8 input-style user-action-form">
            <?php echo Form::open(['method' => 'post', 'url' => route('login')]); ?>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group  <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                        <div class="input-group">
                            <span class="fa fa-envelope input-group-addon"></span>
                            <?php echo e(Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => $static_data['strings']['email_address']])); ?>

                        </div>
                        <?php if($errors->has('email')): ?>
                            <span class="wrong-error">* <?php echo e($errors->first('email')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group  <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
                        <div class="input-group">
                            <span class="fa fa-key input-group-addon"></span>
                            <?php echo e(Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => $static_data['strings']['password']])); ?>

                        </div>
                        <?php if($errors->has('password')): ?>
                            <span class="wrong-error">* <?php echo e($errors->first('password')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if(get_setting('login_with_facebook', 'user')): ?>
                <div class="col-md-6 col-sm-12  social-btn">
                    <a href="<?php echo e(route('facebook_redirect')); ?>" class="facebook-btn"><i class="fa fa-facebook"></i> <?php echo e($static_data['strings']['login_with_facebook']); ?></a>
                </div>
                <?php endif; ?>
                <?php if(get_setting('login_with_google_plus', 'user')): ?>
                <div class="col-md-6 col-sm-12  social-btn">
                    <a href="<?php echo e(route('google_redirect')); ?>" class="google-btn"><i class="fa fa-google-plus"></i> <?php echo e($static_data['strings']['login_with_google']); ?></a>
                </div>
                <?php endif; ?>
                <div class="col-sm-12 text-centered clearfix">
                    <button type="submit" name="action" class="primary-button"><?php echo e($static_data['strings']['submit']); ?></button>
                </div>
                <div class="col-sm-12 text-centered mtop20">
                    <a href="<?php echo e(route('reset_password')); ?>"> <?php echo e($static_data['strings']['forgot_password']); ?> |</a>
                    <a href="<?php echo e(route('resend_activation_mail')); ?>"> <?php echo e($static_data['strings']['resend_activation_mail']); ?> </a>
                </div>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home_layout', ['static_data', $static_data], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>