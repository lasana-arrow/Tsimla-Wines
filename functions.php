<?php

/*
 * Связка с функциями родительской темы            8
 * Виджет для jscomposer Айдентика                 47
 * Виджет для jscomposer СуперКнопа                219
 * Виджет для jscomposer СлайдерБутылочек          310
 * Виджет для jscomposer Вывод таксономий          502
 * Таксономии для типа wines                       566 
 * Тип wines                                       812 
 * Картинки для таксономий                         853 
 * Метабоксы типа wines                            878
 * Шорткод show_wine                               1046
 * Тип tour                                        1138 
 * Метабоксы для туров                             1212 
 * Виджет для jscomposer Вывод туров               1448
 * Шорткод show_lines                              1530 
 * Виджет для jscomposer Список линеек             1560 
 * Тип diary                                       1598 
 * Метабоксы для diary                             1640 
 * Шорткод вывода дневника show_diary              1750
 * Шорткод вывода сортов винограда show_grapes     1868
 * Своя форма поиска                               1906 
 * */

require_once __DIR__ . '/WP_Term_Image.php'; // Наши картинки для таксономий

if ( ! function_exists( 'aperitif_child_theme_enqueue_scripts' ) ) {
	/**
	 * Function that enqueue theme's child style
	 */
	function aperitif_child_theme_enqueue_scripts() {
		$main_style = 'aperitif-main';		
		wp_enqueue_style( 'aperitif-child-style', get_stylesheet_directory_uri() . '/style.css', array( $main_style ) );
		wp_enqueue_style( 'slider-style', get_stylesheet_directory_uri() . '/css/itc-slider.css', array() );
		wp_enqueue_script( 'slider-style', get_stylesheet_directory_uri() .'/js/itc-slider.js' );
    	wp_enqueue_script('lightbox-script', get_stylesheet_directory_uri() .'/js/lightbox.js', array(), null, true );
		wp_enqueue_style( 'lightbox-style', get_stylesheet_directory_uri() . '/css/lightbox.css', array());
		
	}	
	add_action( 'wp_enqueue_scripts', 'aperitif_child_theme_enqueue_scripts' );
}

add_action( 'admin_enqueue_scripts', function(){
wp_enqueue_style( 'admin-style', get_stylesheet_directory_uri().'/css/admin_style.css', array(), null  );
}, 99 );

/* Виджет Айдентика для jsComposer с плавающим логотипом
 * Шорткод: tsimlawines_identica
 * Переменные:
 * identica_img
 * identica_top
 * identica_right
 * identica_left
 * identica_bottom
 * identica_width
 * identica_opacity
 * identica_link
 * identica_link_caption
 * identica_css
 * */

add_action ('vc_before_init', 'add_identica_widget');

function add_identica_widget()
{
	vc_map( array(
		  "name" => "Айдентика",    
          "base" => "tsimlawines_identica",      
          "description" => "Вставить картинку в блок и указать его положение",  
	      "icon" => get_stylesheet_directory_uri().'/img/logo.png',
          "category" =>"Aperitif Core",
		  "params"=>array(
			  
          array(
            "type" => "attach_image",
            "holder" => "div",
            "heading" => "Айдентика",
            "param_name" => "identica_img",
            "value" => "",
            ),
	      array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Отступ сверху в px",
            "param_name" => "identica_top",
            "value" => "",
            ),	  
		  array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Отступ справа в px",
            "param_name" => "identica_right",
            "value" => "",
            ),	 
		  array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Отступ снизу px",
            "param_name" => "identica_bottom",
            "value" => "",
            ),	 
		  array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Отступ слева px",
            "param_name" => "identica_left",
            "value" => "",
            ),
		  array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Ширина изображения в px",
            "param_name" => "identica_width",
            "value" => "",
            ),
		  	  array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Повернуть на угол",
            "param_name" => "identica_degree",
            "value" => "",
            ),	  
		  array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Прозрачность в долях единицы",
            "param_name" => "identica_opacity",
            "value" => "1",
            ),
		 array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Если вдруг на картинку нужно навесить ссылку",
            "param_name" => "identica_link",
            "value" => "",
            ),		
		 array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Подпись",
            "param_name" => "identica_link_caption",
            "value" => "",
            ),
		 array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Z index",
            "param_name" => "identica_z",
            "value" => "",
            ),	  
		 array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Дополнительный CSS на всякий случай",
            "param_name" => "identica_css",
            "value" => "",
            ),	 	  	  
		  )
	   )
	);
}

add_shortcode ('tsimlawines_identica','tsimlawines_identica_shortcode');
/* Шорткод: tsimlawines_identica
 * Переменные:
 * identica_img
 * identica_top
 * identica_right
 * identica_left
 * identica_bottom
 * identica_width
 * identica_opacity
 * identica_css
 * */

function tsimlawines_identica_shortcode ($atts)
{ $img_url=wp_get_attachment_image_url( $atts['identica_img'], 'full' );
  if (isset($atts['identica_link']))
  { $return_text='<a href="'.$atts['identica_link'].'"';
    if (isset($atts['identica_link_caption']))
		$return_text.=' alt="'.$atts['identica_link_caption'].'" ';
    $return_text.=' >';}
  else $return_text='';
  $return_text.='<img class="identica';
   if (isset($atts['identica_css']))
	   $return_text.=' '.$atts['identica_css'];
  $return_text.='" src="'.$img_url.'" style="position: absolute;';
  if (isset($atts['identica_top']))
	  $return_text.=' top:'.$atts['identica_top'].'px; ';
  if (isset($atts['identica_right']))
	  $return_text.=' right:'.$atts['identica_right'].'px; ';
  if (isset($atts['identica_bottom']))
	  $return_text.=' bottom:'.$atts['identica_bottom'].'px; ';
  if (isset($atts['identica_left']))
	  $return_text.=' left:'.$atts['identica_left'].'px; ';
  if (isset($atts['identica_width']))
	  $return_text.=' width:'.$atts['identica_width'].'px; ';
 if (isset($atts['identica_opacity']))
	  $return_text.=' opacity:'.$atts['identica_opacity'].'; ';
 if (isset($atts['identica_degree']))
 {    $atts['identica_degree']=(int)$atts['identica_degree'];
	  $return_text.=' -moz-transform: rotate('.$atts['identica_degree'].'deg);
    -ms-transform: rotate('.$atts['identica_degree'].'deg); 
    -webkit-transform: rotate('.$atts['identica_degree'].'deg); 
    -o-transform: rotate('.$atts['identica_degree'].'deg); 
    transform: rotate('.$atts['identica_degree'].'deg);';
	}
 if (isset($atts['identica_z']))
	  $return_text.=' z-index:'.$atts['identica_z'].'; ';
   $return_text.='" ';  
 
 if (isset($atts['identica_link_caption']))
		$return_text.=' alt="'.$atts['identica_link_caption'].'" title="'.$atts['identica_link_caption'].'"';
    
  $return_text.='>';  
 
  return $return_text;
}


/* Виджет Суперкнопка для jsComposer 
 * Шорткод: tsimlawines_superbutton
 * Переменные:
 * button_text
 * button_link
 * button_align
 * button_family-font
 * button_font-size
 * button_border-color
 * button_border-width
 * button_border-radius
 * button_padding
 * button_css
 * 
 * */

add_action ('vc_before_init', 'add_superbutton_widget');

function add_superbutton_widget()
{
	vc_map( array(
		  "name" => "Тонкая супер кнопка",    
          "base" => "tsimlawines_superbutton",  
		  "icon" => get_stylesheet_directory_uri().'/img/button.png',
          "description" => "Тонкая кнопа с регулируемым форматированием",  
		  "category" =>"Aperitif Core",   
          "params"=>array(
		  
	     array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Надпись на кнопке",
            "param_name" => "button_text",
            "value" => "",
            ),
			  
		 array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Ссылка на кнопке",
            "param_name" => "button_link",
            "value" => "",
            ),	  
          array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => "Форматирование",
            "param_name" => "button_align",
            "value"       => array(
              "По левому краю"   => "left",
			  "По правому краю"  => "right",
			  "По центру" => "center"	
               ),  ),
	      array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Шрифт",
            "param_name" => "button_family-font",
            "value" => "",
            ),	  
		  array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Размер шрифта в px",
            "param_name" => "button_font-size",
            "value" => "",
            ),	 
		  array(
            "type" => "colorpicker",
            "holder" => "div",
            "heading" => "Цвет рамки",
            "param_name" => "button_border-color",
            "value" => "",
            ),	 
		  array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Толщина рамки",
            "param_name" => "button_border-width",
            "value" => "",
            ),
		  array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Радиус рамки",
            "param_name" => "button_border-radius",
            "value" => "",
            ),	 
		  array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Отступы текста от рамки Верх - Право - Низ - Лево",
            "param_name" => "button_padding",
            "value" => "1",
            ),	 	  
		    array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Дополнительный CSS на всякий случай",
            "param_name" => "button_css",
            "value" => "",
            ),	 	  	  
		  )
	   )
	);
}

