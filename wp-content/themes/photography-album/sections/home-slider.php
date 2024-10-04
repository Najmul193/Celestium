<?php if ( true == get_theme_mod( 'photography_album_slide_on_off', 'off' ) ) : ?>

<?php $photography_album_slide_count = get_theme_mod('photography_album_slide_count'); ?>

<section id="home_slider">
	<div class="owl-carousel">
		<?php for ($i=1; $i <= $photography_album_slide_count; $i++) {
			
			$photography_album_slider_image = get_theme_mod('photography_album_slider_image'.$i);
			$photography_album_slider_short_heading = get_theme_mod('photography_album_slider_short_heading'.$i);
			$photography_album_slider_heading = get_theme_mod('photography_album_slider_heading'.$i);
			$photography_album_slider_content = get_theme_mod('photography_album_slider_content'.$i);

			$photography_album_button_text = get_theme_mod('photography_album_button_text'.$i);
			$photography_album_button_link = get_theme_mod('photography_album_button_link'.$i); 
			$photography_album_slider_image_b = get_theme_mod('photography_album_slider_image_b'.$i); ?>

			<div class="slider_main_box">
				<?php if ( ! empty( $photography_album_slider_image ) ) : ?>
					<img src="<?php echo esc_url( $photography_album_slider_image ); ?>">
					<div class="slider_content_box">
						<?php if ( ! empty( $photography_album_slider_short_heading ) ) : ?>
							<h5><?php echo esc_html( $photography_album_slider_short_heading ); ?></h5>
						<?php endif; ?>
						<?php if ( ! empty( $photography_album_slider_heading ) ): ?>
							<h3><?php echo esc_html( $photography_album_slider_heading ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $photography_album_slider_content ) ): ?>
							<p><?php echo esc_html( $photography_album_slider_content ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $photography_album_button_text ) || ! empty( $photography_album_button_link ) ): ?>
							<a class="slider-btn" href="<?php echo esc_url( $photography_album_button_link ); ?>"><?php echo esc_html( $photography_album_button_text ); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div class="imageb">
					<img src="<?php echo esc_url( $photography_album_slider_image_b ); ?>">
				</div>
			</div>
		<?php } ?>
	</div>
	<?php
		$photography_album_top_twitter_link = get_theme_mod('photography_album_top_twitter_link');
		$photography_album_top_linkdin_link = get_theme_mod('photography_album_top_linkdin_link');
		$photography_album_top_youtube_link = get_theme_mod('photography_album_top_youtube_link');
		$photography_album_top_facebook_link = get_theme_mod('photography_album_top_facebook_link');
		$photography_album_top_instagram_link = get_theme_mod('photography_album_top_instagram_link');
	?>
	<div class="icons-media">
		<?php if ( ! empty( $photography_album_top_twitter_link ) ): ?>
			<a href="<?php echo esc_url( $photography_album_top_twitter_link ); ?>"><i class="bi bi-twitter-x" aria-hidden="true"></i>
			</a>
		<?php endif; ?>
		<?php if ( ! empty( $photography_album_top_linkdin_link ) ): ?>
			<a href="<?php echo esc_url( $photography_album_top_linkdin_link ); ?>"><i class="bi bi-linkedin" aria-hidden="true"></i>
			</a>
		<?php endif; ?>
		<?php if ( ! empty( $photography_album_top_youtube_link ) ): ?>
			<a href="<?php echo esc_url( $photography_album_top_youtube_link ); ?>"><i class="bi bi-youtube" aria-hidden="true"></i>
			</a>
		<?php endif; ?>
		<?php if ( ! empty( $photography_album_top_facebook_link ) ): ?>
			<a href="<?php echo esc_url( $photography_album_top_facebook_link ); ?>"><i class="bi bi-facebook" aria-hidden="true"></i>
			</a>
		<?php endif; ?>
		<?php if ( ! empty( $photography_album_top_instagram_link ) ): ?>
			<a href="<?php echo esc_url( $photography_album_top_instagram_link ); ?>"><i class="bi bi-instagram" aria-hidden="true"></i>
			</a>
		<?php endif; ?>
	</div>
</section>

<?php endif; ?>