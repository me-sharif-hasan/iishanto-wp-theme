<?php
// function to count views.
function setPostViews($postID) {
    $count_key = 'iishanto_post_views';

    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// function to display number of posts.

function getPostViews($postID){
    $count_key = 'iishanto_post_views';
    $count = get_post_meta($postID, $count_key, true);

    if($count==0||$count==''){
      $count_key = 'tie_views';
      $count = get_post_meta($postID, $count_key, true);
      setPostViews($count==''?0:$count);
    }

    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}



function iishanto_get_titles(){
  wp_title("");
  if(is_single()||is_category()) echo(" - ");
  bloginfo('title');
}


function get_logo_url(){
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	return $logo[0];
}

function get_footer_js(){
  $root = get_bloginfo( 'template_url' );
  $js="";
  $js .= '<script src="'.$root.'/common-js/jquery-3.1.1.min.js"></script>';
  //$js .= '<script src="'.$root.'/common-js/tether.min.js"></script>';
  //$js .= '<script src="'.$root.'/common-js/bootstrap.js"></script>';
  $js .= '<script src="'.$root.'/common-js/scripts.js"></script>';
  echo $js;
}

add_theme_support( 'post-thumbnails' );
function iishanto_excerpt($excerpt){
  return apply_filters( 'the_excerpt', $excerpt);
}

function render_tags($id){
  $post_tags = get_the_tags($id);
  $template=file_get_contents(__DIR__."/bona-code-snips/tag-single-post.php");
  $out='';
  if(!empty($post_tags)){
      foreach ($post_tags as $value) {
        $tg_fn=array("%tag_name%","%tag_href%","%tag_post_count%");
        $tg_rp=array($value->name,get_tag_link($value->term_id),$value->count);

        $out.=str_replace($tg_fn, $tg_rp, $template);
      }
    }
    return $out;
}

function check_have_post(&$query){
  $val=false;
  if($query==null){
    $val = have_posts();
    the_post();
  }else{
    $val = $query->have_posts();
    $query->the_post();
  }
  return $val;
}
function post_render($single=false,$query=false){

  $dual=0;

  while (check_have_post($query)) {
    //the_post();

    if($single){
      setPostViews(get_the_ID());
    }


    $post_title=the_title(false,false,false);
    $post_excerpt=iishanto_excerpt(get_the_excerpt());
    $post_category='Default';
    $post_category_slug='/';
    $count=0;

    $cat=get_the_category();
    foreach ($cat as $value) {
      $name=$value->name;
      $slug=$value->slug;
      if($value->count>$count){
        $post_category=$name;
        $post_category_slug=$slug;
        $count=$value->count;
      }
    }

    $post_url=esc_url(get_the_permalink());
    $post_views=getPostViews(get_the_ID());
    $post_comments = get_comments_number(get_the_ID());

    $post_thumb_url=get_the_post_thumbnail_url(get_the_ID(),'full');
    if($post_thumb_url==""){
      echo "<style>.post-thumb{display:none;}</style>";
    }
    $post_thumb_id=get_post_thumbnail_id(get_the_ID());
    $thumb_alt = get_post_meta($post_thumb_id, '_wp_attachment_image_alt', true);

    $post_content=apply_filters('the_content',get_the_content());

    $date = get_the_date();



    $post_tags_html=render_tags(get_the_ID());



    $replace=array($post_title,$post_url,$post_content,$post_excerpt,$post_thumb_url,$thumb_alt,$post_category,$post_category_slug,$date,$post_views,$post_comments,$post_tags_html);
    $find=array("%post_title%","%post_url%","%post_content%","%post_excerpt%","%post_thumb_url%","%thumb_alt%","%post_category%","%category_slug%","%post_date%","%post_views%","%post_comments%","%post_tags_html%");

    $template="";
    if($query!=false){
      $template=file_get_contents(__DIR__."/bona-code-snips/iishanto-suggest.php");
    }
    elseif($single){
      $template=file_get_contents(__DIR__."/bona-code-snips/single-post-model-1.php");
    }elseif($post_thumb_url&&$dual==0){
      $template=file_get_contents(__DIR__."/bona-code-snips/blog_post_thumb.php");
    }elseif($post_thumb_url==false){
      $dual++;
      $template=file_get_contents(__DIR__."/bona-code-snips/blog_post_wthout_thumb.php");
    }else{
      $dual++;
      $template=file_get_contents(__DIR__."/bona-code-snips/blog_post_thumb_half.php");     
    }

    if($dual==2){
      $dual=0;
    }

          $template=str_replace($find, $replace, $template);

      echo "$template";

  }
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
            'name' => __( 'iiShanto Right Sidebar', 'iiShanto right sidebar' ),
            'id' => 'iishanto_right_sidebar',
            'description' => __( 'Right Sidebar', 'iiShanto right sidebar' ),
            'before_widget' => '<div class="widget-area">',
            'after_widget' => "</div>",
            'before_title' => '<h4 class="title"><b>',
            'after_title' => '</b></h4><hr>'
        )
    );
}
add_action( 'widgets_init', 'right_sidebar' );

