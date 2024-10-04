<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package photography-album
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
	<?php if ( has_post_thumbnail() ) { ?> 
		<div class="post-thumb">
			<?php if ( true == get_theme_mod( 'photography_album_post_image_on_off', 'on' ) ) : ?>
				<?php the_post_thumbnail(); ?>
				<div class="post-overlay">
					<a href="<?php the_permalink(); ?>"><i class="bi bi-link"></i></a>
				</div>
			<?php endif; ?>
		</div>
	<?php } ?>
	<div class="post-content">
		<?php if ( true == get_theme_mod( 'photography_album_post_heading_on_off', 'on' ) ) : ?>
		<?php  
			if ( is_single() ) :
				the_title('<h4 class="post-title">', '</h4>' );
			else:
				the_title( sprintf( '<h4 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
			endif; 
		?>
		<?php endif; ?>
		<?php if ( true == get_theme_mod( 'photography_album_post_content_on_off', 'on' ) ) : ?>
			<p><?php echo wp_trim_words( get_the_content(), get_theme_mod('photography_album_post_content_limit',15) );?></p>
		<?php endif; ?>
	</div>
	<ul class="meta-info">
        <?php if ( true == get_theme_mod( 'photography_album_post_date_on_off', 'on' ) ) : ?>
            <li class="post-date"><a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>"><i class="bi bi-calendar-date"></i><?php echo esc_html(get_the_date('j M, Y')); ?></a></li>
        <?php endif; ?>
        <?php if ( true == get_theme_mod( 'photography_album_post_comment_on_off', 'on' ) ) : ?>
            <li class="comments-quantity"><a href="<?php echo esc_url(get_comments_link( $post->ID )); ?>"><i class="bi bi-chat-fill"></i> (<?php echo get_comments_number($post->ID); ?>) <?php esc_html_e('Comments','photography-album'); ?></a></li>
        <?php endif; ?>
        <?php if ( true == get_theme_mod( 'photography_album_post_author_on_off', 'on' ) ) : ?>
            <li class="posted-by"><i class="bi bi-person-fill"></i> <?php esc_html_e('By','photography-album'); ?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php the_author(); ?></a></li>
        <?php endif; ?>
        <?php if ( true == get_theme_mod( 'photography_album_post_categories_on_off', 'on' ) ) : ?>
            <li class="post-category"><i class="bi bi-bookmark"></i><a href="<?php the_permalink(); ?>"><?php the_category(', '); ?></a></li>
        <?php endif; ?>
    </ul>
</article>