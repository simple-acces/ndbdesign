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
    the_title("<h1>", "</h1>");
    ?>
    <p>
    A travers une galerie photos avant/après, découvrez quelques-unes de nos réalisations en architecture et décoration d’intérieur. Les projets portés par le Studio NDB Design sont tous différents. Vous trouverez bien sûr la rénovation totale ou partielle de différents appartements. Mais il y a aussi le relooking décoration d’intérieur. Ou encore pour un projet plus orienté architecture d’intérieur, une restructuration de l’espace s’avère nécessaire.

Chaque projet est unique. C’est en effet une nouvelle histoire qui commence entre le client et l’architecte d’intérieur, le décorateur. Et une nouvelle page s’écrit. L’étroite collaboration entre le client et le designer d’intérieur implique donc une totale relation de confiance.
    </p>
<p>
Pour mettre en valeur le potentiel d’un lieu, le studio NDB design exploite ses contraintes et son caractère. Par exemple, en optimisant les volumes et en fluidifiant la circulation. Il joue également avec la subtilité des couleurs et de leur alchimie avec la lumière. Cela lui permet ainsi d’améliorer la sensation d’espace et en même temps, d’intimité. Par ailleurs le choix des revêtements tels que le parquet et carrelages, est étudié en fonction du caractère du lieu. Ils ne seront jamais identiques d’un projet à l’autre.

La créativité et la lumière sont au centre de toutes ces réalisations signées par notre studio NDB Design. Nous accordons en effet autant d’importance à la rénovation d’un appartement qu’au choix du luminaire pour un bureau. 

Quelque soit la prestation que vous choisissez, nous mettons tout en oeuvre pour trouver une solution d’accompagnement en fonction de vos besoins : comment améliorer l’éclairage d’une pièce ? Pourquoi ma cuisine n’est-elle pas pratique ? Est-il possible d’aménager un bureau sans perte d’espace ? Comment scinder une pièce en deux pour créer une chambre d’enfant?

Par ailleurs, nous vous accompagnons dans tous vos projets d’aménagement : création d’un dressing, conception d’une mezzanine, optimisation des combles, rangements sur mesure, etc…
    </p>
    <?php
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
<?php if (is_front_page()): ?>
<a class="seeall" href="/accueil/nos-dernieres-realisations/"><button>VOIR TOUT</button></a>
<?php endif;

if (!is_front_page()) {
    get_footer();
}
