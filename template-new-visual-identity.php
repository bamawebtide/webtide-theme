<?php

// Template Name: WebTide - NEW Visual Identity Standards

// Change the sidebar ID
add_filter( 'ua_webtide_left_sidebar_id', function( $sidebar_id ) {
	return 'new-visual-identity-page';
});

// Get the header area
get_header();

// Get the footer area
get_footer();