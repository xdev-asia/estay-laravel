
<?php $__env->startSection('title'); ?>
    <title><?php echo e($static_data['strings']['service'] .' - '. $service->contentload->name); ?></title>
    <meta name="title" content="<?php if($service->meta_title): ?> <?php echo e($service->meta_title); ?> <?php else: ?> <?php echo e($static_data['strings']['service'] .' - '. $service->contentload->name); ?> <?php endif; ?>">
    <meta name="description" content="<?php if($service->meta_description): ?> <?php echo e($service->meta_description); ?> <?php else: ?> <?php echo e(strip_tags(str_limit($service->contentload->description, 200))); ?> <?php endif; ?>">
    <meta name="keywords" content="<?php if($service->meta_keywords): ?> <?php echo e($service->meta_keywords); ?> <?php else: ?> <?php echo e($static_data['site_settings']['site_keywords']); ?> <?php endif; ?>">
    <meta name="author" content="<?php echo e($static_data['site_settings']['site_name']); ?>">
    <meta property="og:title" content="<?php if($service->meta_title): ?> <?php echo e($service->meta_title); ?> <?php else: ?> <?php echo e($static_data['strings']['service'] .' - '. $service->contentload->name); ?> <?php endif; ?>" />
    <meta property="og:image" content="<?php if(count($service->images)): ?> <?php echo e(URL::asset('images/data').'/'.$service->images[0]->image); ?> <?php else: ?><?php echo e(URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?> <?php endif; ?>" />
    <meta property="og:description" content="<?php if($service->meta_description): ?> <?php echo e($service->meta_description); ?> <?php else: ?> <?php echo e(strip_tags(str_limit($service->contentload->description, 200))); ?> <?php endif; ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bg'); ?>
    <?php if(count($service->images) && get_setting('show_first_image', 'property')): ?> 
        <?php echo e(URL::asset('images/data').'/'.$service->images[0]->image); ?> 
    <?php else: ?>
        <?php echo e(URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?> 
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php 
    $share_links = Share::load(Request::fullUrl(), $service->contentload->name)->services('facebook', 'gplus', 'twitter', 'pinterest', 'email', 'reddit', 'linkedin');
?>
<?php $__env->startSection('content'); ?>
    <div class="row marginalized">
        <div class="col-sm-12"><h1 class="section-title-dark"><?php echo e($service->contentload->name); ?></h1>
            <p class="meta-data"><?php echo e($service->category->contentload->name .', '. $service->ser_location->contentload->location); ?></p>
            <?php if(Session::has('reviewDone')): ?><p class="field-info text-centered green-color"><?php echo e($static_data['strings']['thank_you_for_review']); ?></p><?php endif; ?>
        </div>
        <div class="col-md-8 col-sm-12">
            <div id="carousel-images" class=" bg-overlay carousel slide" data-ride="carousel" data-interval="6000">
                <?php if(count($service->images)): ?>
                <div class="carousel-inner" role="listbox">
                    <?php $c = 0; ?>
                    <?php $__currentLoopData = $service->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <div class="carousel-item <?php if(!$c): ?> active <?php $c++; ?> <?php endif; ?>">
                            <img class="img-fluid d-block" src="<?php echo e(URL::asset('images/data').'/'.$image->image); ?>"/>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </div>
                <a class="carousel-control-prev" href="#carousel-images" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only"><?php echo e($static_data['strings']['previous']); ?></span>
                </a>
                <a class="carousel-control-next" href="#carousel-images" role="button" data-slide="next">
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
            <h3 class="section-type"><?php echo e($static_data['strings']['description']); ?></h3>
            <div style="overflow: hidden;"><p class="description mbot0"><?php echo $service->contentload->description; ?></p></div>
            <div class="features">
                <div class="row">
                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <div class="col-md-2 col-sm-3 amenity">
                        <?php if(isset($service->features) && in_array($feature->id, $service->features)): ?>
                            <span class="tooltip-feature" data-toggle="tooltip" data-placement="top" title="<?php echo e($feature->feature[$default_language->id]); ?>"><i class="primary-color fa fa-check"></i> <?php echo e($feature->feature[$default_language->id]); ?></span>
                        <?php elseif(!get_setting('show_available_amenities_only', 'property')): ?>
                            <span class="tooltip-feature" data-toggle="tooltip" data-placement="top" title="<?php echo e($feature->feature[$default_language->id]); ?>"><i class="red-color fa fa-close"></i> <?php echo e($feature->feature[$default_language->id]); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 sidebar">
            <div class="features">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="map-boxed" class="map-boxed"></div>
                        <p class="listing-data">
                            <a href="#"><i class="fa primary-color fa-home"></i> <?php echo e($service->location['address'].', '.$service->location['city'].' - '.$service->location['country']); ?></a>
                        </p>
                        <?php if($service->contact['tel1']): ?>
                            <p class="listing-data">
                                <a href="tel:<?php echo e($service->contact['tel1']); ?>"><i class="fa primary-color fa-phone"></i> <?php echo e($service->contact['tel1']); ?></a>
                                <?php if($service->contact['tel2']): ?>
                                    <a href="tel:<?php echo e($service->contact['tel2']); ?>"> | <?php echo e($service->contact['tel2']); ?></a>
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>
                        <?php if($service->contact['fax']): ?>
                            <p class="listing-data">
                                <a href="tel:<?php echo e($service->contact['fax']); ?>"><i class="fa primary-color fa-fax"></i> <?php echo e($service->contact['fax']); ?></a>
                            </p>
                        <?php endif; ?>
                        <?php if($service->contact['email']): ?>
                            <p class="listing-data">
                                <a href="mailto:<?php echo e($service->contact['email']); ?>"><i class="fa primary-color fa-envelope"></i> <?php echo e($service->contact['email']); ?></a>
                            </p>
                        <?php endif; ?>
                        <?php if($service->contact['web']): ?>
                            <p class="listing-data">
                                <a href="<?php echo e($service->contact['web']); ?>"><i class="fa primary-color fa-globe"></i> <?php echo e($service->contact['web']); ?></a>
                            </p>
                        <?php endif; ?>
                        <div class="work-times">
                            <p class="first-data listing-data"><i class="fa fa-clock-o"></i> <?php echo e($static_data['strings']['business_hours']); ?></p>
                            <?php if(isset($service->business_hours['week'])): ?><p class="listing-data mtop5"><?php echo e($static_data['strings']['weekdays'].': '.$service->business_hours['week']); ?></p><?php endif; ?>
                            <?php if(isset($service->business_hours['sat'])): ?> <p class="listing-data"><?php echo e($static_data['strings']['saturday'].': '.$service->business_hours['sat']); ?></p><?php endif; ?>
                            <?php if(isset($service->business_hours['sun'])): ?><p class="listing-data"><?php echo e($static_data['strings']['sunday'].': '.$service->business_hours['sun']); ?></p><?php endif; ?>
                        </div>
                        <?php if($service->user): ?><p class="owner-info"><?php echo e($static_data['strings']['owner'] .' - '. $service->user->username); ?></p><?php endif; ?>
                        <ul class="social-icons">
                            <?php if($service->social['facebook']): ?> <li><a href="<?php echo e($service->social['facebook']); ?>" target="_blank"><i class="fa primary-color fa-facebook"></i></a></li> <?php endif; ?> 
                            <?php if($service->social['twitter']): ?> <li><a href="<?php echo e($service->social['twitter']); ?>" target="_blank"><i class="fa primary-color fa-twitter"></i></a></li><?php endif; ?>
                            <?php if($service->social['instagram']): ?>  <li><a href="<?php echo e($service->social['instagram']); ?>" target="_blank"><i class="fa primary-color fa-instagram"></i></a></li><?php endif; ?>
                            <?php if($service->social['gplus']): ?>  <li><a href="<?php echo e($service->social['gplus']); ?>" target="_blank"><i class="fa primary-color fa-google-plus"></i></a></li><?php endif; ?>
                            <?php if($service->social['pinterest']): ?>  <li><a href="<?php echo e($service->social['pinterest']); ?>" target="_blank"><i class="fa primary-color fa-pinterest"></i></a></li><?php endif; ?>
                            <?php if($service->social['linkedin']): ?>  <li><a href="<?php echo e($service->social['linkedin']); ?>" target="_blank"><i class="fa primary-color fa-linkedin"></i></a></li><?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-centered">
                        <div class="social-buttons">
                            <h3 class="section-type"><?php echo e($static_data['strings']['share']); ?></h3>
                            <a href="<?php echo e($share_links['facebook']); ?>" target="_blank" class="primary-color"><i class="fa fa-facebook-official"></i></a>
                            <a href="<?php echo e($share_links['twitter']); ?>" target="_blank" class="primary-color"> <i class="fa fa-twitter-square"></i></a>
                            <a href="<?php echo e($share_links['gplus']); ?>" target="_blank" class="primary-color"><i class="fa fa-google-plus-square"></i></a>
                            <a href="<?php echo e($share_links['pinterest']); ?>" target="_blank" class="primary-color"><i class="fa fa-pinterest-square"></i></a>
                            <a href="<?php echo e($share_links['reddit']); ?>" target="_blank" class="primary-color"><i class="fa fa-reddit-square"></i></a>
                            <a href="<?php echo e($share_links['linkedin']); ?>" target="_blank" class="primary-color"><i class="fa fa-linkedin-square"></i></a>
                            <a href="<?php echo e($share_links['email']); ?>" target="_blank" class="primary-color"><i class="fa fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 mtop20">
            <?php if($similar->count()): ?>
                <div class="row hidden-md-down">
                    <div class="col-sm-12"><h3 class="section-type"><?php echo e($static_data['strings']['similar_services']); ?></h3></div>
                    <?php $__currentLoopData = $similar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service1): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                        <?php echo $__env->make('home.partials.service', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if($static_data['user']): ?>
        <div class="<?php if(count($reviews)): ?>col-md-6 <?php endif; ?> col-sm-12">
            <h3 class="section-type"><?php echo e($static_data['strings']['review']); ?></h3>
            <div id="review">
                <?php echo Form::open(['method' => 'post', 'url' => route('make_review')]); ?>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group  <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                            <?php echo e(Form::text('name', $static_data['user']->info->first_name, ['class' => 'form-control', 'required', 'placeholder' => $static_data['strings']['name']])); ?>

                            <?php if($errors->has('name')): ?>
                                <span class="wrong-error">* <?php echo e($errors->first('name')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mbot10">
                            <p class="mbot0 review-label"><?php echo e($static_data['strings']['rating'].' '); ?></p>
                            <select id="rating-select" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="rating" value="0" class="rating-value hidden" />
                <div class="form-group  <?php echo e($errors->has('review') ? 'has-error' : ''); ?>">
                    <?php echo e(Form::textarea('review', null, ['class' => 'form-control', 'x4', 'required', 'placeholder' => $static_data['strings']['review']])); ?>

                    <?php if($errors->has('review')): ?>
                        <span class="wrong-error">* <?php echo e($errors->first('review')); ?></span>
                    <?php endif; ?>
                </div>
                <?php echo Form::hidden('service_id', $service->id); ?>

                <?php echo Form::hidden('user_id', $static_data['user']->id); ?>

                <button type="submit" name="action" class="primary-button"><?php echo e($static_data['strings']['submit']); ?></button>
                <?php echo Form::close(); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(count($reviews)): ?>
            <div class="<?php if($static_data['user']): ?>col-md-6 <?php endif; ?> col-sm-12">
                <h3 class="section-type mtop20"><?php echo e($static_data['strings']['reviews']); ?></h3>
                <ul class="review-list">
                    <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <li class="review-item">
                                <div class="review-description">
                                    <span><?php echo e($review->review); ?></span>
                                    <div class="br-wrapper br-theme-fontawesome-stars-o">
                                        <?php if($review->user): ?><p class="meta-data"> <?php echo e($static_data['strings']['posted_by'] .': '. $review->user->username); ?></p><?php endif; ?>
                                        <div class="br-widget">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <?php if($i <= $review->rating): ?>
                                                    <a href="#" data-rating-value="<?php echo e($i); ?>" data-rating-text="<?php echo e($i); ?>" class="br-active"></a>
                                                <?php else: ?>
                                                    <a href="#" data-rating-value="<?php echo e($i); ?>" data-rating-text="<?php echo e($i); ?>"></a>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                     </div>
                                    </div>
                                </div>
                            </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script src="<?php echo e(URL::asset('assets/js/plugins/readmore.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/plugins/rating.min.js')); ?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($static_data['site_settings']['google_map_key']); ?>&libraries=places"></script>
    <script src="<?php echo e(URL::asset('assets/js/plugins/richmarkers.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.description').readmore({
                speed: 100,
                collapsedHeight: 150,
                moreLink: '<a class="primary-color" href="#"><?php echo e($static_data['strings']['read_more']); ?></a>',
                lessLink: '<a class="primary-color" href="#"><?php echo e($static_data['strings']['read_less']); ?></a>',
            });

            // Google Map
            var position = new google.maps.LatLng(<?php echo e($mainService->location['geo_lon']); ?>, <?php echo e($mainService->location['geo_lat']); ?>);
            if(typeof google !== 'undefined'){
                var map = new google.maps.Map(document.getElementById('map-boxed'), {
                    center:{
                        lat: <?php echo e($mainService->location['geo_lon']); ?>,
                        lng: <?php echo e($mainService->location['geo_lat']); ?>

                    },
                    zoom: <?php echo e($static_data['site_settings']['google_map_zoom']); ?>,
                    styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#6195a0"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":"0"},{"saturation":"0"},{"color":"#f5f5f2"},{"gamma":"1"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"lightness":"-3"},{"gamma":"1.00"}]},{"featureType":"landscape.natural.terrain","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#bae5ce"},{"visibility":"on"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#fac9a9"},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#4e4e4e"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#787878"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.station.airport","elementType":"labels.icon","stylers":[{"hue":"#0a00ff"},{"saturation":"-77"},{"gamma":"0.57"},{"lightness":"0"}]},{"featureType":"transit.station.rail","elementType":"labels.text.fill","stylers":[{"color":"#43321e"}]},{"featureType":"transit.station.rail","elementType":"labels.icon","stylers":[{"hue":"#ff6c00"},{"lightness":"4"},{"gamma":"0.75"},{"saturation":"-68"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#eaf6f8"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#c7eced"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"lightness":"-49"},{"saturation":"-53"},{"gamma":"0.79"}]}]
                });
                <?php if($mainService->featured): ?> var featured = 'featured'; <?php else: ?> var featured = ''; <?php endif; ?>
                var icon = '<?php echo e($mainService->category->map_icon); ?>';
                marker = new RichMarker({
                    position: position,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    shadow: 'none',
                    content: '<div class="map-marker ' + featured + '"><i class="fa '+ icon + '"></i></div>'
                });
            }

            $('#rating-select').barrating({
                theme: 'fontawesome-stars-o',
                onSelect: function(value, text, event){
                    $('[name="rating"]').val(value);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home_layout', ['static_data', $static_data], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>