<?php
/*-----------------------------------------------------------------------------------*/
/*
/*	Comment Form Styling
/*
/*-----------------------------------------------------------------------------------*/

add_filter('comment_form_defaults', 'vk_comment_form');

function vk_comment_form($form_options) {

	// commenter
	$commenter = wp_get_current_commenter();

	// user
	global $user_identity;

	// global query
	global $wp_query;

	// post if
	$post_id = $wp_query->post->ID;

	// replt title
	if(have_comments()) {

		$replytitle = '<span class="icon-compose"></span> '.__( 'Join the conversation','framework' );

	} else {

		$replytitle = '<span class="icon-compose"></span> '.__( 'Start the conversation','framework' );

	}

    // field array
    $fields = array(

        'author' =>
        '<input type="text" id="author" name="author" class="ar requiredField"' . esc_attr( $commenter['comment_author'] ) . ' placeholder="' . __( 'Name', 'framework' ) . '" />',

        'email' =>
        '<input type="text" id="email" name="email" class="ar requiredField email"' . esc_attr( $commenter['comment_author_email'] ) . ' placeholder="' . __( 'Email', 'framework' ) . '" />',

        'url' =>
        '<input type="text" id="url" name="url"  class="ar" ' . esc_attr( $commenter['comment_author_url'] ) . ' placeholder="' . __( 'Website' , 'framework') . '" />',

    );

    // form options array
    $form_options = array(

        // Include Fields Array
        'fields' => apply_filters( 'comment_form_default_fields', $fields ),

        // Template Options
        'comment_field' =>
        '<div class="clear"></div><textarea name="comment" placeholder="' . __('Comment', 'framework') . '" id="comment" aria-required="true" class="requiredField"></textarea><div class="clear"></div>',
       
       	'must_log_in' =>
        '<p style="margin-bottom: 20px;">' .
        sprintf( __( 'You must be logged in to post a comment','framework'),
            wp_login_url( apply_filters( 'the_permalink', get_permalink($post_id) ) ) ) .
        '</p>',

        'logged_in_as' =>
        '<p style="margin-bottom: 20px;">' .
        sprintf( __( 'Logged in as <a href="%1$s">%2$s</a> - <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url('profile.php'), $user_identity, wp_logout_url( apply_filters('the_permalink', get_permalink($post_id)) ) ) .
        '</p>',

        'comment_notes_before' => '',
        'comment_notes_after' => '',

        // Rest of Options
        'id_form' => 'comment-form',
        'id_submit' => 'submitbutton',
        'title_reply' =>  $replytitle,
        'title_reply_to' => '',
        'label_submit' => __( 'Post Comment','framework' ),
        'cancel_reply_link' => '<span class="icon-compose"></span> '.__('Cancel Reply','framework'),
    );

    return $form_options;
}


/*-----------------------------------------------------------------------------------*/
/*
/*	Comment Styling
/*
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'vk_comment' ) ) {
    function vk_comment($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment;

        $author_url = get_comment_author_url(); ?>

        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

		<div class="contentBlock ar">

			<div class="entry_content">
	        
		        <div class="comment_wrap">

		        	<!-- avatar -->
		            <div class="imgwrap">

		            	<?php // author url
		            	if($author_url!='') { ?>

							<a href="<?php echo $author_url; ?>" title="<?php echo $author_url; ?>">

								<?php echo get_avatar($comment,$size='50'); ?>

							</a>

			            <?php // no author url
			        	} else { ?>

				            	<?php echo get_avatar($comment,$size='50'); ?>

			           	<?php }

			           	// reply button
			        	comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth']) ) );

			        	?>

		            </div>

		            <!-- comment -->
		            <div class="comment">

		            	<!-- details -->
		            	<div class="details">

		            		<?php $time = get_comment_time('G'); ?>

		                	<p><span class="name ar"><?php comment_author(); ?></span> - <span class="time"><?php echo vk_comment_time($time); ?></span></p>

		            	</div><!-- end .details -->

		            	<div class="clear"></div>          

		            	<!-- text -->
		            	<div class="text">

				        <?php if ($comment->comment_approved == '0') { ?>

				        	<p style="color: #ccc; margin-bottom: 5px; text-decoration: underline;"><?php _e('* Your comment is awaiting moderation', 'framework') ?></p>

				        <?php } ?>

		            	<?php comment_text() ?>

		            	</div><!-- end .text -->
		            	
		            </div><!-- end .comment -->

		        </div><!-- end comment_wrap -->
	        
	    	</div><!-- end .entry_content -->

    	</div><!-- end .contentBlock -->

    <?php }

}

/*-----------------------------------------------------------------------------------*/
/*
/*	Trackback / Pings Styling
/*
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'vk_list_pings' ) ) {

    function vk_list_pings($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment; ?>

        <li id="comment-<?php comment_ID(); ?>" class="ping"><?php comment_author_link(); ?>

     <?php }

}

/*-----------------------------------------------------------------------------------*/
/*
/*	Comment Control
/*
/*-----------------------------------------------------------------------------------*/

// do not pass go
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) { die ('Do not load this page directly!'); }

// password conditions
if ( post_password_required() ) { ?>
	
	<div class="contentBlock ar">

		<div class="entry_content">

			<h3 class="inpageTitle" style="margin-bottom: 0px;"><span class="icon-forbid"></span> <?php _e('Comments are hidden on locked posts','framework'); ?></h3>

		</div><!-- end .entry_content -->

	</div><!-- end .contentBlock -->

<?php return; }


// closed conditions
if ('closed' == $post->comment_status && !is_page() ) { ?>

	<div class="contentBlock ar">

		<div class="entry_content">

			<h3 class="inpageTitle" style="margin-bottom: 0px;"><span class="icon-forbid"></span> <?php _e('Comments are now closed for this article','framework'); ?></h3>

		</div><!-- end .etnry_content -->

	</div><!-- end .contentBlock -->

<?php }


// form
if (comments_open()) { ?>

	<div class="contentBlock ar">

		<div class="entry_content">

			<div class="clear"></div>

			<div class="formWrap br">
				
				<?php comment_form(); ?>

			</div>

			<?php 

			// success vars
			$thanks = __('Done!','framework');

			$text = __('Your comment has now been posted','framework');

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

	</div><!-- end .contentBlock -->

<?php }


// comments
if (have_comments()) {

	// if comments
	if ( ! empty($comments_by_type['comment']) ) { ?>

		<ul id="comments">

			<?php wp_list_comments('type=comment&avatar_size=50&callback=vk_comment'); ?>

		</ul><!-- end #comments -->

		<?php // nav
		if( get_previous_comments_link()!='' || get_next_comments_link()!='' ) { ?>

			<div class="contentBlock ar">

				<div class="entry_content">

					<div class="postPages">

						<?php paginate_comments_links(); ?>

					</div><!-- end .postPages -->

				</div><!-- end .entry_content -->

			</div><!-- end .contentBlock -->

		<?php } ?>


	<?php }

	// if pings
	if ( !empty($comments_by_type['pings']) ) { ?>

		<h3 class="inpageTitle"><?php _e('Pings & Trackbacks','framework'); ?></h3>

		<div class="clear"></div>

		<ul id="pings">

			<?php wp_list_comments('type=pings&callback=vk_list_pings'); ?>

			<div class="clear"></div>

		</ul><!-- end #pings -->

		<div class="clear"></div>

		<?php // nav
		if( get_previous_comments_link('type=pings')!='' || get_next_comments_link('type=pings')!='' ) { ?>

			<div class="contentBlock ar">

				<div class="entry_content">

					<div class="postPages">

						<?php paginate_comments_links('type=pings'); ?>

					</div><!-- end .postPages -->

				</div><!-- end .entry_content -->

			</div><!-- end .contentBlock -->

		<?php }

	}

} ?>