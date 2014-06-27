<?php
/**
 * The Sidebar containing the main widget areas.
 */
?>

<div id="secondary">
	<?php do_action( 'spacious_before_sidebar' ); ?>
		<?php 
			if( is_page_template( 'page-templates/contact.php' ) ) {
				$sidebar = 'spacious_contact_page_sidebar';
			}
			else {
				$sidebar = 'spacious_right_sidebar';
			}
		?>

		<?php if ( ! dynamic_sidebar( $sidebar ) ) : ?>

		<?php endif; ?>
	<?php do_action( 'spacious_after_sidebar' ); ?>
</div>