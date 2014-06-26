						<div class="clear"></div>
					
					</div><!-- end .rightContent -->
				<script type="text/javascript">
				  (function() {
				    window._pa = window._pa || {};
				    // _pa.orderId = "myOrderId"; // OPTIONAL: attach unique conversion identifier to conversions
				    // _pa.revenue = "19.99"; // OPTIONAL: attach dynamic purchase values to conversions
				    // _pa.productId = "myProductId"; // OPTIONAL: Include product ID for use with dynamic ads
				    var pa = document.createElement('script'); pa.type = 'text/javascript'; pa.async = true;
				    pa.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + "//tag.perfectaudience.com/serve/53ab5d8e36531ac20e00006f.js";
				    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(pa, s);
				  })();
				</script>
				<?php // copyright

				$copy_text=get_option('vk_copy_text');

				if($copy_text!='') { ?>

					<div class="clear"></div>

					<div class="copyright"><p style="font-size: 90%;"><?php echo $copy_text; ?></p></div>

				<?php } ?>

				<div class="clear"></div>

			</div><!-- end rightPadding -->

			<!-- iOS background helper -->
			<div class="iosBackground"></div>

		</div><!-- end rightContainer -->

		<span id="directoryRef" data-directory="<?php echo get_template_directory_uri(); ?>" data-loading="<?php _e('LOADING','framework'); ?>"></span>

	</div><!-- end #globalWrap -->

	<?php wp_footer(); ?>

</body>
</html>
<?php

	// create the output string
	$output = ob_get_contents();

	// end object
	ob_end_clean();

	// remove javascript comments
	$output = preg_replace('/(?<!\S)\/\/\s*[^\r\n]*/', '', $output);

	// remove whitespace
	$output = join("\n", array_map("trim", explode("\n", $output)));

	// remove tab spaces
	$output = preg_replace('/	/', '', $output);

	// remove double spaces (create single space)
	$output = preg_replace('/  /', ' ', $output);

	// remove empty lines
	$output = preg_replace('/\n+/', " ", trim($output));

	// compressed
	echo $output;

?>