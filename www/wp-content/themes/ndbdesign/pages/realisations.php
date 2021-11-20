<?php

/*
Template Name: Réalisations
*/
$pageId = is_null($args['page']) ? $post->ID : $args['page'];
$posts = get_posts(array(
    "category" => $pageId == 95 ? 18 : 30,
    "numberposts" => is_front_page() ? 3 : -1
));

if (!is_front_page()) {
    get_header();
    the_title("<h1>", "</h1>");
    the_content();
}
?>
<div class="<?php is_front_page() ? print '' : print 'grey' ?>">
<div class="grid realisations">
    <?php
    if ( $posts ) {
        foreach ( $posts as $post ) :
            setup_postdata( $post );
        ?>
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    <div class="element realisation">
        <div class="img" style="background-image:url(<?php the_post_thumbnail_url("full") ?>)"></div>
        <div>
        <?php
            the_title();
        ?>
        </div>
    </div>
    </a>
    <?php
        endforeach; 
        wp_reset_postdata();
    }
    ?>
</div>
</div>
<?php if (is_front_page()): 
    if($pageId == 95):
        ?>
            <a class="seeall" href="/accueil/nos-dernieres-realisations/"><button>VOIR TOUT</button></a>
        <?php 
    else:
        ?>
            <a class="seeall" href="/accueil/nos-derniers-articles-de-blog/"><button>VOIR TOUT</button></a>
        <?php 
    endif;
endif;

if (!is_front_page()) {
    get_footer();
}
