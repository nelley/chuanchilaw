<?php
/**
 * Template part for displaying posts in homepage.
 *
 * --------------------
 * # Latest posts
 * # Editor
 * # Categories posts - 1/2
 * # About us
 * # Categories posts - 2/2
 * --------------------
 *
 */

?>

<?php 

    $not_in_array = array();
    $latest1_obj = new stdClass();
    $latest2_obj_arr = [];
    $latest34_obj_arr = [];
    $latest5_obj = new stdClass();
    $latest6_obj_arr = [];
    $latest78_obj_arr = [];
    
    //============================Latest temp 1 Process================================
    // need to store title, tags, categories, permalink, image_url...
    $latest1_args = array('post_type'=>'post',
                          //'category__not_in' => array(1), //exclude Uncategorized cate
                          'orderby'=>'modified',
                          'posts_per_page'=>1,
                          'order'=>'DESC');
    $latest1_query = new WP_Query( $latest1_args );
    while ( $latest1_query->have_posts() ):
        $latest1_query->the_post();
        array_push($not_in_array,get_the_ID());
        $latest1_obj->ID = get_the_ID();
        $latest1_obj->title = get_the_title();
        $latest1_obj->category = get_the_category();
        $latest1_obj->tags = get_the_tags();
        $latest1_obj->permalink = get_permalink();
        $latest1_obj->image_url = get_the_post_thumbnail(get_the_ID(),'thumbnail');
    endwhile;
    wp_reset_postdata();
    //============================Latest temp 2 Process(Grouping)=======================
    // group by category without latest post
    $group_args = array('post_type'=>'post',
                          //'category__not_in' => array(1), //exclude Uncategorized cate
                          'orderby'=>'modified',
                          'post__not_in' => $not_in_array,
                          'posts_per_page'=>50,
                          'order'=>'DESC');
    $group_query = new WP_Query( $group_args );

    $category_cnt_array = array();
    while ( $group_query->have_posts() ):
        $group_query->the_post();
        $cat_names_array = get_the_category();

        foreach($cat_names_array as $cat){
            if(array_key_exists($cat->cat_name, $category_cnt_array)){
                $tmp = $category_cnt_array[$cat->cat_name];
                $tmp += 1;
                $category_cnt_array[$cat->cat_name] = $tmp;
            }else{
                $category_cnt_array[$cat->cat_name] = 1;
            }
        }
    endwhile;
    
    //sort array by value descending
    arsort($category_cnt_array);
    $cat_name_array = array();
    foreach($category_cnt_array as $x => $x_value) {
        //echo "Key=" . $x . ", Value=" . $x_value . "<br>";
        array_push($cat_name_array,$x);
    }
    //echo $cat_name_array[0];
    wp_reset_postdata();
    //============================Latest temp 2 Process================================
    $latest2_args = array('post_type'=>'post',
                          'category_name' => $cat_name_array[0], //choose top1 category
                          'orderby'=>'modified',
                          'post__not_in' => $not_in_array,
                          'posts_per_page'=>3,
                          'order'=>'DESC');
    $latest2_query = new WP_Query( $latest2_args );
    while ( $latest2_query->have_posts() ):
        $latest2_query->the_post();
        array_push($not_in_array,get_the_ID());
        $latest2_obj=new stdClass();
        $latest2_obj->ID = get_the_ID();
        $latest2_obj->title = get_the_title();
        $latest2_obj->category = get_the_category();
        $latest2_obj->tags = get_the_tags();
        $latest2_obj->permalink = get_permalink();
        $latest2_obj->image_url = get_the_post_thumbnail(get_the_ID(),'thumbnail');
        
        array_push($latest2_obj_arr, $latest2_obj);
    endwhile;

    wp_reset_postdata();
    //============================Latest temp 3&4 Process===============================
    $latest34_args = array('post_type'=>'post',
                          //'category__not_in' => array(1), //exclude Uncategorized cate
                          'orderby'=>'modified',
                          'post__not_in' => $not_in_array,
                          'posts_per_page'=>2,
                          'order'=>'DESC');
    $latest34_query = new WP_Query( $latest34_args );
    while ( $latest34_query->have_posts() ):
        $latest34_query->the_post();
        array_push($not_in_array,get_the_ID());
        $latest34_obj=new stdClass();
        $latest34_obj->ID = get_the_ID();
        $latest34_obj->title = get_the_title();
        $latest34_obj->category = get_the_category();
        $latest34_obj->tags = get_the_tags();
        $latest34_obj->permalink = get_permalink();
        $latest34_obj->image_url = get_the_post_thumbnail(get_the_ID(),'thumbnail');
        
        array_push($latest34_obj_arr, $latest34_obj);
    endwhile;
    wp_reset_postdata();

    //============================Latest temp 5 Process================================
    //foreach($not_in_array as $x => $x_value) {
        //echo "Key=" . $x . ", Value=" . $x_value . "<br>";
    //}
    $latest5_args = array('post_type'=>'post',
                          'orderby'=>'modified',
                          'post__not_in' => $not_in_array,
                          'posts_per_page'=>1,
                          'order'=>'DESC');
    $latest5_query = new WP_Query( $latest5_args );
    while ( $latest5_query->have_posts() ):
        $latest5_query->the_post();
        array_push($not_in_array,get_the_ID());
        $latest5_obj->ID = get_the_ID();
        $latest5_obj->title = get_the_title();
        $latest5_obj->category = get_the_category();
        $latest5_obj->tags = get_the_tags();
        $latest5_obj->permalink = get_permalink();
        $latest5_obj->image_url = get_the_post_thumbnail(get_the_ID(),'thumbnail');
    endwhile;
    wp_reset_postdata();

    //============================Latest temp 6 Process================================
    $latest6_args = array('post_type'=>'post',
                          'category_name' => $cat_name_array[1], //choose second category
                          'orderby'=>'modified',
                          'post__not_in' => $not_in_array,
                          'posts_per_page'=>3,
                          'order'=>'DESC');
    $latest6_query = new WP_Query( $latest6_args );
    while ( $latest6_query->have_posts() ):
        $latest6_query->the_post();
        array_push($not_in_array,get_the_ID());
        $latest6_obj=new stdClass();
        $latest6_obj->ID = get_the_ID();
        $latest6_obj->title = get_the_title();
        $latest6_obj->category = get_the_category();
        $latest6_obj->tags = get_the_tags();
        $latest6_obj->permalink = get_permalink();
        $latest6_obj->image_url = get_the_post_thumbnail(get_the_ID(),'thumbnail');
        
        array_push($latest6_obj_arr, $latest6_obj);
    endwhile;
    wp_reset_postdata();
    
    //============================Latest temp 7&8 Process===============================
    $latest78_args = array('post_type'=>'post',
                           'orderby'=>'modified',
                           'post__not_in' => $not_in_array,
                           'posts_per_page'=>2,
                           'order'=>'DESC');
    $latest78_query = new WP_Query( $latest78_args );
    while ( $latest78_query->have_posts() ):
        $latest78_query->the_post();
        array_push($not_in_array,get_the_ID());
        $latest78_obj=new stdClass();
        $latest78_obj->ID = get_the_ID();
        $latest78_obj->title = get_the_title();
        $latest78_obj->category = get_the_category();
        $latest78_obj->tags = get_the_tags();
        $latest78_obj->permalink = get_permalink();
        $latest78_obj->image_url = get_the_post_thumbnail(get_the_ID(),'thumbnail');
        
        array_push($latest78_obj_arr, $latest78_obj);
    endwhile;
    wp_reset_postdata();
    
