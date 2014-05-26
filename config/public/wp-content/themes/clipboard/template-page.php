<?php // Set Page Variables
$content='wContent'; ?>


<?php if( has_post_thumbnail() || get_the_content()!='' ) { ?>

	<!-- page -->
	<div id="post-<?php the_ID(); ?>" <?php post_class( array($content, 'contentBlock ar')); ?>>

		<?php if(has_post_thumbnail()) { ?>
			<!-- Entry Media -->
			<div class="entry_media">
				<?php the_post_thumbnail('standard', array( 'class' => 'imagescale')); ?>
			</div>
		<?php } ?>


		<?php if(get_the_content()!='') { ?>
			<!-- Entry Content -->
			<div class="entry_content">

				<?php if(get_post_meta($post->ID, 'vk_post_title', true)=='on') { ?>
				<div class="entry_title">
					<h3><?php echo the_title(); ?></h3>
				</div>
				<?php } ?>
				
				<div class="entry_copy">
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>

	</div><!-- end page -->

<?php } ?>