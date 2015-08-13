<?php
/*
Plugin Name: YITH WooCommerce Popup
Description: YITH WooCommerce Popup lets you easily manage and customize all the popups of your site
Version: 1.0.1
Author: Yithemes
Author URI: http://yithemes.com/
Text Domain: ypop
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

// This version can't be activate if premium version is active  ________________________________________
if ( defined( 'YITH_YPOP_PREMIUM_INIT' ) ) {
    function yith_ypop_install_free_admin_notice() {
        ?>
        <div class="error">
            <p><?php _e( 'You can\'t activate the free version of YITH WooCommerce Popup while you are using the premium one.', 'ypop' ); ?></p>
        </div>
        <?php
    }

    add_action( 'admin_notices', 'yith_ypop_install_free_admin_notice' );

    deactivate_plugins( plugin_basename( __FILE__ ) );
    return;
}

// Registration hook  ________________________________________
if ( !function_exists( 'yith_plugin_registration_hook' ) ) {
    require_once 'plugin-fw/yit-plugin-registration-hook.php';
}
register_activation_hook( __FILE__, 'yith_plugin_registration_hook' );



// Define constants ________________________________________
if ( defined( 'YITH_YPOP_VERSION' ) ) {
    return;
}else{
    define( 'YITH_YPOP_VERSION', '1.0.1' );
}

if ( ! defined( 'YITH_YPOP_FREE_INIT' ) ) {
    define( 'YITH_YPOP_FREE_INIT', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'YITH_YPOP_INIT' ) ) {
    define( 'YITH_YPOP_INIT', plugin_basename( __FILE__ ) );
}


if ( ! defined( 'YITH_YPOP_FILE' ) ) {
    define( 'YITH_YPOP_FILE', __FILE__ );
}

if ( ! defined( 'YITH_YPOP_DIR' ) ) {
    define( 'YITH_YPOP_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'YITH_YPOP_URL' ) ) {
    define( 'YITH_YPOP_URL', plugins_url( '/', __FILE__ ) );
}

if ( ! defined( 'YITH_YPOP_ASSETS_URL' ) ) {
    define( 'YITH_YPOP_ASSETS_URL', YITH_YPOP_URL . 'assets' );
}

if ( ! defined( 'YITH_YPOP_ASSETS_PATH' ) ) {
    define( 'YITH_YPOP_ASSETS_PATH', YITH_YPOP_DIR . 'assets' );
}

if ( ! defined( 'YITH_YPOP_TEMPLATE_PATH' ) ) {
    define( 'YITH_YPOP_TEMPLATE_PATH', YITH_YPOP_DIR . 'templates' );
}

if ( ! defined( 'YITH_YPOP_TEMPLATE_URL' ) ) {
    define( 'YITH_YPOP_TEMPLATE_URL', YITH_YPOP_URL . 'templates' );
}

if ( ! defined( 'YITH_YPOP_INC' ) ) {
    define( 'YITH_YPOP_INC', YITH_YPOP_DIR . '/includes/' );
}


if ( ! function_exists( 'yith_ypop_install' ) ) {
    function yith_ypop_install() {
        do_action( 'yith_ypop_init' );
    }

    add_action( 'plugins_loaded', 'yith_ypop_install', 11 );
}


function yith_ypop_free_constructor() {

    // Woocommerce installation check _________________________
    if ( !function_exists( 'WC' ) ) {
        function yith_ypop_install_woocommerce_admin_notice() {
            ?>
            <div class="error">
                <p><?php _e( 'YITH WooCommerce Popup is enabled but not effective. It requires WooCommerce in order to work.', 'ywrac' ); ?></p>
            </div>
            <?php
        }

        add_action( 'admin_notices', 'yith_ypop_install_woocommerce_admin_notice' );
        return;
    }

    // Load YWSL text domain ___________________________________
    load_plugin_textdomain( 'ypop', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );


    require_once( YITH_YPOP_INC . 'functions.yith-popup.php' );
    require_once( YITH_YPOP_INC . 'class-yith-popup-icon.php' );
    require_once( YITH_YPOP_INC . 'class-yith-popup-newsletter.php' );
    require_once( YITH_YPOP_INC . 'newsletter-integration/Mailchimp.php' );
    require_once( YITH_YPOP_INC . 'class-yith-popup.php' );
    if ( is_admin() ) {
        require_once( YITH_YPOP_INC . 'class-yith-popup-admin.php' );
        YITH_Popup_Admin();
    }
    else {
        require_once( YITH_YPOP_INC . 'class-yith-popup-frontend.php' );
        YITH_Popup_Frontend();
    }


    YITH_Popup();

}
add_action( 'yith_ypop_init', 'yith_ypop_free_constructor' );
