<?php
/**
 * theme specific funtions
 */

/****************************************************************************************/

// =========================================================================
// REMOVE JUNK FROM WP_HEAD
// =========================================================================
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action('wp_head', 'feed_links', 2); // remove rss feed links (comment to re-enable an rss feed)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
// remove recent comments hardcode
add_action('widgets_init', 'my_remove_recent_comments_style');
function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
// =========================================================================
// REMOVE jQuery.migrate.js from header (no need, already loaded)
// =========================================================================
add_filter( 'wp_default_scripts', 'dequeue_jquery_migrate' );

function dequeue_jquery_migrate( &$scripts){
	if(!is_admin()){
		$scripts->remove( 'jquery');
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
	}
}



add_action( 'wp_enqueue_scripts', 'spacious_scripts_styles_method' );

// =========================================================================
// LOAD STYLESHEETS & SCRIPTS
// =========================================================================
function spacious_scripts_styles_method() {

	//wp_enqueue_style( 'spacious_style', get_stylesheet_uri() ); //removed main style.css and added it as a base file inside of sass main file (theme.scss)
	wp_enqueue_style( 'sass', get_template_directory_uri().'/assets/css/theme.css', '1.0.0', true );
	//wp_enqueue_style( 'animate', get_template_directory_uri().'/assets/css/animate.min.css', '1.0.0', true ); //accessible as sass vendor file

	if( of_get_option( 'spacious_color_skin', 'light' ) == 'dark' ) {
		wp_enqueue_style( 'spacious_dark_style', SPACIOUS_CSS_URL. '/dark.css' );
	}

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	//if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	//	wp_enqueue_script( 'comment-reply' );

	/**
	 * Register JQuery cycle js file for slider.
	 */
	wp_register_script( 'jquery_cycle', get_template_directory_uri().'/assets/js/jquery.cycle.all.min.js', array( 'jquery' ), '2.9999.5', true );
	//wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '1.0.0', true );
	
	/**
	 * Enqueue Slider setup js file.	 
	 */
	//if ( is_home() || is_front_page() && of_get_option( 'spacious_activate_slider', '0' ) == '1' ) {
	//	wp_enqueue_script( 'spacious_slider', SPACIOUS_JS_URL . '/spacious-slider-setting.js', array( 'jquery_cycle' ), false, true );
	//}
	//wp_enqueue_script( 'spacious-navigation', get_template_directory_uri().'/assets/js/navigation.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'spacious-navigation', get_template_directory_uri().'/assets/js/min/scripts-ck.js', array( 'jquery' ), false, true );
	//wp_enqueue_script( 'spacious-custom', SPACIOUS_JS_URL. '/spacious-custom.js', array( 'jquery' ) );

	//wp_enqueue_style( 'google_fonts' );

   $spacious_user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(preg_match('/(?i)msie [1-8]/',$spacious_user_agent)) {
		wp_enqueue_script( 'html5', SPACIOUS_JS_URL . '/html5.js', true ); 
	}

}

add_action( 'admin_print_styles-appearance_page_options-framework', 'spacious_admin_styles' );
/**
 * Enqueuing some styles.
 *
 * @uses wp_enqueue_style to register stylesheets.
 * @uses wp_enqueue_style to add styles.
 */
function spacious_admin_styles() {
	wp_enqueue_style( 'spacious_admin_style', SPACIOUS_ADMIN_CSS_URL. '/admin.css' );
}

/****************************************************************************************/

add_filter( 'excerpt_length', 'spacious_excerpt_length' );
/**
 * Sets the post excerpt length to 40 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function spacious_excerpt_length( $length ) {
	return 40;
}

add_filter( 'excerpt_more', 'spacious_continue_reading' );
/**
 * Returns a "Continue Reading" link for excerpts
 */
function spacious_continue_reading() {
	return '&hellip; ';
}

/****************************************************************************************/

/**
 * Removing the default style of wordpress gallery
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Filtering the size to be medium from thumbnail to be used in WordPress gallery as a default size
 */
function spacious_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts( array(
	'size' => 'medium',
	), $atts );

	$out['size'] = $atts['size'];
	 
	return $out;
 
}
add_filter( 'shortcode_atts_gallery', 'spacious_gallery_atts', 10, 3 );

/****************************************************************************************/

