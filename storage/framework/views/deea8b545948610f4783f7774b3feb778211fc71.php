
<?php $__env->startSection('title'); ?>
    <title><?php echo e($static_data['strings']['page'] .' - '. $page->contentload->title); ?></title>
    <meta name="title" content="<?php echo e($static_data['strings']['page'] .' - '. $page->contentload->title); ?>">
    <meta name="description" content="<?php echo e(strip_tags(str_limit($page->contentload->content, 200))); ?>">
    <meta name="keywords" content="<?php echo e($static_data['site_settings']['site_keywords']); ?>">
    <meta name="author" content="<?php echo e($static_data['site_settings']['site_name']); ?>">
    <meta property="og:title" content="<?php echo e($static_data['strings']['page'] .' - '. $page->contentload->title); ?>" />
    <meta property="og:image" content="<?php echo e(URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?>" />
    <meta property="og:description" content="<?php echo e(strip_tags(str_limit($page->contentload->content, 200))); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bg'); ?>
    <?php echo e(URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row marginalized">
        <div class="col-sm-12">
            <h1 class="section-title-dark"><?php echo e($page->contentload->title); ?></h1>
            <div class="row">
                <div class="col-sm-12"><?php echo $page->contentload->content; ?></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home_layout', ['static_data', $static_data], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>