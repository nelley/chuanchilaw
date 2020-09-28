<?php
/**
 * The template for displaying categories archive pages
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="title"><?php single_cat_title(''); ?></h1> 
			</header><!-- .page-header -->

			<div class="cats-archive">
			<?php while ( have_posts() ) : the_post(); ?>
					
				<div class="cats temp-1">
					<div class="entry-meta">
						<div class="entry-categories">
							<?php 
								$categories = get_the_category();
								$separator = ' ';
								$output = '';
								if ( ! empty( $categories ) ) {
								    foreach( $categories as $category ) {
								        $output .= '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></li>' . $separator;
								    }
								    echo "<ul>" . $separator . $output . "</ul>";
								} 
							?>
						</div>

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
					</div>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="entry-img">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'thumbnail' ); //“thumbnail”, “medium”, “large” and “full” ?>
							</a>
						</div>
					<?php else: ?>
						<div class="entry-img">
							<a href="<?php the_permalink(); ?>">
								<img src="<?php echo home_url(); ?>/wp-content/themes/chuan-chi/images/default-img.png">
							</a>
						</div>
					<?php endif; ?>

					<div class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>	

					<div class="read-more"><a href="<?php the_permalink(); ?>">read more</a></div>
				</div>

					
			<?php endwhile; ?>
			</div><!-- .cats-archive -->



			<?php // Previous/next page navigation.
				twentynineteen_the_posts_navigation();
			?>

			
		<?php else : ?>

			<?php // If no content, include the "No posts found" template.
				get_template_part( 'template-parts/content/content', 'none' ); 
			?>

		<?php endif; ?>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
