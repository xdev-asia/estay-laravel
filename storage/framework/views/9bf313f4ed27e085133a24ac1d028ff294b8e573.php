

<?php $__env->startSection('title'); ?>
    <title><?php echo e(get_string('booking') . ' - ' . get_setting('site_name', 'site')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('page_title'); ?>
    <h3 class="page-title mbot10"><?php echo e(get_string('booking')); ?></h3>
<?php $__env->stopSection(); ?>
<div class="col s12">
    <?php if($bookings->count()): ?>
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th><?php echo e(get_string('property')); ?></th>
                    <th><?php echo e(get_string('start_date')); ?></th>
                    <th><?php echo e(get_string('end_date')); ?></th>
                    <th><?php echo e(get_string('guest_number')); ?></th>
                    <th><?php echo e(get_string('total')); ?></th>
                    <th><?php echo e(get_string('completed')); ?></th>
                    <th class="icon-options"><?php echo e(get_string('options')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr class="<?php echo e($booking->completed ? 'disabled-style' : ''); ?>">
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="<?php echo e($booking->id); ?>" />
                            <label for="<?php echo e($booking->id); ?>"></label>
                        </td>
                        <td><?php if($booking->property_id && $booking->property): ?> <?php echo e($booking->property->contentDefault->name); ?> <?php elseif($booking->service): ?> <?php echo e($booking->service->contentDefault->name); ?> <?php endif; ?></td>
                        <td><?php echo e($booking->start_date); ?></td>
                        <td><?php echo e($booking->end_date); ?></td>
                        <td><?php echo e($booking->guest_number); ?></td>
                        <td><?php echo e($booking->total); ?> <?php echo e($currency); ?></td>
                        <td class="booking-status"><?php echo e($booking->completed ? get_string('yes') : get_string('no')); ?></td>
                        <td>
                            <div class="icon-options">
                                <a href="#" class="confirm-button" data-id="<?php echo e($booking->id); ?>" title="<?php echo e(get_string('approve_booking')); ?>"><i class="small material-icons color-primary">done</i></a>
                                <a href="#" class="reject-button" data-id="<?php echo e($booking->id); ?>" title="<?php echo e(get_string('reject_booking')); ?>"><i class="small material-icons color-red">close</i></a>
                                <a href="#user-modal" data-toggle="modal" class="user-info" data-id="<?php echo e($booking->id); ?>" title="<?php echo e(get_string('user_info')); ?>"><i class="small material-icons color-blue">person</i></a>
                                <a href="#" class="delete-button" data-id="<?php echo e($booking->id); ?>" title="<?php echo e(get_string('delete_booking')); ?>"><i class="small material-icons color-red">delete</i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php echo e($bookings->links()); ?>

    <?php else: ?>
        <strong class="center-align"><?php echo e(get_string('no_results')); ?></strong>
    <?php endif; ?>
</div>
<input type="hidden" class="token" value="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <div id="user-modal" class="modal not-summernote fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#!" class="close" data-dismiss="modal" aria-label="Close"><i class="material-icons">clear</i></a>
                    <strong class="modal-title"><?php echo e(get_string('user_info')); ?></strong>
                </div>
                <div class="modal-body" id="user-details"></div>
                <div class="modal-footer">
                    <a href="#!" class="waves-effect btn btn-default" data-dismiss="modal"><?php echo e(get_string('close')); ?></a>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#user-modal").on('hidden.bs.modal', function () {
            $('#user-details').html('');
        });
        $('.user-info').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var token = $('.token').val();
            $.ajax({
                url: '<?php echo e(url('/admin/booking/user_details')); ?>/' + id,
                type: 'post',
                data: {_token: token},
                success: function (msg) {
                   var first_name = (typeof msg.first_name !== 'undefined') ? msg.first_name : '';
                    var last_name = (typeof msg.last_name !== 'undefined') ? msg.last_name : '';
                    var phone = (typeof msg.phone !== 'undefined') ? msg.phone : '';
                    var email = (typeof msg.email !== 'undefined') ? msg.email : '';
                    $('#user-details').html('<span class="first-name"><span><?php echo e(get_string('first_name')); ?>: </span>'+ first_name +'</span><span class="email"><span><?php echo e(get_string('email')); ?>: </span>'+ email +'</span><span class="phone"><span><?php echo e(get_string('phone')); ?>: </span>'+ phone +'</span>');
                },
                error: function (msg) {
                    toastr.error(msg.responseJSON);
                }
            });
        });

         $('.confirm-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var status = $('.booking-status', selector);
            var token = $('.token').val();
            if(!selector.hasClass('disabled-style')) {
                bootbox.confirm({
                    title: '<?php echo e(get_string('confirm_action')); ?>',
                    message: '<?php echo e(get_string('activate_booking_confirm')); ?>',
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
                                url: '<?php echo e(url('/admin/booking/activate')); ?>/' + id,
                                type: 'post',
                                data: {_token: token},
                                beforeSend: function(){
                                    $('.table').addClass('loading');
                                },
                                success: function (msg) {
                                    selector.addClass('disabled-style');
                                    status.html('<?php echo e(get_string('yes')); ?>');
                                    toastr.success(msg);
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

        $('.reject-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var status = $('.booking-status', selector);
            var token = $('.token').val();
            if(!selector.hasClass('disabled-style')) {
                bootbox.confirm({
                    title: '<?php echo e(get_string('confirm_action')); ?>',
                    message: '<?php echo e(get_string('reject_booking_confirm')); ?> <br/> <div id="reason" class="form-group"><textarea name="reason" class="form-control"></textarea></div>',
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
                        console.log(result, $('[name="reason"]').val() != '');
                        if (result) {
                            $.ajax({
                                url: '<?php echo e(url('/admin/booking/reject')); ?>/' + id,
                                type: 'post',
                                data: {_token: token, reason: $('[name="reason"]').val()},
                                beforeSend: function(){
                                    $('.table').addClass('loading');
                                },
                                success: function (msg) {
                                    selector.addClass('disabled-style');
                                    status.html('<?php echo e(get_string('yes')); ?>');
                                    toastr.success(msg);
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
                            url: '<?php echo e(url('/admin/booking/delete')); ?>/'+id,
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