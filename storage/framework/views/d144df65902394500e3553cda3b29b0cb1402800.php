

<?php $__env->startSection('title'); ?>
    <title><?php echo e(get_string('site_settings') . ' - ' . get_setting('site_name', 'site')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('page_title'); ?>
    <h3 class="page-title mbot10"><?php echo e(get_string('site_settings')); ?></h3>
<?php $__env->stopSection(); ?>
<div class="panel col s12">
    <div class="row">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="tab active"><a data-toggle="tab" href="#general_settings"><?php echo e(get_string('general')); ?></a></li>
                <li class="tab"><a data-toggle="tab" href="#location"><?php echo e(get_string('location')); ?></a></li>
                <li class="tab"><a data-toggle="tab" href="#contact"><?php echo e(get_string('contact')); ?></a></li>
                <li class="tab"><a data-toggle="tab" href="#social"><?php echo e(get_string('social')); ?></a></li>
                <li class="tab"><a data-toggle="tab" href="#google_settings"><?php echo e(get_string('google')); ?></a></li>
                <!-- <li class="tab"><a data-toggle="tab" href="#email_settings"><?php echo e(get_string('email')); ?></a></li> -->
            </ul>
        </div>
        <?php echo Form::open(['url' => route('admin_site_settings_update'), 'method' => 'post', 'id' => "site_settings", 'class' => 'table-responsive', 'files' => 'true']); ?>

        <div class="panel-body">
            <div class="tab-content">
                <div id="general_settings" class="tab-pane active">
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('site_name') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('site_name', get_setting('site_name', 'site'), ['class' => 'form-control', 'placeholder' => get_string('site_name')])); ?>

                            <?php echo e(Form::label('site_name', get_string('site_name'))); ?>

                            <?php if($errors->has('site_name')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('site_name')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l12 m12 s12">
                        <div class="form-group  <?php echo e($errors->has('site_description') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::textarea('site_description', get_setting('site_description', 'site'), ['class' => 'form-control', 'rows' => '5', 'placeholder' => get_string('site_description')])); ?>

                            <?php echo e(Form::label('site_description', get_string('site_description'))); ?>

                            <?php if($errors->has('site_description')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('site_description')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l12 m12 s12">
                        <div class="form-group  <?php echo e($errors->has('site_keywords') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::textarea('site_keywords', get_setting('site_keywords', 'site'), ['class' => 'form-control', 'rows' => '2', 'placeholder' => get_string('site_keywords_description')])); ?>

                            <?php echo e(Form::label('site_keywords', get_string('site_keywords'))); ?>

                            <?php if($errors->has('site_keywords')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('site_keywords')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col s12 mbot20">
                        <div class="input-group clearfix <?php echo e($errors->has('logo') ? 'has-error' : ''); ?>">
                            <label class="input-group-btn">
                                <span class="btn btn-primary waves-effect"><?php echo e(get_string('select_file')); ?>

                                    <?php echo Form::file('logo', ['class' => 'hidden']); ?>

                                </span>
                            </label>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <div class="field-info"><?php echo e(get_string('upload_your_logo')); ?>  <?php echo e(get_setting('site_logo', 'site')); ?></div>
                    </div>
                    <div class="col s12 mbot20">
                        <div class="input-group clearfix <?php echo e($errors->has('favicon') ? 'has-error' : ''); ?>">
                            <label class="input-group-btn">
                                <span class="btn btn-primary waves-effect"><?php echo e(get_string('select_file')); ?>

                                    <?php echo Form::file('favicon', ['class' => 'hidden']); ?>

                                </span>
                            </label>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <div class="field-info">Favicon (.ico)</div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('dateformat') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::select('dateformat', ['d.m.Y' => 'dd/mm/YYYY', 'm.d.Y' => 'mm/dd/YYYY'], get_setting('dateformat', 'site'), ['class' => 'form-control'])); ?>

                            <?php echo e(Form::label('dateformat', get_string('dateformat'))); ?>

                            <?php if($errors->has('dateformat')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('dateformat')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s6">
                        <div class="form-group  <?php echo e($errors->has('measurement_unit') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::select('measurement_unit', ['m2' => 'm2', 'ft' => 'ft'], get_setting('measurement_unit', 'site'), ['class' => 'form-control'])); ?>

                            <?php echo e(Form::label('measurement_unit', get_string('measurement_unit'))); ?>

                            <?php if($errors->has('measurement_unit')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('measurement_unit')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12 clearfix">
                        <div class="form-group  <?php echo e($errors->has('allow_blog') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::select('allow_blog', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('allow_blog', 'site'), ['class' => 'form-control'])); ?>

                            <?php echo e(Form::label('allow_blog', get_string('allow_blog'))); ?>

                            <?php if($errors->has('allow_blog')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('allow_blog')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div id="location" class="tab-pane">
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('location_address') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('location_address', get_setting('location_address', 'site'), ['class' => 'form-control', 'placeholder' => get_string('address')])); ?>

                            <?php echo e(Form::label('location_address', get_string('address'))); ?>

                            <?php if($errors->has('location_address')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('location_address')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('location_city') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('location_city', get_setting('location_city', 'site'), ['class' => 'form-control', 'placeholder' => get_string('city')])); ?>

                            <?php echo e(Form::label('location_city', get_string('city'))); ?>

                            <?php if($errors->has('location_city')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('location_city')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('location_state') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('location_state', get_setting('location_state', 'site'), ['class' => 'form-control', 'placeholder' => get_string('state')])); ?>

                            <?php echo e(Form::label('location_state', get_string('state'))); ?>

                            <?php if($errors->has('location_state')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('location_state')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('location_country') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('location_country', get_setting('location_country', 'site'), ['class' => 'form-control', 'placeholder' => get_string('country')])); ?>

                            <?php echo e(Form::label('location_country', get_string('country'))); ?>

                            <?php if($errors->has('location_country')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('location_country')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('location_zip') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('location_zip', get_setting('location_zip', 'site'), ['class' => 'form-control', 'placeholder' => get_string('zip')])); ?>

                            <?php echo e(Form::label('location_zip', get_string('zip'))); ?>

                            <?php if($errors->has('location_zip')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('location_zip')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div id="contact" class="tab-pane">
                    <div class="col l4 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('contact_tel1') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('contact_tel1', get_setting('contact_tel1', 'site'), ['class' => 'form-control', 'placeholder' => get_string('contact_tel1')])); ?>

                            <?php echo e(Form::label('contact_tel1', get_string('contact_tel1'))); ?>

                            <?php if($errors->has('contact_tel1')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('contact_tel1')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l4 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('contact_tel2') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('contact_tel2', get_setting('contact_tel2', 'site'), ['class' => 'form-control', 'placeholder' => get_string('contact_tel2')])); ?>

                            <?php echo e(Form::label('contact_tel2', get_string('contact_tel2'))); ?>

                            <?php if($errors->has('contact_tel2')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('contact_tel2')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l4 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('contact_fax') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('contact_fax', get_setting('contact_fax', 'site'), ['class' => 'form-control', 'placeholder' => get_string('fax')])); ?>

                            <?php echo e(Form::label('contact_fax', get_string('fax'))); ?>

                            <?php if($errors->has('contact_fax')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('contact_fax')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('contact_email') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('contact_email', get_setting('contact_email', 'site'), ['class' => 'form-control', 'placeholder' => get_string('email')])); ?>

                            <?php echo e(Form::label('contact_email', get_string('email'))); ?>

                            <?php if($errors->has('contact_email')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('contact_email')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('contact_web') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('contact_web', get_setting('contact_web', 'site'), ['class' => 'form-control', 'placeholder' => get_string('website')])); ?>

                            <?php echo e(Form::label('contact_web', get_string('website'))); ?>

                            <?php if($errors->has('contact_web')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('contact_web')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12 clearfix">
                        <div class="form-group  <?php echo e($errors->has('contact_map_lat') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('contact_map_lat', get_setting('contact_map_lat', 'site'), ['class' => 'form-control', 'placeholder' => get_string('geo_lat')])); ?>

                            <?php echo e(Form::label('contact_map_lat', get_string('geo_lat'))); ?>

                            <?php if($errors->has('contact_map_lat')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('contact_map_lat')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('contact_map_lon') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('contact_map_lon', get_setting('contact_map_lon', 'site'), ['class' => 'form-control', 'placeholder' => get_string('geo_lon')])); ?>

                            <?php echo e(Form::label('contact_map_lon', get_string('geo_lon'))); ?>

                            <?php if($errors->has('contact_map_lon')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('contact_map_lon')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div id="social" class="tab-pane">
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('social_facebook') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('social_facebook', get_setting('social_facebook', 'site'), ['class' => 'form-control', 'placeholder' => get_string('facebook')])); ?>

                            <?php echo e(Form::label('social_facebook', get_string('facebook'))); ?>

                            <?php if($errors->has('social_facebook')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('social_facebook')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('social_twitter') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('social_twitter', get_setting('social_twitter', 'site'), ['class' => 'form-control', 'placeholder' => get_string('twitter')])); ?>

                            <?php echo e(Form::label('social_twitter', get_string('twitter'))); ?>

                            <?php if($errors->has('social_twitter')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('social_twitter')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('social_google_plus') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('social_google_plus', get_setting('social_google_plus', 'site'), ['class' => 'form-control', 'placeholder' => get_string('google_plus')])); ?>

                            <?php echo e(Form::label('social_google_plus', get_string('google_plus'))); ?>

                            <?php if($errors->has('social_google_plus')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('social_google_plus')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('social_youtube') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('social_youtube', get_setting('social_youtube', 'site'), ['class' => 'form-control', 'placeholder' => get_string('youtube')])); ?>

                            <?php echo e(Form::label('social_youtube', get_string('youtube'))); ?>

                            <?php if($errors->has('social_youtube')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('social_youtube')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('social_instagram') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('social_instagram', get_setting('social_instagram', 'site'), ['class' => 'form-control', 'placeholder' => get_string('instagram')])); ?>

                            <?php echo e(Form::label('social_instagram', get_string('instagram'))); ?>

                            <?php if($errors->has('social_instagram')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('social_instagram')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('social_pinterest') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('social_pinterest', get_setting('social_pinterest', 'site'), ['class' => 'form-control', 'placeholder' => get_string('pinterest')])); ?>

                            <?php echo e(Form::label('social_pinterest', get_string('pinterest'))); ?>

                            <?php if($errors->has('social_pinterest')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('social_pinterest')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('social_linkedin') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('social_linkedin', get_setting('social_linkedin', 'site'), ['class' => 'form-control', 'placeholder' => get_string('linkedin')])); ?>

                            <?php echo e(Form::label('social_linkedin', get_string('linkedin'))); ?>

                            <?php if($errors->has('social_linkedin')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('social_linkedin')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('social_tripadvisor') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('social_tripadvisor', get_setting('social_tripadvisor', 'site'), ['class' => 'form-control', 'placeholder' => get_string('tripadvisor')])); ?>

                            <?php echo e(Form::label('social_tripadvisor', get_string('tripadvisor'))); ?>

                            <?php if($errors->has('social_tripadvisor')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('social_tripadvisor')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div id="google_settings" class="tab-pane">
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('google_map_key') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('google_map_key', get_setting('google_map_key', 'site'), ['class' => 'form-control', 'placeholder' => get_string('google_maps_api')])); ?>

                            <?php echo e(Form::label('google_map_key', get_string('google_maps_api'))); ?>

                            <?php if($errors->has('google_map_key')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('google_map_key')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('google_map_zoom') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('google_map_zoom', get_setting('google_map_zoom', 'site'), ['class' => 'form-control', 'placeholder' => get_string('google_maps_zoom')])); ?>

                            <?php echo e(Form::label('google_map_zoom', get_string('google_maps_zoom_label'))); ?>

                            <?php if($errors->has('google_map_zoom')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('google_map_key')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l12 m12 s12">
                        <div class="form-group  <?php echo e($errors->has('google_analytics') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('google_analytics', get_setting('google_analytics', 'site'), ['class' => 'form-control', 'placeholder' => get_string('google_analytics_description')])); ?>

                            <?php echo e(Form::label('google_analytics', get_string('google_analytics'))); ?>

                            <?php if($errors->has('google_analytics')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('google_analytics')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12 clearfix">
                        <div class="form-group  <?php echo e($errors->has('reCaptcha') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::select('reCaptcha', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('reCaptcha', 'site'), ['class' => 'form-control'])); ?>

                            <?php echo e(Form::label('reCaptcha', get_string('reCaptcha_label'))); ?>

                            <?php if($errors->has('reCaptcha')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('reCaptcha_label')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('reCaptcha_api') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('reCaptcha_api', get_setting('reCaptcha_api', 'site'), ['class' => 'form-control', 'placeholder' => get_string('reCaptcha_api')])); ?>

                            <?php echo e(Form::label('reCaptcha_api', get_string('reCaptcha_api'))); ?>

                            <?php if($errors->has('reCaptcha_api')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('reCaptcha_api')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l6 m6 s12">
                        <div class="form-group  <?php echo e($errors->has('reCaptcha_api_secret') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('reCaptcha_api_secret', get_setting('reCaptcha_api_secret', 'site'), ['class' => 'form-control', 'placeholder' => get_string('reCaptcha_api_secret')])); ?>

                            <?php echo e(Form::label('reCaptcha_api_secret', get_string('reCaptcha_api_secret'))); ?>

                            <?php if($errors->has('reCaptcha_api_secret')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('reCaptcha_api_secret')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="card-panel">
                            <span class="primary-color">*<?php echo e(get_string('note_for_apiGoogleMap')); ?></span>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="card-panel">
                            <span class="primary-color">*<?php echo e(get_string('note_for_reCaptcha')); ?></span>
                        </div>
                    </div>
                    <!-- <div class="col l12 m12 s12">
                        <div class="form-group  <?php echo e($errors->has('google_map_styles') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::textarea('google_map_styles', get_setting('google_map_styles', 'site'), ['class' => 'form-control', 'placeholder' => get_string('google_map_styles')])); ?>

                            <?php echo e(Form::label('google_map_styles', get_string('google_map_styles_label'))); ?>

                            <?php if($errors->has('google_analytics')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('google_map_styles')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div> -->
                </div>
                <div id="email_settings" class="tab-pane"></div>
            </div>
            <div class="col clearfix l4 m4 s12 mtop10">
                <div class="form-group">
                    <button class="btn waves-effect" type="submit" name="action"><?php echo e(get_string('update')); ?></button></div>
                </div>
            </div>
        <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>