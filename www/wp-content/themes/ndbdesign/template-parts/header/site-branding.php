<?php
/**
 * Displays header site branding
 */
?>

<?php if ( has_custom_logo() ) : ?>
	<div class="site-logo">
		<?php the_custom_logo(); ?>
		<div>
			NDB Design<br/>
			Architecture d'intérieur & design à vivre <br/>
			Paris
		</div>
	</div>
<?php endif; ?>
