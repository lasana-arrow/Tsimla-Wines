<?php
/**
 * Шаблон для вывода вин по 
 * wine_tax
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
<h4 style="text-align: center; padding: 30px 0;"> Вина с характеристикой 
<?php
single_term_title();
?> </h4>	
	<?php
echo do_shortcode('[show_wine feature="wine_taх" value="'.$term_id.'" perrow=6]');		
?>
	</div></div>
wp_footer(); 

get_footer();
