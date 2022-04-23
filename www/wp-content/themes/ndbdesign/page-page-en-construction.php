<?php

get_header();

   ?>
        <div class="content-area">
        <?php if ( has_post_thumbnail() ) :
         ?> <h1>Page en construction, demain sera plus beau !</h1> <?php
			the_post_thumbnail( 'full' );
        else:
         ?>   
            <h1>Page introuvable</h1>
            <div class="image">
               <img alt="image accueil" style="max-width:100%" src="/wp-content/themes/ndbdesign/assets/images/home.jpeg" />
            </div>
         <?php
		   endif; 
         ?>
        <br/><br/>
   </div>
     <?php

get_footer();

?>