add_shortcode ('tsimlawines_superbutton','tsimlawines_superbutton_shortcode');
/* Шорткод: tsimlawines_superbutton
 * Переменные:
 * button_text
 * button_link
 * button_align
 * button_family-font
 * button_font-size
 * button_border-color
 * button_border-width
 * button_border-radius
 * button_padding
 * button_css
 * */


function tsimlawines_superbutton_shortcode ($atts)
{ $return_text='<div ';
  if (isset($atts['button_css']))
	  $return_text.=' class="'.$atts['button_css'].'"';
  if (isset($atts['button_align']))
	  $return_text.=' style="text-align: '.$atts['button_align'].';" ';
  $return_text.='>';
  $return_text.='<a href="'.$atts['button_link'].'" style=" text-transform: uppercase;';
  if (isset($atts['button_family-font']))
	  $return_text.='font-family: \''.$atts['button_family-font'].'\', serif; ';
  if (isset($atts['button_font-size']))
	  $return_text.='font-size: '.$atts['button_font-size'].'px; ';
  if (isset($atts['button_border-color']))
	  $return_text.='border-color: '.$atts['button_border-color'].'; border-style: solid; ';
  if (isset($atts['button_border-width']))
	  $return_text.='border-width: '.$atts['button_border-width'].'px; ';
  if (isset($atts['button_border-radius']))
	  $return_text.='border-radius: '.$atts['button_border-radius'].'px; ';
  if (isset($atts['button_padding']))
	  $return_text.='padding: '.$atts['button_padding'].'; ';
  
  $return_text.='">'.$atts['button_text'].'</a></div>';  
   
  return $return_text;
}


/* Виджет Слайдер Бутылочек для jsComposer 
 * Шорткод: tsimlawines_bottleslider
 * Переменные:
 * bottle_feature = wine_character, wine_color, wine_sugar, wine_grape, wine_line
 * bottle_feature_value = число
 * bottle_num = число
 * bottle_autoplay = true/false
 * bottle_interval = число
 * 
 * */

add_action ('vc_before_init', 'add_bottleslider_widget');

function add_bottleslider_widget()
{
	vc_map( array(
		  "name" => "Слайдер бутылочек",    
          "base" => "bottleslider",  
		  "icon" => get_stylesheet_directory_uri().'/img/white_wine.png',
          "description" => "Слайдер бутылочек выбранной категории",  
		  "category" =>"Aperitif Core",   
          "params"=>array(
		 
          array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => "Отсортировать бутылочки по категории",
            "param_name" => "bottle_feature",
            "value"       => array(
			  "Выберите категорию" => "none",	 
              "Характер вина (вид)"  => "wine_character",
			  "Тип вина (по цвету)"  => "wine_color",
			  "Тип вина (по сахару)" => "wine_sugar",
			  "Сорт винограда" => "wine_grape",
			  "Линейка"=>"wine_line"	
               ),  ), 
	     array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Номер категории, их которой будем выбирать",
            "param_name" => "bottle_feature_value",
            "value" => "",
            ),
			  
		 array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Сколько бутылочек выберем? Если все, то пишите -1",
            "param_name" => "bottle_num",
            "value" => "",
            ),	  
	      array(
            "type" => "checkbox",
            "holder" => "div",
            "heading" => "Запустить слайдер на autoplay?",
            "param_name" => "bottle_autoplay",
            "value" => "Поставить на autoplay",
            ),	  
		    array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Дополнительный CSS на всякий случай",
            "param_name" => "bottle_css",
            "value" => "",
            ),	 	  	  
		  )
	   )
	);
}

add_shortcode ('bottleslider','bottleslider_shortcode');
/* Шорткод: bottleslider
 * Переменные:
 * bottle_feature = wine_character, wine_color, wine_sugar, wine_grape, wine_line
 * bottle_feature_value = число
 * bottle_num = число
 * bottle_autoplay = true/false
 * bottle_css
 * */

function bottleslider_shortcode ($atts)
{ 
  $return_text='<div style="display: block; margin: 0 auto; text-align: center; width: 400px;">';	
 // $return_text.=$atts['bottle_feature'];	
 // $return_text.=$atts['bottle_feature_value'];	
  $return_text.='<div class="slider';
  if (isset($atts['bottle_css']))
	  $return_text.=' "'.$atts['button_css'];
    $return_text.='" data-slider="itc-slider" data-loop="true" data-autoplay="'.$atts["bottle_autoplay"].'">';
  $return_text.=' <div class="slider__container">';	
  $return_text.='<div class="slider__wrapper"><div class="slider__items">';
	
  $args=array(
		'post_type'=>'wine',
		'posts_per_page'=>(int)$atts['bottle_num']);
  $args['tax_query'] = array(
		             array(
			         'taxonomy' => $atts['bottle_feature'],
			         'field'    => 'id',
		             'terms'    => (int)$atts['bottle_feature_value'],
		                 )
	                   ); 
	   
  $all_bottles=get_posts($args);	
	if ($all_bottles)
		foreach ($all_bottles as $bottle)
		{   $pic=get_the_post_thumbnail_url($bottle->ID, "full");
		    $wine_line=get_the_terms($bottle->ID, 'wine_line');
		    $wine_color=get_the_terms($bottle->ID, 'wine_color');
		    $wine_sugar=get_the_terms($bottle->ID, 'wine_sugar');
           
			$return_text.='<div class="slider__item" onMouseOver="JavaScript: document.getElementById(\''.$wine_line[0]->slug.$atts['bottle_feature_value'].'\').style.color=\'#b94338\'; document.getElementById(\''.$wine_color[0]->slug.$atts['bottle_feature_value'].'\').style.color=\'#b94338\'; document.getElementById(\''.$wine_sugar[0]->slug.$atts['bottle_feature_value'].'\').style.color=\'#b94338\';" onMouseOut="JavaScript: document.getElementById(\''.$wine_line[0]->slug.$atts['bottle_feature_value'].'\').style.color=\'#000\'; document.getElementById(\''.$wine_color[0]->slug.$atts['bottle_feature_value'].'\').style.color=\'#987745\'; document.getElementById(\''.$wine_sugar[0]->slug.$atts['bottle_feature_value'].'\').style.color=\'#987745\';">';
			$return_text.='<a href="'.get_permalink($bottle).'"><img src="'.$pic.'"></a>';
		    if($bottle->_comingsoon=="yes")		
		    $return_text.='<h5 class="comingsoon">Скоро в продаже!</h5>'; 	
		  /*  $return_text.='<span class="bottle-capture">'; 
		    $wine_line=get_the_terms($bottle->ID, 'wine_line');
            $return_text.='<h5>'.$wine_line[0]->name.'</h5>';   
			$return_text.='<h5>'.$bottle->post_title.'</h5>';
		    $return_text.='</span>';*/
			$return_text.='</div>';
		}
	else $return_text.='Нет бутылочек';
  $return_text.='</div>';
  $return_text.='</div>';
  $return_text.='</div>';
  $return_text.='<button class="slider__control" data-slide="prev"></button>';
  $return_text.='<button class="slider__control" data-slide="next"></button>';
  $return_text.='</div></div>';	
  return $return_text;
}

/* Виджет Вывод таксономий для jsComposer 
 * Шорткод: tsimlawines_allfeatures
 * Переменные:
 * allfeatures_feature
 * allfeatures_feature2
 * allfeatures_value2
 * allfeatures_css
 * */

add_action ('vc_before_init', 'add_allfeatures_widget');

function add_allfeatures_widget()
{
	vc_map( array(
		  "name" => "Вывод таксономии",    
          "base" => "tsimlawines_allfeatures",  
		  "icon" => get_stylesheet_directory_uri().'/img/allfeatures.png',
          "description" => "Вывод всех значений определённой таксономии с двойной сортировкой",  
		  "category" =>"Aperitif Core",   
          "params"=>array(
		  
	    array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => "Какую категорию вывести?",
            "param_name" => "allfeatures_feature",
            "value"       => array(
			  "Выберите категорию" => "wine_line",	 
              "Характер вина (вид)"  => "wine_character",
			  "Тип вина (по цвету)"  => "wine_color",
			  "Тип вина (по сахару)" => "wine_sugar",
			  "Сорт винограда" => "wine_grape",
			  "Линейка"=>"wine_line"	
               ),  ), 
		 array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Какие номера исключить? Через запятую",
            "param_name" => "allfeatures_exclude",
            "value" => "",
            ),	  
		array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => "Относительно какой категории отсортировать?",
            "param_name" => "allfeatures_feature2",
            "value"       => array(
			  "Выберите категорию" => "wine_line",	 
              "Характер вина (вид)"  => "wine_character",
			  "Тип вина (по цвету)"  => "wine_color",
			  "Тип вина (по сахару)" => "wine_sugar",
			  "Сорт винограда" => "wine_grape",
			  "Линейка"=>"wine_line"	
               ),  ), 	  
	     array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Номер таксономии в этой категории",
            "param_name" => "allfeatures_value2",
            "value" => "",
            ),	  
        	  
		 	  
		    array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Дополнительный CSS на всякий случай",
            "param_name" => "allfeatures_css",
            "value" => "",
            ),	 	  	  
		  )
	   )
	);
}

