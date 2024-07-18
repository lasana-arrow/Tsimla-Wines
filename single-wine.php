<?php
/**
 * Вывод странички вина
 *
 * @package WordPress
 * @subpackage Tsimla Wines
 */

get_header();


while ( have_posts() ) :
	the_post();

$smallpic=get_the_post_thumbnail_url($post->ID,'full');

?>
<div >
<div class="container wine"><div class="row">
	<div class="col-md-4"><span class="line-header">
	<?php
    $wine_line=get_the_terms($post->ID, 'wine_line');
            if($wine_line)
			{
			echo '<a href="'. get_term_link( $wine_line[0]->term_id, $wine_line[0]->taxonomy ) .'">'. $wine_line[0]->name .'</a>'; ?></span> <?php
		    echo '<div class="row"><div class="col-md-8 buy-button">';		 
	      //  echo do_shortcode('[show_wine line="'.$wine_line[0]->term_id.'" perrow=1]');
	      if ($post->_comingsoon=="yes")
			 echo do_shortcode('[tsimlawines_superbutton button_text="Скоро в продаже!" button_link="#" button_family-font="TTChocolates" button_font-size="14" button_border-color="#b3120c" button_border-width="2" button_border-radius="10" button_padding="5px 50px"]');  
			  else
	      echo do_shortcode('[tsimlawines_superbutton button_text="Где купить" button_link="/contact" button_family-font="TTChocolates" button_font-size="20" button_border-color="#b3120c" button_border-width="2" button_border-radius="10" button_padding="5px 50px"]');
			echo '</div></div>';
			}
		
		?>
		
		</div>
	<div class="col-md-4 wine-mainpic" style="text-align: center; vertical-align: top"><img src="<?php echo $smallpic; ?>"></div>
	<div class="col-md-4 wine-desc">
<?php
echo '<h4>'.$post->post_title.'</h4>';
		
echo '<div>';
$wine_character=get_the_terms($post->ID, 'wine_character');
     if( is_array($wine_character))
	 { echo '<div>  <b>Характер</b>: &nbsp;';
	 foreach ($wine_character as $wc)
     echo '<a href="'. get_term_link( $wc->term_id, $wc->taxonomy ) .'">'. $wc->name .'</a> &nbsp;';
	  echo '</div>';
	 }
		
$wine_sugar=get_the_terms($post->ID, 'wine_sugar');
     if( is_array($wine_sugar))
	 { echo '<div> <b>Тип вина (сахар)</b>: &nbsp;';
	 echo '<a href="'. get_term_link( $wine_sugar[0]->term_id, $wine_sugar[0]->taxonomy ) .'">'. $wine_sugar[0]->name .'</a> &nbsp;';
$wine_color=get_the_terms($post->ID, 'wine_color');
	  echo '</div>';}	
     if( is_array($wine_color))
	 { echo '<div> <b>Тип вина (цвет)</b>: &nbsp;';
	 echo '<a href="'. get_term_link( $wine_color[0]->term_id, $wine_color[0]->taxonomy ) .'">'. $wine_color[0]->name .'</a> ';
     echo '</div>';		 
	 }
	 	
		
if (isset ($post->_year))
{
	 echo '<div><b> Урожай</b>: &nbsp;';		 
	// echo '<a href="';
	// echo get_site_url();
    // echo '?year='.$post->_year.'">';
	echo $post->_year.'г.';
	// echo </a>';
     echo '</div>';		 
}			
$wine_grape=get_the_terms($post->ID, 'wine_grape');
     if( is_array($wine_grape))
	 { echo '<div> <b>Виноград</b>: &nbsp;';
	 foreach ($wine_grape as $wc)
     echo '<a href="'. get_term_link( $wc->term_id, $wc->taxonomy ) .'">'. $wc->name .'</a> &nbsp;';
	  echo '</div>';
	 }
		
if (isset ($post->_color))
	 echo '<div><b> Цвет </b>: &nbsp;'.$post->_color.'</div>';		 
if (isset ($post->_smell))
	 echo '<div><b> Аромат</b>: &nbsp;'.$post->_smell.'</div>';		 
if (isset ($post->_taste))
	 echo '<div><b> Вкус</b>: &nbsp;'.$post->_taste.'</div>';		 
			
