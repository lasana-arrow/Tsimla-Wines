<?php
/**
 * Шаблон для вывода вин по его виду (характеру)
 * wine_character
 *
 *
 * @package WordPress
 * @subpackage Tsimla Wines
 */

get_header();


$queried_object = get_queried_object();
$term_id = $queried_object->term_id;
?>
<div class="wine">
<div class="wine-header" style="text-align: center">	
<h2> 
<?php
single_term_title();
?> вино из коллекции Цимлянских вин</h2>
</div>	
	<div class="tax-image col-md-4">
	<?php
	 $image_id = get_term_meta($term_id, '_thumbnail_id', 1 );	 
	 $image_url = wp_get_attachment_image_url( $image_id, 'full' );
	 if ((isset($image_url))&&($image_url!=""))
         echo '<img src="'. $image_url .'" alt="'.$termtitle.'"  style="max-width: 100%;" />';
		?>
	</div>	
<div class="wine-description col-md-8">
	<p>
<?php echo term_description(); ?>
	</p>		
</div>
<div class="col-md-12">	
<h4 style="text-align: center; padding: 30px 0;"> А вот 
<?php
single_term_title();
?> вино, которое есть у нас:</h4>	
	<?php
	$args=array(
		'post_type'=>'wine',
		'posts_per_page'=>-1,
				); 
	 $args['tax_query'] = array(
		             array(
			         'taxonomy' => 'wine_character',
					 'field'    => 'id',
		             'terms'    => $term_id,
		                 )
	                   ); 
    $allposts=get_posts($args);
	$num=sizeof($allposts);
	if ($num>6) $num=6;
echo do_shortcode('[show_wine feature="wine_character" value="'.$term_id.'" perrow="'.$num.'"]');
		
?>
	</div></div>
<?php
wp_footer(); 
get_footer(); ?>
