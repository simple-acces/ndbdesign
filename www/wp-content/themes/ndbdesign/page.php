<?php
/**
 * The template for displaying all single posts
 */

get_header();


while ( have_posts() ) :
	the_post();
	if ( is_front_page() ) :
		get_template_part( 'template-parts/content/content-front-page' );
	else:
		the_content();
	endif;
endwhile; 

get_footer();
