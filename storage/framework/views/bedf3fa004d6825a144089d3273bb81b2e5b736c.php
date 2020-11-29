

<?php $__env->startSection('title'); ?>
    <title><?php echo e(get_string('services') . ' - ' . get_setting('site_name', 'site')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('page_title'); ?>
    <h3 class="page-title mbot10"><?php echo e(get_string('services')); ?></h3>
<?php $__env->stopSection(); ?>
    <div class="col l6 m8 s12 left left-align mbot10">
        <?php echo e(Form::open(['method' => 'post', 'url' => route('admin_service_search')])); ?>

        <div class="form-group col s8 autocomplete-fix">
            <?php echo e(Form::text('term', null, ['class' => 'form-control', 'id' => 'term', 'placeholder' => get_string('search_services')])); ?>

        </div>
        <div class="col l4 m4 s4">
            <button class="btn waves-effect" type="submit" name="action"><?php echo e(get_string('filter')); ?></button>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
    <div class="col l6 m4 s12 right right-align mbot10">
        <a href="<?php echo e(route('admin.service.create')); ?>" class="btn waves-effect"> <?php echo e(get_string('create_service')); ?> <i class="material-icons small">add_circle</i></a>
        <a href="#" class="mass-delete btn waves-effect btn-red"><i class="material-icons color-white">delete</i></a>
    </div>
    <div class="col s12">
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
                                <a href="<?php echo e(url('service').'/'.$service->alias); ?>" title="<?php echo e(get_string('view_service')); ?>"><i class="small material-icons color-primary">visibility</i></a>
                                <a href="<?php echo e(route('admin.service.edit', $service->id)); ?>" title="<?php echo e(get_string('edit_service')); ?>"><i class="small material-icons color-primary">mode_edit</i></a>
                                <a href="#" class="delete-button" data-id="<?php echo e($service->id); ?>" title="<?php echo e(get_string('delete_service')); ?>"><i class="small material-icons color-red">delete</i></a>
                                <a href="#" class="activate-button <?php echo e($service->status ? 'hidden': ''); ?>" data-id="<?php echo e($service->id); ?>" title="<?php echo e(get_string('activate_service')); ?>"><i class="small material-icons color-primary">done</i></a>
                                <a href="#" class="deactivate-button <?php echo e($service->status ? '': 'hidden'); ?>" data-id="<?php echo e($service->id); ?>" title="<?php echo e(get_string('deactivate_service')); ?>"><i class="small material-icons color-primary">close</i></a>
                                <a href="#" class="make-featured-button <?php echo e($service->featured ? 'hidden': ''); ?>" data-id="<?php echo e($service->id); ?>" title="<?php echo e(get_string('make_featured')); ?>"><i class="small material-icons color-primary">grade</i></a>
                                <a href="#" class="make-default-button <?php echo e($service->featured ? '': 'hidden'); ?>" data-id="<?php echo e($service->id); ?>" title="<?php echo e(get_string('make_default')); ?>"><i class="small material-icons color-yellow">grade</i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </tbody>
        </table>
        </div>
        <?php echo e($services->links()); ?>

        <?php else: ?>
            <strong class="center-align"><?php echo e(get_string('no_results')); ?></strong>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<script>
    $(document).ready(function(){
        $('.delete-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var token = $('[name="_token"]').val();
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
                            url: '<?php echo e(url('/admin/service/')); ?>/'+id,
                            type: 'post',
                            data: {_method: 'delete', _token :token},
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

        $('.activate-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var thisBtn = $(this).parents('.icon-options');
            var status = selector.children('.page-status');
            var token = $('[name="_token"]').val();
            bootbox.confirm({
                title: '<?php echo e(get_string('confirm_action')); ?>',
                message: '<?php echo e(get_string('activate_service_confirm')); ?>',
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
                            url: '<?php echo e(url('/admin/service/activate/')); ?>/'+id,
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

        $('.deactivate-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var thisBtn = $(this).parents('.icon-options');
            var status = selector.children('.page-status');
            var token = $('[name="_token"]').val();
            bootbox.confirm({
                title: '<?php echo e(get_string('confirm_action')); ?>',
                message: '<?php echo e(get_string('deactivate_service_confirm')); ?>',
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
                            url: '<?php echo e(url('/admin/service/deactivate/')); ?>/'+id,
                            type: 'post',
                            data: {_token :token},
                            success:function(msg) {
                                thisBtn.children('.deactivate-button').addClass('hidden');
                                thisBtn.children('.activate-button').removeClass('hidden');
                                status.html('<?php echo e(get_string('pending')); ?>');
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

        $('.make-featured-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var thisBtn = $(this).parents('.icon-options');
            var status = selector.children('.page-featured');
            var token = $('[name="_token"]').val();
            bootbox.confirm({
                title: '<?php echo e(get_string('confirm_action')); ?>',
                message: '<?php echo e(get_string('make_featured_confirm')); ?>',
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
                            url: '<?php echo e(url('/admin/service/makefeatured/')); ?>/'+id,
                            type: 'post',
                            data: {_token :token},
                            success:function(msg) {
                                thisBtn.children('.make-featured-button').addClass('hidden');
                                thisBtn.children('.make-default-button').removeClass('hidden');
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
        });

        $('.make-default-button').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var selector = $(this).parents('tr');
            var thisBtn = $(this).parents('.icon-options');
            var status = selector.children('.page-featured');
            var token = $('[name="_token"]').val();
            bootbox.confirm({
                title: '<?php echo e(get_string('confirm_action')); ?>',
                message: '<?php echo e(get_string('make_default_confirm')); ?>',
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
                            url: '<?php echo e(url('/admin/service/makedefault/')); ?>/'+id,
                            type: 'post',
                            data: {_token :token},
                            success:function(msg) {
                                thisBtn.children('.make-default-button').addClass('hidden');
                                thisBtn.children('.make-featured-button').removeClass('hidden');
                                status.html('<?php echo e(get_string('no')); ?>');
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


        $('.mass-delete').click(function(event){
            event.preventDefault();
            var id = [];
            var selector = [];
            $("tbody input:checkbox:checked").each(function(){
                id.push($(this).attr('id'));
                selector.push($(this).parents('tr'));
            });
            var token = $('[name="_token"]').val();
            bootbox.confirm({
                title: '<?php echo e(get_string('confirm_action')); ?>',
                message: '<?php echo e(get_string('delete_confirm_bulk')); ?>',
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
                            url: '<?php echo e(url('/admin/service/massdestroy')); ?>',
                            type: 'post',
                            data: {id: id, _token :token},
                            success:function(msg) {
                                $.each(selector, function(index, item){
                                    $(this).remove();
                                });
                                $('#select-all').prop('checked', false);
                                toastr.success(msg);
                            },
                            error: function(msg){
                                toastr.error(msg.responseJSON);
                            }
                        });
                    }
                }
            });
        });
        $('#term').autocomplete({
            source: '<?php echo e(url('/admin/service/autocomplete')); ?>',
            minLength: 0,
            delay: 0,
            focus: function( event, ui ) {
                $('#term').val( ui.item.name );
                return false;
            },
            select: function( event, ui ) {
                $('#term').val( ui.item.name).attr('data-id', ui.item.id);
                return false;
        }}).data("ui-autocomplete")._renderItem = function( ul, item ) {
             return $( "<li></li>" )
             .append( "<a href='#'>" + item.name + "</a>" )
            .appendTo( ul );
         };
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>