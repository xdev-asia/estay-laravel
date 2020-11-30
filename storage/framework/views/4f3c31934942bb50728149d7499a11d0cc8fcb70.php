

<?php $__env->startSection('title'); ?>
    <title><?php echo e(get_string('create_location') . ' - ' . get_setting('site_name', 'site')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('page_title'); ?>
    <h3 class="page-title mbot10"><?php echo e(get_string('create_location')); ?></h3>
<?php $__env->stopSection(); ?>
<div class="col s12">
    <?php if(!$errors->isEmpty()): ?>
        <span class="wrong-error">* <?php echo e(get_string('validation_error')); ?></span>
    <?php endif; ?>
        <?php echo Form::open(['method' => 'post', 'url' => route('admin.taxonomy.location.store'), 'files' => true]); ?>

    <div class="panel">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="tab active"><a href="#content-panel" data-toggle="tab"><?php echo e(get_string('content')); ?></a></li>
                <li class="tab"><a href="#data-panel" data-toggle="tab"><?php echo e(get_string('data')); ?></a></li>
            </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div id="content-panel" class="tab-pane active">
                    <div class="panel">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <li class="tab <?php echo e($language->default ? 'active' : ''); ?>"><a href="#lang<?php echo e($language->id); ?>" data-parent="#content" data-toggle="tab"><img src="<?php echo e($language->flag); ?>"/><span><?php echo e($language->language); ?></span></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <div id="lang<?php echo e($language->id); ?>" class="tab-pane <?php echo e($language->default ? 'active' : ''); ?>">
                                        <div class="col s12">
                                            <div class="form-group  <?php echo e($errors->has('name.'.$language->id.'') ? 'has-error' : ''); ?>">
                                                <?php echo e(Form::text('name['.$language->id.']', null, ['class' => 'form-control', 'placeholder' => get_string('enter_location_name')])); ?>

                                                <?php echo e(Form::label('name['.$language->id.']', get_string('location_name'))); ?>

                                                <?php if($errors->has('name.'.$language->id.'')): ?>
                                                    <span class="wrong-error">* <?php echo e($errors->first('name.'.$language->id.'')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col s12">
                                            <?php echo e(Form::textarea('description['.$language->id.']', null, ['class' => 'hidden desc-content'])); ?>

                                            <?php if($errors->has('description.'.$language->id.'')): ?>
                                                <span class="wrong-error"><?php echo e($errors->first('description.'.$language->id.'')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="data-panel" class="tab-pane">
                    <div class="col m8 s6 left left-align mbot0">
                        <div class="form-group">
                            <?php echo e(Form::number('order', 0, ['class' => 'form-control', 'min' => '0', 'step' => 1, 'placeholder' => get_string('order')])); ?>

                            <?php echo e(Form::label('order', get_string('order'))); ?>

                        </div>
                    </div>
                    <div class="col m4 s6 right right-align mbot0">
                        <div class="form-group">
                            <div class="switch">
                                <label>
                                    <?php echo e(get_string('standard')); ?><?php echo e(Form::checkbox('featured', 0, false, ['value' => '0', 'id' => 'activeSwitch', 'class' => 'form-control'])); ?><span class="lever"></span><?php echo e(get_string('featured')); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col m6 c12">
                            <div class="col l12 m12 s12">
                                <div class="input-group <?php echo e($errors->has('home_image') ? 'has-error' : ''); ?>">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary waves-effect"><?php echo e(get_string('upload_home_image')); ?> <i class="material-icons small">add_circle</i>
                                            <?php echo Form::file('home_image', ['id' => 'home_image', 'class' => 'hidden']); ?>

                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col m6 c12">
                            <div class="col l12 m12 s12">
                                <div class="input-group <?php echo e($errors->has('featured_image') ? 'has-error' : ''); ?>">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary waves-effect"><?php echo e(get_string('upload_featured_image')); ?> <i class="material-icons small">add_circle</i>
                                            <?php echo Form::file('featured_image', ['id' => 'featured_image', 'class' => 'hidden']); ?>

                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                <span class="field-info"><?php echo e(get_string('min_dimension_featured')); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col clearfix s12 mtop10">
                <div class="form-group">
                    <button class="btn waves-effect" type="submit" name="action"><?php echo e(get_string('create_location')); ?></button>
                    <a href="<?php echo e(route('admin.taxonomy.location.index')); ?>" class="btn waves-effect"><?php echo e(get_string('location_all')); ?></a>
                </div>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script>
        $(document).ready(function(){
            $('.desc-content').summernote({
             height: 200,
             maxwidth: false,
             minwidth: false,
             placeholder: '<?php echo e(get_string('enter_location_content')); ?>',
             disableDragAndDrop: true,
             toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]]
             ],callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>