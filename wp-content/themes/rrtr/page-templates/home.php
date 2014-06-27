<?php
/**
 * Template Name: Home
 *
 */
?>

<?php get_header(); ?>

	<?php do_action( 'spacious_before_body_content' ); ?>

	<div id="home">
		<div id="content" class="clearfix">
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php do_action( 'spacious_before_post_content' ); ?>
					<div class="entry-content clearfix">
					
						<!-- Homepage Slider -->
						<div class="grid_8">
							<?php echo do_shortcode('[rsSlider id="35"]'); ?>
						</div>
						
						<!-- Request Form -->
						<div id="form-wrap" class="grid_4 omega">
							<div id="form">
								<?php echo do_shortcode( '[contact-form-7 id="49" title="Contact form 1"]' ); ?>
								<script>
									document.getElementById('drop-down').firstChild.innerHTML = "I need an estimate on...";
								</script>
							</div>
						</div>

						<div class="clearfix"></div>
						
						<!-- Homepage Content -->
						<?php the_content(); ?>

						<!-- Feature Boxes -->
						<article id="feature-boxes">
							<div class="col3 push0">
								<a href="<?php the_permalink(); ?>" alt=""><img src="<?php bloginfo('stylesheet_directory') ?>/assets/img/home-feature1.jpg"></a>
							</div>
							<div class="col3 push3">
								<a href="<?php the_permalink(); ?>" alt=""><img src="<?php bloginfo('stylesheet_directory') ?>/assets/img/home-feature2.jpg"></a>
							</div>
							<div class="col3 push6">
								<a href="<?php the_permalink(); ?>" alt=""><img src="<?php bloginfo('stylesheet_directory') ?>/assets/img/home-feature3.jpg"></a>
							</div>
							<div class="col3 push9">
								<a href="<?php the_permalink(); ?>" alt=""><img src="<?php bloginfo('stylesheet_directory') ?>/assets/img/home-feature4.jpg"></a>
							</div>
						</article>
						<!-- //Feature Boxes -->

					</div><!-- //.entry-content -->
					<footer class="entry-meta-bar clearfix">	        			
						<div class="entry-meta clearfix"></div>
					</footer>
					<?php
					do_action( 'spacious_after_post_content' );
				   ?>
				</article>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	


	<?php do_action( 'spacious_after_body_content' ); ?>

<?php get_footer(); ?>