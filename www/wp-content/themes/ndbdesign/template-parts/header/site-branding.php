<?php
/**
 * Displays header site branding
 */
?>

<?php if ( has_custom_logo() ) : ?>
	<div class="site-logo">
		<?php the_custom_logo(); ?>
		<a href="<?php echo home_url() ?>" target="_self"><div>
			NDB Design<br/>
			Architecture d'intérieur & design à vivre <br/>
			Paris
		</div></a>
	</div>
<?php endif; ?>
