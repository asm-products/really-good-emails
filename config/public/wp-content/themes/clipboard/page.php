<?php get_header(); ?>

	<div class="col2 single">

		<!-- content -->
		<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

			<div class="postWrap">

				<?php get_template_part('template','page'); ?>

			</div><!-- end .postWrap -->
			
		<?php } // end while posts ?>

		<?php } // end if posts ?>

		<!-- comments -->
		<?php if (comments_open()!='' && comments_open()) {

			comments_template('', true);

		} ?>

	</div><!-- end .col2 -->

	<!-- sidebar -->
	<div class="col1 postSidebar">

		<?php if(is_active_sidebar( 'page-1-sidebar' )) { dynamic_sidebar('page-1-sidebar'); } ?>

		<!-- floating sidebar -->
		<div id="floatStart" class="clear"></div>

		<div class="floatSidebar">

			<?php if(is_active_sidebar( 'page-2-sidebar' )) { dynamic_sidebar('page-2-sidebar'); } ?>

		</div><!-- end .floatSidebar -->

	</div><!-- end .postSidebar -->

<?php get_footer(); ?>