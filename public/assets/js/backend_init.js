// Select all checkboxs
$('#select-all').click(function(e){
    var table = $(e.target).closest('table');
    $('td input:checkbox',table).prop('checked',this.checked);
});

// Checkbox Selected
$('.switch').change(function(){
    var selector = $('#activeSwitch', this);
    selector.prop('checked') ? selector.val('1') : selector.val('0');
});

Pace.on("done", function(){
    $(".cover").fadeOut(500);
});

// Onload Functions
$(document).ready(function(){
    // Checkbox fix
    var selector = $('.switch input[type="checkbox"]');
    selector.prop('checked') ? selector.val(1) : selector.val(0);

    // Summernote disable tooltip
    $('.note-editor').mouseenter(function(){
        $('[data-toggle="tooltip"]', this).tooltip('disable');
    });

});
