<?php
/**
 * Template part for displaying posts
 */

?>

<article id="post-<?php the_ID(); ?>" class="content-posts">
	<header class="entry-header">
		<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
	</header>

	<div class="entry-content">
		<?php //Load the excerpt
			$excerpt = '';
			if (has_excerpt()) {
			    $excerpt = wp_strip_all_tags(get_the_excerpt());
			    echo '<div class="entry-excerpt">' . $excerpt . '</div>';
			}
		?>

		<?php //Load the thumbnail
			$thumbnail = '';
			if ( has_post_thumbnail() ) {
				$thumbnail = get_the_post_thumbnail( get_the_ID(), 'large'); 
				//“thumbnail”, “medium”, “large” and “full” 
			}
			echo $thumbnail;
		?>

		<?php //Load the post content
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentynineteen' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);

		wp_link_pages( //what's this??????????
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'twentynineteen' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-tags">
			<?php 
				$postTags = get_the_tags();
				if ( ! empty( $postTags ) ) {
				    echo '<ul>' . '<span>Tags: </span>';
				    foreach( $postTags as $post_tag ) {
				        echo '<li><a href="' . get_tag_link( $post_tag ) . '">' . $post_tag->name . '</a></li>';
				    }
				    echo '</ul>';
				}
			?>
		</div>
	</footer><!-- .entry-footer -->

	<?php if ( ! is_singular( 'attachment' ) ) : //what's this?????????? ?>
		<?php get_template_part( 'template-parts/post/author', 'bio' ); ?>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
