<?php // Get the variables
$permalink = get_post_meta($post->ID, 'vk_post_permalink', true);
$lightbox = get_post_meta($post->ID, 'vk_post_lightbox', true);

// Set defaults if undefined
if($permalink=='') { $permalink='on'; }
if($lightbox=='') { $lightbox='on'; }

// Check Attachments
$arg = array(
	'post_type' => 'attachment',
	'numberposts' => null,
	'post_status' => null,
	'post_parent' => $post->ID,
);
$attachments = get_posts($arg);
if($attachments) { $attachments='on'; } else { $attachments='off'; } ?>


	<?php if( $lightbox=='on' && $attachments=='on' || $permalink=='on' ) { ?>
	<div class="entry_hover">
		<div class="placement">


			<?php // Lightbox
			if($lightbox=='on' && $attachments=='on') { ?>
			<div class="iconWrap lightbox ar">
					<?php vk_lightbox_link($post->ID, 'featured'); ?>
					<span class="icon-expand ar"></span>
			</div>
			<?php } ?>


			<?php // Permalink
			if($permalink=='on' ) { ?>
			<div class="iconWrap permalink ar">
				<a href="<?php echo get_permalink(); ?>"></a>
				<span class="icon-hyperlink ar"></span>
			</div>
			<?php } ?>


			<?php // Comment Bubbble
			if( get_comments_number()!='0' ) { ?>
			<div class="iconWrap commentNo ar">
				<span class="icon-chat ar"></span> <?php comments_number('0','1','%'); ?>
			</div>
			<?php } ?>


		</div>
	</div>
	<?php } ?>


<?php // Label
$accentText = get_post_meta($post->ID, 'vk_accent_text', true); if($accentText!='') { ?>
<div class="postLabel"><?php echo $accentText; ?></div>
<?php }