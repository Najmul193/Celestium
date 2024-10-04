<?php
/**
 * @package NASA_Picture-Of-The-Day
 * @version 1.0
 */
/*
Plugin Name: NASA Picture of the Day
Plugin URI: http://wordpress.org/plugins/nasa-astrology-picture-of-the-day
Description: This is just a simple plugin to retrieve NASA's Picture Of The Day via their provided API. This will grab the picture of the day, once daily and create a post from it, in the category you specify.
Author: ianwww
Version: 1.0
Author URI: http://fratercula.com/
*/

// Activation hook for some basic initialization
register_activation_hook( __FILE__,  'wp_handle_activation');
register_deactivation_hook( __FILE__, 'wp_handle_deactivation');

add_action('nasa_potd_daily_event_hook', 'get_potd');  //our cronjob hook
add_action('admin_menu', 'apod_menu'); //add settings menu item

function get_potd(){
	$api_key = get_option('apod_api_key');
	$default_status = get_option('apod_default_status');
	$post_as = get_option('apod_post_as');
	$response = wp_remote_get('https://api.data.gov/nasa/planetary/apod?api_key='.$api_key.'&format=JSON');
	$body=json_decode($response['body']);
	
	if(is_null($post_as) OR $post_as == "" ){
		$user_id = get_user_by('login',$post_as);
	}else{
		$user_id = '1';
	}
	
	if(!is_numeric($user_id)){
		$user_id = '1';
	}
	
	$pGUID = 'apod-'.$body->date;

	if(getIDfromGUID($pGUID) > 0){
		return;
	}

	$post_data = array('post_content' => $body->explanation,
		'post_title' => $body->title,
		'post_name' => create_slug($body->title),
		'post_excerpt' => $body->explanation,
		'post_status' => $default_status,
		'post_author' => $user_id,
		'guid' => $pGUID
	);

	$post_id = wp_insert_post($post_data); //insert the post, return the new post_id
	$imgGet = wp_remote_get($body->url); //grab our image
	$imgType = wp_remote_retrieve_header($imgGet, 'content-type'); //get our image type
	$imgMirror = wp_upload_bits(rawurldecode(basename($body->url)), '', wp_remote_retrieve_body($imgGet)); //upload image to wordpress

	$attachment = array(
		'post_title'=> preg_replace('/\.[^.]+$/', '', basename($body->url)),
		'post_mime_type' => $imgType,
		'post_content' => '',
		'post_status' => 'inherit',
		'guid' => basename($body->url),
		'post_author' => $user_id,
		'post_type' => 'attachment'
	);

	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	
	$attach_id = wp_insert_attachment($attachment, $imgMirror['url'], $post_id); //insert the attachment and get the ID
	$attach_data = wp_generate_attachment_metadata($attach_id, $imgMirror['file']); //generate the meta-data for the image
	wp_update_attachment_metadata($attach_id, $attach_data); //update the images meta-data
	set_post_thumbnail($post_id, $attach_id); //set the image as featured for the new post
		
}

function wp_handle_activation() {  //this should only be called when the plugin is first activated.
	add_option( 'apod_api_key', ''); //make a settings option for your API key, cant query NASA API without it.
	add_option( 'apod_default_status', 'pending'); //make a settings option for the default status of the new post
	add_option( 'apod_post_as', ''); //make a settings option for who to post as
	wp_schedule_event( time(), 'daily', 'nasa_potd_daily_event_hook'); //create our scheduled event
}

function wp_handle_deactivation() {	 //this should only be called when the plugin is deactivated
	wp_clear_scheduled_hook('nasa_potd_daily_event_hook');
	
	if ( get_option( 'apod_api_key' ) != false ){
		delete_option('apod_api_key');
	}
	
	if ( get_option( 'apod_default_status' ) != false ){
		delete_option('apod_default_status');
	}
	
	if ( get_option( 'apod_post_as' ) != false ){
		delete_option( 'apod_post_as');
	}
}

function getIDfromGUID( $guid ){
    global $wpdb;
    return $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid=%s", "http://".$guid ) );
}

function create_slug($string){
   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   return $slug;
}

function apod_menu() {
	add_options_page(
            'APOD Plugin Settings',   //page title
            'APOD Settings',  //menu title
            'manage_options',  //capability
            'apod-settings',  //menu_slug
            'apod_settings_page' //function
        );

	add_action( 'admin_init', 'register_apod_settings');
}

function register_apod_settings() {
	//register our settings
	register_setting('apod-settings-group', 'apod_api_key');
	register_setting('apod-settings-group', 'apod_default_status');
	register_setting('apod-settings-group', 'apod_post_as');
}

function apod_settings_page() { ?>
<div class="wrap">
<h2>NASA Astronomy Picture of the Day(APOD)</h2>

<form method="post" action="options.php">
    <?php settings_fields('apod-settings-group'); ?>
    <?php do_settings_sections('apod-settings-group'); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">APOD API Key</th>
        <td><input type="text" style="width:400px;" name="apod_api_key" value="<?php echo esc_attr( get_option('apod_api_key') ); ?>" /> This is provided by NASA, <a href="https://data.nasa.gov/developer/external/planetary/#apply-for-an-api-key" target="_blank">Click Here</a> to apply for an API key.</td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Default Post Status</th>
        <td><input type="text" name="apod_default_status" value="<?php echo esc_attr( get_option('apod_default_status') ); ?>" /> (draft, pending, publish, future, private, etc.)</td>
        </tr>
        
        <tr valign="top">
        <th scope="row">User To Publish As</th>
        <td><input type="text" name="apod_post_as" value="<?php echo esc_attr( get_option('apod_post_as') ); ?>" /> Please enter a Username</td> 
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>
<?php } ?>