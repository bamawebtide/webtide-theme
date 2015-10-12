<?php
	
global $post, $ua_mybama_cas_auth, $site_url, $layout, $user_first_name, $user_email;
	
// Get site URL
$site_url = get_bloginfo( 'url' );

// What's the login URL?
$login_url = isset( $ua_mybama_cas_auth ) ? $ua_mybama_cas_auth->get_login_url() : NULL;

// What's the logout URL?
$logout_url = isset( $ua_mybama_cas_auth ) ? $ua_mybama_cas_auth->get_logout_url() : NULL;

// Are we viewing the front page?
$is_front_page = is_front_page();

// What's the stylesheet directory
$stylesheet_dir = get_stylesheet_directory_uri();
	
?><!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html lang="en" >
	
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?>>

	<a href="<?php echo is_front_page() ? '#ua-webtide-welcome' : '#ua-webtide-main'; ?>" id="skip-to-content">Skip to Content</a><?php
	
	// Print a background cover on the home page
	if ( $is_front_page ) {
		?><div id="ua-webtide-bg-cover"></div> <!-- #ua-webtide-bg-cover --><?php
	}
	
	// Print the header area
	?><div id="ua-webtide-header">
		
		<div id="ua-webtide-banner">
			
			<div class="row">
				<div class="small-12 columns">
			
					<ul id="ua-webtide-banner-menu">
						<li class="home cap"><a href="<?php echo $site_url; ?>">Home</a></li>
						<li class="ua dash cap"><a href="http://ua.edu/">UA.EDU</a></li><?php
							
						// If you're not a member...
						//if ( ! IS_WEBTIDE_MEMBER ) {
							
							?><li class="how-to-join dash cap"><a href="<?php echo $site_url; ?>/how-to-join/">How To Join</a></li><?php
								
						//}

						?><li class="github dash"><a class="github logo" href="https://github.com/bamawebtide"><span>Follow WebTide on GitHub</span></a></li>
						<li class="twitter"><a class="twitter logo" href="https://twitter.com/bamawebtide"><span>Follow WebTide on Twitter</span></a></li><?php
							
						// If the user is logged in somehow...
						if ( IS_WEBTIDE_MEMBER || IS_MYBAMA_AUTHENTICATED ) {
							
							?><li class="user dash">
								<span class="user-inside">
								
									<span class="user-top"><?php
								
										echo get_avatar( $user_email, 22 );
										
										?><span class="user-greeting"><?php
											
											// Print a greeting
											echo isset( $user_first_name ) && ! empty( $user_first_name ) ? "Hello, {$user_first_name}" : 'Hello';
											
										?></span>
										
									</span>
									<span class="user-drop-down">
									
										<ul class="user-menu"><?php
											
											if ( IS_WEBTIDE_MEMBER ) {
												?><li class="profile icon"><a href="<?php echo $site_url; ?>/members/profile/">Your Profile</a></li>
												<?php /*<li class="settings icon"><a href="#">Your Settings</a></li>*/ ?>
												<li class="directory icon"><a href="<?php echo $site_url; ?>/members/directory/">Member Directory</a></li><?php
											}
											
											// Anyone logged in needs to be able to log out
											?><li class="logout icon"><a href="<?php echo $logout_url; ?>">Logout</a></li>
										</ul>
									</span>
									
								</span>
							</li><?php
								
						}
						
						// If you're not signed in at all
						if ( ! ( IS_WEBTIDE_MEMBER || IS_MYBAMA_AUTHENTICATED ) ) {
							
							?><li class="sign-in dash cap"><a href="<?php echo $login_url; ?>">Sign In</a></li><?php
								
						}

					?></ul> <!-- #ua-webtide-banner-menu -->
					
				</div>
			</div>
			
		</div>
		
		<div class="header-main">
		
			<div class="row">
                <div class="small-12 columns inside"><?php

                   // On home page, have an <h1>
                    $webtide_name_tag = is_front_page() ? 'h1' : 'span';

                    ?><a class="ua-webtide-logo" href="<?php echo $site_url; ?>">
                        <img src="<?php echo $stylesheet_dir; ?>/images/wwWebTide-with-ua-wordmark.svg" alt="" />
                        <?php echo '<' . $webtide_name_tag . ' class="screen-reader-text">WebTide - The University of Alabama</' . $webtide_name_tag . '>'; ?>
                    </a>
					
					<div class="other-header-items">
						
						<div class="magnifying-glass toggle-main-search"></div>
						<a class="twitter logo" href="https://twitter.com/bamawebtide"><span>Follow WebTide on Twitter</span></a>
						<a class="github logo" href="https://github.com/bamawebtide"><span>Follow WebTide on GitHub</span></a><?php
						
						if ( $main_menu = wp_nav_menu( array(
							'theme_location'=> 'main-menu',
							'container'		=> false,
							'menu_id'		=> 'ua-webtide-main-menu',
							'menu_class'	=> false,
							'items_wrap'	=> '<ul id="%1$s">%3$s</ul>',
							'depth'			=> 1,
							'echo'			=> false,
							) ) ) {
								
							?><div id="ua-webtide-main-menu-wrapper">
								
								<div class="toggle-main-menu" data-toggle="ua-webtide-main-menu">
									<div class="toggle-icon">
										<div class="bar one"></div>
										<div class="bar two"></div>
										<div class="bar three"></div>
									</div>
									<div class="open-menu-label">Menu</div>
									<div class="close-menu-label">Close</div>
								</div><?php
									
								echo $main_menu;
									
							?></div> <!-- #ua-webtide-main-menu-wrapper --><?php
						
						}
						
					?></div> <!-- .other-header-items -->
					
				</div>
			</div>
			
		</div> <!-- .header-main --><?php
			
		// Get search $query
		$main_search_query = get_search_query();
		
		// Define the search placeholder text
		$search_placeholder_text = 'Search the site';
			
		// Search area
		?><div id="ua-webtide-main-search"<?php echo ! empty( $main_search_query ) ? ' class="is-active"' : NULL; ?>>
			
			<div class="row">
				<div class="small-12 columns">
					
					<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<label for="ua-webtide-main-search-field">
							<span class="screen-reader-text"><?php echo $search_placeholder_text; ?></span>
							<input id="ua-webtide-main-search-field" type="search" class="search-field" placeholder="<?php echo esc_attr( $search_placeholder_text . '&hellip;' ); ?>" value="<?php echo $main_search_query; ?>" autocomplete="off" name="s" title="<?php echo esc_attr( $search_placeholder_text ); ?>" />
						</label>
						<input id="ua-webtide-main-search-submit" type="submit" class="search-submit" value="<?php echo esc_attr( 'Search' ); ?>" />
						<div class="search-icon"></div> <!-- .search-icon -->
						<div class="close-search toggle-main-search"></div> <!-- .close-search -->
					</form>
					
				</div>
			</div>
		
		</div> <!-- #ua-webtide-main-search-wrapper --><?php
			
		// See if we have a member notification
		if ( $member_notification = get_ua_webtide_member_notification() ) {

			?><div class="header-member-notification">
				
				<div class="row">
					<div class="small-12 columns"><?php
						
						?><p class="i-for-information"><?php
							
							// Only show messages to those who are logged in
							if ( current_user_can( 'is_webtide_member' ) ) {
						
								// Print the notification
								echo $member_notification;
									
							} else {
								
								?><strong>There's a notification for WebTide members.</strong> Please <a href="<?php echo $login_url; ?>">sign in</a> to view the message.<?php
								
							}
							
						?></p>
					
					</div>
				</div>
				
			</div>  <!-- .header-member-notification --><?php
			
		}
		
	?></div> <!-- #ua-webtide-header --><?php
		
	// Do not include this on the home/front page
	if ( ! $is_front_page ) {
		
		// Get the title - checks 'page_header' post meta and then the post title
		$page_title = apply_filters( 'ua_webtide_main_header', isset( $post ) && isset( $post->ID ) ? ( ( $page_header = get_post_meta( $post->ID, 'page_header', true ) ) && ! empty( $page_header ) ? $page_header : get_the_title( $post->ID ) ) : NULL );
		
		if ( $page_title ) {
			
			?><div id="ua-webtide-main-header">
				<div class="row">
					<div class="small-12 columns">
						
						<h1 class="content-title"><?php echo $page_title; ?></h1><?php
							
						// Get the subheader
						if ( $page_subheader = apply_filters( 'ua_webtide_main_subheader', ( isset( $post ) && isset( $post->ID ) ) ? get_post_meta( $post->ID, 'page_subheader', true ) : NULL ) ) {
						
							// If the subheader is a certain length, decrease the side padding
							$page_subheader_length = strlen( strip_tags( $page_subheader ) );
							
							?><h2 class="content-subheader<?php echo $page_subheader_length > 120 ? ' long-subheader' : NULL; ?>"><?php echo $page_subheader; ?></h2><?php
								
						}
						
					?></div>
				</div>
			</div><?php
				
		}
		
		// Will be closed in the footer
		?><div id="ua-webtide-main"><?php
			
			// The <div> will be closed in the footer
			?><div class="row"><?php
				
				// What's our layout?
				$layout = apply_filters( 'ua_webtide_layout', 'left' );
				
				switch( $layout ) {
					
					case 'left':
				
						// The <div> will be closed in the footer
						?><div class="small-12 medium-8 medium-push-4 large-9 large-push-3 columns content has-sidebar has-left-sidebar"><?php
							
							// Print the loop
							ua_webtide_print_loop();
							
						break;
						
					case 'right':
					
						// The <div> will be closed in the footer
						?><div class="small-12 medium-8 large-9 columns content has-sidebar has-right-sidebar"><?php
							
							ua_webtide_print_loop();
					
						break;
						
					case 'full-width':
					default:
					
						// The <div> will be closed in the footer
						?><div class="small-12 columns"><?php
							
							// Print the loop
							ua_webtide_print_loop();
							
						break;
						
				}
				
	}