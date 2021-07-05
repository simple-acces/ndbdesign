<article>
	<div class="content-area">
		<?php if ( has_post_thumbnail() ) :
			the_post_thumbnail( 'full' );
		endif; ?>
	</div>
</article>

<article class="bg-secondary home-description">
	<div class="content-area">
		<div class="image">
			<img alt="image accueil" src="/wp-content/themes/ndbdesign/assets/images/home_1.jpg" />
		</div>
		<div class="description">
		<?php
			the_content();
		?>
		</div>
	</div>
</article>

<?php 

$pages = get_pages(array(
	"child_of" => $post->ID,
	"sort_column" => "menu_order"
));

foreach( $pages as $page ) {      
    $content = $page->post_content;
    if ( ! $content ) // Check for empty page
        continue;
 
    $content = apply_filters( 'the_content', $content );
?>
    <article><?php echo $content; ?></article>
<?php
    }   
?>