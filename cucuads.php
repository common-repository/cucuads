<?php
/*
Plugin Name: CucuAds
Plugin URI: https://cucuads.com/
Description: CucuAds is the best way to <strong>monetize your mobile traffic</strong> in Wordpress. It is extremely easy to install obtaining a high revenue while being fully customizable to your needs. To start just <a href="https://cucuads.com/" target="_blank">Sign up</a> to get your code, and Go to your <a href="admin.php?page=cucuads_options">CucuAds configuration</a> page, and save it.
Version: 1.0.1
Author: cucuads
Author URI: https://cucuads.com/
*/

if ('cucuads.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not access this file directly. Thanks!');

class cucuads_plugin
{
	function __construct()
	{
		add_action( 'admin_menu', array( &$this, 'cucuads_admin_menu' ) );
		add_action( 'wp_footer', array( &$this, 'cucuads_footer_add_script' ));
		add_action( 'admin_notices', array( &$this, 'cucuads_notices' ));
	}

	static function cucuads_activation()
	{
		add_option( 'cucuads_script_code', '' );
	}
	
	static function cucuads_deactivation()
	{
		delete_option( 'cucuads_script_code' );
	}
	
	function cucuads_admin_menu()
	{
		add_menu_page( __('CucuAds', CUCUADS_PLUGIN_NAME), 'CucuAds', 'manage_options', 'cucuads_options', array( &$this, 'cucuads_admin_options' ), plugin_dir_url( __FILE__ ) . 'images/icon16.png' );
	}

	function cucuads_admin_options()
	{
		include 'inc/cucuads-admin.php';
	}

	/* Cucuads script added in the footer.*/
	function cucuads_footer_add_script()
	{
		
		$cucuadsCode = get_option( 'cucuads_script_code' );

		if ( ! empty($cucuadsCode) )
			echo stripslashes( $cucuadsCode );

	}

	function cucuads_notices()
	{
	
		$cucuadsCode = get_option( 'cucuads_script_code' );

		if ( empty($cucuadsCode) && empty($_POST['cucuads_script_code']) )
			echo '<div class="updated fade-ff0000"><p><strong>'.__('CucuAds Warning!').'</strong><br>'.__('Don\'t forget to enter your script code: <a href="admin.php?page=cucuads_options">Here</a>').'<br></p></div>';
	}

}
/* comentario */
define('CUCUADS_PLUGIN_NAME', 'cucuads'); //THIS LINE WILL BE CHANGED WITH THE USER SETTINGS
load_plugin_textdomain( CUCUADS_PLUGIN_NAME, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

register_activation_hook( __FILE__, array( 'cucuads_plugin', 'cucuads_activation' ) );
register_deactivation_hook( __FILE__, array( 'cucuads_plugin', 'cucuads_deactivation' ) );

new cucuads_plugin();

?>