add_shortcode ('tsimlawines_allfeatures','tsimlawines_allfeatures_shortcode');
/* Шорткод: tsimlawines_allfeatures
 * Переменные:
 * allfeatures_feature
 * allfeatures_exclude
 * allfeatures_feature2
 * allfeatures_value2
 * allfeatures_css
 * */


function tsimlawines_allfeatures_shortcode ($atts)
{ 
  $allcats = get_terms( [
	'taxonomy' => $atts['allfeatures_feature'],
	'hide_empty' => true,
	'exclude' => $atts['allfeatures_exclude']]);
	  
  $return_text='<div ';
   if (isset($atts['allfeatures_css']))
	$return_text.=' class="'.$atts['allfeatures_css'];
  $return_text.='">'; 
	
  foreach ($allcats as $cat)
	  {
		$return_text.= '<span class="allfeatures_name"><a href="'. get_term_link( $cat->term_id, $cat->taxonomy );
		if (isset($atts['allfeatures_feature2'])) 
		$return_text.='?feature2='.$atts['allfeatures_feature2'].'&value2='.$atts['allfeatures_value2'];
		$return_text.= '" id="'.$cat->slug.$atts['allfeatures_value2'].'">'. $cat->name .'</a> </span>';
		
	  }
  $return_text.='</div>';	  
  return $return_text;
}

add_action( 'init', 'create_wine_taxonomies');	
// wine_character, wine_color, wine_sugar, wine_grape, wine_taste, wine_combine, wine_line, wine_tax
function create_wine_taxonomies(){	
    // Характер вина: тихое, игристое
	register_taxonomy( 'wine_character', [ 'wine' ], [
		'label'                 => '', 
		'labels'                => [
			'name'              => __( 'Характер вина', 'wine' ),
			'singular_name'     => __( 'Характер вина', 'wine' ),
			'search_items'      => __( 'Искать', 'wine' ),
			'all_items'         => __( 'Все', 'wine' ),
			'view_item '        => __( 'Просмотреть', 'wine' ),
			'edit_item'         => __( 'Редактировать', 'wine' ),
			'update_item'       => __( 'Обновить', 'wine' ),
			'add_new_item'      => __( 'Добавить характер вина', 'wine' ),
			'new_item_name'     => __( 'Название', 'wine' ),
			'menu_name'         => __( 'Характер вина', 'wine' ),
		],
		'description'           => 'Характер вина: тихое, игристое, выдержанное...', // описание таксономии
		'public'                => true,
	    'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'rewrite'               => true,
		'query_var'             => 'wine_character', // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', 
		'show_admin_column'     => true, 
		'show_in_rest'          => true, 
		'rest_base'             => null, 
	] );

   // Тип вина: красное, белое, розовое, оранжевое
	register_taxonomy( 'wine_color', [ 'wine' ], [
		'label'                 => '', 
		'labels'                => [
			'name'              => __( 'Тип вина (цвет)', 'wine' ),
			'singular_name'     => __( 'Тип вина(цвет)', 'wine' ),
			'search_items'      => __( 'Искать', 'wine' ),
			'all_items'         => __( 'Все', 'wine' ),
			'view_item '        => __( 'Просмотреть', 'wine' ),
			'edit_item'         => __( 'Редактировать', 'wine' ),
			'update_item'       => __( 'Обновить', 'wine' ),
			'add_new_item'      => __( 'Добавить тип вина', 'wine' ),
			'new_item_name'     => __( 'Тип вина (цвет)', 'wine' ),
			'menu_name'         => __( 'Тип вина (цвет)', 'wine' ),
		],
		'description'           => 'Тип вина: красное, белое, розовое, оранжевое', // описание таксономии
		'public'                => true,
	    'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'rewrite'               => true,
		'query_var'             => 'wine_color', // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', 
		'show_admin_column'     => true, 
		'show_in_rest'          => true, 
		'rest_base'             => null, 
	] );
	
  // Сахар: брют, сухое, полусухое, полусладкое, сладкое, десертное
	register_taxonomy( 'wine_sugar', [ 'wine' ], [
		'label'                 => '', 
		'labels'                => [
			'name'              => __( 'Тип вина (сахар)', 'wine' ),
			'singular_name'     => __( 'Тип вина(сахар)', 'wine' ),
			'search_items'      => __( 'Искать', 'wine' ),
			'all_items'         => __( 'Все', 'wine' ),
			'view_item '        => __( 'Просмотреть', 'wine' ),
			'edit_item'         => __( 'Редактировать', 'wine' ),
			'update_item'       => __( 'Обновить', 'wine' ),
			'add_new_item'      => __( 'Добавить тип вина по сахару', 'wine' ),
			'new_item_name'     => __( 'Тип вина по сахару', 'wine' ),
			'menu_name'         => __( 'Тип вина по сахару', 'wine' ),
		],
		'description'           => 'Тип вина по сахару: брют, сухое, полусухое, полусладкое, сладкое, десертное', // описание таксономии
		'public'                => true,
	    'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'rewrite'               => true,
		'query_var'             => 'wine_sugar', // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', 
		'show_admin_column'     => true, 
		'show_in_rest'          => true, 
		'rest_base'             => null, 
	] );
	
	 // Сорта винограда
	register_taxonomy( 'wine_grape', [ 'wine' ], [
		'label'                 => '', 
		'labels'                => [
			'name'              => __( 'Сорта винограда', 'wine' ),
			'singular_name'     => __( 'Сорт винограда', 'wine' ),
			'search_items'      => __( 'Искать', 'wine' ),
			'all_items'         => __( 'Все', 'wine' ),
			'view_item '        => __( 'Просмотреть', 'wine' ),
			'edit_item'         => __( 'Редактировать', 'wine' ),
			'update_item'       => __( 'Обновить', 'wine' ),
			'add_new_item'      => __( 'Добавить cорт винограда', 'wine' ),
			'new_item_name'     => __( 'Сорт винограда', 'wine' ),
			'menu_name'         => __( 'Сорта винограда', 'wine' ),
		],
		'description'           => 'Сорта винограда', // описание таксономии
		'public'                => true,
	    'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'rewrite'               => true,
		'query_var'             => 'wine_grape', // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', 
		'show_admin_column'     => true, 
		'show_in_rest'          => true, 
		'rest_base'             => null, 
	] );
	
	 // Оттенки вкуса
	register_taxonomy( 'wine_taste', [ 'wine' ], [
		'label'                 => '', 
		'labels'                => [
			'name'              => __( 'Оттенки вкуса', 'wine' ),
			'singular_name'     => __( 'Оттенок вкуса', 'wine' ),
			'search_items'      => __( 'Искать', 'wine' ),
			'all_items'         => __( 'Все', 'wine' ),
			'view_item '        => __( 'Просмотреть', 'wine' ),
			'edit_item'         => __( 'Редактировать', 'wine' ),
			'update_item'       => __( 'Обновить', 'wine' ),
			'add_new_item'      => __( 'Добавить оттенок вкуса', 'wine' ),
			'new_item_name'     => __( 'Оттенок вкуса', 'wine' ),
			'menu_name'         => __( 'Оттенки вкуса', 'wine' ),
		],
		'description'           => 'Оттенки вкуса: вот эти вот красные ягоды, хлебная корочка, бензоколонка после дождя в тропической деревне и т.д. и т.п.', // описание таксономии
		'public'                => true,
	    'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'rewrite'               => true,
		'query_var'             => 'wine_taste', // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', 
		'show_admin_column'     => false, 
		'show_in_rest'          => true, 
		'rest_base'             => null, 
	] );

	 // Сочетание
	register_taxonomy( 'wine_combine', [ 'wine' ], [
		'label'                 => '', 
		'labels'                => [
			'name'              => __( 'Сочетания', 'wine' ),
			'singular_name'     => __( 'Сочетание', 'wine' ),
			'search_items'      => __( 'Искать', 'wine' ),
			'all_items'         => __( 'Все', 'wine' ),
			'view_item '        => __( 'Просмотреть', 'wine' ),
			'edit_item'         => __( 'Редактировать', 'wine' ),
			'update_item'       => __( 'Обновить', 'wine' ),
			'add_new_item'      => __( 'Добавить сочетание', 'wine' ),
			'new_item_name'     => __( 'Сочетания', 'wine' ),
			'menu_name'         => __( 'Сочетания', 'wine' ),
		],
		'description'           => 'Сочетания, т.е. с чем сочетается это вино: фрукты, сыры, белое мясо, донская следёка, говяжий доширак и т.д.', // описание таксономии
		'public'                => true,
	    'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'rewrite'               => true,
		'query_var'             => 'wine_combine', // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', 
		'show_admin_column'     => false, 
		'show_in_rest'          => true, 
		'rest_base'             => null, 
	] );
	
	// Линейка
	register_taxonomy( 'wine_line', [ 'wine' ], [
		'label'                 => '', 
		'labels'                => [
			'name'              => __( 'Линейки вин', 'wine' ),
			'singular_name'     => __( 'Линейка', 'wine' ),
			'search_items'      => __( 'Искать', 'wine' ),
			'all_items'         => __( 'Все', 'wine' ),
			'view_item '        => __( 'Просмотреть', 'wine' ),
			'edit_item'         => __( 'Редактировать', 'wine' ),
			'update_item'       => __( 'Обновить', 'wine' ),
			'add_new_item'      => __( 'Добавить линейку', 'wine' ),
			'new_item_name'     => __( 'Линейка', 'wine' ),
			'menu_name'         => __( 'Линейки вин', 'wine' ),
		],
		'description'           => 'Сочетания, т.е. с чем сочетается это вино: фрукты, сыры, белое мясо, донская следёка, говяжий доширак и т.д.', // описание таксономии
		'public'                => true,
	    'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'rewrite'               => true,
		'query_var'             => 'wine_line', // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', 
		'show_admin_column'     => true, 
		'show_in_rest'          => true, 
		'rest_base'             => null, 
	] );

	// Запасная таксономия
	register_taxonomy( 'wine_tax', [ 'wine' ], [
		'label'                 => '', 
		'labels'                => [
			'name'              => __( 'Категории', 'wine' ),
			'singular_name'     => __( 'Категория', 'wine' ),
			'search_items'      => __( 'Искать', 'wine' ),
			'all_items'         => __( 'Все', 'wine' ),
			'view_item '        => __( 'Просмотреть', 'wine' ),
			'edit_item'         => __( 'Редактировать', 'wine' ),
			'update_item'       => __( 'Обновить', 'wine' ),
			'add_new_item'      => __( 'Добавить категорию', 'wine' ),
			'new_item_name'     => __( 'Категории', 'wine' ),
			'menu_name'         => __( 'Категория', 'wine' ),
		],
		'description'           => 'Запасная таксономия для всевозможных категорий вина, которые не были учтены в других таксономиях', // описание таксономии
		'public'                => true,
	    'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'rewrite'               => true,
		'query_var'             => 'wine_tax', // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', 
		'show_admin_column'     => false, 
		'show_in_rest'          => true, 
		'rest_base'             => null, 
	] );
	
}

