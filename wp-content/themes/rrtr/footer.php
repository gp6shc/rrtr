<?php 
/**
 * Theme Footer Section for our theme.
 * 
 * Displays all of the footer section and closing of the #main div.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
?>

		</div><!-- .inner-wrap -->
	</div><!-- #main -->	
	<?php do_action( 'spacious_before_footer' ); ?>
		<footer id="colophon" class="clearfix">	
			<?php get_sidebar( 'footer' ); ?>	
			<div class="footer-socket-wrapper clearfix">
				<div class="inner-wrap">
					<div class="footer-socket-area">
						<nav class="small-menu" class="clearfix">
							<?php
								if ( has_nav_menu( 'footer' ) ) {									
										wp_nav_menu( array( 'theme_location' => 'footer',
																 'depth'           => -1
																 ) );
								}
							?>
							<script>
								var subject = document.getElementsByClassName('form-subject');
									for (var i = 0; i < subject.length; i++) {
										subject[i].firstChild.firstChild.firstChild.innerHTML = "I need an estimate on...";
									}
							
								var ref = document.getElementsByClassName('form-referral');
									for (var i = 0; i < ref.length; i++) {
										ref[i].firstChild.firstChild.firstChild.innerHTML = "How did you hear about us...";
									}

								var faGlyph = document.getElementsByClassName('wpcf7-list-item');
									for (var i = 0; i < faGlyph.length; i++) {
										if(i%2 === 0) {
											faGlyph[i].firstChild.innerHTML = "&#xf003;";
										}else{
											faGlyph[i].firstChild.innerHTML = "&#xf095;";
										}
										
									}
								</script>

		    			</nav>
					</div>
				</div>
			</div>			
		</footer>
		<a href="#masthead" id="scroll-up"></a>	
	</div><!-- #page -->
	<?php wp_footer(); ?>
</body>
</html>