<?php
/**
 * Вывод странички блога
 *
 * @package WordPress
 * @subpackage Tsimla Wines
 */

get_header();


while ( have_posts() ) :
	the_post();

$smallpic=get_the_post_thumbnail_url($post->ID,'full');

?>
<div class="container wineblog">
<div class="row">
<div class="wineblog-header" style="background-image: url('<?php echo $smallpic;?>')">
	<h1 class="wineblog-title"><?php echo $post->post_title;?></h1>
</div>	
</div>	
<div class="row wineblog-date">
<?php 
	the_time('j F Y в H:i'); 
	echo '<img src="'.get_stylesheet_directory_uri().'/img/leaf.png" style="margin-left: 10px; margin-top: -10px; margin-right: 10px;   height: 26px;">';
	$category=get_the_terms($post->ID, 'category');
     if( is_array($category))
	 { 
	 foreach ($category as $cat)
     echo '<a href="'. get_term_link( $cat->term_id, $cat->taxonomy ) .'">'. $cat->name .'</a> &nbsp;';
	  
	 }
	?>
</div>
<div class="row wineblog-text">		
	<?php		the_content(); ?>
	</div>
</div>
<?php
endwhile; // End of the loop.

get_footer();
wp_reset_postdata(); ?>