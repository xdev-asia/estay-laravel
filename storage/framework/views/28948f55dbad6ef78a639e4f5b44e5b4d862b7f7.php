<?php $__env->startSection('title', trans('installer_messages.final.title')); ?>
<?php $__env->startSection('container'); ?>
        <p class="paragraph" style="text-align: center;margin-bottom: 20px;line-height: 20px;">You have installed Booksi but in order to use it you need to activate it first!</p>
    <div class="buttons">
        <a href="http://activate.booksicms.com/" target="_blank" class="button">Activate</a>
        <a href="<?php echo e(url('/')); ?>" class="button"><?php echo e(trans('installer_messages.final.exit')); ?></a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>