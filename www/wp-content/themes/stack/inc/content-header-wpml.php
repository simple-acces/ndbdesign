<?php $languages = icl_get_languages('skip_missing=0&orderby=code'); ?>

<li class="dropdown">
	<span class="dropdown__trigger"><?php echo ICL_LANGUAGE_NAME; ?></span>
	<div class="dropdown__container">
		<div class="container">
			<div class="row">
				<div class="col-md-1 dropdown__content">
					<ul class="menu-vertical text-left">
						<?php
							if(!( empty($languages) )){
							    foreach($languages as $l){
							        echo '<li><a href="'.$l['url'].'">'.$l['native_name'].'</a></li>';
							    }
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</li>