add_theme_support( 'post-thumbnails', array( 'post', 'wine', 'tour','diary' ) );

/* Тип записей "вино"  wine */
function create_wine_posttype() {
    $labels = array(
        'name' => __( 'Вино', 'wine' ),
        'singular_name' => __( 'Вино', 'wine' ),
        'menu_name' => __( 'Вино', 'wine' ),
        'all_items' => __( 'Все вина', 'wine' ),
        'view_item' => __( 'Просмотр карточки вина', 'wine' ),
        'add_new_item' => __( 'Добавить вино', 'wine' ),
        'add_new' => __( 'Добавить вино', 'wine' ),
        'edit_item' => __( 'Редактировать карточку вина', 'wine' ),
        'update_item' => __( 'Обновить карточку вина', 'wine' ),
        'search_items' => __( 'Искать вино', 'wine' ),
        'not_found' => __( 'Не найдено', 'wine' ),
        'not_found_in_trash' => __( 'Не найдено в корзине', 'wine' ),
    );

    $args = array(
        'label' => __( 'Вино', 'wine' ),
        'description' => __( 'Каталог вин', 'wine' ),
        'labels' => $labels,
        'supports' => array('title','thumbnail', 'editor'),
        'taxonomies' => array('wine_character', 'wine_color', 'wine_sugar', 'wine_grape', 'wine_taste', 'wine_combine', 'wine_line', 'wine_tax'),
        'hierarchical' => false,
        'public' => true,
		'menu_position' => 21,		 
		'menu_icon' =>get_stylesheet_directory_uri().'/img/white_wine.png',
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type( 'wine', $args );
}
add_action( 'init', 'create_wine_posttype');

// Добавление картинок к таксономиям
add_action('admin_init', 'add_images_to_taxonomies'); 
function add_images_to_taxonomies()
{
	\Vrabec\WP_Term_Image::init( [
		'taxonomies' => [ 'wine_character', 'wine_color', 'wine_sugar', 'wine_grape', 'wine_taste', 'wine_combine', 'wine_line'],
	] );
}


 // Добавляем метабоксы к винам
 // 1. alcohol_l  - нижняя граница алкоголя
 // 2. alcohol_h  - верхняя граница алкоголя
 // 3. year       - год
 // 4. value      - объём
 // 5. barcode    - код
 // 6. color      - цвет (не путать с характеристикой по цвету)
 // 7. taste      - вкус (общая характеристика, не путать с оттенками вкуса)
 // 8. smell      - аромат... тоже не путать с оттенками вкуса
 // 9. comingsoon - скоро в продаже 
 // 
 
add_action('add_meta_boxes', 'wine_info_metabox_init'); 
add_action('save_post', 'wine_info_metabox_save'); 

function wine_info_metabox_init() { 
add_meta_box('info_metabox', 'Характеристики вина', 'wine_info_metabox_showup', 'wine', 'advanced', 'default'); 
} 

function wine_info_metabox_showup($post, $box) { 
	
wp_nonce_field('wine_info_action', 'wine_info_nonce');	
	
echo '<div class="adminka">';
echo '<div class="container adminka">';	
	
// 1. Нижняя граница алкоголя
// 2. Верхняя граница алкоголя	
$alcohol_l = get_post_meta($post->ID, '_alcohol_l', true);
if(!isset($alcohol_l)) $alcohol_l='';
$alcohol_h = get_post_meta($post->ID, '_alcohol_h', true);
if(!isset($alcohol_h)) $alcohol_h='';
	
	
echo '<div class="row adminka"><div class="col-md-2 name">Алкоголь от: </div><div class="col-md-3"><input type="text" name="alcohol_l" value="'. esc_attr($alcohol_l) . '" size="20"/></div> <div class="col-md-1 name">до: </div><div class="col-md-3"><input type="text" name="alcohol_h" value="'. esc_attr($alcohol_h) . '" size="20"/> %</div> </div>';

// 3. Год
$year = get_post_meta($post->ID, '_year', true);
if(!isset($year)) $year='';
echo '<div class="row"><div class="col-md-2 name">Год урожая: </div><div class="col-md-8"><input type="text" name="year" value="'. esc_attr($year) . '" size="10"/></div></div>';

// 4. Объём
$value = get_post_meta($post->ID, '_value', true);
if(!isset($value)) $value='';
echo '<div class="row"><div class="col-md-2 name">Объём: </div><div class="col-md-8"><input type="text" name="value" value="'. esc_attr($value) . '" size="10"/> л.</div></div>';
	
// 6. color     - цвет (не путать с характеристикой по цвету)
$color = get_post_meta($post->ID, '_color', true);
if(!isset($color)) $color='';
echo '<div class="row"><div class="col-md-2 name">Описание цвета и перляжа (если есть): </div><div class="col-md-8"><textarea name="color" rows="5" cols="33">'. esc_attr($color) . '</textarea></div></div>';	

// 7. taste     - вкус (общая характеристика, не путать с оттенками вкуса)

$taste = get_post_meta($post->ID, '_taste', true);
if(!isset($taste)) $taste='';
echo '<div class="row"><div class="col-md-2 name">Описание вкуса: </div><div class="col-md-8"><textarea name="taste" rows="5" cols="33">'.esc_attr($taste).'</textarea></div></div>';	
	
// 8. smell     - аромат... тоже не путать с оттенками вкуса
$smell = get_post_meta($post->ID, '_smell', true);
if(!isset($smell)) $smell='';
echo '<div class="row"><div class="col-md-2 name">Описание аромата: </div><div class="col-md-8"><textarea name="smell" rows="5" cols="33">'.esc_attr($smell).'</textarea></div></div>';	


// 9. Скоро в продаже
$comingsoon = get_post_meta($post->ID, '_comingsoon', true);
if(!isset($comingsoon)) $comingsoon="no";
echo '<div class="row"><div class="col-md-2 name">Скоро в продаже: </div><div class="col-md-8"><input type="checkbox" name="comingsoon" value="yes" ';
if ($comingsoon=="yes") echo ' checked ';	
echo	'/></div></div>';



// 5. Код
$barcode = get_post_meta($post->ID, '_barcode', true);
if(!isset($barcode)) $barcode='';
echo '<div class="row"><div class="col-md-2 name">Код (пока не заполняй): </div><div class="col-md-8"><input type="text" name="barcode" value="'. esc_attr($barcode) . '" size="80"/></div></div>';	


	
echo '</div>';	
	 echo "</div>";
}

function wine_info_metabox_save($postID) { 

if ((!isset($_POST['alcohol_l']))&&(!isset($_POST['alcohol_h']))&&(!isset($_POST['year']))&&(!isset($_POST['barcode']))&&(!isset($_POST['value']))&&(!isset($_POST['color']))&&(!isset($_POST['taste']))&&(!isset($_POST['smell']))) 
return; 
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
return; 
if (wp_is_post_revision($postID)) 
return; 
	
check_admin_referer('wine_info_action', 'wine_info_nonce'); 

if (isset($_POST['alcohol_l']))
    {  
     $data = sanitize_text_field($_POST['alcohol_l']); 
	 if ($data!="")
     update_post_meta($postID, '_alcohol_l', $data); 
     }
	
if (isset($_POST['alcohol_h']))
    {  
     $data = sanitize_text_field($_POST['alcohol_h']);
	 if ($data!="")
     update_post_meta($postID, '_alcohol_h', $data); 
     }
	 
if (isset($_POST['year']))
    {  
     $data = $_POST['year'];
     update_post_meta($postID, '_year', $data); 	
     }

if (isset($_POST['value']))
    {  
     $data = sanitize_text_field($_POST['value']); 
	 if ($data!="")
     update_post_meta($postID, '_value', $data); 
     }
if (isset($_POST['barcode']))
    {  
     $data = sanitize_text_field($_POST['barcode']); 
	 if ($data!="")
     update_post_meta($postID, '_barcode', $data); 
     }
if (isset($_POST['color']))
    {  
     $data = sanitize_text_field($_POST['color']); 
	 if ($data!="")
     update_post_meta($postID, '_color', $data); 
     }	
if (isset($_POST['taste']))
    {  
     $data = sanitize_text_field($_POST['taste']); 
	 if ($data!="")
     update_post_meta($postID, '_taste', $data); 
     }	
if (isset($_POST['smell']))
    {  
     $data = sanitize_text_field($_POST['smell']); 
	 if ($data!="")
     update_post_meta($postID, '_smell', $data); 
     }	
	
if (isset($_POST['comingsoon'])&&($_POST['comingsoon']="yes"))
    update_post_meta($postID, '_comingsoon',"yes"); 
	 else update_post_meta($postID, '_comingsoon',""); 
     	
}

/* Шорткод [show_wine id= вино с определённым номером (страничка single-wine.php)
 *                    perrow = сколько колонок в ряд
 *                    exclude = какое вино исключить
 *                    feature= wine_character
 *                             wine_sugar
 *                             wine_color
 *                             wine_grape
 *                             wine_line
 *                    feature2=wine_character
 *                             wine_sugar
 *                             wine_color
 *                             wine_grape
 *                             wine_line
 *                    value= номер таксономии feature   
 *                    value2=номер таксономии feature2   
 *                    year= _year                    
 *                    num= сколько всего показывать
 *                  ]
 * 
 * */

function create_showwine_shortcode($args)
{
	$params=shortcode_atts(
	                   array(
						   'id'=>'0',
					       'perrow'=>'1',
                           'feature'=>'',
						   'feature2'=>'',
						   'value2'=>'0',
						   'exclude'=>'0',
                           'value'=>'0',      
                           'year'=>'',                          
                           'num' =>'-1' 
						     ), $args);
	$params['id']=(int)$params['id'];
	$params['perrow']=(int)$params['perrow'];
	$params['value']=(int)$params['value'];
	$params['num']=(int)$params['num'];
	$params['exclude']=(int)$params['exclude'];
	
	// Это будет переменная, в которую мы будем записывать вывод на экран и которую будем возвращать
	$text_to_return='';
   // Вычисляем что должно быть указано в стилях, в зависимости от того, сколько колонок в ряд указано
	if ($params['perrow']>0)
			{ //если несколько в ряд
			  switch ($params['perrow']) {
				  case 1:
					  $colmd='col-md-12';
					  break;	  
				  case 2:
					  $colmd='col-md-6';
					  break;
			      case 3:
					  $colmd='col-md-4';
					  break;
			      case 4:
					  $colmd='col-md-3';
					  break;
				  case 5:
					  $colmd='col-md';
					  break;	  
				  default:	  
					  $params['perrow']=6;
					  $colmd='col-md-2';
					  break;	  
			  }	}
	
    //Это если вывести определённый блок 
	if ($params['id']!=0)
	{   $args=array(
	       'post_type'=>'wine',
	       'include'=>$params['id']);
		    $allposts=get_posts($args);
	}
	else
    {
     // Это если вывести подборку вин
	$args=array(
		'post_type'=>'wine',
		'posts_per_page'=>$params['num'],
				); 
     // Если без какого-то вина
     if ($params['exclude']!=0)
		 $args['exclude']=$params['exclude'];
	//Если указана характеристика feature
	if ($params['feature']!='')
	{
		  $args['tax_query'] = array(
		             array(
			         'taxonomy' => $params['feature'],
			         'field'    => 'id',
		             'terms'    => $params['value'],
		                 )
	                   ); 
	  }
	if ($params['feature2']!='')
	{
		  $args['tax_query'] = array(
			         'relation'=>'AND',
			         array(
			         'taxonomy' => $params['feature'],
			         'field'    => 'id',
		             'terms'    => $params['value'],
		                 ),
		             array(
			         'taxonomy' => $params['feature2'],
			         'field'    => 'id',
		             'terms'    => $params['value2'],
		                 )
	                   ); 
	  }	
	// если указан год	
	if ($params['year']!='')
	{   
		$args['meta_query']=array(
		            array(
					'key'=>'_year',
					'value'=>$params['year']
					));
	}  
		
	$allposts=get_posts($args);
		
     }		
		if ($allposts)
		{    // если много бутылочек
		//	$text_to_return=print_r($args,true);
	    	$text_to_return='';
			if ($params['id']==0)
			{
				$text_to_return.='<div class="container"><div class="row">';
				$i=0;	
				if ($params['perrow']>1)
				{
				foreach($allposts as $block )
			     { $i++;
				   if (($i>$params['perrow'])&&($i%$params['perrow']==1))
				       { $text_to_return.='<div class="row">';}
				   $smallpic=get_the_post_thumbnail_url($block,'large');
			       $text_to_return.='<div class="'.$colmd.' bottle-row"><div class="wine-image">';		
			       $text_to_return.='<a href="'.get_permalink($block).'"><img src="'.$smallpic.'"></a></div>';
				   $text_to_return.='<div class="wine-text" style="margin-top: 20px">';
				   if($block->_comingsoon=="yes")		
			       $text_to_return.='<h5 class="comingsoon">Скоро в продаже!</h5>'; 				  
				   $wine_line=get_the_terms($block->ID, 'wine_line');
                   if($wine_line)		
			       $text_to_return.='<h5 class="wine-linename"><a href="'. get_term_link( $wine_line[0]->term_id, $wine_line[0]->taxonomy ) .'">'.$wine_line[0]->name.'</a></h5>';   
				   $text_to_return.='<h5 class="wine-title"><a href="'.get_permalink($block).'">'.$block->post_title.'</a></h5>';
				  
				   $text_to_return.='</div></div>';
				   if ($i%$params['perrow']==0) {$text_to_return.='</div>';}
				   }
				}
				else
				{foreach($allposts as $block )
			     { $smallpic=get_the_post_thumbnail_url($block,'medium');
			       $text_to_return.='<div class="small-wine"><div class="wine-image">';		
			       $text_to_return.='<a href="'.get_permalink($block).'"><img src="'.$smallpic.'"></a></div>';
				    $text_to_return.='<div class="wine-text">'; 
				   $wline=get_the_terms($block->ID, 'wine_line');
				   $text_to_return.='<h5 class="wine-linename">'.$wline[0]->name.'</h5>';
				   $text_to_return.='<h5 class="wine-title">'.$block->post_title.'</h5>';
			       $text_to_return.='</div></div>';					
				}
				}
				$text_to_return.='</div></div>';	
			}  
			
			// если одна бутылочка
			else 
			{ 	foreach($allposts as $block )
			{
				 $smallpic=get_the_post_thumbnail_url($block,'large');
			     $text_to_return.='<div class="'.$colmd.'"><div class="wine-image">';		
			       $text_to_return.='<a href="'.get_permalink($block).'"><img src="'.$smallpic.'"></a></div>';
				   $text_to_return.='<div class="wine-text" style="margin-top: 20px">';
				   $wine_line=get_the_terms($block->ID, 'wine_line');
                   if($wine_line)		
			       $text_to_return.='<h5 class="wine-linename"><a href="'. get_term_link( $wine_line[0]->term_id, $wine_line[0]->taxonomy ) .'">'.$wine_line[0]->name.'</a></h5>';   
				   $text_to_return.='<h5 class="wine-title"><a href="'.get_permalink($block).'">'.$block->post_title.'</a></h5>';
				  
				   $text_to_return.='</div></div>';
			}
			}
		}
		return $text_to_return;
}

add_shortcode('show_wine', 'create_showwine_shortcode');

add_action( 'init', 'create_tour_taxonomies');	
function create_tour_taxonomies(){	register_taxonomy( 'tour_tax', [ 'tour' ], [
		'label'                 => '', 
		'labels'                => [
			'name'              => __( 'Категории', 'tour' ),
			'singular_name'     => __( 'Категория', 'tour' ),
			'search_items'      => __( 'Искать', 'tour' ),
			'all_items'         => __( 'Все', 'tour' ),
			'view_item '        => __( 'Просмотреть', 'tour' ),
			'edit_item'         => __( 'Редактировать', 'tour' ),
			'update_item'       => __( 'Обновить', 'tour' ),
			'add_new_item'      => __( 'Добавить категорию', 'tour' ),
			'new_item_name'     => __( 'Категории', 'tour' ),
			'menu_name'         => __( 'Категория', 'tour' ),
		],
		'description'           => 'Запасная таксономия для всевозможных категорий вина, которые не были учтены в других таксономиях', // описание таксономии
		'public'                => true,
	    'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'rewrite'               => true,
		'query_var'             => 'tour_tax', // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', 
		'show_admin_column'     => false, 
		'show_in_rest'          => true, 
		'rest_base'             => null, 
	] );
	
}

/* Тип записей "экскурсия"  tour */
function create_tour_posttype() {
    $labels = array(
        'name' => __( 'Экскурсии', 'tour' ),
        'singular_name' => __( 'Экскурсия', 'tour' ),
        'menu_name' => __( 'Экскурсии', 'tour' ),
        'all_items' => __( 'Все экскурсии', 'tour' ),
        'view_item' => __( 'Просмотр карточки экскурсии', 'tour' ),
        'add_new_item' => __( 'Добавить экскурсию', 'tour' ),
        'add_new' => __( 'Добавить экскурсию', 'tour' ),
        'edit_item' => __( 'Редактировать карточку экскурсии', 'tour' ),
        'update_item' => __( 'Обновить карточку экскурсии', 'tour' ),
        'search_items' => __( 'Искать экскурсию', 'tour' ),
        'not_found' => __( 'Не найдено', 'tour' ),
        'not_found_in_trash' => __( 'Не найдено в корзине', 'tour' ),
    );

    $args = array(
        'label' => __( 'Экскурсия', 'tour' ),
        'description' => __( 'Список экскурсий', 'tour' ),
        'labels' => $labels,
        'supports' => array('title','thumbnail','editor', 'excerpt'),
        'taxonomies' => array('tour_tax'),
        'hierarchical' => false,
        'public' => true,
		'menu_position' => 22,		 
		'menu_icon' =>get_stylesheet_directory_uri().'/img/tour.png',
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type( 'tour', $args );
}
add_action( 'init', 'create_tour_posttype');


// Добавляем метабоксы к экскурсиям
// 0. old_name     - старое название экскурсии
// 1. people_min   - кол-во человек от
// 2. people_max   - кол-во человек до
// 3. duration     - продолжительность
// 4. price        - стоимость
// 5. for_price    - примечание к цене
// 6. degustation  - есть/нет дегустация
// 7. when_date    - свободные даты
// 

add_action('add_meta_boxes', 'tour_info_metabox_init'); 
add_action('save_post', 'tour_info_metabox_save'); 

function tour_info_metabox_init() { 
add_meta_box('info_metabox', 'Количество человек', 'tour_info_metabox_showup', 'tour', 'advanced', 'default'); 
} 

function tour_info_metabox_showup($post, $box) { 
	
wp_nonce_field('tour_info_action', 'tour_info_nonce');	
	
echo '<div class="adminka">';
echo '<div class="container adminka">';	
	
// 0. Старое название экскурсии old_name	
// 1. Кол-во человек от people_min
// 2. Кол-во человек до	people_max 
$old_name = get_post_meta($post->ID, '_old_name', true);
if(!isset($old_name)) $old_name='';
$people_min = get_post_meta($post->ID, '_people_min', true);
if(!isset($people_min)) $people_min='';
$people_max = get_post_meta($post->ID, '_people_max', true);
if(!isset($people_max)) $people_max='';
	
	
echo '<div class="row adminka"><div class="col-md-2 name">Старое название экскурсии</div><div class="col-md-10"><input type="text" name="old_name" value="'.esc_attr($old_name).'" size="80"></div></div><div class="row adminka"><div class="col-md-2 name">Количество человек на экскурсии от: </div><div class="col-md-3"><input type="text" name="people_min" value="'. esc_attr($people_min) . '" size="20"/></div> <div class="col-md-1 name">до: </div><div class="col-md-3"><input type="text" name="people_max" value="'. esc_attr($people_max) . '" size="20"/> чел.</div> </div>';

echo '</div></div>';
}


add_action('add_meta_boxes', 'tour_price_metabox_init'); 
add_action('save_post', 'tour_price_metabox_save'); 

function tour_price_metabox_init() { 
add_meta_box('price_metabox', 'Стоимость экскурсии', 'tour_price_metabox_showup', 'tour', 'advanced', 'default'); 
} 

function tour_price_metabox_showup($post, $box) { 
	
wp_nonce_field('tour_price_action', 'tour_price_nonce');	
echo '<div class="adminka">';
echo '<div class="container adminka">';		
// 3. Продолжительность duration
$duration = get_post_meta($post->ID, '_duration', true);
if(!isset($duration)) $duration='';
echo '<div class="row adminka"><div class="col-md-2 name">Продолжительность экскурсии: </div><div class="col-md-8"><input type="text" name="duration" value="'. esc_attr($duration) . '" size="80"/>мин.</div></div>';

// 4. Стоимость price
$price = get_post_meta($post->ID, '_price', true);
if(!isset($price)) $price='';
echo '<div class="row"><div class="col-md-2 name">Стоимость экскурсии: </div><div class="col-md-8"><input type="text" name="price" value="'. esc_attr($price) . '" size="80"/> р.</div></div>';

// 5. Примечание к цене (с человека, за группу) for_price
$for_price = get_post_meta($post->ID, '_for_price', true);
if(!isset($for_price)) $for_price='';
echo '<div class="row"><div class="col-md-2 name">Примечание к цене (с человека, за группу): </div><div class="col-md-8"><input type="text" name="for_price" value="'. esc_attr($for_price) . '" size="80"/></div></div>';	

	
//6. degustation  - есть/нет дегустация
$degustation = get_post_meta($post->ID, '_degustation', true);
echo '<div class="row"><div class="col-md-2 name">Дегустация </div><div class="col-md-8"><input type="checkbox" name="degustation" value="1"'; 
if ($degustation) echo ' checked';
echo '> Есть';	
echo'</div></div>';	

// 7. Когда when_date
$when_date = get_post_meta($post->ID, '_when_date', true);
if(!isset($when_date)) $when_date='';
echo '<div class="row"><div class="col-md-2 name">Даты и время: </div><div class="col-md-8"><textarea name="when_date" cols="60" rows="10">'.$when_date.'</textarea></div></div>';	

}

function tour_info_metabox_save($postID) { 

if ((!isset($_POST['people_min']))&&(!isset($_POST['people_max']))&&(!isset($_POST['old_name']))) 
return; 
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
return; 
if (wp_is_post_revision($postID)) 
return; 
	
check_admin_referer('tour_info_action', 'tour_info_nonce'); 

if (isset($_POST['old_name']))
    {  
     $data = sanitize_text_field($_POST['old_name']); 
	 if ($data!="")
     update_post_meta($postID, '_old_name', $data); 
     }
	
if (isset($_POST['people_min']))
    {  
     $data = sanitize_text_field($_POST['people_min']); 
	 if ($data!="")
     update_post_meta($postID, '_people_min', $data); 
     }
	
if (isset($_POST['people_max']))
    {  
     $data = sanitize_text_field($_POST['people_max']);
	 if ($data!="")
     update_post_meta($postID, '_people_max', $data); 
     }
}

function tour_price_metabox_save($postID) { 

if ((!isset($_POST['duration']))&&(!isset($_POST['price']))&&(!isset($_POST['for_price']))&&(!isset($_POST['degustation']))&&(!isset($_POST['agegate'])))
return; 
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
return; 
if (wp_is_post_revision($postID)) 
return; 
	
check_admin_referer('tour_price_action', 'tour_price_nonce'); 
	
if (isset($_POST['duration']))
    {  
     $data = $_POST['duration'];
     update_post_meta($postID, '_duration', $data); 	
     }

if (isset($_POST['price']))
    {  
     $data = sanitize_text_field($_POST['price']); 
	 if ($data!="")
     update_post_meta($postID, '_price', $data); 
     }
if (isset($_POST['for_price']))
    {  
     $data = sanitize_text_field($_POST['for_price']); 
	 if ($data!="")
     update_post_meta($postID, '_for_price', $data); 
     }
if (isset($_POST['when_date']))
    {  
     $data = sanitize_text_field($_POST['when_date']); 
	 if ($data!="")
     update_post_meta($postID, '_when_date', $data); 
     }	
if (isset($_POST['degustation']))
    {  
     $data = ($_POST['degustation']); 
	 if ($data=="1")
     update_post_meta($postID, '_degustation', true);
	  else update_post_meta($postID, '_degustation', false);
     }	

}


/* Виджет Вывод экскурсий для jsComposer 
 * Шорткод: tsimlawines_tours
 * Переменные:
 * tours_num
 * tours_css
 * */

add_action ('vc_before_init', 'add_tours_widget');

function add_tours_widget()
{
	vc_map( array(
		  "name" => "Вывод экскурий",    
          "base" => "tsimlawines_tours",  
		  "icon" => get_stylesheet_directory_uri().'/img/allfeatures.png',
          "description" => "Вывод всех экскурсий",  
		  "category" =>"Aperitif Core",   
          "params"=>array(  	 
			array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Сколько экскурсий вывести?",
            "param_name" => "tours_num",
            "value" => "",
            ),	 	  
		    array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Дополнительный CSS на всякий случай",
            "param_name" => "tours_css",
            "value" => "",
            ),	 	  	  
		  )
	   )
	);
}

