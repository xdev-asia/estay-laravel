
<?php $__env->startSection('title'); ?>
    <title><?php echo e($static_data['strings']['property'] .' - '. $property->contentload->name); ?></title>
    <meta name="title" content="<?php if($property->meta_title): ?> <?php echo e($property->meta_title); ?> <?php else: ?> <?php echo e($static_data['strings']['property'] .' - '. $property->contentload->name); ?> <?php endif; ?>">
    <meta name="description" content="<?php if($property->meta_description): ?> <?php echo e($property->meta_description); ?> <?php else: ?> <?php echo e(strip_tags(str_limit($property->contentload->description, 200))); ?> <?php endif; ?>">
    <meta name="keywords" content="<?php if($property->meta_keywords): ?> <?php echo e($property->meta_keywords); ?> <?php else: ?> <?php echo e($static_data['site_settings']['site_keywords']); ?> <?php endif; ?>">
    <meta name="author" content="<?php echo e($static_data['site_settings']['site_name']); ?>">
    <meta property="og:title" content="<?php if($property->meta_title): ?> <?php echo e($property->meta_title); ?> <?php else: ?> <?php echo e($static_data['strings']['property'] .' - '. $property->contentload->name); ?> <?php endif; ?>" />
    <meta property="og:image" content="<?php if(count($property->images)): ?> <?php echo e(URL::asset('images/data').'/'.$property->images[0]->image); ?> <?php else: ?><?php echo e(URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?> <?php endif; ?>" />
    <meta property="og:description" content="<?php if($property->meta_description): ?> <?php echo e($property->meta_description); ?> <?php else: ?> <?php echo e(strip_tags(str_limit($property->contentload->description, 200))); ?> <?php endif; ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bg'); ?>
    <?php if(count($property->images) && get_setting('show_first_image', 'property')): ?>
        <?php echo e(URL::asset('images/data').'/'.$property->images[0]->image); ?>

    <?php else: ?>
        <?php echo e(URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/plugins/jquery-ui.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php
    $share_links = Share::load(Request::fullUrl(), $property->contentload->name)->services('facebook', 'gplus', 'twitter', 'pinterest', 'email', 'reddit', 'linkedin');
?>
<?php $__env->startSection('content'); ?>
    <div class="row marginalized">
        <div class="col-sm-12"><h1 class="section-title-dark"><?php echo e($property->contentload->name); ?></h1>
            <p class="meta-data"><?php echo e($property->category->contentload->name .', '. $property->prop_location->contentload->location); ?></p>
            <?php if(Session::has('reviewDone')): ?><p class="field-info text-centered green-color"><?php echo e($static_data['strings']['thank_you_for_review']); ?></p><?php endif; ?>
        </div>
        <div class="col-md-8 col-sm-12">
            <div id="carousel-images" class=" bg-overlay carousel slide" data-ride="carousel" data-interval="6000">
                <?php if(count($property->images)): ?>
                <div class="carousel-inner" role="listbox">
                    <?php $c = 0; ?>
                    <?php $__currentLoopData = $property->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
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
            <div style="overflow: hidden;"><p class="description mbot0"><?php echo $property->contentload->description; ?></p></div>
            <div class="features">
                <div class="row">
                    <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <div class="col-md-2 col-sm-3 amenity">
                            <?php if(isset($property->features) && in_array($feature->id, $property->features)): ?>
                                <span class="tooltip-feature" data-toggle="tooltip" data-placement="top" title="<?php echo e($feature->feature[$default_language->id]); ?>"><i class="primary-color fa fa-check"></i> <?php echo e($feature->feature[$default_language->id]); ?></span>
                            <?php elseif(!get_setting('show_available_amenities_only', 'property')): ?>
                                <span class="tooltip-feature" data-toggle="tooltip" data-placement="top" title="<?php echo e($feature->feature[$default_language->id]); ?>"><i class="red-color fa fa-close"></i> <?php echo e($feature->feature[$default_language->id]); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="property-info mtop20">
                        <h3 class="section-type"><?php echo e($static_data['strings']['property_info']); ?></h3>
                        <?php if(isset($property->property_info['size'])): ?><p class="listing-data"><i class="primary-color fa fa-info-circle"></i> <?php echo e($static_data['strings']['property_size'].': '); ?> <strong> <?php echo e($property->property_info['size']); ?> <?php echo e($static_data['site_settings']['measurement_unit']); ?></strong></p><?php endif; ?>
                        <?php if(isset($property->property_info['guest_number'])): ?><p class="listing-data"><i class="primary-color fa fa-info-circle"></i> <?php echo e($static_data['strings']['guest_number'].': '); ?> <strong> <?php echo e($property->property_info['guest_number']); ?></strong></p><?php endif; ?>
                        <?php if(isset($property->property_info['rooms'])): ?><p class="listing-data"><i class="primary-color fa fa-info-circle"></i> <?php echo e($static_data['strings']['property_rooms'].': '); ?><strong> <?php echo e($property->property_info['rooms']); ?> </strong></p><?php endif; ?>
                        <?php if(isset($property->property_info['bedrooms'])): ?><p class="listing-data"><i class="primary-color fa fa-info-circle"></i> <?php echo e($static_data['strings']['property_bedrooms'].': '); ?> <strong><?php echo e($property->property_info['bedrooms']); ?> </strong></p><?php endif; ?>
                        <?php if(isset($property->property_info['bathrooms'])): ?><p class="listing-data"><i class="primary-color fa fa-info-circle"></i> <?php echo e($static_data['strings']['property_bathrooms'].': '); ?> <strong><?php echo e($property->property_info['bathrooms']); ?></strong></p><?php endif; ?>
                        <?php if(isset($property->fees['city_fee'])): ?><p class="listing-data"><i class="primary-color fa fa-info-circle"></i> <?php echo e($static_data['strings']['city_fee'].': '); ?> <strong><?php echo e(currency($property->fees['city_fee'], $static_data['site_settings']['currency_code'], Session::get('currency'), false)); ?></strong><?php echo e(userCurrencySymbol()); ?></p><?php endif; ?>
                        <?php if(isset($property->fees['cleaning_fee'])): ?><p class="listing-data"><i class="primary-color fa fa-info-circle"></i> <?php echo e($static_data['strings']['cleaning_fee'].': '); ?> <strong><?php echo e(currency($property->fees['cleaning_fee'], $static_data['site_settings']['currency_code'], Session::get('currency'), false)); ?> </strong><?php echo e(userCurrencySymbol()); ?></p><?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="property-info  mtop20">
                        <h3 class="section-type"><?php echo e($static_data['strings']['property_prices']); ?></h3>
                        <?php if(isset($property->price_per_night)): ?><p class="listing-data"><i class="primary-color fa fa-info-circle"></i> <?php echo e($static_data['strings']['price_per_night'].': '); ?> <strong> <?php echo e(currency($property->price_per_night, $static_data['site_settings']['currency_code'], Session::get('currency'), false)); ?> </strong><?php echo e(userCurrencySymbol()); ?></p><?php endif; ?>
                        <?php if(isset($property->prices['d_5'])): ?><p class="listing-data"><i class="primary-color fa fa-info-circle"></i> <?php echo e($static_data['strings']['price_d_5'].': '); ?> <strong> <?php echo e(currency($property->prices['d_5'], $static_data['site_settings']['currency_code'], Session::get('currency'), false)); ?> </strong><?php echo e(userCurrencySymbol()); ?></p><?php endif; ?>
                        <?php if(isset($property->prices['d_15'])): ?><p class="listing-data"><i class="primary-color fa fa-info-circle"></i> <?php echo e($static_data['strings']['price_d_15'].': '); ?><strong> <?php echo e(currency($property->prices['d_15'], $static_data['site_settings']['currency_code'], Session::get('currency'), false)); ?> </strong><?php echo e(userCurrencySymbol()); ?></p><?php endif; ?>
                        <?php if(isset($property->prices['d_30'])): ?><p class="listing-data"><i class="primary-color fa fa-info-circle"></i> <?php echo e($static_data['strings']['price_d_30'].': '); ?> <strong><?php echo e(currency($property->prices['d_30'], $static_data['site_settings']['currency_code'], Session::get('currency'), false)); ?> </strong><?php echo e(userCurrencySymbol()); ?></p><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 sidebar">
            <?php if(get_setting('guest_booking', 'user') || $static_data['user']): ?>
            <div class="booking-form input-style filter-box mbot20">
                <?php echo Form::open(['method' => 'post', 'url' => route('booking_pay_page')]); ?>

                <h3 class="section-type text-centered mbot5"><?php echo e($static_data['strings']['book_now']); ?></h3>
                <p class="field-info text-centered mbot5"><?php echo e($static_data['strings']['fill_fields_to_book']); ?></p>
                <div class="form-group not-after">
                    <div class="input-group">
                        <span class="fa fa-user input-group-addon"></span>
                        <input type="text" value="<?php if($static_data['user']): ?><?php echo e($static_data['user']->info->first_name); ?><?php endif; ?>" name="first_name" required class="form-control slider-field" placeholder="<?php echo e($static_data['strings']['your_name']); ?>">
                    </div>
                </div>
                <div class="form-group not-after">
                    <div class="input-group">
                        <span class="fa fa-envelope input-group-addon"></span>
                        <input type="email" value="<?php if($static_data['user']): ?><?php echo e($static_data['user']->email); ?><?php endif; ?>" name="email" class="form-control slider-field" required placeholder="<?php echo e($static_data['strings']['your_email']); ?>">
                    </div>
                </div>
                <div class="form-group not-after">
                    <div class="input-group">
                        <span class="fa fa-phone input-group-addon"></span>
                        <input type="text" value="" required name="phone" class="form-control slider-field" placeholder="<?php echo e($static_data['strings']['your_phone']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="fa fa-user-o input-group-addon"></span>
                        <input type="text" disabled name="guest_number_value" value="" class="form-control filter-field" placeholder="<?php echo e($static_data['strings']['guests_number']); ?>">
                    </div>
                    <input type="hidden" name="guest_number" value="1" class="form-control filter-hidden hidden" placeholder="<?php echo e($static_data['strings']['guests_number']); ?>">
                    <ul class="dropdown-filter-menu">
                        <?php if(isset($property->guest_number)): ?>
                            <?php for($i = 1; $i <= $property->guest_number; $i++): ?>
                                <li data-number="<?php echo e($i); ?>">
                                    <a href="#" class="guest_number_picker">
                                        <span><?php echo e($i); ?></span>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        <?php else: ?>
                            <li data-number="1">
                                <a href="#" class="guest_number_picker">
                                    <span>1</span>
                                </a>
                            </li>
                        <?php endif; ?>
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
                    </div>
                </div>
                <input type="hidden" name="total" class="hidden total-field" >
                <input type="hidden" name="property_id" value="<?php echo e($property->id); ?>" class="hidden property-field" >
                <input type="hidden" value="<?php echo e(Session::get('currency')); ?>" class="currency_code" name="currency_code" />
                <div class="form-group not-after booking-data">
                    <p class="wrong-error"></p>
                </div>
                <div class="row booking-total">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr><td><?php echo e($static_data['strings']['nights']); ?> </td><td class="total-nights"><strong></strong></td></tr>
                                <?php if(isset($property->price_per_night)): ?><tr><td><?php echo e($static_data['strings']['price_per_night']); ?> </td><td class="price-per-night"><strong><?php echo e(currency($property->price_per_night, $static_data['site_settings']['currency_code'], Session::get('currency'), false)); ?></strong><?php echo e(userCurrencySymbol()); ?></td></tr><?php endif; ?>
                                <?php if(isset($property->fees['cleaning_fee'])): ?><tr><td><?php echo e($static_data['strings']['cleaning_fee']); ?> </td><td class="cleaning-fee"><strong><?php echo e(currency($property->fees['cleaning_fee'], $static_data['site_settings']['currency_code'], Session::get('currency'),false)); ?></strong><?php echo e(userCurrencySymbol()); ?></td></tr><?php endif; ?>
                                <?php if(isset($property->fees['city_fee'])): ?><tr><td><?php echo e($static_data['strings']['city_fee']); ?> </td><td class="city-fee"><strong><?php echo e(currency($property->fees['city_fee'], $static_data['site_settings']['currency_code'], Session::get('currency'), false)); ?></strong><?php echo e(userCurrencySymbol()); ?></td></tr><?php endif; ?>
                                <tr><td><?php echo e($static_data['strings']['total']); ?> </td><td class="total-book"><strong></strong><?php echo e(userCurrencySymbol()); ?></td></tr>
                            </table>
                        </div>
                        <?php if(!get_setting('booking_by_payment', 'payment')): ?> <a href="#" class="primary-button book-now"><?php echo e($static_data['strings']['book_now']); ?></a>
                        <?php else: ?>
                        <button type="submit" class="primary-button pay-now"><?php echo e($static_data['strings']['book_now']); ?></button>
                        <?php echo Form::close(); ?>

                        <?php endif; ?>
                        <p class="success-book green-color" style="display: none;"><?php echo e($static_data['strings']['thank_you_for_book']); ?></p>
                    </div>
                </div>
            </div>
            <?php else: ?>
                <p class="field-info text-centered mbot5"><?php echo e($static_data['strings']['login_to_book']); ?></p>
            <?php endif; ?>
            <div class="features">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="map-boxed" class="map-boxed"></div>
                        <p class="listing-data">
                            <a href="#"><i class="fa primary-color fa-home"></i> <?php echo e($property->location['address'].', '.$property->location['city'].' - '.$property->location['country']); ?></a>
                        </p>
                        <?php if($property->contact['tel1']): ?>
                            <p class="listing-data">
                                <a href="tel:<?php echo e($property->contact['tel1']); ?>"><i class="fa primary-color fa-phone"></i> <?php echo e($property->contact['tel1']); ?></a>
                                <?php if($property->contact['tel2']): ?>
                                    <a href="tel:<?php echo e($property->contact['tel2']); ?>"> | <?php echo e($property->contact['tel2']); ?></a>
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>
                        <?php if($property->contact['fax']): ?>
                            <p class="listing-data">
                                <a href="tel:<?php echo e($property->contact['fax']); ?>"><i class="fa primary-color fa-fax"></i> <?php echo e($property->contact['fax']); ?></a>
                            </p>
                        <?php endif; ?>
                        <?php if($property->contact['email']): ?>
                            <p class="listing-data">
                                <a href="mailto:<?php echo e($property->contact['email']); ?>"><i class="fa primary-color fa-envelope"></i> <?php echo e($property->contact['email']); ?></a>
                            </p>
                        <?php endif; ?>
                        <?php if($property->contact['web']): ?>
                            <p class="listing-data">
                                <a href="<?php echo e($property->contact['web']); ?>"><i class="fa primary-color fa-globe"></i> <?php echo e($property->contact['web']); ?></a>
                            </p>
                        <?php endif; ?>
                        <?php if($property->user): ?><p class="owner-info"><?php echo e($static_data['strings']['owner'] .' - '. $property->user->username); ?></p><?php endif; ?>
                        <ul class="social-icons">
                            <?php if($property->social['facebook']): ?> <li><a href="<?php echo e($property->social['facebook']); ?>" target="_blank"><i class="fa primary-color fa-facebook"></i></a></li> <?php endif; ?>
                            <?php if($property->social['twitter']): ?> <li><a href="<?php echo e($property->social['twitter']); ?>" target="_blank"><i class="fa primary-color fa-twitter"></i></a></li><?php endif; ?>
                            <?php if($property->social['instagram']): ?>  <li><a href="<?php echo e($property->social['instagram']); ?>" target="_blank"><i class="fa primary-color fa-instagram"></i></a></li><?php endif; ?>
                            <?php if($property->social['gplus']): ?>  <li><a href="<?php echo e($property->social['gplus']); ?>" target="_blank"><i class="fa primary-color fa-google-plus"></i></a></li><?php endif; ?>
                            <?php if($property->social['pinterest']): ?>  <li><a href="<?php echo e($property->social['pinterest']); ?>" target="_blank"><i class="fa primary-color fa-pinterest"></i></a></li><?php endif; ?>
                            <?php if($property->social['linkedin']): ?>  <li><a href="<?php echo e($property->social['linkedin']); ?>" target="_blank"><i class="fa primary-color fa-linkedin"></i></a></li><?php endif; ?>
                        </ul>
                    </div>
                </div>
                <?php if($property->user && $static_data['user']): ?>
                    <div class="row">
                        <div class="col-sm-12 text-centered">
                            <p class="mbot0 mtop10"><a class="primary-button" href="#" data-toggle="modal" data-target="#message-modal"><i class="fa fa-envelope"></i> <?php echo e($static_data['strings']['contact_owner']); ?></a></p>
                        </div>
                    </div>
                <?php endif; ?>
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
                    <div class="col-sm-12"><h3 class="section-type"><?php echo e($static_data['strings']['similar_properties']); ?></h3></div>
                    <?php $__currentLoopData = $similar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                        <?php echo $__env->make('home.partials.property', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
                    <?php echo Form::hidden('property_id', $property->id); ?>

                    <?php echo Form::hidden('user_id', $static_data['user']->id); ?>

                </div>
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
    <?php echo e(csrf_field()); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>

    <?php if($static_data['user']): ?>
        <div class="modal fade" id="message-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e($static_data['strings']['write_your_message']); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <?php echo Form::open(['method' => 'post', 'url' => route('message_owner'), 'id' => 'message-form']); ?>

                            <div class="form-group">
                                <?php echo Form::textarea('message', null, ['class' => 'form-control form-message', 'required', 'placeholder' => $static_data['strings']['write_your_message']]); ?>

                                <span class="wrong-error hidden"><?php echo e($static_data['strings']['required_field']); ?></span>
                            </div>
                            <?php echo Form::hidden('user_id', $static_data['user']->id); ?>

                            <?php echo Form::hidden('owner_id', $property->user_id); ?>

                            <?php if($static_data['site_settings']['reCaptcha']): ?>
                            <div class="form-group" id="reCaptcha">
                                <div class="g-recaptcha" data-sitekey="<?php echo e($static_data['site_settings']['reCaptcha_api']); ?>"></div>
                                <span class="wrong-error"></span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="send-form primary-button" data-dismiss="modal"><?php echo e($static_data['strings']['close']); ?></button>
                        <a href="#" class="send-message primary-button"><?php echo e($static_data['strings']['submit']); ?></a>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="<?php echo e(URL::asset('assets/js/plugins/readmore.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/plugins/rating.min.js')); ?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($static_data['site_settings']['google_map_key']); ?>&libraries=places"></script>
    <script src="<?php echo e(URL::asset('assets/js/plugins/richmarkers.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/plugins/jquery-ui.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.description').readmore({
                speed: 100,
                collapsedHeight: 150,
                moreLink: '<a class="primary-color" href="#"><?php echo e($static_data['strings']['read_more']); ?></a>',
                lessLink: '<a class="primary-color" href="#"><?php echo e($static_data['strings']['read_less']); ?></a>',
            });

            <?php if($static_data['site_settings']['reCaptcha']): ?>
            // Contact mail
            $('.send-message').click(function(e){
                e.preventDefault();
                var token = $('[name="_token"]').val();
                var parent = $('.form-message').parent();
                $('.wrong-error', parent).addClass('hidden');
                $('#reCaptcha .wrong-error').hide();
                var captcha = grecaptcha.getResponse();
                if(captcha.length){
                    $.ajax({
                        url: '<?php echo e(route('reCaptcha')); ?>',
                        type: 'post',
                        data: {response: captcha, _token: token},
                        success: function(msg){
                            if(msg.status){
                                if($('.form-message').val() != ''){
                                    $('#message-form').submit();
                                }else{
                                    $('.wrong-error', parent).removeClass('hidden');
                                }
                            }else{
                                $('#reCaptcha .wrong-error').show().html('<?php echo e($static_data['strings']['refresh_and_try_again']); ?>');
                            }
                        },
                    })
                }else{
                    $('#reCaptcha .wrong-error').show().html('<?php echo e($static_data['strings']['fill_captcha']); ?>');
                }
            });
            <?php else: ?>
            // Contact mail
            $('.send-form').click(function(e){
                e.preventDefault();
                if($('.form-message').val() != ''){
                    $('#message-form').submit();
                }else{
                    $('.wrong-error', parent).removeClass('hidden');
                }
            });
            <?php endif; ?>

            var array = <?php echo json_encode($dates); ?>;
            // Datepickers
            $('.start_date-picker').datepicker({
                dateFormat: 'dd/mm/yy',
                minDate: 0,
                beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
                    return [ array.indexOf(string) == -1 ]
                },
                onSelect: function(dateText, inst) {
                    if($('.end_date-picker').hasClass('hasDatepicker')){
                        $('.end_date-picker').datepicker('destroy');
                        $('.end_date-picker').val('');
                        $('.booking-total').hide();
                    }
                    var startDate = $(this).datepicker('getDate');
                    startDate.setDate(startDate.getDate() + 1);
                    $("[name='start_date']").val(dateText);
                    $("[name='end_date']").removeAttr('disabled');
                    $('.end_date-picker').datepicker({
                        dateFormat: 'dd/mm/yy',
                        minDate: startDate,
                        beforeShowDay: function(date){
                            var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
                            return [ array.indexOf(string) == -1 ]
                        },
                        onSelect: function(dateText, inst) {
                            $('.booking-form').addClass('loading');
                            $('.booking-data, .booking-total').hide();
                            $("[name='end_date']").val(dateText);
                            var endDate = $(this).datepicker('getDate');
                            var dates = getDates(startDate, endDate);
                            var condition = 1;
                            $.each(dates, function(i){
                                if(array.indexOf(dates[i]) != -1){
                                    condition = 0;
                                    return false;
                                }
                            });
                            if(condition){
                                price_per_night = <?php echo e(currency($mainProperty->price_per_night, $static_data['site_settings']['currency_code'], Session::get('currency'), false)); ?>;
                                var days = dates.length, price = 0, total = 0, total_book = 0;
                                if(days > 5) price = <?php if(isset($mainProperty->prices['d_5'])): ?> <?php echo e(currency($mainProperty->prices['d_5'], $static_data['site_settings']['currency_code'], Session::get('currency'), false)); ?> <?php else: ?> price_per_night <?php endif; ?>;
                                if(days > 15) price = <?php if(isset($mainProperty->prices['d_15'])): ?> <?php echo e(currency($mainProperty->prices['d_15'], $static_data['site_settings']['currency_code'], Session::get('currency'), false)); ?> <?php else: ?> price_per_night <?php endif; ?>;
                                if(days > 30) price = <?php if(isset($mainProperty->prices['d_30'])): ?> <?php echo e(currency($mainProperty->prices['d_30'], $static_data['site_settings']['currency_code'], Session::get('currency'), false)); ?> <?php else: ?> price_per_night <?php endif; ?>;
                                if(days < 5 || price == 0) price = price_per_night;
                                total_book = days * price;
                                total = total_book <?php if(isset($mainProperty->fees['city_fee'])): ?>+ <?php echo e(currency($mainProperty->fees['city_fee'], $static_data['site_settings']['currency_code'], Session::get('currency'), false)); ?> <?php endif; ?> <?php if(isset($mainProperty->fees['cleaning_fee'])): ?> + <?php echo e(currency($mainProperty->fees['cleaning_fee'], $static_data['site_settings']['currency_code'], Session::get('currency'), false)); ?> <?php endif; ?>;
                                $('.booking-total').show();$('.total-nights strong').html(days);$('.price-per-night strong').html(price);$('.total-book strong').html(Math.round(total * 100) / 100);$('.total-field').val(Math.round(total * 100) / 100);
                            }else{
                                $('.booking-data').show();
                                $('.booking-data .wrong-error').html('* <?php echo e($static_data['strings']['dates_overlap']); ?>')
                            }
                            $('.booking-form').removeClass('loading');
                        },
                    });
                    setTimeout(function(){
                        $('.end_date-picker').datepicker('show');
                    }, 100);
                },
            });

            // Google Map
            var position = new google.maps.LatLng(<?php echo e($mainProperty->location['geo_lon']); ?>, <?php echo e($mainProperty->location['geo_lat']); ?>);
            if(typeof google !== 'undefined'){
                var map = new google.maps.Map(document.getElementById('map-boxed'), {
                    center:{
                        lat: <?php echo e($mainProperty->location['geo_lon']); ?>,
                        lng: <?php echo e($mainProperty->location['geo_lat']); ?>

                    },
                    zoom: <?php echo e($static_data['site_settings']['google_map_zoom']); ?>,
                    styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#6195a0"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":"0"},{"saturation":"0"},{"color":"#f5f5f2"},{"gamma":"1"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"lightness":"-3"},{"gamma":"1.00"}]},{"featureType":"landscape.natural.terrain","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#bae5ce"},{"visibility":"on"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#fac9a9"},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#4e4e4e"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#787878"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.station.airport","elementType":"labels.icon","stylers":[{"hue":"#0a00ff"},{"saturation":"-77"},{"gamma":"0.57"},{"lightness":"0"}]},{"featureType":"transit.station.rail","elementType":"labels.text.fill","stylers":[{"color":"#43321e"}]},{"featureType":"transit.station.rail","elementType":"labels.icon","stylers":[{"hue":"#ff6c00"},{"lightness":"4"},{"gamma":"0.75"},{"saturation":"-68"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#eaf6f8"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#c7eced"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"lightness":"-49"},{"saturation":"-53"},{"gamma":"0.79"}]}]
                });
                <?php if($mainProperty->featured): ?> var featured = 'featured'; <?php else: ?> var featured = ''; <?php endif; ?>
                var icon = '<?php echo e($mainProperty->category->map_icon); ?>';
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

            <?php if(!get_setting('booking_by_payment', 'payment')): ?>
            $('.book-now').click(function(e){
                e.preventDefault();
                $('.booking-form').addClass('loading');
                var first_name = $('[name="first_name"]').val(),
                        email = $('[name="email"]').val(),
                        phone = $('[name="phone"]').val(),
                        start_date = $('[name="start_date"]').val(),
                        end_date = $('[name="end_date"]').val(),
                        total = $('[name="total"]').val(),
                        currency = $('.currency_code').val(),
                        guests = $('[name="guest_number"]').val(),
                        property_id = $('.property-field').val(),
                        token = $('[name="_token"]').val();
                if(first_name == ''){
                    $('.booking-data').show();
                    $('.booking-data .wrong-error').html('<?php echo e($static_data['strings']['fill_fields_to_book']); ?>');
                    $('.booking-form').removeClass('loading');
                }else if(!isEmail(email)){
                    $('.booking-data').show();
                    $('.booking-data .wrong-error').html('<?php echo e($static_data['strings']['email_invalid']); ?>');
                    $('.booking-form').removeClass('loading');
                }else if(phone == ''){
                    $('.booking-data').show();
                    $('.booking-data .wrong-error').html('<?php echo e($static_data['strings']['fill_fields_to_book']); ?>');
                    $('.booking-form').removeClass('loading');
                }else if(!isPhone(phone)){
                    $('.booking-data').show();
                    $('.booking-data .wrong-error').html('<?php echo e($static_data['strings']['phone_number_validation']); ?>');
                    $('.booking-form').removeClass('loading');
                }else{
                    $.ajax({
                        url: '<?php echo e(url('bookproperty')); ?>',
                        type: 'post',
                        data: {
                            first_name: first_name,
                            email: email,
                            property_id: property_id,
                            start_date: start_date,
                            end_date: end_date,
                            total: total,
                            guests: guests,
                            _token: token,
                            phone: phone,
                            currency: currency,
                        },
                        success: function (data) {
                            $('.booking-form').removeClass('loading');
                            $('.success-book').show();
                            $('.booking-data, .book-now').hide();
                            setTimeout(function () {
                                // window.location.reload()
                            }, 3000);
                        }, error: function (data) {
                            console.log(data);
                            $('.booking-form').removeClass('loading');
                            $('.booking-data').show();
                            $('.booking-data .wrong-error').html('<?php echo e($static_data['strings']['something_happened']); ?>');
                        }
                    });
                }
            });
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home_layout', ['static_data', $static_data], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>