<?php
	
// Filter the main header
add_filter( 'ua_webtide_main_header', 'ua_webtide_search_filter_main_header' );
function ua_webtide_search_filter_main_header() {
	
	// Get the query
	$search_query = get_search_query();
	
	return 'Search Results' . ( $search_query ? " for \"{$search_query}\"" : NULL );
	
}
	
get_header();

get_footer();