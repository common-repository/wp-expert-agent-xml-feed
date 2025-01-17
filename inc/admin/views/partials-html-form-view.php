<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.fse-online.co.uk
 * @since      2.1.3
 *
 * @package    fse_wpeaxf
 * @subpackage fse_wpeaxf/inc/admin/views
 */


/**
 * The form to be loaded on the plugin's admin page
 */

if( current_user_can( 'edit_users' ) ) {

	if( !function_exists('ftp_connect') ) {
  		// Hide form FTP is not enabled on the server
  		echo '<div class="wrap"><h1>WordPress Expert Agent XML Feed</h1><div class="notice notice-error"><p><strong>' . __( 'FTP is required', $this->plugin_name ) . '</strong> ' . __( 'to use this plugin.', $this->plugin_name ) . ' ' . __( 'Please inform your server administrator to', $this->plugin_name ) . ' <a target="_blank" href="https://stackoverflow.com/questions/39841936/enabling-ftp-functions-in-existing-php-install">' . __( 'enable FTP', $this->plugin_name ) . '</a> ' . __( 'on your server.', $this->plugin_name ) . '</p></div>
  		<p>' . __( 'Sorry, we require FTP enabled on your server. Please see the error above.', $this->plugin_name ) . '</p></div>';
  		die();
  }

?>

<?php
	// Generate a custom nonce value.
 $fse_wpeaxf_add_nonce = wp_create_nonce( 'fse_wpeaxf_add_ftp_form_nonce' );

 ?>

<div class="wrap">
<?php 
$plugin_dir_url = plugin_dir_url(__FILE__);
$a = strpos($plugin_dir_url, 'wp-expert-agent-xml-feed');
$c = strlen('wp-expert-agent-xml-feed');
$b = substr($plugin_dir_url, 0, $a + $c);
$assets_url = $b . '/assets/admin/img';
?>
	<img src="<?php echo $assets_url . '/banner-772x250.png' ?>" alt="">
	<h1><?php _e( 'WordPress Expert Agent XML Feed', $this->plugin_name ); ?></h1>

	<form id="fse_wpeaxf_form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<?php settings_fields( 'fse_wpeaxf_settings_group' ); ?>
		<?php do_settings_sections( 'fse_wpeaxf_settings_group' ); ?>
		<table class="form-table">
			<p><?php _e( 'Please enter your FTP login details as provided by Expert Agent', $this->plugin_name ); ?> (<a target="_blank" href="https://learningcentre.expertagent.co.uk/ea-manual/using-ea-data-in-your-website/the-two-methods/method-3-xml-feed"><?php _e( 'more info here', $this->plugin_name ); ?></a>) <?php _e( 'so that we can fetch daily for your XML feed.', $this->plugin_name ); ?></p>
			<tr valign="top">
				<th scope="row"><?php _e('Remote File', $this->plugin_name); ?></th>
				<td>
					<input id="<?php echo $this->plugin_name; ?>-remote_file" type="text" name="<?php echo "fse_wpeaxf"; ?>[remote_file]" value="<?php echo esc_attr( get_option('fse_wpeaxf_remote_file') ); ?>" placeholder="<?php _e('e.g. properties.xml', $this->plugin_name);?>" size="33" required />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e('Remote User', $this->plugin_name); ?></th>
				<td>
					<input id="<?php echo $this->plugin_name; ?>-remote_user" type="text" name="<?php echo "fse_wpeaxf"; ?>[remote_user]" value="<?php echo esc_attr( get_option('fse_wpeaxf_remote_user') ); ?>" placeholder="<?php _e('e.g. Excellent Agency', $this->plugin_name);?>" size="33" required />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e('Remote Password', $this->plugin_name); ?></th>
				<td>
					<input id="<?php echo $this->plugin_name; ?>-remote_pass" type="password" name="<?php echo "fse_wpeaxf"; ?>[remote_pass]" value="<?php echo esc_attr( get_option('fse_wpeaxf_remote_pass') ); ?>" size="33" required />
				</td>
			</tr>

		</table>

		<p>
			<?php submit_button('Start fetching XML file daily', 'primary', 'Start fetching XML file daily', false); ?>
		</p>

		<input type="hidden" name="action" value="fse_wpeaxf_form_response">
		<input type="hidden" name="fse_wpeaxf_ftp_nonce" value="<?php echo $fse_wpeaxf_add_nonce ?>" />

		<div id="data"></div>

	</form>

</div>

<?php }
else {
?>
	<p><?php _e('You are not authorized to perform this operation.', $this->plugin_name); ?></p>
<?php
}
