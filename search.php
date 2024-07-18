<?php
/**
 * Вывод странички поиска
 * @package WordPress
 * @subpackage Tsimla Wines
 */

get_header();
?>
<style id='aperitif-style-inline-css' type='text/css'>
#qodef-page-outer { margin-top: -80px;}@font-face {font-family: TTChocolatessrc:;}@font-face {font-family: PetrovskyOneCsrc:;}#qodef-page-footer-top-area { background-color: #ece2ca;background-image: url(https://8osem.ru/wp-content/uploads/2019/10/Footer-grafika.png);background-repeat: no-repeat;background-position: bottom center;}body { background-color: #f5f2eb;}.qodef-header-navigation>ul>li>a { color: #000000;font-family: TTChocolates;font-size: 34px;line-height: 38px;font-weight: 400;text-transform: uppercase;}.qodef-side-area-opener { color: #000000;}#qodef-side-area-close { color: #000000;}#qodef-side-area-close:hover { color: #dd3333;}#qodef-side-area { background-color: #ffffff;width: 30%;right: -30%;}.qodef-side-area--opened .qodef-side-area-cover { background-color: rgba(0,0,0,0.55);}.qodef-page-title .qodef-m-content { padding-top: 80px;}p { font-family: TTChocolates;font-size: 20px;line-height: 25px;}h1 { color: #987745;font-family: PetrovskyOneC;font-size: 60px;line-height: 80px;letter-spacing: 0px;}h2 { font-family: TTChocolates;font-size: 30px;line-height: 30px;text-transform: uppercase;}h3 { font-size: 25px;line-height: 30px;}h4 { font-size: 20px;line-height: 20px;}h5 { font-size: 15px;line-height: 15px;}a, p a { color: #000000;font-style: normal;text-decoration: none;}a:hover, p a:hover { color: #b94338;text-decoration: none;}.qodef-search-opener { color: #000000;font-size: 30;}.qodef-search-opener:hover { color: #dd3333;}.qodef-search-opener { color: #000000;font-size: 30;}.qodef-search-opener:hover { color: #dd3333;}.qodef-header--standard #qodef-page-header { height: 80px;background-color: transparent;}
</style>
<?php

echo '<div class="search-page">';
echo '<h2 class="qodef-m-title">Результаты поиска</h2>';
	

	
	//Конец хедера
get_search_form();

if (isset($_GET['wine_character']))
	{	
      $wine_character=$_GET['wine_character'];	
	}
	if (isset($_GET['wine_color']))
	{	
      $wine_color=$_GET['wine_color'];	
	}
	if (isset($_GET['wine_sugar']))
	{	
      $wine_sugar=$_GET['wine_sugar'];	
	}
		if (isset($_GET['wine_grape']))
	{	
      $wine_grape=$_GET['wine_grape'];	
	}

$args=array(
	       'post_type'=>'wine',
	       'posts_per_page'=>-1
	       );
if ((isset($wine_character))||(isset($wine_color))||(isset($wine_sugar))||(isset($wine_grape)))
{
	$args['tax_query'] = array('relation'=>'AND');
	if ((isset($wine_character))&&($wine_character!=''))
		$args['tax_query'][] = array(
			         'taxonomy' => 'wine_character',
			         'field'    => 'id',
		             'terms'    => $wine_character,
		                 
	                   ); 
  if ((isset($wine_color))&&($wine_color!=''))
		$args['tax_query'][] = array( 
			         'taxonomy' => 'wine_color',
			         'field'    => 'id',
		             'terms'    => $wine_color,
		                 
	                   ); 
  if ((isset($wine_sugar))&&($wine_sugar!=''))
		$args['tax_query'][] = array( 
			         'taxonomy' => 'wine_sugar',
			         'field'    => 'id',
		             'terms'    => $wine_sugar
	                   ); 	
   if ((isset($wine_grape))&&($wine_grape!=''))
		$args['tax_query'][] = array( 
			         'taxonomy' => 'wine_grape',
			         'field'    => 'id',
		             'terms'    => $wine_grape
	                   ); 		
}

$allposts=get_posts($args);
$perrow=6;
$i=0;
$colmd='col-md-2';
echo '<div class="row">';
if ($allposts)
{foreach($allposts as $block )
			     { $i++;
				   if (($i>$perrow)&&($i%$perrow==1))
				       { echo '<div class="row">';}
				   $smallpic=get_the_post_thumbnail_url($block,'medium');
			       echo '<div class="'.$colmd.' bottle-row"><div class="wine-image">';		
			       echo '<a href="'.get_permalink($block).'"><img src="'.$smallpic.'"></a></div>';
				   echo '<div class="wine-text" style="margin-top: 20px">';
				   $wine_line=get_the_terms($block->ID, 'wine_line');
                   if($wine_line)		
			       echo '<h5 class="wine-linename"><a href="'. get_term_link( $wine_line[0]->term_id, $wine_line[0]->taxonomy ) .'">'.$wine_line[0]->name.'</a></h5>';   
				   echo '<h5 class="wine-title"><a href="'.get_permalink($block).'">'.$block->post_title.'</a></h5>';
				  
				   echo '</div></div>';
				   if ($i%$perrow==0) { echo '</div>';}
				   }

}
else 
{
	echo '<h2>Нет вин, удовлетворяющих поиску! Попробуйте задать параметры попроще! </h2>';
}
echo '<div class="after-search"><h3><a href="https://8osem.ru/vse-vina/">Вернуться в каталог вин</a></h3></div>';
echo '</div>';
get_footer();

?>