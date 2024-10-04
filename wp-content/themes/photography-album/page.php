<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photography Album
 */

get_header(); ?>

<section id="service-page" class="section-padding-80">
	<div class="container">
		<div class="row">		
        	<div class="col-lg-8 col-md-8">
				<div class="site-content">
					<?php if ( has_post_thumbnail() ) { ?>
					    <div class="post-thumbnail">
					      <?php the_post_thumbnail(''); ?>
					    </div>
				 	<?php }?>
					<?php 
						if( have_posts()) :  the_post(); ?>
						<h2 class="my-3"><?php the_title(); ?></h2>
						<?php the_content(); 
						endif;
						if( $post->comment_status == 'open' ) { 
							comments_template( '', true ); // show comments 
						}
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'photography-album' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- /.posts -->		
			</div><!-- /.col -->
			<!--/End of Blog Detail-->
			<div class="col-lg-4 col-md-4 sidebar">
				<?php get_sidebar(); ?>	
		    </div>
		</div><!-- /.row -->
	</div><!-- /.container -->
</section>

<?php get_footer(); ?>

