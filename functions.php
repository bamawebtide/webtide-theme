<?php

//! Add theme supports
add_action( 'after_setup_theme', 'ua_webtide_add_theme_supports' );
function ua_webtide_add_theme_supports() {
	
	// Add support for the title tag
	add_theme_support( 'title-tag' );
	
}

//! Register menus
register_nav_menus( array(
	'main-menu' => 'Main Menu',
) );

//! Register sidebars
add_action( 'wp', 'ua_webtide_register_sidebars' );
function ua_webtide_register_sidebars() {
	global $next_webtide_meeting_html;

	// Do we need to tweak the columns?
	$next_webtide_meeting_html = null;
	$home_page_columns = null;

	// Tweak on the front page
	if ( is_front_page() ) {

	    // Get the next meeting HTML
	    $next_webtide_meeting_html = ua_webtide_get_next_monthly_meeting_html( array( 'include_excerpt' => false, 'include_button' => true, 'view_details' => false ) );

        // Tweak the columns
	    if ( IS_WEBTIDE_MEMBER && $next_webtide_meeting_html ) {
	        $home_page_columns = ' large-pull-4';
	    }

	}
	
	// Register the home page content area
    register_sidebar( array(
        'name'			=> 'Home Page Featured Content',
        'id'			=> 'home-page-featured-content',
        'description'	=> 'Widgets in this area will be shown in the home page featured content area.',
        'before_widget'	=> '<div class="small-12 medium-12 large-4' . $home_page_columns . ' columns">', // We don't mess with the col order for non-members
        'after_widget'  => '</div>',
        'before_title'	=> '<h2>',
        'after_title'	=> '</h2>',
    ) );
    
    // Register the main/default sidebar
    register_sidebar( array(
        'name'			=> 'Main Sidebar',
        'id'			=> 'main',
        'description'	=> 'Widgets in this area will be shown by default.',
        'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'	=> '<h3 class="widget-title">',
        'after_title'	=> '</h3>',
    ) );
    
    // Register the who we are sidebar
    register_sidebar( array(
        'name'			=> 'Who We Are Sidebar',
        'id'			=> 'who-we-are-page',
        'description'	=> 'Widgets in this area will be shown on the "Who We Are" page.',
        'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'	=> '<h3 class="widget-title">',
        'after_title'	=> '</h3>',
    ) );
    
    // Register the how to join sidebar
    register_sidebar( array(
        'name'			=> 'How To Join Sidebar',
        'id'			=> 'how-to-join-page',
        'description'	=> 'Widgets in this area will be shown on the "How To Join" page.',
        'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'	=> '<h3 class="widget-title">',
        'after_title'	=> '</h3>',
    ) );
    
    // Register the jobs sidebar
    register_sidebar( array(
        'name'			=> 'Jobs Sidebar',
        'id'			=> 'jobs-page',
        'description'	=> 'Widgets in this area will be shown on the jobs page.',
        'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'	=> '<h3 class="widget-title">',
        'after_title'	=> '</h3>',
    ) );

    // Register the visual identity sidebar
    register_sidebar( array(
        'name'			=> 'NEW Visual Identity Pres Sidebar',
        'id'			=> 'new-visual-identity-page',
        'description'	=> 'Widgets in this area will be shown on the visual identity standards presentation page.',
        'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'	=> '<h3 class="widget-title">',
        'after_title'	=> '</h3>',
    ) );
    
    // Register the main calendar page sidebar
    register_sidebar( array(
        'name'			=> 'Calendar Sidebar',
        'id'			=> 'calendar',
        'description'	=> 'Widgets in this area will be shown on the main calendar page.',
        'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'	=> '<h3 class="widget-title">',
        'after_title'	=> '</h3>',
    ) );
    
    // Register the resources sidebar
    register_sidebar( array(
        'name'			=> 'Resources Sidebar',
        'id'			=> 'resources',
        'description'	=> 'Widgets in this area will be shown on the resources page(s).',
        'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'	=> '<h3 class="widget-title">',
        'after_title'	=> '</h3>',
    ) );
    
    // Register the "Your Profile" sidebar
    register_sidebar( array(
        'name'			=> 'Members Sidebar',
        'id'			=> 'members',
        'description'	=> 'Widgets in this area will be shown on the members pages.',
        'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'	=> '<h3 class="widget-title">',
        'after_title'	=> '</h3>',
    ) );
    
    // Register the "Contact Us" sidebar
    register_sidebar( array(
        'name'			=> 'Contact Us Sidebar',
        'id'			=> 'contact',
        'description'	=> 'Widgets in this area will be shown on the contact page.',
        'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'	=> '<h3 class="widget-title">',
        'after_title'	=> '</h3>',
    ) );
    
}

