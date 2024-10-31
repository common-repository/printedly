<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://expresspixel.com
 * @since      1.0.0
 *
 * @package    Printedly
 * @subpackage Printedly/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Printedly
 * @subpackage Printedly/admin
 * @author     Printedly <kevin@expresspixel.com>
 */
class Printedly_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	const ADMIN_SLUG = 'printedly';

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Printedly_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Printedly_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/printedly-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Printedly_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Printedly_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/printedly-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'printedly_pym',  'https://pym.nprapps.org/pym.v1.min.js' );

	}


		/**
		 * Register the JavaScript for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function display_admin_page() {

			add_menu_page(
			        'Dashboard',
			        'Printedly Designer',
			        'manage_options',
							self::ADMIN_SLUG,
							array( $this, 'product_page' ),
			        'dashicons-store',
			        '',
//			        plugins_url( 'printedly/images/icon.png' ),
			        '2.562347345'
			    );
					/*add_submenu_page(
						self::ADMIN_SLUG,
						'Products',
						'Products',
						'manage_options',
						self::ADMIN_SLUG,
						array( $this, 'product_page' )
					);

					add_submenu_page(
						self::ADMIN_SLUG,
						'Categories',
						'Categories',
						'manage_options',
						self::ADMIN_SLUG . '-admin-categories',
						array( $this, 'categories_page' )
					);
					add_submenu_page(
						self::ADMIN_SLUG,
						'Clip-art',
						'Clip-art',
						'manage_options',
						self::ADMIN_SLUG . '-admin-clip-art',
						array( $this, 'clipart_page' )
					);
					add_submenu_page(
						self::ADMIN_SLUG,
						'Orders',
						'Orders',
						'manage_options',
						self::ADMIN_SLUG . '-admin-orders',
						array( $this, 'orders_page' )
					);
					add_submenu_page(
						self::ADMIN_SLUG,
						'Settings',
						'Settings',
						'manage_options',
						self::ADMIN_SLUG . '-admin-settings',
						array( $this, 'settings_page' )
					);
*/
					add_action( 'admin_bar_menu', function( \WP_Admin_Bar $bar ) {
						$bar->add_menu( array(
					         'id'    => 'printedly-bar',
									 'title' => '<span class="printedly-top-menu-item"></span>',
					         'href'  => '#',
					         'meta'  => array(
					             'title' => __('Printedly'),
					         ),
					     ));
					     $bar->add_menu( array(
					         'id'    => 'printedly-bar-quote',
					         'parent' => 'printedly-bar',
					         'title' => 'Visit Quick Quote page',
					         'href'  => get_permalink( get_page_by_path( 'quote' ) ),
					         'meta'  => array(
					             'title' => __('Visit Quick Quote page'),
					             'target' => '_blank',
					             'class' => 'my_menu_item_class'
					         ),
					     ));
					     $bar->add_menu( array(
								 	 'id'    => 'printedly-bar-designer',
								 	 'parent' => 'printedly-bar',
					         'title' => 'Visit Designer page',
					         'href'  => get_permalink( get_page_by_path( 'designer' ) ),
					         'meta'  => array(
										 	'title' => __('Visit Designer page'),
					             'target' => '_blank',
					             'class' => 'my_menu_item_class'
					         ),
					     ));

					}, 1000 );

		}

		public function process_authorization() {

			#print_r($_REQUEST['code']);
			$params = [];
			$params['code'] = $_REQUEST['code'];
			$params['client_id'] = 3;
			$params['client_secret'] = '2bEoPOWBH7WyjF8d5lSnHL7lcXdz6cc55om5DPuv';
			$params['redirect_uri'] = admin_url('admin-post.php?action=printedly_oauth');
			$params['grant_type'] = 'authorization_code';

			$ch = curl_init( 'http://my.printedly.com/oauth/token' );
			# Setup request to send json via POST.
			$payload = http_build_query( $params );

			curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result = curl_exec($ch);
			curl_close($ch);
			# Print response.
			$result = json_decode($result, true);
			 #echo __LINE__; echo "\n";
			update_option('printedly_oauth_token', $result['access_token']);
			$this->get_user($result['access_token']);
			wp_redirect( admin_url( 'admin.php?page=printedly' ) );
		}

		public function get_user($access_token) {
			$ch = curl_init( 'http://my.printedly.com/wordpress/oauth-login' );

			$headers = [
			    'Authorization: Bearer '.$access_token,
			    'Content-Type: application/json',
			];
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			#print_r($headers);

			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result = curl_exec($ch);
			curl_close($ch);
			#print_r($result);

			# Print response.
			$result = json_decode($result, true);
			update_option('printedly_user_id', $result['id']);



		}

		public function product_page() {
			$iframe_url = "products";
			include plugin_dir_path( __FILE__ ) . 'partials/printedly-admin-display.php' ;
		}
		public function categories_page() {
			$iframe_url = "categories";
			include plugin_dir_path( __FILE__ ) . 'partials/printedly-admin-display.php' ;
		}
		public function clipart_page() {
			$iframe_url = "clip-art";
			include plugin_dir_path( __FILE__ ) . 'partials/printedly-admin-display.php' ;
		}
		public function orders_page() {
			$iframe_url = "orders";
			include plugin_dir_path( __FILE__ ) . 'partials/printedly-admin-display.php' ;
		}
		public function settings_page() {
			$iframe_url = "settings";
			include plugin_dir_path( __FILE__ ) . 'partials/printedly-admin-display.php' ;
		}

}
