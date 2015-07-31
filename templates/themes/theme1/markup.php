<?php
/**
 * Popup Theme 1 Template
 *
 * @author Yithemes
 * @package YITH WooCommerce Popup
 * @version 1.0.0
 */

if ( ! defined( 'YITH_YPOP_INIT' ) ) {
    exit;
} // Exit if accessed directly


$theme = '_theme1';
/* CONTENT */
$header = YITH_Popup()->get_meta( $theme.'_header', $popup_id);

/* LAYOUT */
$width                        = YITH_Popup()->get_meta( $theme . '_width', $popup_id );
$height                       = YITH_Popup()->get_meta( $theme . '_height', $popup_id );
$background_color             = YITH_Popup()->get_meta( $theme . '_body_bg_color', $popup_id );

$header_color                 = YITH_Popup()->get_meta( $theme . '_header_color', $popup_id );
$header_height                = YITH_Popup()->get_meta( $theme . '_header_height', $popup_id );
$header_background_image      = YITH_Popup()->get_meta( $theme . '_header_bg_image', $popup_id );

$footer_bg_color              = YITH_Popup()->get_meta( $theme . '_footer_bg_color', $popup_id );

$submit_button_color          = YITH_Popup()->get_meta( $theme . '_submit_button_color', $popup_id );
$submit_button_bg_color       = YITH_Popup()->get_meta( $theme . '_submit_button_bg_color', $popup_id );
$submit_button_bg_color_hover = YITH_Popup()->get_meta( $theme . '_submit_button_bg_color_hover', $popup_id );

$close_button_icon            = YITH_Popup()->get_meta( '_close_button_icon', $popup_id );
$close_button_bg_color        = YITH_Popup()->get_meta( '_close_button_background_color', $popup_id );

$content                      = YITH_Popup()->get_meta( $theme . '_content', $popup_id );
$content_type                 = YITH_Popup()->get_meta( '_content_type', $popup_id );
$footer_content               = YITH_Popup()->get_meta( $theme . '_footer_content', $popup_id );

$checkzone_bg_color           = YITH_Popup()->get_meta( '_checkzone_bg_color', $popup_id );
$checkzone_text_color         = YITH_Popup()->get_meta( '_checkzone_text_color', $popup_id );


$overlay_opacity =  YITH_Popup()->get_meta( '_overlay_opacity', $popup_id );

/* Close icon */
$close_button_icon_url = YITH_YPOP_ASSETS_URL.'/images/close-buttons/close1.png';
/* Content type */
$template_part = '';
$shortcode = '';
$args = array(
    'popup_id' => $popup_id,
    'theme' => $theme
);

switch ( $content_type ):
    case 'newsletter':
        $newsletter_integration = YITH_Popup()->get_meta( '_newsletter-integration', $popup_id );

        $template_part = '/newsletters/'. $newsletter_integration.'.php';
        break;

    case 'woocommerce':
        $template_part = '/misc/woocommerce.php';
        $args['product_from'] = 'product';
        $args['products'] = YITH_Popup()->get_meta( '_ypop_products', $popup_id );
        $args['category'] = YITH_Popup()->get_meta( '_ypop_category', $popup_id );
        $args['show_title'] = YITH_Popup()->get_meta( '_show_title', $popup_id );
        $args['show_thumbnail'] = YITH_Popup()->get_meta( '_show_thumbnail', $popup_id );
        $args['show_price'] = YITH_Popup()->get_meta( '_show_price', $popup_id );
        $args['show_add_to_cart'] = YITH_Popup()->get_meta( '_show_add_to_cart', $popup_id );
        $args['add_to_cart_label'] = YITH_Popup()->get_meta( '_add_to_cart_label', $popup_id );
        $args['show_summary'] = YITH_Popup()->get_meta( '_show_summary', $popup_id );

        break;
    default:
endswitch;
?>
<style>
    .ypop-overlay{
        background-color: #000;
        opacity: <?php echo $overlay_opacity/100 ?>;
    }

    .ypop-wrapper{
        width: <?php echo $width  ?>px;
        height: <?php echo ($height) ? $height .'px': 'auto' ?>;
        padding: 10px;
    }
    .ypop-container-inner{
        background-color: <?php echo $background_color ?>;
    }


    .ypop-header{
        height: <?php echo $header_height ?>px;
        background-image: url(<?php echo $header_background_image ?>);

    }
    .ypop-title{
        color: <?php echo $header_color ?>;
    }

    .ypop-wrapper button,
    .ypop-content-type .contact-form input[type=submit]{
        background-image: none;
        background-color: <?php echo $submit_button_bg_color ?>;
        color: <?php echo $submit_button_color ?>
    }
    .ypop-wrapper button:hover, .ypop-wrapper button:active,
    .ypop-content-type .contact-form input[type=submit]:hover, .ypop-content-type .contact-form input[type=submit]:active{
        background-color: <?php echo $submit_button_bg_color_hover ?>;
    }

    .ypop-footer{
        background-color: <?php echo $footer_bg_color ?>;
    }

    .ypop-wrapper a.close{
        background-image: url(<?php echo $close_button_icon_url ?>);
        background-color: #ff8a00;
        background-position: center center ;
        background-repeat: no-repeat;
    }

    .ypop-checkzone {
        background-color: <?php echo $checkzone_bg_color ?>;
        color:  <?php echo $checkzone_text_color ?>;
    }

</style>
<div class="ypop-modal">
	<div class="ypop-overlay"></div>
	<div class="ypop-wrapper">
		<!-- yit-newsletter-popup -->
		<div class="ypop-container">
            <div class="ypop-container-inner">
                <div class="ypop-header">
                    <h2 class="ypop-title"><?php echo $header ?></h2>
                </div>

                <div class="ypop-content-wrapper">
                    <div class="ypop-content">
                        <?php echo do_shortcode( $content ) ?>

                        <div class="ypop-content-type">
                            <?php
                            if ( $template_part != '' ) {
                                yit_plugin_get_template( YITH_YPOP_DIR, $template_part, $args );
                            } elseif ( $shortcode != '' ) {
                                echo do_shortcode( $shortcode );
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- ypop-border -->
                <div class="ypop-footer">
                    <?php echo do_shortcode( $footer_content ) ?>
                </div>
                <div class="ypop-checkzone">
                    <label for="hideforever">
                        <input type="checkbox" id="hideforever" name="no-view" class="no-view yith-popup-checkbox"><span>&nbsp;</span><?php echo $hiding_text ?>
                    </label>
                </div>
            </div>
		</div>
		<!-- ypop-container -->
		<!-- END yit-newsletter-popup -->
	</div>
</div>