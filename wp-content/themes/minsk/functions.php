<?php
function disable_embeds_init() {

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}

add_action('init', 'disable_embeds_init', 9999);


function filter_plugin_updates( $update ) {    
global $DISABLE_UPDATE; // см. wp-config.php
if( !is_array($DISABLE_UPDATE) || count($DISABLE_UPDATE) == 0 ){  return $update;  }
foreach( $update->response as $name => $val ){
foreach( $DISABLE_UPDATE as $plugin ){
if( stripos($name,$plugin) !== false ){
unset( $update->response[ $name ] );
}
}
}
return $update;
}
add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );

function register_styles() {
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
	wp_enqueue_style( 'bootstrap');
	wp_register_style( 'comments', get_template_directory_uri() . '/css/comments.css');
    wp_enqueue_style( 'comments');
    wp_register_style( 'select', get_template_directory_uri() . '/css/bootstrap-select.min.css');
    wp_enqueue_style( 'select');
    wp_register_style( 'icomoon', get_template_directory_uri() . '/css/icomoon.css');
    wp_enqueue_style( 'icomoon');
     wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css');
    wp_enqueue_style( 'font-awesome');
    wp_register_style( 'style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style( 'style');
	
}

//Load the theme JS
function load_my_script(){ 
	wp_deregister_script( 'jquery');
	wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js');
	wp_register_script( 'main.js', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true );
    wp_enqueue_script( 'main.js');
    wp_register_script( 'js/bootstrap.min.js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'js/bootstrap.min.js');
    wp_register_script( 'bootstrap-select.min.js', get_template_directory_uri() . '/js/bootstrap-select.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'bootstrap-select.min.js');
}

add_action( 'wp_enqueue_scripts', 'register_styles' ); 
add_action( 'wp_enqueue_scripts', 'load_my_script' );

function wpb_widgets_init() {
 
    register_sidebar( array(
        'name' => __( 'Search sidebar', 'wpb' ),
        'id' => 'sidebar-1',
        'description' => __( 'The main sidebar appears on the right on each page except the front page template', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
 
    register_sidebar( array(
        'name' =>__( 'Main sidebar', 'wpb'),
        'id' => 'sidebar-2',
        'description' => __( 'Appears on the static front page template', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    }
 
add_action( 'widgets_init', 'wpb_widgets_init' );

require_once get_template_directory() . '/partials/wp-bootstrap-navwalker.php';


register_nav_menu('menu', 'Main menu');
register_nav_menu('footer', 'Footer menu');
register_nav_menu('top', 'Top main menu');
register_nav_menu('bottom', 'Bottom footer menu');

add_theme_support('post-thumbnails');


add_filter('wp_list_categories', 'add_slug_class_wp_list_categories');
function add_slug_class_wp_list_categories($list) {

    $cats = get_categories('hide_empty=0');
    foreach($cats as $cat) {
        $find = 'cat-item-' . $cat->term_id . '"';
        $replace = 'cat-item-' . $cat->slug . ' cat-item-' . $cat->term_id . '"';
        $list = str_replace( $find, $replace, $list );
        $find = 'cat-item-' . $cat->term_id . ' ';
        $replace = 'cat-item-' . $cat->slug . ' cat-item-' . $cat->term_id . ' ';
        $list = str_replace( $find, $replace, $list );
    }

    return $list;
}

function pagination($pages = '', $range = 1)
{  
     $showitems = ($range * 1)+0;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span> ".$paged."</span> <span>of</span> <span>".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 //echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

$image_sizes = apply_filters('minsk_image_sizes', array(

            
            'post-block' => array('width' => 430, 'height' => 300),   
            // Images for the featured block
            'grid-slider-b-large' => array('width' => 760, 'height' => 495),
            'grid-slider-b-med' => array('width' => 480, 'height' => 240),
        ));
        
        foreach ($image_sizes as $key => $size) {
            
            // set default crop to true
            $size['crop'] = (!isset($size['crop']) ? true : $size['crop']);
            
            if ($key == 'post-thumbnail') {
                set_post_thumbnail_size($size['width'], $size['height'], $size['crop']);
            }
            else {
                add_image_size($key, $size['width'], $size['height'], $size['crop']);
            }
            
        } 

function bootstrap_clearfix( $i, $args = array(), $element = 'div',  $grid = 12 ) {
    $performFor = array();
    $clearfix   = '';

    if ( isset( $args['xs'] ) && is_int( $args['xs'] ) ) {
        $performFor[] = 'xs';
    }
    if ( isset( $args['sm'] ) && is_int( $args['sm'] ) ) {
        $performFor[] = 'sm';
    }
    if ( isset( $args['md'] ) && is_int( $args['md'] ) ) {
        $performFor[] = 'md';
    }
    if ( isset( $args['lg'] ) && is_int( $args['lg'] ) ) {
        $performFor[] = 'lg';
    }

    foreach ( $performFor as $v ) {
        $modulus = $grid / $args[ $v ];
        $clearfix .= ( $i > 0 && $i % $modulus == 0 ? ' <'.$element.' class="clearfix visible-' . $v . '"></'.$element.'>' : '' );
    }

    return $clearfix;
}

function add_responsive_class($content){

        $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
        $document = new DOMDocument();
        libxml_use_internal_errors(true);
        $document->loadHTML(utf8_decode($content));

        $imgs = $document->getElementsByTagName('img');
        foreach ($imgs as $img) {           
           $img->setAttribute('class','img-responsive');
        }

        $html = $document->saveHTML();
        return $html;   
}