add_shortcode ('tsimlawines_tours','tsimlawines_tours_shortcode');
/* Шорткод: tsimlawines_tours
 * Переменные:
 * tours_num
 * tours_css
 * */

function tsimlawines_tours_shortcode ($atts)
{ 
  $args=array('post_type'=>'tour',
			  'posts_per_page'=>(int)$atts['tours_num']
			 );
  $alltours=get_posts($args);
  $return_text='';	
  if ($alltours)	
  {	  
  $return_text='<div class="container ';
   if (isset($atts['tours_css']))
	$return_text.=' '.$atts['tours_css'];
  $return_text.='">'; 
 	
  foreach ($alltours as $tour)
	  { $return_text.='<div class="row">';
	     $smallpic=get_the_post_thumbnail_url($tour,'small');			   				  
	     $return_text.= '<div class="col-md-2 tour-small-pic"><a href="'.get_permalink($tour).'"> <img src="'.$smallpic.'"></a></div>';
	    $return_text.='<div class="col-md-6 tour-info"><h5><a href="'.get_permalink($tour).'">'.$tour->post_title.'</a></h5>';
	    $return_text.='<div class="tour-small-excerpt">('.$tour->_old_name.')<br><a href="'.get_permalink($tour).'">'.get_the_excerpt($tour).'</a></div>';
	    $return_text.='<div class="tour-uslovia"><span class="tour-people"><img src="'.get_stylesheet_directory_uri().'/img/chelovechek.png">';
	    if ((isset($tour->_people_min))&&($tour->_people_min>0)) $return_text.=' от '.$tour->_people_min.' чел. ';
	    if ((isset($tour->_people_max))&&($tour->_people_max>0)) $return_text.=' до '.$tour->_people_max.' чел. ';
	    $return_text.='</span>';
        if ((isset($tour->_price))&&($tour->_price>0))  
	    $return_text.='<span class="tour-money"><img src="'.get_stylesheet_directory_uri().'/img/rubl.png"> '.$tour->_price.' '.$tour->_for_price.'</span>';
	    $return_text.='</div></div>';
	    $return_text.='<div class="col-md-4 tour-order">';
        if ($tour->_degustation)
			$return_text.='<span class="tour-adults0nly-sign"><img src="'.get_stylesheet_directory_uri().'/img/adultsonly.png"></span>';
	   $return_text.='<div class="order-button"><button class="tour-'.$tour->ID.'">Заказать</button></div>';
	   $return_text.='</div></div>';
	  }
  $return_text.='</div>';	
  }
  return $return_text;
}

