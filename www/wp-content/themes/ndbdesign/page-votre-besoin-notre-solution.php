<?php
/**
 * The template for displaying all single posts
 */

get_header();
?> 
<div class="prestations">
<?php
    while ( have_posts() ) :
        the_post();
        the_title("<h1>", "</h1>");
        ?>
        <p>
        L’année 2020, marquée par la nécessité de rester chez soi,
a fait émerger de profonds désirs de changements.

NDB Design vous invite à réinventer votre intérieur.

Une large gamme de prestations en architecture & décoration d’intérieur ainsi qu’une sélection de luminaires & de mobilier vous sont proposés.

Contactez-nous, nous vous aiderons à concrétiser votre projet
<br /><br />
L’année 2020, marquée par la nécessité de rester chez soi,
a fait émerger de profonds désirs de changements.

NDB Design vous invite à réinventer votre intérieur.

Une large gamme de prestations en architecture & décoration d’intérieur ainsi qu’une sélection de luminaires & de mobilier vous sont proposés.

Contactez-nous, nous vous aiderons à concrétiser votre projet
        <p>
        <div class="grey">
        <?php
            the_content();
        ?>
        </div>
            
        <?php
    endwhile; 

?> 
</div>
<?php

get_footer();
