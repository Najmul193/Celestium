<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photography Album
 */

get_header();
?>
<section id="blog-content">
	<div class="featured-img">
		<div class="post-thumbnail">
			<?php
				if ( is_single() ) :
				    if ( true == get_theme_mod( 'photography_album_single_post_image_on_off', 'on' ) ) :
				        if ( has_post_thumbnail() ) : ?>
				            <a href="<?php the_permalink(); ?>" class="img-responsive center-block" ><?php the_post_thumbnail(); ?></a>
				        <?php endif;
				    endif;
				endif;
			?>
			<div class="single-meta-box">
				<?php if ( is_single() ) : 
					if ( true == get_theme_mod( 'photography_album_single_meta_on_off', 'on' ) ) : ?>
				    <ul class="meta-info list-inline">
				        <li class="posted-by"><i class="bi bi-person-fill"></i> <?php esc_html_e('By', 'photography-album'); ?> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></li>
				        <li class="post-date"><a href="<?php echo esc_url(get_month_link(get_post_time('Y'), get_post_time('m'))); ?>"><i class="bi bi-calendar-date"></i> <?php echo esc_html(get_the_date('j M, Y')); ?></a></li>
				        <li class="post-category"><i class="bi bi-bookmark"></i> <a href="<?php the_permalink(); ?>"><?php the_category(', '); ?></a></li>
				    </ul>
				    <?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8">
				<?php if( have_posts() ): ?>					
					<?php while( have_posts() ): the_post(); ?>
						<?php get_template_part('template-parts/content','page'); ?>
					<?php endwhile; ?>
					
					<!-- Pagination -->
					    <?php if ( true == get_theme_mod( 'photography_album_single_post_pagination_on_off', 'on' ) ) : ?>
							<div class="paginations">
								<?php
									// Previous/next page navigation.
									the_post_navigation( 
										array(
											'prev_text'          => '<i class="bi bi-arrow-left-square"></i>',
											'next_text'          => '<i class="bi bi-arrow-right-square"></i>',
										) 
									); 
								?>
							</div>
				        <?php endif; ?>
					<!-- Pagination -->
					
				<?php else: ?>
					
					<?php get_template_part('template-parts/content','none'); ?>
					
				<?php endif; ?>
				<?php comments_template( '', true ); // show comments  ?>
			</div>
			<div class="col-lg-4 col-md-4 sidebar">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</section>	
<!-- End of Blog & Sidebar Section -->
 
<div class="clearfix"></div>

<?php get_footer(); ?>
