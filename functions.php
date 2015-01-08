<?php
/*
Author: DiddyDoIt, Zhen Huang
URL: http://diddydoit.com/

This place is much cleaner. Put your theme specific codes here,
anything else you may wan to use plugins to keep things tidy.

*/

/*
1. lib/clean.php
    - head cleanup
    - post and images related cleaning
*/
require_once('lib/clean.php'); // do all the cleaning and enqueue here
/*
2. lib/enqueue-sass.php or enqueue-css.php
    - enqueueing scripts & styles for Sass OR CSS
    - please use either Sass OR CSS, having two enabled will ruin your weekend
*/
//require_once('lib/enqueue-sass.php'); // do all the cleaning and enqueue if you Sass to customize DiddyDoIt
require_once('lib/enqueue-css.php'); // to use CSS for customization, uncomment this line and comment the above Sass line
/*
3. lib/foundation.php
    - add pagination
    - custom walker for top-bar and related
*/
require_once('lib/foundation.php'); // load Foundation specific functions like top-bar
/*
4. lib/presstrends.php
    - add PressTrends, tracks how many people are using DiddyDoIt
*/
require_once('lib/presstrends.php'); // load PressTrends to track the usage of DiddyDoIt across the web, comment this line if you don't want to be tracked

/**********************
Add theme supports
**********************/
function DiddyDoIt_theme_support() {
    // Add language supports.
    load_theme_textdomain('DiddyDoIt', get_template_directory() . '/lang');
    
    // Add post thumbnail supports. http://codex.wordpress.org/Post_Thumbnails
    add_theme_support('post-thumbnails');
    // set_post_thumbnail_size(150, 150, false);
    
    // rss thingy
    add_theme_support('automatic-feed-links');
    
    // Add post formarts supports. http://codex.wordpress.org/Post_Formats
    add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
    
    // Add menu supports. http://codex.wordpress.org/Function_Reference/register_nav_menus
    add_theme_support('menus');
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'DiddyDoIt'),
        'utility' => __('Utility Navigation', 'DiddyDoIt')
    ));
    
    // Add custom background support
    add_theme_support( 'custom-background',
        array(
        'default-image' => '',  // background image default
        'default-color' => '', // background color default (dont add the #)
        'wp-head-callback' => '_custom_background_cb',
        'admin-head-callback' => '',
        'admin-preview-callback' => ''
        )
    );
}
add_action('after_setup_theme', 'DiddyDoIt_theme_support'); /* end DiddyDoIt theme support */

// create widget areas: sidebar, footer
$sidebars = array('Sidebar');
foreach ($sidebars as $sidebar) {
    register_sidebar(array('name'=> $sidebar,
        'before_widget' => '<article id="%1$s" class="row widget %2$s"><div class="small-12 columns">',
        'after_widget' => '</div></article>',
        'before_title' => '<h6><strong>',
        'after_title' => '</strong></h6>'
    ));
}
$sidebars = array('Footer');
foreach ($sidebars as $sidebar) {
    register_sidebar(array('name'=> $sidebar,
        'before_widget' => '<article id="%1$s" class="large-4 columns widget %2$s">',
        'after_widget' => '</article>',
        'before_title' => '<h6><strong>',
        'after_title' => '</strong></h6>'
    ));
}

