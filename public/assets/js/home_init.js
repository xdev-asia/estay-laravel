// Onload functions
$('document').ready(function(){

    $(".dropdown-toggle").dropdown();
    var w_height = $(window).height();
    if(w_height < 768){
        $('#slider').css('padding-top', '40px');
    }else{
        $('#slider').css('padding-top', w_height / 6);
    }
    // Close Dropdown on clikc outside
    $('body').click(function(){
        $(".dropdown-active").removeClass('dropdown-active');
    });
    $(window).on('resize', function(){
        var win = $(this); //this = window
        if(win.height() < 768){
            $('#slider').css('padding-top', '40px');
        }else{
            $('#slider').css('padding-top', win.height() / 6);
        }
    });

    // Mobile Menu
    $('.mobile-menu-button').click(function(e){
       e.preventDefault();
    });
    $('.mobile-menu').slideReveal({
        width: 200,
        position: 'right',
        push: false,
        closeOnClick: true,
        trigger: $('.mobile-menu-button'),
        overlay: true,
    });

    // Slider Dropdown menu
    $('.slider-box .form-group').click(function(e){
        e.stopPropagation();
        $(".dropdown-active").not(this).removeClass('dropdown-active');
        $(this).toggleClass('dropdown-active');
    });
    // Slider Dropdown Menu click
    $('.slider-box .dropdown-slider-menu li').click(function(e){
        e.preventDefault();
        var parent = $(this).parents('.form-group');
        $('.slider-hidden', parent).val($(this).data('id'));
        $('.slider-field', parent).val($(this).data('name'));
    });

    // Slider Dropdown menu
    $('.filter-box .form-group').click(function(e){
        e.stopPropagation();
        $(".dropdown-active").not(this).removeClass('dropdown-active');
        $(this).toggleClass('dropdown-active');
    });

    $(document).on('mouseenter', '.item', function() {
        $('.map-marker[data-id="' + $(this).attr('data-id') + '"]').addClass('hovered');
    });
    $(document).on('mouseleave', '.item', function() {
        $('.map-marker[data-id="' + $(this).attr('data-id') + '"]').removeClass('hovered');
    });

    // Smooth Scrolling
    $('a[href*="#"]:not([href="#"]):not([href^="#confirm-"]):not([href^="#carousel-"]):not([href^="#accordion-"]):not([href*="-picker"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 50
                }, 1000);
                return false;
            }
        }
    });

    $('.language-switcher').click(function(e){
        e.preventDefault();
        var code = $(this).data('code'),
            token = $('[name="_token"]').val();
        if(typeof token === 'undefined'){
            token = $('.token').val();
        }
        $.ajax({
            url: '/user/changeLanguage',
            type: 'post',
            data: {code: code, _token: token},
            success: function(){
                location.reload();
            },
            error: function(){
                location.reload();
            }
        });
    });

    $('.currency-switcher').click(function(e){
        e.preventDefault();
        var code = $(this).data('code'),
            token = $('[name="_token"]').val();
        if(typeof token === 'undefined'){
            token = $('.token').val();
        }
        $.ajax({
            url: '/user/changeCurrency',
            type: 'post',
            data: {code: code, _token: token},
            success: function(){
               location.reload();
            },
            error: function(){
               location.reload();
            }
        });
    });

    // Rooms and Guests picker
    $('.room_number_picker').click(function(e){
        e.preventDefault();
        $('[name="rooms_value"]').val($(this).parent().data('number'));
        $('[name="rooms"]').val($(this).parent().data('number'));
    });
    $('.guest_number_picker').click(function(e){
        e.preventDefault();
        $('[name="guest_number_value"]').val($(this).parent().data('number'));
        $('[name="guest_number"]').val($(this).parent().data('number'));
    });
    $('.location_id_picker').click(function(e){
        e.preventDefault();
        $('[name="location_id_value"]').val($(this).parent().data('name'));
        $('[name="location_id"]').val($(this).parent().data('id'));
    });
    $('.category_id_picker').click(function(e){
        e.preventDefault();
        $('[name="category_id_value"]').val($(this).parent().data('name'));
        $('[name="category_id"]').val($(this).parent().data('id'));
    });
    $('.sort_id_picker').click(function(e){
        e.preventDefault();
        $('[name="sort_id_value"]').val($(this).parent().data('name'));
        $('[name="sort_id"]').val($(this).parent().data('id'));
    });

    // Tooltips
    if($('.tooltip-feature').length){
        $('.tooltip-feature').tooltip({
            position: {
                my: "center bottom-20",
                at: "center top"
            }
        });
    }

    $('.featured-grid-properties').slick({
        dots: false,
        infinite: true,
        speed: 300,
        arrows: false,
        autoplay: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
            }
        }]
    });

    $('.featured-grid-services').slick({
        dots: false,
        infinite: true,
        speed: 300,
        arrows: false,
        autoplay: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
            }
        }]
    });

    $('#featured-properties').slick({
        dots: true,
        infinite: true,
        speed: 300,
        arrows: false,
        autoplay: false,
        slidesToShow: 3,
        appendDots: '.dots-navigation-1',
        slidesToScroll: 2,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true
            }
        }]
    });

    $('#half-map-featured').slick({
        dots: true,
        infinite: true,
        speed: 300,
        arrows: false,
        autoplay: true,
        slidesToShow: 2,
        appendDots: '.dots-navigation-1',
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true
            }
        }]
    });

    $('.review-description a').click(function(e){
        e.preventDefault();
    });

    // Fixed Header
    if($('.sticky-header').length){
        var height = $('#header').outerHeight();
        var stickyOffset = $('.sticky-header').offset().top;
        var previousScroll = 0;
        if($(window).scrollTop() >= stickyOffset){
            $('sticky-header').addClass('fixed-header box-shadow')
            $('#header-phantom').css('height', height).removeClass('hidden');
        }
        $(window).scroll(function(){
            var sticky = $('.sticky-header'),
                scroll = $(window).scrollTop();

            if (scroll >= stickyOffset){
                if(scroll > previousScroll){
                    sticky.removeClass('fixed-header box-shadow');
                    $('#header-phantom').css('height', height).addClass('hidden');
                }else{
                    sticky.addClass('fixed-header box-shadow');
                    $('#header-phantom').css('height', height).removeClass('hidden');
                }
            } else{
                sticky.removeClass('fixed-header box-shadow');
                $('#header-phantom').css('height', height).addClass('hidden');
            }

            previousScroll = scroll;

        });
    }

});
// Global variables
var map, infoBubble, mapClusters, allmarkers = [], fmarkers = [];
Pace.on("done", function(){
    $(".cover").fadeOut(500);
});
// Price Range generator
function price_range(max){
    // Price range
    if(document.getElementById('price-range') !== null){
        var price_range = document.getElementById('price-range');
        noUiSlider.create(price_range, {
            start: [0, max],
        connect: true,
            range: {
            'min': 0,
            'max': max
        }
    });
        var input_min = $('.price-range span.min'),
            input_max = $('.price-range span.max'),
            hidden_min = $('[name="price_min"]'),
            hidden_max = $('[name="price_max"]'),
            inputs = [input_min, input_max],
            hiddens = [hidden_min, hidden_max];
        price_range.noUiSlider.on('update', function(values, handle){
            var value = Math.round(values[handle]);
            hiddens[handle].val(value);
            inputs[handle].text(value);
        });
    }

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(){
        $('.featured-grid-services').slick("getSlick").refresh()
    });

}

