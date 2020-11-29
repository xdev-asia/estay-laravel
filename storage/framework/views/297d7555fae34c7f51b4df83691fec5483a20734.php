

<?php $__env->startSection('title'); ?>
    <title><?php echo e(get_string('login_title') .' - '. get_setting('site_name', 'site')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

                    <?php echo Form::open(['method' => 'post', 'class' => 'form-material', 'url' => route('login')]); ?>

                        <div class="input-field">
                            <?php echo Form::email('email', null, ['id' => 'email', 'class' => $errors->has('email') ? 'invalid' : '']); ?>

                            <?php echo Form::label('email', get_string('email_address')); ?>

                        <?php if($errors->has('email')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('email')); ?></span>
                        <?php endif; ?>
                        </div>
                        <div class="input-field">
                            <?php echo Form::password('password', ['id' => 'password', 'class' => $errors->has('password') ? 'invalid' : '']); ?>

                            <?php echo Form::label('password', get_string('password')); ?>

                            <?php if($errors->has('password')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('password')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="input-field input-checkbox">
                            <?php echo Form::checkbox('remember', null, false, ['id' => 'remember']); ?>

                            <?php echo Form::label('remember', get_string('remember_me')); ?>

                        </div>
                    <div class="input-field input-button">
                        <button class="btn waves-effect waves-light" type="submit" name="action"><?php echo e(get_string('login')); ?></button>
                        <a class="forgot" href="<?php echo e(route('reset_password')); ?>"><?php echo e(get_string('forgot_password')); ?></a>
                    </div>
                    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>