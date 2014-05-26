<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
	
	<div class="col1 postWrap">

		<?php get_template_part('template','post'); ?>

	</div><!-- end .postWrap -->

<?php } } ?>