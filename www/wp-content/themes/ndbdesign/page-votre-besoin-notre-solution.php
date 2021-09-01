<?php
/**
 * The template for displaying all single posts
 */

get_header();

    while ( have_posts() ) :
        the_post();
        ?>
        <div class="prestations grey">
        <h1>Nos prestations en Architecture d'intérieur & décoration</h1>
        <?php
            the_content();
        ?>
        </div>
        <?php
        the_title("<h1>", "</h1>");
        ?>
        <p>
        Vous souhaitez transformer votre intérieur mais vous ne savez pas quelle prestation choisir? Dans notre rubrique interactive, Votre besoin, notre solution d'accompagnement, laissez-vous guider : cliquez sur ce que vous recherchez; une ou des solutions d'accompagnement vous seront proposées pour obtenir un diagnostic, des conseils en architecture d'intérieur, en décoration ou sur la meilleure façon de concrétiser votre projet d'aménagement d'espace.
        <br /><br />
        Vous ne trouvez pas la solution adaptée à votre besoin? Vous avez un doute sur la meilleure formule? Contactez-nous par téléphone ou par mail et nous envisagerons ensemble la prestation la plus appropriée à ce que vous souhaitez ainsi qu'à votre budget.
        <p> 
        <?php
    endwhile; 

get_footer();
