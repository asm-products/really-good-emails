<?php
/*
Template name: Archive Page
*/

get_header(); ?>
<div class="masonry">

	<!-- Last 30 Posts -->
	<div class="col1 postWrap widget">

		<div class="contentBlock ar">

			<div class="entry_content">

				<div class="entry_copy">

					<div class="archiveLists">

						<h6 class="widgetTitle"><span class="icon-newspaper inline"></span> <?php _e('Last 30 Posts', 'framework') ?></h6>

						<ul>

						<?php $archive_30 = get_posts('numberposts=30');

						foreach($archive_30 as $post) : ?>

							<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>

						<?php endforeach; ?>

						</ul>

					</div>

				</div>

				<div class="clear"></div>

			</div>

		</div>

	</div>


	<!-- Monthly Archive -->
	<div class="col1 postWrap widget">

		<div class="contentBlock ar">

			<div class="entry_content">

				<div class="entry_copy">

					<div class="archiveLists">

						<h6 class="widgetTitle"><span class="icon-calendar inline"></span> <?php _e('Archives by Month', 'framework') ?></h6>

						<ul>

							<?php wp_get_archives('type=monthly'); ?>

						</ul>

					</div>

				</div>

				<div class="clear"></div>

			</div>

		</div>

	</div>


	<!-- Category Archive -->
	<div class="col1 postWrap widget">

		<div class="contentBlock ar">

			<div class="entry_content">

				<div class="entry_copy">

					<div class="archiveLists">

						<h6 class="widgetTitle"><span class="icon-list inline"></span> <?php _e('Archives by Category', 'framework') ?></h6>

						<ul>

					 		<?php wp_list_categories( 'title_li=' ); ?>

						</ul>

					</div>

				</div>

				<div class="clear"></div>

			</div>

		</div>

	</div>

</div>
<?php get_footer(); ?>