<?php

// Video Post Format
//-------------------------------------------->
if ( has_post_format('video')) { ?>

		<div class="clear"></div>

		<div class="entry_media">
		
			<?php echo vk_video($post->ID); ?>

		</div>

<?php // Audio Post Format
//-------------------------------------------->
} elseif ( has_post_format('audio')) { ?>

		<div class="clear"></div>

		<div class="entry_media">

			<?php

			if(has_post_thumbnail()) {

				get_template_part('template','hover');

				the_post_thumbnail('standard', array( 'class' => 'imagescale'));
				
			} 

			echo vk_audio($post->ID);

			?>

		</div>


<?php // Chat Post Format
//-------------------------------------------->
} elseif ( has_post_format('chat')) { ?>


		<?php $chat_content = get_post_meta($post->ID,'vk_chat',true); ?>
		<div class="entry_media">
			<?php echo vk_chat($chat_content); ?>
		</div>


<?php // Gallery Post Format
//-------------------------------------------->
} elseif ( has_post_format('gallery')) { ?>


		<div class="entry_media">
		<?php $type = get_post_meta($post->ID, 'vk_gallery', true);
		get_template_part('template','hover');

		// Thumbnail Gallery
		if($type=='Thumbnails') { ?>

			<div class="galleryWrap"><?php vk_gallery($post->ID, 'standard'); ?></div>

		<?php // Slider Gallery
		} else { ?>

			<div class="slideWrap"><?php vk_slider($post->ID, 'standard'); ?></div>
			<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".slides_<?php echo get_the_ID(); ?>").responsiveSlides({
					auto: true,
					speed: 300,
					timeout: 5000,
					pager: true,
					pause: true,
					nav: false,
					pauseControls: true,
				});
			});
			</script>

		<?php } ?>
		</div>


<?php // Link Post Format
//-------------------------------------------->
} elseif ( has_post_format('link')) {

	$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'standard' );
	$linkurl = get_post_meta($post->ID, 'vk_link_url', true);
	$linkurlclean = preg_replace("/(http:\/\/)/i",'',$linkurl);
	$linkdesc = get_post_meta($post->ID, 'vk_link_desc', true);
	$txcolor = get_post_meta($post->ID, 'vk_link_color', true);
	$bgcolor = get_post_meta($post->ID, 'vk_link_bgcolor', true);
	$bgoverlay = get_post_meta($post->ID, 'vk_link_overlay', true); ?>

	<div class="ql_wrapper">
	<div class="entry_media css3coverbg" style="<?php if($image!=''){ ?>background-image: url(<?php echo $image; ?>);<?php } ?> <?php if($bgcolor!='') { ?>background-color: <?php echo $bgcolor; ?>;<?php } ?>">
	<?php get_template_part('template','hover'); ?>
	


			<?php // If Overlay exists
			if($bgoverlay!='') { $rgb = vk_hexchange($bgoverlay); ?>
				<div class="ql_overlay" style="background-color: rgba(<?php echo $rgb; ?>, .5); "></div>
			<?php } ?>

			<div class="ql_textwrap">
				<?php if($linkdesc!='') { ?><h3 style="color: <?php echo $txcolor; ?>"><?php echo apply_filters('widget_text', $linkdesc); ?></h3><?php } ?>
				<p style="color: <?php echo $txcolor; ?>"><a style="color: <?php echo $txcolor; ?>" target="_blank" href="<?php echo $linkurl; ?>"><?php echo $linkurlclean; ?></a></p>
			</div>


	
	</div>
	<div class="clear"></div>
	</div>
	<div class="clear"></div>


<?php // Quote Post Format
//-------------------------------------------->
} elseif ( has_post_format('quote')) {

	$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'standard' );
	$quotetext = get_post_meta($post->ID, 'vk_quote_text', true);
	$quotesource = get_post_meta($post->ID, 'vk_quote_source', true);
	$txcolor = get_post_meta($post->ID, 'vk_quote_color', true);
	$bgcolor = get_post_meta($post->ID, 'vk_quote_bgcolor', true);
	$bgoverlay = get_post_meta($post->ID, 'vk_quote_overlay', true); ?>

	<div class="ql_wrapper">
	<div class="entry_media css3coverbg" style="<?php if($image!=''){ ?>background-image: url(<?php echo $image; ?>);<?php } ?> <?php if($bgcolor!='') { ?>background-color: <?php echo $bgcolor; ?>;<?php } ?>">
	<?php get_template_part('template','hover'); ?>
	


			<?php // If Overlay exists
			if($bgoverlay!='') { $rgb = vk_hexchange($bgoverlay); ?>
				<div class="ql_overlay" style="background-color: rgba(<?php echo $rgb; ?>, .5); "></div>
			<?php } ?>

			<div class="ql_textwrap">
				<h3 style="color: <?php echo $txcolor; ?>"><?php echo apply_filters('widget_text', $quotetext); ?></h3>
				<?php if($quotesource!='') { ?>
					<p style="color: <?php echo $txcolor; ?>"><?php echo $quotesource; ?></p>
				<?php } ?>
			</div>


	</div>
	<div class="clear"></div>
	</div>
	<div class="clear"></div>


<?php // Status Post Format (twitter embed only)
//-------------------------------------------->
} elseif ( has_post_format('status')) { ?>


	<?php $tweetEmbed = get_post_meta($post->ID, 'vk_status_embed', true);
	if($tweetEmbed!='') { ?>
		<div class="entry_media">
			<?php echo stripslashes(nl2br(htmlspecialchars_decode($tweetEmbed))); ?>
		<div class="clear"></div>
		</div>	
	<?php } ?>


<?php // Standard Post Format
//-------------------------------------------->
} else { ?>


		<?php if(has_post_thumbnail()) { ?>
		<div class="entry_media">
			<?php get_template_part('template','hover'); the_post_thumbnail('standard', array( 'class' => 'imagescale')); ?>
		</div>
		<?php } ?>


<?php } ?>