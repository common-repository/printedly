<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://expresspixel.com
 * @since      1.0.0
 *
 * @package    Printedly
 * @subpackage Printedly/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Printedly
 * @subpackage Printedly/public
 * @author     Printedly <kevin@expresspixel.com>
 */
class Printedly_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/printedly-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/printedly-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'printedly-embed',  'https://app.printedly.com/embed.js');
		wp_enqueue_script( 'printedly-quote',  'https://quote.printedly.com/dist/build.js', array(), false, true);
		wp_enqueue_style( 'printedly-quote',  'https://quote.printedly.com/dist/main.css');

	}

	public function register_shortcodes() {
		add_shortcode( 'printedly-quote', array( $this, 'printedly_quote' ) );
		add_shortcode( 'printedly-designer', array( $this, 'printedly_designer' ) );
		$this->create_post("Quote", "quote");
		$this->create_post("Designer", "designer");
	} // register_shortcodes()

	public function printedly_quote() {
		$printedly_user_id = (get_option('printedly_user_id'));
		include plugin_dir_path( __FILE__ ) . 'partials/printedly-quote-template.php' ;
	}

	public function printedly_designer() {
		$printedly_user_id = (get_option('printedly_user_id'));
		include plugin_dir_path( __FILE__ ) . 'partials/printedly-designer-template.php' ;
	}

	/**
 * A function used to programmatically create a post in WordPress. The slug, author ID, and title
 * are defined within the context of the function.
 *
 * @returns -1 if the post was never created, -2 if a post with the same title exists, or the ID
 *          of the post if successful.
 */
function create_post($title, $slug) {

	// Initialize the page ID to -1. This indicates no action has been taken.
	$post_id = -1;

	// Setup the author, slug, and title for the post
	$author_id = 1;

	// If the page doesn't already exist, then create it
	if( null == get_page_by_title( $title ) ) {

		// Set the post ID so that we know the post was created successfully
		$post_id = wp_insert_post(
			array(
				'comment_status'	=>	'closed',
				'ping_status'		=>	'closed',
				'post_author'		=>	$author_id,
				'post_name'		=>	$slug,
				'post_content'		=>	"[printedly-".$slug."]",
				'post_title'		=>	$title,
				'post_status'		=>	'publish',
				'post_type'		=>	'page'
			)
		);

	// Otherwise, we'll stop
	} else {

    		// Arbitrarily use -2 to indicate that the page with the title already exists
    		$post_id = -2;

	} // end if

} // end programmatically_create_post

}
