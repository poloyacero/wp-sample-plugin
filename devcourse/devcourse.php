<?php
/**
*@package DevCoursePlugin
*/
/*
Plugin Name: Dev Course Plugin
Plugin URI: 
Description: A Plugin
Version: 1.0.0
Author: Paul Kerwin Acero
Author URI: 
License: GPL2 or later
*/

define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
require_once( PLUGIN_DIR . 'controller/dev.course.controller.php' );

class DevCoursePlugin {
	
	private $controller;
	
	public function __construct($controller) {
		$this->controller = $controller;
	}
	
	public function activate() {
		$this->controller->setup_db();
		$this->admin_menu();
		$this->admin_post_response();
		$this->load_scripts();
		//flush_rewrite_rules();
	}
	
	public function load_scripts() {
		add_action( 'admin_enqueue_scripts', 
			array( $this, 'scripts' ) 
		);
	}
	
	public function deactivate() {
		flush_rewrite_rules();
	}
	
	public function admin_menu() {
		add_action( 'admin_menu', array($this, 'add_plugin_menu_items' ) );
		
	}
	
	public function add_plugin_menu_items() {
		add_menu_page( 'Courses', 'Courses', 'activate_plugins', 'dev_course', array( $this->controller, 'index' ) );
		add_submenu_page( 'dev_course', 'All Courses', 'All Courses', 'manage_options', 'dev_course' );
		add_submenu_page( 'dev_course', 'New Course', 'Add Course', 'manage_options', 'new_dev_course', array( $this->controller, 'edit' ) );
	}
	
	public function admin_post_response() {
		add_action( 'admin_post_nds_form_response', array( $this->controller, 'store' ) );
	}
	
	public function scripts() {
		/*if ( ! did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}*/
		wp_enqueue_media();
		wp_register_script( 'script', plugin_dir_url( __FILE__ ) . '/assets/scripts.js', array('jquery'), null, true );
		wp_enqueue_script('script'); 
	}

}

if( class_exists('DevCoursePlugin') ){
	$model = new DevCourseModel();
	$controller = new DevCourseController($model);
	$plugin = new DevCoursePlugin($controller);
	$plugin->activate();
}

// activation
register_activation_hook( __FILE__, array( $plugin, 'activate' ) );

// deactivation
register_deactivation_hook( __FILE__, array( $plugin, 'deactivate' ) );