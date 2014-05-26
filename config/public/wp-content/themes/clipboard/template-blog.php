<?php

// Get the template variables
$blgtmp=get_option('vk_blog_template');
$srchtmp=get_option('vk_search_template');


// 3 Column Masonry Blog Page
if( is_page_template('page-masonry.php') ||
	is_page_template('page-masonry_oversize.php') ||
	is_page_template('page-masonry_fixedfull.php') ||

	is_home() && $blgtmp=='msnryFixed' ||
	is_home() && $blgtmp=='msnryOver' ||
	is_home() && $blgtmp=='msnryFixedfull' ||

	is_search() && $srchtmp=='msnryFixed' ||
	is_search() && $srchtmp=='msnryOver' ||
	is_search() && $srchtmp=='msnryFixedfull' ||

	is_archive() && $srchtmp=='msnryFixed' ||
	is_archive() && $srchtmp=='msnryOver' ||
	is_archive() && $srchtmp=='msnryFixedfull' ||
	is_404() && $blgtmp=='msnryFixed' ||
	is_404() && $blgtmp=='msnryOver' ||
	is_404() && $blgtmp=='msnryFixedfull'

) { ?>


	<div id="content" class="masonry">
  
		<?php if(is_search() || is_home() || is_archive()) { } else { get_template_part('template','customloop'); } ?>

		<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

			<div class="col1 postWrap">

				<?php get_template_part('template','post'); ?>

				<div class="clear"></div>

			</div>

		<?php } // end while posts ?>

		<?php } elseif(!have_posts()) { get_template_part('template','searchfail'); } ?>
	
	</div>
	<?php get_template_part('template','pagination'); ?>




<?php // 2 Column Blog Page Masonry
} elseif (
	is_page_template('page-blog2col.php') ||
	is_home() && $blgtmp=='blg2col' ||
	is_search() && $srchtmp=='blg2col' ||
	is_archive() && $srchtmp=='blg2col' ||
	is_404() && $blgtmp=='blg2col'

) { ?>


	<div class="blog2col">

	<div id="content" class="masonry">

		<?php if(is_search() || is_home() || is_archive()) { } else { get_template_part('template','customloop'); } ?>

		<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

			<div class="col1 postWrap">

			<?php get_template_part('template','post'); ?>

			<div class="clear"></div>

			</div>

		<?php } // end while posts ?>

		<?php } elseif(!have_posts()) { get_template_part('template','searchfail'); } ?>
	
	</div>

	<?php get_template_part('template','pagination'); ?>

	</div><!-- end blog2col wrapper -->

	<!-- Sibebar -->
	<div class="col1 postSidebar">

		<?php if(is_active_sidebar( 'blog-1-sidebar' )) { dynamic_sidebar('blog-1-sidebar'); } ?>

		<!-- Floating Sidebar -->
		<div id="floatStart" class="clear"></div>

		<div class="floatSidebar">

		<?php if(is_active_sidebar( 'blog-2-sidebar' )) { dynamic_sidebar('blog-2-sidebar'); } ?>

		</div><!-- end Float Sidebar -->

	</div><!-- end postSidebar -->





<?php // 1 Column Blog Page
} elseif (
	is_page_template('page-blog1col.php') ||
	is_home() && $blgtmp=='blg1col' ||
	is_search() && $srchtmp=='blg1col' ||
	is_archive() && $srchtmp=='blg1col' ||
	is_404() && $blgtmp=='blg1col'
	
) { ?>


	<div class="col2">

		<div id="content">

			<?php if(is_search() || is_home() || is_archive()) { } else { get_template_part('template','customloop'); } ?>

			<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

				<div class="col1 postWrap">

				<?php get_template_part('template','post'); ?>

				<div class="clear"></div>

				</div>

			<?php } // end while posts ?>

			<?php } elseif(!have_posts()) { get_template_part('template','searchfail'); } ?>

		</div>

		<?php get_template_part('template','pagination'); ?>

	</div><!-- end col2 -->

	<!-- Sibebar -->
	<div class="col1 postSidebar">

		<?php if(is_active_sidebar( 'blog-1-sidebar' )) { dynamic_sidebar('blog-1-sidebar'); } ?>

		<!-- Floating Sidebar -->
		<div id="floatStart" class="clear"></div>

		<div class="floatSidebar">

		<?php if(is_active_sidebar( 'blog-2-sidebar' )) { dynamic_sidebar('blog-2-sidebar'); } ?>

		</div><!-- end Float Sidebar -->

	</div><!-- end postSidebar -->




<?php // Standard 1 colum fallback for everything else
} else { ?>


	<div class="col2">

		<div id="content">

			<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

				<div class="col1 postWrap">

				<?php get_template_part('template','post'); ?>

				<div class="clear"></div>

				</div>

			<?php } // end while posts ?>

			<?php } elseif(!have_posts()) { get_template_part('template','searchfail'); } ?>

		</div>

		<?php get_template_part('template','pagination'); ?>

	</div><!-- end postWrap -->

	<!-- Sibebar -->
	<div class="col1 postSidebar">

		<?php if(is_active_sidebar( 'blog-1-sidebar' )) { dynamic_sidebar('blog-1-sidebar'); } ?>

		<!-- Floating Sidebar -->
		<div id="floatStart" class="clear"></div>

		<div class="floatSidebar">

		<?php if(is_active_sidebar( 'blog-2-sidebar' )) { dynamic_sidebar('blog-2-sidebar'); } ?>

		</div><!-- end Float Sidebar -->

	</div><!-- end postSidebar -->

<?php } ?>