<?php 
/**
 * Theme Header.php
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8">
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="HandheldFriendly" content="True" />
<meta name="MobileOptimized" content="320" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php	do_action( 'before' ); ?>
<div id="page" class="hfeed site">
	<?php do_action( 'spacious_before_header' ); ?>
	<header id="masthead" class="site-header clearfix">
		
		<?php if( of_get_option( 'spacious_header_image_position', 'above' ) == 'above' ) { spacious_render_header_image(); } ?>

		<div id="header-text-nav-container">
			<div class="inner-wrap">
				
				<div id="header-text-nav-wrap" class="clearfix">
					<div id="header-left-section">
						<?php 
						if( ( of_get_option( 'spacious_show_header_logo_text', 'text_only' ) == 'both' || of_get_option( 'spacious_show_header_logo_text', 'text_only' ) == 'logo_only' ) && of_get_option( 'spacious_header_logo_image', '' ) != '' ) {
						?>
							<div id="header-logo-image">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo of_get_option( 'spacious_header_logo_image', '' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
							</div><!-- #header-logo-image -->
						<?php
						}

						if( of_get_option( 'spacious_show_header_logo_text', 'text_only' ) == 'both' || of_get_option( 'spacious_show_header_logo_text', 'text_only' ) == 'text_only' ) {
						?>
						<div id="header-text">
							<h1 id="site-title"> 
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h1>
							<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2><!-- #site-description -->
						</div><!-- #header-text -->
						<?php
						}
						?>
					</div><!-- #header-left-section -->
					<div id="header-right-section">
						<?php
						if( is_active_sidebar( 'spacious_header_sidebar' ) ) {
						?>								
						<div id="header-right-sidebar" class="clearfix">
						<?php
							// Calling the header sidebar if it exists.
							if ( !dynamic_sidebar( 'spacious_header_sidebar' ) ):
							endif;
						?>		
						</div>
						<?php
						}
						?>
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<h1 class="menu-toggle"><?php _e( 'Menu', 'spacious' ); ?></h1>
							<?php
								if ( has_nav_menu( 'primary' ) ) {									
									wp_nav_menu( array( 'theme_location' => 'primary' ) );
								}
								else {
									wp_page_menu();
								}
							?>
						</nav>					
			    	</div><!-- #header-right-section --> 
			    	
			   </div><!-- #header-text-nav-wrap -->
			</div><!-- .inner-wrap -->
		</div><!-- #header-text-nav-container -->

		<?php if( of_get_option( 'spacious_header_image_position', 'above' ) == 'below' ) { spacious_render_header_image(); } ?>

		<?php
   	if( of_get_option( 'spacious_activate_slider', '0' ) == '1' ) {
			if ( is_home() || is_front_page() ) {
   			spacious_featured_image_slider();
			}
   	}

		if( ( '' != spacious_header_title() )  && !( is_home() || is_front_page() ) ) {
		?>
		<div class="header-post-title-container clearfix">
			<div class="inner-wrap">
				<div class="post-title-wrapper">
					<?php 
					if( '' != spacious_header_title() ) {
					?>
				   
				   <?php
					}
					?>
				</div>
				<?php if( function_exists( 'spacious_breadcrumb' ) ) { spacious_breadcrumb(); } ?>
			</div>
		</div>
		<?php
	   }
	   ?>
	</header>
	<?php do_action( 'spacious_after_header' ); ?>
	<?php do_action( 'spacious_before_main' ); ?>
	<?php if ( is_page( '22' ) ){  // if is homepage ?>
	<div id="main" class="clearfix">
	<?php } else { //  ?>
	<div id="main" class="clearfix forpage">
	<?php } ?>
		<div class="inner-wrap">
		
		
		
		