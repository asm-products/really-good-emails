<?php
/*-----------------------------------------------------------------------------------*/

    /* This files contains the custom user meta fields and author badge functions */
    /* WARNING: Do not change anything in here or things will quickly break */

/*-----------------------------------------------------------------------------------*/
/*
/*  Custom User Metafields
/*
/*-----------------------------------------------------------------------------------*/

    function vk_add_custom_user_profile_fields( $user ) {
    ?>
        <h3><?php _e('Social Profile Information', 'framework'); ?></h3>
        
        <table class="form-table">

            <!-- Twitter -->
            <tr>
                <th>
                    <label for="twitter"><?php _e('Twitter', 'framework'); ?>
                </label></th>
                <td>
                    <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php _e('Please enter your twitter URL', 'framework'); ?></span>
                </td>
            </tr>

            <!-- Facebook -->
            <tr>
                <th>
                    <label for="facebook"><?php _e('Facebook', 'framework'); ?>
                </label></th>
                <td>
                    <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php _e('Please enter your facebook URL', 'framework'); ?></span>
                </td>
            </tr>

            <!-- Google Plus -->
            <tr>
                <th>
                    <label for="google"><?php _e('Google Plus', 'framework'); ?>
                </label></th>
                <td>
                    <input type="text" name="google" id="google" value="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php _e('Please enter your google plus URL', 'framework'); ?></span>
                </td>
            </tr>

            <!-- Dribbble -->
            <tr>
                <th>
                    <label for="dribbble"><?php _e('Dribbble', 'framework'); ?>
                </label></th>
                <td>
                    <input type="text" name="dribbble" id="dribbble" value="<?php echo esc_attr( get_the_author_meta( 'dribbble', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php _e('Please enter your dribbble URL', 'framework'); ?></span>
                </td>
            </tr>

            <!-- Instagram -->
            <tr>
                <th>
                    <label for="instagram"><?php _e('Instagram', 'framework'); ?>
                </label></th>
                <td>
                    <input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php _e('Please enter your instagram URL', 'framework'); ?></span>
                </td>
            </tr>

            <!-- Vine -->
            <tr>
                <th>
                    <label for="vine"><?php _e('Vine', 'framework'); ?>
                </label></th>
                <td>
                    <input type="text" name="vine" id="vine" value="<?php echo esc_attr( get_the_author_meta( 'vine', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php _e('Please enter your vine URL', 'framework'); ?></span>
                </td>
            </tr>

            <!-- Tumblr -->
            <tr>
                <th>
                    <label for="tumblr"><?php _e('Tumblr', 'framework'); ?>
                </label></th>
                <td>
                    <input type="text" name="tumblr" id="tumblr" value="<?php echo esc_attr( get_the_author_meta( 'tumblr', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php _e('Please enter your tumblr URL', 'framework'); ?></span>
                </td>
            </tr>

        </table>

    <?php }

    function vk_save_custom_user_profile_fields( $user_id ) {
        
        if ( !current_user_can( 'edit_user', $user_id ) )
            return FALSE;
        
        update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
        update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
        update_user_meta( $user_id, 'google', $_POST['google'] );
        update_user_meta( $user_id, 'dribbble', $_POST['dribbble'] );
        update_user_meta( $user_id, 'instagram', $_POST['instagram'] );
        update_user_meta( $user_id, 'vine', $_POST['vine'] );
        update_user_meta( $user_id, 'tumblr', $_POST['tumblr'] );

    }

    add_action( 'show_user_profile', 'vk_add_custom_user_profile_fields' );
    add_action( 'edit_user_profile', 'vk_add_custom_user_profile_fields' );
    add_action( 'personal_options_update', 'vk_save_custom_user_profile_fields' );
    add_action( 'edit_user_profile_update', 'vk_save_custom_user_profile_fields' );

?>