?>

<section id="latest-posts" class="latest-posts">
	<div class="latest-container">
		<?php if(!empty($latest1_obj)): ?>
			<div class="latest temp-1">
				<div class="entry-meta">
					<div class="entry-categories">
						<ul>
							<?php foreach($latest1_obj->category as $value): ?>
								<li>
									<a href="<?php echo get_category_link(get_cat_ID($value->name)); ?>"><?php echo $value->name; ?></a>
								</li>
							<?php endforeach;                                ?>
						</ul>
					</div>
				</div>
				<h3 class="entry-title"><a href="<?php echo $latest1_obj->permalink; ?>"><?php echo $latest1_obj->title ?></a></h3>
				<div class="entry-img">
				    <a href="<?php echo $latest1_obj->permalink; ?>">
				        <?php if($latest1_obj->image_url){
					             echo $latest1_obj->image_url;
					          }else{
					              echo '<img src="' . home_url().'/wp-content/themes/chuan-chi/images/default-img.png ">';
					          }?>
					</a>
				</div>
			</div>
		<?php endif; ?>
		
		<?php if(!empty($latest2_obj_arr)): ?>
			<div class="latest temp-2">
				<div class="entry-meta">
					<div class="entry-categories">
						<ul>
							<li><a href="<?php echo get_category_link(get_cat_ID($cat_name_array[0])); ?>"><?php echo $cat_name_array[0]; ?></a></li>
						</ul>
					</div>
				</div>
				<div class="posts-list">
					<?php foreach($latest2_obj_arr as $key=>$value): ?>
						<div class="entry-title"><a href="<?php echo $latest2_obj_arr[$key]->permalink; ?>"><?php echo $latest2_obj_arr[$key]->title; ?></a></div>
					<?php endforeach; ?>
				</div>
			</div> 
		<?php endif; ?>
	</div>

	<div class="latest-container">
		<?php if(!empty($latest34_obj_arr)) : ?>
			<?php foreach($latest34_obj_arr as $key=>$value): ?>
				<div class="latest temp-3">
					<div class="entry-img">
					    <a href="<?php echo $latest34_obj_arr[$key]->permalink; ?>">
					        <?php if($latest34_obj_arr[$key]->image_url){
					                  echo $latest34_obj_arr[$key]->image_url;
					              }else{
					                  echo '<img src="' . home_url().'/wp-content/themes/chuan-chi/images/default-img.png ">';
					              }?>
    					</a>
					</div>
					<div class="entry-meta">
						<div class="entry-categories">
							<ul>
								<?php foreach($latest34_obj_arr[$key]->category as $value): ?>
									<li><a href="<?php echo get_category_link(get_cat_ID($value->name)); ?>"><?php echo $value->name; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="entry-tags">
							<ul>
								<?php foreach((array)$latest34_obj_arr[$key]->tags as $value): ?>
									<?php if(isset($value->name)){ ?>
										<li><a href="<?php echo get_tag_link($value->term_id); ?>"><?php echo $value->name; ?></a></li>
									<?php } ?>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="entry-title">
						<a href="<?php echo $latest34_obj_arr[$key]->permalink; ?>"><?php echo $latest34_obj_arr[$key]->title; ?></a>
					</div>	
					<div class="read-more"><a href="<?php echo $latest34_obj_arr[$key]->permalink; ?>">read more</a></div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>

    <div class="latest-container latest-mobile">
        <?php if(!empty($latest5_obj)): ?>
            <div class="latest temp-1">
                <div class="entry-meta">
                    <div class="entry-categories">
                        <ul>
                            <?php foreach($latest5_obj->category as $value): ?>
                                <li>
                                    <a href="<?php echo get_category_link(get_cat_ID($value->name)); ?>"><?php echo $value->name; ?></a>
                                </li>
                            <?php endforeach;                                ?>
                        </ul>
                    </div>
                </div>
                <h3 class="entry-title"><a href="<?php echo $latest1_obj->permalink; ?>"><?php echo $latest5_obj->title ?></a></h3>
                <div class="entry-img">
                    <a href="<?php echo $latest1_obj->permalink; ?>">
                        <?php if($latest5_obj->image_url){
                                 echo $latest5_obj->image_url;
                              }else{
                                  echo '<img src="' . home_url().'/wp-content/themes/chuan-chi/images/default-img.png ">';
                              }?>
                    </a>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if(!empty($latest6_obj_arr)): ?>
            <div class="latest temp-2">
                <div class="entry-meta">
                    <div class="entry-categories">
                        <ul>
                            <li><a href="<?php echo get_category_link(get_cat_ID($cat_name_array[1])); ?>"><?php echo $cat_name_array[1]; ?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="posts-list">
                    <?php foreach($latest6_obj_arr as $key=>$value): ?>
                        <div class="entry-title"><a href="<?php echo $latest2_obj_arr[$key]->permalink; ?>"><?php echo $latest6_obj_arr[$key]->title; ?></a></div>
                    <?php endforeach; ?>
                </div>
            </div> 
        <?php endif; ?>
    </div>

    <div class="latest-container latest-mobile">
        <?php if(!empty($latest78_obj_arr)) : ?>
            <?php foreach($latest78_obj_arr as $key=>$value): ?>
                <div class="latest temp-3">
                    <div class="entry-img">
                        <a href="<?php echo $latest34_obj_arr[$key]->permalink; ?>">
                            <?php if($latest78_obj_arr[$key]->image_url){
                                      echo $latest78_obj_arr[$key]->image_url;
                                  }else{
                                      echo '<img src="' . home_url().'/wp-content/themes/chuan-chi/images/default-img.png ">';
                                  }?>
                        </a>
                    </div>
                    <div class="entry-meta">
                        <div class="entry-categories">
                            <ul>
                                <?php foreach($latest78_obj_arr[$key]->category as $value): ?>
                                    <li><a href="<?php echo get_category_link(get_cat_ID($value->name)); ?>"><?php echo $value->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="entry-tags">
                            <ul>
                                <?php foreach($latest78_obj_arr[$key]->tags as $value): ?>
                                    <li><a href="<?php echo get_tag_link($value->term_id); ?>"><?php echo $value->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="entry-title">
                        <a href="<?php echo $latest34_obj_arr[$key]->permalink; ?>"><?php echo $latest78_obj_arr[$key]->title; ?></a>
                    </div>  
                    <div class="read-more"><a href="<?php echo $latest34_obj_arr[$key]->permalink; ?>">read more</a></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section><!-- #latest -->