add_shortcode ('show_lines','show_lines_shortcode');

/* Шорткод: show_lines
 * Переменные:
 * perrow
 * 
 * */
function show_lines_shortcode ($atts)
{ 
if (isset($atts['perrow'])) $atts['perrow']=(int)$atts['perrow'];
	else $atts['perrow']=6;
$return_text='';	
$all_lines=get_terms([
	'taxonomy' => 'wine_line',
	'hide_empty' =>true,
    'orderby' => 'slug']);
if ($all_lines)
{
	foreach($all_lines as $line)
	{
		$return_text.='<div class="row">';
		$return_text.='<h2><a href="'. get_term_link( $line->term_id, $line->taxonomy ).'">'.$line->name.'</a></h2>';
		$return_text.=do_shortcode('[show_wine feature="wine_line" value="'.$line->term_id.'" num=-1 perrow="'.$atts['perrow'].'"]');
		$return_text.='</div>';
	}
}
	return $return_text;
}


/* Виджет Вывод списка линеек для jsComposer 
 * Шорткод: tsimlawines_lines
 * Переменные:
 * lines_include
 * lines_align
 * lines_postfix
 * lines_css
 * */

add_action ('vc_before_init', 'add_lines_widget');

function add_lines_widget()
{
	vc_map( array(
		  "name" => "Вывод списка линеек",    
          "base" => "tsimlawines_lines",  
		  "icon" => get_stylesheet_directory_uri().'/img/allfeatures.png',
          "description" => "Вывод списка линеек",  
		  "category" =>"Aperitif Core",   
          "params"=>array(
		  
	    array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => "Как отформатировать?",
            "param_name" => "lines_align",
            "value"       => array(
			  "Форматируем по..." => "inherit",	 
              "Левому краю"  => "left",
			  "Правому краю"  => "right",
			  "Центру" => "center"
               ),  ), 
			  
		array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Если включить только определённые линейки - через запятую",
            "param_name" => "lines_include",
            "value" => "",
            ), 
		array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Постфикс id (любое число и/или латинские буквы без пробелов)",
            "param_name" => "lines_postfix",
            "value" => "",
            ),	  
	    array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => "Дополнительный CSS на всякий случай",
            "param_name" => "lines_css",
            "value" => "",
            )	 	  	  
		  )
	   )
	);
}

