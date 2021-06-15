<div class="row">
	<div class="col-sm-12">
		<div class="masonry masonry-blog-magazine">
			
			<?php if( 'yes' == get_option('stack_show_loop_categories', 'yes') ) : ?>
				<div class="masonry-filter-container">
					<?php get_template_part('inc/content-post', 'categories'); ?>
				</div>
			<?php endif; ?>
			
			<div class="row">
				<div class="masonry__container">
					<div class="masonry__item col-sm-6"></div>
					<?php
						$i = 0;
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							
							$i++;
							
							if( 1 == $i || 5 == $i ){
								echo '<div class="masonry__item col-sm-12 col-xs-12">';	
							} elseif( 2 == $i || 3 == $i || 6 == $i || 7 == $i ){
								echo '<div class="masonry__item col-sm-6 col-xs-12">';
							} else {
								echo '<div class="masonry__item col-sm-12 col-md-6 col-xs-12 height--tall">';
							}
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content-post', 'magazine');
							
							echo '</div>';
							
							if( 4 == $i ){
								echo '
									<div class="masonry__item col-md-6 col-sm-12 col-xs-12 magazine-loop-cta">
										<div class="boxed boxed--lg boxed--border bg--secondary text-center masonry__promo height--tall">
											<div class="pos-vertical-center">'. do_shortcode(get_option('stack_magazine_loop_cta')) .'</div>
										</div>
									</div><!--end item-->
								';	
							}
							
							if( 7 == $i ){
								$i = 0;	
							}
						
						endwhile;	
						else : 
							
							/**
							 * Display no posts message if none are found.
							 */
							get_template_part('loop/content','none');
							
						endif;
					?>

				</div><!--end masonry container-->
			</div><!--end of row-->
			
			<?php get_template_part('inc/content-pagination', get_option('stack_pagination_layout', 'text')); ?>
			
		</div><!--end masonry-->
	</div>
</div>