<?php
function photography_album_premium_setting( $wp_customize ) {
	
	/*=========================================
	Page Layout Settings Section
	=========================================*/
	$wp_customize->add_section(
        'photography_album_upgrade_premium',
        array(
            'title' 		=> __('Upgrade to Pro','photography-album'),
			'priority'      => 1,
		)
    );
	
	/*=========================================
	Add Buttons
	=========================================*/
	
	class Photography_Album_WP_Button_Customize_Control extends WP_Customize_Control {
	public $type = 'photography_album_upgrade_premium';

	   function render_content() {
		?>
			<div class="premium_info">
				<ul>
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW ); ?>" target="_blank"><?php esc_html_e( 'Upgrade to Pro','photography-album' ); ?> </a></li>
				</ul>
			</div>
			<div class="premium_info">
				<ul>
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_DEMO_PRO ); ?>" target="_blank"><?php esc_html_e( 'Live Demo','photography-album' ); ?></a></li>
				</ul>
			</div>
			<div class="premium_info">
				<ul>
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_DOCS_FREE ); ?>" target="_blank"><?php esc_html_e( 'Free Documentation','photography-album' ); ?> </a></li>
				</ul>
			</div>
			<div class="premium_info discount-box">
				<ul>
					<li class="discount-text"><?php esc_html_e( 'Special Discount of 35% Use Code “winter35”','photography-album' ); ?></li>
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( PHOTOGRAPHY_ALBUM_BUNDLE ); ?>" target="_blank"><?php esc_html_e( 'Wordpress Theme Bundle','photography-album' ); ?> </a></li>
				</ul>
			</div>
		<?php
	   }
	}
	
	$wp_customize->add_setting('photography_album_premium_info_buttons', array(
	   'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'photography_album_sanitize_text',
	));
		
	$wp_customize->add_control( new Photography_Album_WP_Button_Customize_Control( $wp_customize, 'photography_album_premium_info_buttons', array(
		'section' => 'photography_album_upgrade_premium',
    ))
);
}
add_action( 'customize_register', 'photography_album_premium_setting' );