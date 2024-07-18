<?php
/**
 * Шаблон для вывода вин по его виду (характеру)
 * wine_grape
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
<h2> Виноград 
<?php
single_term_title();
?> </h2>
</div>	
	<div class="tax-image col-md-4">
	<?php
	 $image_id = get_term_meta($term_id, '_thumbnail_id', 1 );	 
	 $image_url = wp_get_attachment_image_url( $image_id, 'aperitif_image_size_square' );
	 if ((isset($image_url))&&($image_url!=""))
         echo '<img src="'. $image_url .'" alt="';
		 single_term_title();
		 echo '" />';
		?>
	</div>	
<div class="wine-description col-md-8">
	<p>
<?php echo term_description(); ?>
	</p>		
</div>
<div class="col-md-12">	
<h4 class="wine-header-4"> Вино из винограда  
<?php
single_term_title();
?>, которое есть у нас:</h4>	
	<?php
$args=array(
		'post_type'=>'wine',
		'posts_per_page'=>-1,
				); 
	 $args['tax_query'] = array(
		             array(
			         'taxonomy' => 'wine_grape',
					 'field'    => 'id',
		             'terms'    => $term_id,
		                 )
	                   ); 
    $allposts=get_posts($args);
	$num=sizeof($allposts);
	if ($num>6) $num=6;	
echo do_shortcode('[show_wine feature="wine_grape" value="'.$term_id.'" perrow="'.$num.'"]');		
?>
	</div></div>
<?php
wp_footer(); 

get_footer(); ?>