add_shortcode ('tsimlawines_lines','tsimlawines_lines_shortcode');
/* Шорткод: tsimlawines_lines
 * Переменные:
 * lines_include
 * lines_align
 * lines_postfix
 * lines_css
 * */

function tsimlawines_lines_shortcode ($atts)
{ 
  if (isset ($atts['lines_include']))	
  $allcats = get_terms( [
	'taxonomy' => 'wine_line',
	'hide_empty' => true,
	'include' => $atts['lines_include'],
    'orderby' => 'include',
    'order'=> 'DESC']);
	else 
  $allcats = get_terms( [
	'taxonomy' => 'wine_line',
	'hide_empty' => true]);
	
  $return_text='<div ';
  $return_text.=' ids="'.$atts['lines_include'].'" ';	
   if (isset($atts['lines_css']))
	$return_text.=' class="'.$atts['lines_css'].'"';
   if (isset($atts['lines_align']))	
    $return_text.=' style="text-align: '.$atts['lines_align'].'"'; 
 
   $return_text.=' >';
	
if ($allcats)	
  foreach ($allcats as $cat)
	  {
		$return_text.= '<div><a href="'. get_term_link( $cat->term_id, $cat->taxonomy );
		$return_text.= '" id="'.$cat->slug.$atts['lines_postfix'].'">'. $cat->name .'</a> </div>';
		
	  }
  $return_text.='</div>';	  
  return $return_text;
}