function single_post_right_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'iiShanto single post right sidebar', 'iiShanto right sidebar' ),
            'id' => 'iishanto_single_post_right_sidebar',
            'description' => __( 'Single post right Sidebar', 'iiShanto single post right sidebar' ),
            'before_widget' => '<div class="widget-area">',
            'after_widget' => "</div>",
            'before_title' => '<h4 class="title"><b>',
            'after_title' => '</b></h4><hr>'
        )
    );
}
add_action( 'widgets_init', 'single_post_right_sidebar' );

function footer_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'iiShanto footer sidebar', 'iiShanto footer sidebar' ),
            'id' => 'iishanto_footer_sidebar',
            'description' => __( 'Footer Sidebar', 'iiShanto footer sidebar' ),
            'before_widget' => '<div class="col-lg-4 col-md-6"><div class="footer-section">',
            'after_widget' => "</div></div>",
            'before_title' => '<h4 class="title"><b>',
            'after_title' => '</b></h4>'
        )
    );
}

add_action( 'widgets_init', 'single_post_right_sidebar' );
add_action( 'widgets_init', 'footer_sidebar' );

function get_dynamic_sidebar($id=  'iishanto_right_sidebar' ){
  if ( is_active_sidebar($id) ){
    dynamic_sidebar( $id );
  }
}

function add_styles($link,$name='iishanto_page_css'){
  wp_enqueue_style($name,$link);
}

add_theme_support("html5");



function iishanto_number_pagination() {
 
global $wp_query;
$big = 9999999; // need an unlikely integer
  echo paginate_links( array(
   'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
   'format' => '?paged=%#%',
   'current' => max( 1, get_query_var('paged') ),
   'total' => $wp_query->max_num_pages
    )
);

}



function mo_comment_fields_custom_order( $fields ) {
    $comment_field = $fields['comment'];
    $author_field = $fields['author'];
    $email_field = $fields['email'];
    //$url_field = $fields['url'];
    $cookies_field = $fields['cookies'];
    unset( $fields['comment'] );
    unset( $fields['author'] );
    unset( $fields['email'] );
    //unset( $fields['url'] );
    unset( $fields['cookies'] );
    // the order of fields is the order below, change it as needed:
    $fields['author'] = $author_field;
    $fields['email'] = $email_field;
    //$fields['url'] = $url_field;
    $fields['comment'] = $comment_field;
    $fields['cookies'] = $cookies_field;
    // done ordering, now return the fields:
    return $fields;
}

add_filter( 'comment_form_fields', 'mo_comment_fields_custom_order' );

add_action( 'comment_form_top', function(){
     // Adjust this to your needs:
     echo '<div class="row">'; 
});

add_action( 'comment_form_bottom', function(){
     // Adjust this to your needs:
     echo '</div>'; 
});



function smk_get_comment_time( $comment_id = 0 ){
    return sprintf( 
        _x( '%s ago', 'Human-readable time', 'text-domain' ), 
        human_time_diff( 
            get_comment_date( 'U', $comment_id ), 
            current_time( 'timestamp' ) 
        ) 
    );
}