/**********************
Add CUSTOM ROIs type
**********************/
function codex_custom_ROIs_init() {
  $labels = array(
    'name' => 'Proposals',
    'singular_name' => 'Proposal',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Proposal',
    'edit_item' => 'Edit Proposal',
    'new_item' => 'New Proposal',
    'all_items' => 'All Proposals',
    'view_item' => 'View Proposals',
    'search_items' => 'Search Proposals',
    'not_found' =>  'No Proposals found',
    'not_found_in_trash' => 'No Proposals found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Proposals'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'taxonomies' => array ('category'),
    'rewrite' => array( 'slug' => 'proposal' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 2, 
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' )
  ); 

  register_post_type( 'ROI', $args );
}
add_action( 'init', 'codex_custom_rois_init' );

/**********************
Add CUSTOM products type
**********************/
function codex_custom_products_init() {
  $labels = array(
    'name' => 'Proposed Fixturess',
    'singular_name' => 'Proposed Fixture',
    'add_new' => 'New Fixture',
    'add_new_item' => 'Add New Proposed Fixtures',
    'edit_item' => 'Edit Proposed Fixtures',
    'new_item' => 'New Proposed Fixtures',
    'all_items' => 'All Proposed Fixtures',
    'view_item' => 'View Proposed Fixtures',
    'search_items' => 'Search Proposed Fixtures',
    'not_found' =>  'No Proposed Fixturess found',
    'not_found_in_trash' => 'No Proposed Fixturess found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Proposed Fixturess'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'taxonomies' => array ('category'),
    'rewrite' => array('with_front' => false, 'fixtures'),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 2, 
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' )
  ); 

  register_post_type( 'product', $args );
}
add_action( 'init', 'codex_custom_products_init' );



//Custome Post Types  & Tax on o meee   --------------------------------------------------------/////////
/**********************
Add CUSTOM Existing Fixtures type
**********************/
function codex_custom_existing_init() {
  $labels = array(
    'name' => '',
    'singular_name' => 'Existing Fixture',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Existing Fixture',
    'edit_item' => 'Edit Existing Fixture',
    'new_item' => 'New Existing Fixture',
    'all_items' => 'All Existing Fixtures',
    'view_item' => 'View Existing Fixture',
    'search_items' => 'Search Existing Fixtures',
    'not_found' =>  'No Existing Fixtures found',
    'not_found_in_trash' => 'No Existing Fixtures found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Existing Fixtures'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'taxonomies' => array ('types'),
    'rewrite' => array( 'slug' => 'existing' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 2, 
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' )
  ); 

  register_post_type( 'existing', $args );
}
add_action( 'init', 'codex_custom_existing_init' );

/**********************
Add Tax for custom post size Taxonmy
**********************/
//hook into the init action and call create_product_taxonomies when it fires
add_action( 'init', 'create_existing_taxonomies', 0 );

//create two taxonomies, genres and Manufacturers for the post size "product"
function create_existing_taxonomies() 
{
// Add Product type taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'                => _x( 'Type', 'taxonomy general name' ),
    'singular_name'       => _x( 'Type', 'taxonomy singular name' ),
    'search_items'        => __( 'Search Types' ),
    'all_items'           => __( 'All Types' ),
    'parent_item'         => __( 'Parent Type' ),
    'parent_item_colon'   => __( 'Parent Type:' ),
    'edit_item'           => __( 'Edit Type' ), 
    'update_item'         => __( 'Update Type' ),
    'add_new_item'        => __( 'Add New Type' ),
    'new_item_name'       => __( 'New Type Name' ),
    'menu_name'           => __( 'Type' )
  );    

  $args = array(
    'hierarchical'        => true,
    'labels'              => $labels,
    'show_ui'             => true,
    'show_admin_column'   => true,
    'query_var'           => true,
    'rewrite'             => array('with_front' => false, 'slug' => 'existing/sizes' )
  ); 
  register_taxonomy( 'type', array( 'existing' ), $args );
} 
/// END CUSTOM POST/TAX TYPES


/**********************
Add payments type
**********************/
function codex_custom_payments_init() { 
  $labels = array(
    'name' => 'Payment Options',
    'singular_name' => 'Payment Option',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Payment',
    'edit_item' => 'Edit Payment Options',
    'new_item' => 'New Payment Options',
    'all_items' => 'All Payment Options',
    'view_item' => 'View Payment Options',
    'search_items' => 'Search Payment Options',
    'not_found' =>  'No Payment Options found',
    'not_found_in_trash' => 'No Payment Options found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Payments'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'taxonomies' => array ('category'),
    'rewrite' => array('with_front' => false, 'showcase'),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 2, 
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' )
  ); 

  register_post_type( 'payment', $args );
}
add_action( 'init', 'codex_custom_payments_init' );





//--------------------------------------------------------------------------------------
//        CUSTOM STATUS/PDF FUNCTIONS         ------------------------------------------
//--------------------------------------------------------------------------------------


//Unapproved post status sort w/count at top
function dblr_review_post_status(){
     register_post_status( 'pending', array(
          'label'                     => _x( 'Unapproved', 'post' ),
          'public'                    => true,
          'show_in_admin_all_list'    => true,
          'show_in_admin_status_list' => true,
          'label_count'               => _n_noop( 'Unapproved <span class="count">(%s)</span>', 'Unapproved <span class="count">(%s)</span>' )
     ) );
}
add_action( 'init', 'dblr_review_post_status' );

//Approved post status sort w/count at top
function dblr_published_post_status(){
     register_post_status( 'publish', array(
          'label'                     => _x( 'Approved', 'post' ),
          'public'                    => true,
          'show_in_admin_all_list'    => true,
          'show_in_admin_status_list' => true,
          'label_count'               => _n_noop( 'Approved <span class="count">(%s)</span>', 'Approved <span class="count">(%s)</span>' )
     ) );
}
add_action( 'init', 'dblr_published_post_status' );

function dblr_draft_post_status(){
     register_post_status( 'draft', array(
          'label'                     => _x( 'Saved/Editing', 'post' ),
          'public'                    => true,
          'show_in_admin_all_list'    => true,
          'show_in_admin_status_list' => true,
          'label_count'               => _n_noop( 'Saved/Editing <span class="count">(%s)</span>', 'Saved/Editing <span class="count">(%s)</span>' )
     ) );
}
add_action( 'init', 'dblr_draft_post_status' );

//Post Status & PDF Links Next to Post Title
function dblr_display_unapproved_state( $states ) {
     global $post;
     $arg = get_query_var( 'post_status' );
          $derp = $post->ID;
           $title = get_the_title($derp);
          if($post->post_status == 'pending'){
                return array('Unapproved - <a href="http://lampinator.com/roi/create/?id=' . $derp . '&title=' . $title . '" target="_blank">View PDF</a>');
          } elseif($post->post_status == 'publish') {
                return array('Approved - <a href="http://lampinator.com/roi/create/?id=' . $derp . '&title=' . $title . '"  target="_blank">View PDF</a>');
          } elseif($post->post_status == 'draft') {
                return array('Saved/Editing');
          }

    return $states;
}
add_filter( 'display_post_states', 'dblr_display_unapproved_state' );



//Proposal Location on Proposal Page VIEW PDF
add_action('admin_footer-post.php', 'dblr_location_lock');
function dblr_location_lock(){
          global $post;
               $label_location = '<span>Proposal Location</span>';
               $derp = $post->ID;
               $title = get_the_title($derp);
              if($post->post_status != 'draft') {
                $PDFView = "<div id='visibility' class='misc-pub-section misc-pub-visibility'><span>PDF: <strong>View</strong>  <a href='http://lampinator.com/roi/create/?id=" . $derp . "&title=" . $title . "' target='_blank'>Click Here</a></span></div>";
              } else {
                $PDFView = "<div id='visibility' class='misc-pub-section misc-pub-visibility'><span>PDF: <strong>Submit For Review to View PDF</strong></span></div>";
              }
               
          echo '
          <script>
          jQuery(document).ready(function($){
               $("#author_cat h3.hndle span").replaceWith("'.$label_location.'");
               $("div#misc-publishing-actions").prepend("'.$PDFView.'");
          });
          </script>
          ';
     
}



//Custom Login CSS
function my_login_stylesheet() { 
  echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/admin.css" type="text/css" media="all" />';
 }
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );




// return entry meta information for posts, used by multiple loops.
function DiddyDoIt_entry_meta() {
    echo '<time class="updated" datetime="'. get_the_time('c') .'" pubdate>'. sprintf(__('Posted on %s at %s.', 'DiddyDoIt'), get_the_time('l, F jS, Y'), get_the_time()) .'</time>';
    echo '<p class="byline author">'. __('Written by', 'DiddyDoIt') .' <a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author" class="fn">'. get_the_author() .'</a></p>';
}
?>