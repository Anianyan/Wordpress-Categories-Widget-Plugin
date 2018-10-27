<?php
/**
 * Plugin Name: List Categories Widget
 * Description: Task From NovemBit
 * Author: Ani Voskanyan
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//Include APP_HOSP_PLUGIN_FILE.
if ( ! defined( 'LIST_CATEGORIES_WIDGET_PLUGIN_FILE' ) ) {
	define( 'LIST_CATEGORIES_WIDGET_PLUGIN_FILE', __FILE__ );
}

//Include the Widget class.
require plugin_dir_path( __FILE__ ) . 'class-list-categories-widget.php';
require plugin_dir_path( __FILE__ ) . 'helper.php';

//register List Categories Widget
add_action( 'widgets_init', 'register_list_categories_widget' );

function register_list_categories_widget() {
	register_widget( 'List_Categories_Widget' );
}


add_action( 'wp_enqueue_scripts', 'list_categories_widget_scripts' );

function list_categories_widget_scripts() {
	wp_enqueue_script( 'jquery', 'http://code.jquery.com/jquery-3.3.1.min.js' );
	wp_enqueue_script( 'widget-script', plugins_url( '\assets\widget-script.js', __FILE__ )  );
	wp_localize_script( 'widget-script', 'ajax_url', array(
		'url' => admin_url( 'admin-ajax.php' ),
	));
	wp_enqueue_style( 'widget-style', plugins_url( '\assets\widget-style.css', __FILE__ ) );

}

add_action( 'wp_ajax_get_cat_posts', 'list_categories_widget_get_posts' );
add_action( 'wp_ajax_nopriv_get_cat_posts', 'list_categories_widget_get_posts' );