/* Тип записей "запись в дневнике"  diary */
function create_diary_posttype() {
    $labels = array(
        'name' => __( 'Дневник виноградаря', 'diary' ),
        'singular_name' => __( 'Дневник', 'diary' ),
        'menu_name' => __( 'Дневник', 'diary' ),
        'all_items' => __( 'Все записи дневника', 'diary' ),
        'view_item' => __( 'Просмотр записи дневника', 'diary' ),
        'add_new_item' => __( 'Добавить запись в дневник', 'diary' ),
        'add_new' => __( 'Добавить запись в дневник', 'diary' ),
        'edit_item' => __( 'Редактировать запись дневника', 'diary' ),
        'update_item' => __( 'Обновить запись в дневник', 'diary' ),
        'search_items' => __( 'Искать запись', 'diary' ),
        'not_found' => __( 'Не найдено', 'diary' ),
        'not_found_in_trash' => __( 'Не найдено в корзине', 'diary' ),
    );

    $args = array(
        'label' => __( 'Дневник', 'diary' ),
        'description' => __( 'Дневник виноградаря', 'diary' ),
        'labels' => $labels,
        'supports' => array('title','thumbnail', 'editor'),
        'hierarchical' => false,
        'public' => true,
		'menu_position' => 24,		 
		'menu_icon' =>get_stylesheet_directory_uri().'/img/diary.png',
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type( 'diary', $args );
}
add_action( 'init', 'create_diary_posttype');


// Добавляем метабоксы к дневнику виноградаря
// 1. year - год
// 2. month - месяц
// 3. index - год+месяц (заполняется автоматически)
// 

add_action('add_meta_boxes', 'diary_metabox_init'); 
add_action('save_post', 'diary_metabox_save'); 

function diary_metabox_init() { 
add_meta_box('info_metabox', 'Год и месяц записи', 'diary_metabox_showup', 'diary', 'advanced', 'default'); 
} 

function diary_metabox_showup($post, $box) { 
	
wp_nonce_field('diary_action', 'diary_nonce');	
	
echo '<div class="adminka">';
echo '<div class="container adminka">';	
//print_r($post);	
// 1. year - год
// 2. month - месяц
$all_months= array('Выберите месяц','Январь','Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октрябрь', 'Ноябрь', 'Декабрь' );

$year = get_post_meta($post->ID, '_year', true);
if(!isset($year)) $year='';
	
$month_id = get_post_meta($post->ID, '_month', true);
if(!isset($month_id)) $month_id=0;
	else $month_id=(int)$month_id;

	
echo '<div class="row adminka"><div class="col-md-2 name">Год: </div><div class="col-md-3"><input type="text" name="diary_year" value="'. esc_attr($year) . '" size="20"/></div> <div class="col-md-1 name">Месяц: </div><div class="col-md-3">';
	echo '<select name="diary_month" >';
	if ($month_id!=0)
		echo '<option selected value="'.$month_id.'">'.$all_months[$month_id].'</option>';
    else 
		echo '<option value="0">Выберите месяц</option>';
	for ($i=1; $i<13; $i++)
	{
		echo '<option value="'.$i.'">'.$all_months[$i].'</option>';
	}
echo '</select>';	
echo '</div> </div>';


}

function diary_metabox_save($postID) { 

if ((!isset($_POST['diary_month']))&&(!isset($_POST['diary_year']))) 
return; 
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
return; 
if (wp_is_post_revision($postID)) 
return; 
$post_type = get_post_type($postID);	
if ($post_type!='diary')	
return;

check_admin_referer('diary_action', 'diary_nonce'); 	
$index='';	
if (isset($_POST['diary_year']))
    {  
     $data = (int)$_POST['diary_year']; 
	 $index.= $_POST['diary_year'];
	 update_post_meta($postID, '_year', $data); 
     }
	
if (isset($_POST['diary_month']))
    {  
     $data = (int)$_POST['diary_month'];
	 update_post_meta($postID, '_month', $data); 
	 if ($data<10)
	 $index.='0'.$_POST['diary_month'];
	  else  $index.=$_POST['diary_month'];	
	 update_post_meta($postID, '_index', (int)$index); 
     }	
}

add_shortcode ('show_diary','show_diary_shortcode');

/* Шорткод: show_diary
 * Переменные:
 * year
 * month
 * order = 'ASC', 'DESC'
 * 
 * */
function show_diary_shortcode ($atts)
{ 
if(!isset($atts['order']))
	$atts['order']='DESC';
$args=array(
   'post_type'=>'diary',
   'posts_per_page'=>-1,
   'orderby'=>'meta_value',
   'meta_key'=>'_index',
   'order'=>$atts['order']
);
	
if (isset($atts['year']))
$args['meta_query'][]=
	     array(
         'key'=>'_diary_year',
	     'value'=>(int)$atts['year'] 
);
	
if (isset($atts['month']))
$args['meta_query'][]=
	      array(
         'key'=>'_diary_month',
	     'value'=>(int)$atts['month'] 
			  );	
	
if ((isset($atts['month']))&&(isset($atts['year'])))
	$args['meta_query']['relation']='AND';

$the_whole_diary=get_posts($args);
	
$return_text='';	

	if ($the_whole_diary)
	{    
		$return_text.='<div class="container diary">';
		$year=0;
		$month=0;
		$all_months= array('Выберите месяц','Январь','Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октрябрь', 'Ноябрь', 'Декабрь' );

		foreach ($the_whole_diary as $diary)
		{
			$return_text.='<div class="row">';
			$return_text.='<div class="col-md-1">';
			if ((int)$diary->_year!=$year) 
			{$return_text.='<span class="diary-year">'.$diary->_year.'</span>';
			 $year=(int)$diary->_year;
			}
			$return_text.='</div>';
			
			$return_text.='<div class="col-md-1">';
			if ((int)$diary->_month!=$month) 
			{$return_text.='<span class="diary-month">'.$all_months[$diary->_month].'</span>';
			 $month=(int)$diary->_month;
			}
			$return_text.='</div>';
			
			$return_text.='<div class="col-md-6 diary-content">';
			$return_text.='<h3>'.$diary->post_title.'</h3>';
			$return_text.='<span class="diary-text">'.$diary->post_content.'</span>';
			$return_text.='</div>';
		    $smallpic=get_the_post_thumbnail_url($diary,'small');			   				  
	  
			$return_text.='<div class="col-md-3">';
			$return_text.='<span class="diary-pic">';
			if (isset($smallpic))
			$return_text.='<a href="'.$smallpic.'" data-lightbox="diary-gallery" data-title="'.$diary->post_title.'"><img src="'.$smallpic.'"></a>';
			$return_text.='</span>';
			$return_text.='</div>';
			$return_text.='</div>';
		}
	}
	else $return_text=print_r($args, true);
return $return_text;
}

add_shortcode ('show_grapes','show_grapes_shortcode');

/* Шорткод: [show_grapes
 *           except = '' / без каких сортов винограда 
 *                ]
 * */
function show_grapes_shortcode ($atts)
{
  $allgrapes=get_terms([
	  'taxonomy'=>'wine_grape',
	  'hide_empty' =>true,
	  'exclude' => $atts['except'],
  ]);
	
 $return_text='<div class="container grapes" style="display: block; margin: 0 auto; max-width: 1200px;">';
	if (isset($allgrapes))
	{
		$k=0;
		foreach ($allgrapes as $grape)
		{
			$k++;
			if ((($k>4)&&($k%4==1))||($k==1))
			 { $return_text.='<div class="row">';}
			$return_text.='<div class="col-md-3">';
			$image_id=get_term_meta($grape->term_id,'_thumbnail_id',1);
			$image_url=wp_get_attachment_image_url($image_id, 'full');
		    if ((isset($image_url))&&($image_url!=""))
     
			$return_text.='<a href="'.get_term_link($grape->term_id, $grape->taxonomy).'"><div class="grape-pic" style="display: block; height: 200px; background-image: url('.$image_url.'); background-size: cover;
    background-position: center center;"></div></a>';
			$return_text.='<h5 class="grape-name">'.$grape->name.'</h5>';
			$return_text.='</div>';
			if ($k%4==0) {$return_text.='</div>';}
		}		
	}
$return_text.='</div>';	
	
	return $return_text;
}

add_filter( 'get_search_form', 'special_wine_search', 10, 2 );

/**
 * Function for `get_search_form` filter-hook.
 * 
 * @param string $form The search form HTML output.
 * @param array  $args The array of arguments for building the search form. See get_search_form() for information on accepted arguments.
 *
 * @return string
 */
function special_wine_search( $form, $args ){	
	$alltypes=get_terms('wine_character');
	$form = '
	<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<div class="col-md-3"><label for="wine_character">Характер вина</label>
		                  <select name="wine_character" id="wine_character">';
	if (isset($_GET['wine_character']))
	{
	   $char_term = get_term($_GET['wine_character'], 'wine_character');
       $form.= '<option value="'.$_GET['wine_character'].'">'.$char_term ->name.'</option>';
	}
	else
		$form.= '<option value=""> Выберите характер вина</option>';
	
		if ((isset ($alltypes))&&(sizeof($alltypes)>0))
	foreach	($alltypes as $wine_char)
	{$form.='<option value="'.$wine_char->term_id.'">'.$wine_char->name.'</option>'; 
	}
	$form.='</select></div>';
	$form.='<div class="col-md-3"><label for="wine_color">Цвет вина</label>
		                          <select name="wine_color" id="wine_color">';
	if (isset($_GET['wine_color']))
	{
	   $char_term = get_term($_GET['wine_color'], 'wine_color');
       $form.= '<option value="'.$_GET['wine_color'].'">'.$char_term ->name.'</option>';
	}
	else
		$form.= '<option value=""> Выберите цвет вина</option>';
	
	
	wp_reset_query(); 
	$alltypes=get_terms('wine_color');
	if ((isset ($alltypes))&&(sizeof($alltypes)>0))
	foreach	($alltypes as $wine_color)
	{$form.='<option value="'.$wine_color->term_id.'">'.$wine_color->name.'</option>'; 
	}
	$form.='</select></div>';
	
	$form.='<div class="col-md-3"><label for="wine_sugar">Содержание сахара</label>
		                          <select name="wine_sugar" id="wine_sugar">';
	if (isset($_GET['wine_sugar']))
	{
	   $char_term = get_term($_GET['wine_sugar'], 'wine_sugar');
       $form.= '<option value="'.$_GET['wine_sugar'].'">'.$char_term ->name.'</option>';
	}
	else
		$form.= '<option value=""> Выберите сладость вина</option>';
	wp_reset_query(); 
	$alltypes=get_terms('wine_sugar');
	if ((isset ($alltypes))&&(sizeof($alltypes)>0))
	foreach	($alltypes as $wine_sugar)
	{$form.='<option value="'.$wine_sugar->term_id.'">'.$wine_sugar->name.'</option>'; 
	}
	$form.='</select></div>';
	
	$form.='<div class="col-md-3"><label for="wine_grape">Сорт винограда</label>
		                          <select name="wine_grape" id="wine_grape">';
	if (isset($_GET['wine_grape']))
	{
	   $char_term = get_term($_GET['wine_grape'], 'wine_grape');
       $form.= '<option value="'.$_GET['wine_grape'].'">'.$char_term ->name.'</option>';
	}
	else
		$form.= '<option value=""> Выберите сорт винограда</option>';
	
	
	wp_reset_query(); 
	$alltypes=get_terms('wine_grape');
	if ((isset ($alltypes))&&(sizeof($alltypes)>0))
	foreach	($alltypes as $wine_grape)
	{$form.='<option value="'.$wine_grape->term_id.'">'.$wine_grape->name.'</option>'; 
	}
	$form.='</select></div>';
	$form.='<input type="submit" id="searchsubmit" value="Искать" />
            </form>';
	return $form;
}


add_action('init','external_wine_search');
function external_wine_search()
{	
	if ((isset($_GET['wine_character']))||(isset($_GET['wine_color']))||(isset($_GET['wine_sugar']))||(isset($_GET['wine_grape'])))
	{
	 get_template_part ('search');	
	 exit;
	}
}