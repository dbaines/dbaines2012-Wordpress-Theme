<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="archive-container">
			<div id="archive-content" role="main">
				<?php

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				get_template_part( 'loop', 'category' );
				?>

			<div class="clear"></div>
			</div><!-- #content -->
		</div><!-- #container -->
        
<?php include(TEMPLATEPATH.'/subsection.php'); ?>
<?php get_footer(); ?>
