<?php

get_header();

   ?>
        <div class="content-area">
        <h1>Page en construction, demain sera plus beau !</h1>
        <div class="image">
        <?php if ( has_post_thumbnail() ) :
			the_post_thumbnail( 'full' );
        else:
         ?>   
            <div class="image">
               <img alt="image accueil" style="max-width:100%" src="/wp-content/themes/ndbdesign/assets/images/home.jpeg" />
            </div>
         <?php
		   endif; 
         ?>
        </div>
        <br/><br/>
   </div>
     <?php

get_footer();

?>