<?php 
	//Laod the .site-editor section
	get_template_part( 'template-parts/content/content', 'site-editor' ); 
?>

<?php //Interface Init Start ?>
<?php
    $output_categories = array();
    $category_names = array();
    $categories=get_categories($args);
    foreach($categories as $key=>$value) { 
        $output_categories[$key] = $value->cat_ID;
        $category_names[$key] = $value->name;
    }
?>
<?php 
    $all_cate_6_post = [];
    for($k=0 ; $k<count($output_categories); $k++):
        $args = array('post_type'=>'post',
                      'cat'=>$output_categories[$k],
                      'orderby'=>'modified',
                      'posts_per_page'=>-1,
                      'order'=>'DESC');
        $the_query = new WP_Query( $args );
        if($the_query->have_posts()):
            $cnt=0;
            $single_cate = [];
            while($the_query->have_posts() && $cnt<6):
                $the_query->the_post(); 
                $cat_obj=new stdClass();
                $cat_obj->ID = get_the_ID();
                $cat_obj->title = get_the_title();
                $cat_obj->category = get_the_category();
                $cat_obj->tags = get_the_tags();
                $cat_obj->permalink = get_permalink();
                //$cat_obj->image_url = get_the_post_thumbnail_url();
                $cat_obj->image_url = get_the_post_thumbnail(get_the_ID(),'thumbnail');
                array_push($single_cate, $cat_obj);
                $cnt += 1;
            endwhile;
            array_push($all_cate_6_post, $single_cate);
        endif;
        wp_reset_postdata();
    endfor;
    
    
    $between_author_n_firm = array_slice($all_cate_6_post,0,2); //slice from 0 to 2
    $rest_categories = array_slice($all_cate_6_post,2,count($all_cate_6_post)-1);   //slice from 2 to all
    unset($all_cate_6_post);    //destroy array
    /*
    foreach($between_author_n_firm as $key=>$value) { 
        foreach($between_author_n_firm[$key] as $key2=>$value2){
            //[$key+1] is for skip the Uncategorized cate
            echo $category_names[$key] . ':' . $between_author_n_firm[$key][$key2]->title . '<br>';
        }
    }
    echo '===================<br>';
    
    foreach($rest_categories as $key=>$value) { 
        foreach($rest_categories[$key] as $key2=>$value2){
            //[$key+3] is for skip the Uncategorized cate & first showed 2 categories
            echo $category_names[$key + 2] . ':' . $rest_categories[$key][$key2]->title . '<br>';
        }
    }
    foreach($category_names as $key=>$value){
        echo $key . ':' . $category_names[$key] . '<br>';
    }*/
