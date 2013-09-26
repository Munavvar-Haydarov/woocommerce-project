<?php
/**
 * Woothemes_Projects_Shortcodes class.
 *
 * @class 		Woothemes_Projects_Shortcodes
 * @version		1.0.0
 * @package 	WordPress
 * @subpackage 	Woothemes_Projects/Classes
 * @category	Class
 * @author 		WooThemes
 */
class Woothemes_Projects_Shortcodes {

	public function __construct() {
		// Regular shortcodes
		add_shortcode( 'woothemes_recent_projects', array( $this, 'woothemes_recent_projects' ) );
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
			'class' 	=> 'woothemes-projects',
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
	public function woothemes_recent_projects( $atts ) {

		global $woothemes_projects_loop;

		extract( shortcode_atts( array(
			'per_page' 				=> '12',
			'columns' 				=> '4',
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

		$projects = new WP_Query( apply_filters( 'woothemes_projects_query', $args, $atts ) );

		$woothemes_projects_loop['columns'] = $columns;

		if ( $projects->have_posts() ) : ?>

			<?php woothemes_projects_project_loop_start(); ?>

				<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>

					<?php woothemes_projects_get_template_part( 'content', 'project' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woothemes_projects_project_loop_end(); ?>

		<?php endif;

		wp_reset_postdata();

		return '<div class="woothemes-projects columns-' . $columns . '">' . ob_get_clean() . '</div>';
	}

}

new Woothemes_Projects_Shortcodes();