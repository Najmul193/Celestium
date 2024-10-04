<?php if ( true == get_theme_mod( 'photography_album_about_on_off', false ) ) : ?>

<?php

$photography_album_about_title = get_theme_mod('photography_album_about_title');
$photography_album_about_sub_title = get_theme_mod('photography_album_about_sub_title');
$photography_album_about_content = get_theme_mod('photography_album_about_content');
$photography_album_about_button_text = get_theme_mod('photography_album_about_button_text');
$photography_album_about_button_link = get_theme_mod('photography_album_about_button_link');
$photography_album_about_customer_count = get_theme_mod('photography_album_about_customer_count');
$photography_album_about_customer = get_theme_mod('photography_album_about_customer');
$photography_album_about_photography_count = get_theme_mod('photography_album_about_photography_count');
$photography_album_about_photography = get_theme_mod('photography_album_about_photography');
$photography_album_about_image_a = get_theme_mod('photography_album_about_image_a');
$photography_album_about_image_b = get_theme_mod('photography_album_about_image_b');

?>

<section id="home_about">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-md-12 align-self-center">
				<?php if ( ! empty( $photography_album_about_title ) ): ?>
					<h4><?php echo esc_html( $photography_album_about_title ); ?></h4>
				<?php endif; ?>
				<?php if ( ! empty( $photography_album_about_sub_title ) ): ?>
					<h3><?php echo esc_html( $photography_album_about_sub_title ); ?></h3>
				<?php endif; ?>
				<?php if ( ! empty( $photography_album_about_content ) ): ?>
					<p class="content-a"><?php echo esc_html( $photography_album_about_content ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $photography_album_about_button_text ) ): ?>
					<a class="about-btn" href="<?php echo esc_url( $photography_album_about_button_link ); ?>"><?php echo esc_html( $photography_album_about_button_text ); ?></a>
				<?php endif; ?>
				<div class="row">
					<div class="col-lg-6 col-md-6 align-self-center">
						<?php if ( ! empty( $photography_album_about_customer_count ) ): ?>
						<div class="display-box">
								<p class="count"><?php echo esc_html( $photography_album_about_customer_count ); ?></p>
							<?php if ( ! empty( $photography_album_about_customer ) ): ?>
								<p><?php echo esc_html( $photography_album_about_customer ); ?></p>
							<?php endif; ?>
						</div>
						<hr class="hr-a">
						<hr class="hr-b">
						<?php endif; ?>
					</div>
					<div class="col-lg-6 col-md-6 align-self-center">
						<?php if ( ! empty( $photography_album_about_photography_count ) ): ?>
						<div class="display-box">
								<p class="count"><?php echo esc_html( $photography_album_about_photography_count ); ?></p>
							<?php if ( ! empty( $photography_album_about_photography ) ): ?>
								<p><?php echo esc_html( $photography_album_about_photography ); ?></p>
							<?php endif; ?>
						</div>
						<hr class="hr-a">
						<hr class="hr-b">
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-lg-5 col-md-12 align-self-center image-ab">
				<div class="row">
					<div class="col-lg-6 col-md-6 align-self-center">
		             	<?php if ( ! empty( $photography_album_about_image_b ) ) : ?>
		             		<div class="shape-b"></div>
		              		<img class="image-b" src="<?php echo esc_url( $photography_album_about_image_b ); ?>">
		            	<?php endif; ?>
		            </div>
					<div class="col-lg-6 col-md-6 align-self-center">
						<?php if ( ! empty( $photography_album_about_image_a ) ) : ?>
							<div class="shape-a"></div>
		              		<img class="image-a" src="<?php echo esc_url( $photography_album_about_image_a ); ?>">
		            	<?php endif; ?>
		            </div>
	            </div>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>