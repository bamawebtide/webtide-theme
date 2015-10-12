<?php

global $next_webtide_meeting_html;
	
// Get the header
get_header();

	// Print the welcome area
	?><div id="ua-webtide-welcome">
		
		<div class="row">
			<div class="small-12 columns">
				
				<div class="welcome-message">
					<p>Bringing University of Alabama <em>web professionals</em> together to educate, inform, discuss, innovate, and share.</p>
					<a class="button learn-more" href="<?php echo $site_url; ?>/who-we-are/">Learn more about our community</a>
				</div> <!-- .welcome-message -->
				
			</div>
		</div>
		
	</div> <!-- #ua-webtide-welcome --><?php
		
	// Print the other sections of the home page
	?><div id="ua-webtide-front-page-sections">
		
		<section>
			<div class="row"><?php

				// Make sure we have the html
				//if ( ! $next_webtide_meeting_html ) {
					$next_webtide_meeting_html = ua_webtide_get_next_monthly_meeting_html( array(
						'include_excerpt' => true,
						'include_button'  => true,
						'view_details'    => false
					) );
				//}
				
				// Have a different order for members, putting the next meeting note first on small screens
				if ( IS_WEBTIDE_MEMBER && $next_webtide_meeting_html ) {
					
					?><div class="small-12 medium-12 large-4 large-push-8 columns">

						<div class="webtide-next-meeting">

							<h2>Our Next Meeting</h2><?php

							echo $next_webtide_meeting_html;

						?></div>

					</div><?php
						
					// If we have featured content items...
					if ( is_active_sidebar( 'home-page-featured-content' ) ) {
			
						// Print the featured content items
						dynamic_sidebar( 'home-page-featured-content' );
						
					}
					
				} else {
					
					// If we have featured content items...
					if ( is_active_sidebar( 'home-page-featured-content' ) ) {
			
						// Print the featured content items
						dynamic_sidebar( 'home-page-featured-content' );
						
					}
					
					?><div class="small-12 medium-12 large-4 columns"><?php
					
						?><h2>Web Jobs at UA</h2>
							
						<p>The <a href="http://www.ua.edu/">The University of Alabama</a> provides an amazing work environment as well as the opportunity to be a part of an accomplished community of higher education web professionals. <a class="button expand" href="<?php echo get_bloginfo( 'url' ); ?>/jobs/">Learn more about available web jobs</a></p><?php
						
					?></div><?php
					
				}
				
			?></div>
		</section>
				
	</div><?php

// Get the footer
get_footer();