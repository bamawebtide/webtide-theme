<?php
		
global $site_url, $layout;
		
	// Do not include this on the home/front page
	if ( ! is_front_page() ) {
			
				// Closing our <div>s depending upon our layout
				switch( $layout ) {
					
					case 'full-width':
					default:
					
						// Close the main content div we started in the header
						?></div><?php
							
						break;
						
					case 'left':
					
						// Close the main content div we started in the header
						?></div><?php
							
						// Print the sidebar
						?><div class="small-12 medium-4 medium-pull-8 large-3 large-pull-9 columns sidebar"><?php
							
							ua_webtide_print_sidebar();
							
						?></div><?php
							
						break;
						
					case 'right':
					
						// Close the main content div we started in the header
						?></div><?php
							
						// Print the sidebar
						?><div class="small-12 medium-4 large-3 columns sidebar"><?php
							
							ua_webtide_print_sidebar();
							
						?></div><?php
							
						break;
						
				}
			
			// Closing the row
			?></div><?php
		
		// Closing the main area that's opened in the header
		?></div> <!-- #ua-webtide-main --><?php
		
	}
	
	// The footer area
	?><div id="ua-webtide-footer">
		
		<div class="row">
			<div class="small-12 columns">
				
				<a class="ua-square" href="http://ua.edu"><span>The University of Alabama</span></a>
				
				<ul class="footer-items">
					<li>Copyright &copy; <?php echo date( 'Y' ); ?></li>
					<li><a href="<?php echo $site_url; ?>">WebTide</a></li>
					<li><a href="http://ua.edu/">The University of Alabama</a></li>
					<li class="break"><a href="http://ua.edu/disclaimer.html">Disclaimer</a></li>
					<li>Tuscaloosa, AL 35487</li>
					<li><a href="<?php echo $site_url; ?>/contact/">Contact WebTide</a></li>
				</ul>
				
				<?php /*<div class="magnifying-glass"></div>*/ ?>
				<a class="twitter logo" href="https://twitter.com/bamawebtide"><span>Follow WebTide on Twitter</span></a>
				<a class="github logo" href="https://github.com/bamawebtide"><span>Follow WebTide on GitHub</span></a>
				
			</div>
		</div>
		
	</div> <!-- #ua-webtide-footer --><?php
		
	wp_footer();
	
?></body>
</html>