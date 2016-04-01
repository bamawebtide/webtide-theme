<?php

// Set the main header
add_filter( 'ua_webtide_main_header', function( $title ) {
	return 'Resources';
});

// Set the subheader
add_filter( 'ua_webtide_main_subheader', function( $subheader ) {
	global $post;
	return get_the_title( $post->ID );
});

// Set the sidebar
add_filter( 'ua_webtide_left_sidebar_id', function( $sidebar_id ) {
	return 'resources';
});

get_header();

get_footer();