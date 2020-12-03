<?php $__env->startSection('title'); ?>
    <title>404! - <?php echo e($static_data['site_settings']['site_name']); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bg'); ?>
        <?php echo e(URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row  marginalized">
        <div class="col-sm-12">
            <h1 class="section-title-dark">404! <br><?php echo e($static_data['strings']['you_broke_internet']); ?></h1>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home_layout', ['static_data', $static_data], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>