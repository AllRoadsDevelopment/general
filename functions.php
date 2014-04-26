<?php
/**
* @package   Master
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// load config    
require_once(dirname(__FILE__).'/config.php');

// Load Shotcodes in Text Widgets
add_filter( 'widget_text', 'do_shortcode' );

// Excerpt Length
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Excerpt String
function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Post List Featured Image
add_filter('manage_posts_columns', 'featured_image_add_column');
add_filter('manage_pages_columns', 'featured_image_add_column');

function featured_image_add_column($columns) 
{
	$columns['featured_image'] = 'Image';
	return $columns;
}

add_action('manage_posts_custom_column', 'featured_image_render_post_columns', 10, 2);

function featured_image_render_post_columns($column_name, $id) 
{
	if($column_name == 'featured_image')
	{
		$thumb = get_the_post_thumbnail( $id, array(50,50) );
		if($thumb) { echo $thumb; }
	}
}