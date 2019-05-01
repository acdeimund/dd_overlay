<?php
/**
 * Plugin Name: dd_secondary_logo
 * Plugin URI: https://github.com/acdeimund/dd_secondary_logo
 * Description: A WordPress plug-in for adding a secondary logo.
 * Version: 1.0
 * Author: Aaron Deimund
 * Author URI: https://www.deimunddesigns.net
 */

function secondary_logo_post_type() {
    $labels = array(
        "name" => "Secondary Logo",
        "singular_name" => "Secondary Logo",
        "add_new" => "Add Secondary Logo",
        "all_items" => "All Secondary Logos",
        "add_new_item" => "Add Secondary Logo",
        "edit_item" => "Edit Secondary Logo",
        "new_item" => "New Secondary Logo",
        "view_item" => "View Secondary Logo",
        "search_item" => "Search Secondary Logos",
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
    register_post_type("secondary_logo", $args);
}

add_action("init", "secondary_logo_post_type");

// Add style and scripts for the plug-in
function dd_secondary_logo_scripts() {

  // // Plug-in stylesheet
  wp_enqueue_style( 'dd_secondary_logo_style', plugins_url( '/style.css', __FILE__ ) );

  // // Plug-in scripts
  wp_enqueue_script( 'dd_secondary_logo_scripts', plugins_url( '/scripts.js', __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'dd_secondary_logo_scripts' );

function dd_add_secondary_logo(){
  global $post;

  $args = array( "posts_per_page" => 1,"post_type" => "secondary_logo" );
  $secondary_logo = get_posts( $args );
  foreach ( $secondary_logo as $post ) : setup_postdata( $post ); ?>
    <a href="<?php echo get_site_url(); ?>">
      <img class = "dd_secondary_logo <?php the_title(); ?>" src = "<?php the_post_thumbnail_url(); ?>);">
    </a>
  <?php endforeach; 
  wp_reset_postdata();
}