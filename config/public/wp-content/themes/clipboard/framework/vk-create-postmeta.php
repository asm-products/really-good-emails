<?php
/*-----------------------------------------------------------------------------------*/

    /* This files contains functions that make 'making' metaboxes easier and quicker. */
    /* Metaboxes are made in /theme/functions/theme-postmeta.php */
    /* WARNING: Do not change anything in here or things will quickly break */

/*-----------------------------------------------------------------------------------*/
/*	Add Metabox Function
/*-----------------------------------------------------------------------------------*/

	if( !function_exists( 'vk_add_meta_box' ) ) {
        function vk_add_meta_box($metaname, $nonce) {

        	// add the nonce to the show meta box args
        	$metaname['nonce'] = $nonce;


        	// Mutle Page Metabox
        	if(is_array($metaname['page'])) {

	        	foreach($metaname['page'] as $page) {

	        		add_meta_box($metaname['id'], $metaname['title'], 'vk_show_meta_box', $page, $metaname['context'], $metaname['priority'], $metaname);

	        	}


	        // Single Page Metabox
        	} else {

        		add_meta_box($metaname['id'], $metaname['title'], 'vk_show_meta_box', $metaname['page'], $metaname['context'], $metaname['priority'], $metaname);

        	}
    	}
    }

/*-----------------------------------------------------------------------------------*/
/*	Show Metabox Function
/*-----------------------------------------------------------------------------------*/

	if( !function_exists( 'vk_show_meta_box' ) ) {
        function vk_show_meta_box($post, $metaname) {

        		// Set the nonce value
        		$nonce = $metaname['args']['nonce'];

				// Use nonce for verification
				echo '<input type="hidden" name="jn_meta_box_nonce" value="', wp_create_nonce($nonce), '" />';
			 	// echo '<input type="hidden" name="vk_meta_box_nonce" value="' . $nonce . '" />';
				echo '<table class="form-table">';

				foreach ($metaname['args']['fields'] as $field) {
					
					// get current post meta data
					$meta = get_post_meta($post->ID, $field['id'], true);
					
					switch ($field['type']) {


					// If divider
					case 'divider':
						echo '<tr id="', $field['id'], '" class="vk-divider">',
						'<th style="width:40%; height: 1px; padding: 0px"><label><strong></strong></label></th>',
						'<td style="height: 1px; padding: 0px">';
					break; 

					// If group-start
					case 'group-start':
						echo '<tbody class="vk-group">';
					break; 

					// If group-end
					case 'group-end':
						echo '<!-- end vk-group --></tbody>';
					break; 

					// If Select
					case 'select':
						echo '<tr id="', $field['id'], '">',
						'<th style="width:40%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
						'<td>';
						echo'<select name="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo'<option';
							if ($meta == $option ) { 
								echo ' selected="selected"'; 
							}
							echo'>'. $option .'</option>';
						} 
						echo'</select>';
					break; 

					// If Taxonomy Select	
					case 'tax_select':
						echo '<tr id="', $field['id'], '">',
						'<th style="width:40%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
						'<td>';

							
						$tax_arg = array(
							'show_option_none' => 'None (all portfolio posts)',
							'taxonomy' => $field['taxonomy'],
							'name' => $field['id'],
							'show_count' => 1,
							'selected' => $meta,
							'class' => 'postform',
							'hide_if_empty' => false,
							'hide_empty' => 0,
						);

						wp_dropdown_categories( $tax_arg );

					break; 

					// If Textarea
					case 'textarea':
						echo '<tr id="', $field['id'], '">',
						'<th style="width:40%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
						'<td>';
						echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="5" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
					break;

					// If Text		
					case 'text':
						echo '<tr id="', $field['id'], '">',
						'<th style="width:40%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
						'<td>';
						echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
					break;

					// If Checkbox
					case 'checkbox':
						echo '<tr id="', $field['id'], '">',
						'<th style="width:40%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
						'<td>';
						    $val = '';
			                if( $meta ) {
			                    if( $meta == 'on' ) $val = ' checked="yes"';
			                } else {
			                    if( $field['std'] == 'on' ) $val = ' checked="yes"';
			                }
							echo '<input type="hidden" name="'. $field['id'] .'" value="off" />
			                <input type="checkbox" id="'. $field['id'] .'" name="'. $field['id'] .'" value="on"'. $val .' /> ';
						 echo '</td>';
					 break;

					// If Button	
					case 'button':
						echo '<tr id="', $field['id'], '">',
							 '<th style="width:40%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
						     '<td>';
						echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
						echo '</tr>';
						?><script type="text/javascript" language="javascript">
		            		jQuery(document).ready(function($){

								// Force button text
								$("input#<?php echo $field['id']; ?>").val("<?php echo $field['std']; ?>");


								// If button is select
								<?php if($field['media']=='select') { ?>

									$("input#<?php echo $field['id']; ?>").click(function(e) {

									    // Default Media View
									    var buttoncall = 0;
									    $('#wpcontent').ajaxStop(function() {
									        if ( 0 == buttoncall ) {
									            $('[value="uploaded"]').attr( 'selected', true ).parent().trigger('change');
									            buttoncall = 1;
									        }
									    });

									    // The button magic
										var button = $(this);
										_custom_media = true;
										wp.media.editor.send.attachment = function(props, attachment){
											if ( _custom_media ) {
												$("input#<?php echo $field['for']; ?>, textarea#<?php echo $field['for']; ?>").val(attachment.url);
											} else {
												return wp.media.editor.send.attachment.apply( this, [props, attachment] );
											};
										}
										wp.media.editor.open(button);
										return false;
									});


								// If button is upload
								<?php } else { ?>

									$("input#<?php echo $field['id']; ?>").click(function(e) {
										
									    // Default Media View
									    var buttoncall = 0;
									    $('#wpcontent').ajaxStop(function() {
									        if ( 0 == buttoncall ) {
									            $('[value="uploaded"]').attr( 'selected', true ).parent().trigger('change');
									            buttoncall = 1;
									        }
									    });

										// The button magic
										var button = $(this);
										wp.media.editor.send.attachment = function(props, attachment){}
										wp.media.editor.open(button);
										return false;

									});

								<?php } ?>

		                    });
		        		</script><?php
					break;

					// If Color
		            case 'color':
		                echo '<tr id="', $field['id'], '">',
		    			'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
		    			'<td>';
		                echo '<div id="' . $field['id'] . '_picker" class="colorSelector"><div></div></div>';
		    			echo '<input style="width:75px; margin-left: 5px;" class="vk-color" name="'. $field['id'] .'" id="'. $field['id'] .'" type="text" value="'. $meta .'" />';
						?><script type="text/javascript" language="javascript">
		            		jQuery(document).ready(function(){
		            			//Color Picker
		    				    jQuery('#<?php echo $field['id']; ?>_picker').children('div').css('backgroundColor', '<?php echo $meta; ?>');    
		            			jQuery('#<?php echo $field['id']; ?>_picker').ColorPicker({
		            				color: '<?php echo $meta; ?>',
		            				onShow: function (colpkr) {
		            					jQuery(colpkr).fadeIn(500);
		            					return false;
		            				},
		            				onHide: function (colpkr) {
		            					jQuery(colpkr).fadeOut(500);
		            					return false;
		            				},
		            				onChange: function (hsb, hex, rgb) {
		            					//jQuery(this).css('border','1px solid red');
		            					jQuery('#<?php echo $field['id']; ?>_picker').children('div').css('backgroundColor', '#' + hex);
		            					jQuery('#<?php echo $field['id']; ?>_picker').next('input').attr('value','#' + hex);
		        					}
		    				    });
		                    });
		        		</script><?php
		        	break;


					}
				}
				echo '</table>';

    	}
    }

/*-----------------------------------------------------------------------------------*/
/*	Save Metabox Function
/*-----------------------------------------------------------------------------------*/

	if( !function_exists( 'vk_save_meta_box' ) ) {
        function vk_save_meta_box($post_id, $metaname) {

			// Define new
 			$new ='';

			// General Page Settings
			foreach ($metaname['fields'] as $field) {

				$old = get_post_meta($post_id, $field['id'], true);
				
				if(isset($_POST[$field['id']])){

				     $new = $_POST[$field['id']];

				    if( $field['type']=='tax_select' && $new==0 ) {

				    	$new='all';

				    }		     

				}

				if ($new && $new != $old) {

					update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
				
				} elseif ('' == $new && $old) {

					delete_post_meta($post_id, $field['id'], $old);
				
				}

			}

    	}
    }

?>