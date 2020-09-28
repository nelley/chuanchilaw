<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'single' );

				if ( is_singular( 'attachment' ) ) {
					// Parent post navigation.
					the_post_navigation(
						array(
							/* translators: %s: parent post link */
							'prev_text' => sprintf( __( '<span class="meta-nav">回到上層</span><span class="post-title">%s</span>', 'twentynineteen' ), '%title' ),
						)
					);
				} elseif ( is_singular( 'post' ) ) {
					// Previous/next post navigation.
					the_post_navigation(
						array(
							'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'NEXT', 'twentynineteen' ) . '</span> ' .
								'<span class="screen-reader-text">' . __( 'Next post:', 'twentynineteen' ) . '</span> <br/>' .
								'<span class="post-title">%title</span>',
							'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'PREV', 'twentynineteen' ) . '</span> ' .
								'<span class="screen-reader-text">' . __( 'Previous post:', 'twentynineteen' ) . '</span> <br/>' .
								'<span class="post-title">%title</span>',
						)
					);
				}

			endwhile; // End of the loop.
			?>

			<?php 
				// Load the .site-editor section
				get_template_part( 'template-parts/content/content', 'site-editor' ); 
			?>

			<?php // Load the related posts. 
				$cats = wp_get_post_categories($post->ID);
				$custom_query_args = array( 
					'category__in' => $cats,
					'posts_per_page' => 2, 
					'post__not_in' => array($post->ID),
					'orderby' => 'rand',
					'caller_get_posts'=>1
				);
				$custom_query = new WP_Query( $custom_query_args ); 

				if ( $custom_query->have_posts() ) : ?>
					<section id="related-posts" class="related-posts">
						<h3 class="title">相關案例</h3>
						<div class="related-container">

							<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
							<div class="related temp">

								<div class="entry-meta">
									<?php echo get_the_date('Y/m/d'); ?>
									<span class="entry-categories">
										<?php 
											$categories = get_the_category();
											$separator = ' ';
											$output = '';
											if ( ! empty( $categories ) ) {
											    foreach( $categories as $category ) {
											        $output .= '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></li>' . $separator;
											    }
											    echo $separator . $output;
											} 
										?>
									</span>
								</div>

								<div class="entry-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</div>

								<div class="entry-excerpt">
									<?php
										if ( has_excerpt() ) {
											echo get_the_excerpt(); 
										} else {
											echo wp_trim_words( get_the_content(), 80, '...' );
										}
									?>
								</div>

								<footer class="entry-footer">
									<div class="entry-tags">
										<?php 
											$postTags = get_the_tags();
											if ( ! empty( $postTags ) ) {
											    echo '<ul>';
											    foreach( $postTags as $post_tag ) {
											        echo '<li><a href="' . get_tag_link( $post_tag ) . '">' . $post_tag->name . '</a></li>';
											    }
											    echo '</ul>';
											}
										?>
									</div>

									<div class="read-more"><a href="<?php the_permalink(); ?>">read more</a></div>
								</footer>	

							</div>
							<?php endwhile; ?>

						</div>
					</section>
				<?php endif; 
				wp_reset_postdata();
			?>	

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
