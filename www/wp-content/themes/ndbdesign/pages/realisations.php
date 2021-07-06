<?php

/*
Template Name: Réalisations
*/

$posts = get_posts(array(
    "category" => 18,
    "numberposts" => is_front_page() ? 3 : -1
));

if (!is_front_page()) {
    get_header();
}
?>
<div class="grid realisations">
    <?php
    if ( $posts ) {
        foreach ( $posts as $post ) :
            setup_postdata( $post );
        ?>
    <div class="element realisation">
        <img src="<?php the_post_thumbnail_url("full") ?>" />
        <?php
            the_title();
        ?>
    </div>
    <?php
        endforeach; 
        wp_reset_postdata();
    }
    ?>
</div>
<?php if (is_front_page()): ?>
<a href="/accueil/nos-realisations/"><button>VOIR PLUS</button></a>
<?php endif;

if (!is_front_page()) {
    get_footer();
}