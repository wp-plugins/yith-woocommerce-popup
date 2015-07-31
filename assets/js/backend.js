jQuery( document ).ready( function( $ ) {




    $( '.ypop-onoff-w span' ).on( 'click',  function() {
        var input = $( this ).prev( 'input' );
        var checked = input.attr( 'checked' );

        if( checked ) {
            input.attr( 'checked', false ).attr( 'value', 0 ).removeClass('onoffchecked');
        } else {
            input.attr( 'checked', true ).attr( 'value', 1 ).addClass('onoffchecked');
        }

        input.change();

        var status = (  typeof input.attr( 'checked' ) == 'undefined' ) ? 'disable' : 'enable';
        $.ajax({
            cache: false,
            data: 'post_id='+input.data('id')+'&action='+input.data('action')+'&status='+status,
            success: function(data, status, jqXHR){

            },
            url: ypop_backend.url
        });
    } );
} );