?>
<?php //Interface Init End ?>

<?php foreach($between_author_n_firm as $key=>$value): ?>
	<section id="site-cats-<?php echo $output_categories[$key]; ?>" class="site-cats">
		<div class="cats-container">
			<div class="cats-title-deco"><img src="<?php echo home_url(); ?>/wp-content/themes/chuan-chi/images/cats-title-deco.png"></div>
			
			<a href="<?php echo get_category_link($output_categories[$key]); ?>" class="cats-title">
				<h1 class="title"><?php echo $category_names[$key]; ?></h1>
				<h2 class="title">更多<?php echo $category_names[$key]; ?>相關的法律文章</h2>
			</a>
		</div>
		
		<?php 
		    $top2_posts = array_slice($between_author_n_firm[$key],0,2) ;
		    $last4_posts = array_slice($between_author_n_firm[$key],2,count($between_author_n_firm[$key])-1);
		?>
		<div class="cats-container">
			<?php foreach($top2_posts as $key2=>$value2): ?>
				<div class="cats temp-1">
					<div class="entry-meta">
						<div class="entry-categories">
							<ul>
								<?php foreach($top2_posts[$key2]->category as $value): ?>
									<li><a href="<?php echo get_category_link(get_cat_ID($value->name)); ?>"><?php echo $value->name; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="entry-tags">
							<ul>
								<?php foreach((array)$top2_posts[$key2]->tags as $value): ?>
									<?php if(isset($value->name)){ ?>
										<li><a href="<?php echo get_tag_link($value->term_id); ?>"><?php echo $value->name; ?></a></li>
									<? } ?>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="entry-img">
					    <a href="<?php echo $top2_posts[$key2]->permalink; ?>">
					        <?php if($top2_posts[$key2]->image_url){
					                  echo $top2_posts[$key2]->image_url;
					              }else{
					                  echo '<img src="' . home_url().'/wp-content/themes/chuan-chi/images/default-img.png ">';
					              }?>
    					</a>
					</div>
					<div class="entry-title"><a href="<?php echo $top2_posts[$key2]->permalink ; ?>"><?php echo $top2_posts[$key2]->title ; ?></a></div>	
					<div class="read-more"><a href="<?php echo $top2_posts[$key2]->permalink ; ?>">read more</a></div>
				</div>
			<?php endforeach; ?>

			<?php if(count($last4_posts)>0): ?>
				<div class="cats temp-2">
					<div class="entry-meta">
						<div class="entry-categories">
							<ul>
								<li><a href="<?php echo get_category_link($output_categories[$key]); ?>"><?php echo $category_names[$key]; ?></a></li>
							</ul>
						</div>
					</div>
					<div class="posts-list">
						<?php foreach($last4_posts as $key1=>$value1): ?>
							<div class="entry-title"><a href="<?php echo $last4_posts[$key1]->permalink; ?>"><?php echo $last4_posts[$key1]->title; ?></a></div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endforeach; ?> <!-- .site-cats -->

