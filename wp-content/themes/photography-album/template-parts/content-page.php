<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package photography-album
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-style-1'); ?>>	
	<div class="post-content p-0 pb-3">
		<div class="post-content-inner read-more-wrapper">
		<?php
			if ( is_single() ) :
				if ( true == get_theme_mod( 'photography_album_single_post_heading_on_off', 'on' ) ) :
					the_title('<h4 class="post-title">', '</h4>' );
				endif;
			else:
				the_title( sprintf( '<h4 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
			endif;
		?> 
		<?php 
		if ( is_single() ) :
			if ( true == get_theme_mod( 'photography_album_single_post_content_on_off', 'on' ) ) :
				the_content( 
					sprintf( 
						__( 'Read More', 'photography-album' ), 
						'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
					) 
				);
			endif;
			else:
					the_content( 
					sprintf( 
						__( 'Read More', 'photography-album' ), 
						'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
					) 
				);
			endif;
		?>
		</div>
	</div>
</article>