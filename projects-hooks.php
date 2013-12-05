<?php
/**
 * WooThemes Projects Hooks
 *
 * Action/filter hooks used for WooThemes Projects functions/templates
 *
 * @author 		WooThemes
 * @category 	Core
 * @package 	Projects/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/** Template Hooks ********************************************************/

if ( ! is_admin() || defined('DOING_AJAX') ) {

	add_filter( 'body_class', 'woo_projects_body_class' );
	add_action( 'wp_enqueue_scripts', 'projects_script' );
	add_action( 'template_redirect', 'projects_template_redirect' );
	add_filter( 'wp_nav_menu_objects',  'projects_nav_menu_item_classes', 2, 20 );

	/**
	 * Content Wrappers
	 *
	 * @see projects_output_content_wrapper()
	 * @see projects_output_content_wrapper_end()
	 */
	add_action( 'projects_before_main_content', 'projects_output_content_wrapper', 10 );
	add_action( 'projects_after_main_content', 'projects_output_content_wrapper_end', 10 );

	/**
	 * Sidebar
	 *
	 * @see projects_get_sidebar()
	 */
	add_action( 'projects_sidebar', 'projects_get_sidebar', 10 );

	/**
	 * Archive descriptions
	 *
	 * @see projects_taxonomy_archive_description()
	 * @see projects_project_archive_description()
	 */
	add_action( 'projects_archive_description', 'projects_taxonomy_archive_description', 10 );
	add_action( 'projects_archive_description', 'projects_project_archive_description', 10 );

	/**
	 * Project Loop Items
	 *
	 * @see projects_template_loop_project_thumbnail()
	 * @see projects_template_short_description()
	 */
	add_action( 'projects_before_showcase_loop_item_title', 'projects_template_loop_project_thumbnail', 10 );
	add_action( 'projects_after_showcase_loop_item', 'projects_template_short_description', 10 );

	/**
	 * Before Single Projects Summary Div
	 *
	 * @see projects_show_project_images()
	 * @see projects_show_project_thumbnails()
	 */
	add_action( 'projects_before_single_project_summary', 'projects_show_project_images', 20 );
	add_action( 'projects_project_thumbnails', 'projects_show_project_thumbnails', 20 );

	/**
	 * Project Summary Box
	 *
	 * @see projects_template_single_title()
	 * @see projects_template_single_description()
	 * @see projects_template_single_meta()
	 */
	add_action( 'projects_single_project_summary', 'projects_template_single_title', 10 );
	add_action( 'projects_single_project_summary', 'projects_template_single_description', 20 );
	add_action( 'projects_single_project_summary', 'projects_template_single_meta', 40 );

	/**
	 * After Single Project
	 *
	 * @see projects_single_pagination()
	 */
	add_action( 'projects_after_single_project', 'projects_single_pagination', 5 );

	/**
	 * Pagination after showcase loops
	 *
	 * @see projects_pagination()
	 */
	add_action( 'projects_after_showcase_loop', 'projects_pagination', 10 );
}

/** Store Event Hooks *****************************************************/

/**
 * Filters
 */
add_filter( 'projects_short_description', 'wptexturize'        );
add_filter( 'projects_short_description', 'convert_smilies'    );
add_filter( 'projects_short_description', 'convert_chars'      );
add_filter( 'projects_short_description', 'wpautop'            );
add_filter( 'projects_short_description', 'shortcode_unautop'  );
add_filter( 'projects_short_description', 'prepend_attachment' );
add_filter( 'projects_short_description', 'do_shortcode', 11 ); // AFTER wpautop()