function explore_map(map_lat, map_lon, markers, infoWindowContent, type){
        // Generate the map
        map = new google.maps.Map(document.getElementById('google-map'), {
            center:{
                lat: map_lat,
                lng: map_lon,
         },
            mapTypeControl: false,
            zoomControl: true,
            scrollwheel: false,
            zoomControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            zoom: 5,
            streetViewControl: false,
            styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#6195a0"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":"0"},{"saturation":"0"},{"color":"#f5f5f2"},{"gamma":"1"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"lightness":"-3"},{"gamma":"1.00"}]},{"featureType":"landscape.natural.terrain","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#bae5ce"},{"visibility":"on"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#fac9a9"},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#4e4e4e"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#787878"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.station.airport","elementType":"labels.icon","stylers":[{"hue":"#0a00ff"},{"saturation":"-77"},{"gamma":"0.57"},{"lightness":"0"}]},{"featureType":"transit.station.rail","elementType":"labels.text.fill","stylers":[{"color":"#43321e"}]},{"featureType":"transit.station.rail","elementType":"labels.icon","stylers":[{"hue":"#ff6c00"},{"lightness":"4"},{"gamma":"0.75"},{"saturation":"-68"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#eaf6f8"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#c7eced"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"lightness":"-49"},{"saturation":"-53"},{"gamma":"0.79"}]}],
        });
        var bounds = new google.maps.LatLngBounds();
        // Display multiple markers on a map
        var infoWindow = new google.maps.InfoWindow(), marker, i;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
        }

        infoBubble = new InfoBubble({
            shadowStyle: 0,
            padding: 0,
            backgroundColor: 'rgb(255,255,255)',
            borderRadius: 0,
            arrowSize: 20,
            borderWidth: 1,
            maxWidth: 280,
            maxHeight: 55,
            borderColor: '#cecece',
            hideCloseButton: true,
            arrowPosition: 20,
            anchorHeight: 200,
            arrowStyle: 0
        });

        // Loop through our array of markers & place each one on the map
        for(i = 0; i < markers.length; i++ ) {

            var position = new google.maps.LatLng(markers[i][0], markers[i][1]);
            bounds.extend(position);

            var featured = (infoWindowContent[i][0].featured == 1) ? 'featured' : '';
            var img = '/images/data/'+infoWindowContent[i][0].image;
            // Create marker
            marker = new RichMarker({
                    position: position,
                    map: map,
                    infowindow: '<div class="map-info-window"><div class="map-info-window-inner"><div class="map-info-window-details"> <a href="/'+ type +'/'+ infoWindowContent[i][0].alias +'"><h3>'+ infoWindowContent[i][0].name +'</h3></a><p>'+ infoWindowContent[i][0].address + ' ' + infoWindowContent[i][0].city + ', '+ infoWindowContent[i][0].country +'</p></div><div class="map-info-window-image"><img src="'+ img +'" alt="'+ infoWindowContent[i][0].name +'" class="img-fluid"></div></div></div>',
                    title: infoWindowContent[i][0].name,
                    shadow: 'none',
                    content: '<div class="map-marker ' + featured + '" data-id="' + infoWindowContent[i][0].id + '"><i class="fa '+ infoWindowContent[i][0].icon +'"></i></div>'
            });
            if(infoWindowContent[i][0].featured == 1){
                fmarkers.push(marker);
            }
            allmarkers.push(marker);
            // Allow each marker to have an info window
            google.maps.event.addListener(marker, 'click', function() {
                infoBubble.setContent(this.infowindow);
                infoBubble.open(map, this);
            });
            google.maps.event.addListener(map, 'click', function() {
                infoBubble.close();
            });
        }

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
        var options = {
            imagePath: '/images/home/icons/m'
        };
        mapClusters = new MarkerClusterer(map, allmarkers, options);

}

