<?php $image = get_option('stack_footer_background_image'); ?>

<footer class="footer-6 unpad--bottom imagebg">

	<?php if( $image ) : ?>
		<div class="background-image-holder">
			<img src="<?php echo esc_url($image); ?>" alt="Footer Background" />
		</div>
	<?php endif; ?>
	
	<div class="container">
		<div class="row">
			<?php get_template_part('inc/content-footer', 'widgets'); ?>
		</div><!--end of row-->
	</div><!--end of container-->
	<div class="footer__lower text-center-xs">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<?php get_template_part('inc/content-footer', 'copyright'); ?>
				</div>
				<div class="col-sm-6 text-right text-center-xs">
					<?php get_template_part('inc/content-footer', 'social'); ?>
				</div>
			</div><!--end of row-->
		</div><!--end of container-->
	</div>
</footer>