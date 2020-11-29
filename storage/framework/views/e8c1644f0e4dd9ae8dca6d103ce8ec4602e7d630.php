<div class="item box-shadow">
    <div id="carousel_-<?php echo e($service->id); ?>" class="main-image bg-overlay carousel slide" data-ride="carousel" data-interval="false">
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
            <a class="carousel-control-prev" href="#carousel_-<?php echo e($service->id); ?>" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only"><?php echo e($static_data['strings']['previous']); ?></span>
            </a>
            <a class="carousel-control-next" href="#carousel_-<?php echo e($service->id); ?>" role="button" data-slide="next">
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
        <div class="item-category"><?php echo e($service->category->contentload->name.' - '.$service->ser_location->contentload->location); ?></div>
        <?php if($service->user): ?><div class="small-text"><?php echo e($static_data['strings']['posted_by'] .': '. $service->user->username); ?></div><?php endif; ?>
    </div>
</div>