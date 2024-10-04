<?php 
	if(isset($_GET['import-demo']) && $_GET['import-demo'] == true){
		// ------- Create Nav Menu --------
		$photography_album_menuname ='Primary Menu';
	    $photography_album_bpmenulocation = 'primary_menu';
	    $photography_album_menu_exists = wp_get_nav_menu_object( $photography_album_menuname );
	    if( !$photography_album_menu_exists){
	        $photography_album_menu_id = wp_create_nav_menu($photography_album_menuname);
	        $photography_album_home_parent = wp_update_nav_menu_item($photography_album_menu_id, 0, array(
				'menu-item-title' =>  __('Home','photography-album'),
				'menu-item-classes' => 'home',
				'menu-item-url' =>home_url( '/' ),
				'menu-item-status' => 'publish')
	    	);

			wp_update_nav_menu_item($photography_album_menu_id, 0, array(
	            'menu-item-title' =>  __('About','photography-album'),
	            'menu-item-classes' => 'about',
	            'menu-item-url' => home_url( '//features/' ), 
	            'menu-item-status' => 'publish'));

	        wp_update_nav_menu_item($photography_album_menu_id, 0, array(
	            'menu-item-title' =>  __('Services','photography-album'),
	            'menu-item-classes' => 'services',
	            'menu-item-url' => home_url( '//services/' ), 
	            'menu-item-status' => 'publish'));

	        wp_update_nav_menu_item($photography_album_menu_id, 0, array(
	            'menu-item-title' =>  __('Gallery','photography-album'),
	            'menu-item-classes' => 'gallery',
	            'menu-item-url' => home_url( '//gallery/' ),
	            'menu-item-status' => 'publish'));

			wp_update_nav_menu_item($photography_album_menu_id, 0, array(
	            'menu-item-title' =>  __('Blog','photography-album'),
	            'menu-item-classes' => 'blog',
	            'menu-item-url' => home_url( '//support/' ),
	            'menu-item-status' => 'publish'));

			wp_update_nav_menu_item($photography_album_menu_id, 0, array(
	            'menu-item-title' =>  __('Contact','photography-album'),
	            'menu-item-classes' => 'contact',
	            'menu-item-url' => home_url( '//contact/' ),
	            'menu-item-status' => 'publish'));
	        
			if( !has_nav_menu( $photography_album_bpmenulocation ) ){
	            $locations = get_theme_mod('nav_menu_locations');
	            $locations[$photography_album_bpmenulocation] = $photography_album_menu_id;
	            set_theme_mod( 'nav_menu_locations', $locations );
	        }
	    }
	    $photography_album_home_id='';
		$photography_album_home_content = '';
		$photography_album_home_title = 'Home';
		$photography_album_home = array(
			'post_type' => 'page',
			'post_title' => $photography_album_home_title,
			'post_content' => $photography_album_home_content,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'home'
		);
		$photography_album_home_id = wp_insert_post($photography_album_home);
	    
		add_post_meta( $photography_album_home_id, '_wp_page_template', 'templates/template-homepage.php' );

		update_option( 'page_on_front', $photography_album_home_id );
		update_option( 'show_on_front', 'page' );

		//---Header--//

		set_theme_mod('photography_album_header_phone_number', '+1234567890');

		//-----Slider-----//

		set_theme_mod( 'photography_album_slide_on_off', 'on' );

		set_theme_mod('photography_album_top_twitter_link', '#');
		set_theme_mod('photography_album_top_linkdin_link', '#');
		set_theme_mod('photography_album_top_youtube_link', '#');
		set_theme_mod('photography_album_top_facebook_link', '#');
		set_theme_mod('photography_album_top_instagram_link', '#');

		set_theme_mod('photography_album_slide_count','3');

		for ($i=1; $i <= 3; $i++) {
			set_theme_mod( 'photography_album_slider_image'.$i, get_template_directory_uri().'/images/demo-import-images/slides/slide_1.png' );
			set_theme_mod('photography_album_slider_short_heading'.$i,'We Craft Emotional Photo Project');
			set_theme_mod('photography_album_slider_heading'.$i, 'Photography Studio');
			set_theme_mod('photography_album_slider_content'.$i,'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.');
			set_theme_mod('photography_album_button_link'.$i, '#');
			set_theme_mod('photography_album_button_text'.$i, 'Contact Us');
			set_theme_mod( 'photography_album_slider_image_b'.$i, get_template_directory_uri().'/images/demo-import-images/slides/slide_imageb_1.png' );
		}

		//-----About Us-----//

		set_theme_mod( 'photography_album_about_on_off', 'on' );

		set_theme_mod('photography_album_about_title','About Us');
		set_theme_mod('photography_album_about_sub_title','Capturing The Essence Of Time, Preserving Your Beautiful Memories');
		set_theme_mod('photography_album_about_content','Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam conse quat sunt nostrud amet. Amet minim mollit non deserunt ullamco. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam conse quat sunt nostrud amet. Amet minim mollit non deserunt ullamco.');
		set_theme_mod('photography_album_about_button_text','Know More');
		set_theme_mod('photography_album_about_button_link','#');
		set_theme_mod('photography_album_about_customer_count','100%');
		set_theme_mod('photography_album_about_customer','Customer Satisfaction');
		set_theme_mod('photography_album_about_photography_count','500+');
		set_theme_mod('photography_album_about_photography','Photography Sessions');
		set_theme_mod('photography_album_about_image_a', get_template_directory_uri().'/images/demo-import-images/about/about_imagea.png' );
		set_theme_mod('photography_album_about_image_b', get_template_directory_uri().'/images/demo-import-images/about/about_imageb.png' );

	}
?>