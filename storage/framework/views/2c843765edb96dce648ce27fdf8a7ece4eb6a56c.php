

<?php $__env->startSection('title'); ?>
    <title><?php echo e(get_string('blog') . ' - ' . get_setting('site_name', 'site')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('page_title'); ?>
    <h3 class="page-title mbot10"><?php echo e(get_string('posts')); ?></h3>
<?php $__env->stopSection(); ?>
    <div class="col l6 m6 s12 left left-align mbot10">
        <?php echo Form::open(['method' => 'post', 'url' => route('admin_blog_search')]); ?>

        <div class="form-group col s8 autocomplete-fix">
            <?php echo e(Form::text('term', null, ['class' => 'form-control', 'id' => 'term', 'placeholder' => get_string('search_posts')])); ?>

        </div>
        <div class="col l4 m4 s4">
            <button class="btn waves-effect" type="submit" name="action"><?php echo e(get_string('filter')); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
    <div class="col l6 m6 s12 right right-align mbot10">
        <a href="<?php echo e(route('admin.blog.create')); ?>" class="btn waves-effect"> <?php echo e(get_string('create_post')); ?> <i class="material-icons small">add_circle</i></a>
        <a href="#" class="mass-delete btn waves-effect btn-red"><i class="material-icons color-white">delete</i></a>
    </div>
    <div class="col s12">
        <?php if($posts->count()): ?>
        <div class="table-responsive">
        <table class="table bordered striped">
            <thead class="thead-inverse">
            <tr>
                <th>
                    <input type="checkbox" class="filled-in primary-color" id="select-all" />
                    <label for="select-all"></label>
                </th>
                <th><?php echo e(get_string('user')); ?></th>
                <th><?php echo e(get_string('title')); ?></th>
                <th><?php echo e(get_string('status')); ?></th>
                <th class="icon-options"><?php echo e(get_string('options')); ?></th>
            </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="filled-in primary-color" id="<?php echo e($post->id); ?>" />
                            <label for="<?php echo e($post->id); ?>"></label>
                        </td>
                        <td><?php if($post->user): ?><?php echo e($post->user->username); ?><?php endif; ?></td>
                        <td><?php echo e($post->contentDefault->title); ?></td>
                        <td class="post-status"><?php echo e($post->status ? get_string('active') : get_string('pending')); ?></td>
                        <td>
                            <div class="icon-options">
                                <a href="<?php echo e(url('blog/post').'/'.$post->alias); ?>" title="<?php echo e(get_string('view_page')); ?>" ><i class="small material-icons color-primary">visibility</i></a>
                                <a href="<?php echo e(route('admin.blog.edit', $post->id)); ?>" title="<?php echo e(get_string('edit_post')); ?>"><i class="small material-icons color-primary">mode_edit</i></a>
                                <a href="#" class="delete-button" data-id="<?php echo e($post->id); ?>" title="<?php echo e(get_string('delete_post')); ?>"><i class="small material-icons color-red">delete</i></a>
                                <a href="#" class="activate-button <?php echo e($post->status ? 'hidden': ''); ?>" data-id="<?php echo e($post->id); ?>" title="<?php echo e(get_string('activate_post')); ?>"><i class="small material-icons color-primary">done</i></a>
                                <a href="#" class="deactivate-button <?php echo e($post->status ? '': 'hidden'); ?>" data-id="<?php echo e($post->id); ?>" title="<?php echo e(get_string('deactivate_post')); ?>"><i class="small material-icons color-primary">close</i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </tbody>
        </table>
        </div>
        <?php echo e($posts->links()); ?>

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
            var token = $('[name=_token]').val();
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
                            url: '<?php echo e(url('/admin/blog/')); ?>/'+id,
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
            var status = selector.children('.post-status');
            var token = $('[name=_token]').val();
            bootbox.confirm({
                title: '<?php echo e(get_string('confirm_action')); ?>',
                message: '<?php echo e(get_string('activate_post_confirm')); ?>',
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
                            url: '<?php echo e(url('/admin/blog/activate/')); ?>/'+id,
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
            var status = selector.children('.post-status');
            var token = $('[name=_token]').val();
            bootbox.confirm({
                title: '<?php echo e(get_string('confirm_action')); ?>',
                message: '<?php echo e(get_string('deactivate_post_confirm')); ?>',
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
                            url: '<?php echo e(url('/admin/blog/deactivate/')); ?>/'+id,
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

        $('.mass-delete').click(function(event){
            event.preventDefault();
            var id = [];
            var selector = [];
            $("tbody input:checkbox:checked").each(function(){
                id.push($(this).attr('id'));
                selector.push($(this).parents('tr'));
            });
            var token = $('[name=_token]').val();
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
                    if(result) {
                        $.ajax({
                            url: '<?php echo e(url('admin/blog/massdestroy')); ?>',
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
            source: '<?php echo e(url('/admin/blog/autocomplete')); ?>',
            minLength: 0,
            delay: 0,
            focus: function( event, ui ) {
                $('#term').val( ui.item.title );
                return false;
            },
            select: function( event, ui ) {
                $('#term').val( ui.item.title).attr('data-id', ui.item.id);
                return false;
        }}).data("ui-autocomplete")._renderItem = function( ul, item ) {
             return $( "<li></li>" )
             .append( "<a href='#!'>" + item.title + "</a>" )
            .appendTo( ul );
         };
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>