
<?php $max_price = get_setting('price_range_max', 'property') ?>
<?php $__env->startSection('title'); ?>
    <title><?php echo e($static_data['strings']['category'] . ' - ' . $category->contentload->name); ?></title>
    <meta name="title" content="<?php echo e($static_data['strings']['category'] . ' - ' . $category->contentload->name); ?>">
    <meta name="description" content="<?php echo e(strip_tags($category->contentload->description)); ?>">
    <meta name="keywords" content="<?php echo e($static_data['site_settings']['site_keywords']); ?>">
    <meta name="author" content="<?php echo e($static_data['site_settings']['site_name']); ?>">
    <meta property="og:title" content="<?php echo e($static_data['strings']['category'] . ' - ' . $category->contentload->name); ?>" />
    <meta property="og:image" content="<?php echo e(URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?>" />
    <meta property="og:description" content="<?php echo e(strip_tags($category->contentload->description)); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/plugins/nouislider.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/plugins/jquery-ui.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bg'); ?>
    <?php if($category->featured_image): ?>
        <?php echo e($category->featured_image); ?>

    <?php else: ?>
        <?php echo e(URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row header-tabs">
        <div class="col-sm-12">
            <ul class="nav nav-tabs" id="header-tabs">
                <?php if(isset($properties) && count($properties)): ?><li class="nav-item"><a class="nav-link active" href="#accordion-properties" data-toggle="tab" aria-expanded="true"><i class="fa fa-building-o"></i><span><?php echo e($static_data['strings']['properties']); ?></span></a></li><?php endif; ?>
                <?php if(isset($services) && count($services)): ?><li class="nav-item"><a class="nav-link <?php if(!count($properties)): ?> active <?php endif; ?>" href="#accordion-services" data-toggle="tab" aria-expanded="false"><i class="fa fa-cutlery"></i><span><?php echo e($static_data['strings']['services']); ?></span></a></li><?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="row marginalized">
        <div class="col-sm-12">
            <h1 class="section-title-dark"><?php echo e($static_data['strings']['category'] . ' - ' . $category->contentload->name); ?></h1>
            <div class="tab-content">
                <div class="tab-pane active" id="accordion-properties" role="tabpanel">
                    <div class="row">
                        <?php if(count($properties)): ?>
                            <div class="col-sm-12">
                                <h3 class="section-type text-uppercase"><?php echo e($static_data['strings']['properties']); ?></h3>
                            </div>
                            <div class="col-sm-12 filter-box">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="fa fa-map-marker input-group-addon"></span>
                                        <input type="text" readonly name="location_id_value" class="form-control filter-field" placeholder="<?php echo e($static_data['strings']['choose_your_location']); ?>">
                                    </div>
                                    <input type="hidden" name="location_id" value="0" class="form-control filter-hidden hidden" placeholder="<?php echo e($static_data['strings']['choose_your_location']); ?>">
                                    <ul class="dropdown-filter-menu">
                                        <li data-id="" data-name="<?php echo e($static_data['strings']['all']); ?>">
                                            <a href="#" class="location_id_picker">
                                                <span><?php echo e($static_data['strings']['all']); ?></span>
                                            </a>
                                        </li>
                                        <?php $__currentLoopData = $static_data['locations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <li data-id="<?php echo e($location->id); ?>" data-name="<?php echo e($location->contentload->location); ?>">
                                                <a href="#" class="location_id_picker">
                                                    <span><?php echo e($location->contentload->location); ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="fa fa-user-o input-group-addon"></span>
                                        <input type="text" readonly name="guest_number_value" value="" class="form-control filter-field" placeholder="<?php echo e($static_data['strings']['guests_number']); ?>">
                                    </div>
                                    <input type="hidden" name="guest_number" value="0" class="form-control filter-hidden hidden" placeholder="<?php echo e($static_data['strings']['choose_your_category']); ?>">
                                    <ul class="dropdown-filter-menu">
                                        <?php for($i = 1; $i <= get_setting('guest_number_max','property'); $i++): ?>
                                            <li data-number="<?php echo e($i); ?>">
                                                <a href="#" class="guest_number_picker">
                                                    <span><?php echo e($i); ?></span>
                                                </a>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="fa fa-building-o input-group-addon"></span>
                                        <input type="text" readonly name="rooms_value" class="form-control filter-field" placeholder="<?php echo e($static_data['strings']['rooms_number']); ?>">
                                    </div>
                                    <input type="hidden" name="rooms" value="0" class="form-control filter-hidden hidden" placeholder="<?php echo e($static_data['strings']['choose_your_category']); ?>">
                                    <ul class="dropdown-filter-menu">
                                        <?php for($i = 1; $i <= get_setting('rooms_number_max','property'); $i++): ?>
                                            <li data-number="<?php echo e($i); ?>">
                                                <a href="#" class="room_number_picker">
                                                    <span><?php echo e($i); ?></span>
                                                </a>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="fa fa-sort input-group-addon"></span>
                                        <input type="text" readonly name="sort_id_value" class="form-control filter-field" placeholder="<?php echo e($static_data['strings']['sort_results']); ?>">
                                    </div>
                                    <input type="hidden" name="sort_id" value="0" class="form-control filter-hidden hidden" placeholder="<?php echo e($static_data['strings']['sort_results']); ?>">
                                    <ul class="dropdown-filter-menu">
                                        <li data-id="0" data-name="<?php echo e($static_data['strings']['default']); ?>">
                                            <a href="#" class="sort_id_picker">
                                                <span><?php echo e($static_data['strings']['default']); ?></span>
                                            </a>
                                        </li>
                                        <li data-id="1" data-name="<?php echo e($static_data['strings']['price_asc']); ?>">
                                            <a href="#" class="sort_id_picker">
                                                <span><?php echo e($static_data['strings']['price_asc']); ?></span>
                                            </a>
                                        </li>
                                        <li data-id="2" data-name="<?php echo e($static_data['strings']['price_desc']); ?>">
                                            <a href="#" class="sort_id_picker">
                                                <span><?php echo e($static_data['strings']['price_desc']); ?></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="form-group not-after">
                                    <div class="input-group">
                                        <span class="fa fa-calendar input-group-addon"></span>
                                        <input type="text" name="start_date" class="form-control start_date-picker filter-field" placeholder="<?php echo e($static_data['strings']['checking_in']); ?>">
                                    </div>
                                </div>
                                <div class="form-group not-after">
                                    <div class="input-group">
                                        <span class="fa fa-calendar input-group-addon"></span>
                                        <input type="text" disabled name="end_date" class="form-control end_date-picker filter-field" placeholder="<?php echo e($static_data['strings']['checking_out']); ?>">
                                    </div>                                </div>
                                <div class="form-group not-after price-range">
                                    <p><?php echo e($static_data['strings']['price_range']); ?>: <span class="min">0</span> -  <span class="max"><?php echo e(get_setting('price_range_max', 'property')); ?></span><?php echo e(userCurrencySymbol()); ?></p>
                                    <input type="hidden" value="0" class="hidden" name="price_min"/>
                                    <input type="hidden" value="0" class="hidden" name="price_max"/>
                                    <div id="price-range"></div>
                                </div>
                                <a href="#" class="primary-button property-filter"><?php echo e($static_data['strings']['search']); ?></a>
                                <?php if(get_setting('filter_by_features', 'property')): ?>
                                <div class="clearfix"></div>
                                    <a href="#" class="more-options"><?php echo e($static_data['strings']['more_options']); ?> <i class="fa fa-caret-down"></i></a>
                                    <div class="features-filter-box">
                                        <div class="row">
                                            <?php $__currentLoopData = $static_data['features']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <div class="col-md-3 col-sm-6 not-after">
                                                <input type="checkbox" name="features[]" value="<?php echo e($feature->id); ?>" class="form-control" id="<?php echo e($feature->id); ?>" />
                                                <label for="<?php echo e($feature->id); ?>"></label>
                                                <img src="<?php echo e($feature->icon); ?>" class="feature-icon"> <span class="checkbox-label"><?php echo e($feature->feature[$static_data['default_language']->id]); ?></span>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if(isset($featured_properties)): ?>
                                <div class="col-sm-12 featured-grid-properties items-grid">
                                    <?php $__currentLoopData = $featured_properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                        <?php echo $__env->make('home.partials.property_grid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </div>
                            <?php endif; ?>
                            <div id="filtered-properties" class="row">
                                <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    
                                    <?php echo $__env->make('home.partials.property', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </div>
                            <div class="col-sm-12 mtop5 text-centered"><a href="#" class="black-button load-more-properties"><?php echo e($static_data['strings']['load_more']); ?></a><img src="<?php echo e(URL::asset('assets/images/ajax-loader.gif')); ?>" class="ajax-loader"/></div>
                        <?php else: ?>
                            <?php if(!count($properties) && !count($services)): ?><div class="col-sm-12 text-centered"><strong class="center-align"><?php echo e($static_data['strings']['no_results']); ?></strong></div><?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if(get_setting('services_allowed', 'service')): ?>
                    <div class="tab-pane <?php if(!count($properties)): ?> active <?php endif; ?>" id="accordion-services" role="tabpanel">
                        <div class="row">
                            <?php if(isset($services) && count($services)): ?>
                                <div class="col-sm-12 mbot10"><h3 class="section-type text-uppercase"><?php echo e($static_data['strings']['services']); ?></h3></div>
                                <div class="col-sm-12 filter-box">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="fa fa-map-marker input-group-addon"></span>
                                            <input type="text" readonly name="location_id_value" class="form-control filter-field" placeholder="<?php echo e($static_data['strings']['choose_your_location']); ?>">
                                        </div>
                                        <input type="hidden" name="location_id" value="0" class="form-control filter-hidden hidden" placeholder="<?php echo e($static_data['strings']['choose_your_location']); ?>">
                                        <ul class="dropdown-filter-menu">
                                            <li data-id="" data-name="<?php echo e($static_data['strings']['all']); ?>">
                                                <a href="#" class="location_id_picker">
                                                    <span><?php echo e($static_data['strings']['all']); ?></span>
                                                </a>
                                            </li>
                                            <?php $__currentLoopData = $static_data['locations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <li data-id="<?php echo e($location->id); ?>" data-name="<?php echo e($location->contentload->location); ?>">
                                                    <a href="#" class="location_id_picker">
                                                        <span><?php echo e($location->contentload->location); ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </ul>
                                    </div>
                                    <a href="#" class="primary-button service-filter"><?php echo e($static_data['strings']['search']); ?></a>
                                </div>
                                <?php if(isset($featured_services)): ?>
                                    <div class="col-sm-12 featured-grid-services items-grid">
                                        <?php $__currentLoopData = $featured_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            
                                            <?php echo $__env->make('home.partials.service_grid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row" id="filtered-services">
                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                   
                                    <?php echo $__env->make('home.partials.service', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </div>
                            <div class="col-sm-12 mtop5 text-centered"><a href="#" class="black-button load-more-services"><?php echo e($static_data['strings']['load_more']); ?></a><img src="<?php echo e(URL::asset('assets/images/ajax-loader.gif')); ?>" class="ajax-loader"/></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <input type="hidden" class="hidden token" value="<?php echo e(csrf_token()); ?>"/>
    <input type="hidden" class="hidden category_id" value="<?php echo e($category->id); ?>"/>
    <input type="hidden" class="hidden" name="isExplore" value="0"/>
    <script src="<?php echo e(URL::asset('assets/js/plugins/nouislider.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/plugins/jquery-ui.min.js')); ?>"></script>
    <script type="text/javascript">
        $('document').ready(function(){

             $('.more-options').click(function(e){
                e.preventDefault();
                $('.features-filter-box').slideToggle();
            });
            
            // Load more properties
            var page_property = 3;
            $('.load-more-properties').click(function(e){
                var $this = $(this);
                var ajax_loader = $(this).parent().find('.ajax-loader');
                e.preventDefault();
                $.ajax({
                    url: '<?php echo e(url('category') .'/'. $category->id .'/properties?page='); ?>' + page_property,
                    beforeSend: function(){
                        $this.hide(); ajax_loader.show();
                    }
                }).done(function(data){
                    if(data){$this.show();$('#filtered-properties').append(data);}else{$('#filtered-properties').append('<div class="col-sm-12 info-message text-centered"><?php echo e($static_data['strings']['no_results']); ?></div>');setTimeout(function(){$('.info-message').slideUp()}, 2000);}
                    page_property++;
                    ajax_loader.hide();
                });
            });

            // Load more services
            var page_service = 3;
            $('.load-more-services').click(function(e){
                var $this = $(this);
                var ajax_loader = $(this).parent().find('.ajax-loader');
                e.preventDefault();
                $.ajax({
                    url: '<?php echo e(url('category') .'/'. $category->id .'/services?page='); ?>' + page_service,
                    beforeSend: function(){
                        $this.hide();
                        ajax_loader.show();
                    }
                }).done(function(data){
                    if(data){
                        $this.show();
                        $('#filtered-services').append(data);
                    }else{
                        $('#filtered-services').append('<div class="col-sm-12 info-message text-centered"><?php echo e($static_data['strings']['no_results']); ?></div>');
                        setTimeout(function(){$('.info-message').slideUp()}, 2000);
                    }
                    page_service++;
                    ajax_loader.hide();
                });
            });

            // Property Filter
            $('.property-filter').click(function(e){
                e.preventDefault();
                var parent = $(this).parent(),
                        rooms = $('[name="rooms"]').val(),
                        guest_number = $('[name="guest_number"]').val(),
                        price_min = $('[name="price_min"]').val(),
                        price_max = $('[name="price_max"]').val(),
                        token = $('.token').val(),
                        location_id = $('[name="location_id"]').val(),
                        category_id = $('[name="category_id"]').val(),
                        sort_id = $('[name="sort_id"]').val(),
                        start_date = $('[name="start_date"]').val(),
                        end_date = $('[name="end_date"]').val(),
                        features = [];
                $('[name^="features"]').each(function() {
                    if($(this).is(':checked')) features.push($(this).val());
                });
                $.ajax({
                    url: '<?php echo e(url('filter')); ?>/properties',
                    type: 'post',
                    data: {features: features, rooms: rooms, sort_id: sort_id, guest_number: guest_number, price_min: price_min, price_max: price_max, _token: token,location_id: location_id, category_id: category_id, start_date: start_date, end_date: end_date},
                    beforeSend: function(){
                        parent.addClass('loading');
                    }
                }).done(function(data){
                    parent.removeClass('loading');
                    $('.load-more-properties').hide();
                    if(data){$('#filtered-properties').html(data);}else{$('#filtered-properties').html('<div class="col-sm-12 info-message text-centered"><?php echo e($static_data['strings']['no_results']); ?></div>');}
                    var target = $('#filtered-properties');
                    $('html, body').animate({
                        scrollTop: target.offset().top - 150
                    }, 1000);
                });
            });

            // Datepickers
            $('.start_date-picker').datepicker({
                dateFormat: 'dd/mm/yy',
                minDate: 0,
                onSelect: function(dateText, inst) {
                    var startDate = $(this).datepicker('getDate');
                    if($('.end_date-picker').hasClass('hasDatePicker')){
                        $('.end_date-picker').datepicker('destroy');
                    }
                    startDate.setDate(startDate.getDate() + 1);
                    $("[name='start_date']").val(dateText);
                    $("[name='end_date']").removeAttr('disabled');
                    $('.end_date-picker').datepicker({
                        dateFormat: 'dd/mm/yy',
                        minDate: startDate,
                        onSelect: function(dateText, inst) {
                            $("[name='end_date']").val(dateText);
                        }
                    });
                }
            });

            // Service Filter
            $('.service-filter').click(function(e){
                e.preventDefault();
                var parent = $(this).parent(),
                        token = $('.token').val(),
                        location_id = $('[name="location_id"]').val(),
                        category_id = $('[name="category_id"]').val();
                $.ajax({
                    url: '<?php echo e(url('filter')); ?>/services',
                    type: 'post',
                    data: {_token: token, location_id: location_id, category_id: category_id},
                    beforeSend: function(){
                        parent.addClass('loading');
                    }
                }).done(function(data){
                    parent.removeClass('loading');
                    $('.load-more-services').hide();
                    if(data){$('#filtered-services').html(data);}else{$('#filtered-services').html('<div class="col-sm-12 info-message text-centered"><?php echo e($static_data['strings']['no_results']); ?></div>');}
                    var target = $('#filtered-services');
                    $('html, body').animate({
                        scrollTop: target.offset().top - 150
                    }, 1000);
                });
            });

            // Load price range
            price_range(<?php echo e($max_price); ?>);

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home_layout', ['static_data', $static_data], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>