
<?php $max_price = get_setting('price_range_max', 'property') ?>
<?php $__env->startSection('title'); ?>
    <title><?php echo e($static_data['strings']['explore'] .' - '. $static_data['strings']['services']); ?></title>
    <meta name="title" content="<?php echo e($static_data['strings']['explore'] .' - '. $static_data['strings']['services']); ?>">
    <meta name="description" content="<?php echo e($static_data['strings']['services']); ?>">
    <meta name="keywords" content="<?php echo e($static_data['site_settings']['site_keywords']); ?>">
    <meta name="author" content="<?php echo e($static_data['site_settings']['site_name']); ?>">
    <meta property="og:title" content="<?php echo e($static_data['strings']['explore'] .' - '. $static_data['strings']['services']); ?>" />
    <meta property="og:image" content="<?php echo e(URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/plugins/nouislider.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/plugins/jquery-ui.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(count($services)): ?>
        <div class="col-sm-12">
            <h3 class="section-type text-uppercase"><?php echo e($static_data['strings']['services']); ?></h3>
        </div>
        <div class="col-sm-12 filter-box">
            <div class="form-group">
                <div class="input-group">
                    <span class="fa fa-map-marker input-group-addon"></span>
                    <input type="text" readonly name="category_id_value" class="form-control filter-field" placeholder="<?php echo e($static_data['strings']['choose_your_category']); ?>">
                </div>
                <input type="hidden" name="category_id" value="0" class="form-control filter-hidden hidden" placeholder="<?php echo e($static_data['strings']['choose_your_category']); ?>">
                <ul class="dropdown-filter-menu">
                    <li data-id="" data-name="<?php echo e($static_data['strings']['all']); ?>">
                        <a href="#" class="category_id_picker">
                            <span><?php echo e($static_data['strings']['all']); ?></span>
                        </a>
                    </li>
                    <?php $__currentLoopData = $static_data['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <li data-id="<?php echo e($category->id); ?>" data-name="<?php echo e($category->contentload->name); ?>">
                            <a href="#" class="category_id_picker">
                                <span><?php echo e($category->contentload->name); ?></span>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </ul>
            </div>
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
            <a href="#" class="primary-button property-filter"><?php echo e($static_data['strings']['search']); ?></a>
        </div>
        <?php if(isset($featured_services)): ?>
            <div id="half-map-featured" class="col-sm-12 items-grid">
                <?php $__currentLoopData = $featured_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <div class="item box-shadow" data-id="<?php echo e($service->id); ?>">
                        <div id="carousel-_<?php echo e($service->id); ?>" class="main-image bg-overlay carousel slide" data-ride="carousel" data-interval="false">
                            <div class="featured-sign">
                                <?php echo e($static_data['strings']['featured']); ?>

                            </div>
                            <?php if(count($service->images)): ?>
                            <div class="carousel-inner" role="listbox">
                                <?php $c = 0; ?>
                                <?php $__currentLoopData = $service->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <div class="carousel-item <?php if(!$c): ?> active <?php $c++; ?> <?php endif; ?>">
                                        <img class="responsive-img" src="<?php echo e(URL::asset('images/data').'/'.$image->image); ?>"/>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </div>
                            <a class="carousel-control-prev" href="#carousel-_<?php echo e($service->id); ?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only"><?php echo e($static_data['strings']['previous']); ?></span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-_<?php echo e($service->id); ?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only"><?php echo e($static_data['strings']['next']); ?></span>
                            </a>
                            <?php else: ?>
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img class="responsive-img" src="<?php echo e(URL::asset('images/').'/no_image.jpg'); ?>"/>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="data">
                            <a href="<?php echo e(url('/service').'/'.$service->alias); ?>"><h3 class="item-title primary-color"><?php echo e($service->contentload->name); ?></h3></a>
                            <div class="item-category"><?php echo e($service->location['address'].', '.$service->location['city'] .' - '. $service->location['country']); ?></div>
                            <div class="item-category"><?php echo e($static_data['strings']['category'] .': '. $service->category->contentload->name .' | '); ?>

                                <?php echo e($static_data['strings']['location'] .': '. $service->ser_location->contentload->location); ?></div>
                            <?php if($service->user): ?><div class="small-text"><?php echo e($static_data['strings']['posted_by'] .': '. $service->user->username); ?></div><?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </div>
        <?php endif; ?>
        <div id="filtered-services" class="row">
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <div class="col-md-6 col-sm-6 items-grid">
                    <div class="item box-shadow" data-id="<?php echo e($service->id); ?>">
                        <div id="carousel-<?php echo e($service->id); ?>" class="main-image bg-overlay carousel slide" data-ride="carousel" data-interval="false">
                            <?php if($service->featured): ?>
                                <div class="featured-sign">
                                    <?php echo e($static_data['strings']['featured']); ?>

                                </div>
                            <?php endif; ?>
                            <?php if(count($service->images)): ?>
                                <div class="carousel-inner" role="listbox">
                                    <?php $c = 0; ?>
                                    <?php $__currentLoopData = $service->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <div class="carousel-item <?php if(!$c): ?> active <?php $c++; ?> <?php endif; ?>">
                                            <img class="responsive-img" src="<?php echo e(URL::asset('images/data').'/'.$image->image); ?>"/>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </div>
                                <a class="carousel-control-prev" href="#carousel-<?php echo e($service->id); ?>" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only"><?php echo e($static_data['strings']['previous']); ?></span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-<?php echo e($service->id); ?>" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only"><?php echo e($static_data['strings']['next']); ?></span>
                                </a>
                            <?php else: ?>
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img class="responsive-img" src="<?php echo e(URL::asset('images/').'/no_image.jpg'); ?>"/>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="data">
                            <a href="<?php echo e(url('/service').'/'.$service->alias); ?>"><h3 class="item-title primary-color"><?php echo e($service->contentload->name); ?></h3></a>
                            <div class="item-category"><?php echo e($service->location['address'].', '.$service->location['city'] .' - '. $service->location['country']); ?></div>
                            <div class="item-category"><?php echo e($static_data['strings']['category'] .': '. $service->category->contentload->name .' | '); ?>

                                <?php echo e($static_data['strings']['location'] .': '. $service->ser_location->contentload->location); ?></div>
                            <div class="small-text"><?php echo e($static_data['strings']['posted_by'] .': '. $service->user->username); ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </div>
        <div class="col-sm-12 mtop5 text-centered"><a href="#" class="black-button load-more-services"><?php echo e($static_data['strings']['load_more']); ?></a><img src="<?php echo e(URL::asset('assets/images/ajax-loader.gif')); ?>" class="ajax-loader"/></div>
    <?php else: ?>
        <?php if(!count($services)): ?><div class="col-sm-12 text-centered"><strong class="center-align"><?php echo e($static_data['strings']['no_results']); ?></strong></div><?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <input type="hidden" class="hidden token" value="<?php echo e(csrf_token()); ?>"/>
    <input type="hidden" class="hidden" name="isExplore" value="1"/>
    <script src="<?php echo e(URL::asset('assets/js/plugins/nouislider.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/plugins/jquery-ui.min.js')); ?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($static_data['site_settings']['google_map_key']); ?>&libraries=places"></script>
    <script src="<?php echo e(URL::asset('assets/js/plugins/richmarkers.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/plugins/clusters.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            // Load more services
            var page_service = 4;
            $('.load-more-services').click(function(e){
                var $this = $(this);
                var ajax_loader = $(this).parent().find('.ajax-loader');
                e.preventDefault();
                $.ajax({
                    url: '<?php echo e(url('explore') .'/getservices?page='); ?>' + page_service,
                    beforeSend: function(){
                        $this.hide(); ajax_loader.show();
                        $('#google-map').addClass('loading');
                    }
                }).done(function(data){
                    $('#google-map').removeClass('loading');
                    if(data){$this.show();$('#filtered-services').append(data);}else{$('#filtered-services').append('<div class="col-sm-12 info-message text-centered"><?php echo e($static_data['strings']['no_results']); ?></div>');setTimeout(function(){$('.info-message').slideUp()}, 2000);}
                    page_service++;
                    ajax_loader.hide();
                    mapClusters.clearMarkers();
                    var options = {
                        imagePath: '/images/home/icons/m'
                    };
                    mapClusters = new MarkerClusterer(map, allmarkers, options);
                });
            });

            // Property Filter
            $('.property-filter').click(function(e){
                e.preventDefault();
                var parent = $(this).parent(),
                        token = $('.token').val(),
                        location_id = $('[name="location_id"]').val(),
                        category_id = $('[name="category_id"]').val();
                $.ajax({
                    url: '<?php echo e(url('filter')); ?>/services',
                    type: 'post',
                    data: {isExplore: 1,_token: token,location_id: location_id, category_id: category_id},
                    beforeSend: function(){
                        parent.addClass('loading');
                        $('#google-map').addClass('loading');
                        removeMarkers();
                    }
                }).done(function(data){
                    parent.removeClass('loading');
                    $('#google-map').removeClass('loading');
                    $('.load-more-services').hide();
                    if(data){$('#filtered-services').html(data);}else{$('#filtered-services').html('<div class="col-sm-12 info-message text-centered"><?php echo e($static_data['strings']['no_results']); ?></div>');}
                    <?php if($featured_markers): ?>
                        fmarkers = [];
                        for(var i = 0; i < featured_markers.length; i++ ) {
                            addMarkerToMap(featured_markers[i][0], featured_markers[i][1], featured_infoWindowContent[i], 'services');
                        }
                    <?php endif; ?>
                    var target = $('#filtered-services');
                    $('html, body').animate({
                        scrollTop: target.offset().top - 150
                    }, 1000);
                    var options = {
                        imagePath: '/images/home/icons/m'
                    };
                    mapClusters = new MarkerClusterer(map, allmarkers, options);
                });
            });

            // Datepickers
            $('.start_date-picker').datepicker({
                dateFormat: 'dd/mm/yy',
                minDate: 0,
                onSelect: function(dateText, inst) {
                    var startDate = $(this).datepicker('getDate');
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

            // Load price range
            price_range(<?php echo e($max_price); ?>);

            var markers = [<?php $__currentLoopData = $markers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marker): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>[<?php echo e($marker['geo_lon']); ?>, <?php echo e($marker['geo_lat']); ?>], <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>],
                    infoWindowContent = [<?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>[{"id" : "<?php echo e($service->id); ?>","alias":"<?php echo e($service->alias); ?>","name":<?php echo json_encode($service->contentload->name); ?>,"address":"<?php echo e($service->location['address']); ?>" ,"city":"<?php echo e($service->location['city']); ?>" ,"country":"<?php echo e($service->location['country']); ?>" ,"phone":"<?php echo e($service->contact['tel1']); ?>", "icon":"<?php echo e($service->category->map_icon); ?>", "featured":"<?php echo e($service->featured); ?>", "image":<?php if(count($service->images)): ?>"<?php echo e($service->images[0]->image); ?>" <?php else: ?> "no_image.jpg" <?php endif; ?>}], <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>], map_lon = <?php echo e($static_data['site_settings']['contact_map_lon']); ?>, map_lat = <?php echo e($static_data['site_settings']['contact_map_lat']); ?>;

            explore_map(map_lat, map_lon, markers, infoWindowContent, 'service');

            <?php if($featured_markers): ?>
                var featured_markers = [<?php $__currentLoopData = $featured_markers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marker): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>[<?php echo e($marker['geo_lon']); ?>, <?php echo e($marker['geo_lat']); ?>], <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>],
                        featured_infoWindowContent = [<?php $__currentLoopData = $featured_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>[{"id" : "<?php echo e($service->id); ?>","alias":"<?php echo e($service->alias); ?>","name":<?php echo json_encode($service->contentload->name); ?>,"address":"<?php echo e($service->location['address']); ?>" ,"city":"<?php echo e($service->location['city']); ?>" ,"country":"<?php echo e($service->location['country']); ?>" ,"phone":"<?php echo e($service->contact['tel1']); ?>", "icon":"<?php echo e($service->category->map_icon); ?>", "featured":"<?php echo e($service->featured); ?>", "image":<?php if(count($service->images)): ?>"<?php echo e($service->images[0]->image); ?>" <?php else: ?> "no_image.jpg" <?php endif; ?>}], <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>];
                for(i = 0; i < featured_markers.length; i++ ) {
                    addMarkerToMap(featured_markers[i][0], featured_markers[i][1], featured_infoWindowContent[i], 'service');
                }
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home_explore', ['static_data', $static_data], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>