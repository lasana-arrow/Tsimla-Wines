<?php
/**
 * Вывод странички тура
 *
 * @package WordPress
 * @subpackage Tsimla Wines
 */

get_header();


while ( have_posts() ) :
	the_post();

$pic=get_the_post_thumbnail_url($post->ID,'full');

?>

<div class="container tour"><div class="row">
	<div class="col-md-4" style=" height: 600px;   background-position: center center; background-size: cover;
   background-image:url('<?php echo $pic;?>')">
	</div>
	<div class="col-md-8" class="tour-big-info">
		<div class="small-title">Экскурсия</div>
		<h1><?php echo $post->post_title;?></h1>
		<div class="tour-hint"><?php if (isset($post->_old_name)) echo $post->_old_name; ?></div>	
	<div class="tour-uslovia">	
		<span class="tour-people"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/chelovechek.png">
	   <?php 
		if ((isset($post->_people_min))&&($post->_people_min>0)) echo ' от '.$post->_people_min.' чел. ';
	    if ((isset($post->_people_max))&&($post->_people_max>0)) echo ' до '.$post->_people_max.' чел. ';
	    ?>
		</span>
		<?php
        if ((isset($post->_price))&&($post->_price>0))  
	    echo '<span class="tour-people"><img src="'.get_stylesheet_directory_uri().'/img/rubl.png"> '.$post->_price.' '.$post->_for_price.'</span>';
		if ($post->_degustation) echo '<span class="tour-people tour-adults0nly-sign"><img src="'.get_stylesheet_directory_uri().'/img/adultsonly.png"> С дегустацией</span>';	
			
	    if ((isset($post->_when_date))&&($post->_when_date!='')) echo '<span class="tour-money"><img src="'.get_stylesheet_directory_uri().'/img/when_date.png"> '.$post->_when_date.'</span>'; ?>
	</div>
		<div class="tour-info"><?php the_content(); ?>
		</div>	
		<div class="order-button"><button class="tour-<?php echo $post->ID;?>">Заказать</button></div>
	</div>	
</div>	
<?php
endwhile; // End of the loop.

get_footer();
wp_reset_postdata();