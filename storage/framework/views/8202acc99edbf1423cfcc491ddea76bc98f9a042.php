      <div class="item">
          <a href="<?php echo e(url('/property').'/'.$property->alias); ?>" class="item-img">
              
        <?php if(count($property->images)): ?>
                    <img class="responsive-img" src="<?php echo e(URL::asset('images/data').'/'.$property->images[0]->image); ?>"/>
        <?php else: ?>
                    <img class="item-thumb" src="<?php echo e(URL::asset('images/').'/no_image.jpg'); ?>"/>
        <?php endif; ?>

          </a>
          <div class="item-body">
            <span class="date"><img class="icon-ssm mr-1" src="assets/estay/images/icon/calendar.svg"/>18/01/2020 - 31/12/2020</span>
            <h3 class="item-title my-4">
              <a href="<?php echo e(url('/property').'/'.$property->alias); ?>"><?php echo e($property->contentload->name); ?></a>
            </h3>
            <div class="d-flex justify-content-between">
              <div class="price mr-2">
                
                <p class="lead mb-0"><?php echo e(currency((int)$property->price_per_night, $static_data['site_settings']['currency_code'], Session::get('currency'))); ?> <span class="currency"> <?php echo e($static_data['strings']['per_night']); ?></p>             
              </div>
              <div class="d-flex align-items-center">
                <a href="<?php echo e(url('/property').'/'.$property->alias); ?>" class="btn btn-estay-primary">Mua ngay</a>
              </div>
            </div>
          </div>
          <div class="item-footer"> 
            <div class="rating">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <span class="ml-2">(20 đánh giá)</span>
            </div>
            <div class="buyers">
              <img class="icon-ssm" src="assets/estay/images/icon/user.svg"/>
              50 người mua
            </div>
          </div>
        </div>

