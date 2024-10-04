<!-- Start: Header
============================= -->
<?php


$photography_album_header_phone_number = get_theme_mod('photography_album_header_phone_number');

?>

<header id="header" role="banner" class="mb-2 mb-lg-0" <?php if ( get_header_image() ) { ?> style="background-image: url( <?php header_image(); ?> ); background-size: 100%;" <?php } ?>>
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 align-self-center">
				<div class="logo main">
					<?php if ( function_exists( 'photography_album_logo_title_description' ) ) :photography_album_logo_title_description(); endif; ?>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-3 align-self-center">
				<div class="toggle-menu gb_menu text-start">
					<button onclick="photography_album_navigation_open()" class="gb_toggle"><p class="mb-0"><?php esc_html_e('Menu','photography-album'); ?></p></button>
				</div>
				<div id="gb_responsive" class="nav side_gb_nav">
					<nav id="top_gb_menu" class="gb_nav_menu" role="navigation" aria-label="<?php esc_attr_e( 'Menu', 'photography-album' ); ?>">
						<?php 
						    wp_nav_menu( array( 
								'theme_location' => 'primary_menu',
								'container_class' => 'gb_navigation clearfix' ,
								'menu_class' => 'clearfix',
								'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav mb-0 px-0">%3$s</ul>',
								'fallback_cb' => 'wp_page_menu',
						    ) ); 
						?>
						<a href="javascript:void(0)" class="closebtn gb_menu" onclick="photography_album_navigation_close()">x<span class="screen-reader-text"><?php esc_html_e('Close Menu','photography-album'); ?></span></a>
					</nav>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-9 align-self-center text-end">
				<?php if ( ! empty( $photography_album_header_phone_number ) ): ?>
					<span class="call-box"><i class="bi bi-telephone-fill me-3"></i><?php echo esc_html( $photography_album_header_phone_number ); ?></span>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>