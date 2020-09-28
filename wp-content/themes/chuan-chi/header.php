<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700|Noto+Serif+TC:400,500,600&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentynineteen' ); ?></a>

		<header id="masthead" class="site-header">
			<div class="top-nav"></div>
			<div class="site-branding-container">
				<div class="sub-navigation">
					<div class="logo">
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo home_url(); ?>/wp-content/themes/chuan-chi/images/chuan-chi-logo.png" class="is-desktop">
							<img src="<?php echo home_url(); ?>/wp-content/themes/chuan-chi/images/chuan-chi-logo-s.png" class="is-tablet">
							<img src="<?php echo home_url(); ?>/wp-content/themes/chuan-chi/images/chuan-chi-logo-mobile.png" class="is-mobile">
						</a>
					</div>

					<?php if ( has_nav_menu( 'social' ) ) : ?>
						<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'twentynineteen' ); ?>">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'social',
									'menu_class'     => 'social-links-menu',
									'link_before'    => '<span class="social-links-text">',
									'link_after'     => '</span>',
									'depth'          => 1,
								)
							);
							?>
						</nav><!-- .social-navigation -->
					<?php endif; ?>	
				</div>

				<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'twentynineteen' ); ?>">
					<i class="ellipses-to-nav"><img src="<?php echo home_url(); ?>/wp-content/themes/chuan-chi/images/ellipse_icon.png"></i>
					<ul id="menu-main-menu" class="main-menu">
						<div>
						<?php // load only top categories
							$categories = get_categories( array(
							    'orderby' => 'name',
							    'parent'  => 0
							) );
							$current_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$INDEX_URL = home_url() . '/';
							
							foreach ( $categories as $category ) {
								$current = '';
					        	if ( (int) $category->term_id === get_queried_object_id() ) {
					        		$current = ' current';
					        	}

					        	$output = '';
                                if(strcmp($current_link,$INDEX_URL) == 0){
                                    $output = '<li id="menu-item-' . $category->term_id . '" class="menu-item menu-item-' . $category->term_id . $current . '">';
								    $output .= '<a href="#site-cats-' . $category->term_id . '">' . esc_html( $category->name ) . '</a>';
								    $output .= '</li>';
                                }else{
                                    $output = '<li id="menu-item-' . $category->term_id . '" class="menu-item menu-item-' . $category->term_id . $current . '">';
								    $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
							        $output .= '</li>';
                                }
								

							    echo $output;
							}
						?>
						</div>
					</ul>	
				</nav><!-- #site-navigation -->

			</div><!-- .site-branding-container -->

			<?php if( is_user_logged_in() ): ?>
				<a href="<?php echo home_url(); ?>/wp-admin" class="admin-door"></a>
			<?php endif; ?>

		</header><!-- #masthead -->

	<div class="site-content-container">
		<div id="content" class="site-content">



<script type="text/javascript">
(function($) {	
    // register the mouseclick listener
    $('#menu-main-menu li').each(function(i, li){
        document.getElementById(li.id).addEventListener("click", on_current);
    });
    
    function on_current() {
        // reset all first
        $('#menu-main-menu li').each(function(i, li){
            li.className= 'menu-item ' + li.id;
        });
        var current_id = $(this).attr('id');
        $('#' + current_id).attr('class', 'menu-item ' + current_id + ' current');
    }

    // replace the anchor href in mobile
    var handleMatchMedia = function (mediaQuery) {
        if (mediaQuery.matches) {
            $('#menu-main-menu li a').each(function(i, li){
                if(li.toString().indexOf('#') > -1){
                    var ahref = li.toString();
                    var cat_num = ahref.substring(ahref.indexOf('#'), ahref.length);
                    var base_url = ahref.substring(0, ahref.indexOf('#'));
                    var cat_num = cat_num.split('-');
                    li.href = base_url +  '?cat=' + cat_num[2];
                }
            });
            
        } else { // reset
            console.log("PC Version");
        }
    },
    mql = window.matchMedia('all and (max-width: 760px)');

    handleMatchMedia(mql);
    mql.addListener(handleMatchMedia);       
        
})( jQuery );

</script>

