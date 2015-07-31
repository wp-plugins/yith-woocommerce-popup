<?php

$list = YITH_Popup()->get_popups_list();
if( empty ( $list ) ){
    $desc = sprintf( __('Attention: You should create a new popup to set this option. <a href="%s">Create a new popup</a>', 'ypop' ), admin_url( 'post-new.php?post_type=yith_popup' ) );
}else{
    $desc = __( 'Select the popup that you want to show as default', 'ypop' );
}

$settings = array(

    'settings' => array(

        'header'    => array(

            array(
                'name' => __( 'General Settings', 'ypop' ),
                'type' => 'title'
            ),

            array( 'type' => 'close' )
        ),


        'general' => array(

            array( 'type' => 'open' ),

            array(
                'id'      => 'ypop_enable',
                'name'    => __( 'Enable Popup', 'ypop' ),
                'desc'    => '',
                'type'    => 'on-off',
                'std'     => 'yes'
            ),

            array(
                'id'      => 'ypop_enable_in_mobile',
                'name'    => __( 'Enable Popup in Mobile Device', 'ypop' ),
                'desc'    => '',
                'type'    => 'on-off',
                'std'     => 'yes'
            ),

            array( 'name' => __( 'Show on all pages', 'ypop' ),
                   'desc' => __( 'Enable newsletter popup in all pages.', 'ypop' ),
                   'id'   => 'ypop_enabled_everywhere',
                   'type' => 'on-off',
                   'std'  => 'yes' ),

            array( 'name' => __( 'Select where you want to show the popup', 'ypop' ),
                   'desc' => __( 'Select in which pages you want to show the popup. ', 'ypop' ),
                   'id'   => 'ypop_popup_pages',
                   'type' => 'chosen',
                   'multiple' => true,
                   'options' => ypop_get_available_pages(),
                   'std'  => array(),
                   'deps' => array(
                       'ids' => 'ypop_enabled_everywhere',
                       'values' => 'no'
                   )
            ),

            array( 'name' => __( 'Cookie Variable', 'ypop' ),
                   'desc' => __( 'Set the name for the cookie generated after closing the link of the popup. In this way, as soon as you\'ll change this value, all your visitors will see the link again even if they have disabled it. Don\'t abuse of this function!', 'ypop' ),
                   'id'   => 'ypop_cookie_var',
                   'type' => 'text',
                   'std'  => __( 'yithpopup', 'ypop' )
            ),


            array( 'name' => __( 'Hide policy', 'ypop' ),
                   'desc' => __( 'Select when popup should be hidden. By default, it will be hidden only when the hiding checkbox is flagged) ', 'ypop' ),
                   'id'   => 'ypop_hide_policy',
                   'type' => 'select',
                   'options' => array(
                       'always' => __('Hide when the "Hiding checkbox" is flagged', 'ypop'),
                       'session' => __('Show only once per session', 'ypop')
                   ),
                   'std'  => 'always' ),

            array( 'name' => __( 'How many days should the popup be hidden for?', 'ypop' ),
                   'desc' => __( 'Set how many days have to pass before showing again the lightbox', 'ypop' ),
                   'id'   => 'ypop_hide_days',
                   'css' 		=> 'width:50px;',
                   'type' 		=> 'text',
                   'std'  => '3',
                   'deps' => array(
                       'ids' => 'ypop_hide_policy',
                       'values' => 'always'
                   )
            ),

            array( 'name' => __( 'Hiding text', 'ypop' ),
                                 'desc' => __( 'The title displayed next to the checkbox that lets users hide the popup forever. You can also use HTML code', 'ypop' ),
                                 'id'   => 'ypop_hide_text',
                                 'type' => 'text',
                                 'std'  =>  __( 'Do not show it anymore.', 'ypop' )
            ),

            array( 'name' => __( 'Select the default popup', 'ypop' ),
                   'desc' => __( 'Attention: You should create a new popup to set this option', 'ypop' ),
                   'desc' => $desc,
                   'id'   => 'ypop_popup_default',
                   'type' => 'select',
                   'multiple' => false,
                   'options' => YITH_Popup()->get_popups_list(),
                   'std'  => ''
            ),

            array( 'type' => 'close' )

        )
    )
);

return apply_filters( 'yith_ypop_panel_settings_options', $settings );