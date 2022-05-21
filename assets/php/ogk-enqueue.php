<?php
/**
* ENQUEUE STYLES
*/

function theme_enqueue_styles() {

$dist = get_template_directory_uri().'/dist';

wp_enqueue_style( 'main', $dist.'/assets/sass/style.css', '', (WP_DEBUG == TRUE)? time(): '' ); // main stylesheet
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/* ================================================================= */

/**
* ENQUEUE SCRIPTS
*/
function theme_enqueue_scripts() {

$dist = get_template_directory_uri().'/dist';
$assets = get_template_directory_uri() . '/assets';

wp_deregister_script('jquery');
wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', null, null, false);
wp_enqueue_script('jquery');

wp_register_script('scripts', $dist . '/assets/js/scripts-min.js', '', (WP_DEBUG == TRUE) ? time() : '', true);
wp_enqueue_script('scripts'); // main scripts file
}

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts', 0);