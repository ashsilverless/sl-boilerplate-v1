<?php
/**
 * sl-boilerplate-v1 functions and definitions
 *
 * @package sl-boilerplate-v1
 */

/****************************************************/
/*                       Hooks                       /
/****************************************************/

/* Enqueue scripts and styles */
add_action('wp_enqueue_scripts', 'sl-boilerplate-v1_scripts');

/* Add Menus */
add_action('init', 'sl-boilerplate-v1_custom_menu');

/* Dashboard Config */
add_action('wp_dashboard_setup', 'sl-boilerplate-v1_dashboard_widget');

/* Dashboard Style */
add_action('admin_head', 'sl-boilerplate-v1_custom_fonts');

/* Remove Default Menu Items */
add_action('admin_menu', 'sl-boilerplate-v1_remove_menus');

/* Change Posts Columns */
add_filter('manage_posts_columns', 'sl-boilerplate-v1_manage_columns');

/* Reorder Admin Menu */
add_filter('custom_menu_order', 'sl-boilerplate-v1_reorder_menu');
add_filter('menu_order', 'sl-boilerplate-v1_reorder_menu');

/* Remove Comments Link */
add_action('wp_before_admin_bar_render', 'sl-boilerplate-v1_manage_admin_bar');


/****************************************************/
/*                     Functions                     /
/****************************************************/

function sl-boilerplate-v1_scripts() {
	wp_enqueue_style( 'sl-boilerplate-v1-style', get_stylesheet_uri() );
	wp_enqueue_script( 'sl-boilerplate-v1-core-js', get_template_directory_uri() . '/inc/js/compiled.js', array('jquery'), true);
}

function sl-boilerplate-v1_custom_menu() {
	register_nav_menus(array(
		'main-menu' => __( 'Main Menu' )
	));

	register_nav_menus(array(
		'secondary-menu' => __( 'Secondary Menu' )
	));
}

function sl-boilerplate-v1_dashboard_widget() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'sl-boilerplate-v1 Support', 'sl-boilerplate-v1_dashboard_help');
}

function sl-boilerplate-v1_dashboard_help() {
	echo file_get_contents(__DIR__ . "/admin-settings/dashboard.html");
}

function sl-boilerplate-v1_custom_fonts() {
	echo '<style type="text/css">' . file_get_contents(__DIR__ . "/admin-settings/style-admin.css") . '</style>';
}

if(function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'site-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

function sl-boilerplate-v1_remove_menus(){
	remove_menu_page( 'edit-comments.php' ); //Comments
}

function sl-boilerplate-v1_manage_columns($columns) {
	unset($columns["comments"]);
	return $columns;
}

function sl-boilerplate-v1_reorder_menu() {
    return array(
		'index.php',                        // Dashboard
		'separator1',                       // --Space--
		'edit.php',                         // Posts
		'edit.php?post_type=page',          // Pages
		'upload.php',                       // Media
		'separator2',                       // --Space--
		'themes.php',                       // Appearance
		'plugins.php',                      // Plugins
		'users.php',                        // Users
		'tools.php',                        // Tools
		'options-general.php',              // Settings
		'wpcf7',                            // Contact Form 7
   );
}

function sl-boilerplate-v1_manage_admin_bar(){
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
}

/* ADD CUSTOM RESPONSIVE IMAGE SIZES
================================================== */

function aw_custom_responsive_image_sizes($sizes, $size) {
  $width = $size[0];
  // blog posts
  if ( is_singular( 'post' ) ) {
    // half width images - medium size
    if ( $width === 600 ) {
      return '(min-width: 768px) 322px, (min-width: 576px) 255px, calc( (100vw - 30px) / 2)';
    }
    // full width images - large size
    if ( $width === 1024 ) {
      return '(min-width: 768px) 642px, (min-width: 576px) 510px, calc(100vw - 30px)';
    }
    // default to return if condition is not met
    return '(max-width: ' . $width . 'px) 100vw, ' . $width . 'px';
  }
  // default to return if condition is not met
  return '(max-width: ' . $width . 'px) 100vw, ' . $width . 'px';
}
add_filter('wp_calculate_image_sizes', 'aw_custom_responsive_image_sizes', 10 , 2);

 function manage_my_category_columns($columns)
{
 // only edit the columns on the current taxonomy
 if ( !isset($_GET['taxonomy']) || $_GET['taxonomy'] != 'category' )
 return $columns;

 // unset the description columns
 if ( $posts = $columns['description'] ){ unset($columns['description']); }

 return $columns;
}
add_filter('manage_edit-category_columns','manage_my_category_columns');
