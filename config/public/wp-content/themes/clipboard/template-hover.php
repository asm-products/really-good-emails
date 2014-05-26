<?php // Get the variables
$permalink = get_post_meta($post->ID, 'vk_post_permalink', true);
$lightbox = get_post_meta($post->ID, 'vk_post_lightbox', true);

// Set defaults if undefined
if($permalink=='') { $permalink='off'; }
if($lightbox=='') { $lightbox='off'; }
$lightlinks = '';

// Check Attachments
$arg = array(
	'post_type' => 'attachment',
	'numberposts' => null,
	'post_status' => null,
	'post_parent' => $post->ID,
);
$attachments = get_posts($arg);
if($attachments) { $attachments='on'; } else { $attachments='off'; } ?>


	<?php if( $lightbox=='on' && $attachments=='on' || $permalink=='on' && !is_single() ) { ?>

		<div class="entry_hover">

			<!-- single links -->
			<?php if( $lightbox=='on' && $permalink=='off' || $lightbox=='on' && $permalink=='on' && is_single() ) {

				vk_lightbox_link($post->ID, 'standard');

				// turn off below links
				$lightlinks = 'off';

			} elseif( $lightbox=='off' && $permalink=='on' && !is_single() ) { ?>

				<a href="<?php echo get_permalink(); ?>"></a>

			<?php } ?>


			<!-- icon holder -->
			<div class="placement">


				<?php // lightbox
				if($lightbox=='on' && $attachments=='on') { ?>

				<div class="iconWrap lightbox">

					<?php if($lightlinks!='off'){ vk_lightbox_link($post->ID, 'standard'); } ?>

					<span class="icon-expand"></span>

				</div>

				<?php } ?>


				<?php // permalink
				if($permalink=='on' && !is_single() ) { ?>

				<div class="iconWrap permalink">

					<a href="<?php echo get_permalink(); ?>"></a>

					<span class="icon-hyperlink"></span>

				</div>

				<?php } ?>


				<?php // comment
				if( get_comments_number()!='0' && !is_single() ) { ?>

				<div class="iconWrap commentNo">

					<span class="icon-chat"></span> <?php comments_number('0','1','%'); ?>

				</div>

				<?php } ?>

			</div>

		</div>

	<?php } ?>


<?php // Label
$accentText = get_post_meta($post->ID, 'vk_accent_text', true); if($accentText!='') { ?>
<div class="postLabel"><?php echo $accentText; ?></div>
<?php }