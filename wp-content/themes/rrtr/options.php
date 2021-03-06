<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {
	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	$options = array();

	// Header Options Area
	$options[] = array(
		'name' => __( 'Header', 'spacious' ),
		'type' => 'heading'
	);

	// Header Logo upload option
	$options[] = array(
		'name' 	=> __( 'Header Logo', 'spacious' ),
		'desc' 	=> __( 'Upload logo for your header.', 'spacious' ),
		'id' 		=> 'spacious_header_logo_image',
		'type' 	=> 'upload'
	);

	// Header logo and text display type option
	$header_display_array = array(
		'logo_only' 	=> __( 'Header Logo Only', 'spacious' ),
		'text_only' 	=> __( 'Header Text Only', 'spacious' ),
		'both' 	=> __( 'Show Both', 'spacious' ),
		'none'		 	=> __( 'Disable', 'spacious' )
	);
	$options[] = array(
		'name' 		=> __( 'Show', 'spacious' ),
		'desc' 		=> __( 'Choose the option that you want.', 'spacious' ),
		'id' 			=> 'spacious_show_header_logo_text',
		'std' 		=> 'text_only',
		'type' 		=> 'radio',
		'options' 	=> $header_display_array 
	);

	// Header Image replace postion
	$options[] = array(
		'name' => __( 'Need to replace Header Image?', 'spacious' ),
		'desc' => sprintf( __( '<a href="%1$s">Click Here</a>', 'spacious' ), admin_url('themes.php?page=custom-header') ),
		'type' => 'info'
	);

	// Header image position option
	$options[] = array(
		'name' 		=> __( 'Heder Image Position', 'spacious' ),
		'desc' 		=> __( 'Choose top header image display position.', 'spacious' ),
		'id' 			=> 'spacious_header_image_position',
		'std' 		=> 'above',
		'type' 		=> 'radio',
		'options' 	=> array(
							'above' => __( 'Position Above (Default): Display the Header image just above the site title and main menu part.', 'spacious' ),
							'below' => __( 'Position Below: Display the Header image just below the site title and main menu part.', 'spacious' )
						)

	);

	/*************************************************************************/

	$options[] = array(
		'name' => __( 'Design', 'spacious' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' 		=> __( 'Site Layout', 'spacious' ),
		'desc' 		=> __( 'Choose your site layout. The change is reflected in whole site.', 'spacious' ),
		'id' 			=> 'spacious_site_layout',
		'std' 		=> 'box_1218px',
		'type' 		=> 'radio',
		'options' 	=> array(
							'box_1218px' 	=> __( 'Boxed layout with content width of 1218px', 'spacious' ),
							'box_978px' 	=> __( 'Boxed layout with content width of 978px', 'spacious' ),
							'wide_1218px' 	=> __( 'Wide layout with content width of 1218px', 'spacious' ),
							'wide_978px' 	=> __( 'Wide layout with content width of 978px', 'spacious' ),
						)
	);

	$options[] = array(
		'name' 		=> __( 'Default layout', 'spacious' ),
		'desc' 		=> __( 'Select default layout. This layout will be reflected in whole site archives, search etc. The layout for a single post and page can be controlled from below options.', 'spacious' ),
		'id' 			=> 'spacious_default_layout',
		'std' 		=> 'right_sidebar',
		'type' 		=> 'images',
		'options' 	=> array(
								'right_sidebar' 	=> SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
								'left_sidebar' 		=> SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
								'no_sidebar_full_width'				=> SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
								'no_sidebar_content_centered'		=> SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
							)
	);

	$options[] = array(
		'name' 		=> __( 'Default layout for pages only', 'spacious' ),
		'desc' 		=> __( 'Select default layout for pages. This layout will be reflected in all pages unless unique layout is set for specific page.', 'spacious' ),
		'id' 			=> 'spacious_pages_default_layout',
		'std' 		=> 'right_sidebar',
		'type' 		=> 'images',
		'options' 	=> array(
								'right_sidebar' 	=> SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
								'left_sidebar' 		=> SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
								'no_sidebar_full_width'				=> SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
								'no_sidebar_content_centered'		=> SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
							)
	);

	$options[] = array(
		'name' 		=> __( 'Default layout for single posts only', 'spacious' ),
		'desc' 		=> __( 'Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post.', 'spacious' ),
		'id' 			=> 'spacious_single_posts_default_layout',
		'std' 		=> 'right_sidebar',
		'type' 		=> 'images',
		'options' 	=> array(
								'right_sidebar' 	=> SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
								'left_sidebar' 		=> SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
								'no_sidebar_full_width'				=> SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
								'no_sidebar_content_centered'		=> SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
							)
	);

	// Site primary color option
	$options[] = array(
		'name' 		=> __( 'Primary color option', 'spacious' ),
		'desc' 		=> __( 'This will reflect in links, buttons and many others. Choose a color to match your site.', 'spacious' ),
		'id' 			=> 'spacious_primary_color',
		'std' 		=> '#0FBE7C',
		'type' 		=> 'color' 
	);

	// Site dark light skin option
	//$options[] = array(
	//	'name' 		=> __( 'Color Skin', 'spacious' ),
	//	'desc' 		=> __( 'Choose the light or dark skin. This will be reflected in whole site.', 'spacious' ),
	//	'id' 			=> 'spacious_color_skin',
	//	'std' 		=> 'light',
	//	'type' 		=> 'images',
	//	'options' 	=> array(
	//						'light' 	=> SPACIOUS_ADMIN_IMAGES_URL . '/light-color.jpg',
	//						'dark' 	=> SPACIOUS_ADMIN_IMAGES_URL . '/dark-color.jpg'
	//					)
	//);	

	$options[] = array(
		'name' 		=> __( 'Need to replace default background?', 'spacious' ),
		'desc' 		=> sprintf( __( '<a href="%1$s">Click Here</a>', 'spacious' ), admin_url('themes.php?page=custom-background') ).'&nbsp;&nbsp;&nbsp;'.__( 'Note: The background will only be seen if you choose any of the boxed layout option in site layout option.', 'spacious' ),
		'type' 		=> 'info'
	);

	$options[] = array(
		'name' 		=> __( 'Custom CSS', 'spacious' ),
		'desc' 		=> __( 'Write your custom css.', 'spacious' ),
		'id' 			=> 'spacious_custom_css',
		'std' 		=> '',
		'type' 		=> 'textarea'
	);

	/*************************************************************************/

	$options[] = array(
		'name' => __( 'Additional', 'spacious' ),
		'type' => 'heading'
	);

	// Favicon activate option
	$options[] = array(
		'name' 		=> __( 'Activate favicon', 'spacious' ),
		'desc' 		=> __( 'Check to activate favicon. Upload fav icon from below option', 'spacious' ),
		'id' 			=> 'spacious_activate_favicon',
		'std' 		=> '0',
		'type' 		=> 'checkbox'
	);

	// Fav icon upload option
	$options[] = array(
		'name' 	=> __( 'Upload favicon', 'spacious' ),
		'desc' 	=> __( 'Upload favicon for your site.', 'spacious' ),
		'id' 		=> 'spacious_favicon',
		'type' 	=> 'upload'
	);

	

	return $options;
}

add_action( 'optionsframework_after','spacious_options_display_sidebar' );

/**
 * Spacious admin sidebar
 */
function spacious_options_display_sidebar() { ?>

<?php
}