//! Add Favicon To <head>s
add_action( 'wp_head', 'ua_webtide_add_favicons' );
add_action( 'admin_head', 'ua_webtide_add_favicons' );
add_action( 'login_head', 'ua_webtide_add_favicons' );
function ua_webtide_add_favicons() {
	
	// Set the images folder
	$images_folder = get_stylesheet_directory_uri() . '/images/ua-icons/';
	
	// Include the favicons
	?><link rel="shortcut icon" href="<?php echo $images_folder; ?>icon-touch-iphone.png">
	<link rel="apple-touch-icon" href="<?php echo $images_folder; ?>icon-touch-iphone.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $images_folder; ?>icon-touch-ipad.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $images_folder; ?>icon-touch-iphone-2x.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $images_folder; ?>icon-touch-ipad-2x.png"><?php
		
}

//! Add site styles and scripts
add_action( 'wp_enqueue_scripts', 'ua_webtide_enqueue_styles_and_scripts', 10000 );
function ua_webtide_enqueue_styles_and_scripts() {
	global $post;
	
	// Register our fonts
	// Other considered fonts: Comfortaa
	wp_enqueue_style( 'ua-webtide-fonts', 'https://fonts.googleapis.com/css?family=Ubuntu:400|Open+Sans:300,300italic,400,400italic,600,600italic,700', array(), NULL );
	
	// Enqueue our main stylesheet
	wp_enqueue_style( 'ua-webtide', get_stylesheet_directory_uri() . '/css/styles.min.css', array( 'ua-webtide-fonts' ), NULL );
	
	// Register modernizr - goes in header
    wp_register_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js' );
	
	// Enqueue our main script
	wp_enqueue_script( 'ua-webtide', get_stylesheet_directory_uri() . '/js/ua-webtide-main.min.js', array( 'jquery', 'modernizr' ), NULL );
	
	// If we're looking at resources, enqueue the resources styles
	if ( is_archive( 'resources' ) || is_singular( 'resources' ) ) {
		
		wp_enqueue_style( 'ua-webtide-resources', get_stylesheet_directory_uri() . '/css/resources.min.css', array( 'ua-webtide' ), NULL );
		
	}	
	
	// If we're looking at events, enqueue the events styles
	if ( 'tribe_events' == get_query_var( 'post_type' ) || is_post_type_archive( 'tribe_events' ) || is_tax( 'tribe_events_cat' ) || is_singular( 'tribe_events' ) ) {
		
		wp_enqueue_style( 'ua-webtide-tribe-events', get_stylesheet_directory_uri() . '/css/tribe-events.min.css', array( 'ua-webtide', 'tribe-events-full-calendar-style' ), NULL );
		
	}
	
}

//! Print the loop
function ua_webtide_print_loop() {
	global $post;
		
	// Run an action before the loop
	do_action( 'ua_webtide_before_the_loop' );
	
	if ( IS_WEBTIDE_MEMBERS_ONLY_PAGE ) {
		print_ua_webtide_breadcrumbs( array( 'container_id' => 'ua-webtide-breadcrumbs' ) );
	}
	
	// Do we run the loop?
	if ( apply_filters( 'ua_webtide_run_the_loop', true ) ) {
	
		// Is this the search page?
		$is_search = is_search();
		
		// Is this an archive page?
		$is_archive = $is_search || is_archive();
		
		if ( ! have_posts() ) :
		
			// Run an action before no posts
			do_action( 'ua_webtide_before_the_loop_no_posts' );
			
			// Print no posts message
			echo apply_filters( 'ua_webtide_loop_no_posts', '<p class="no-posts">There are no posts.</p>' );
		
			// Run an action after no posts
			do_action( 'ua_webtide_after_the_loop_no_posts' );
			
		else :
			
			while ( have_posts() ) :
				the_post();
				
				// Get the post type
				$post_type = get_post_type( $post );
				
				// What's the title wrap?
				$title_wrap = $is_archive ? 'h2' : 'h1';
				
				// Classes to add to post class
				$add_to_post_class = array( 'webtide-loop' );
				
				// Add an archive class
				if ( $is_archive )
					$add_to_post_class[] = 'post-in-archive-list';
						
				?><div <?php post_class( $add_to_post_class ); ?>><?php
					
					// Only print for archives
					if ( $is_archive ) {
					
						?><<?php echo $title_wrap; ?> class="post-title"><?php
						
							// Run an action before the title
							do_action( 'ua_webtide_loop_before_the_title', $post );
						
							// Print the title
							if ( $is_archive ) {
								
								?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php
							
							} else {
								
								the_title();
							
							}
							
						?></<?php echo $title_wrap; ?>><?php
							
					}
						
					// Run an action after the title
					do_action( 'ua_webtide_loop_after_the_title', $post );
					
					// Run an action before the content
					do_action( 'ua_webtide_loop_before_the_content', $post );
					
					if ( apply_filters( 'ua_webtide_loop_show_the_content', true ) ) {
						
						// If archive, print the excerpt
						if ( $is_archive )
							the_excerpt();
						else
							the_content();
							
					}
					
					// Run an action after the content
					do_action( 'ua_webtide_loop_after_the_content', $post );
					
				?></div><?php
				
			endwhile;
			
		endif;
			
	}
	
	// Run an action after the loop
	do_action( 'ua_webtide_after_the_loop' );
	
}	

