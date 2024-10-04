<?php
/**
 * photography-album Theme Customizer.
 *
 * @package photography-album
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photography_album_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_setting('custom_logo')->transport = 'refresh';	
}
add_action( 'customize_register', 'photography_album_customize_register' );

if ( ! defined( 'PHOTOGRAPHY_ALBUM_BUY_NOW_1' ) ) {
define('PHOTOGRAPHY_ALBUM_BUY_NOW_1',__('https://www.mishkatwp.com/themes/photography-album-wordpress-theme/','photography-album'));
}

if ( class_exists("Kirki")){

	/* Logo */

	/* Logo Size limit Option End */
	new \Kirki\Field\Slider(
		[
			'settings'    => 'photography_album_logo_resizer_setting',
			'label'       => esc_html__( 'Logo Size Limit', 'photography-album' ),
			'section'     => 'title_tagline',
			'default'     => 70,
			'choices'     => [
				'min'  => 10,
				'max'  => 300,
				'step' => 10,
			],
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_site_title_setting',
			'label'       => esc_html__( 'Site Title On / Off', 'photography-album' ),
			'section'     => 'title_tagline',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_tagline_setting',
			'label'       => esc_html__( 'Tagline On / Off', 'photography-album' ),
			'section'     => 'title_tagline',
			'default'     => 'off',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	/* Logo End */

	/* Typography Section */

	new \Kirki\Section(
		'photography_album_theme_typography_section',
		[
			'title'       => esc_html__( 'Theme Typography', 'photography-album' ),
			'description' => esc_html__( 'Here you can customize Heading or other body text font settings', 'photography-album' ),
			'priority'    => 30,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'photography_album_all_headings_typography',
		'section'     => 'photography_album_theme_typography_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading Of All Sections',  'photography-album' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'global', array(
		'type'        => 'typography',
		'settings'    => 'photography_album_all_headings_typography',
		'label'       => esc_html__( 'Heading Typography',  'photography-album' ),
		'description' => esc_html__( 'Select the typography options for your heading.',  'photography-album' ),
		'section'     => 'photography_album_theme_typography_section',
		'priority'    => 10,
		'default'     => array(
			'font-family'    => '',
			'variant'        => '',
		),
		'output' => array(
			array(
				'element' => array( 'h1','h2','h3','h4','h5','h6', ),
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'photography_album_body_content_typography',
		'section'     => 'photography_album_theme_typography_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Body Content',  'photography-album' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'global', array(
		'type'        => 'typography',
		'settings'    => 'photography_album_body_content_typography',
		'label'       => esc_html__( 'Content Typography',  'photography-album' ),
		'description' => esc_html__( 'Select the typography options for your content.',  'photography-album' ),
		'section'     => 'photography_album_theme_typography_section',
		'priority'    => 10,
		'default'     => array(
			'font-family'    => '',
			'variant'        => '',
		),
		'output' => array(
			array(
				'element' => array( 'body', ),
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'photography-album' ),
		'default'  => '<a class="premium_info_btn" target="_blank" href="' . esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'photography-album' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'photography_album_theme_typography_section',
    ] );

    /* End Typography */

    /* Global Color Section */

	new \Kirki\Section(
		'photography_album_theme_color_section',
		[
			'title'       => esc_html__( 'Theme Colors Option', 'photography-album' ),
			'description' => esc_html__( 'Here you can change your theme color', 'photography-album' ),
			'priority'    => 30,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'color',
		'settings'    => 'photography_album_theme_color_1',
		'label'       => __( 'Select Your First Color', 'photography-album' ),
		'section'     => 'photography_album_theme_color_section',
		'default'     => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'photography-album' ),
		'default'  => '<a class="premium_info_btn" target="_blank" href="' . esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'photography-album' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'photography_album_theme_color_section',
    ] );

    /* Global Color End */

    //Home page Setting Panel
	new \Kirki\Panel(
		'photography_album_home_page_section',
		[
			'priority'    => 10,
			'title'       => esc_html__( 'Home Page Sections', 'photography-album' ),
			'priority'    => 20,
		]
	);

	/* Header */

	new \Kirki\Section(
		'photography_album_header_button_section',
		[
			'title'       => esc_html__( 'Header', 'photography-album' ),
			'description' => esc_html__( 'Here you can add header button text and link.', 'photography-album' ),
			'panel'		  => 'photography_album_home_page_section',
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'photography_album_header_phone_number',
			'label'    => esc_html__( 'Add Phone Number', 'photography-album' ),
			'section'  => 'photography_album_header_button_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'photography-album' ),
		'default'  => '<a class="premium_info_btn" target="_blank" href="' . esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'photography-album' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'photography_album_header_button_section',
    ] );

	/* Home Slider */

	new \Kirki\Section(
		'photography_album_home_slider_section',
		[
			'title'       => esc_html__( 'Home Slider', 'photography-album' ),
			'description' => esc_html__( 'Here you can add slider image, title and text.', 'photography-album' ),
			'panel'		  => 'photography_album_home_page_section',
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_slide_on_off',
			'label'       => esc_html__( 'Slider On / Off', 'photography-album' ),
			'section'     => 'photography_album_home_slider_section',
			'default'     => 'off',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	new \Kirki\Field\Number(
		[
			'settings' => 'photography_album_slide_count',
			'label'    => esc_html__( 'Slider Number Control', 'photography-album' ),
			'section'  => 'photography_album_home_slider_section',
			'default'  => '',
			'choices'  => [
				'min'  => 1,
				'max'  => 3,
				'step' => 1,
			],
		]
	);

	$photography_album_slide_count = get_theme_mod('photography_album_slide_count');

	for ($i=1; $i <= $photography_album_slide_count; $i++) { 
		
		new \Kirki\Field\Image(
			[
				'settings'    => 'photography_album_slider_image'.$i,
				'label'       => esc_html__( 'Slider Image 0', 'photography-album' ).$i,
				'section'     => 'photography_album_home_slider_section',
				'default'     => '',
			]
		);

		new \Kirki\Field\Image(
			[
				'settings'    => 'photography_album_slider_image_b'.$i,
				'label'       => esc_html__( 'Image-2 0', 'photography-album' ).$i,
				'section'     => 'photography_album_home_slider_section',
				'default'     => '',
			]
		);

		new \Kirki\Field\Text(
			[
				'settings' => 'photography_album_slider_short_heading'.$i,
				'label'    => esc_html__( 'Short Heading 0', 'photography-album' ).$i,
				'section'  => 'photography_album_home_slider_section',
			]
		);

		new \Kirki\Field\Text(
			[
				'settings' => 'photography_album_slider_heading'.$i,
				'label'    => esc_html__( 'Main Heading 0', 'photography-album' ).$i,
				'section'  => 'photography_album_home_slider_section',
			]
		);

		new \Kirki\Field\Text(
			[
				'settings' => 'photography_album_slider_content'.$i,
				'label'    => esc_html__( 'Content 0', 'photography-album' ).$i,
				'section'  => 'photography_album_home_slider_section',
			]
		);

		new \Kirki\Field\Text(
			[
				'settings' => 'photography_album_button_text'.$i,
				'label'    => esc_html__( 'Button Text 0', 'photography-album' ).$i,
				'section'  => 'photography_album_home_slider_section',
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'photography_album_button_link'.$i,
				'label'    => esc_html__( 'Button Url 0', 'photography-album' ).$i,
				'section'  => 'photography_album_home_slider_section',
				'default'  => '',
			]
		);
	}


	new \Kirki\Field\URL(
		[
			'settings' => 'photography_album_top_twitter_link',
			'label'    => esc_html__( 'Add Twitter Link', 'photography-album' ),
			'section'  => 'photography_album_home_slider_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	new \Kirki\Field\URL(
		[
			'settings' => 'photography_album_top_linkdin_link',
			'label'    => esc_html__( 'Add Linkdin Link', 'photography-album' ),
			'section'  => 'photography_album_home_slider_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	new \Kirki\Field\URL(
		[
			'settings' => 'photography_album_top_youtube_link',
			'label'    => esc_html__( 'Add Youtube Link', 'photography-album' ),
			'section'  => 'photography_album_home_slider_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	new \Kirki\Field\URL(
		[
			'settings' => 'photography_album_top_facebook_link',
			'label'    => esc_html__( 'Add Facebook Link', 'photography-album' ),
			'section'  => 'photography_album_home_slider_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	new \Kirki\Field\URL(
		[
			'settings' => 'photography_album_top_instagram_link',
			'label'    => esc_html__( 'Add Instagram Link', 'photography-album' ),
			'section'  => 'photography_album_home_slider_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'photography-album' ),
		'default'  => '<a class="premium_info_btn" target="_blank" href="' . esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'photography-album' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'photography_album_home_slider_section',
    ] );

	/* Home About */

	new \Kirki\Section(
		'photography_album_home_about_section',
		[
			'title'       => esc_html__( 'Home About Us', 'photography-album' ),
			'description' => esc_html__( 'Here you can add about content with images.', 'photography-album' ),
			'panel'		  => 'photography_album_home_page_section',
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_about_on_off',
			'label'       => esc_html__( 'About On / Off', 'photography-album' ),
			'section'     => 'photography_album_home_about_section',
			'default'     => false,
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'photography_album_about_title',
			'label'    => esc_html__( 'Main Title', 'photography-album' ),
			'section'  => 'photography_album_home_about_section',
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'photography_album_about_sub_title',
			'label'    => esc_html__( 'Sub Title', 'photography-album' ),
			'section'  => 'photography_album_home_about_section',
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'photography_album_about_content',
			'label'    => esc_html__( 'Content', 'photography-album' ),
			'section'  => 'photography_album_home_about_section',
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'photography_album_about_button_text',
			'label'    => esc_html__( 'Button Text', 'photography-album' ),
			'section'  => 'photography_album_home_about_section',
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'photography_album_about_button_link',
			'label'    => esc_html__( 'Button Link', 'photography-album' ),
			'section'  => 'photography_album_home_about_section',
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'photography_album_about_customer_count',
			'label'    => esc_html__( 'Customer Satisfaction Count', 'photography-album' ),
			'section'  => 'photography_album_home_about_section',
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'photography_album_about_customer',
			'label'    => esc_html__( 'Customer Satisfaction Text', 'photography-album' ),
			'section'  => 'photography_album_home_about_section',
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'photography_album_about_photography_count',
			'label'    => esc_html__( 'Photography Session Count', 'photography-album' ),
			'section'  => 'photography_album_home_about_section',
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'photography_album_about_photography',
			'label'    => esc_html__( 'Photography Session Text', 'photography-album' ),
			'section'  => 'photography_album_home_about_section',
		]
	);

	new \Kirki\Field\Image(
		[
			'settings'    => 'photography_album_about_image_a',
			'label'       => esc_html__( 'About Image A', 'photography-album' ),
			'section'     => 'photography_album_home_about_section',
			'default'     => '',
		]
	);

	new \Kirki\Field\Image(
		[
			'settings'    => 'photography_album_about_image_b',
			'label'       => esc_html__( 'About Image B', 'photography-album' ),
			'section'     => 'photography_album_home_about_section',
			'default'     => '',
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'photography-album' ),
		'default'  => '<a class="premium_info_btn" target="_blank" href="' . esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'photography-album' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'photography_album_home_about_section',
    ] );

	/* Footer */

	new \Kirki\Section(
		'photography_album_footer_section',
		[
			'title'       => esc_html__( 'Footer', 'photography-album' ),
			'panel'		  => 'photography_album_home_page_section',
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_footer_widgets_on_off',
			'label'       => esc_html__( 'Footer Widgets On / Off', 'photography-album' ),
			'section'     => 'photography_album_footer_section',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_copyright_on_off',
			'label'       => esc_html__( 'Footer Copyright On / Off', 'photography-album' ),
			'section'     => 'photography_album_footer_section',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'photography_album_copyright_content_text',
			'label'    => esc_html__( 'Copyright Text', 'photography-album' ),
			'section'  => 'photography_album_footer_section',
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'photography-album' ),
		'default'  => '<a class="premium_info_btn" target="_blank" href="' . esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'photography-album' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'photography_album_footer_section',
    ] );

	/* Single Post Options */

	new \Kirki\Section(
		'photography_album_single_post_options',
		[
			'title'       => esc_html__( 'Single Post Options', 'photography-album' ),
			'priority'    => 30,
		]
	);
    
    /* Single Post Heading Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_single_post_heading_on_off',
			'label'       => esc_html__( 'Single Post Heading On / Off', 'photography-album' ),
			'section'     => 'photography_album_single_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	/* Single Post Content Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_single_post_content_on_off',
			'label'       => esc_html__( 'Single Post Content On / Off', 'photography-album' ),
			'section'     => 'photography_album_single_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	/* Single Post Meta Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_single_meta_on_off',
			'label'       => esc_html__( 'Single Post Meta On / Off', 'photography-album' ),
			'section'     => 'photography_album_single_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	/* Single Post Feature Image Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_single_post_image_on_off',
			'label'       => esc_html__( 'Single Post Feature Image On / Off', 'photography-album' ),
			'section'     => 'photography_album_single_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	/* Single Post Pagination Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_single_post_pagination_on_off',
			'label'       => esc_html__( 'Single Post Pagination On / Off', 'photography-album' ),
			'section'     => 'photography_album_single_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'photography-album' ),
		'default'  => '<a class="premium_info_btn" target="_blank" href="' . esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'photography-album' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'photography_album_single_post_options',
    ] );

	/* Post Options */

	new \Kirki\Section(
		'photography_album_post_options',
		[
			'title'       => esc_html__( 'Post Options', 'photography-album' ),
			'priority'    => 30,
		]
	);
    
    /* Post Image Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_post_image_on_off',
			'label'       => esc_html__( 'Post Image On / Off', 'photography-album' ),
			'section'     => 'photography_album_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	/* Post Heading Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_post_heading_on_off',
			'label'       => esc_html__( 'Post Heading On / Off', 'photography-album' ),
			'section'     => 'photography_album_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	/* Post Content Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_post_content_on_off',
			'label'       => esc_html__( 'Post Content On / Off', 'photography-album' ),
			'section'     => 'photography_album_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	/* Post Date Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_post_date_on_off',
			'label'       => esc_html__( 'Post Date On / Off', 'photography-album' ),
			'section'     => 'photography_album_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	/* Post Comments Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_post_comment_on_off',
			'label'       => esc_html__( 'Post Comments On / Off', 'photography-album' ),
			'section'     => 'photography_album_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	/* Post Author Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_post_author_on_off',
			'label'       => esc_html__( 'Post Author On / Off', 'photography-album' ),
			'section'     => 'photography_album_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	/* Post Categories Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_post_categories_on_off',
			'label'       => esc_html__( 'Post Categories On / Off', 'photography-album' ),
			'section'     => 'photography_album_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	/* Post limit Option End */
	new \Kirki\Field\Slider(
		[
			'settings'    => 'photography_album_post_content_limit',
			'label'       => esc_html__( 'Post Content Limit', 'photography-album' ),
			'section'     => 'photography_album_post_options',
			'default'     => 15,
			'choices'     => [
				'min'  => 0,
				'max'  => 50,
				'step' => 1,
			],
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'photography-album' ),
		'default'  => '<a class="premium_info_btn" target="_blank" href="' . esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'photography-album' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'photography_album_post_options',
    ] );

	/* Post Options End */

	/* Post Options */

	new \Kirki\Section(
		'photography_album_post_layouts_section',
		[
			'title'       => esc_html__( 'Post Layout Options', 'photography-album' ),
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Radio_Image(
		[
			'settings'    => 'photography_album_post_layout',
			'label'       => esc_html__( 'Blog Layout', 'photography-album' ),
			'section'     => 'photography_album_post_layouts_section',
			'default'     => 'two_column_right',
			'priority'    => 10,
			'choices'     => [
				'one_column'   => get_template_directory_uri().'/images/1column.png',
				'two_column_right' => get_template_directory_uri().'/images/right-sidebar.png',
				'two_column_left'  => get_template_directory_uri().'/images/left-sidebar.png',
				'three_column'  => get_template_directory_uri().'/images/3column.png',
				'four_column'  => get_template_directory_uri().'/images/4column.png',
				'grid_post'  => get_template_directory_uri().'/images/grid.png',
			],
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'photography-album' ),
		'default'  => '<a class="premium_info_btn" target="_blank" href="' . esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'photography-album' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'photography_album_post_layouts_section',
    ] );

	/* Post Options End */

	/* 404 Page */

	new \Kirki\Section(
		'photography_album_404_page_section',
		[
			'title'       => esc_html__( '404 Page', 'photography-album' ),
			'description' => esc_html__( 'Here you can add 404 Page information.', 'photography-album' ),
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'photography_album_404_page_heading',
			'label'    => esc_html__( 'Add Heading', 'photography-album' ),
			'section'  => 'photography_album_404_page_section',
			'default'  => esc_html__( '404', 'photography-album' ),
			'priority' => 10,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'photography_album_404_page_content',
			'label'    => esc_html__( 'Add Content', 'photography-album' ),
			'section'  => 'photography_album_404_page_section',
			'default'  => esc_html__( 'Ops! Something happened...', 'photography-album' ),
			'priority' => 10,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'photography_album_404_page_button',
			'label'    => esc_html__( 'Add Button', 'photography-album' ),
			'section'  => 'photography_album_404_page_section',
			'default'  => esc_html__( 'Home', 'photography-album' ),
			'priority' => 10,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'photography-album' ),
		'default'  => '<a class="premium_info_btn" target="_blank" href="' . esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'photography-album' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'photography_album_404_page_section',
    ] );

	/* 404 Page End */

	/* General Options */

	new \Kirki\Section(
		'photography_album_general_options_section',
		[
			'title'       => esc_html__( 'General Options', 'photography-album' ),
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_preloader_setting',
			'label'       => esc_html__( 'Preloader On / Off', 'photography-album' ),
			'section'     => 'photography_album_general_options_section',
			'default'     => 'off',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'photography_album_scroll_to_top_setting',
			'label'       => esc_html__( 'Scroll To Top On / Off', 'photography-album' ),
			'section'     => 'photography_album_general_options_section',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'photography-album' ),
				'off' => esc_html__( 'Disable', 'photography-album' ),
			],
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'photography-album' ),
		'default'  => '<a class="premium_info_btn" target="_blank" href="' . esc_url( PHOTOGRAPHY_ALBUM_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'photography-album' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'photography_album_general_options_section',
    ] );

	/* General Options End */

}