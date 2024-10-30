<?php

if ('cucuads-admin.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not access this file directly. Thanks!');

if ( !is_admin() ) {
	die();
}

if ( !current_user_can( 'manage_options' ) ) :
	wp_die( 'You do not have sufficient permissions to access this page.' );
endif;



if ( isset( $_POST['cucuads-submit'] ) ) :
    if ( !wp_verify_nonce( $_POST['cucuads-nonce'], 'cucuads-nonce' ) ) die( 'Invalid Nonce.' );
	if ( function_exists( 'current_user_can' ) && current_user_can( 'edit_plugins' ) ) :
		update_option( 'cucuads_script_code', $_POST['cucuads_script_code'] );
		echo '<div class="updated fade"><p>'.__('Options updated and saved.').'</p></div>';
        else :
	        wp_die( '<p>You do not have sufficient permissions.</p>' );
        endif;
endif;

$options['cucuads_script_code'] = get_option( 'cucuads_script_code' );

?>
<div id="cucuads-options" class="wrap">
<h2><img src="<?php echo plugins_url( 'images/icon32.png',dirname(__FILE__) );?>"> <?php _e('CucuAds Options', _PLUGIN_NAME_); ?></h2>
<form class="cucuads-form" name="cucuads-options" method="post" action="">
<h3>Script Code</h3>
<table class="form-table">
<tr valign="top">
<th scope="row">
<label for="cucuads-script"><?php _e('Code'); ?></label>
</th>
<td>
<span class="description"><?php _e('Visit <a href="https://cucuads.com/" target="_blank">CucuAds.com</a> to get your code. Log into your account and then go to <a href="https://cucuads.com/dashboard/publisher/code" target="_blank">"Code Generator" section</a> to obtain your code to paste in here.', _PLUGIN_NAME_); ?></span>
<textarea class="widefat" id="cucuads_script_code" name="cucuads_script_code" rows="8" cols="20"><?php
						if ( isset( $options['cucuads_script_code'] ) ) {
							echo stripslashes( $options['cucuads_script_code'] );
						}
						?></textarea>
</td></tr>

</table>
<?php wp_nonce_field( 'cucuads-nonce', 'cucuads-nonce', false ) ?> 
<p class="submit"><input id="cucuads-submit" type="submit" name="cucuads-submit" class="button-primary cucuads-button" value="<?php _e('Save Changes', _PLUGIN_NAME_); ?>" /></p>
</form>
</div>
<div class="clear"></div>
