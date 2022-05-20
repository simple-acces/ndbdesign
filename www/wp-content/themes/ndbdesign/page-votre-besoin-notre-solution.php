<?php
/**
 * The template for displaying all single posts
 */

$my_postid = 29;//This is page id or post id
$content_post = get_post($my_postid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);

get_header();

    while ( have_posts() ) :
        the_post();
        ?>
        <div class="prestations">
        <h1>Nos prestations en Architecture d'intérieur & décoration</h1>
        <?php
            echo $content;
        ?>
        </div>
        <?php
        the_title("<h1 style=\"margin-top:0px\">", "</h1>");
        ?>
        <p>
        Vous souhaitez transformer votre intérieur mais vous ne savez pas quelle prestation choisir? Dans notre rubrique interactive, Votre besoin, notre solution d'accompagnement, laissez-vous guider : cliquez sur ce que vous recherchez; une ou des solutions d'accompagnement vous seront proposées pour obtenir un diagnostic, des conseils en architecture d'intérieur, en décoration ou sur la meilleure façon de concrétiser votre projet d'aménagement d'espace.
        <br /><br />
        Vous ne trouvez pas la solution adaptée à votre besoin? Vous avez un doute sur la meilleure formule? Contactez-nous par téléphone ou par mail et nous envisagerons ensemble la prestation la plus appropriée à ce que vous souhaitez ainsi qu'à votre budget.
        <p> 
        <div class="prestations grey">
        <?php
            the_content();
        ?>
        </div>
        <?php
    endwhile; 

get_footer();
