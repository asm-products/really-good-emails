<?php get_header(); ?>

<div class="col3">

	<div class="contentBlock ar resultsWrap">

		<div class="entry_content">

			<?php // author conditions

			$author = '';

			if(is_author()) {

				// author id
				$id = get_query_var('author');

				$author = get_userdata( $id );

			} ?>

			<h4>

				<?php // archive title

				if (is_category()) { ?><span class="icon-list"></span><?php printf(__('All posts in %s', 'framework'), single_cat_title('',false));

				} elseif (is_tag()) { ?><span class="icon-list"></span><?php printf(__('All posts tagged %s', 'framework'), single_tag_title('',false));

				} elseif (is_day()) { ?><span class="icon-calendar"></span><?php _e('Archive for ', 'framework'); the_time('F jS, Y');

				} elseif (is_month()) { ?><span class="icon-calendar"></span><?php _e('Archive for ', 'framework'); the_time('F, Y');

				} elseif (is_year()) { ?><span class="icon-calendar"></span><?php _e('Archive for ', 'framework'); the_time('Y');

				} elseif (is_author()) { ?><span class="icon-user"></span><?php _e('All posts by ', 'framework'); echo $author->display_name;

				} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?><span class="icon-list"></span><?php printf(__('All items in %s', 'framework'), single_cat_title('',false)); } ?>

			</h4>

		</div><!-- end entry_content -->

	</div><!-- end contentBlock -->

</div><!-- end col3 -->

<div class="clear"></div>

<?php get_template_part('template','blog'); ?>

<?php get_template_part('template','infinitescroll'); ?>

<?php get_footer(); ?>