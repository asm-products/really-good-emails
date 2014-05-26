<?php get_header(); ?>

<div class="col3">

	<div class="contentBlock ar resultsWrap">

		<div class="entry_content">

				<h4><span class="icon-exclamation"></span><?php _e('Oops, you found something that doesn\'t exist', 'framework'); ?></h4>

		</div><!-- end entry_content -->

	</div><!-- end contentBlock -->

</div><!-- end col3 -->

<div class="col3 postWrap">

	<div class="contentBlock ar searchFail">

		<div class="entry_content">

		<?php // if logged in
		global $user_ID;

		// if user id exists
		if( $user_ID ) {

			// if user lvl is 10
			if( current_user_can('level_10') ) { ?>

				<div class="adminNote ar">

					<p><strong><?php _e('It appears you are logged in as the site admin!','framework'); ?></strong><br>

					<?php _e('Re-saving your sites permalink settings will fix 404 errors','framework'); ?></p>

				</div><!-- end adminNote -->

		<?php }

		} ?>

			<h4><strong><?php _e('Perhaps give the search a go','framework'); ?></strong></h4>

			<p><?php _e('Remember to search for general keywords','framework'); ?></p>

			<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">    
				
				<input class="searchinput" type="text" name="s" id="s2" placeholder="<?php _e('Search Posts', 'framework') ?>"/>

			</form>

		</div><!-- end entry_content -->

	</div><!-- end contentBlock -->

</div><!-- end postWrap -->

<div class="clear"></div>

<?php get_template_part('template','blog'); ?>

<?php get_template_part('template','infinitescroll'); ?>

<?php get_footer(); ?>