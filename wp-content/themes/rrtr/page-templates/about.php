<?php 
/**
 * Template Name: About

 */
?>

<?php get_header(); ?>

	<?php do_action( 'spacious_before_body_content' ); ?>

	<div id="primary">
		<div id="content" class="clearfix">
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php do_action( 'spacious_before_post_content' ); ?>
					<div class="team entry-content">
						<?php the_content(); ?>
						<h1 class="feature">Meet Our Leadership Team</h1>
						
						<!-- Team Member 1 -->
						<div class="tg-one-half">
							<img src="<?php bloginfo('stylesheet_directory') ?>/assets/img/about-team1.png"/>
						</div>
						<div class="tg-one-half tg-one-half-last">
							<h5>Kevin LastName</h5>
							<span>Position</span>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
						</div>
						<div style="clear:both;"></div>
						<hr>
						
						<!-- Team Member 2 -->
						<div class="tg-one-half">
							<img src="<?php bloginfo('stylesheet_directory') ?>/assets/img/about-team3.png"/>
						</div>
						<div class="tg-one-half tg-one-half-last">
							<h5>Jason Coben</h5>
							<span>Position</span>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
						</div>
						<div style="clear:both;"></div>
						<hr>
						
						<!-- Team Member 3 -->
						<div class="tg-one-half">
							<img src="<?php bloginfo('stylesheet_directory') ?>/assets/img/about-team3.png"/>
						</div>
						<div class="tg-one-half tg-one-half-last">
							<h5>Steve Stevens</h5>
							<span>Position</span>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
						</div>
						<div style="clear:both;"></div>
						
						
						
						

					</div>
					<footer class="entry-meta-bar clearfix">	        			
						<div class="entry-meta clearfix">
						</div>
					</footer>
					<?php
					do_action( 'spacious_after_post_content' );
				   ?>
				</article>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	
	<?php spacious_sidebar_select(); ?>

	<?php do_action( 'spacious_after_body_content' ); ?>

<?php get_footer(); ?>