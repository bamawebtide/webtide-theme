<?php
	
/*
 * Template Name: WebTide - Member Directory
 */
 
// Set the layout
add_filter( 'ua_webtide_layout', 'ua_webtide_directory_set_layout' );
function ua_webtide_directory_set_layout( $layout ) {
	return 'full-width';
}
 
// Hide any set content
add_filter( 'ua_webtide_loop_show_the_content', 'ua_webtide_directory_dont_show_content' );
function ua_webtide_directory_dont_show_content( $show_the_content ) {
	return false;
}

// Create the content
add_filter( 'ua_webtide_loop_before_the_content', 'ua_webtide_filter_directory_before_the_content' );
function ua_webtide_filter_directory_before_the_content() {
	global $ua_mybama_cas_auth;
	
	// The directory is only for WebTide Members
	if ( ! current_user_can( 'is_webtide_member' ) ) {
		
		?><p>The member directory is for WebTide members only. <a href="<?php echo $ua_mybama_cas_auth->get_login_url(); ?>">Login</a></p><?php
			
	} else {
		
		// Get hold WebTide members
		$webtide_members = get_webtide_members();
			
		if ( ! $webtide_members ) {
			
			?><p><em>There are no WebTide members to display.</em></p><?php
				
		} else {
			
			?><table class="webtide-members-listing">
				<thead>
					<tr>
						<th></th>
						<th>Name</th>
						<th>Position</th>
						<th>Department</th>
						<th>College</th>
						<th>Phone</th>
						<th>Website</th>
						<th>Twitter</th>
						<th>GitHub</th>
					</tr>
				</thead>
				<tbody><?php
					
					foreach( $webtide_members as $member ) {
						
						// Make sure we have user data
						if ( ! ( $userdata = isset( $member->data ) ? $member->data : NULL ) ) {
							continue;
						}
							
						// Make sure we have a display name
						if ( ! ( $display_name = isset( $userdata->display_name ) ? $userdata->display_name : NULL ) ) {
							continue;
						}
							
						// Get user email
						$user_email = isset( $userdata->user_email ) && ! empty( $userdata->user_email ) ? $userdata->user_email : NULL;
							
						?><tr>
							<td class="avatar"><?php
								
								echo get_avatar( $user_email, 22 );
								
							?></td>
							<td class="name"><?php
								
								if ( $user_email ) {
									
									?><a class="email" href="mailto:<?php echo $user_email; ?>"><img class="email-icon" alt="Send an email to <?php echo $display_name; ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/webtide-envelope.svg" /> <span><?php echo $display_name; ?></span></a><?php
										
								} else
									echo $display_name;
								
							?></td>
							<td class="job-title"><?php
								
								// Get job title
								echo ( $user_job_title = get_user_meta( $member->ID, 'webtide_job_title', true ) ) ? $user_job_title : NULL;
								
							?></td>
							<td class="department"><?php
								
								// Get department
								echo ( $user_department = get_user_meta( $member->ID, 'webtide_department', true ) ) ? $user_department : NULL;
								
							?></td>
							<td class="college"><?php
								
								// Get college
								echo ( $user_college = get_user_meta( $member->ID, 'webtide_college', true ) ) ? $user_college : NULL;
								
							?></td>
							<td class="phone"><?php
								
								// Get office phone
								if ( $user_office_phone = get_user_meta( $member->ID, 'webtide_office_phone', true ) ) {
								
									// Remove area code
									$user_office_phone = preg_replace( '/^(\+1)?\s?\(?205\)?\s?/i', '', $user_office_phone );
									
									// Remove prefix
									$user_office_phone = preg_replace( '/^34(7|8)(\-|\s)/i', '\1-', $user_office_phone );
									
									// Print phone
									echo $user_office_phone;
										
								}
								
							?></td>
							<td class="website"><?php
								
								// Get website
								if ( isset( $userdata->user_url ) && ! empty( $userdata->user_url ) ) {
									
									?><a href="<?php echo $userdata->user_url; ?>">Website</a><?php
										
								}
								
							?></td>
							<td class="twitter"><?php
								
								// Get twitter
								if ( $user_twitter = get_user_meta( $member->ID, 'webtide_twitter', true ) ) {
									
									?><a href="https://twitter.com/<?php echo $user_twitter; ?>">@<?php echo $user_twitter; ?></a><?php	
									
								}	
								
							?></td>
							<td class="github"><?php
								
								// Get github
								if ( $user_github = get_user_meta( $member->ID, 'webtide_github', true ) ) {
									
									?><a href="https://github.com/<?php echo $user_github; ?>"><?php echo $user_github; ?></a><?php	
									
								}	
								
							?></td>
						</tr><?php
						
					}
				
				?></tbody>
			</table><?php
				
		}
			
	}	
	
}

get_header();

get_footer();