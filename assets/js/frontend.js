jQuery(document).ready(function($) {


    var display = 'load',
        exit_shown = false,
        form =  $('.ypop-container').find('form'),

        show_popup = function () {

            $('body').yit_popup({
                content : $('.ypop-container').html(),
                delay   : 0,
                position: 'center',
                mobile  : ypop_frontend_var.ismobile
            });

        };


    if( 'load' == display ){
        show_popup();
    }
    else if( 'leave-viewport' == display ){
        jQuery(document).mouseleave(function(){
            show_popup();
        })
    }
    else if( 'leave-page' == display ){

        window.onbeforeunload = function(e) {

            if(exit_shown === false) {
                e = e || window.event;

                exit_shown = true;
                setTimeout(show_popup, 500);
                if(e)
                    e.returnValue = ypop_frontend_var.leave_page_message;
                return ypop_frontend_var.leave_page_message;
            }
        };

        $('a, input, button').on( 'click', function(){
            window.onbeforeunload = null;
        });
    }
    else if( 'external-link' == display ){
        var external = false;
        $('a').on( 'click',  function (e) {
            if (external == false && this.host !== location.host) {
                e.preventDefault();
                show_popup();
                external = true;
            }
        });

    }

    $('body').on('close.ypop', function () {
        if ($('input.no-view').is(':checked')) {
            $.cookie(ypop_frontend_var.never_show_again_cookie_name, '1', {
                expires: parseInt(ypop_frontend_var.expired),
                path   : '/'
            })
        }
        else {
            $.cookie(ypop_frontend_var.show_next_time_cookie_name, '1', {path: '/'})
        }
    });

    if (form.length) {
        form.on('submit', function (e) {
            $.cookie(ypop_frontend_var.never_show_again_cookie_name, '1', {
                expires: parseInt(ypop_frontend_var.expired),
                path   : '/'
            });
        });
    }
});
