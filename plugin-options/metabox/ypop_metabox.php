<?php
/**
 * Created by PhpStorm.
 * User: Your Inspiration
 * Date: 20/01/2015
 * Time: 12:04
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly



$type_of_content = array(
    'newsletter' => __( 'Newsletter', 'ypop' ),
);

if ( function_exists( 'WC' ) ) {
    $type_of_content['woocommerce'] = __( 'WooCommerce', 'ypop' );
}

$integration_types =  YITH_Popup_Newsletter()->get_integration();
$options = array(
    'label'    => __( 'Popup Settings', 'ypop' ),
    'pages'    => 'yith_popup',
    'context'  => 'normal', //('normal', 'advanced', or 'side')
    'priority' => 'default',
    'tabs' => array(
        /*************************************
         * CONTENT TAB
         *************************************/
        'content'       => array(
            'label'  => __( 'Content', 'ypop' ),
            'fields' => apply_filters( 'ypop_content_metabox', array(

                /*************************************
                 * GENERAL OPTIONS
                 *************************************/
                'enable_popup'   => array(
                    'label'   => __( 'Enable popup', 'ypop' ),
                    'desc'    => '',
                    'type'    => 'onoff',
                    'std'     => 'yes'

                ),
                'content_type'   => array(
                    'label'   => __( 'Content type', 'ypop' ),
                    'desc'    => __( 'Select the type of the content', 'ypop' ),
                    'type'    => 'select',
                    'std'     => 'newsletter',
                    'options' => $type_of_content
                ),

                /*************************************
                 * THEME 1 CONTENT
                 *************************************/
                'theme1_header'         => array(
                    'label' => __( 'Header', 'ypop' ),
                    'type'  => 'text',
                    'desc'  => __( 'Add the header content of the popup', 'ypop' ),
                    'std'   => __( 'SIGN UP TO OUR NEWSLETTER AND SAVE 25% OFF FOR YOUR NEXT PURCHASE', 'ypop' ),
                    'deps'  => array(
                        'ids'    => '_template_name',
                        'values' => 'theme1',
                    )
                ),
                'theme1_content'        => array(
                    'label' => __( 'Content', 'ypop' ),
                    'type'  => 'textarea-editor',
                    'desc'  => __( 'Add the content of the popup', 'ypop' ),
                    'std'   => '<h3>Increase more than 500% of Email Subscribers!</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis viverra, urna vitae vehicula congue, purus nibh vestibulum lacus, sit amet tristique ante odio.</p>',
                    'deps'  => array(
                        'ids'    => '_template_name',
                        'values' => 'theme1',
                    )
                ),
                'theme1_footer_content' => array(
                    'label' => __( 'Footer content', 'ypop' ),
                    'type'  => 'textarea-editor',
                    'desc'  => __( 'Add the footer of the popup', 'ypop' ),
                    'std'   => '<img src="' . YITH_YPOP_TEMPLATE_URL . '/themes/theme1/images/icon-lock.png"> Your Information will never be shared with any third party.',
                    'deps'  => array(
                        'ids'    => '_template_name',
                        'values' => 'theme1',
                    )
                ),

            ) )
        ),
        /*************************************
         * LAYOUT TAB
         *************************************/
        'layout'        => array(
            'label'  => __( 'Layout', 'ypop' ),
            'fields' => apply_filters( 'ypop_layout_metabox', array(

                /*************************************
                 * THEME 1 LAYOUT
                 *************************************/

                'theme1_width'                        => array(
                    'label' => __( 'Width', 'ypop' ),
                    'type'  => 'number',
                    'desc'  => __( 'Select the width of the popup.', 'ypop' ),
                    'min'   => 10,
                    'max'   => 2000,
                    'std'   => 550,
                    'deps'  => array(
                        'ids'    => '_template_name',
                        'values' => 'theme1',
                    )
                ),
                'theme1_height'                       => array(
                    'label' => __( 'Height', 'ypop' ),
                    'type'  => 'number',
                    'desc'  => __( 'Select the height of the popup. Leave 0 to set it automatically', 'ypop' ),
                    'min'   => 0,
                    'max'   => 2000,
                    'std'   => 0,

                    'deps'  => array(
                        'ids'    => '_template_name',
                        'values' => 'theme1',
                    )
                ),
                'theme1_body_bg_color'                => array(
                    'label' => __( 'Background color', 'ypop' ),
                    'desc'  => __( 'Select the background color of the popup', 'ypop' ),
                    'type'  => 'colorpicker',
                    'std'   => '#ffffff',
                    'deps'  => array(
                        'ids'    => '_template_name',
                        'values' => 'theme1',
                    )
                ),
                'theme1_header_bg_image'              => array(
                    'label' => __( 'Header background image', 'ypop' ),
                    'desc'  => __( 'Select the background image for the header', 'ypop' ),
                    'type'  => 'upload',
                    'std'   => YITH_YPOP_TEMPLATE_URL . '/themes/theme1/images/header.png',
                    'deps'  => array(
                        'ids'    => '_template_name',
                        'values' => 'theme1',
                    )
                ),
                'theme1_header_height'                => array(
                    'label' => __( 'Header height', 'ypop' ),
                    'type'  => 'number',
                    'desc'  => __( 'Select the height of the header popup', 'ypop' ),
                    'min'   => 0,
                    'max'   => 2000,
                    'std'   => 159,
                    'deps'  => array(
                        'ids'    => '_template_name',
                        'values' => 'theme1',
                    )
                ),
                'theme1_header_color'                 => array(
                    'label' => __( 'Header color', 'ypop' ),
                    'type'  => 'colorpicker',
                    'std'   => '#ffffff',
                    'desc'  => __( 'Select the color of the header', 'ypop' ),
                    'deps'  => array(
                        'ids'    => '_template_name',
                        'values' => 'theme1',
                    )
                ),
                'theme1_footer_bg_color'              => array(
                    'label' => __( 'Footer background color', 'ypop' ),
                    'desc'  => __( 'Select the background color of the footer', 'ypop' ),
                    'type'  => 'colorpicker',
                    'std'   => '#f4f4f4',
                    'deps'  => array(
                        'ids'    => '_template_name',
                        'values' => 'theme1',
                    )
                ),
                'theme1_label_position'               => array(
                    'label'   => __( 'Position of the field title in newsletter content type', 'ypop' ),
                    'desc'    => __( 'Select the position of the label ', 'ypop' ),
                    'type'    => 'select',
                    'std'     => 'label',
                    'options' => array(
                        'label'       => __( 'Label', 'ypop' ),
                        'placeholder' => __( 'Placeholder', 'ypop' )
                    ),
                    'deps'    => array(
                        'ids'    => '_template_name',
                        'values' => 'theme1',
                    )
                ),
                'theme1_submit_button_bg_color'       => array(
                    'label' => __( 'Background color for submit button', 'ypop' ),
                    'desc'  => __( 'Select the background color for submit button', 'ypop' ),
                    'type'  => 'colorpicker',
                    'std'   => '#ff8a00',
                    'deps'  => array(
                        'ids'    => '_template_name',
                        'values' => 'theme1',
                    )
                ),
                'theme1_submit_button_bg_color_hover' => array(
                    'label' => __( 'Background color on hover for submit button', 'ypop' ),
                    'desc'  => __( 'Select the background color on hover for submit button', 'ypop' ),
                    'type'  => 'colorpicker',
                    'std'   => '#db7600',
                    'deps'  => array(
                        'ids'    => '_template_name',
                        'values' => 'theme1',
                    )
                ),
                'theme1_submit_button_color'          => array(
                    'label' => __( 'Color for submit button', 'ypop' ),
                    'desc'  => __( 'Select the text color for submit button', 'ypop' ),
                    'type'  => 'colorpicker',
                    'std'   => '#ffffff',
                    'deps'  => array(
                        'ids'    => '_template_name',
                        'values' => 'theme1',
                    )
                ),

                /*************************************
                 * COMMON LAYOUT OPTIONS
                 *************************************/
                'checkzone_bg_color'       => array(
                    'label' => __( 'Background color for the hiding text area', 'ypop' ),
                    'desc'  => __( 'Select the background color for the hiding text area', 'ypop' ),
                    'type'  => 'colorpicker',
                    'std'   => 'transparent'
                ),
                'checkzone_text_color'       => array(
                    'label' => __( 'Text color for the hiding text', 'ypop' ),
                    'desc'  => __( 'Select the text color for the hiding text', 'ypop' ),
                    'type'  => 'colorpicker',
                    'std'   => '#333333'
                ),


			) )
        ),
        'display'       => array(
            'label'  => __( 'Display Settings', 'ypop' ),
            'fields' => apply_filters( 'ypop_display_metabox', array(

                'overlay_opacity' => array(
                    'label' => __( 'Overlay opacity', 'ypop' ),
                    'desc'  => '',
                    'type'  => 'slider',
                    'min'   => 0,
                    'max'   => 100,
                    'step'  => 10,
                    'std'   => 50
                ),

            ) )
        ),
        'customization' => array(
            'label'  => __( 'Customization', 'ypop' ),
            'fields' => apply_filters( 'ypop_customization_metabox', array(
                'ypop_css'        => array(
                    'label' => __( 'CSS', 'ypop' ),
                    'desc'  => '',
                    'type'  => 'textarea',
                    'std'   => '',
                ),
                'sep'             => array(
                    'type' => 'sep'
                ),
                'ypop_javascript' => array(
                    'label' => __( 'JavaScript', 'ypop' ),
                    'desc'  => '',
                    'type'  => 'textarea',
                    'std'   => '',
                ),
            ) )
        ),
        'newsletter'    => apply_filters( 'yith-popup-newsletter-metabox', array(
            'label'  => __( 'Newsletter', 'ypop' ),
            'fields' => array(
                'newsletter-integration'   => array(
                    'label'   => __( 'Form integration preset', 'ypop' ),
                    'desc'    => __( 'Select what kind of newsletter service you want to use, or set a custom form.', 'ypop' ),
                    'type'    => 'select',
                    'options' => $integration_types,
                    'std'     => 'custom'
                ),

                'newsletter-action'        => array(
                    'label' => __( 'Form action', 'ypop' ),
                    'desc'  => __( 'The attribute "action" of the form.', 'ypop' ),
                    'type'  => 'text',
                    'std'   => '',
                    'deps'  => array(
                        'ids'    => '_newsletter-integration',
                        'values' => 'custom'
                    )
                ),

                'newsletter-method'        => array(
                    'label'   => __( 'Request method', 'ypop' ),
                    'desc'    => __( 'The attribute "method" of the form.', 'ypop' ),
                    'type'    => 'select',
                    'options' => array(
                        'post' => __( 'POST', 'ypop' ),
                        'get'  => __( 'GET', 'ypop' )
                    ),
                    'std'     => 'post',
                    'deps'    => array(
                        'ids'    => '_newsletter-integration',
                        'values' => 'custom'
                    )
                ),

                'newsletter-show-name'     => array(
                    'label' => __( 'Show name field', 'ypop' ),
                    'desc'  => __( 'Show the "Name" field in the newsletter', 'ypop' ),
                    'type'  => 'onoff',
                    'std'   => 'no',
                    'deps'  => array(
                        'ids'    => '_newsletter-integration',
                        'values' => 'custom'
                    )
                ),

                'newsletter-name-label'    => array(
                    'label' => __( 'Name field label', 'ypop' ),
                    'desc'  => __( 'The label for "Name" field', 'ypop' ),
                    'type'  => 'text',
                    'std'   => 'Your Name',
                    'deps'  => array(
                        'ids'    => '_newsletter-integration',
                        'values' => 'custom'
                    )
                ),

                'newsletter-name-name'     => array(
                    'label' => __( '"Name" attribute of the Name field', 'ypop' ),
                    'desc'  => __( 'The "Name" attribute of the Name field.', 'ypop' ),
                    'type'  => 'text',
                    'std'   => 'ypop_name',
                    'deps'  => array(
                        'ids'    => '_newsletter-integration',
                        'values' => 'custom'
                    )
                ),

                'newsletter-email-label'   => array(
                    'label' => __( 'Email field label', 'ypop' ),
                    'desc'  => __( 'The label for the "Email" field', 'ypop' ),
                    'type'  => 'text',
                    'std'   => 'Email',
                    'deps'  => array(
                        'ids'    => '_newsletter-integration',
                        'values' => 'custom'
                    )
                ),

                'newsletter-email-name'    => array(
                    'label' => __( '"Name" attribute for Email field', 'ypop' ),
                    'desc'  => __( 'The attribute "Name" of the email address field.', 'ypop' ),
                    'type'  => 'text',
                    'std'   => 'ypop_email',
                    'deps'  => array(
                        'ids'    => '_newsletter-integration',
                        'values' => 'custom'
                    )
                ),

                'newsletter-submit-label'  => array(
                    'label' => __( 'Submit button label', 'ypop' ),
                    'desc'  => __( 'This field is not always used. It depends on the style of the form.', 'ypop' ),
                    'type'  => 'text',
                    'std'   => 'Add Me',
                    'deps'  => array(
                        'ids'    => '_newsletter-integration',
                        'values' => 'custom'
                    )
                ),

                'newsletter-hidden-fields' => array(
                    'label' => __( 'Hidden fields', 'ypop' ),
                    'desc'  => __( 'Type here all hidden field names and values in a serial way. Example: name1=value1&name2=value2.', 'ypop' ),
                    'type'  => 'text',
                    'std'   => '',
                    'deps'  => array(
                        'ids'    => '_newsletter-integration',
                        'values' => 'custom'
                    )
                ),
            )
        ) ),

    )
);

