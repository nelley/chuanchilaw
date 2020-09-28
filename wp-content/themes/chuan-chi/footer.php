		</div><!-- #content -->

		<div class="back-to-top">
			<a href="#page"><img src="<?php echo home_url(); ?>/wp-content/themes/chuan-chi/images/back-to-top.png"></a>
		</div>

		<footer id="footer" class="site-footer">
			<div class="footer-navigation-container">
				<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'twentynineteen' ); ?>">
						<div class="footer-nav-title">關於</div>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'menu_class'     => 'footer-menu',
								'depth'          => 1,
							)
						);
						?>
					</nav><!-- .footer-navigation -->
				<?php endif; ?>

				<nav class="main-navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'twentynineteen' ); ?>">
					<div class="footer-nav-title">法律文章</div>
					<ul id="menu-main-menu" class="main-menu">
						<?php // load only top categories
							$categories = get_categories( array(
							    'orderby' => 'name',
							    'parent'  => 0
							) );
							
							foreach ( $categories as $category ) {
					        	$output = '';
                                $output = '<li id="menu-item-' . $category->term_id . '" class="menu-item menu-item-' . $category->term_id . '">';
							    $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
						        $output .= '</li>';
						        
							    echo $output;
							}
						?>
					</ul>
				</nav><!-- #site-navigation -->

				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'twentynineteen' ); ?>">
						<div class="footer-nav-title">社群</div>
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
				<div class="footer-contact">
					<div class="footer-nav-title">聯絡我們</div>
					<div class="footer-contact-info">
						<li>台北市大安區羅斯福路二段91號四樓之2</li>
						<li>電話 02-2368-8013</li>
                        <li>傳真 02-2368-2688</li>
                        <li><a href="mailto:yuanchen0113@gmail.com">yuanchen0113@gmail.com</a></li>
					</div>
				</div>
			</div>

			<div class="colophon-container">
				<div class="logo"><img src="<?php echo home_url(); ?>/wp-content/themes/chuan-chi/images/chuan-chi-logo-footer.png"></div>
				<div class="colophon">
					<div>©️2019 CHUAN CHI</div>
					<div>Concept and Design::</div>
					<div>M.J. Wu | <a href="mailto:justmandy16@gmail.com">justmandy16@gmail.com</a></div>
				</div>
			</div>
		</footer><!-- #footer -->
	</div><!-- .site-content-container -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>


<script type="text/javascript">
// The checker
const sectionIsInView = el => {
    const scroll = window.scrollY || window.pageYOffset
    const boundsTop = el.getBoundingClientRect().top + scroll

    const viewport = {
        top: scroll,
        bottom: scroll + window.innerHeight,
    }

    const bounds = {
        top: boundsTop,
        bottom: boundsTop + el.clientHeight,
    }
    
    const top_offset = window.innerHeight/13;
    const bottom_offset = window.innerHeight/3;
    
    console.log(el.id + ':' + bounds.top + ',' + bounds.bottom);
    console.log(el.id + ':' + viewport.top + ',' + viewport.bottom);
    console.log(bounds.bottom >= (viewport.top) && bounds.bottom <= (viewport.bottom));
    console.log(bounds.top <= (viewport.bottom) && bounds.top >= (viewport.top));
    return ( bounds.bottom >= (viewport.top+top_offset) && bounds.bottom <= (viewport.bottom-bottom_offset*2) ) 
        || ( bounds.top <= (viewport.bottom-bottom_offset*2) && bounds.top >= (viewport.top+top_offset))
        || ( bounds.bottom >= (viewport.bottom-bottom_offset*2) && bounds.top <= (viewport.top+top_offset));
        
    //return ( bounds.bottom >= viewport.top && bounds.bottom <= viewport.bottom ) 
    //    || ( bounds.top <= viewport.bottom && bounds.top >= viewport.top)
    //    || ( bounds.bottom >= viewport.bottom && bounds.top <= viewport.top);

}

// requestAnimationFrame
const raf = 
    window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    function( callback ) {
        window.setTimeout( callback, 1000 / 60 )
    };

