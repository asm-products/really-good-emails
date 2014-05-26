<div class="clear"></div>

<!-- manual -->
<?php $pagType = get_option('vk_pagination');
if($pagType=='manualInfinite'){ ?>

	<div class="pageWrap manual">

		<a id="load-more">

			<?php _e('Load More','framework'); ?>

		</a>

		<a id="loading" style="display: none;">

			<?php _e('Loading','framework'); ?>

		</a>

	</div>


<!-- seamless -->
<?php } elseif($pagType=='seamlessInfinite') { ?>

	<div class="pageWrap seamless">

		<a id="loading">

			<?php _e('Loading','framework'); ?>

		</a>

	</div>


<!-- standard -->
<?php } else { ?>

	<div class="pageWrap standard">

		<?php global $wp_query;

		$big = 999999999; // need an unlikely integer

		$paginate = paginate_links( array(

		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),

		'format' => '?paged=%#%',

		'current' => max( 1, get_query_var('paged') ),

		'total' => $wp_query->max_num_pages,

		'end_size' => 1,

		'mid_size' => 1,

		'prev_next' => False

		));

		if($paginate!='') { ?>

			<?php echo $paginate; ?>

		<?php } ?>

	</div>

<?php } ?>