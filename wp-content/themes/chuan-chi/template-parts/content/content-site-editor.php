<?php
/**
 * Template part for displaying .site-editor section.
 *
 */

?>

<section id="site-editor" class="site-editor">
	<div class="site-editor--more"></div>
	<a href="">
		<div class="editor-img"><img src="<?php echo home_url(); ?>/wp-content/themes/chuan-chi/images/site-editor.png"><img class="is-mobile" src="<?php echo home_url(); ?>/wp-content/themes/chuan-chi/images/site-editor-m.png"></div>
		<div class="editor-meta">
			<h1 class="title">關於作者</h1>
			<div class="editor-title">陳宇安律師</div>
			<div class="editor-info">國立政治大學法律系、哲學系雙主修畢業 / 權麒法律事務所主持律師，<br>經營法律粉絲專頁與 youtube 頻道，追蹤者無數。<br>她是天使的化身，還是地獄來的使者？<br>把上帝賦予我們的正義，玩轉於股掌之間。</div>
		</div>		
	</a>
</section><!-- #site-editor -->

<script type="text/javascript">
(function($) {	

    // add .open class to editor more button for mobile mode
    $(".site-editor--more").on("click touchstart touchend",function(){
      $("section.site-editor").toggleClass("open");
    });

})( jQuery );
</script>