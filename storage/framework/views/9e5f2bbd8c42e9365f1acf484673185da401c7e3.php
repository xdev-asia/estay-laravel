<style type="text/css">
    <?php $pc = get_setting('primary_color', 'style'); $pc_h = get_setting('primary_color_hover', 'style'); ?>
        <?php if($pc): ?>
    ::selection{background: <?php echo e($pc); ?> !important;}
    ::-moz-selection {background:  <?php echo e($pc); ?> !important;}
    ::-webkit-scrollbar {background:  <?php echo e($pc); ?> !important;}
    ::-webkit-scrollbar-thumb{background:  <?php echo e($pc); ?> !important;}
    .primary-color{color: <?php echo e($pc); ?> !important;}
    .primary-background{background:  <?php echo e($pc); ?> !important;}
    .white-button:hover{background:  <?php echo e($pc); ?> !important;border-color: <?php echo e($pc); ?> !important;}
    .primary-button{background: <?php echo e($pc); ?> !important;}
    .black-button:hover{background: <?php echo e($pc); ?> !important;border-color: <?php echo e($pc); ?> !important;}
    #top a:hover i{color: <?php echo e($pc); ?> !important;}
    #top ul.top-menu > li i, #top ul.top-social > li i{color: <?php echo e($pc); ?> !important;}
    .dropdown-menu{background-color: <?php echo e($pc); ?> !important;}
    #header .main-menu li a::before{background: <?php echo e($pc); ?> !important;}
    .slider-box .dropdown-slider-menu li a:hover *{color: <?php echo e($pc); ?> !important;}
    .slider-box .dropdown-active::after{border-top-color: <?php echo e($pc); ?> !important;}
    .featured-sign{background-color:  <?php echo e($pc); ?> !important;}
    .quick-boxes .main-subheading{color: <?php echo e($pc); ?> !important;}
    .slick-dots li span{background:  <?php echo e($pc); ?> !important;}
    .slick-dots li:hover span{background:  <?php echo e($pc); ?> !important;}
    .form-control:focus{border-color:  <?php echo e($pc); ?> !important; }
    .main-container .header-tabs .nav-tabs li a.active{background:  <?php echo e($pc); ?> !important; }
    .filter-box .dropdown-filter-menu li a:hover *{ color: <?php echo e($pc); ?> !important; }
    .filter-box .dropdown-active::after{border-top-color: <?php echo e($pc); ?> !important; }
    .thead-inverse th{background: <?php echo e($pc); ?> !important;  }
    .contact-info .social-icons a{color: <?php echo e($pc); ?> !important;}
    .main-container .social-icons li a:hover{background: <?php echo e($pc); ?> !important; }
    .contact-info .footer-menu li a i{color:  <?php echo e($pc); ?> !important; }
    .ui-tooltip{color:  <?php echo e($pc); ?> !important; }
    .br-widget a::after{color:  <?php echo e($pc); ?> !important;  }
    .noUi-connect{background: <?php echo e($pc); ?> !important; }
    #ui-datepicker-div .ui-datepicker-header {background: <?php echo e($pc); ?> !important; }
    .ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus{color:  <?php echo e($pc); ?> !important; border-color: <?php echo e($pc); ?> !important; }
    .map-marker {border-color: <?php echo e($pc); ?> !important;}
    .map-marker:before {color: <?php echo e($pc); ?> !important;}
    .map-marker:after {border-top-color: <?php echo e($pc); ?> !important;}
    .pace .pace-progress{background: <?php echo e($pc); ?> !important;}
    <?php endif; ?>


    <?php if($pc_h): ?>
    .features .listing-data a:hover{color:  <?php echo e($pc_h); ?> !important;}
    .primary-button:hover{background:  <?php echo e($pc_h); ?> !important;}
    .map-marker:hover{border-color:  <?php echo e($pc_h); ?> !important;  }
    .map-marker:hover::after{border-top-color: <?php echo e($pc_h); ?> !important;  }
    .map-marker:hover::before{color:  <?php echo e($pc_h); ?> !important;}
    .map-marker.hovered{border-color: <?php echo e($pc_h); ?> !important;}
    .map-marker.hovered::after{border-top-color: <?php echo e($pc_h); ?> !important;}
    .map-marker.hovered::before{color:  <?php echo e($pc_h); ?> !important;}
    <?php endif; ?>
    .main-container .social-icons li a:hover .fa{color: white !important;}

    .features-filter-box{
        display: none;
        padding: 2px 0;
    }
    .features-filter-box input{
        width: auto !important;
    }
</style>