$(document).ready(function () {

    $('#share_update').focus(function () {
        if ( $(this).val() == 'Share an update' ) {
            $(this).css('color', '#000000').val('');
            $(this).autoResize({
                // On resize:
                onResize : function() {
                    $(this).css({opacity:0.8});
                },
                // After resize:
                animateCallback : function() {
                    $(this).css({opacity:1});
                },
                // Quite slow animation:
                animateDuration : 300
                // More extra space:
            });
        }
    }).blur(function () {
        if ( $(this).val() == '' ) {
            $(this).val('Share an update').css({'color':'#999999','height':'20px'});
        }
    });


});
