<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
	<button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
	<input class="src-input" type="text" placeholder="<?php echo esc_attr_x( 'Type to search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>">
</form>