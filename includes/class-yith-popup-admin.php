<?php
/**
 * Admin class
 *
 * @author Yithemes
 * @package YITH WooCommerce Popup
 * @version 1.0.0
 */

if ( ! defined( 'YITH_YPOP_INIT' ) ) {
    exit;
} // Exit if accessed directly

if( ! class_exists( 'YITH_Popup_Admin' ) ) {
    /**
     * YITH_Popup_Admin class
     *
     * @since 1.0.0
     */
    class YITH_Popup_Admin {
        /**
         * Single instance of the class
         *
         * @var \YITH_Popup_Admin
         * @since 1.0.0
         */
        protected static $instance;

        /**
         * @var $_premium string Premium tab template file name
         */
        protected $_premium = 'premium.php';

        /**
         * @var $_panel Panel Object
         */
        protected $_panel;

        /**
         * @var string Premium version landing link
         */
        protected $_premium_landing = 'http://yithemes.com/themes/plugins/yith-woocommerce-popup/';

        /**
         * @var string Panel page
         */
        protected $_panel_page = 'yith_woocommerce_popup';

        /**
         * @var string Doc Url
         */
        public $doc_url = 'http://yithemes.com/docs-plugins/yith-woocommerce-popup';

        /**
         * The name for the plugin options
         *
         * @access public
         * @var string
         * @since 1.0.0
         */
        public $plugin_options = 'yit_ypop_options';

        /**
         * Returns single instance of the class
         *
         * @return \YITH_Popup_Admin
         * @since 1.0.0
         */
        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        /**
         * Constructor.
         *
         * @return \YITH_Popup_Admin
         * @since 1.0.0
         */
        public function __construct() {

            $this->create_menu_items();

            //Add action links
            add_filter( 'plugin_action_links_' . plugin_basename( YITH_YPOP_DIR . '/' . basename( YITH_YPOP_FILE ) ), array( $this, 'action_links' ) );
            add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 4 );

            //custom styles and javascript
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles_scripts' ) );



            add_filter( 'yit_fw_metaboxes_type_args', array( $this, 'add_custom_metaboxes' ) );

            add_action( 'wp_ajax_ypop_change_status', array( $this, 'change_status' ) );
            add_action( 'wp_ajax_nopriv_ypop_change_status', array( $this, 'change_status' ) );

            add_filter( 'yit_fw_metaboxes_type_args', array( $this, 'textarea_metabox'));

        }


        /**
         * Change value in a metabox
         *
         * Modify the metabox value in a textarea-editor when the value is empty
         *
         * @since  1.0
         * @author Emanuela Castorina
         */
        function textarea_metabox( $args ){
            if( ! isset( $_REQUEST['post']) ){
                return $args;
            }
            $post_id = $_REQUEST['post'];

            if( $args['type'] == 'textarea-editor'){
                $meta_value =  YITH_Popup()->get_meta( $args['args']['args']['id'], $post_id);
                $args['args']['args']['value'] = $meta_value;
            }

            return $args;
        }

        /**
         * Create Menu Items
         *
         * Print admin menu items
         *
         * @since  1.0
         * @author Emanuela Castorina
         */

        private function create_menu_items() {
            // Add a panel under YITH Plugins tab
            add_action( 'admin_menu', array( $this, 'register_panel' ), 5 );
            add_action( 'yith_ypop_premium_tab', array( $this, 'premium_tab' ) );
        }

        /**
         * Action Links
         *
         *
         * add the action links to plugin admin page
         *
         * @param $links | links plugin array
         *
         * @return   mixed Array
         * @since    1.0
         * @author   Andrea Grillo <andrea.grillo@yithemes.com>
         * @return mixed
         * @use      plugin_action_links_{$plugin_file_name}
         */

        public function action_links( $links ) {

            $links[] = '<a href="' . admin_url( "admin.php?page={$this->_panel_page}" ) . '">' . __( 'Settings', 'ypop' ) . '</a>';
//            if ( defined( 'YITH_YPOP_FREE_INIT' ) ) {
//                $links[] = '<a href="' . $this->get_premium_landing_uri() . '" target="_blank">' . __( 'Premium Version', 'ypop' ) . '</a>';
//            }

            return $links;
        }

        /**
         * Enqueue styles and scripts
         *
         * @access public
         * @return void
         * @since 1.0.0
         */
        public function enqueue_styles_scripts() {

            $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
            wp_enqueue_script( 'yith_ypop_admin', YITH_YPOP_ASSETS_URL . '/js/backend' . $suffix . '.js', array( 'jquery' ), YITH_YPOP_VERSION, true );
            wp_enqueue_style( 'yith_ypop_backend', YITH_YPOP_ASSETS_URL . '/css/backend.css' );

            wp_localize_script( 'yith_ypop_admin', 'ypop_backend', array( 'url' => admin_url( 'admin-ajax.php' ) ) );

            require_once( YITH_YPOP_DIR.'/plugin-fw/yit-plugin.php' );

        }


        /**
         * plugin_row_meta
         *
         * add the action links to plugin admin page
         *
         * @param $plugin_meta
         * @param $plugin_file
         * @param $plugin_data
         * @param $status
         *
         * @return   Array
         * @since    1.0
         * @author   Andrea Grillo <andrea.grillo@yithemes.com>
         * @use      plugin_row_meta
         */

        public function plugin_row_meta( $plugin_meta, $plugin_file, $plugin_data, $status ) {

            if ( defined( 'YITH_YPOP_INIT' ) && YITH_YPOP_INIT == $plugin_file ) {
                $plugin_meta[] = '<a href="' . $this->doc_url . '" target="_blank">' . __( 'Plugin Documentation', 'ypop' ) . '</a>';
            }
            return $plugin_meta;
        }

        /**
         * Get the premium landing uri
         *
         * @since   1.0.0
         * @author  Andrea Grillo <andrea.grillo@yithemes.com>
         * @return  string The premium landing link
         */
        public function get_premium_landing_uri(){
            return defined( 'YITH_REFER_ID' ) ? $this->_premium_landing . '?refer_id=' . YITH_REFER_ID : $this->_premium_landing.'?refer_id=1030585';
        }

        /**
         * Add a panel under YITH Plugins tab
         *
         * @return   void
         * @since    1.0
         * @author   Andrea Grillo <andrea.grillo@yithemes.com>
         * @use      /Yit_Plugin_Panel class
         * @see      plugin-fw/lib/yit-plugin-panel.php
         */

        public function register_panel() {

            if ( !empty( $this->_panel ) ) {
                return;
            }

            $admin_tabs = array(
                'settings' => __( 'Settings', 'ypop' )
            );

            if ( defined( 'YITH_YPOP_FREE_INIT' ) ) {
                $admin_tabs['premium'] = __( 'Premium Version', 'ypop' );
            }


            $args = array(
                'create_menu_page' => true,
                'parent_slug'      => '',
                'page_title'       => __( 'WC Popup', 'ypop' ),
                'menu_title'       => __( 'WC Popup', 'ypop' ),
                'capability'       => 'manage_options',
                'parent'           => 'ypop',
                'parent_page'      => 'yit_plugin_panel',
                'page'             => $this->_panel_page,
                'admin-tabs'       => $admin_tabs,
                'options-path'     => YITH_YPOP_DIR . '/plugin-options'
            );

            /* === Fixed: not updated theme  === */
            if ( !class_exists( 'YIT_Plugin_Panel' ) ) {
                require_once( YITH_YPOP_DIR.'/plugin-fw/lib/yit-plugin-panel.php' );
            }

            $this->_panel = new YIT_Plugin_Panel( $args );
        }




        /**
         * Premium Tab Template
         *
         * Load the premium tab template on admin page
         *
         * @return   void
         * @since    1.0
         * @author   Andrea Grillo <andrea.grillo@yithemes.com>
         */

        public function premium_tab() {
            $premium_tab_template = YITH_YPOP_TEMPLATE_PATH . '/admin/' . $this->_premium;
            if ( file_exists( $premium_tab_template ) ) {
                include_once( $premium_tab_template );
            }
        }



        /**Enable custom metabox type
         * @author YITHEMES
         * @param $args
         * @use yit_fw_metaboxes_type_args
         * @return mixed
         */
        public function add_custom_metaboxes( $args ){

            if( 'iconlist' == $args['type'] ){
                $args['basename']   = YITH_YPOP_DIR;
                $args['path']       = 'metaboxes/types/';
            }

            return $args;
        }


        public function change_status(){

            if( ! isset( $_REQUEST['post_id']) ){
                return false;
            }

            $post_id = $_REQUEST['post_id'];
            if( $_REQUEST['status'] == 'enable' ){
                $updated = update_post_meta($post_id, '_enable_popup', 'yes');
            }else{
                $updated = update_post_meta($post_id, '_enable_popup', 'no');
            }

            echo $updated;

            die();

        }




    }

    /**
     * Unique access to instance of YITH_Popup_Admin class
     *
     * @return \YITH_Popup_Admin
     */
    function YITH_Popup_Admin() {
        return YITH_Popup_Admin::get_instance();
    }


}
