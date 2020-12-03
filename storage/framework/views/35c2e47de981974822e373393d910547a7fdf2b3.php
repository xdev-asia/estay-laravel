<?php $__env->startSection('title'); ?>
    <title><?php echo e($static_data['strings']['contact']); ?> - <?php echo e($static_data['site_settings']['site_name']); ?></title>
    <meta name="title" content="<?php echo e($static_data['strings']['contact']); ?> - <?php echo e($static_data['site_settings']['site_name']); ?>">
    <meta name="description" content="<?php echo e($static_data['site_settings']['site_description']); ?>">
    <meta name="keywords" content="<?php echo e($static_data['site_settings']['site_keywords']); ?>">
    <meta name="author" content="<?php echo e($static_data['site_settings']['site_name']); ?>">
    <meta property="og:title" content="<?php echo e($static_data['strings']['contact']); ?> - <?php echo e($static_data['site_settings']['site_name']); ?>" />
    <meta property="og:image" content="<?php echo e(URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bg'); ?>
    <?php echo e(URL::asset('/assets/images/home/').'/'.$static_data['design_settings']['slider_background']); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row  marginalized">
        <div class="col-sm-12">
            <h1 class="section-title-dark"><?php echo e($static_data['strings']['contact']); ?></h1>
        </div>
        <div class="col-sm-12"><div id="google-map"></div></div>
        <div class="col-md-4 col-sm-12 contact-info">
            <h2 class="section-type"><?php echo e($static_data['strings']['information']); ?></h2>
            <ul class="footer-menu">
                <?php if($static_data['site_settings']['location_address'] || $static_data['site_settings']['location_city'] || $static_data['site_settings']['location_country']): ?><li><a href="#"><i class="fa fa-home"></i> <?php echo e($static_data['site_settings']['location_address'].', '.$static_data['site_settings']['location_city'].' - '.$static_data['site_settings']['location_country']); ?></a></li><?php endif; ?>
                <?php if($static_data['site_settings']['contact_tel1']): ?><li><a href="tel:<?php echo e($static_data['site_settings']['contact_tel1']); ?>"><i class="fa fa-phone"></i> <?php echo e($static_data['site_settings']['contact_tel1']); ?></a></li><?php endif; ?>
                <?php if($static_data['site_settings']['contact_tel2']): ?><li><a href="tel:<?php echo e($static_data['site_settings']['contact_tel2']); ?>"><i class="fa fa-phone"></i> <?php echo e($static_data['site_settings']['contact_tel2']); ?></a></li><?php endif; ?>
                <?php if($static_data['site_settings']['contact_fax']): ?><li><a href="tel:<?php echo e($static_data['site_settings']['contact_fax']); ?>"><i class="fa fa-fax"></i> <?php echo e($static_data['site_settings']['contact_fax']); ?></a></li><?php endif; ?>
                <?php if($static_data['site_settings']['contact_email']): ?><li><a href="mailto:<?php echo e($static_data['site_settings']['contact_email']); ?>"><i class="fa fa-envelope"></i> <?php echo e($static_data['site_settings']['contact_email']); ?></a></li><?php endif; ?>
                <?php if($static_data['site_settings']['contact_web']): ?><li><a href="<?php echo e($static_data['site_settings']['contact_web']); ?>"><i class="fa fa-globe"></i> <?php echo e($static_data['site_settings']['contact_web']); ?></a></li><?php endif; ?>
            </ul>
            <ul class="social-icons">
                <?php if($static_data['site_settings']['social_facebook']): ?> <li><a href="<?php echo e($static_data['site_settings']['social_facebook']); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li> <?php endif; ?>
                <?php if($static_data['site_settings']['social_twitter']): ?> <li><a href="<?php echo e($static_data['site_settings']['social_twitter']); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
                <?php if($static_data['site_settings']['social_youtube']): ?>  <li><a href="<?php echo e($static_data['site_settings']['social_youtube']); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li><?php endif; ?>
                <?php if($static_data['site_settings']['social_instagram']): ?>  <li><a href="<?php echo e($static_data['site_settings']['social_instagram']); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li><?php endif; ?>
                <?php if($static_data['site_settings']['social_google_plus']): ?>  <li><a href="<?php echo e($static_data['site_settings']['social_google_plus']); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
                <?php if($static_data['site_settings']['social_pinterest']): ?>  <li><a href="<?php echo e($static_data['site_settings']['social_pinterest']); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li><?php endif; ?>
                <?php if($static_data['site_settings']['social_linkedin']): ?>  <li><a href="<?php echo e($static_data['site_settings']['social_linkedin']); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
                <?php if($static_data['site_settings']['social_tripadvisor']): ?>  <li><a href="<?php echo e($static_data['site_settings']['social_tripadvisor']); ?>" target="_blank"><i class="fa fa-tripadvisor"></i></a></li><?php endif; ?>
            </ul>
        </div>
        <div class="col-md-8 col-sm-12 contact-form input-style">
            <?php echo Form::open(['method' => 'post', 'url' => route('send_contact')]); ?>

            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group  <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                        <div class="input-group">
                            <span class="fa fa-user input-group-addon"></span>
                            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => $static_data['strings']['your_name']])); ?>

                        </div>
                        <span class="wrong-error"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group  <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                        <div class="input-group">
                            <span class="fa fa-envelope input-group-addon"></span>
                            <?php echo e(Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => $static_data['strings']['your_email']])); ?>

                        </div>
                        <span class="wrong-error"></span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group  <?php echo e($errors->has('subject') ? 'has-error' : ''); ?>">
                        <div class="input-group">
                            <span class="fa fa-font input-group-addon"></span>
                            <?php echo e(Form::text('subject', null, ['class' => 'form-control', 'required', 'placeholder' => $static_data['strings']['your_subject']])); ?>

                        </div>
                        <span class="wrong-error"></span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group  <?php echo e($errors->has('body') ? 'has-error' : ''); ?>">
                        <div class="input-group">
                            <span class="fa fa-commenting-o input-group-addon"></span>
                            <?php echo e(Form::textarea('body', null, ['class' => 'form-control', 'x4', 'required', 'placeholder' => $static_data['strings']['your_message']])); ?>

                        </div>
                        <span class="wrong-error"></span>
                    </div>
                </div>
                <?php if($static_data['site_settings']['reCaptcha']): ?>
                    <div class="col-sm-12" id="reCaptcha">
                        <div class="g-recaptcha" data-sitekey="<?php echo e($static_data['site_settings']['reCaptcha_api']); ?>"></div>
                        <span class="wrong-error"></span>
                    </div>
                <?php endif; ?>
                <div id="form-response" class="col-sm-12 mtop10">
                    <a href="#" class="primary-button send-form"><?php echo e($static_data['strings']['submit']); ?></a>
                    <p class="green-color field-info"></p>
                </div>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($static_data['site_settings']['google_map_key']); ?>&libraries=places"></script>
    <script src="<?php echo e(URL::asset('assets/js/plugins/richmarkers.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // Google Map
            if(typeof google !== 'undefined'){
                var map = new google.maps.Map(document.getElementById('google-map'), {
                    center:{
                        lat: <?php echo e($static_data['site_settings']['contact_map_lat']); ?>,
                        lng: <?php echo e($static_data['site_settings']['contact_map_lon']); ?>

                    },
                    mapTypeControl: false,
                    zoomControl: true,
                    scrollwheel: false,
                    zoom: <?php echo e($static_data['site_settings']['google_map_zoom']); ?>,
                    styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#6195a0"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":"0"},{"saturation":"0"},{"color":"#f5f5f2"},{"gamma":"1"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"lightness":"-3"},{"gamma":"1.00"}]},{"featureType":"landscape.natural.terrain","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#bae5ce"},{"visibility":"on"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#fac9a9"},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#4e4e4e"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#787878"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.station.airport","elementType":"labels.icon","stylers":[{"hue":"#0a00ff"},{"saturation":"-77"},{"gamma":"0.57"},{"lightness":"0"}]},{"featureType":"transit.station.rail","elementType":"labels.text.fill","stylers":[{"color":"#43321e"}]},{"featureType":"transit.station.rail","elementType":"labels.icon","stylers":[{"hue":"#ff6c00"},{"lightness":"4"},{"gamma":"0.75"},{"saturation":"-68"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#eaf6f8"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#c7eced"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"lightness":"-49"},{"saturation":"-53"},{"gamma":"0.79"}]}]
                });
                var position = new google.maps.LatLng(<?php echo e($static_data['site_settings']['contact_map_lat']); ?>, <?php echo e($static_data['site_settings']['contact_map_lon']); ?>);
                marker = new RichMarker({
                    position: position,
                    animation: google.maps.Animation.DROP,
                    map: map,
                    draggable: false,
                    shadow: 'none',
                    content: '<div class="map-marker"><i class="fa fa-home"></i></div>'
                });
            }

            <?php if($static_data['site_settings']['reCaptcha']): ?>
            // Contact mail
            $('.send-form').click(function(e){
                e.preventDefault();
                var token = $('[name="_token"]').val();
                $('#reCaptcha .wrong-error').hide();
                var captcha = grecaptcha.getResponse();
                if(captcha.length){
                    $.ajax({
                        url: '<?php echo e(route('reCaptcha')); ?>',
                        type: 'post',
                        data: {response: captcha, _token: token},
                        success: function(msg){
                            if(msg.status){
                                var name = $('[name="name"]').val(),
                                        email = $('[name="email"]').val(),
                                        subject = $('[name="subject"]').val(),
                                        body = $('[name="body"]').val();
                                $.ajax({
                                    url: '<?php echo e(url('mail/sendcontact')); ?>',
                                    type: 'post',
                                    data: {name: name, email: email, subject: subject, body: body, _token: token},
                                    beforeSend: function(){
                                        $('.contact-form').addClass('loading');
                                        $('.wrong-error').html('').hide();
                                    },
                                    success: function(data){
                                        if(data.status){
                                            $('#form-response .field-info').html(data.msg).show();
                                            $('.form-control').val('');
                                            setTimeout(function(){$('#form-response .field-info').slideUp()}, 6000);
                                        }else{
                                            $.each(data.errors, function(key, value){
                                                var parent = $('[name="'+ key +'"]').parents('.form-group');
                                                $('.wrong-error', parent).html(value).show();
                                            });
                                        }
                                        $('.contact-form').removeClass('loading');
                                    },
                                });
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
                var name = $('[name="name"]').val(),
                        email = $('[name="email"]').val(),
                        subject = $('[name="subject"]').val(),
                        body = $('[name="body"]').val(),
                        token = $('[name="_token"]').val();
                $.ajax({
                    url: '<?php echo e(url('mail/sendcontact')); ?>',
                    type: 'post',
                    data: {name: name, email: email, subject: subject, body: body, _token: token},
                    beforeSend: function(){
                        $('.contact-form').addClass('loading');
                        $('.wrong-error').html('').hide();
                    },
                    success: function(data){
                        if(data.status){
                            $('#form-response .field-info').html(data.msg).show();
                            $('.form-control').val('');
                            setTimeout(function(){$('#form-response .field-info').slideUp()}, 6000);
                        }else{
                            $.each(data.errors, function(key, value){
                                var parent = $('[name="'+ key +'"]').parents('.form-group');
                                $('.wrong-error', parent).html(value).show();
                            });
                        }
                        $('.contact-form').removeClass('loading');
                    },
                });
            });
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home_layout', ['static_data', $static_data], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>