jQuery( function($){
    $( '.agency-item' ).click(function(){
        $('.agency-item').removeClass('active');
        $(this).addClass('active');
        var taxonomy = $(this).attr('value');
        var data = {
            'action': 'ref_filter',
            'tax': taxonomy
        };
        jQuery.post(ref_obj.ajaxurl, data, function(response) {
            $( '#real-estate-listing' ).html(response);
        });
    });
});