<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	
	<fieldset class="no-bot-marg">
	
		<legend for="comment" class="show-old"><?php _e('Type & hit enter to search','framework'); ?></legend>
	
		<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="<?php _e('Type & hit enter to search','framework'); ?>" />
	
	</fieldset>

</form>