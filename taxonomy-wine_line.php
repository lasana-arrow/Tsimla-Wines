<?php
/**
 * Шаблон для вывода вин по 
 * wine_line
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
<h2 class="line-header"> 
<?php
single_term_title();
?> </h2>
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
<h4 style="text-align: center; padding: 30px 0;"> Вина коллекции
<?php
single_term_title();
?> </h4>	
	<?php
	$args=array(
		'post_type'=>'wine',
		'posts_per_page'=>-1,
				); 
	 $args['tax_query'] = array(
		             array(
			         'taxonomy' => 'wine_line',
					 'field'    => 'id',
		             'terms'    => $term_id,
		                 )
	                   ); 
    $allposts=get_posts($args);
	$num=sizeof($allposts);
	if ($num>6) $num=6;
	
if ((isset ($_GET['feature2']))&&($_GET['feature2']!="wine_color"))
{ 
  $feature2=$_GET['feature2'];
  $value2=$_GET['value2'];
	  $term = get_term( $value2, $feature2);
  echo  '<h4 style="text-align: center;"> В этой линейке '.$term->name.': </h4>';	  
  echo do_shortcode('[show_wine feature="wine_line" value="'.$term_id.'" feature2="'.$feature2.'" value2="'.$value2.'" perrow="'.$num.'"]');
  echo '<div><h4><a href="'.get_term_link($term_id, "wine_line").'">Посмотреть все вина этой линейки</a></h4></div>';
  	
}
	else echo do_shortcode('[show_wine feature="wine_line" value="'.$term_id.'" perrow="'.$num.'"]');
		
	
?>
	</div></div>
<?php
wp_footer(); 

get_footer();
