<?php
/**
 * The template for displaying project content within widgets.
 *
 * Override this template by copying it to yourtheme/woothemes_projects/content-project-widget.php
 *
 * @author 		WooThemes
 * @package 	Woothemes_Projects/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $project;
?>
<li>

	<a href="<?php the_permalink(); ?>" class="project-permalink">

		<?php echo woothemes_projects_get_project_thumbnail( 'project-thumbnail' ); ?>

		<span class="project-title"><?php the_title(); ?></span>

	</a>

</li>