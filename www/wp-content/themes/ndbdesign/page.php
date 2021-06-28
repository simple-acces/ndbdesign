<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

if ( is_front_page() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content/content-front-page' );
	endwhile; 
endif;

get_footer();
