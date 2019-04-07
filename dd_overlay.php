<?php
/**
 * Plugin Name: dd_overlay
 * Plugin URI: https://github.com/acdeimund/dd_overlay
 * Description: A WordPress plug-in for adding an overlay picture to the home page.
 * Version: 1.0
 * Author: Aaron Deimund
 * Author URI: https://www.deimunddesigns.net
 */

function overlay_post_type() {
    $labels = array(
        "name" => "Overlay",
        "singular_name" => "Overlay",
        "add_new" => "Add Overlay",
        "all_items" => "All Overlays",
        "add_new_item" => "Add Overlay",
        "edit_item" => "Edit Overlay",
        "new_item" => "New Overlay",
        "view_item" => "View Overlay",
        "search_item" => "Search Overlays",
        "not_found" => "Sorry, nothing found",
        "not_found_in_trash" => "Sorry, nothing found in trash",
        "parent_item_colon" => "Parent Section"
    );
    $support = array(
        "title",
        "editor",
        "revisions",
        "thumbnail"
    );
    $args = array(
        "labels" => $labels,
        "public" => true,
        "has_archive" => false,
        "publicly_queryable" => true,
        "query_var" => true,
        "rewrite" => true,
        "capability_type" => "post",
        "hierarchical" => false,
        "supports" => $support,
        "exclude_from_search" => false,
        "menu_icon" => "dashicons-format-gallery"
    );
    register_post_type("overlay", $args);
}

add_action("init", "overlay_post_type");

// Add style and scripts for the plug-in
function dd_overlay_scripts() {

  // // Plug-in stylesheet
  wp_enqueue_style( 'dd_overlay_style', plugins_url( '/style.css', __FILE__ ) );

  // // Plug-in scripts
  wp_enqueue_script( 'dd_overlay_scripts', plugins_url( '/scripts.js', __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'dd_overlay_scripts' );

function dd_add_overlay(){
  global $post;

  $args = array( "posts_per_page" => 1,"post_type" => "overlay" );
  $overlay = get_posts( $args );
  foreach ( $overlay as $post ) : setup_postdata( $post ); ?>
    <img class = "dd_overlay <?php the_title(); ?>" src = "<?php the_post_thumbnail_url(); ?>);">
  <?php endforeach; 
  wp_reset_postdata();
}