function removeMarkers(){
    for(var i = 0; i < allmarkers.length; i++){
        allmarkers[i].setMap(null);
    }
    allmarkers = [];
    mapClusters.clearMarkers();
}
function addMarkerToMap(lat, long, infoWindowContent, type) {
    var condition = 1;
    var position = new google.maps.LatLng(lat, long);
    if(fmarkers.length){
        for(var j = 0; j < fmarkers.length; j++){
            if(position.equals(fmarkers[j].getPosition())){
                condition = 0;
                return false;
            }
        }
    }
    if(condition){
        var bounds = new google.maps.LatLngBounds();
        bounds.extend(position);

        var featured = (infoWindowContent[0].featured == 1) ? 'featured' : '';
        var img = '/images/data/'+infoWindowContent[0].image;

        marker = new RichMarker({
            position: position,
            map: map,
            infowindow: '<div class="map-info-window"><div class="map-info-window-inner"><div class="map-info-window-details"> <a href="/'+ type +'/'+ infoWindowContent[0].alias +'"><h3>'+ infoWindowContent[0].name +'</h3></a><p>'+ infoWindowContent[0].address + ' ' + infoWindowContent[0].city + ', '+ infoWindowContent[0].country +'</p></div><div class="map-info-window-image"><img src="'+ img +'" alt="'+ infoWindowContent[0].name +'" class="img-fluid"></div></div></div>',
            title: infoWindowContent[0].name,
            shadow: 'none',
            content: '<div class="map-marker ' + featured + '" data-id="' + infoWindowContent[0].id + '"><i class="fa '+ infoWindowContent[0].icon +'"></i></div>'
        });
        if(infoWindowContent[0].featured == 1){
            fmarkers.push(marker);
        }
        allmarkers.push(marker);
        var options = {
            imagePath: '/images/home/icons/m'
        };
        mapClusters.addMarker(marker);
        // Allow each marker to have an info window
        google.maps.event.addListener(marker, 'click', function() {
            infoBubble.setContent(this.infowindow);
            infoBubble.open(map, this);
        });
        google.maps.event.addListener(map, 'click', function() {
            infoBubble.close();
        });
    }else{
        return 0;
    }
}

Date.prototype.addDays = function(days) {
    var dat = new Date(this.valueOf());
    dat.setDate(dat.getDate() + days);
    return dat;
};

Date.prototype.ddmmyyyy = function() {
    var mm = this.getMonth() + 1; // getMonth() is zero-based
    var dd = this.getDate();

    return [(mm>9 ? '' : '0') + mm,
        (dd>9 ? '' : '0') + dd,
        this.getFullYear()
    ].join('/');
};

function getDates(startDate, stopDate) {
    var dateArray = [];
    var currentDate = startDate;
    while (currentDate <= stopDate) {
        var x = new Date (currentDate);
        dateArray.push(x.ddmmyyyy());
        currentDate = currentDate.addDays(1);
    }
    return dateArray;
}
function toDate(dateStr) {
    var parts = dateStr.split("/");
    return new Date(parts[2], parts[1] - 1, parts[0]);
}
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function isPhone(email) {
    var regex = /^\+?(\d|\-|\ ){1,20}$/;
    return regex.test(email);
}