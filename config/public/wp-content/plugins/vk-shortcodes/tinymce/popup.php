<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new visual_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<div id="visual-popup">

	<div id="visual-shortcode-wrap">
		
		<div id="visual-sc-form-wrap">
		
			<div id="visual-sc-form-head">
			
				<?php echo $shortcode->popup_title; ?>
			
			</div>
			<!-- /#visual-sc-form-head -->
			
			<form method="post" id="visual-sc-form">
			
				<table id="visual-sc-form-table">
				
					<?php echo $shortcode->output; ?>
					
					<tbody>
						<tr class="form-row">
							<?php if( ! $shortcode->has_child ) : ?><td class="label">&nbsp;</td><?php endif; ?>
							<td class="field"><a href="#" class="button-primary visual-insert">Insert Shortcode</a></td>							
						</tr>
					</tbody>
				
				</table>
				<!-- /#visual-sc-form-table -->
				
			</form>
			<!-- /#visual-sc-form -->
		
		</div>
		<!-- /#visual-sc-form-wrap -->
		
		<div class="clear"></div>
		
	</div>
	<!-- /#visual-shortcode-wrap -->

</div>
<!-- /#visual-popup -->

</body>
</html>