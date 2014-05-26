<?php
/*
Template name: Fullwidth Page
*/

get_header();

?>

	<div class="col3">

		<!-- content  -->
		<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

				<div class="postWrap">
				
					<?php get_template_part('template','page'); ?>
				
				</div><!-- end .postWrap -->

			<?php } // end while posts ?>

		<?php } // end if posts ?>

	</div><!-- end col3 -->

<?php get_footer(); ?>