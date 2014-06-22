<?php
/*
Plugin Name: Jetpack Awesome Icons
Plugin URI: http://wordpress.org
Description: Use FontAwesome icons instead of Jetpack icons for sharing buttons
Version: 0.1.0
Author: Tanner Moushey
Author URI: http://tannermoushey.com
License: GPL2
*/

define( 'JETPACK_DEV_DEBUG', true);
define( 'JAI_URL',     plugin_dir_url( __FILE__ ) );
define( 'JAI_PATH',    plugin_dir_path( __FILE__ ) );
define( 'JAI_VERSION', '0.1.0' );
define( 'JAI_KEY', 'jai_enabled' );

function jai_init() {
	add_action( 'wp_enqueue_scripts',         'jai_enqueue_scripts'     );
	add_action( 'load-settings_page_sharing', 'jai_enqueue_scripts'     );
	add_action( 'sharing_global_options',     'jai_enable_custom_icons' );
	add_action( 'sharing_admin_update',       'jai_admin_init'          );
}
add_action( 'plugins_loaded', 'jai_init' );

function jai_enqueue_scripts() {
	if ( ! get_option( JAI_KEY ) ) {
		return;
	}
	wp_enqueue_style( 'jai-awesome', JAI_URL . '/assets/css/font-awesome.min.css', array(), JAI_VERSION );
	wp_enqueue_style( 'jai-icons', JAI_URL . '/assets/css/icon-styles.css', array( 'jai-awesome' ), JAI_VERSION );
}

function jai_enable_custom_icons() {
	include_once( JAI_PATH . 'views/enable_custom_icons.php' );
}

function admin_init() {
	if ( isset( $_GET['page'] ) && ( $_GET['page'] == 'sharing.php' || $_GET['page'] == 'sharing' ) )
		$this->process_requests();
}

function jai_admin_init() {
	if ( empty( $_POST['jai_enable_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['jai_enable_nonce'], 'jai-enable' ) ) {
		return;
	}

	update_option( JAI_KEY, isset( $_POST['jai-enable'] ) );

}