<?php if(!isset($class)) $class="col-md-4 col-sm-6 items-grid"; ?>
<div class="<?php echo e($class); ?>">
    <div class="item box-shadow">
        <div id="carousel-<?php echo e($property->id); ?>" class="main-image bg-overlay carousel slide" data-ride="carousel" data-interval="false">
            <?php if($property->featured): ?>
                <div class="featured-sign">
                    <?php echo e($static_data['strings']['featured']); ?>

                </div>
            <?php endif; ?>
            <div class="price">
                <span class="currency"></span> <?php echo e(currency((int)$property->price_per_night, $static_data['site_settings']['currency_code'], Session::get('currency'))); ?> <span class="currency"> <?php echo e($static_data['strings']['per_night']); ?></span>
            </div>
            <?php if(count($property->images)): ?>
                <div class="carousel-inner" role="listbox">
                    <?php $c = 0; ?>
                    <?php $__currentLoopData = $property->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <div class="carousel-item <?php if(!$c): ?> active <?php $c++; ?> <?php endif; ?>">
                            <img class="responsive-img" src="<?php echo e(URL::asset('images/data').'/'.$image->image); ?>"/>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </div>
                <a class="carousel-control-prev" href="#carousel-<?php echo e($property->id); ?>" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only"><?php echo e($static_data['strings']['previous']); ?></span>
                </a>
                <a class="carousel-control-next" href="#carousel-<?php echo e($property->id); ?>" role="button" data-slide="next">
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
            <a href="<?php echo e(url('/property').'/'.$property->alias); ?>"><h3 class="item-title primary-color"><?php echo e($property->contentload->name); ?></h3></a>
            <div class="item-category"><?php echo e($property->location['address'].', '.$property->location['city'] .' - '. $property->location['country']); ?></div>
            <div class="item-category"><?php echo e($static_data['strings']['category'] .': '. $property->category->contentload->name .' | '); ?>

                <?php echo e($static_data['strings']['location'] .': '. $property->prop_location->contentload->location); ?></div>
            <div class="item-category"><?php echo e($static_data['strings']['size'] .': '. $property->property_info['size'] . ' '. $static_data['site_settings']['measurement_unit']. ' | '); ?>

                <?php echo e($static_data['strings']['rooms'] .': '. $property->rooms .' | '); ?>

                <?php echo e($static_data['strings']['guests'] .': '. $property->guest_number); ?></div>
            <?php if($property->user): ?><div class="small-text"><?php echo e($static_data['strings']['posted_by'] .': '. $property->user->username); ?></div><?php endif; ?>
        </div>
    </div>
</div>