//! Print the sidebar
function ua_webtide_print_sidebar( $sidebar_id = NULL ) {
	
	// What sidebar do we show?
	$sidebar_id = 'main';
	
	// Define another sidebar
	if ( IS_WEBTIDE_MEMBERS_ONLY_PAGE ) {
		$sidebar_id = 'members';
	} else if ( is_page( 'submit-a-job' ) ) {
		$sidebar_id = 'jobs-page';
	} else if ( is_page( 'who-we-are' ) ) {
		$sidebar_id = 'who-we-are-page';
	} else if ( is_page( 'how-to-join' ) ) {
		$sidebar_id = 'how-to-join-page';
	} else if ( is_page( 'contact' ) ) {
		$sidebar_id = 'contact';
	}
		
	// Filter the ID
	$sidebar_id = apply_filters( 'ua_webtide_left_sidebar_id', $sidebar_id );
	
	do_action( 'ua_webtide_before_sidebar', $sidebar_id );
	
	// If our selected sidebar is active...
	if ( is_active_sidebar( $sidebar_id ) ) {
		
		// Print the sidebar items
		dynamic_sidebar( $sidebar_id );
		
	}
	
	do_action( 'ua_webtide_after_sidebar', $sidebar_id );
		
}

//! Print breadcrumbs
function print_ua_webtide_breadcrumbs( $args = array() ) {
	
	// Setup args
	$defaults = array(
		'echo'				=> true,
		'container_id' 		=> NULL,
		'container_class'	=> NULL,
	);
	$args= wp_parse_args( $args, $defaults );

	// Build print of breadcrumbs
	$print_breadcrumbs = NULL;
	
	// Get breadcrumbs
    if ( $breadcrumbs = get_ua_webtide_breadcrumbs() ) {
	    
	    // Start building <ul>
	    $print_breadcrumbs = '<ul';
	    
	    	// Add ID
	    	if ( isset( $args[ 'container_id' ] ) && ! empty( $args[ 'container_id' ] ) ) {
	    		$print_breadcrumbs .= ' id="' . $args[ 'container_id' ] . '"';
	    	}
	    		
	    	// Add class
	    	if ( isset( $args[ 'container_class' ] ) && ! empty( $args[ 'container_class' ] ) ) {
	    		$print_breadcrumbs .= ' class="' . $args[ 'container_class' ] . '"';
	    	}
	    
	    $print_breadcrumbs .= '>';
	    
	    	foreach( $breadcrumbs as $crumb ) {
		    	
		    	// Make sure its an object
		    	if ( ! is_object( $crumb ) )
		    		$crumb = (object) $crumb;
	
	            // Make sure we have a URL and a label
	            if ( isset( $crumb->url ) && ! empty( $crumb->url )
	                && isset( $crumb->label ) && ! empty( $crumb->label ) ) {
	
	                $print_breadcrumbs .= '<li';
	
	                    // Is current crumb
	                    if ( ( isset( $crumb->current ) && $crumb->current ) || ( isset( $crumb->ID ) && isset( $post->ID ) && $crumb->ID == $post->ID ) )
	                        $print_breadcrumbs .= ' class="current"';
	
	                $print_breadcrumbs .= '><a href="' . $crumb->url . '">' . wp_trim_words( $crumb->label, 10 ) . '</a></li>';
	
	            }
	
	        }
	        
	    $print_breadcrumbs .= '</ul>';
	    
	}

	if ( ! $args[ 'echo' ] ) {
		return $print_breadcrumbs;
	}
	
	echo $print_breadcrumbs;    
    
}

