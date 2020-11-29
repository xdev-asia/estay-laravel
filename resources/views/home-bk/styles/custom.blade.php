<style type="text/css">
    <?php $pc = get_setting('primary_color', 'style'); $pc_h = get_setting('primary_color_hover', 'style'); ?>
        @if($pc)
    ::selection{background: {{ $pc }} !important;}
    ::-moz-selection {background:  {{ $pc }} !important;}
    ::-webkit-scrollbar {background:  {{ $pc }} !important;}
    ::-webkit-scrollbar-thumb{background:  {{ $pc }} !important;}
    .primary-color{color: {{ $pc }} !important;}
    .primary-background{background:  {{ $pc }} !important;}
    .white-button:hover{background:  {{ $pc }} !important;border-color: {{ $pc }} !important;}
    .primary-button{background: {{ $pc }} !important;}
    .black-button:hover{background: {{ $pc }} !important;border-color: {{ $pc }} !important;}
    #top a:hover i{color: {{ $pc }} !important;}
    #top ul.top-menu > li i, #top ul.top-social > li i{color: {{ $pc }} !important;}
    .dropdown-menu{background-color: {{ $pc }} !important;}
    #header .main-menu li a::before{background: {{ $pc }} !important;}
    .slider-box .dropdown-slider-menu li a:hover *{color: {{ $pc }} !important;}
    .slider-box .dropdown-active::after{border-top-color: {{ $pc }} !important;}
    .featured-sign{background-color:  {{ $pc }} !important;}
    .quick-boxes .main-subheading{color: {{ $pc }} !important;}
    .slick-dots li span{background:  {{ $pc }} !important;}
    .slick-dots li:hover span{background:  {{ $pc }} !important;}
    .form-control:focus{border-color:  {{ $pc }} !important; }
    .main-container .header-tabs .nav-tabs li a.active{background:  {{ $pc }} !important; }
    .filter-box .dropdown-filter-menu li a:hover *{ color: {{ $pc }} !important; }
    .filter-box .dropdown-active::after{border-top-color: {{ $pc }} !important; }
    .thead-inverse th{background: {{ $pc }} !important;  }
    .contact-info .social-icons a{color: {{ $pc }} !important;}
    .main-container .social-icons li a:hover{background: {{ $pc }} !important; }
    .contact-info .footer-menu li a i{color:  {{ $pc }} !important; }
    .ui-tooltip{color:  {{ $pc }} !important; }
    .br-widget a::after{color:  {{ $pc }} !important;  }
    .noUi-connect{background: {{ $pc }} !important; }
    #ui-datepicker-div .ui-datepicker-header {background: {{ $pc }} !important; }
    .ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus{color:  {{ $pc }} !important; border-color: {{ $pc }} !important; }
    .map-marker {border-color: {{ $pc }} !important;}
    .map-marker:before {color: {{ $pc }} !important;}
    .map-marker:after {border-top-color: {{ $pc }} !important;}
    .pace .pace-progress{background: {{ $pc }} !important;}
    @endif


    @if($pc_h)
    .features .listing-data a:hover{color:  {{ $pc_h }} !important;}
    .primary-button:hover{background:  {{ $pc_h }} !important;}
    .map-marker:hover{border-color:  {{ $pc_h }} !important;  }
    .map-marker:hover::after{border-top-color: {{ $pc_h }} !important;  }
    .map-marker:hover::before{color:  {{ $pc_h }} !important;}
    .map-marker.hovered{border-color: {{ $pc_h }} !important;}
    .map-marker.hovered::after{border-top-color: {{ $pc_h }} !important;}
    .map-marker.hovered::before{color:  {{ $pc_h }} !important;}
    @endif
    .main-container .social-icons li a:hover .fa{color: white !important;}

    .features-filter-box{
        display: none;
        padding: 2px 0;
    }
    .features-filter-box input{
        width: auto !important;
    }
</style>