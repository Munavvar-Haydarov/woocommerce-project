<?php
/**
 * Projects_Shortcodes class.
 *
 * @class 		Projects_Shortcodes
 * @version		1.0.0
 * @package 	WordPress
 * @subpackage 	Projects/Classes
 * @category	Class
 * @author 		WooThemes
 */
class Projects_Shortcodes {

	public function __construct() {
		// Regular shortcodes
		add_shortcode( 'projects_recent_projects', array( $this, 'projects_recent_projects' ) );
		add_shortcode( 'projects_categories', array( $this, 'projects_categories_shortcode' ) );
	}

	/**
	 * Shortcode Wrapper
	 *
	 * @param mixed $function
	 * @param array $atts (default: array())
	 * @return string
	 */
	public static function shortcode_wrapper(
		$function,
		$atts = array(),
		$wrapper = array(
			'class' 	=> 'projects',
			'before' 	=> null,
			'after' 	=> null
		)
	){
		ob_start();

		$before 		= empty( $wrapper['before'] ) ? '<div class="' . $wrapper['class'] . '">' : $wrapper['before'];
		$after 			= empty( $wrapper['after'] ) ? '</div>' : $wrapper['after'];

		echo $before;
		call_user_func( $function, $atts );
		echo $after;

		return ob_get_clean();
	}

	/**
	 * Recent Products shortcode
	 *
	 * @access public
	 * @param array $atts
	 * @return string
	 */
	public function projects_recent_projects( $atts ) {

		global $projects_loop;

		extract( shortcode_atts( array(
			'per_page' 				=> '12',
			'columns' 				=> '2',
			'orderby' 				=> 'date',
			'order' 				=> 'desc'
		), $atts ) );

		$args = array(
			'post_type'				=> 'project',
			'post_status' 			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' 		=> $per_page,
			'orderby' 				=> $orderby,
			'order' 				=> $order
		);

		ob_start();

		$projects = new WP_Query( apply_filters( 'projects_query', $args, $atts ) );

		$projects_loop['columns'] = $columns;

		if ( $projects->have_posts() ) : ?>

			<?php projects_project_loop_start(); ?>

				<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>

					<?php projects_get_template_part( 'content', 'project' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php projects_project_loop_end(); ?>

		<?php endif;

		wp_reset_postdata();

		return '<div class="projects columns-' . $columns . '">' . ob_get_clean() . '</div>';

	}

	public function projects_categories_shortcode() {

		ob_start();

		projects_template_categories();

		return '<div class="projects">' . ob_get_clean() . '</div>';

	}

}


new Projects_Shortcodes();