<?php // Post Variables
$contentDisplay = get_post_meta($post->ID, 'vk_post_content', true);
if($contentDisplay=='') { $contentDisplay='Always show'; }

$metaDisplay = get_post_meta($post->ID, 'vk_post_meta', true);
if($metaDisplay=='') { $metaDisplay='Always show'; }

$gallerystyle = get_post_meta($post->ID, 'vk_gallery', true);
if($gallerystyle=='Thumbnails') { $gallerystyle='thumb'; } else { $gallerystyle='slide'; }


// Check if content is on
if(    $contentDisplay=='Always show'
	|| $contentDisplay=='Only show on post page' && is_single()
	|| get_the_post_thumbnail()=='' && get_post_format()=='standard' )
{
	$content='wContent';
} else {
	$content='nContent';
}


// Check if meta is on
if(    $metaDisplay=='Always show'
	|| $metaDisplay=='Only show on post page' && is_single() ) {
	$meta='wMeta';
} else {
	$meta='nMeta';
}

// Force the content of for status and empty content posts
if( has_post_format('status')
	&& get_post_meta($post->ID, 'vk_status_embed', true)!=''
	|| get_the_content()=='' )
{
	$content = 'nContent';
	$meta = 'nMeta';
}

// Check if post has featured image
if(has_post_thumbnail()) {
	$hasfeature = 'wFeature';
} else {
	$hasfeature = 'nFeature';
} ?>


<!-- Post -->
<div id="post-<?php the_ID(); ?>" <?php post_class( array($hasfeature, $content, $gallerystyle, 'contentBlock ar')); ?>>


	<?php get_template_part('template','media'); ?>


	<?php if($content=='wContent') { ?>
		<!-- Entry Content -->
		<div class="entry_content">

			<?php if(get_post_meta($post->ID, 'vk_post_title', true)!='off' && !has_post_format('status') && !has_post_format('aside') ) { ?>
			<div class="entry_title">
			
				<?php if(is_single()) { ?>

					<h1><?php echo the_title(); ?></h1>

				<?php } else { ?>

					<h2><a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_title(); ?></a></h2>

				<?php } ?>

			
			</div>
			<?php } ?>

			<div class="entry_copy">

				<?php vk_content($post->ID); ?>
				<?php vk_pages(); ?>

			</div>
			<div class="clear"></div>
		</div>


		<?php if($meta=='wMeta') { ?>
			<!-- Entry Meta -->
			<div class="entry_meta br">
				<section class="postTime">
					<span class="icon-calendar icon"></span><span class="meta"><?php echo vk_post_time(); ?></span>
				</section>
				<?php if(has_tag()) { ?>
					<section class="postTags">
						<span class="icon-pin icon"></span><span class="meta"><?php the_tags('',', ',''); ?></span>
					</section>
				<?php } ?>
				<?php if(vk_categories()!='') { ?>
					<section class="postCategories">
						<span class="icon-list icon"></span><span class="meta"><?php echo vk_categories(); ?></span>
					</section>
				<?php } ?>
			</div>
		<?php } ?>

	<?php } ?>


</div><!-- end post -->
<div class="clear"></div>