<?php
	
require get_template_directory() . '/inc/tgm-plugin/class-tgm-plugin-activation.php';

/**
 * Recommended plugins.
 */
function photography_album_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Kirki Customizer Framework', 'photography-album' ),
			'slug'             => 'kirki',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	photography_album_tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'photography_album_register_recommended_plugins' );