<section id="about-us" class="about-us">
	<h1 class="title">關於律所</h1>
	<div class="about-us-title">陳宇安律師</div>
	<div class="about-us-info">
        <li>地址 ｜ 台北市大安區羅斯福路二段91號四樓之2</li>
        <li>電話 ｜ 02-2368-8013</li>
        <li>傳真 ｜ 02-2368-2688</li>
        <li>電子信箱 ｜ <a href="mailto:yuanchen0113@gmail.com">yuanchen0113@gmail.com</a></li>
        <br>
		<li>簡歷 ｜ 國立政治大學法律系、哲學系雙主修畢業 / 高等檢察署錄事 / <br>泰鼎法律事務所實習律師 / 泰鼎法律事務所受雇律 / <br>匡正國際法律事務所合署律師 / 權麒法律事務所主持律師</li>
        <br>
		<li>執業資格 ｜ 台北律師公會會員 / 桃園律師公會會員 / 新竹律師公會會員 / <br>台中律師公會會員 / 嘉義律師公會會員 / 高雄律師公會會員 / <br>台南律師公會會員 / 宜蘭律師公會會員 / 基隆律師公會會員</li>
        <br>
        <li>專業領域 ｜ 一般民、刑事訴訟案件 / 智慧財產權（商標、專利、著作權）案件 / <br>商務合約審理 / 民事假扣押、假處分保全事件 / <br>債務清理事件 / 不動產強制執行事件</li>
	</div>
