<?php
	
global $resources_page_post;

/**
 * Get the resources page post.
 *
 * This method allows us to have a 'resources' archive while still having a post editor.
 */
$resources_page_post = get_page_by_path( 'resources' );

// Set the main header
add_filter( 'ua_webtide_main_header', 'ua_webtide_resources_set_main_header_title' );
function ua_webtide_resources_set_main_header_title( $title ) {
	return 'Resources';
}

// Set the subheader
//add_filter( 'ua_webtide_main_subheader', 'ua_webtide_resources_set_main_subheader' );
function ua_webtide_resources_set_main_subheader( $subheader ) {
	//return get_post_meta( $jobs_page_post->ID, 'page_subheader', true );
	return $subheader;
}

// Don't print the loop
add_filter( 'ua_webtide_run_the_loop', 'ua_webtide_filter_resources_run_the_loop' );
function ua_webtide_filter_resources_run_the_loop( $run_the_loop ) {
	return false;
}

// Set the layout to full
add_filter( 'ua_webtide_layout', 'ua_webtide_filter_resources_layout' );
function ua_webtide_filter_resources_layout( $layout ) {
	return 'full';
}

// Add title before the loop
add_action( 'ua_webtide_before_the_loop', 'ua_webtide_resources_print_page_title' );
function ua_webtide_resources_print_page_title() {
	global $resources_page_post, $post;
	
	$original_post = $post = $resources_page_post;
	
	// Add the content
	/*if ( 1 == get_current_user_id() ) {
		
		echo apply_filters( 'the_content', $resources_page_post->post_content );
		
	} else {*/
	
		?><p>We're about excited our new knowledge base but some gears are still being put into motion. It won't be too much longer.</p>

		<p>In the meantime, here are a few Google Docs that might be helpful:</p>

		<ul>
			<li><a href="https://docs.google.com/document/d/1-eH_rP16T8_hDr0bSHth3hD9DHLt6YAcqhkG0RYrRmo/edit?usp=sharing" target="_blank">Tools and Resources For Your Job</a></li>
			<li><a href="https://docs.google.com/document/d/1wDbnaeVgAtP6HDsFONzAakuURvK8szmcpdvxYwECvIM/edit?usp=sharing" target="_blank">Recommended WordPress Plugins</a></li>
		</ul>
		
		<!-- Begin MailChimp Signup Form -->
		<link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
		<style type="text/css">
			#mc_embed_signup{background:rgba(0,0,0,0.05); clear:left; padding:30px 40px;}
			#mc_embed_signup form {margin:0; padding:0;}
			#mc_embed_signup label {font-size:20px; color:#222;}
			#mc_embed_signup input.email {width:100%;}
			#mc_embed_signup input.button {width:100%; margin:0;}
		</style>
		<div id="mc_embed_signup">
		<form action="//webtide.us5.list-manage.com/subscribe/post?u=8d7dd837768f016e32e4adb57&amp;id=71a1ff6cec" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
		    <div id="mc_embed_signup_scroll">
			
				<label for="mce-EMAIL">Let me know when the WebTide Resources knowledge base is ready</label><?php
				
				if ( IS_WEBTIDE_MEMBER ) {
					
					?><p style="margin-bottom:0;">There's no need for you fill anything out. We'll let WebTide members know when the resources section is ready to go.</p><?php
						
				} else {
					
					?><input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Your email address" required>
					<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					<div style="position: absolute; left: -5000px;"><input type="text" name="b_8d7dd837768f016e32e4adb57_71a1ff6cec" tabindex="-1" value=""></div>
					<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div><?php
						
				}
				
			?></div>
		</form>
		</div>
		
		<!--End mc_embed_signup--><?php
			
	//}
	
	$post = $original_post;
		
}

// Get the header area
get_header();

// Get the footer area
get_footer();