if ( function_exists( 'WC' ) ) {
    $woocommerce_options = array(
        'woocommerce' => array(
            'label'  => __( 'WooCommerce', 'ypop' ),
            'fields' => apply_filters( 'ypop_woocommerce_metabox', array(

                    'ypop_products'     => array(
                        'label'    => __( 'Select products', 'ypop' ),
                        'desc'     => '',
                        'type'     => 'ajax-products',
                        'multiple' => true,
                        'options'  => array(),
                        'std'      => array(),

                    ),


                    'show_title' => array(
                        'label' => __( 'Show name of product', 'ypop' ),
                        'desc'  => '',
                        'type'  => 'onoff',
                        'std'   => 'yes'
                    ),


                    'show_thumbnail' => array(
                        'label' => __( 'Show thumbnail of product', 'ypop' ),
                        'desc'  => '',
                        'type'  => 'onoff',
                        'std'   => 'yes'
                    ),

                    'show_price' => array(
                        'label' => __( 'Show price of product', 'ypop' ),
                        'desc'  => '',
                        'type'  => 'onoff',
                        'std'   => 'yes'
                    ),

                    'show_add_to_cart' => array(
                        'label' => __( 'Show Add to Cart', 'ypop' ),
                        'desc'  => '',
                        'type'  => 'onoff',
                        'std'   => 'yes'
                    ),

                    'add_to_cart_label' => array(
                        'label' => __( '"Add to cart" Label', 'ypop' ),
                        'desc'  => '',
                        'type'  => 'text',
                        'std'   => __('Add to cart', 'ypop')
                    ),

                    'show_summary' => array(
                        'label' => __( 'Show summary', 'ypop' ),
                        'desc'  => '',
                        'type'  => 'onoff',
                        'std'   => 'yes'
                    ),



                )
            )
        )
    );

    $options['tabs'] = array_merge( $options['tabs'], $woocommerce_options );
}

return $options;


