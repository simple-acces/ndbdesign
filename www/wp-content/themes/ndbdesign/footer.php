<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
	</div><!-- #content -->

	<?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav aria-label="<?php esc_attr_e( 'Secondary menu', 'twentytwentyone' ); ?>" class="footer-navigation">
				<ul class="footer-navigation-wrapper">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'items_wrap'     => '%3$s',
							'container'      => false,
							'depth'          => 1,
							'link_before'    => '<span>',
							'link_after'     => '</span>',
							'fallback_cb'    => false,
						)
					);
					?>
				</ul><!-- .footer-navigation-wrapper -->
			</nav><!-- .footer-navigation -->
		<?php endif; ?>
		<div class="site-info">
			<div class="site-name">
			© NDB Design - Tél: +33 6 61 74 50 55 - <a href="mailto:contact@ndbdesign.fr">contact@ndbdesign.fr</a>
			</div><!-- .site-name -->
		</div><!-- .site-info -->
		<div class="socials">
			<a href="https://www.pinterest.fr/pin/666040232363255934/" target="_blank"><i class="fab fa-pinterest-p"></i></a>
			<a href="https://www.linkedin.com/in/nad%C3%A8ge-di-bernardo-31b6b335?originalSubdomain=fr" target="_blank"><i class="fab fa-linkedin-in"></i></a>
			<a href="https://www.instagram.com/ndbdesignparis/" target="_blank"><i class="fab fa-instagram"></i></a>
		</div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
