<?php
	
global $jobs_page_post;

/**
 * Get the jobs page post.
 *
 * This method allows us to have a 'jobs' archive while still having a post editor.
 */
$jobs_page_post = get_page_by_path( 'jobs' );

// Set the main header
add_filter( 'ua_webtide_main_header', 'ua_webtide_jobs_set_main_header_title' );
function ua_webtide_jobs_set_main_header_title( $title ) {
	global $jobs_page_post;
	return get_the_title( $jobs_page_post->ID );
}

// Set the subheader
add_filter( 'ua_webtide_main_subheader', 'ua_webtide_jobs_set_main_subheader' );
function ua_webtide_jobs_set_main_subheader( $subheader ) {
	global $jobs_page_post;
	return get_post_meta( $jobs_page_post->ID, 'page_subheader', true );
}
	
// Change the sidebar ID
add_filter( 'ua_webtide_left_sidebar_id', 'ua_webtide_filter_jobs_left_sidebar_id' );
function ua_webtide_filter_jobs_left_sidebar_id( $sidebar_id ) {
	return 'jobs-page';
}

// Add content before the loop
add_action( 'ua_webtide_before_the_loop', 'ua_webtide_jobs_print_page_title' );
function ua_webtide_jobs_print_page_title() {
	global $jobs_page_post, $post;
	
	$original_post = $post = $jobs_page_post;
	
	// Add form before the content
	echo do_shortcode( '[gravityform id="6" title="true" description="true"]' );
	
	// Add the content
	echo apply_filters( 'the_content', $jobs_page_post->post_content );
	
	$post = $original_post;
		
}

// Add data after the title in the loop
add_action( 'ua_webtide_loop_after_the_title', 'ua_webtide_loop_jobs_after_the_title' );
function ua_webtide_loop_jobs_after_the_title( $post ) {
	
	// Get details
	$details = array();
	
	if ( $department = get_post_meta( $post->ID, 'department', true ) )
		$details[ 'Department' ] = $department;
		
	if ( $closing_date = strtotime( get_post_meta( $post->ID, 'closing_date', true ) ) )
		$details[ 'Closing Date' ] = date( 'n/j/Y', $closing_date );
		
	// Add details
	if ( $details ) {
		
		?><p class="post-meta"><?php
			
			$details_index = 0;
			foreach( $details as $detail_label => $detail ) {
				
				// If more than 1 detail, add a space between them
				if ( $details_index > 0 )
					echo '&nbsp;&nbsp;/&nbsp;&nbsp;';
				
				// Print the detail
				echo $detail_label . ': <span class="meta-value">' . $detail . '</span>';
				
				// Keep track of the detail index
				$details_index++;
				
			}
			
		?></p><?php
			
	}
	
	// Add social media share buttons
	if ( $tweet_intent_url = get_ua_webtide_job_tweet_intent_url( $post->ID ) ) {
	
		?><a class="social-button twitter" href="<?php echo $tweet_intent_url; ?>" target="_blank">Share on Twitter</a><?php
			
	}
	
	if ( $facebook_share_url = get_ua_webtide_facebook_share_url( $post->ID ) ) {
	
		?><a class="social-button facebook" href="<?php echo $facebook_share_url; ?>" target="_blank">Share on Facebook</a><?php
			
	}
	
}

// Customize no posts message
add_filter( 'ua_webtide_loop_no_posts', 'ua_webtide_loop_jobs_no_posts' );
function ua_webtide_loop_jobs_no_posts( $no_posts ) {
	return '<p class="no-posts jobs">There are no job postings at this time.</p>';
}

// Get the header area
get_header();

// Get the footer area
get_footer();