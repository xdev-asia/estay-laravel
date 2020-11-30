

<?php $__env->startSection('title'); ?>
    <title><?php echo e(get_string('messages') . ' - ' . get_setting('site_name', 'site')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('page_title'); ?>
    <h3 class="page-title mbot10"><?php echo e(get_string('message_threads')); ?></h3>
<?php $__env->stopSection(); ?>
 <?php if(Session::has('success_message_sent')): ?>
    <div class="col s12">
        <div class="col s12 text-centered">
            <h5 class="color-primary"><?php echo e(get_string('success_message_sent')); ?></h5>
        </div>
    </div>
 <?php endif; ?>
<div class="col s12">
    <?php if($threads->count()): ?>
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th><?php echo e(get_string('between')); ?></th>
                    <th><?php echo e(get_string('updated')); ?></th>
                    <th><?php echo e(get_string('created')); ?></th>
                    <th class="icon-options"><?php echo e(get_string('options')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr class="<?php echo e($thread->closed ? 'disabled-style' : ''); ?>">
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="<?php echo e($thread->id); ?>" />
                            <label for="<?php echo e($thread->id); ?>"></label>
                        </td>
                        <td <?php if($thread->status == 1): ?> class="color-red" <?php endif; ?>>
                            <?php echo e($thread->user ? $thread->user->username : ''); ?> - <?php echo e($thread->owner ? $thread->owner->username : ''); ?></td>
                        <td><?php echo e($thread->updated_at->diffForHumans()); ?></td>
                        <td><?php echo e($thread->created_at->diffForHumans()); ?></td>
                        <td>
                            <div class="icon-options">
                                <?php if(!$thread->closed): ?> 
                                    <a class="edit-button" href="<?php echo e(route('admin_message_list', $thread->id)); ?>"><i class="small material-icons color-primary">message</i></a>
                                <a href="#" class="close-button" data-id="<?php echo e($thread->id); ?>"><i class="small material-icons color-red">close</i></a>
                                <?php endif; ?>
                                <a href="#" class="delete-button" data-id="<?php echo e($thread->id); ?>"><i class="small material-icons color-red">delete</i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php echo e($threads->links()); ?>

    <?php else: ?>
        <strong class="center-align"><?php echo e(get_string('no_results')); ?></strong>
    <?php endif; ?>
</div>
<input type="hidden" class="token" value="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<script type="text/javascript">
    $(document).ready(function(){

         $('.close-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var status = $('.booking-status', selector);
            var token = $('.token').val();
            if(!selector.hasClass('disabled-style')) {
                bootbox.confirm({
                    title: '<?php echo e(get_string('confirm_action')); ?>',
                    message: '<?php echo e(get_string('message_close_confirm')); ?>',
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
                                url: '<?php echo e(url('/admin/message/close')); ?>/' + id,
                                type: 'post',
                                data: {_token: token},
                                beforeSend: function(){
                                    $('.table').addClass('loading');
                                },
                                success: function (msg) {
                                    selector.addClass('disabled-style');
                                    status.html('<?php echo e(get_string('yes')); ?>');
                                    toastr.success(msg);
                                    $('.close-button').hide();
                                    $('.edit-button').hide();
                                    $('.table').removeClass('loading');
                                },
                                error: function (msg) {
                                    toastr.error(msg.responseJSON);
                                    $('.table').removeClass('loading');
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
                            url: '<?php echo e(url('/admin/message/delete')); ?>/'+id,
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
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>