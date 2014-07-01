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
					<div id="top-wrapper">
						<!-- Homepage Slider -->
						<div class="grid_8">
							<?php echo do_shortcode('[rsSlider id="35"]'); ?>
						</div>
						
						<!-- Request Form -->
						<div class="grid_4 omega form-wrap">
							<div class="form">
								<h4><b>ROOF INSPECTION & ESTIMATE</b></h4>
								<p>Fill out this quick form and we will contact you to schedule your FREE roof inspection and estimate.</p>
								<?php echo do_shortcode( '[contact-form-7 id="75" title="Home Page Estimate Submission"]' ); ?>
							</div>
							
							<div id="realtor">
								<h4><b>REALTORS: DON'T LOSE A SALE BECAUSE OF AN AGING ROOF</b></h4>
								<a href="<?php the_permalink(); ?>">LEARN MORE</a>
							</div>
						</div>
					</div>
					
					
						<div class="clearfix"></div>
						
						<!-- Homepage Content -->
						<?php the_content(); ?>

						<!-- Feature Boxes -->
						<article id="feature-boxes">
							<div class="grid_3">
								<a href="<?php the_permalink(); ?>" alt=""><img src="<?php bloginfo('stylesheet_directory') ?>/assets/img/home-feature1.jpg"></a>
							</div>
							<div class="grid_3">
								<a href="<?php the_permalink(); ?>" alt=""><img src="<?php bloginfo('stylesheet_directory') ?>/assets/img/home-feature2.jpg"></a>
							</div>
							<div class="grid_3">
								<a href="<?php the_permalink(); ?>" alt=""><img src="<?php bloginfo('stylesheet_directory') ?>/assets/img/home-feature3.jpg"></a>
							</div>
							<div class="grid_3 omega">
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