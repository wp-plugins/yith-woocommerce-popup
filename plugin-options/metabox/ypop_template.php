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


$template_metabox =  array(
    'label'    => __( 'Popup Template', 'ypop' ),
    'pages'    => 'yith_popup',
    'context'  => 'normal', //('normal', 'advanced', or 'side')
    'priority' => 'high',
    'tabs'     => array(
        'template' => array(
            'label'  => __( 'Template', 'ypop' ),
            'fields' => apply_filters( 'ypop_template_metabox', array(
                'template_name'     => array(
                    'label' => __( 'Template', 'ypop' ),
                    'type'  => 'select',
                    'desc'  => '',
                    'options' => YITH_Popup()->template_list,
                    'std'   => 'none'
                ),

            ))
        ),
    )
);

foreach( YITH_Popup()->template_list as $key => $template ){
    $template_metabox['tabs']['template']['fields']['preview_'.$key] = array(
        'label' =>'',
        'type'  => 'preview',
        'std'   => YITH_YPOP_TEMPLATE_URL.'/themes/'.$key.'/preview/preview.jpg',
        'deps'  => array(
            'ids'    => '_template_name',
            'values' => $key,
        )
    );
}

return $template_metabox;