(function($) {	
	// detect the facebook/youtube/line links and insert the icon in it.
	var fb_text = ".social-navigation a[href*='facebook'] .social-links-text";
	var fb_anchor = ".social-navigation a[href*='facebook']";
	var fb_icon = "<i class='fb-btn'></i>";

	var yt_text = ".social-navigation a[href*='youtube'] .social-links-text, .social-navigation a[href*='youtu.be'] .social-links-text";
	var yt_anchor = ".social-navigation a[href*='youtube'], .social-navigation a[href*='youtu.be']";
	var yt_icon = "<i class='yt-btn'></i>";

	var l_text = ".social-navigation a[href*='line'] .social-links-text";
	var l_anchor = ".social-navigation a[href*='line']";
	var l_icon = "<i class='l-btn'></i>";

	$( fb_text ).css( "display", "none" ).add( fb_icon ).appendTo( fb_anchor );
	$( yt_text ).css( "display", "none" ).add( yt_icon ).appendTo( yt_anchor );
	$( l_text ).css( "display", "none" ).add( l_icon ).appendTo( l_anchor );
	$( fb_anchor + ", " + yt_anchor + ", " + l_anchor ).css( { "border": "none", "padding": "0"} )
	

    
    //organize the category name and ID
    var cats_name_id_array = [];
    $('#menu-main-menu li a').each(function(i, li){
        if(li.href.indexOf('#')!== -1){
            cats_name_id_array[li.innerHTML] = li.href.substring(li.href.indexOf('#'));
        }
    });
    
    $('section[class*="site-cats"]').each(function(i, ele){
    //$('h1[class*="title"]').each(function(i, ele){
        const handler = () => raf( () => {
            if(sectionIsInView(ele)){
                //console.log(ele.id);
                //console.log(cats_name_id_array[ele.innerHTML]);
                var current_menu= $('a[href="#' + ele.id + '"]').parent()
                //var current_menu= $('a[href="' + cats_name_id_array[ele.innerHTML] + '"]').parent()
                //console.log(current_menu);
                if(current_menu){
                    var current = current_menu.attr('class');
                    if(!(current.indexOf('current') !== -1)){
                        current_menu.attr('class', current+ ' current');
                    }
                }
            }else{
                var classObj = $('a[href="#' + ele.id + '"]').parent();
                //var classObj = $('a[href="' + cats_name_id_array[ele.innerHTML] + '"]').parent();
                
                if(classObj.attr('class').indexOf('current' ) !== -1){
                    //console.log('Before:' + classStr);
                    var new_str = classObj.attr('class').replace(/current/g,'').trim();
                    //console.log('After:' + new_str);
                    classObj.attr('class', new_str);
                }
            }
        });
        handler();
        window.addEventListener('scroll', handler);
    });
    
    $('section.latest-posts').not('.mobile').each(function(i, ele){
        const handler = () => raf( () => {
            if(sectionIsInView( ele )){
                console.log('latest-posts');
                $('#menu-main-menu li').each(function(i, li){
                    li.className= 'menu-item ' + li.id;
                });
            }
        });
        handler();
        window.addEventListener('scroll', handler);
    });


    // handle the ellipse button for main menu
    $(".ellipses-to-nav").on("click touchstart touchend",function(){
      $(this).toggleClass("open");
      $("#site-navigation ul").toggleClass("open");
      $(".top-nav").toggleClass("expanded");

	    var handleMatchMedia = function (mediaQuery) {
	        if (mediaQuery.matches) {
        	  // mark the icon group.
        	  $('nav.social-navigation ul#menu-social li').has("a[href*='facebook'], a[href*='youtube'], a[href*='line']").addClass('social-btn');
        	  $('nav.social-navigation ul#menu-social li').not('.social-btn').addClass('social-inner-link');
        	  // only once 
        	  if ( !$( "#mobile-social-menu" ).length ) { 
        	  	$('<div/>', { id: 'mobile-social-menu' }).appendTo('nav.main-navigation ul.open div');
        	  	$('<div/>', { id: 'mobile-social-inner-link' }).insertBefore('#mobile-social-menu');
        	  	// paste icon group
        	  	$('nav.social-navigation ul#menu-social li.social-btn').appendTo('#mobile-social-menu');
        	  	// paste normal group 
        	  	$('nav.social-navigation ul#menu-social li.social-inner-link').appendTo('#mobile-social-inner-link'); 
        	  }
        	
	        } else {  // reset      	
	        	$('#mobile-social-menu li').removeClass('social-btn').appendTo('nav.social-navigation ul#menu-social');
	        	$('#mobile-social-inner-link li').removeClass('social-inner-link').appendTo('nav.social-navigation ul#menu-social');
	        	$('#mobile-social-menu, #mobile-social-inner-link').remove();
	        }
	    },
	    mql = window.matchMedia('all and (max-width: 760px)');

	    handleMatchMedia(mql);
	    mql.addListener(handleMatchMedia);
    });


    // handle the footer
    var handleMatchMedia = function (mediaQuery) {
        if (mediaQuery.matches) {
        	// mark the latest section
        	$('section[class="latest-posts"]').addClass('mobile');

        	// Clone the header main menu to the footer in mobile mode
        	$("#site-navigation ul").clone().attr('id', 'mobile-main-menu').addClass('mobile-clone').prependTo("footer.site-footer");

        	// Footer reconstruction
        	$('footer .main-navigation,	footer .social-navigation, .footer-navigation > div.footer-nav-title, .footer-nav-title, footer > .colophon-container').css('display', 'none');
        	$('<div/>', { class: 'footer-branding mobile-clone' }).prependTo('.footer-navigation-container');
        	$('.colophon-container .logo').clone().addClass('mobile-clone').appendTo('footer .footer-branding');
        	$('nav.social-navigation .menu-social-container #menu-social').clone().addClass('mobile-clone').appendTo('footer .footer-branding');
        	$('<div/>', { class: 'colophon-container mobile-clone' }).appendTo('.footer-navigation-container');
        	$('.colophon-container .colophon').clone().addClass('mobile-clone').appendTo('.footer-navigation-container > .colophon-container');
        } else {       // reset 	
        	$('footer .main-navigation,	footer .social-navigation, .footer-navigation > div.footer-nav-title, .footer-nav-title, footer > .colophon-container').css('display', 'inherit');
        	$('.mobile-clone').remove(); 
        	$('section.latest-posts').removeClass('mobile');
        }
    },
    mql = window.matchMedia('all and (max-width: 760px)');

    handleMatchMedia(mql);
    mql.addListener(handleMatchMedia);
    
})(jQuery );
</script>
