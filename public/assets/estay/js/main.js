$(document).ready(function() {
    $(function() {
      $('input[name="daterange"]').daterangepicker({
        opens: 'center',
        drops: 'up',
        locale: {
          format: 'DD/MM/YYYY'
          }
      }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
      });
    });
    
    $(function() {
      $('input[name="listingdaterange"]').daterangepicker({
        opens: 'center',
        drops: 'down',
        locale: {
          format: 'DD/MM/YYYY'
          }
      }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
      });
    });

    $("#dropdownOpen").click(function(e){
      e.stopPropagation();
   })

   $('[data-toggle="collapse"]').click(function() {
      $(this).toggleClass( "active" );
      if ($(this).hasClass("active")) {
        $(this).text("- Đóng lựa chọn");
      } else {
        $(this).text("+ Thêm lựa chọn");
      }
    });

    $('#btnShowSearch').click(function(){
      $('.list-wrap-search').slideToggle();
    })
    $('#btnShowMap').click(function(){
      $('.map-container ').css({
        'width':'100%',
        'z-index':'3',
        'opacity':'1'
      });
      $('body').css({
        'overflow':'hidden'
      });
      $('#closeMap').show()
    })
    $('#closeMap').click(function(){
      $('.map-container ').css({
        'z-index':'1',
        'opacity':'0'
      });
      $('body').css({
        'overflow':'auto'
      });
      $(this).hide();
    })
    // gallerySlider
    if($('#gallerySlider').length){
      $('#gallerySlider').slick({
        infinite: true,
        slidesToShow: 1.15,
        slidesToScroll: 1,
        
      });        
    };
    
    $('.btn-theme-setting').click(function(){
      $('.theme-setting').toggleClass('active');
    })

    // chatbox
    $(".btn-chat").click(function(){
      $('.chatbox-wrapper').toggleClass('show');
    })
    
        // gallerySlider
        if($('#galleryImage').length){
          $('#galleryImage').Mosaic({
            innerGap: 10
          });      
        };


  });