

<?php $__env->startSection('title'); ?>
    <title><?php echo e(get_string('purchases') . ' - ' . get_setting('site_name', 'site')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('page_title'); ?>
    <h3 class="page-title mbot10"><?php echo e(get_string('purchases')); ?></h3>
<?php $__env->stopSection(); ?>
<div class="col s12">
    <?php if($purchases->count()): ?>
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th><?php echo e(get_string('username')); ?></th>
                    <th><?php echo e(get_string('points_purchased')); ?></th>
                    <th><?php echo e(get_string('price')); ?></th>
                    <th><?php echo e(get_string('transaction')); ?></th>
                    <th><?php echo e(get_string('payment_method')); ?></th>
                    <th><?php echo e(get_string('date_of_purchase')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr class="<?php echo e($purchase->completed ? 'disabled-style' : ''); ?>">
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="<?php echo e($purchase->id); ?>" />
                            <label for="<?php echo e($purchase->id); ?>"></label>
                        </td>
                        <td><?php if($purchase->user): ?><?php echo e($purchase->user->username); ?><?php endif; ?></td>
                        <td><?php echo e($purchase->points); ?></td>
                        <td><?php echo e($purchase->price); ?> <?php echo e($currency); ?></td>
                        <td><?php echo e($purchase->transaction); ?></td>
                        <td><?php echo e($purchase->method); ?></td>
                        <td><?php echo e(date(get_setting('dateformat', 'site'), strtotime($purchase->created_at))); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php echo e($purchases->links()); ?>

    <?php else: ?>
        <strong class="center-align"><?php echo e(get_string('no_results')); ?></strong>
    <?php endif; ?>
</div>
<input type="hidden" class="token" value="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script>
        $(document).ready(function(){
            $('.confirm-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var selector = $(this).parents('tr');
                var status = $('.purchase-status', selector);
                var token = $('.token').val();
                if(!selector.hasClass('disabled-style')) {
                    bootbox.confirm({
                        title: '<?php echo e(get_string('confirm_action')); ?>',
                        message: '<?php echo e(get_string('upgrade_confirm')); ?>',
                        onEscape: true,
                        backdrop: true,
                        buttons: {
                            cancel: {
                                label: '<?php echo e(get_string('no')); ?>',
                                className: 'btn waves-effect'
                            },
                            confirm: {
                                label: '<?php echo e(get_string('yes')); ?>',
                                className: 'btn waves-effect'
                            }
                        },
                        callback: function (result) {
                            if (result) {
                                $.ajax({
                                    url: '<?php echo e(url('/admin/user/purchase/complete/')); ?>/' + id,
                                    type: 'post',
                                    data: {_token: token},
                                    success: function (msg) {
                                        selector.addClass('disabled-style');
                                        status.html('<?php echo e(get_string('yes')); ?>');
                                        toastr.success(msg);
                                    },
                                    error: function (msg) {
                                        toastr.error(msg.responseJSON);
                                    }
                                });
                            }
                        }
                    });
                }
            });
            $('.delete-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var selector = $(this).parents('tr');
                var token = $('.token').val();
                bootbox.confirm({
                    title: '<?php echo e(get_string('confirm_action')); ?>',
                    message: '<?php echo e(get_string('delete_confirm')); ?>',
                    onEscape: true,
                    backdrop: true,
                    buttons: {
                        cancel: {
                            label: '<?php echo e(get_string('no')); ?>',
                            className: 'btn waves-effect'
                        },
                        confirm: {
                            label: '<?php echo e(get_string('yes')); ?>',
                            className: 'btn waves-effect'
                        }
                    },
                    callback: function (result) {
                        if(result){
                            $.ajax({
                                url: '<?php echo e(url('/admin/user/purchase/delete')); ?>/'+id,
                                type: 'post',
                                data: {_token :token},
                                success:function(msg) {
                                    selector.remove();
                                    toastr.success(msg);
                                },
                                error:function(msg){
                                    toastr.error(msg.responseJSON);
                                }
                            });
                        }
                    }
                });
            });
            $('.dismiss-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var selector = $(this).parents('tr');
                var status = $('.purchase-status', selector);
                var token = $('.token').val();
                if(!selector.hasClass('disabled-style')){
                    bootbox.confirm({
                        title: '<?php echo e(get_string('confirm_action')); ?>',
                        message: '<?php echo e(get_string('upgrade_dismiss')); ?>',
                        onEscape: true,
                        backdrop: true,
                        buttons: {
                            cancel: {
                                label: '<?php echo e(get_string('no')); ?>',
                                className: 'btn waves-effect'
                            },
                            confirm: {
                                label: '<?php echo e(get_string('yes')); ?>',
                                className: 'btn waves-effect'
                            }
                        },
                        callback: function (result) {
                            if(result){
                                $.ajax({
                                    url: '<?php echo e(url('/admin/user/purchase/dismiss/')); ?>/'+id,
                                    type: 'post',
                                    data: {_token :token},
                                    success:function(msg) {
                                        selector.addClass('disabled-style');
                                        status.html('<?php echo e(get_string('yes')); ?>');
                                        toastr.success(msg);
                                    },
                                    error:function(msg){
                                        toastr.error(msg.responseJSON);
                                    }
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>