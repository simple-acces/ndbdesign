<article>
    <div class="content-area">
        <?php if ( has_post_thumbnail() ) :
			the_post_thumbnail( 'full' );
		endif; ?>
    </div>
</article>

<article class="home-description">
    <div class="content-area">
        <div class="image">
            <img alt="image accueil" src="/wp-content/themes/ndbdesign/assets/images/home_1.jpg" />
        </div>
        <div class="description">
            <?php the_content(); ?>
        </div>
    </div>
</article>

<?php 

$pages = get_pages(array(
	"child_of" => $post->ID,
	"sort_column" => "menu_order"
));

foreach( $pages as $page ) { 
	setup_postdata( $page );     
?>
<?php 
if ($page->ID == 29) {

    ?><article class='bg-secondary'><?php 

} else {
    
    ?><article><?php 

}		
?>
    <h1><?php echo $page->post_title ?></h1>

    <?php 
	if ($page->ID == 95 || $page->ID == 143) {
		get_template_part('pages/realisations', null, ['page' => $page->ID]);
	} else {
		the_content();
	}		
	?>
</article>
<?php
    }   
	wp_reset_postdata();
?>