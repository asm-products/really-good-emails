						<div class="clear"></div>
					
					</div><!-- end .rightContent -->

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