add_filter( 'body_class', 'spacious_body_class' );
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function spacious_body_class( $classes ) {
	global $post;

	if( $post ) { $layout_meta = get_post_meta( $post->ID, 'spacious_page_layout', true ); }

	if( empty( $layout_meta ) || is_archive() || is_search() || is_home() ) { $layout_meta = 'default_layout'; }
	$spacious_default_layout = of_get_option( 'spacious_default_layout', 'right_sidebar' );

	$spacious_default_page_layout = of_get_option( 'spacious_pages_default_layout', 'right_sidebar' );
	$spacious_default_post_layout = of_get_option( 'spacious_single_posts_default_layout', 'right_sidebar' );

	if( $layout_meta == 'default_layout' ) {
		if( is_page() ) {
			if( $spacious_default_page_layout == 'right_sidebar' ) { $classes[] = ''; }
			elseif( $spacious_default_page_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
			elseif( $spacious_default_page_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
			elseif( $spacious_default_page_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
		}
		elseif( is_single() ) {
			if( $spacious_default_post_layout == 'right_sidebar' ) { $classes[] = ''; }
			elseif( $spacious_default_post_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
			elseif( $spacious_default_post_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
			elseif( $spacious_default_post_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
		}
		elseif( $spacious_default_layout == 'right_sidebar' ) { $classes[] = ''; }
		elseif( $spacious_default_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
		elseif( $spacious_default_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
		elseif( $spacious_default_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
	}
	elseif( $layout_meta == 'right_sidebar' ) { $classes[] = ''; }
	elseif( $layout_meta == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
	elseif( $layout_meta == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
	elseif( $layout_meta == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }


	if( is_page_template( 'page-templates/blog-image-alternate-medium.php' ) ) {
		$classes[] = 'blog-alternate-medium';
	}
	if( is_page_template( 'page-templates/blog-image-medium.php' ) ) {
		$classes[] = 'blog-medium';
	}
	if( of_get_option( 'spacious_site_layout', 'box_1218px' ) == 'wide_978px' ) {
		$classes[] = 'wide-978';
	}
	elseif( of_get_option( 'spacious_site_layout', 'box_1218px' ) == 'box_978px' ) {
		$classes[] = 'narrow-978';
	}
	elseif( of_get_option( 'spacious_site_layout', 'box_1218px' ) == 'wide_1218px' ) {
		$classes[] = 'wide-1218';
	}
	else {
		$classes[] = '';
	}

	return $classes;
}

/****************************************************************************************/

if ( ! function_exists( 'spacious_sidebar_select' ) ) :
/**
 * Fucntion to select the sidebar
 */
function spacious_sidebar_select() {
	global $post;

	if( $post ) { $layout_meta = get_post_meta( $post->ID, 'spacious_page_layout', true ); }

	if( empty( $layout_meta ) || is_archive() || is_search() || is_home() ) { $layout_meta = 'default_layout'; }
	$spacious_default_layout = of_get_option( 'spacious_default_layout', 'right_sidebar' );

	$spacious_default_page_layout = of_get_option( 'spacious_pages_default_layout', 'right_sidebar' );
	$spacious_default_post_layout = of_get_option( 'spacious_single_posts_default_layout', 'right_sidebar' );

	if( $layout_meta == 'default_layout' ) {
		if( is_page() ) {
			if( $spacious_default_page_layout == 'right_sidebar' ) { get_sidebar(); }
			elseif ( $spacious_default_page_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
		}
		if( is_single() ) {
			if( $spacious_default_post_layout == 'right_sidebar' ) { get_sidebar(); }
			elseif ( $spacious_default_post_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
		}
		elseif( $spacious_default_layout == 'right_sidebar' ) { get_sidebar(); }
		elseif ( $spacious_default_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
	}
	elseif( $layout_meta == 'right_sidebar' ) { get_sidebar(); }
	elseif( $layout_meta == 'left_sidebar' ) { get_sidebar( 'left' ); }
}
endif;

/****************************************************************************************/

add_action( 'admin_head', 'spacious_favicon' );
add_action( 'wp_head', 'spacious_favicon' );
/**
 * Fav icon for the site
 */
function spacious_favicon() {
	if ( of_get_option( 'spacious_activate_favicon', '0' ) == '1' ) {
		$spacious_favicon = of_get_option( 'spacious_favicon', '' );
		$spacious_favicon_output = '';
		if ( !empty( $spacious_favicon ) ) {
			$spacious_favicon_output .= '<link rel="shortcut icon" href="'.esc_url( $spacious_favicon ).'" type="image/x-icon" />';
		}
		echo $spacious_favicon_output;
	}
}
/**************************************************************************************/


if ( ! function_exists( 'spacious_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function spacious_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'spacious' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'spacious' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'spacious' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'spacious' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'spacious' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // spacious_content_nav

/**************************************************************************************/

if ( ! function_exists( 'spacious_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function spacious_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'spacious' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'spacious' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 74 );
					printf( '<div class="comment-author-link">%1$s%2$s</div>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'spacious' ) . '</span>' : ''
					);
					printf( '<div class="comment-date-time">%1$s</div>',
						sprintf( __( '%1$s at %2$s', 'spacious' ), get_comment_date(), get_comment_time() )
					);
					printf( __( '<a class="comment-permalink" href="%1$s">Permalink</a>', 'spacious'), esc_url( get_comment_link( $comment->comment_ID ) ) );
					edit_comment_link();
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'spacious' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'spacious' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</section><!-- .comment-content -->
			
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

/**************************************************************************************/

/* Register shortcodes. */
add_action( 'init', 'spacious_add_shortcodes' );
/**
 * Creates new shortcodes for use in any shortcode-ready area.  This function uses the add_shortcode() 
 * function to register new shortcodes with WordPress.
 *
 * @uses add_shortcode() to create new shortcodes.
 */
function spacious_add_shortcodes() {
	/* Add theme-specific shortcodes. */
	add_shortcode( 'the-year', 'spacious_the_year_shortcode' );
	add_shortcode( 'site-link', 'spacious_site_link_shortcode' );
	add_shortcode( 'wp-link', 'spacious_wp_link_shortcode' );
	add_shortcode( 'tg-link', 'spacious_themegrill_link_shortcode' );
}

/**
 * Shortcode to display the current year.
 *
 * @uses date() Gets the current year.
 * @return string
 */
function spacious_the_year_shortcode() {
   return date( 'Y' );
}

/**
 * Shortcode to display a link back to the site.
 *
 * @uses get_bloginfo() Gets the site link
 * @return string
 */
function spacious_site_link_shortcode() {
   return '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';
}

/**
 * Shortcode to display a link to WordPress.org.
 *
 * @return string
 */
function spacious_wp_link_shortcode() {
   return '<a href="'.esc_url( 'http://wordpress.org' ).'" target="_blank" title="' . esc_attr__( 'WordPress', 'spacious' ) . '"><span>' . __( 'WordPress', 'spacious' ) . '</span></a>';
}

/**
 * Shortcode to display a link to spacious.com.
 *
 * @return string
 */
function spacious_themegrill_link_shortcode() {
   return '<a href="'.esc_url( 'http://themegrill.com' ).'" target="_blank" title="'.esc_attr__( 'ThemeGrill', 'spacious' ).'" ><span>'.__( 'ThemeGrill', 'spacious') .'</span></a>';
}

add_action( 'spacious_footer_copyright', 'spacious_footer_copyright', 10 );
/**
 * function to show the footer info, copyright information
 */
if ( ! function_exists( 'spacious_footer_copyright' ) ) :
function spacious_footer_copyright() {
	$spacious_footer_copyright = '<div class="copyright">'.__( 'Copyright &copy; ', 'spacious' ).'[the-year] [site-link] '.__( 'Theme by: ', 'spacious' ).'[tg-link] '.__( 'Powered by: ', 'spacious' ).'[wp-link]'.'</div>';
	echo do_shortcode( $spacious_footer_copyright );
}
endif;


// ================================================================================
// Add "is_tree" support for all page children and it's ancestors a few levels deep
// ================================================================================
function is_tree($pid)
{
  global $post;

  $ancestors = get_post_ancestors($post->$pid);
  $root = count($ancestors) - 1;
  $parent = $ancestors[$root];

  if(is_page() && (is_page($pid) || $post->post_parent == $pid || in_array($pid, $ancestors)))
  {
    return true;
  }
  else
  {
    return false;
  }
};

/**************************************************************************************/
?>