</section><!-- #about-us -->

<?php foreach($rest_categories as $key=>$value): ?>
	<section id="site-cats-<?php echo $output_categories[$key+2]; ?>" class="site-cats">
		<div class="cats-container">
			<div class="cats-title-deco"><img src="<?php echo home_url(); ?>/wp-content/themes/chuan-chi/images/cats-title-deco.png"></div>
			
			<a href="<?php echo get_category_link($output_categories[$key+2]); ?>" class="cats-title">
				<h1 class="title"><?php echo $category_names[$key+2]; ?></h1>
				<h2 class="title">更多<?php echo $category_names[$key+2]; ?>相關的法律文章</h2>
			</a>
		</div>
		
		<?php 
		      $top2_posts = array_slice($rest_categories[$key],0,2) ;
		      $last4_posts = array_slice($rest_categories[$key],2,count($rest_categories[$key])-1);
		?>
		<div class="cats-container">
			<?php foreach($top2_posts as $key2=>$value2): ?>
				<div class="cats temp-1">
					<div class="entry-meta">
						<div class="entry-categories">
							<ul>
								<?php foreach($top2_posts[$key2]->category as $value): ?>
									<li><a href="<?php echo get_category_link(get_cat_ID($value->name)); ?>"><?php echo $value->name; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="entry-tags">
							<ul>
								<?php foreach((array)$top2_posts[$key2]->tags as $value): ?>
									<?php if(isset($value->name)){ ?>
										<li><a href="<?php echo get_tag_link($value->term_id); ?>"><?php echo $value->name; ?></a></li>
									<?php } ?>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="entry-img">
					    <a href="<?php echo $top2_posts[$key2]->permalink; ?>">
					        <?php if($top2_posts[$key2]->image_url){
					                  echo $top2_posts[$key2]->image_url;
					              }else{
					                  echo '<img src="' . home_url().'/wp-content/themes/chuan-chi/images/default-img.png ">';
					              }?>
					    </a>
					</div>
					<div class="entry-title"><a href="<?php echo $top2_posts[$key2]->permalink ; ?>"><?php echo $top2_posts[$key2]->title ; ?></a></div>	
					<div class="read-more"><a href="<?php echo $top2_posts[$key2]->permalink ; ?>">read more</a></div>
				</div>
			<?php endforeach; ?>

			<?php if(count($last4_posts)>0): ?>
				<div class="cats temp-2">
					<div class="entry-meta">
						<div class="entry-categories">
							<ul>
								<li><a href="<?php echo get_category_link($output_categories[$key+2]); ?>"><?php echo $category_names[$key+2]; ?></a></li>
							</ul>
						</div>
					</div>
					<div class="posts-list">
						<?php foreach($last4_posts as $key1=>$value1): ?>
							<div class="entry-title"><a href="<?php echo $last4_posts[$key1]->permalink; ?>"><?php echo $last4_posts[$key1]->title; ?></a></div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endforeach; ?> <!-- .site-cats -->

