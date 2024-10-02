<?php
/*
Plugin Name: Shortcodes Indep
Plugin URI: http://theemesindep.com
Description: ThemesIndep shortcodes generator.
Version: 1.0
Author: ThemesIndep
Author URI: http://themesindep.com
*/

	
class ShortcodesIndep {
	
	function __construct() {
		
		require_once( plugin_dir_path( __FILE__ ) . 'shortcodes.php' );
		define('SI_URI', plugin_dir_url( __FILE__ ));
		define('SI_DIR', plugin_dir_path( __FILE__ ));
		
    	add_action( 'init', array(&$this,'init') );
		add_action('admin_init', array(&$this, 'admin_init'));
		
		load_plugin_textdomain( 'si-text', false, dirname( plugin_basename(__FILE__) ) . '/languages' );
		
    }
	
	
    function init() {
		
		/* Front-End scripts & Styles
		-------------------------------------------- */
		if( ! is_admin() ){
			wp_register_script( 'sc-tabs', plugin_dir_url( __FILE__ ) . 'js/sc-tabs.js', 'jquery', '1.0', true );
			wp_register_script( 'sc-toggle', plugin_dir_url( __FILE__ ) . 'js/sc-toggle.js', 'jquery', '1.0', true );
			wp_enqueue_style('sc-style', plugin_dir_url( __FILE__ ) . 'css/sc-style.css');
		}
		
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
			 
		if ( get_user_option('rich_editing') == 'true') {
			add_filter("mce_external_plugins", array(&$this, 'si_menu_button_plugin'));
			add_filter('mce_buttons', array(&$this, 'register_si_menu_button'));
		}
    }  
	
		
	
	/* Register editor button
	-------------------------------------------- */
	function register_si_menu_button($menu_button) {
		array_push($menu_button, "|", "sc_menu");
		return $menu_button;
	}
	
	
	/* Path to shortcodes editor button menu
	-------------------------------------------- */
	function si_menu_button_plugin($plugin_array) {
		$plugin_array['sc_menu'] = SI_URI . 'editor-button-menu.js';
		return $plugin_array;
	}
	
	
	
	/* Enqueue Scripts & Style for admin
	-------------------------------------------- */
	function admin_init(){
		
		wp_enqueue_style( 'dialog-style', SI_URI . 'css/dialog-style.css', 'style', '1.0', 'all' );
		
		wp_enqueue_script('livequery', SI_URI . 'js/jquery.livequery.js', 'jquery', '1.1.1', true);
		wp_enqueue_script('shortcodes-core', SI_URI . 'js/shortcodes-core.js', 'jquery', '1.0', true);
		wp_enqueue_script('dialog-scripts', SI_URI . 'js/dialog-scripts.js', 'jquery', '1.0', true);
		
		wp_localize_script( 'jquery', 'ShortcodesIndep', array('plugin_url' => plugin_dir_url( __FILE__ ) ) );
		
		
	}
	
}
$shortcodesindep = new ShortcodesIndep;