<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" value="<?php _e( '', 'nayncuration' ); ?>" onfocus=" if ( this.value == '<?php _e( 'Type and press enter', 'nayncuration' ); ?>' ) this.value = '';" onblur="if ( this.value == '' ) this.value = '<?php _e( 'Type and press enter', 'nayncuration' ); ?>';" name="s" id="s" /> 
	<input type="submit" id="searchsubmit" value="<?php _e( 'Search', 'nayncuration' ); ?>" class="button hidden">
</form>