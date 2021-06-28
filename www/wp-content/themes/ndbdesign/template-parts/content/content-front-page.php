<article>
	<div class="content-area">
		<?php if ( has_post_thumbnail() ) :
			the_post_thumbnail( 'full' );
		endif; ?>
	</div>
</article>

<article class="bg-secondary">
	<div class="content-area">
		<?php
			the_content();
		?>
	</div>
</article>
