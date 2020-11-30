

<?php $__env->startSection('title'); ?>
    <title><?php echo e(get_string('design_settings') . ' - ' . get_setting('site_name', 'site')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('page_title'); ?>
    <h3 class="page-title mbot10"><?php echo e(get_string('design_settings')); ?></h3>
<?php $__env->stopSection(); ?>
<div class="panel col s12">
    <div class="row">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="tab active"><a data-toggle="tab" href="#general_settings"><?php echo e(get_string('general')); ?></a></li>
                <li class="tab"><a data-toggle="tab" href="#home_settings"><?php echo e(get_string('home')); ?></a></li>
                <li class="tab"><a data-toggle="tab" href="#strings"><?php echo e(get_string('string')); ?></a></li>
                <li class="tab"><a data-toggle="tab" href="#footer_settings"><?php echo e(get_string('footer')); ?></a></li>
            </ul>
        </div>
        <?php echo Form::open(['url' => route('admin_design_settings_update'), 'method' => 'post', 'id' => "design_settings", 'class' => 'table-responsive', 'files' => 'true']); ?>

        <div class="panel-body">
            <div class="tab-content">
                <div id="general_settings" class="tab-pane active">
                    <div class="col m6 s12">
                        <div class="form-group  <?php echo e($errors->has('show_social_top_bar') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::select('show_social_top_bar', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_social_top_bar', 'design'), ['class' => 'form-control'])); ?>

                            <?php echo e(Form::label('show_social_top_bar', get_string('show_social_top_bar'))); ?>

                            <?php if($errors->has('show_social_top_bar')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('show_social_top_bar')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col m6 s12">
                        <div class="form-group  <?php echo e($errors->has('allow_add_property_button') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::select('allow_add_property_button', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('allow_add_property_button', 'design'), ['class' => 'form-control'])); ?>

                            <?php echo e(Form::label('allow_add_property_button', get_string('allow_add_property_button'))); ?>

                            <?php if($errors->has('allow_add_property_button')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('allow_add_property_button')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div id="home_settings" class="tab-pane">
                    <div class="col s12 mbot20">
                        <div class="input-group clearfix <?php echo e($errors->has('slider_background') ? 'has-error' : ''); ?>">
                            <label class="input-group-btn">
                                <span class="btn btn-primary waves-effect"><?php echo e(get_string('upload')); ?>

                                    <?php echo Form::file('files[slider_background]', ['class' => 'hidden']); ?>

                                </span>
                            </label>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <div class="field-info"><?php echo e(get_string('slider_background')); ?><?php echo e(get_setting('slider_background', 'design')); ?></div>
                    </div>
                    <div class="col l4 m4 s6">
                        <div class="form-group  <?php echo e($errors->has('show_featured_locations') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::select('show_featured_locations', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_featured_locations', 'design'), ['class' => 'form-control'])); ?>

                            <?php echo e(Form::label('show_featured_locations', get_string('show_featured_locations'))); ?>

                            <?php if($errors->has('show_featured_locations')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('show_featured_locations')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l4 m4 s6">
                        <div class="form-group  <?php echo e($errors->has('show_featured_properties') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::select('show_featured_properties', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_featured_properties', 'design'), ['class' => 'form-control'])); ?>

                            <?php echo e(Form::label('show_featured_properties', get_string('show_featured_properties'))); ?>

                            <?php if($errors->has('show_featured_properties')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('show_featured_properties')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l4 m4 s6">
                        <div class="form-group  <?php echo e($errors->has('show_quick_boxes') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::select('show_quick_boxes', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_quick_boxes', 'design'), ['class' => 'form-control'])); ?>

                            <?php echo e(Form::label('show_quick_boxes', get_string('show_quick_boxes'))); ?>

                            <?php if($errors->has('show_quick_boxes')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('show_quick_boxes')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col l4 m4 s6">
                        <div class="form-group  <?php echo e($errors->has('show_blog_section') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::select('show_blog_section', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_blog_section', 'design'), ['class' => 'form-control'])); ?>

                            <?php echo e(Form::label('show_blog_section', get_string('show_blog_section'))); ?>

                            <?php if($errors->has('show_blog_section')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('show_blog_section')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- <div class="col l4 m4 s6">
                        <div class="form-group  <?php echo e($errors->has('show_icons_section') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::select('show_icons_section', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('show_icons_section', 'design'), ['class' => 'form-control'])); ?>

                            <?php echo e(Form::label('show_icons_section', get_string('show_icons_section'))); ?>

                            <?php if($errors->has('show_icons_section')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('show_icons_section')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div> -->
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header">
                                <span><?php echo e(get_string('featured_properties_section')); ?></span>
                                <i class="material-icons small accordion-active">remove_circle</i>
                                <i class="material-icons small accordion-disabled">add_circle</i>
                                <i class="material-icons small color-red hidden">report_problem</i>
                            </div>
                            <div class="collapsible-body">
                                <?php if(get_setting('show_featured_properties', 'design')): ?>
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="col m6 s12">
                                                <div class="form-group  <?php echo e($errors->has('fp_properties_count') ? 'has-error' : ''); ?>">
                                                    <?php echo e(Form::text('fp_properties_count', get_setting('fp_properties_count', 'design'), ['class' => 'form-control', 'placeholder' => get_string('fp_properties_count')])); ?>

                                                    <?php echo e(Form::label('fp_properties_count', get_string('fp_properties_count'))); ?>

                                                    <?php if($errors->has('fp_properties_count')): ?>
                                                        <span class="wrong-error">* <?php echo e($errors->first('fp_properties_count')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col m6 s12">
                                                <div class="form-group  <?php echo e($errors->has('fp_show_featured_only') ? 'has-error' : ''); ?>">
                                                    <?php echo e(Form::select('fp_show_featured_only', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('fp_show_featured_only', 'design'), ['class' => 'form-control'])); ?>

                                                    <?php echo e(Form::label('fp_show_featured_only', get_string('fp_show_featured_only'))); ?>

                                                    <?php if($errors->has('fp_show_featured_only')): ?>
                                                        <span class="wrong-error">* <?php echo e($errors->first('fp_show_featured_only')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <span><?php echo e(get_string('enable_this_section_first')); ?></span>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">
                                <span><?php echo e(get_string('quick_boxes_section')); ?></span>
                                <i class="material-icons small accordion-active">remove_circle</i>
                                <i class="material-icons small accordion-disabled">add_circle</i>
                                <i class="material-icons small color-red hidden">report_problem</i>
                            </div>
                            <div class="collapsible-body">
                                <?php if(get_setting('show_quick_boxes', 'design')): ?>
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="col s12 mbot20">
                                                <div class="input-group clearfix <?php echo e($errors->has('qs_background') ? 'has-error' : ''); ?>">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-primary waves-effect"><?php echo e(get_string('upload')); ?>

                                                            <?php echo Form::file('files[qs_background]', ['class' => 'hidden']); ?>

                                                        </span>
                                                    </label>
                                                    <input type="text" class="form-control" readonly>
                                                </div>
                                                <div class="field-info"><?php echo e(get_string('qs_background')); ?><?php echo e(get_setting('qs_background', 'design')); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <span><?php echo e(get_string('enable_this_section_first')); ?></span>
                                <?php endif; ?>
                            </div>
                        </li>
                        <!-- <li>
                            <div class="collapsible-header">
                                <span><?php echo e(get_string('icons_section')); ?></span>
                                <i class="material-icons small accordion-active">remove_circle</i>
                                <i class="material-icons small accordion-disabled">add_circle</i>
                                <i class="material-icons small color-red hidden">report_problem</i>
                            </div>
                            <div class="collapsible-body">
                                <?php if(get_setting('show_icons_section', 'design')): ?>
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="card-panel">
                                                <span class="primary-color">*<?php echo e(get_string('note_for_is')); ?></span>
                                            </div>
                                        </div>
                                        <div class="col m6 s12">
                                            <div class="form-group  <?php echo e($errors->has('is_icon1_head') ? 'has-error' : ''); ?>">
                                                <?php echo e(Form::text('is_icon1_head', get_setting('is_icon1_head', 'design'), ['class' => 'form-control', 'placeholder' => '1 '.get_string('is_icon_head')])); ?>

                                                <?php echo e(Form::label('is_icon1_head', '1 '.get_string('is_icon_head'))); ?>

                                                <?php if($errors->has('is_icon1_head')): ?>
                                                    <span class="wrong-error">* <?php echo e($errors->first('is_icon1_head')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group  <?php echo e($errors->has('is_icon1_text') ? 'has-error' : ''); ?>">
                                                <?php echo e(Form::text('is_icon1_text', get_setting('is_icon1_text', 'design'), ['class' => 'form-control', 'placeholder' => '1 '.get_string('is_icon_text')])); ?>

                                                <?php echo e(Form::label('is_icon1_text', '1 '.get_string('is_icon_text'))); ?>

                                                <?php if($errors->has('is_icon1_text')): ?>
                                                    <span class="wrong-error">* <?php echo e($errors->first('is_icon1_text')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group  <?php echo e($errors->has('is_icon1_icon') ? 'has-error' : ''); ?>">
                                                <?php echo e(Form::text('is_icon1_icon', get_setting('is_icon1_icon', 'design'), ['class' => 'form-control', 'placeholder' => '1 '.get_string('is_icon_icon')])); ?>

                                                <?php echo e(Form::label('is_icon1_icon', '1 '.get_string('is_icon_icon'))); ?>

                                                <?php if($errors->has('is_icon1_icon')): ?>
                                                    <span class="wrong-error">* <?php echo e($errors->first('is_icon1_icon')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col m6 s12">
                                            <div class="form-group  <?php echo e($errors->has('is_icon2_head') ? 'has-error' : ''); ?>">
                                                <?php echo e(Form::text('is_icon2_head', get_setting('is_icon2_head', 'design'), ['class' => 'form-control', 'placeholder' => '2 '.get_string('is_icon_head')])); ?>

                                                <?php echo e(Form::label('is_icon2_head', '2 '.get_string('is_icon_head'))); ?>

                                                <?php if($errors->has('is_icon2_head')): ?>
                                                    <span class="wrong-error">* <?php echo e($errors->first('is_icon2_head')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group  <?php echo e($errors->has('is_icon2_text') ? 'has-error' : ''); ?>">
                                                <?php echo e(Form::text('is_icon2_text', get_setting('is_icon2_text', 'design'), ['class' => 'form-control', 'placeholder' => '2 '.get_string('is_icon_text')])); ?>

                                                <?php echo e(Form::label('is_icon2_text', '2 '.get_string('is_icon_text'))); ?>

                                                <?php if($errors->has('is_icon2_text')): ?>
                                                    <span class="wrong-error">* <?php echo e($errors->first('is_icon2_text')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group  <?php echo e($errors->has('is_icon2_icon') ? 'has-error' : ''); ?>">
                                                <?php echo e(Form::text('is_icon2_icon', get_setting('is_icon2_icon', 'design'), ['class' => 'form-control', 'placeholder' => '2 '.get_string('is_icon_icon')])); ?>

                                                <?php echo e(Form::label('is_icon2_icon', '2 '.get_string('is_icon_icon'))); ?>

                                                <?php if($errors->has('is_icon2_icon')): ?>
                                                    <span class="wrong-error">* <?php echo e($errors->first('is_icon2_icon')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col m6 s12 mtop20">
                                            <div class="form-group  <?php echo e($errors->has('is_icon3_head') ? 'has-error' : ''); ?>">
                                                <?php echo e(Form::text('is_icon3_head', get_setting('is_icon3_head', 'design'), ['class' => 'form-control', 'placeholder' => '3 '.get_string('is_icon_head')])); ?>

                                                <?php echo e(Form::label('is_icon3_head', '3 '.get_string('is_icon_head'))); ?>

                                                <?php if($errors->has('is_icon3_head')): ?>
                                                    <span class="wrong-error">* <?php echo e($errors->first('is_icon3_head')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group  <?php echo e($errors->has('is_icon3_text') ? 'has-error' : ''); ?>">
                                                <?php echo e(Form::text('is_icon3_text', get_setting('is_icon3_text', 'design'), ['class' => 'form-control', 'placeholder' => '3 '.get_string('is_icon_text')])); ?>

                                                <?php echo e(Form::label('is_icon3_text', '3 '.get_string('is_icon_text'))); ?>

                                                <?php if($errors->has('is_icon3_text')): ?>
                                                    <span class="wrong-error">* <?php echo e($errors->first('is_icon3_text')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group  <?php echo e($errors->has('is_icon3_icon') ? 'has-error' : ''); ?>">
                                                <?php echo e(Form::text('is_icon3_icon', get_setting('is_icon3_icon', 'design'), ['class' => 'form-control', 'placeholder' => '3 '.get_string('is_icon_icon')])); ?>

                                                <?php echo e(Form::label('is_icon3_icon', '3 '.get_string('is_icon_icon'))); ?>

                                                <?php if($errors->has('is_icon3_icon')): ?>
                                                    <span class="wrong-error">* <?php echo e($errors->first('is_icon3_icon')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <span><?php echo e(get_string('enable_this_section_first')); ?></span>
                                <?php endif; ?>
                            </div>
                        </li> -->
                    </ul>
                </div>
                <div id="strings" class="tab-pane">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <li class="tab <?php echo e($language->default ? 'active' : ''); ?>"><a href="#lang<?php echo e($language->id); ?>" data-toggle="tab"><img src="<?php echo e($language->flag); ?>"/><span><?php echo e($language->language); ?></span></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <div id="lang<?php echo e($language->id); ?>" class="tab-pane <?php echo e($language->default ? 'active' : ''); ?>">
                                    <div class="col m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('welcome_text') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_site_description][' . $language->code .']' , get_opt_string('opt_site_description', $language->code), ['class' => 'form-control', 'placeholder' => get_string('site_description')])); ?>

                                            <?php echo e(Form::label('opt_site_description', get_string('site_description'))); ?>

                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('welcome_text') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_welcome_text][' . $language->code .']' , get_opt_string('opt_welcome_text', $language->code), ['class' => 'form-control', 'placeholder' => get_string('welcome_text')])); ?>

                                            <?php echo e(Form::label('welcome_text', get_string('welcome_text'))); ?>

                                        </div>
                                    </div>
                                    <div class="col l6 m6 s12 clearfix">
                                        <div class="form-group  <?php echo e($errors->has('slider_heading') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_slider_heading][' . $language->code .']', get_opt_string('opt_slider_heading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('slider_heading')])); ?>

                                            <?php echo e(Form::label('slider_heading', get_string('slider_heading'))); ?>

                                            <?php if($errors->has('slider_heading')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('slider_heading')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col l6 m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('slider_subheading') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_slider_subheading][' . $language->code .']', get_opt_string('opt_slider_subheading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('slider_subheading')])); ?>

                                            <?php echo e(Form::label('slider_subheading', get_string('slider_subheading'))); ?>

                                            <?php if($errors->has('slider_subheading')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('slider_subheading')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12 clearfix">
                                        <div class="form-group  <?php echo e($errors->has('fl_heading') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_fl_heading][' . $language->code .']', get_opt_string('opt_fl_heading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('fl_heading')])); ?>

                                            <?php echo e(Form::label('strings[opt_fl_heading', get_string('fl_heading'))); ?>

                                            <?php if($errors->has('fl_heading')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('fl_heading')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('fl_subheading') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_fl_subheading][' . $language->code .']', get_opt_string('opt_fl_subheading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('fl_subheading')])); ?>

                                            <?php echo e(Form::label('strings[opt_fl_subheading', get_string('fl_subheading'))); ?>

                                            <?php if($errors->has('fl_subheading')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('fl_subheading')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12 clearfix">
                                        <div class="form-group  <?php echo e($errors->has('fp_heading') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_fp_heading][' . $language->code .']', get_opt_string('opt_fp_heading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('fp_heading')])); ?>

                                            <?php echo e(Form::label('strings[opt_fp_heading][' . $language->code .']', get_string('fp_heading'))); ?>

                                            <?php if($errors->has('fp_heading')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('fp_heading')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('fp_subheading') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_fp_subheading][' . $language->code .']', get_opt_string('opt_fp_subheading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('fp_subheading')])); ?>

                                            <?php echo e(Form::label('strings[opt_fp_subheading][' . $language->code .']', get_string('fp_subheading'))); ?>

                                            <?php if($errors->has('fp_subheading')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('fp_subheading')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12 clearfix">
                                        <div class="form-group  <?php echo e($errors->has('qs_heading') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_qs_heading][' . $language->code .']', get_opt_string('opt_qs_heading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('qs_heading')])); ?>

                                            <?php echo e(Form::label('strings[opt_qs_heading][' . $language->code .']', get_string('qs_heading'))); ?>

                                            <?php if($errors->has('qs_heading')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('qs_heading')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('qs_subheading') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_qs_subheading][' . $language->code .']', get_opt_string('opt_qs_subheading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('qs_subheading')])); ?>

                                            <?php echo e(Form::label('strings[opt_qs_subheading][' . $language->code .']', get_string('qs_subheading'))); ?>

                                            <?php if($errors->has('qs_subheading')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('qs_subheading')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12 clearfix">
                                        <div class="form-group  <?php echo e($errors->has('qs_box1_head') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_qs_box1_head][' . $language->code .']', get_opt_string('opt_qs_box1_head', $language->code), ['class' => 'form-control', 'placeholder' => '1 '.get_string('qs_box_head')])); ?>

                                            <?php echo e(Form::label('strings[opt_qs_box1_head][' . $language->code .']', '1 '.get_string('qs_box_head'))); ?>

                                            <?php if($errors->has('qs_box1_head')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('qs_box1_head')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('qs_box1_sub') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_qs_box1_sub][' . $language->code .']', get_opt_string('opt_qs_box1_sub', $language->code), ['class' => 'form-control', 'placeholder' => '1 '.get_string('qs_box_sub')])); ?>

                                            <?php echo e(Form::label('strings[opt_qs_box1_sub][' . $language->code .']', '1 '.get_string('qs_box_sub'))); ?>

                                            <?php if($errors->has('qs_box1_sub')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('qs_box1_sub')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('qs_box1_text') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_qs_box1_text][' . $language->code .']', get_opt_string('opt_qs_box1_text', $language->code), ['class' => 'form-control', 'placeholder' => '1 '.get_string('qs_box_text')])); ?>

                                            <?php echo e(Form::label('strings[opt_qs_box1_text][' . $language->code .']', '1 '.get_string('qs_box_text'))); ?>

                                            <?php if($errors->has('qs_box1_text')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('qs_box1_text')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('qs_box1_head') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_qs_box2_head][' . $language->code .']', get_opt_string('opt_qs_box2_head', $language->code), ['class' => 'form-control', 'placeholder' => '2 '.get_string('qs_box_head')])); ?>

                                            <?php echo e(Form::label('strings[opt_qs_box2_head][' . $language->code .']', '2 '.get_string('qs_box_head'))); ?>

                                            <?php if($errors->has('qs_box1_head')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('qs_box1_head')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('qs_box1_sub') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_qs_box2_sub][' . $language->code .']', get_opt_string('opt_qs_box2_sub', $language->code), ['class' => 'form-control', 'placeholder' => '2 '.get_string('qs_box_sub')])); ?>

                                            <?php echo e(Form::label('strings[opt_qs_box2_sub][' . $language->code .']', '2 '.get_string('qs_box_sub'))); ?>

                                            <?php if($errors->has('qs_box1_sub')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('qs_box1_sub')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('qs_box1_text') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_qs_box2_text][' . $language->code .']', get_opt_string('opt_qs_box2_text', $language->code), ['class' => 'form-control', 'placeholder' => '2 '.get_string('qs_box_text')])); ?>

                                            <?php echo e(Form::label('strings[opt_qs_box2_text][' . $language->code .']', '2 '.get_string('qs_box_text'))); ?>

                                            <?php if($errors->has('qs_box1_text')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('qs_box1_text')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('qs_box1_head') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_qs_box3_head][' . $language->code .']', get_opt_string('opt_qs_box3_head', $language->code), ['class' => 'form-control', 'placeholder' => '3 '.get_string('qs_box_head')])); ?>

                                            <?php echo e(Form::label('strings[opt_qs_box3_head][' . $language->code .']', '3 '.get_string('qs_box_head'))); ?>

                                            <?php if($errors->has('qs_box1_head')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('qs_box1_head')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('qs_box1_sub') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_qs_box3_sub][' . $language->code .']', get_opt_string('opt_qs_box3_sub', $language->code), ['class' => 'form-control', 'placeholder' => '3 '.get_string('qs_box_sub')])); ?>

                                            <?php echo e(Form::label('strings[opt_qs_box3_sub][' . $language->code .']', '3 '.get_string('qs_box_sub'))); ?>

                                            <?php if($errors->has('qs_box1_sub')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('qs_box1_sub')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('qs_box1_text') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_qs_box3_text][' . $language->code .']', get_opt_string('opt_qs_box3_text', $language->code), ['class' => 'form-control', 'placeholder' => '3 '.get_string('qs_box_text')])); ?>

                                            <?php echo e(Form::label('strings[opt_qs_box3_text][' . $language->code .']', '3 '.get_string('qs_box_text'))); ?>

                                            <?php if($errors->has('qs_box1_text')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('qs_box1_text')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12 clearfix">
                                        <div class="form-group  <?php echo e($errors->has('lb_heading') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_lb_heading][' . $language->code .']', get_opt_string('opt_lb_heading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('lb_heading')])); ?>

                                            <?php echo e(Form::label('strings[opt_lb_heading][' . $language->code .']', get_string('lb_heading'))); ?>

                                            <?php if($errors->has('lb_heading')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('lb_heading')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <div class="form-group  <?php echo e($errors->has('lb_subheading') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_lb_subheading][' . $language->code .']', get_opt_string('opt_lb_subheading', $language->code), ['class' => 'form-control', 'placeholder' => get_string('lb_subheading')])); ?>

                                            <?php echo e(Form::label('strings[opt_lb_subheading][' . $language->code .']', get_string('lb_subheading'))); ?>

                                            <?php if($errors->has('lb_subheading')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('lb_subheading')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12 clearfix">
                                        <h5 class="section-title"><?php echo e('2 '.get_string('footer_menu')); ?></h5>
                                        <div class="form-group  <?php echo e($errors->has('footer_menu1_head') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_footer_menu1_head][' . $language->code .']', get_opt_string('opt_footer_menu1_head', $language->code), ['class' => 'form-control', 'placeholder' => '1 '.get_string('footer_menu_head')])); ?>

                                            <?php echo e(Form::label('footer_menu1_head', '2 '.get_string('footer_menu_head'))); ?>

                                            <?php if($errors->has('footer_menu1_head')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu1_head')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group  <?php echo e($errors->has('footer_menu_text1') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_footer_menu1_text1][' . $language->code .']', get_opt_string('opt_footer_menu1_text1', $language->code), ['class' => 'form-control', 'placeholder' => '1 '.get_string('text')])); ?>

                                            <?php echo e(Form::label('footer_menu1_text1', '1 '.get_string('text'))); ?>

                                            <?php if($errors->has('footer_menu1_text1')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu1_text1')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group  <?php echo e($errors->has('footer_menu_text1') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_footer_menu1_text2][' . $language->code .']', get_opt_string('opt_footer_menu1_text2', $language->code), ['class' => 'form-control', 'placeholder' => '2 '.get_string('text')])); ?>

                                            <?php echo e(Form::label('footer_menu1_text1', '2 '.get_string('text'))); ?>

                                            <?php if($errors->has('footer_menu1_text1')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu1_text1')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group  <?php echo e($errors->has('footer_menu_text1') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_footer_menu1_text3][' . $language->code .']', get_opt_string('opt_footer_menu1_text3', $language->code), ['class' => 'form-control', 'placeholder' => '3 '.get_string('text')])); ?>

                                            <?php echo e(Form::label('footer_menu1_text1', '3 '.get_string('text'))); ?>

                                            <?php if($errors->has('footer_menu1_text1')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu1_text1')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group  <?php echo e($errors->has('footer_menu_text1') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_footer_menu1_text4][' . $language->code .']', get_opt_string('opt_footer_menu1_text4', $language->code), ['class' => 'form-control', 'placeholder' => '4 '.get_string('text')])); ?>

                                            <?php echo e(Form::label('footer_menu1_text1', '4 '.get_string('text'))); ?>

                                            <?php if($errors->has('footer_menu1_text1')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu1_text1')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group  <?php echo e($errors->has('footer_menu_text1') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_footer_menu1_text5][' . $language->code .']', get_opt_string('opt_footer_menu1_text5', $language->code), ['class' => 'form-control', 'placeholder' => '5 '.get_string('text')])); ?>

                                            <?php echo e(Form::label('footer_menu1_text1', '5 '.get_string('text'))); ?>

                                            <?php if($errors->has('footer_menu1_text1')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu1_text1')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <h5 class="section-title"><?php echo e('3 '.get_string('footer_menu')); ?></h5>
                                        <div class="form-group  <?php echo e($errors->has('footer_menu1_head') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_footer_menu2_head][' . $language->code .']', get_opt_string('opt_footer_menu2_head', $language->code), ['class' => 'form-control', 'placeholder' => '2 '.get_string('footer_menu_head')])); ?>

                                            <?php echo e(Form::label('footer_menu1_head', '3 '.get_string('footer_menu_head'))); ?>

                                            <?php if($errors->has('footer_menu1_head')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu1_head')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group  <?php echo e($errors->has('footer_menu_text1') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_footer_menu2_text1][' . $language->code .']', get_opt_string('opt_footer_menu2_text1', $language->code), ['class' => 'form-control', 'placeholder' => '1 '.get_string('text')])); ?>

                                            <?php echo e(Form::label('footer_menu2_text1', '1 '.get_string('text'))); ?>

                                            <?php if($errors->has('footer_menu2_text1')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu2_text1')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group  <?php echo e($errors->has('footer_menu_text1') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_footer_menu2_text2][' . $language->code .']', get_opt_string('opt_footer_menu2_text2', $language->code), ['class' => 'form-control', 'placeholder' => '2 '.get_string('text')])); ?>

                                            <?php echo e(Form::label('footer_menu2_text1', '2 '.get_string('text'))); ?>

                                            <?php if($errors->has('footer_menu2_text1')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu2_text1')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group  <?php echo e($errors->has('footer_menu_text1') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_footer_menu2_text3][' . $language->code .']', get_opt_string('opt_footer_menu2_text3', $language->code), ['class' => 'form-control', 'placeholder' => '3 '.get_string('text')])); ?>

                                            <?php echo e(Form::label('footer_menu2_text1', '3 '.get_string('text'))); ?>

                                            <?php if($errors->has('footer_menu2_text1')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu2_text1')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group  <?php echo e($errors->has('footer_menu_text1') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_footer_menu2_text4][' . $language->code .']', get_opt_string('opt_footer_menu2_text4', $language->code), ['class' => 'form-control', 'placeholder' => '4 '.get_string('text')])); ?>

                                            <?php echo e(Form::label('footer_menu2_text1', '4 '.get_string('text'))); ?>

                                            <?php if($errors->has('footer_menu2_text1')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu2_text1')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group  <?php echo e($errors->has('footer_menu_text1') ? 'has-error' : ''); ?>">
                                            <?php echo e(Form::text('strings[opt_footer_menu2_text5][' . $language->code .']', get_opt_string('opt_footer_menu2_text5', $language->code), ['class' => 'form-control', 'placeholder' => '5 '.get_string('text')])); ?>

                                            <?php echo e(Form::label('footer_menu2_text1', '5 '.get_string('text'))); ?>

                                            <?php if($errors->has('footer_menu2_text1')): ?>
                                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu2_text1')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </div>
                    </div>
                </div>
                <div id="footer_settings" class="tab-pane">
                    <div class="col m6 s12">
                        <div class="form-group  <?php echo e($errors->has('footer_social') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::select('footer_social', ['0' => get_string('no'), '1' => get_string('yes')], get_setting('footer_social', 'design'), ['class' => 'form-control'])); ?>

                            <?php echo e(Form::label('footer_social', get_string('footer_social'))); ?>

                            <?php if($errors->has('footer_social')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('footer_social')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col m6 s12 mtop20 clearfix">
                        <h5 class="section-title"><?php echo e('2 '.get_string('footer_menu')); ?></h5>
                        <div class="form-group  <?php echo e($errors->has('footer_menu_link1') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('footer_menu1_link1', get_setting('footer_menu1_link1', 'design'), ['class' => 'form-control', 'placeholder' => '1 '.get_string('link')])); ?>

                            <?php echo e(Form::label('footer_menu1_link1', '1 '.get_string('link'))); ?>

                            <?php if($errors->has('footer_menu1_link1')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu1_link')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group  <?php echo e($errors->has('footer_menu_link2') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('footer_menu1_link2', get_setting('footer_menu1_link2', 'design'), ['class' => 'form-control', 'placeholder' => '2 '.get_string('link')])); ?>

                            <?php echo e(Form::label('footer_menu1_link2', '2 '.get_string('link'))); ?>

                            <?php if($errors->has('footer_menu1_link2')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu1_link2')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group  <?php echo e($errors->has('footer_menu_link3') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('footer_menu1_link3', get_setting('footer_menu1_link3', 'design'), ['class' => 'form-control', 'placeholder' => '3 '.get_string('link')])); ?>

                            <?php echo e(Form::label('footer_menu1_link3', '3 '.get_string('link'))); ?>

                            <?php if($errors->has('footer_menu1_link3')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu1_link3')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group  <?php echo e($errors->has('footer_menu_link4') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('footer_menu1_link4', get_setting('footer_menu1_link4', 'design'), ['class' => 'form-control', 'placeholder' => '4 '.get_string('link')])); ?>

                            <?php echo e(Form::label('footer_menu1_link4', '4 '.get_string('link'))); ?>

                            <?php if($errors->has('footer_menu1_link4')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu1_link4')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group  <?php echo e($errors->has('footer_menu_link5') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('footer_menu1_link5', get_setting('footer_menu1_link5', 'design'), ['class' => 'form-control', 'placeholder' => '5 '.get_string('link')])); ?>

                            <?php echo e(Form::label('footer_menu1_link5', '5 '.get_string('link'))); ?>

                            <?php if($errors->has('footer_menu1_link5')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu1_link5')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col m6 s12 mtop20">
                        <h5 class="section-title"><?php echo e('3 '.get_string('footer_menu')); ?></h5>
                        <div class="form-group  <?php echo e($errors->has('footer_menu_link1') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('footer_menu2_link1', get_setting('footer_menu2_link1', 'design'), ['class' => 'form-control', 'placeholder' => '1 '.get_string('link')])); ?>

                            <?php echo e(Form::label('footer_menu2_link1', '1 '.get_string('link'))); ?>

                            <?php if($errors->has('footer_menu2_link1')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu2_link')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group  <?php echo e($errors->has('footer_menu_link2') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('footer_menu2_link2', get_setting('footer_menu2_link2', 'design'), ['class' => 'form-control', 'placeholder' => '2 '.get_string('link')])); ?>

                            <?php echo e(Form::label('footer_menu2_link2', '2 '.get_string('link'))); ?>

                            <?php if($errors->has('footer_menu2_link2')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu2_link2')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group  <?php echo e($errors->has('footer_menu_link3') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('footer_menu2_link3', get_setting('footer_menu2_link3', 'design'), ['class' => 'form-control', 'placeholder' => '3 '.get_string('link')])); ?>

                            <?php echo e(Form::label('footer_menu2_link3', '3 '.get_string('link'))); ?>

                            <?php if($errors->has('footer_menu2_link3')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu2_link3')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group  <?php echo e($errors->has('footer_menu_link4') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('footer_menu2_link4', get_setting('footer_menu2_link4', 'design'), ['class' => 'form-control', 'placeholder' => '4 '.get_string('link')])); ?>

                            <?php echo e(Form::label('footer_menu2_link4', '4 '.get_string('link'))); ?>

                            <?php if($errors->has('footer_menu2_link4')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu2_link4')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group  <?php echo e($errors->has('footer_menu_link5') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('footer_menu2_link5', get_setting('footer_menu2_link5', 'design'), ['class' => 'form-control', 'placeholder' => '5 '.get_string('link')])); ?>

                            <?php echo e(Form::label('footer_menu2_link5', '5 '.get_string('link'))); ?>

                            <?php if($errors->has('footer_menu2_link5')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('footer_menu2_link5')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                </div>
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