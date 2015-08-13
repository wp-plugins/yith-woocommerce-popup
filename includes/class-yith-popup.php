<?php
/**
 * Main class
 *
 * @author Yithemes
 * @package YITH WooCommerce Popup
 * @version 1.0.0
 */


if ( ! defined( 'YITH_YPOP_INIT' ) ) {
    exit;
} // Exit if accessed directly

if( ! class_exists( 'YITH_Popup' ) ){
    /**
     * YITH WooCommerce Popup main class
     *
     * @since 1.0.0
     */
    class YITH_Popup {
        /**
         * Single instance of the class
         *
         * @var \YITH WooCommerce Popup
         * @since 1.0.0
         */
        protected static $instance;

        /**
         * Array with accessible variables
         */
        protected $_data = array();

        public $post_type_name = 'yith_popup';

        public $template_list = array();

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
         * @return \YITH WooCommerce Popup
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
         * @since 1.0.0
         */
        public function __construct() {

            $this->set_templates();

            add_action( 'after_setup_theme', array( $this, 'plugin_fw_loader' ), 1 );
            add_action( 'init', array( $this, 'create_post_type' ), 0 );
            add_action( 'admin_init', array( $this, 'add_metabox' ), 1 );

            add_filter('manage_edit-' . $this->post_type_name . '_columns', array($this, 'edit_columns'));
            add_action('manage_' . $this->post_type_name . '_posts_custom_column', array($this, 'custom_columns'), 10, 2);



        }

        public function set_templates(){
            $this->template_list = array(
                'theme1' => __('Theme 1', 'ypop')
            );

            $_data['template_list'] = $this->template_list;
        }


        // Register Custom Post Type
        function create_post_type() {

            $labels = array(
                'name'               => _x( 'Yith Popup', 'Post Type General Name', 'ypop' ),
                'singular_name'      => _x( 'Yith Popup', 'Post Type Singular Name', 'ypop' ),
                'menu_name'          => __( 'Popup', 'ypop' ),
                'parent_item_colon'  => __( 'Parent Item:', 'ypop' ),
                'all_items'          => __( 'All Popups', 'ypop' ),
                'view_item'          => __( 'View Popup', 'ypop' ),
                'add_new_item'       => __( 'Add New Popup', 'ypop' ),
                'add_new'            => __( 'Add New Popup', 'ypop' ),
                'edit_item'          => __( 'Edit Popup', 'ypop' ),
                'update_item'        => __( 'Update Popup', 'ypop' ),
                'search_items'       => __( 'Search Popup', 'ypop' ),
                'not_found'          => __( 'Not found', 'ypop' ),
                'not_found_in_trash' => __( 'Not found in Trash', 'ypop' ),
            );
            $args   = array(
                'label'               => __( 'yith_popup', 'ypop' ),
                'description'         => __( 'Yith Popup Description', 'ypop' ),
                'labels'              => $labels,
                'supports'            => array( 'title' ),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => false,
                'show_in_admin_bar'   => true,
                'menu_position'       => null,
                'can_export'          => true,
                'has_archive'         => true,
                'menu_icon'           => 'dashicons-feedback',
                'exclude_from_search' => true,
                'publicly_queryable'  => true,
                'capability_type'     => 'post',
            );

            register_post_type( $this->post_type_name, $args );

        }
        /**
         * Return a $property defined in this class
         *
         * @since   1.0.0
         * @author  Emanuela Castorina <emanuela.castorina@yithemes.com>
         * @return  mix
         */
        public function __get( $property ){
            if ( isset( $this->_data[$property] ) ) {
                return $this->_data[$property];
            }
        }

        /**
         * Load YIT Plugin Framework
         *
         * @since  1.0.0
         * @return void
         * @author Andrea Grillo <andrea.grillo@yithemes.com>
         */
        public function plugin_fw_loader() {
            if ( !defined( 'YIT' ) || !defined( 'YIT_CORE_PLUGIN' ) ) {
                require_once( YITH_YPOP_DIR.'/plugin-fw/yit-plugin.php' );
            }
        }

        /**
         * Get options from db
         *
         * @access public
         * @since 1.0.0
         * @author Francesco Licandro <francesco.licandro@yithemes.com>
         * @param $option string
         * @return mixed
         */
        public function get_option( $option ) {
            // get all options
            $options = get_option( $this->plugin_options );

            if( isset( $options[ $option ] ) ) {
                return $options[ $option ];
            }

            return false;
        }

        /**
         * Add metabox in popup page
         *
         * @since  1.0.0
         * @return void
         * @author Andrea Grillo <andrea.grillo@yithemes.com>
         */
        public function  add_metabox() {

            if ( !function_exists( 'YIT_Metabox' ) ) {
                require_once( 'plugin-fw/yit-plugin.php' );
            }

            $args             = require_once( YITH_YPOP_DIR . '/plugin-options/metabox/ypop_template.php' );
            $metabox_template = YIT_Metabox( 'yit-pop' );
            $metabox_template->init( $args );

            $args    = require_once( YITH_YPOP_DIR . '/plugin-options/metabox/ypop_metabox.php' );
            $metabox = YIT_Metabox( 'yit-pop-info' );
            $metabox->init( $args );

            $args    = require_once( YITH_YPOP_DIR . '/plugin-options/metabox/ypop_cpt_metabox.php' );
            $metabox = YIT_Metabox( 'yit-cpt-info' );
            $metabox->init( $args );

        }

        /**
         * Get meta from Metabox Panel
         *
         * return the meta from database
         *
         * @param $meta
         * @param $post_id
         *
         * @return mixed
         * @since    1.0
         * @author   Antonio La Rocca <antonio.larocca@yithemes.it>
         */
        public function get_meta( $meta, $post_id ) {
            $meta_value = get_post_meta( $post_id, $meta, true );

            if ( isset( $meta_value ) ) {
                return $meta_value;
            }
            else {
                return '';
            }
        }

        public function get_popups_list() {
            $popups = get_posts( 'post_type='. $this->post_type_name .'&posts_per_page=-1');

            $array = array();
            if( !empty( $popups )){
                foreach( $popups as $popup ){
                    $array[  $popup->ID ] = $popup->post_title;
                }
            }

            return $array;
        }


        function edit_columns($columns)
        {

            $columns = array(
                'cb' => '<input type="checkbox" />',
                'title'    => __( 'Title', 'ypop' ),
                'template' => __( 'Template', 'ypop' ),
                'content'  => __( 'Content Type', 'ypop' ),
                'active'   => __( 'Active', 'ypop' ),
            );

            return $columns;
        }

        public function custom_columns($column, $post_id)
        {

            $template = get_post_meta($post_id, '_template_name', true);
            $enabled = get_post_meta($post_id, '_enable_popup', true);

            switch ($column) {
                case 'template' :
                    echo $template;
                    break;
                case 'content' :
                    $content = get_post_meta($post_id, '_'.$template.'_content_type', true);
                    if (is_string($content))
                        echo $content;
                    break;
                case 'active' : ?>
                        <div class="ypop-onoff-w">
                            <input type="checkbox" class="ypop-onoff" id="enable <?php echo $post_id ?>" name="ypop_enable_popup" value="<?php echo esc_attr( $enabled ) ?>" <?php checked( $enabled, 'yes' ) ?> data-id="<?php echo $post_id ?>" data-action="ypop_change_status"/>
                            <span class="onoff">&nbsp;</span>
                        </div>

                    <?php
                break;
            }
        }


    }

    /**
    * Unique access to instance of YITH_Popup class
	 *
	 * @return \YITH_Popup
    */
	function YITH_Popup() {
        return YITH_Popup::get_instance();
    }

}