//! Get breadcrumbs
function get_ua_webtide_breadcrumbs() {
    global $post;

    // Build array of breadcrumbs
    $breadcrumbs = array();

    // Add home
    $breadcrumbs[] = (object) array(
        'url'   => get_bloginfo( 'url' ),
        'label' => 'Home',
    );

    // For archive pages
    if ( is_post_type_archive() && ( $post_type = get_query_var( 'post_type' ) ) ) {
	    
	    $breadcrumbs[] = (object) array(
            'url'       => get_post_type_archive_link( $post_type ),
            'label'     => post_type_archive_title( NULL, false ),
            'current'   => true,
        );
		
	// For archive pages
    } else if ( is_archive() ) {

        if ( is_category()
            && ( $term_label = single_term_title( NULL, false ) )
            && ( $category_url = get_category_link( get_cat_ID( $term_label ) ) ) ) {

            $breadcrumbs[] = (object) array(
                'url'       => $category_url,
                'label'     => $term_label,
                'current'   => true,
            );

        } else if ( is_day() ) {
            
            $breadcrumbs[] = (object) array(
                'url'       => get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ),
                'label'     => get_the_date( 'F j, Y' ),
                'current'   => true,
            );

        } else if ( is_month() ) {

            $breadcrumbs[] = (object) array(
                'url'       => get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ),
                'label'     => get_the_date( 'F Y' ),
                'current'   => true,
            );

        } else if ( is_year() ) {

            $breadcrumbs[] = (object) array(
                'url'       => get_year_link( get_the_time( 'Y' ) ),
                'label'     => get_the_date( 'Y' ),
                'current'   => true,
            );

        }

	} 
    
    // For search pages
    if ( is_search() ) {

        $breadcrumbs[] = (object) array(
            'url'       => get_search_link(),
            'label'     => 'Search Results',
            'current'   => true,
        );

	// Build crumbs around current page
    } else if ( is_singular() && isset( $post ) && ( $post_type = $post->post_type ) ) {
	    
        // If not a "page", then try to get archive
        if ( 'page' != $post_type ) {
	        
	      	// If archive exists, add archive
            if ( $post_type_archive_url = get_post_type_archive_link( $post_type ) ) {
	            
	            // Get the post type archive title
	            $post_type_obj = get_post_type_object( $post_type );

				// Filter the post type archive title.
				$post_type_archive_title = apply_filters( 'post_type_archive_title', $post_type_obj->labels->name, $post_type );
	            
	            $breadcrumbs[] = (object) array(
                    'url'   => $post_type_archive_url,
                    'label' => $post_type_archive_title,
                );

            }

            // If page with archive slug exists, add page
            else if ( ( $post_type_object = get_post_type_object( $post_type ) )
                && isset( $post_type_object->rewrite )
                && isset( $post_type_object->rewrite[ 'slug' ] )
                && ( $post_type_page = get_page_by_path( $post_type_object->rewrite[ 'slug' ] ) ) ) {

                $breadcrumbs[] = (object) array(
                    'ID'    => $post_type_page->ID,
                    'url'   => get_permalink( $post_type_page ),
                    'label' => get_the_title( $post_type_page->ID )
                );

            }

        }

        // Get parent
        if ( isset( $post->post_parent ) && $post->post_parent > 0 ) {

            // Set the parent ID
            $bc_parent = $post->post_parent;

            // Create array of parent crumbs
            $bc_parents = array();

            // Recursive loop to get all parents
            while ( $bc_parent > 0 ) {

                $bc_parents[] = (object) array(
                    'ID'	=> $bc_parent,
                    'url'	=> get_permalink( $bc_parent ),
                    'label'	=> get_the_title( $bc_parent ),
                );

                $bc_parent = get_post( $bc_parent );
                $bc_parent = $bc_parent->post_parent;

            }

            if ( ! empty( $bc_parents ) ) {

                // Reverse order and add to crumbs
                $bc_parents = array_reverse( $bc_parents );
                $breadcrumbs = array_merge( $breadcrumbs, $bc_parents );

            }

        }

        // Add current page
        $breadcrumbs[] = (object) array(
            'ID'        => $post->ID,
            'url'       => get_permalink( $post ),
            'label'     => get_the_title( $post->ID ),
            'current'   => true
        );

    }
    
    return apply_filters( 'ua_webtide_breadcrumbs', $breadcrumbs, $post );

}