$wine_taste=get_the_terms($post->ID, 'wine_taste');
     if( is_array($wine_taste))
	 { echo '<div><b> Оттенки</b>: &nbsp; ';
	 foreach ($wine_taste as $wc)
     echo '<a href="'. get_term_link( $wc->term_id, $wc->taxonomy ) .'">'. $wc->name .'</a> &nbsp;';
	  echo '</div>';
	 }		
		
$wine_combine=get_the_terms($post->ID, 'wine_combine');
     if( is_array($wine_combine))
	 { echo '<div> <b>Сочетания</b>: &nbsp;';
	 foreach ($wine_combine as $wc)
     echo '<a href="'. get_term_link( $wc->term_id, $wc->taxonomy ) .'">'. $wc->name .'</a> &nbsp;';
	  echo '</div>';
	 }	

if (isset($post->_alcohol_l)) 		
	 echo '<div> <b>Алкоголь</b>: &nbsp;';		 
	 echo $post->_alcohol_l;

if (isset($post->_alcohol_h)) 	
	 echo '-'.$post->_alcohol_h;
echo '% об.';		
     echo '</div>';			
		

if (isset($post->_value)) 		
	 echo '<div><b> Объём</b>: &nbsp;';		 
	 echo $post->_value.'л. </div>';
		
$wine_tax=get_the_terms($post->ID, 'wine_tax');
     if( is_array($wine_tax))
	 { echo '<div>';
	 foreach ($wine_tax as $wc)
     echo '<a href="'. get_term_link( $wc->term_id, $wc->taxonomy ) .'">'. $wc->name .'</a> &nbsp;';
	  echo '</div>';
	 }	
		
$output =  apply_filters( 'the_content', $post->post_content ); 	
echo '<div class="block-content">'.$output.'</div>';
if ($post->_comingsoon=="yes")
echo '<div><h3 style="color:#B3120C; text-transform: uppercase">Скоро в продаже!</h3></div>';		
		?>
		</div></div></div></div>
	<div class="row">
		<?php
	     $args=array(
		'post_type'=>'wine',
		'posts_per_page'=>-1,
				); 
	     $args['tax_query'] = array(
		             array(
			         'taxonomy' => 'wine_line',
					 'field'    => 'id',
		             'terms'    => $wine_line[0]->term_id,
		                 )
	                   ); 
         $allposts=get_posts($args);
	     $num=sizeof($allposts);
	     if ($num>6) $num=6;
		 if ($num>0)
		 {   echo '<div style="text-align: center">';
		     echo '<h3>Другое вино линейки  "'.$wine_line[0]->name.'"</h3>';
		     echo do_shortcode('[show_wine feature="wine_line" value="'.$wine_line[0]->term_id.'" perrow="'.$num.'"]');
		     echo '</div>';
			}
		?>
	</div>

		<?php	/*
		foreach ($wine_character as $wc){
			echo '<div class="row">';
		    echo '<h3>Другое '.$wc->name.' вино</h3>';
		    echo '<div style="padding: 0 50px">';
		    echo do_shortcode('[show_wine feature="wine_character" value="'.$wc->term_id.'" exclude='.$post->ID.' perrow=4 num=4]');
		    echo '</div>';
			echo '</div>';
		}
		?>
	
	<div class="row">
		<?php
		    echo '<h3>Другое '.$wine_sugar[0]->name.' вино </h3>';
		    echo '<div style="padding: 0 50px">';
		    echo do_shortcode('[show_wine feature="wine_sugar" value="'.$wine_sugar[0]->term_id.'" exclude='.$post->ID.' perrow=6 num=6]');
		    echo '</div>';
		?>
	</div>
	<div class="row">
		<?php
		    echo '<h3>Другое '.$wine_color[0]->name.' вино</h3>';
		    echo '<div style="padding: 0 50px">';
		    echo do_shortcode('[show_wine feature="wine_color" value="'.$wine_color[0]->term_id.'" exclude='.$post->ID.' perrow=4 num=4]');
		    echo '</div>';
		*/?>
	
	</div>		
<?php
endwhile; // End of the loop.

get_footer();
wp_reset_postdata(); 
?>