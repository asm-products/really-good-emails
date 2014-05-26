<?php
/*
Template name: Contact Page
*/

get_header();

// Get contact page variables
$id = get_the_id();

$address = get_post_meta($post->ID,'vk_contact_address', true);

$header = get_post_meta($post->ID,'vk_contact_header', true);

$icon = get_post_meta($post->ID,'vk_contact_icon', true);

?>

	<div class="col2 single">

		<!-- google maps -->
		<?php if($address!='') { ?>

			<div class="contentBlock ar">

				<div class="entry_media">

					<div id="googlemap" class="ar" style="height: 300px; width: 100%; overflow: hidden;"></div>

					<script type="text/javascript">

					(function($) {

						jQuery(document).ready(function($) {

						$('#googlemap').gmap3({

						    action: 'addMarker',

						    address: "<?php print($address); ?>",

						    map:{

						      center: true,

						      zoom: 14

						    },

						  },


						  {action: 'setOptions', args:[{scrollwheel: false }]}

						);

						});

					})(jQuery);

					</script>

				</div><!-- end entry_media -->

			</div><!-- end .contentBlock -->

		<?php } ?>


		<!-- content -->
		<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

				<div class="postWrap">

					<?php get_template_part('template','page'); ?>

				</div><!-- end .postWrap -->

			<?php } // end while posts ?>

		<?php } // end if posts ?>


		<!-- form -->
		<div class="contentBlock ar">

			<div class="entry_content">

				<div class="formWrap br">

					<div id="respond">

						<h3 id="reply-title"><span class="icon-<?php echo $icon; ?>"></span> <?php echo $header; ?></h3>

						<form method="get" action="<?php echo get_template_directory_uri(); ?>/send.php?set=<?php echo $id; ?>" id="comment-form">

							<!-- Name -->
							<input type="text" id="author" name="author" class="requiredField" placeholder="<?php _e('Name','framework'); ?>">

							<!-- Email -->
							<input type="text" id="email" name="email" class="requiredField email" placeholder="<?php _e('Email','framework'); ?>">

							<!-- Website -->
							<input type="text" id="url" name="url" placeholder="<?php _e('Website','framework'); ?>">

							<!-- Message -->
							<div class="clear"></div>
							<textarea name="comment" placeholder="<?php _e('Message','framework'); ?>" id="comment" class="requiredField"></textarea>

							<!-- Validator -->
							<input type="text" id="validator" name="validator">

							<!-- Submit -->
							<div class="clear"></div>

							<p class="form-submit">

								<input name="submit" type="submit" id="submitbutton" value="<?php _e('Send Message','framework'); ?>" class="button">

							</p>

						</form>

					</div><!-- #respond -->

				</div><!-- .formWrap -->

				<?php // success vars
				$thanks = __('Done!','framework');

				$text = __('Your message has now been sent','framework');

				$refresh = __('Refresh page','framework');

				$refreshlink = get_permalink($post->ID);

				?>

				<script type="text/javascript">
				jQuery(document).ready(function($) {

					$('form#comment-form').submit(function() {

						var hasError = false;

						$('form#comment-form .requiredField').each(function() {
							
							$(this).removeClass('inputError');

							if(jQuery.trim($(this).val()) == '') {

								$(this).addClass('inputError');

								hasError = true;

							} else if($(this).hasClass('email')) {

								var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

								if(!emailReg.test(jQuery.trim($(this).val()))) {

									$(this).addClass('inputError');

									hasError = true;

								}
							}

						});

						if(!hasError) {

							var formInput = $(this).serialize();

							$("form#comment-form").before('<div class="contact-success"><h3 class="inpageTitle"><?php Print($thanks); ?></h3><p><?php Print($text); ?> - <a href="<?php Print($refreshlink); ?>" title="<?php Print($refresh); ?>"><?php Print($refresh); ?></a></p></div>');

							$("form#comment-form").css('display','none');

							$("div.contact-success").hide().fadeIn(300);

							$('#reply-title').remove();

							$.post($(this).attr('action'),formInput);

						}
						
						return false;

					});

				});
				</script>

			</div><!-- end .entry_content -->

		</div><!-- end contentBlock -->

	</div><!-- end col2 -->

	<!-- sidebar -->
	<div class="col1 postSidebar">

			<?php if(is_active_sidebar( 'contact-sidebar' )) { dynamic_sidebar('contact-sidebar'); } ?>

	</div><!-- end .postSidebar -->

<?php get_footer(); ?>