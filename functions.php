<?php
function add_styles(){

}

function get_dposts($snip){
	//while(have_posts)
}

function get_logo_url(){
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	return $logo[0];
}

add_theme_support( 'custom-logo' );
function themename_custom_logo_setup() {
 $defaults = array(
 'flex-height' => true,
 'flex-width'  => true,
 'header-text' => array( 'site-title', 'site-description' ),
'unlink-homepage-logo' => true
 );
}
add_action( 'init', 'themename_custom_logo_setup' );

function iishanto_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'iiShanto Header Menu' ),
      'footer-menu' => __( 'iiShanto Footer Menu' ),
      'sidebar-menu' => __('iiShanto Sidebar Menu')
    ) 
  );
}
add_action( 'init', 'iishanto_menus' );


function right_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Right Sidebar', 'iiShanto right sidebar' ),
            'id' => 'right_sidebar',
            'description' => __( 'Right Sidebar', 'iiShanto right sidebar' ),
            'before_widget' => '<div class="single-post info-area">',
            'after_widget' => "</div>",
            'before_title' => '<h4 class="title"><b>',
            'after_title' => '</b></h4>'
        )
    );
}
add_action( 'widgets_init', 'right_sidebar' );