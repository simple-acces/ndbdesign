<?php

get_header();

   ?>
        <div class="content-area">
        <h1>Page en construction, demain sera plus beau !</h1>
        <div class="image">
        <?php if ( has_post_thumbnail() ) :
			the_post_thumbnail( 'full' );
		endif; ?>
        </div>
        <br/><br/>
   </div>
     <?php

get_footer();

?>
