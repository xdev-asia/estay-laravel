<?php $__env->startSection('title'); ?>
    <title><?php echo e(get_string('requests') . ' - ' . get_setting('site_name', 'site')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('page_title'); ?>
    <h3 class="page-title mbot10"><?php echo e(get_string('requests')); ?></h3>
<?php $__env->stopSection(); ?>
<div class="col s12">
    <h3 class="page-title"><?php echo e(get_string('users')); ?></h3>
    <?php if($users->count()): ?>
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th><?php echo e(get_string('username')); ?></th>
                    <th><?php echo e(get_string('email')); ?></th>
                    <th><?php echo e(get_string('first_name')); ?></th>
                    <th><?php echo e(get_string('last_name')); ?></th>
                    <th><?php echo e(get_string('status')); ?></th>
                    <th class="icon-options"><?php echo e(get_string('options')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <?php if($user && $user->user): ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="<?php echo e($user->id); ?>" />
                            <label for="<?php echo e($user->id); ?>"></label>
                        </td>
                        <td><?php echo e($user->username); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php if($user->user): ?><?php echo e($user->user->first_name); ?><?php endif; ?></td>
                        <td><?php if($user->user): ?><?php echo e($user->user->last_name); ?><?php endif; ?></td>
                        <td class="post-status"><?php echo e($user->is_active ? get_string('active') : get_string('pending')); ?></td>
                        <td>
                            <div class="icon-options">
                                <a href="#" data-type="1" class="activate-button <?php echo e($user->is_active ? 'hidden': ''); ?>" data-id="<?php echo e($user->id); ?>" title="<?php echo e(get_string('activate_user')); ?>"><i class="small material-icons color-primary">done</i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <strong class="center-align"><?php echo e(get_string('no_results')); ?></strong>
    <?php endif; ?>
    <?php echo e(csrf_field()); ?>

    <h3 class="page-title"><?php echo e(get_string('properties')); ?></h3>
    <?php if($properties->count()): ?>
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th><?php echo e(get_string('property')); ?></th>
                    <th><?php echo e(get_string('user')); ?></th>
                    <th><?php echo e(get_string('category')); ?></th>
                    <th><?php echo e(get_string('location')); ?></th>
                    <th><?php echo e(get_string('status')); ?></th>
                    <th><?php echo e(get_string('featured')); ?></th>
                    <th class="icon-options"><?php echo e(get_string('options')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="<?php echo e($property->id); ?>" />
                            <label for="<?php echo e($property->id); ?>"></label>
                        </td>
                        <td><?php echo e($property->contentDefault->name); ?></td>
                        <td><?php if($property->user): ?><?php echo e($property->user->username); ?><?php else: ?> <i class="small material-icons color-red">clear</i> <?php endif; ?></td>
                        <td><?php echo e($property->category->contentDefault->name); ?></td>
                        <td><?php echo e($property->prop_location->contentDefault->location); ?></td>
                        <td class="page-status"><?php echo e($property->status ? get_string('active') : get_string('pending')); ?></td>
                        <td class="page-featured"><?php echo e($property->featured ? get_string('yes') : get_string('no')); ?></td>
                        <td>
                            <div class="icon-options">
                                <a href="#" data-type="3" class="activate-button <?php echo e($property->status ? 'hidden': ''); ?>" data-id="<?php echo e($property->id); ?>" title="<?php echo e(get_string('activate_property')); ?>"><i class="small material-icons color-primary">done</i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <strong class="center-align"><?php echo e(get_string('no_results')); ?></strong>
    <?php endif; ?>
    <h3 class="page-title"><?php echo e(get_string('services')); ?></h3>
    <?php if($services->count()): ?>
        <div class="table-responsive">
            <table class="table bordered striped">
                <thead class="thead-inverse">
                <tr>
                    <th>
                        <input type="checkbox" class="filled-in primary-color" id="select-all" />
                        <label for="select-all"></label>
                    </th>
                    <th><?php echo e(get_string('user')); ?></th>
                    <th><?php echo e(get_string('category')); ?></th>
                    <th><?php echo e(get_string('name')); ?></th>
                    <th><?php echo e(get_string('status')); ?></th>
                    <th><?php echo e(get_string('featured')); ?></th>
                    <th class="icon-options"><?php echo e(get_string('options')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="<?php echo e($service->id); ?>" />
                            <label for="<?php echo e($service->id); ?>"></label>
                        </td>
                        <td><?php if($service->user): ?><?php echo e($service->user->username); ?><?php else: ?> <i class="small material-icons color-red">clear</i> <?php endif; ?></td>
                        <td><?php echo e($service->category->contentDefault->name); ?></td>
                        <td><?php echo e($service->contentDefault->name); ?></td>
                        <td class="page-status"><?php echo e($service->status ? get_string('active') : get_string('pending')); ?></td>
                        <td class="page-featured"><?php echo e($service->featured ? get_string('yes') : get_string('no')); ?></td>
                        <td>
                            <div class="icon-options">
                                <a href="#" data-type="4" class="activate-button <?php echo e($service->status ? 'hidden': ''); ?>" data-id="<?php echo e($service->id); ?>" title="<?php echo e(get_string('activate_service')); ?>"><i class="small material-icons color-primary">done</i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <strong class="center-align"><?php echo e(get_string('no_results')); ?></strong>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script>
        $(document).ready(function(){
            $('.activate-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var selector = $(this).parents('tr');
                var thisBtn = $(this).parents('.icon-options');
                var status = selector.children('.page-status');
                var token = $('[name="_token"]').val();
                var type = $(this).data('type');
                switch(type){
                    case 1 : var url = '<?php echo e(url('/admin/user/activate/')); ?>/'; break;
                    case 2 : var url = '<?php echo e(url('.admin/owner/activate/')); ?>/'; break;
                    case 3 : var url = '<?php echo e(url('/admin/property/activate/')); ?>/'; break;
                    case 4 : var url = '<?php echo e(url('/admin/service/activate/')); ?>/'; break;
                }
                bootbox.confirm({
                    title: '<?php echo e(get_string('confirm_action')); ?>',
                    message: '<?php echo e(get_string('activate_item')); ?>',
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
                                url: url + id,
                                type: 'post',
                                data: {_token :token},
                                success:function(msg) {
                                    thisBtn.children('.activate-button').addClass('hidden');
                                    thisBtn.children('.deactivate-button').removeClass('hidden');
                                    status.html('<?php echo e(get_string('active')); ?>');
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