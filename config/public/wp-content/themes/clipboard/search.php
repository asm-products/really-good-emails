<?php get_header(); ?>

	<div class="col3">

		<div class="contentBlock ar resultsWrap">

			<div class="entry_content">

				<h4><span class="icon-search"></span><?php _e('Search results for', 'framework'); ?> <?php echo the_search_query(); ?></h4>

			</div><!-- end .entry_content -->

		</div><!-- end .contentBlock -->

	</div><!-- end .col3 -->

	<div class="clear"></div>

<?php get_template_part('template','blog'); ?>

<?php get_template_part('template','infinitescroll'); ?>

<?php get_footer(); ?>